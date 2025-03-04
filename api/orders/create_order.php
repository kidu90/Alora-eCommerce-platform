<?php
require_once '../../dbconnection.php';

function createOrder($user_id, $shipping_address, $order_items)
{
    global $conn;

    try {
        $conn->begin_transaction();

        // Calculate total amount
        $total_amount = 0;
        foreach ($order_items as $item) {
            $subtotal = $item['quantity'] * $item['price_per_unit'];
            $total_amount += $subtotal;
        }

        $stmt = $conn->prepare("INSERT INTO orders (user_id, order_date, total_amount, status, shipping_address, payment_status) 
                                VALUES (?, NOW(), ?, 'pending', ?, 'pending')");
        $stmt->bind_param("ids", $user_id, $total_amount, $shipping_address);

        if (!$stmt->execute()) {
            file_put_contents('php://stderr', "Failed to create order: " . $stmt->error . PHP_EOL);
            throw new Exception("Failed to create order: " . $stmt->error);
        }

        $order_id = $stmt->insert_id;
        $stmt->close();

        // Insert order items into the order_items table and update stock
        foreach ($order_items as $item) {
            createOrderItem($order_id, $item['product_id'], $item['quantity'], $item['price_per_unit']);
            updateProductStock($item['product_id'], $item['quantity']);
        }

        // Commit the transaction
        $conn->commit();

        // Log successful order creation
        file_put_contents('php://stderr', "Order created successfully: Order ID = $order_id" . PHP_EOL);

        return [
            "status" => "success",
            "message" => "Order created successfully",
            "order_id" => $order_id,
            "total_amount" => $total_amount
        ];
    } catch (Exception $e) {
        $conn->rollback();
        file_put_contents('php://stderr', "Transaction rolled back: " . $e->getMessage() . PHP_EOL);
        http_response_code(500);
        return [
            "status" => "error",
            "message" => $e->getMessage()
        ];
    }
}

function createOrderItem($order_id, $product_id, $quantity, $price_per_unit)
{
    global $conn;

    $subtotal = $quantity * $price_per_unit;

    $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price_per_unit, subtotal) 
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iiidd", $order_id, $product_id, $quantity, $price_per_unit, $subtotal);

    if (!$stmt->execute()) {
        file_put_contents('php://stderr', "Failed to create order item: " . $stmt->error . PHP_EOL);
        throw new Exception("Failed to create order item: " . $stmt->error);
    }

    $stmt->close();
}

//reduce stock quantity of product
function updateProductStock($product_id, $quantity)
{
    global $conn;

    $stmt = $conn->prepare("UPDATE products SET stock_quantity = stock_quantity - ? WHERE product_id = ?");
    $stmt->bind_param("ii", $quantity, $product_id);

    if (!$stmt->execute()) {
        file_put_contents('php://stderr', "Failed to update product stock: " . $stmt->error . PHP_EOL);
        throw new Exception("Failed to update product stock: " . $stmt->error);
    }

    // Ensure stock does not go negative
    if ($stmt->affected_rows === 0) {
        throw new Exception("Failed to update stock, product ID: $product_id might not exist or have insufficient stock.");
    }

    $stmt->close();
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputData = json_decode(file_get_contents('php://input'), true);

    file_put_contents('php://stderr', "Received Input Data: " . print_r($inputData, true));

    $user_id = $inputData['user_id'] ?? 0;
    $shipping_address = $inputData['shipping_address'] ?? '';
    $order_items = $inputData['order_items'] ?? [];

    if ($user_id <= 0 || empty($shipping_address) || empty($order_items)) {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "Invalid input data. Make sure to provide user_id, shipping_address, and order_items."
        ]);
        exit();
    }

    $response = createOrder($user_id, $shipping_address, $order_items);

    echo json_encode($response);
}

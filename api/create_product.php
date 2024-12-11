<?php
require_once '../dbconnection.php';

function createProduct($name, $description, $price, $brand, $stock_quantity)
{
    global $conn;

    try {
        $stmt = $conn->prepare("INSERT INTO products (name, description, price, brand, stock_quantity) VALUES (?, ?, ?, ?, ?)");

        $stmt->bind_param("ssdsi", $name, $description, $price, $brand, $stock_quantity);

        if ($stmt->execute()) {
            // Return the ID of the newly created product
            return [
                "status" => "success",
                "message" => "Product created successfully",
                "product_id" => $stmt->insert_id
            ];
        } else {
            throw new Exception("Failed to create product: " . $stmt->error);
        }
    } catch (Exception $e) {
        http_response_code(500);
        return [
            "status" => "error",
            "message" => $e->getMessage()
        ];
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
    }
}

header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputData = json_decode(file_get_contents('php://input'), true);

    $name = $inputData['name'] ?? '';
    $description = $inputData['description'] ?? '';
    $price = $inputData['price'] ?? 0;
    $brand = $inputData['brand'] ?? '';
    $stock_quantity = $inputData['stock_quantity'] ?? 0;

    if (empty($name) || empty($description) || $price <= 0 || empty($brand) || $stock_quantity < 0) {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "Invalid input data"
        ]);
        exit();
    }

    // Call the function to create a new product
    $response = createProduct($name, $description, $price, $brand, $stock_quantity);

    echo json_encode($response);
}

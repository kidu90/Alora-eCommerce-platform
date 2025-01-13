<?php
require_once '../../dbconnection.php';

function deleteOrder($order_id)
{
    global $conn;

    try {
        $conn->begin_transaction();

        $stmt = $conn->prepare("DELETE FROM order_items WHERE order_id = ?");
        $stmt->bind_param("i", $order_id);
        if (!$stmt->execute()) {
            file_put_contents('php://stderr', "Failed to delete order items: " . $stmt->error);
            throw new Exception("Failed to delete order items: " . $stmt->error);
        }

        // Delete the order from the orders table
        $stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
        $stmt->bind_param("i", $order_id);
        if (!$stmt->execute()) {
            file_put_contents('php://stderr', "Failed to delete order: " . $stmt->error);
            throw new Exception("Failed to delete order: " . $stmt->error);
        }

        // Commit the transaction
        $conn->commit();

        return [
            "status" => "success",
            "message" => "Order and associated items deleted successfully"
        ];
    } catch (Exception $e) {
        // Rollback if any error occurs
        $conn->rollback();
        file_put_contents('php://stderr', "Transaction rolled back: " . $e->getMessage());
        return [
            "status" => "error",
            "message" => $e->getMessage()
        ];
    }
}


header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $order_id = $_GET['order_id'] ?? null;

    if (!$order_id) {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "Missing 'order_id' in the request"
        ]);
        exit();
    }

    // Call the function to delete the order
    $response = deleteOrder($order_id);

    echo json_encode($response);
}

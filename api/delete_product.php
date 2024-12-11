<?php
require_once '../dbconnection.php';

function deleteProduct($id)
{
    global $conn;

    try {
        $stmt = $conn->prepare("DELETE FROM products WHERE productid = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // Check if any row was affected
        if ($stmt->affected_rows === 0) {
            throw new Exception("No rows affected. Product may not exist.");
        }

        return [
            "status" => "success",
            "message" => "Product deleted successfully"
        ];
    } catch (Exception $e) {
        http_response_code(404);
        echo json_encode([
            "status" => "error",
            "message" => "Failed to delete product",
            "error" => $e->getMessage()
        ]);
        exit();
    }
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Get id from the query string
    if (isset($_GET['id'])) {
        $productId = intval($_GET['id']); // Use 'id' as the query parameter
        $response = deleteProduct($productId);
        echo json_encode($response);
    } else {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "Invalid input: id is required"
        ]);
    }
}

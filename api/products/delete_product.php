<?php
require_once '../../dbconnection.php';

require_once '../../functions.php';

isAuthenticated(true);

function deleteProduct($id)
{
    global $conn;

    try {
        // First check if the product exists
        $checkStmt = $conn->prepare("SELECT product_id FROM products WHERE product_id = ?");
        if (!$checkStmt) {
            throw new Exception("Prepare check statement failed: " . $conn->error);
        }

        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Product with ID $id not found.");
        }
        $checkStmt->close();

        // Check if product is referenced in order_items
        $orderCheckStmt = $conn->prepare("SELECT order_item_id FROM order_items WHERE product_id = ? LIMIT 1");
        if (!$orderCheckStmt) {
            throw new Exception("Prepare order check statement failed: " . $conn->error);
        }

        $orderCheckStmt->bind_param("i", $id);
        $orderCheckStmt->execute();
        $orderResult = $orderCheckStmt->get_result();

        if ($orderResult->num_rows > 0) {
            throw new Exception("Cannot delete product as it is referenced in orders.");
        }
        $orderCheckStmt->close();

        // Proceed with deletion
        $deleteStmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
        if (!$deleteStmt) {
            throw new Exception("Prepare delete statement failed: " . $conn->error);
        }

        $deleteStmt->bind_param("i", $id);

        if (!$deleteStmt->execute()) {
            throw new Exception("Execute failed: " . $deleteStmt->error);
        }

        if ($deleteStmt->affected_rows === 0) {
            throw new Exception("Failed to delete product. No rows affected.");
        }

        return [
            "status" => "success",
            "message" => "Product deleted successfully",
            "product_id" => $id
        ];
    } catch (Exception $e) {
        // Determine appropriate status code based on error
        $statusCode = 500;
        if (strpos($e->getMessage(), "not found") !== false) {
            $statusCode = 404;
        } else if (strpos($e->getMessage(), "referenced in orders") !== false) {
            $statusCode = 409; // Conflict
        }

        http_response_code($statusCode);
        return [
            "status" => "error",
            "message" => $e->getMessage()
        ];
    } finally {
        if (isset($deleteStmt)) {
            $deleteStmt->close();
        }
    }
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Validate and sanitize the product ID
    if (isset($_GET['id'])) {
        $productId = filter_var($_GET['id'], FILTER_VALIDATE_INT);

        if ($productId === false || $productId <= 0) {
            http_response_code(400);
            echo json_encode([
                "status" => "error",
                "message" => "Invalid product ID provided"
            ]);
            exit();
        }

        $response = deleteProduct($productId);
        echo json_encode($response);
    } else {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "Product ID is required"
        ]);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode([
        "status" => "error",
        "message" => "Method not allowed. Use DELETE method."
    ]);
}

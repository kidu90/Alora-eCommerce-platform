<?php
require_once '../dbconnection.php';

function getAllProducts()
{
    global $conn;

    try {
        $sql = "SELECT p.product_id, p.name, p.description, p.price, p.category_id, 
                       p.stock_quantity, p.ingredients, p.usage_tips, p.image_url, 
                       p.created_at, c.name as category_name
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.category_id";

        $result = $conn->query($sql);

        if (!$result) {
            throw new Exception("Query failed: " . $conn->error);
        }

        // Fetch all products
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        return [
            "status" => "success",
            "data" => $products
        ];
    } catch (Exception $e) {
        http_response_code(500);
        return [
            "status" => "error",
            "message" => "Failed to fetch products",
            "error" => $e->getMessage()
        ];
    }
}

function getProductById($id)
{
    global $conn;

    try {
        $stmt = $conn->prepare(
            "SELECT p.product_id, p.name, p.description, p.price, p.category_id, 
                    p.stock_quantity, p.ingredients, p.usage_tips, p.image_url, 
                    p.created_at, c.name as category_name
             FROM products p
             LEFT JOIN categories c ON p.category_id = c.category_id
             WHERE p.product_id = ?"
        );

        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            return [
                "status" => "success",
                "data" => $product
            ];
        } else {
            throw new Exception("Product with ID $id not found.");
        }
    } catch (Exception $e) {
        http_response_code($e->getMessage() === "Product with ID $id not found." ? 404 : 500);
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

// Sanitize input if ID is provided
if (isset($_GET['id'])) {
    $productId = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    if ($productId === false) {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "Invalid product ID provided"
        ]);
        exit();
    }

    // Fetch detailed product data by ID
    $response = getProductById($productId);
} else {
    // Default: fetch all product details
    $response = getAllProducts();
}

echo json_encode($response);

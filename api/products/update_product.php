<?php
require_once '../../dbconnection.php';
require_once '../../functions.php';

function updateProduct($productid, $name, $description, $price, $category_id, $stock_quantity, $ingredients, $usage_tips, $image_url)
{
    global $conn;

    try {
        $stmt = $conn->prepare("UPDATE products 
                               SET name = ?, description = ?, price = ?, category_id = ?, stock_quantity = ?, ingredients = ?, usage_tips = ?, image_url = ? 
                               WHERE product_id = ?");

        $stmt->bind_param(
            "ssdiisssi",
            $name,
            $description,
            $price,
            $category_id,
            $stock_quantity,
            $ingredients,
            $usage_tips,
            $image_url,
            $productid
        );

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                return [
                    "status" => "success",
                    "message" => "Product updated successfully"
                ];
            } else {
                throw new Exception("No rows affected. Product may not exist or data may be unchanged.");
            }
        } else {
            throw new Exception("Failed to update product: " . $stmt->error);
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

    // Get all required fields from input
    $productid = $inputData['productid'] ?? 0;
    $name = $inputData['name'] ?? '';
    $description = $inputData['description'] ?? '';
    $price = $inputData['price'] ?? 0;
    $category_id = $inputData['category_id'] ?? 0;
    $stock_quantity = $inputData['stock_quantity'] ?? 0;
    $ingredients = $inputData['ingredients'] ?? '';
    $usage_tips = $inputData['usage_tips'] ?? '';
    $image_url = $inputData['image_url'] ?? '';

    // Validate input data
    $errors = [];

    if ($productid <= 0) {
        $errors[] = "Valid product ID is required";
    }
    if (empty($name)) {
        $errors[] = "Product name is required";
    }
    if (empty($description)) {
        $errors[] = "Product description is required";
    }
    if ($price <= 0) {
        $errors[] = "Price must be greater than 0";
    }
    if ($category_id <= 0) {
        $errors[] = "Valid category ID is required";
    }
    if ($stock_quantity < 0) {
        $errors[] = "Stock quantity cannot be negative";
    }

    if (!empty($errors)) {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "Invalid input data",
            "errors" => $errors
        ]);
        exit();
    }

    // Call the function to update the product
    $response = updateProduct(
        $productid,
        $name,
        $description,
        $price,
        $category_id,
        $stock_quantity,
        $ingredients,
        $usage_tips,
        $image_url
    );

    echo json_encode($response);
}

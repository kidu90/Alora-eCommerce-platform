<?php
require_once '../../dbconnection.php';
require_once '../../functions.php';


// Function to create a new product
function createProduct($name, $description, $price, $category_id, $stock_quantity, $ingredients, $usage_tips, $image_url)
{
    global $conn;

    try {
        $name = htmlspecialchars(trim($name));
        $description = htmlspecialchars(trim($description));
        $ingredients = htmlspecialchars(trim($ingredients));
        $usage_tips = htmlspecialchars(trim($usage_tips));
        $image_url = filter_var(trim($image_url), FILTER_SANITIZE_URL);

        $stmt = $conn->prepare("INSERT INTO products (name, description, price, category_id, stock_quantity, ingredients, usage_tips, image_url) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param(
            "ssdiisss",
            $name,
            $description,
            $price,
            $category_id,
            $stock_quantity,
            $ingredients,
            $usage_tips,
            $image_url
        );

        if ($stmt->execute()) {
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

    // Get all required fields from input
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

    $response = createProduct(
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

<?php
require_once '../dbconnection.php';

function getAllProducts()
{

    global $conn; // Use the global connection object from dbconnection.php

    try {
        $sql = "SELECT productid, name, description, price, brand, stock_quantity FROM products";
        $result = $conn->query($sql);

        if (!$result) {
            throw new Exception("Query failed: " . $conn->error);
        }

        // Fetch all products
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        return $products;
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode([
            "status" => "error",
            "message" => "Failed to fetch products",
            "error" => $e->getMessage()
        ]);
        exit();
    }
}

function getProductById($id)
{
    global $conn;

    try {
        $stmt = $conn->prepare("SELECT productid, name, description, price, brand, stock_quantity FROM products WHERE productid = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch the product data
            $product = $result->fetch_assoc();
        } else {
            throw new Exception("Product with ID $id not found.");
        }

        $stmt->close();

        return $product;
    } catch (Exception $e) {
        http_response_code(404);
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage()
        ]);
        exit();
    }
}

function getProductsForCards()
{
    global $conn;

    try {
        // Select only the required fields for product cards
        $sql = "SELECT productid, name, price, image_url FROM products";
        $result = $conn->query($sql);

        if (!$result) {
            throw new Exception("Query failed: " . $conn->error);
        }

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        return $products;
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode([
            "status" => "error",
            "message" => "Failed to fetch products for cards",
            "error" => $e->getMessage()
        ]);
        exit();
    }
}


header('Content-Type: application/json'); // Set the content type to JSON

if (isset($_GET['id'])) {
    $productId = intval($_GET['id']);
    $product = getProductById($productId);
    echo json_encode($product); // Output the product as JSON
} else {

    $allProducts = getAllProducts();
    echo json_encode($allProducts); // Output all products as JSON
}

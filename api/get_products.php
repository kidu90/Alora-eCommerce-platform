<?php
require_once '../dbconnection.php'; // Include the database connection

function getAllProducts()
{

    global $conn; // Use the global connection object from dbconnection.php

    try {
        // Query to fetch all products
        $sql = "SELECT productid, name, description, price, brand, stock_quantity FROM products";
        $result = $conn->query($sql);

        // Check if the query was successful
        if (!$result) {
            throw new Exception("Query failed: " . $conn->error);
        }

        // Fetch all products
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        // Return the products array
        return $products;
    } catch (Exception $e) {
        // Handle errors
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
    global $conn; // Use the global connection object from dbconnection.php

    try {
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT productid, name, description, price, brand, stock_quantity FROM products WHERE productid = ?");
        $stmt->bind_param("i", $id); // Bind the ID as an integer
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch the product data
            $product = $result->fetch_assoc();
        } else {
            // Product not found
            throw new Exception("Product with ID $id not found.");
        }

        // Close the statement
        $stmt->close();

        // Return the product data
        return $product;
    } catch (Exception $e) {
        // Handle errors
        http_response_code(404); // Set HTTP status to 404 for not found
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage()
        ]);
        exit();
    }
}

header('Content-Type: application/json'); // Set the content type to JSON

// Example usage
if (isset($_GET['id'])) {
    // If 'id' is passed in the query string, get a single product
    $productId = intval($_GET['id']); // Ensure ID is an integer
    $product = getProductById($productId);
    echo json_encode($product); // Output the product as JSON
} else {
    // Otherwise, get all products

    $allProducts = getAllProducts();
    echo json_encode($allProducts); // Output all products as JSON
}

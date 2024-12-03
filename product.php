<?php

include_once '../controllers/ProductController.php';
include_once '../dbconnection.php';
include_once '../models/ProductModel.php';

// Database connection
try {
    $db = new mysqli($servername, $username, $password, $dbname);

    if ($db->connect_error) {
        throw new Exception("Connection failed: " . $db->connect_error);
    }

    // Handle routing
    $request_method = $_SERVER["REQUEST_METHOD"];
    $request_uri = $_SERVER['REQUEST_URI'];

    // Basic routing for products
    if ($request_method === 'GET') {
        if (strpos($request_uri, '/api/products') !== false) {
            $productController = new ProductController($db);
            $productController->getAllProducts();
        }
    }
} catch (Exception $e) {
    // Error handling
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}

// Close database connection
if (isset($db)) {
    $db->close();
}

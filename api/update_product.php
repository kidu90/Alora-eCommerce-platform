<?php

// Include database connection file (adjust path if needed)
require_once '../dbconnection.php';

// Define the updateProduct function
function updateProduct($data)
{
    global $conn; // Use the global connection object from dbconnection.php

    try {
        // Check if the necessary data is provided
        if (!isset($data['productid'], $data['name'], $data['description'], $data['price'], $data['brand'], $data['stock_quantity'])) {
            throw new Exception("Missing required fields");
        }

        // Prepare the SQL statement to update a product by ID
        $stmt = $conn->prepare("UPDATE products SET name = ?, description = ?, price = ?, brand = ?, stock_quantity = ? WHERE productid = ?");

        // Bind parameters to the prepared statement
        $stmt->bind_param("sssdis", $data['name'], $data['description'], $data['price'], $data['brand'], $data['stock_quantity'], $data['productid']);

        // Execute the statement
        $stmt->execute();

        // Check if any row was affected
        if ($stmt->affected_rows === 0) {
            throw new Exception("No rows affected. Product may not exist or data may be unchanged.");
        }

        // Return success message
        return [
            "status" => "success",
            "message" => "Product updated successfully"
        ];
    } catch (Exception $e) {
        // Handle errors
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "Failed to update product",
            "error" => $e->getMessage()
        ]);
        exit();
    }
}


header('Content-Type: application/json');
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw JSON input from the request
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if the productid is provided in the input data
    if (isset($data['productid'])) {
        // Call the updateProduct function with the provided data
        $response = updateProduct($data);
        // Output the response as JSON
        echo json_encode($response);
    } else {
        // If productid is missing, return an error response
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "Invalid input: productid is required"
        ]);
    }
}

// Close the database connection
$conn->close();

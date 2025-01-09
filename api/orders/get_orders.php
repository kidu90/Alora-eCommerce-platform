<?php
require_once '../../dbconnection.php';

function getAllOrders()
{
    global $conn;

    try {
        // Prepare the query to select all orders
        $stmt = $conn->prepare("SELECT * FROM orders");

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Fetch all the orders
            $orders = [];
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }

            $stmt->close();

            return [
                "status" => "success",
                "message" => "Orders retrieved successfully",
                "orders" => $orders
            ];
        } else {
            return [
                "status" => "error",
                "message" => "No orders found"
            ];
        }
    } catch (Exception $e) {
        file_put_contents('php://stderr', "Error: " . $e->getMessage());
        return [
            "status" => "error",
            "message" => $e->getMessage()
        ];
    }
}

header('Content-Type: application/json');

// Call the function to get all orders
$response = getAllOrders();

echo json_encode($response);

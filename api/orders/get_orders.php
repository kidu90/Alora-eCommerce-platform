<?php
require_once '../../dbconnection.php';

// Function to get all orders
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

// Function to get orders by user ID
function getOrdersByUserId($userId)
{
    global $conn;

    try {
        // Prepare the query to select orders by user ID
        $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");

        // Bind the user ID parameter
        $stmt->bind_param("i", $userId);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Fetch all the orders for the user
            $orders = [];
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }

            $stmt->close();

            return [
                "status" => "success",
                "message" => "Orders for user retrieved successfully",
                "orders" => $orders
            ];
        } else {
            return [
                "status" => "error",
                "message" => "No orders found for this user"
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

// Example: Retrieve orders for a specific user
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['user_id'])) {
    $userId = (int)$_GET['user_id'];
    $response = getOrdersByUserId($userId);
} else {
    $response = [
        "status" => "error",
        "message" => "User ID is required"
    ];
}

echo json_encode($response);

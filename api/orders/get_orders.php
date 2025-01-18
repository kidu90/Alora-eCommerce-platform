<?php
require_once '../../dbconnection.php';

// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Function to get all orders
function getAllOrders()
{
    global $conn;

    try {
        $stmt = $conn->prepare("SELECT * FROM orders");
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $orders = [];
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }

            $stmt->close();

            return [
                "status" => "success",
                "message" => "All orders retrieved successfully",
                "orders" => $orders
            ];
        } else {
            return [
                "status" => "error",
                "message" => "No orders found"
            ];
        }
    } catch (Exception $e) {
        file_put_contents('php://stderr', "Error: " . $e->getMessage() . "\n");
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
        $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $orders = [];
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }

            $stmt->close();

            // Log the orders for debugging
            //file_put_contents('php://stderr', print_r($orders, true));

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
        file_put_contents('php://stderr', "Error: " . $e->getMessage() . "\n");
        return [
            "status" => "error",
            "message" => $e->getMessage()
        ];
    }
}

// Handle API request
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['user_id'])) {
        $userId = (int)$_GET['user_id'];
        $response = getOrdersByUserId($userId);
    } else {
        $response = getAllOrders();
    }
} else {
    $response = [
        "status" => "error",
        "message" => "Invalid request method"
    ];
}

echo json_encode($response);

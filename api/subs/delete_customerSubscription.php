<?php
require_once '../../dbconnection.php';


function deleteCustomerSubscription($userId, $subscriptionId)
{
    global $conn;

    try {
        // Check if the subscription exists for the given user and subscription ID
        $checkQuery = "SELECT * FROM customer_subscriptions WHERE subscription_id = ? AND user_id = ?";
        $stmt = $conn->prepare($checkQuery);

        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }

        $stmt->bind_param("ii", $subscriptionId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            http_response_code(404);
            throw new Exception("No subscription found for the specified user ID and subscription ID");
        }

        // Delete the specific subscription
        $deleteQuery = "DELETE FROM customer_subscriptions WHERE subscription_id = ? AND user_id = ?";
        $stmt = $conn->prepare($deleteQuery);

        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }

        $stmt->bind_param("ii", $subscriptionId, $userId);

        if ($stmt->execute()) {
            return [
                "status" => "success",
                "message" => "The subscription has been deleted successfully"
            ];
        } else {
            throw new Exception("Failed to delete the subscription: " . $stmt->error);
        }
    } catch (Exception $e) {
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

// Set the response type to JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Validate and extract user_id and subscription_id from the URL parameters
    if (isset($_GET['user_id']) && isset($_GET['subscription_id'])) {
        $userId = filter_var($_GET['user_id'], FILTER_VALIDATE_INT);
        $subscriptionId = filter_var($_GET['subscription_id'], FILTER_VALIDATE_INT);

        if ($userId === false || $userId <= 0 || $subscriptionId === false || $subscriptionId <= 0) {
            http_response_code(400);
            echo json_encode([
                "status" => "error",
                "message" => "Invalid user ID or subscription ID provided"
            ]);
            exit();
        }

        // Call the function to delete the subscription
        $response = deleteCustomerSubscription($userId, $subscriptionId);
    } else {
        http_response_code(400);
        $response = [
            "status" => "error",
            "message" => "Both user ID and subscription ID are required"
        ];
    }

    echo json_encode($response);
} else {
    http_response_code(405);
    echo json_encode([
        "status" => "error",
        "message" => "Method not allowed. Use DELETE."
    ]);
}

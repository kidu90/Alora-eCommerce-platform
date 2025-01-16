<?php
require_once '../../dbconnection.php';
require_once '../../functions.php';

// Function to delete a subscription
function deleteSubscription($subscription_id)
{
    global $conn;

    try {
        // Prepare the query to check if the subscription exists
        $stmt = $conn->prepare("SELECT * FROM customer_subscriptions WHERE subscription_id = ?");
        $stmt->bind_param("i", $subscription_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Subscription ID not found");
        }

        // Prepare and execute the deletion query
        $delete_query = "DELETE FROM customer_subscriptions WHERE subscription_id = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("i", $subscription_id);

        if ($stmt->execute()) {
            return [
                "status" => "success",
                "message" => "Subscription deleted successfully"
            ];
        } else {
            throw new Exception("Failed to delete subscription: " . $stmt->error);
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

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Get the subscription_id from the URL
    if (isset($_GET['subscription_id']) && is_numeric($_GET['subscription_id'])) {
        $subscription_id = $_GET['subscription_id'];
    } else {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "Invalid subscription_id"
        ]);
        exit();
    }

    // Call the function to delete the subscription
    $response = deleteSubscription($subscription_id);

    echo json_encode($response);
}

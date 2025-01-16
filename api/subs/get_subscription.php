<?php
require_once '../../dbconnection.php';

function getAllSubscriptions()
{
    global $conn;

    try {
        $sql = "SELECT plan_id, name, description, price, duration_months, is_custom_box FROM subscription_plans";
        $result = $conn->query($sql);

        if (!$result) {
            throw new Exception("Query failed: " . $conn->error);
        }

        $subscriptions = [];
        while ($row = $result->fetch_assoc()) {
            $subscriptions[] = $row;
        }

        return [
            "status" => "success",
            "data" => $subscriptions
        ];
    } catch (Exception $e) {
        http_response_code(500);
        return [
            "status" => "error",
            "message" => "Failed to fetch subscription plans",
            "error" => $e->getMessage()
        ];
    }
}

header('Content-Type: application/json');

// Fetch all subscriptions
$response = getAllSubscriptions();

echo json_encode($response);

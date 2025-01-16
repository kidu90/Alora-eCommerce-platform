<?php
require_once '../../dbconnection.php';

function getAllCustomerSubscriptions()
{
    global $conn;

    try {
        $sql = "SELECT subscription_id, user_id, plan_id, start_date, next_delivery_date, status, created_at 
                FROM customer_subscriptions";
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
            "message" => "Failed to fetch customer subscriptions",
            "error" => $e->getMessage()
        ];
    }
}

function getSubscriptionById($subscriptionId)
{
    global $conn;

    try {
        $sql = "SELECT subscription_id, user_id, plan_id, start_date, next_delivery_date, status, created_at 
                FROM customer_subscriptions 
                WHERE subscription_id = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("i", $subscriptionId);

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $subscription = $result->fetch_assoc();
            return [
                "status" => "success",
                "data" => $subscription
            ];
        } else {
            throw new Exception("Subscription with ID $subscriptionId not found.");
        }
    } catch (Exception $e) {
        http_response_code($e->getMessage() === "Subscription with ID $subscriptionId not found." ? 404 : 500);
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

function getSubscriptionsByUserId($userId)
{
    global $conn;

    try {
        $sql = "SELECT subscription_id, user_id, plan_id, start_date, next_delivery_date, status, created_at 
                FROM customer_subscriptions 
                WHERE user_id = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("i", $userId);

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();

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
            "message" => "Failed to fetch subscriptions for user",
            "error" => $e->getMessage()
        ];
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
    }
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['subscription_id'])) {
        $subscriptionId = filter_var($_GET['subscription_id'], FILTER_VALIDATE_INT);

        if ($subscriptionId === false || $subscriptionId <= 0) {
            http_response_code(400);
            echo json_encode([
                "status" => "error",
                "message" => "Invalid subscription ID provided"
            ]);
            exit();
        }

        // Fetch subscription by ID
        $response = getSubscriptionById($subscriptionId);
    } elseif (isset($_GET['user_id'])) {
        $userId = filter_var($_GET['user_id'], FILTER_VALIDATE_INT);

        if ($userId === false || $userId <= 0) {
            http_response_code(400);
            echo json_encode([
                "status" => "error",
                "message" => "Invalid user ID provided"
            ]);
            exit();
        }

        // Fetch subscriptions by user ID
        $response = getSubscriptionsByUserId($userId);
    } else {
        // Fetch all customer subscriptions
        $response = getAllCustomerSubscriptions();
    }

    echo json_encode($response);
}

<?php
require_once '../../dbconnection.php';
require_once '../../functions.php';

// Function to create a new subscription
function createSubscription($user_id, $plan_id)
{
    global $conn;

    try {
        $stmt = $conn->prepare("SELECT * FROM subscription_plans WHERE plan_id = ?");
        $stmt->bind_param("i", $plan_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $plan = $result->fetch_assoc();

        if (!$plan) {
            throw new Exception("Invalid plan ID");
        }

        // Get plan details
        $duration_months = $plan['duration_months'];
        $start_date = date('Y-m-d'); // Set the start date to current date
        $next_delivery_date = date('Y-m-d', strtotime("+$duration_months months"));
        $status = 'active'; // Default status for the subscription
        $created_at = date('Y-m-d H:i:s'); // Current timestamp

        // Insert into customer_subscription table
        $insert_query = "INSERT INTO customer_subscriptions (user_id, plan_id, start_date, next_delivery_date, status, created_at) 
                         VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("iissss", $user_id, $plan_id, $start_date, $next_delivery_date, $status, $created_at);

        if ($stmt->execute()) {
            return [
                "status" => "success",
                "message" => "Subscription created successfully",
                "subscription_id" => $stmt->insert_id
            ];
        } else {
            throw new Exception("Failed to create subscription: " . $stmt->error);
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputData = json_decode(file_get_contents('php://input'), true);

    // Get all required fields from input
    $user_id = $inputData['user_id'] ?? 0;
    $plan_id = $inputData['plan_id'] ?? 0;

    // Validate input data
    $errors = [];

    if ($user_id <= 0) {
        $errors[] = "User ID is required and must be greater than 0";
    }
    if ($plan_id <= 0) {
        $errors[] = "Plan ID is required and must be greater than 0";
    }

    if (!empty($errors)) {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "Invalid input data",
            "errors" => $errors
        ]);
        exit();
    }

    // Call the function to create a new subscription
    $response = createSubscription($user_id, $plan_id);

    echo json_encode($response);
}

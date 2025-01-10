<?php


require_once '../../dbconnection.php';

function updateOrderStatus($order_id, $payment_status, $status)
{
    global $conn;

    try {
        // Prepare the SQL query to update the payment_status and status
        $stmt = $conn->prepare("UPDATE orders SET payment_status = ?, status = ? WHERE order_id = ?");

        // Bind parameters
        $stmt->bind_param("ssi", $payment_status, $status, $order_id);

        // Execute the query
        if (!$stmt->execute()) {
            file_put_contents('php://stderr', "Failed to update order: " . $stmt->error);
            throw new Exception("Failed to update order: " . $stmt->error);
        }

        // Close the statement
        $stmt->close();

        // Return success message
        return [
            "status" => "success",
            "message" => "Order updated successfully"
        ];
    } catch (Exception $e) {
        file_put_contents('php://stderr', "Error: " . $e->getMessage());
        return [
            "status" => "error",
            "message" => $e->getMessage()
        ];
    }
}

header('Content-Type: application/json');

// Only process PUT requests
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Get data from the request
    $inputData = json_decode(file_get_contents('php://input'), true);

    // Log the input data for debugging
    file_put_contents('php://stderr', "Received Input Data: " . print_r($inputData, true));

    // Extract order_id, payment_status, and status
    $order_id = $inputData['order_id'] ?? 0;
    $payment_status = $inputData['payment_status'] ?? '';
    $status = $inputData['status'] ?? '';

    // Validate input
    if ($order_id <= 0 || empty($payment_status) || empty($status)) {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "Invalid input data. Make sure to provide order_id, payment_status, and status."
        ]);
        exit();
    }

    // Call the updateOrderStatus function
    $response = updateOrderStatus($order_id, $payment_status, $status);

    // Send the response as JSON
    echo json_encode($response);
}

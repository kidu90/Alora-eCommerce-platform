<?php
require_once '../../dbconnection.php';

function getAllCategories()
{
    global $conn;

    try {
        // SQL query to fetch all categories
        $sql = "SELECT category_id, name, description FROM categories";

        $result = $conn->query($sql);

        if (!$result) {
            throw new Exception("Query failed: " . $conn->error);
        }

        // Fetch all categories
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }

        return [
            "status" => "success",
            "data" => $categories
        ];
    } catch (Exception $e) {
        http_response_code(500);
        return [
            "status" => "error",
            "message" => "Failed to fetch categories",
            "error" => $e->getMessage()
        ];
    }
}

header('Content-Type: application/json');

// Fetch all categories
$response = getAllCategories();

echo json_encode($response);

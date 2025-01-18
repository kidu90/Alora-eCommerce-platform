<?php
include '../../dbconnection.php';

// Check if the search query is set
if (isset($_GET['query'])) {
    $searchQuery = $_GET['query'];

    $searchQuery = mysqli_real_escape_string($conn, $searchQuery);

    // Start building the SQL query to search for products by name
    $sql = "SELECT p.* FROM products p 
            JOIN categories c ON p.category_id = c.category_id
            WHERE p.name LIKE '%$searchQuery%'";

    // Check if category is set
    if (isset($_GET['category']) && !empty($_GET['category'])) {
        $category = $_GET['category'];
        $category = mysqli_real_escape_string($conn, $category);
        $sql .= " AND c.name = '$category'";
    }

    $result = mysqli_query($conn, $sql);

    // Check if there are results
    if (mysqli_num_rows($result) > 0) {
        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }

        echo json_encode($products);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode(['error' => 'Invalid search parameters']);
}

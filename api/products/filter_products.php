<?php
require_once '../../dbconnection.php';
require_once '../../functions.php';

header('Content-Type: application/json');

// Fetch the filter parameter from the request
$filter = $_GET['filter'] ?? '';

$products = fetchProducts(1, 12)['data'];

if ($filter === 'price-low-high') {
    usort($products, fn($a, $b) => $a['price'] - $b['price']); // Sort by price ascending
} elseif ($filter === 'price-high-low') {
    usort($products, fn($a, $b) => $b['price'] - $a['price']); // Sort by price descending
} elseif ($filter === 'newest') {
    usort($products, fn($a, $b) => strtotime($b['created_at']) - strtotime($a['created_at'])); // Sort by newest
}

echo json_encode($products);

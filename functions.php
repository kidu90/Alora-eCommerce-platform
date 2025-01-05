<?php
// api/get_product.php

function fetchProducts($page = 1, $limit = 10)
{
    $url = 'http://localhost/Alora/api/get_products.php'; // The path to the API endpoint

    // Add pagination parameters to the API request
    $url .= '?page=' . $page . '&limit=' . $limit;

    // Use cURL to send a GET request to the API
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Return the response as a string
    curl_setopt($ch, CURLOPT_HTTPGET, true);  // Set request type as GET

    $response = curl_exec($ch);

    if ($response === false) {
        // Handle error in case of failure
        return [
            "status" => "error",
            "message" => "Failed to fetch products: " . curl_error($ch)
        ];
    }

    curl_close($ch);

    // Decode the JSON response
    $data = json_decode($response, true);

    // Check if the API returns a successful response
    if (isset($data['status']) && $data['status'] === 'success') {
        return [
            "status" => "success",
            "data" => $data['data'],
            "pagination" => $data['pagination']  // Include pagination information
        ];
    } else {
        // If the response contains an error message
        return [
            "status" => "error",
            "message" => "No products found or API error"
        ];
    }
}

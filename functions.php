
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'dbconnection.php';
// api/get_product.php

function fetchProducts($page = 1, $limit = 10)
{
    $url = 'http://localhost/Alora/api/Products/get_products.php';

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

function startSession()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

function isAuthenticated($adminRequired = false)
{

    header('Content-Type: application/json');
    startSession();

    if (!isset($_SESSION['user_id'])) {
        http_response_code(401); // Unauthorized
        echo json_encode([
            "status" => "error",
            "message" => "Unauthorized access. Please log in.",
            "success" => false
        ]);
        exit; // Stop further execution
    }

    // Check if admin access is required
    if ($adminRequired && $_SESSION['ROLE'] !== 'admin') {
        http_response_code(403); // Forbidden
        echo json_encode([
            "status" => "error",
            "message" => "Admin access required.",
            "success" => false
        ]);
        exit; // Stop further execution
    }

    // Optional: Return user session data if needed
    return [
        "user_id" => $_SESSION['user_id'],
        "first_name" => $_SESSION['first_name'],
        "email" => $_SESSION['email'],
        "role" => $_SESSION['ROLE'],
        "success" => true
    ];
}

function loginUser($email, $password)
{
    $url = 'http://localhost/Alora/api/auth/login.php';

    // Create an array of data to be posted to the API
    $data = [
        'email' => $email,
        'password' => $password
    ];

    // Use cURL to send a POST request to the API
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Return the response as a string
    curl_setopt($ch, CURLOPT_POST, true);  // Set request type as POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));  // Set the POST data

    // Set the content type to application/json
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);

    if ($response === false) {
        // Handle error in case of failure
        return [
            "status" => "error",
            "message" => "Failed to login: " . curl_error($ch)
        ];
    }

    curl_close($ch);

    // Decode the JSON response
    $data = json_decode($response, true);
    // echo json_encode($data);
    if (isset($data['status']) && $data['status'] === 'success') {
        // Set session variables
        startSession();
        $_SESSION['user_id'] = $data['user']['id'];
        $_SESSION['first_name'] = $data['user']['first_name'];
        $_SESSION['email'] = $data['user']['email'];
        $_SESSION['ROLE'] = $data['user']['role'];

        return [
            "status" => "success",
            "message" => "Login successful"
        ];
    } else {
        return [
            "status" => "error",
            "message" => "Invalid email or password"
        ];
    }
}


// Fetch filtered products function

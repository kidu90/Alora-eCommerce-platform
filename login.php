<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'dbconnection.php';
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $response = loginUser($email, $password);

    if ($response['status'] === 'success') {
        // Role-based redirection
        if ($_SESSION['ROLE'] === 'admin') {
            header('Location: Admin/index.php'); // Redirect to the admin dashboard
            exit;
        } else {
            header('Location: index.php'); // Redirect to the customer dashboard or homepage
            exit;
        }
    } else {
        $error_message = $response['message'];
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<?php require 'views/partials/header.php'; ?>

<body class="font-sans bg-primary">

    <!-- Navigation -->
    <?php require 'views/partials/navbar.php'; ?>

    <!-- Login Section -->
    <section class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h2 class="text-3xl font-bold mb-6 text-center font-secondary">Login to Your Account</h2>

            <?php
            // Display error message if login fails
            if (isset($error_message)) {
                echo "<p style='color: red; text-align: center;'>$error_message</p>";
            }
            ?>

            <form method="POST" action="login.php">
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" id="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black">
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" id="password" name="password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black">
                </div>
                <button type="submit" class="w-full bg-black text-white py-2 px-4 rounded-md hover:bg-gray-800 transition duration-300">
                    Log In
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">Don't have an account? <a href="index.php?route=register" class="text-black hover:underline">Sign up</a></p>
            </div>
        </div>
    </section>

    <?php require 'views/partials/footer.php'; ?>

</body>

</html>
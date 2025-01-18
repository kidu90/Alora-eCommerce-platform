<?php
require_once 'dbconnection.php';
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $error = registerUser($first_name, $last_name, $email, $password);

    if ($error) {
        header('Location: register.php?error=' . $error);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php require 'views/partials/header.php'; ?>

<body class="font-sans bg-primary">
    <!-- Navigation -->
    <?php
    require 'views/partials/navbar.php'
    ?>

    <!-- Registration Section -->
    <section class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h2 class="text-3xl font-bold mb-6 text-center font-secondary">Create Your Account</h2>

            <form method="POST">
                <div class="mb-4">
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                    <input type="text" id="first_name" name="first_name" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black">
                </div>
                <div class="mb-4">
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <input type="text" id="last_name" name="last_name" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black">
                </div>
                <button type="submit"
                    class="w-full bg-black text-white py-2 px-4 rounded-md hover:bg-gray-800 transition duration-300">
                    Register
                </button>
            </form>
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">Already have an account? <a href="login.php" class="text-black hover:underline">Log in</a></p>
            </div>
        </div>
    </section>

    <?php
    require 'views/partials/footer.php'
    ?>
</body>

</html>
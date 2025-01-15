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
            <?php
            // Display any error messages
            if (isset($_GET['error'])) {
                echo "<p style='color: red; text-align: center;'>" . htmlspecialchars($_GET['error']) . "</p>";
            }
            ?>
            <form>
                <div class="mb-4">
                    <label for="fullname" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input type="text" id="fullname" name="fullname" required
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
                <div class="mb-6">
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required
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
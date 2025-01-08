<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alora - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Cardo:ital,wght@0,400;0,700;1,400&family=Ga+Maamli&family=Kanit:ital@1&family=Playfair+Display:wght@600&family=Ubuntu:wght@500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Cardo:ital,wght@0,400;0,700;1,400&family=Ga+Maamli&family=Kanit:ital@1&family=Playfair+Display:wght@600&family=Rubik:ital,wght@0,300..900;1,300..900&family=Ubuntu:wght@500&display=swap" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body class="font-sans bg-primary">
    <!-- Navigation -->
    <?php
    require 'views/partials/navbar.php'
    ?>

    <!-- Login Section -->
    <section class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h2 class="text-3xl font-bold mb-6 text-center font-secondary">Login to Your Account</h2>
            <?php
            // Display any error messages
            if (isset($_GET['error'])) {
                echo "<?p style='color: red; text-align: center;'>" . htmlspecialchars($_GET['error']) . "</?p>";
            }
            ?>
            <form>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black">
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black">
                </div>
                <button type="submit"
                    class="w-full bg-black text-white py-2 px-4 rounded-md hover:bg-gray-800 transition duration-300">
                    Log In
                </button>
            </form>
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">Don't have an account? <a href="index.php?route=register" class="text-black hover:underline">Sign up</a></p>
            </div>
        </div>
    </section>

    <?php
    require 'views/partials/footer.php'
    ?>
</body>

</html>
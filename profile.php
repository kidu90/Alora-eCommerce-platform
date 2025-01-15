<?php
require_once 'functions.php';
require_once 'dbconnection.php';

isAuthenticated(false, false);
$userId = $_SESSION['user_id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    logoutUser();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alora - Your Profile</title>
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body class="font-sans bg-primary">
    <!-- Navigation -->
    <?php
    require 'views/partials/navbar.php'
    ?>

    <!-- Profile Section -->
    <section class="flex items-center justify-center min-h-screen py-12">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-2xl">
            <h2 class="text-3xl font-bold mb-6 text-center font-secondary">Welcome, <?php echo htmlspecialchars($_SESSION['first_name']); ?></h2>

            <h3 class="text-2xl font-bold mb-4">Your Order History</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 bg-gray-100 font-semibold text-sm text-gray-600 border-b">Order ID</th>
                            <th class="py-2 px-4 bg-gray-100 font-semibold text-sm text-gray-600 border-b">Date</th>
                            <th class="py-2 px-4 bg-gray-100 font-semibold text-sm text-gray-600 border-b">Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['order_history'] as $order): ?>
                            <tr>
                                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($order['order_id']); ?></td>
                                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($order['order_date']); ?></td>
                                <td class="py-2 px-4 border-b">$<?php echo htmlspecialchars(number_format($order['total_amount'], 2)); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <form action="" method="POST">
                    <button type="submit" name="logout" class="text-black font-bold py-2 px-4 rounded">
                        Logout
                    </button>
                </form>

            </div>
        </div>
    </section>

    <?php
    require 'views/partials/footer.php'
    ?>
</body>

</html>
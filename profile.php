<?php
require_once 'functions.php';
require_once 'dbconnection.php';

// Ensure the user is authenticated
isAuthenticated(false, false);

// Get the logged-in user's ID from the session
$userId = $_SESSION['user_id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    logoutUser();
}

try {
    // Fetch orders by user ID
    if ($userId) {
        $orders = fetchOrdersByUserId($userId);
    } else {
        $orders = [];
    }
} catch (Exception $e) {
    // Handle any errors in fetching orders
    $orders = [];
    $errorMessage = $e->getMessage();
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
    <?php require 'views/partials/navbar.php'; ?>

    <!-- Profile Section -->
    <section class="flex items-center justify-center min-h-screen py-12">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-2xl">
            <h2 class="text-3xl font-bold mb-6 text-center font-secondary">Welcome, <?php echo htmlspecialchars($_SESSION['first_name']); ?></h2>

            <h3 class="text-2xl font-bold mb-4">Your Order History</h3>

            <?php if (isset($errorMessage)): ?>
                <div class="text-red-500 mb-4">
                    <?php echo htmlspecialchars($errorMessage); ?>
                </div>
            <?php endif; ?>

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
                        <?php if (!empty($orders)): ?>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($order['order_id']); ?></td>
                                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($order['order_date']); ?></td>
                                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($order['total_amount']); ?> USD</td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="py-2 px-4 text-center text-gray-500">No orders found</td>
                            </tr>
                        <?php endif; ?>
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

    <?php require 'views/partials/footer.php'; ?>
</body>

</html>
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
        $subscriptions = fetchSubscriptionsByUserId($userId);  // Fetch subscriptions for the user
    } else {
        $orders = [];
        $subscriptions = [];
    }
} catch (Exception $e) {
    // Handle any errors in fetching orders or subscriptions
    $orders = [];
    $subscriptions = [];
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

            <!-- Orders Table -->
            <div class="overflow-x-auto mb-8">
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
            </div>

            <!-- Subscriptions Table -->
            <h3 class="text-2xl font-bold mb-4">Your Subscription History</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 bg-gray-100 font-semibold text-sm text-gray-600 border-b">Subscription ID</th>
                            <th class="py-2 px-4 bg-gray-100 font-semibold text-sm text-gray-600 border-b">Plan ID</th>
                            <th class="py-2 px-4 bg-gray-100 font-semibold text-sm text-gray-600 border-b">Start Date</th>
                            <th class="py-2 px-4 bg-gray-100 font-semibold text-sm text-gray-600 border-b">Next Delivery</th>
                            <th class="py-2 px-4 bg-gray-100 font-semibold text-sm text-gray-600 border-b">Status</th>
                            <th class="py-2 px-4 bg-gray-100 font-semibold text-sm text-gray-600 border-b">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($subscriptions)): ?>
                            <?php foreach ($subscriptions as $subscription): ?>
                                <tr>
                                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($subscription['subscription_id']); ?></td>
                                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($subscription['plan_id']); ?></td>
                                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($subscription['start_date']); ?></td>
                                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($subscription['next_delivery_date']); ?></td>
                                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($subscription['status']); ?></td>
                                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($subscription['created_at']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="py-2 px-4 text-center text-gray-500">No subscriptions found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <form action="" method="POST">
                <button type="submit" name="logout" class="bg-gray-200 text-black px-6 py-2 rounded-full hover:bg-gray-100 mt-4 inline-block">
                    Logout
                </button>
            </form>
        </div>
    </section>

    <?php require 'views/partials/footer.php'; ?>
</body>

</html>
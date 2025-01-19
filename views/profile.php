<?php
require_once 'functions.php';
require_once 'dbconnection.php';

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
    <?php require 'views/partials/navbar.php'; ?>

    <section class="flex items-center justify-center min-h-screen py-12">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-2xl">
            <h2 class="text-3xl font-bold mb-6 text-center font-secondary">Welcome, <?php echo htmlspecialchars($_SESSION['first_name']); ?></h2>

            <h3 class="text-2xl font-bold mb-4">Your Order History</h3>
            <div class="overflow-x-auto mb-8">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 bg-gray-100 font-semibold text-sm text-gray-600 border-b">Order ID</th>
                            <th class="py-2 px-4 bg-gray-100 font-semibold text-sm text-gray-600 border-b">Date</th>
                            <th class="py-2 px-4 bg-gray-100 font-semibold text-sm text-gray-600 border-b">Total Amount</th>
                            <th class="py-2 px-4 bg-gray-100 font-semibold text-sm text-gray-600 border-b">Action</th>
                        </tr>
                    </thead>
                    <tbody id="orders-tbody">
                        <!-- Orders will be populated here -->
                    </tbody>
                </table>
            </div>

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
                            <th class="py-2 px-4 bg-gray-100 font-semibold text-sm text-gray-600 border-b">Action</th>
                        </tr>
                    </thead>
                    <tbody id="subscriptions-tbody">
                        <!-- Subscriptions will be populated here -->
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

    <script>
        // Function to fetch and populate orders
        async function fetchOrders(userId) {
            const ordersTableBody = document.getElementById('orders-tbody');
            try {
                const response = await fetch(`http://localhost/Alora/api/orders/get_orders.php?user_id=${userId}`);
                const data = await response.json();

                if (data.status === 'success' && data.orders.length > 0) {
                    data.orders.forEach(order => {
                        const row = `
                            <tr>
                                <td class="py-2 px-4 border-b">${order.order_id}</td>
                                <td class="py-2 px-4 border-b">${order.order_date}</td>
                                <td class="py-2 px-4 border-b">${order.total_amount} USD</td>
                                <td class="py-2 px-4 border-b text-center">
                                    <button class="bg-red-500 text-black px-4 py-2 rounded-full" onclick="deleteOrder(${order.order_id})">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        `;
                        ordersTableBody.innerHTML += row;
                    });
                } else {
                    ordersTableBody.innerHTML = `
                        <tr>
                            <td colspan="4" class="py-2 px-4 text-center text-gray-500">No orders found</td>
                        </tr>
                    `;
                }
            } catch (error) {
                console.error('Error fetching orders:', error);
                ordersTableBody.innerHTML = `
                    <tr>
                        <td colspan="4" class="py-2 px-4 text-center text-red-500">Failed to load orders</td>
                    </tr>
                `;
            }
        }

        // Function to fetch and populate subscriptions
        async function fetchSubscriptions(userId) {
            const subscriptionsTableBody = document.getElementById('subscriptions-tbody');
            try {
                const response = await fetch(`http://localhost/Alora/api/subs/get_customerSubscription.php?user_id=${userId}`);
                const data = await response.json();

                if (data.status === 'success' && data.data.length > 0) {
                    data.data.forEach(subscription => {
                        const row = `
                            <tr>
                                <td class="py-2 px-4 border-b">${subscription.subscription_id}</td>
                                <td class="py-2 px-4 border-b">${subscription.plan_id}</td>
                                <td class="py-2 px-4 border-b">${subscription.start_date}</td>
                                <td class="py-2 px-4 border-b">${subscription.next_delivery_date}</td>
                                <td class="py-2 px-4 border-b">${subscription.status}</td>
                                <td class="py-2 px-4 border-b">${subscription.created_at}</td>
                                <td class="py-2 px-4 border-b text-center">
                                    <button class="bg-red-500 text-black px-4 py-2 rounded-lg" onclick="deleteSubscription(${userId}, ${subscription.subscription_id})">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        `;
                        subscriptionsTableBody.innerHTML += row;
                    });
                } else {
                    subscriptionsTableBody.innerHTML = `
                        <tr>
                            <td colspan="7" class="py-2 px-4 text-center text-gray-500">No subscriptions found</td>
                        </tr>
                    `;
                }
            } catch (error) {
                console.error('Error fetching subscriptions:', error);
                subscriptionsTableBody.innerHTML = `
                    <tr>
                        <td colspan="7" class="py-2 px-4 text-center text-red-500">Failed to load subscriptions</td>
                    </tr>
                `;
            }
        }

        // Function to delete an order
        async function deleteOrder(orderId) {
            const confirmDelete = confirm("Are you sure you want to delete this order?");
            if (confirmDelete) {
                try {
                    const response = await fetch(`http://localhost/Alora/api/orders/delete_order.php?order_id=${orderId}`, {
                        method: 'DELETE',
                    });
                    const data = await response.json();

                    if (data.status === 'success') {
                        alert('Order deleted successfully');
                        location.reload(); // Reload the page to update the table
                    } else {
                        alert('Failed to delete the order');
                    }
                } catch (error) {
                    console.error('Error deleting order:', error);
                    alert('An error occurred while deleting the order');
                }
            }
        }

        // Function to delete a subscription
        async function deleteSubscription(userId, subscriptionId) {
            const confirmDelete = confirm("Are you sure you want to delete this subscription?");
            if (confirmDelete) {
                try {
                    const response = await fetch(`http://localhost/Alora/api/subs/delete_customerSubscription.php?user_id=${userId}&subscription_id=${subscriptionId}`, {
                        method: 'DELETE',
                    });
                    const data = await response.json();

                    if (data.status === 'success') {
                        alert('Subscription deleted successfully');
                        location.reload(); // Reload the page to update the table
                    } else {
                        alert('Failed to delete the subscription');
                    }
                } catch (error) {
                    console.error('Error deleting subscription:', error);
                    alert('An error occurred while deleting the subscription');
                }
            }
        }

        // Initialize the page with user-specific data
        document.addEventListener('DOMContentLoaded', () => {
            const userId = <?php echo json_encode($_SESSION['user_id'] ?? null); ?>;
            if (userId) {
                fetchOrders(userId);
                fetchSubscriptions(userId);
            }
        });
    </script>
</body>

</html>
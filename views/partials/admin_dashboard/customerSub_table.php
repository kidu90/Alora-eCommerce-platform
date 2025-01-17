<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Subscriptions</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 p-6">
    <div class="overflow-x-auto">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Customer Subscriptions Table</h1>
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Subscription ID</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">User ID</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Plan ID</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Start Date</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Next Delivery Date</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Status</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Created At</th>
                </tr>
            </thead>
            <tbody id="customerSubscriptionTableBody">
                <!-- Customer subscriptions will be dynamically inserted here -->
            </tbody>
        </table>
    </div>

    <script>
        // Function to fetch all customer subscriptions
        async function fetchCustomerSubscriptions() {
            const url = 'http://localhost/Alora/api/subs/get_customerSubscription.php';

            try {
                const response = await fetch(url, {
                    method: 'GET',
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const data = await response.json();

                if (data.status === "success") {
                    populateCustomerSubscriptionTable(data.data);
                } else {
                    console.error(data.message);
                    document.getElementById('customerSubscriptionTableBody').innerHTML =
                        `<tr><td colspan="7" class="text-center text-gray-500 py-4">${data.message}</td></tr>`;
                }
            } catch (error) {
                console.error("Error fetching customer subscriptions:", error);
                document.getElementById('customerSubscriptionTableBody').innerHTML =
                    `<tr><td colspan="7" class="text-center text-red-500 py-4">Error fetching customer subscriptions. Please try again later.</td></tr>`;
            }
        }

        // Function to populate the customer subscription table
        function populateCustomerSubscriptionTable(subscriptions) {
            const tableBody = document.getElementById('customerSubscriptionTableBody');
            tableBody.innerHTML = ""; // Clear any existing rows

            subscriptions.forEach(subscription => {
                const row = document.createElement('tr');
                row.className = "border-b";

                row.innerHTML = `
                    <td class="px-4 py-2 text-gray-700">${subscription.subscription_id}</td>
                    <td class="px-4 py-2 text-gray-700">${subscription.user_id}</td>
                    <td class="px-4 py-2 text-gray-700">${subscription.plan_id}</td>
                    <td class="px-4 py-2 text-gray-700">${subscription.start_date}</td>
                    <td class="px-4 py-2 text-gray-700">${subscription.next_delivery_date}</td>
                    <td class="px-4 py-2 text-gray-700">${subscription.status}</td>
                    <td class="px-4 py-2 text-gray-700">${subscription.created_at}</td>
                `;

                tableBody.appendChild(row);
            });
        }

        // Call fetchCustomerSubscriptions when the page loads
        document.addEventListener('DOMContentLoaded', fetchCustomerSubscriptions);
    </script>
</body>

</html>
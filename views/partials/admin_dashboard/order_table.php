<body class="bg-gray-50 p-6">
    <div class="overflow-x-auto">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Orders Table</h1>
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Order ID</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">User ID</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Order Date</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Total Amount ($)</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Status</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Shipping Address</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Payment Status</th>
                </tr>
            </thead>
            <tbody id="ordersTableBody">
                <!-- Orders will be dynamically inserted here -->
            </tbody>
        </table>
    </div>

    <script>
        // Function to fetch orders and populate the table
        async function fetchOrders() {
            const url = 'http://localhost/Alora/api/orders/get_orders.php';

            try {
                const response = await fetch(url, {
                    method: 'GET',
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const data = await response.json();

                if (data.status === "success") {
                    populateOrdersTable(data.orders);
                } else {
                    console.error(data.message);
                    document.getElementById('ordersTableBody').innerHTML =
                        `<tr><td colspan="7" class="text-center text-gray-500 py-4">${data.message}</td></tr>`;
                }
            } catch (error) {
                console.error("Error fetching orders:", error);
                document.getElementById('ordersTableBody').innerHTML =
                    `<tr><td colspan="7" class="text-center text-red-500 py-4">Error fetching orders. Please try again later.</td></tr>`;
            }
        }

        // Function to populate the orders table
        function populateOrdersTable(orders) {
            const tableBody = document.getElementById('ordersTableBody');
            tableBody.innerHTML = "";

            orders.forEach(order => {
                const row = document.createElement('tr');
                row.className = "border-b";

                row.innerHTML = `
                    <td class="px-4 py-2 text-gray-700">${order.order_id}</td>
                    <td class="px-4 py-2 text-gray-700">${order.user_id}</td>
                    <td class="px-4 py-2 text-gray-700">${order.order_date}</td>
                    <td class="px-4 py-2 text-gray-700">$${order.total_amount}</td>
                    <td class="px-4 py-2 text-gray-700">${order.status}</td>
                    <td class="px-4 py-2 text-gray-700">${order.shipping_address}</td>
                    <td class="px-4 py-2 text-gray-700">${order.payment_status}</td>
                `;

                tableBody.appendChild(row);
            });
        }

        document.addEventListener('DOMContentLoaded', fetchOrders);
    </script>
</body>

</html>
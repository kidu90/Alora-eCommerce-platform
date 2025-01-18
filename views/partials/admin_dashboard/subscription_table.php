<body class="bg-gray-50 p-6">
    <div class="overflow-x-auto">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Subscription Plans Table</h1>
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Plan ID</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Name</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Description</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Price ($)</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Duration (Months)</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Custom Box</th>
                </tr>
            </thead>
            <tbody id="subscriptionTableBody">
                <!-- Subscription plans will be dynamically inserted here -->
            </tbody>
        </table>
    </div>

    <script>
        // Function to fetch subscriptions and populate the table
        async function fetchSubscriptions() {
            const url = 'http://localhost/Alora/api/subs/get_subscription.php';

            try {
                const response = await fetch(url, {
                    method: 'GET',
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const data = await response.json();

                if (data.status === "success") {
                    populateSubscriptionTable(data.data);
                } else {
                    console.error(data.message);
                    document.getElementById('subscriptionTableBody').innerHTML =
                        `<tr><td colspan="6" class="text-center text-gray-500 py-4">${data.message}</td></tr>`;
                }
            } catch (error) {
                console.error("Error fetching subscriptions:", error);
                document.getElementById('subscriptionTableBody').innerHTML =
                    `<tr><td colspan="6" class="text-center text-red-500 py-4">Error fetching subscriptions. Please try again later.</td></tr>`;
            }
        }

        // Function to populate the subscription table
        function populateSubscriptionTable(subscriptions) {
            const tableBody = document.getElementById('subscriptionTableBody');
            tableBody.innerHTML = "";

            subscriptions.forEach(subscription => {
                const row = document.createElement('tr');
                row.className = "border-b";

                row.innerHTML = `
                    <td class="px-4 py-2 text-gray-700">${subscription.plan_id}</td>
                    <td class="px-4 py-2 text-gray-700">${subscription.name}</td>
                    <td class="px-4 py-2 text-gray-700">${subscription.description}</td>
                    <td class="px-4 py-2 text-gray-700">$${subscription.price}</td>
                    <td class="px-4 py-2 text-gray-700">${subscription.duration_months}</td>
                    <td class="px-4 py-2 text-gray-700">${subscription.is_custom_box ? "Yes" : "No"}</td>
                `;

                tableBody.appendChild(row);
            });
        }

        document.addEventListener('DOMContentLoaded', fetchSubscriptions);
    </script>
</body>

</html>
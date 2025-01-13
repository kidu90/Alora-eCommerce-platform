<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alora</title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link href="https://fonts.googleapis.com/css2?family=Cardo:ital,wght@0,400;0,700;1,400&family=Ga+Maamli&family=Kanit:ital@1&family=Playfair+Display:wght@600&family=Ubuntu:wght@500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Cardo:ital,wght@0,400;0,700;1,400&family=Ga+Maamli&family=Kanit:ital@1&family=Playfair+Display:wght@600&family=Rubik:ital,wght@0,300..900;1,300..900&family=Ubuntu:wght@500&display=swap" rel="stylesheet">

    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <?php require '../views/partials/navbar.php'; ?>

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 h-screen bg-white shadow-sm">
            <div class="p-4">
                <nav class="space-y-2">
                    <button onclick="showTab('home')" class="tab-link bg-gray-100 text-gray-900 flex items-center px-4 py-2 text-sm font-medium rounded-md">
                        Home
                    </button>
                    <button onclick="showTab('manage-products')" class="tab-link text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-4 py-2 text-sm font-medium rounded-md">
                        Manage Products
                    </button>
                    <button onclick="showTab('order-history')" class="tab-link text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-4 py-2 text-sm font-medium rounded-md">
                        Order History
                    </button>
                    <button onclick="showTab('stock')" class="tab-link text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-4 py-2 text-sm font-medium rounded-md">
                        Stock
                    </button>
                    <button onclick="showTab('subscriptions')" class="tab-link text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-4 py-2 text-sm font-medium rounded-md">
                        Subscriptions
                    </button>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Home Tab -->
            <div id="home" class="tab-content">
                <h1 class="text-2xl font-semibold text-gray-900 mb-6">Home</h1>
                <p>Welcome to the Alora Dashboard!</p>
            </div>

            <!-- Manage Products Tab -->
            <div id="manage-products" class="tab-content hidden">
                <h1 class="text-2xl font-semibold text-gray-900 mb-6">Manage Products</h1>
                <p>Here you can manage your products.</p>
            </div>

            <!-- Order History Tab -->
            <div id="order-history" class="tab-content hidden">
                <h1 class="text-2xl font-semibold text-gray-900 mb-6">Order History</h1>
                <p>View order history here.</p>
            </div>

            <!-- Stock Tab -->
            <div id="stock" class="tab-content hidden">
                <h1 class="text-2xl font-semibold text-gray-900 mb-6">Stock</h1>
                <p>Manage stock details here.</p>
            </div>

            <!-- Subscriptions Tab -->
            <div id="subscriptions" class="tab-content hidden">
                <h1 class="text-2xl font-semibold text-gray-900 mb-6">Subscriptions</h1>
                <p>Manage subscriptions here.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php require '../views/partials/footer.php'; ?>

    <!-- JavaScript -->
    <script>
        function showTab(tabId) {
            // Hide all tab content
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(tab => {
                tab.classList.add('hidden');
            });

            // Remove active styles from all buttons
            const tabLinks = document.querySelectorAll('.tab-link');
            tabLinks.forEach(link => {
                link.classList.remove('bg-gray-100', 'text-gray-900');
                link.classList.add('text-gray-600');
            });

            // Show selected tab content
            document.getElementById(tabId).classList.remove('hidden');

            // Add active styles to the selected button
            event.target.classList.add('bg-gray-100', 'text-gray-900');
            event.target.classList.remove('text-gray-600');
        }
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alora</title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body class="bg-gray-50 font-sans">
    <!-- Navigation -->

    <?php require '../views/partials/admin_dashboard/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 p-8">
        <!-- Home Tab -->
        <div id="home" class="tab-content">
            <p class="text-3xl">Welcome to the Alora Dashboard!</p>
        </div>

        <!-- Manage Products Tab -->
        <div id="manage-products" class="tab-content hidden space-y-6">

            <!-- Add Product Section -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <?php require '../views/partials/admin_dashboard/add_products.php'; ?>
            </div>

            <!-- Product Table Section -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <?php require '../views/partials/admin_dashboard/products_table.php'; ?>
            </div>


            <div class="bg-white p-6 rounded-lg shadow-md">
                <?php require '../views/partials/admin_dashboard/edit_product.php'; ?>
            </div>


        </div>


        <!-- Manage Categories Tab -->
        <div id="manage-categories" class="tab-content hidden">
            <h1 class="text-2xl font-semibold text-gray-900 mb-6">Add Categories</h1>

            <!-- Add Category Form -->
            <div class="mb-8"> <!-- Add margin bottom -->
                <?php require '../views/partials/admin_dashboard/add_category.php'; ?>
            </div>

            <!-- Categories Table -->
            <div>
                <?php require '../views/partials/admin_dashboard/categories_table.php'; ?>

            </div>
        </div>

        <!-- Order History Tab -->
        <div id="order-history" class="tab-content hidden">

            <?php require '../views/partials/admin_dashboard/order_table.php'; ?>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <?php require '../views/partials/admin_dashboard/update_order.php'; ?>
            </div>


        </div>

        <!-- Stock Tab -->
        <div id="stock" class="tab-content hidden">
            <h1 class="text-2xl font-semibold text-gray-900 mb-6">Stock</h1>
            <p>Manage stock details here.</p>
        </div>

        <!-- Subscriptions Tab -->
        <div id="subscriptions" class="tab-content hidden">

            <?php require '../views/partials/admin_dashboard/subscription_table.php'; ?>

            <div class="mt-12">
                <?php require '../views/partials/admin_dashboard/customerSub_table.php'; ?>

            </div>

        </div>
    </div>

    <!-- Footer -->

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
<?php
require_once '../functions.php';

// Fetch products from the database
$products = fetchProducts(null, null)['data'];
?>

<div class="overflow-x-auto">
    <h1>Products table </h1>
    <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg ">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Product ID</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Category ID</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Name</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Description</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Price</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Stock Quantity</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Ingredients</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Usage Tips</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Image URL</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product) : ?>
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 text-sm text-gray-700 border-b"><?= htmlspecialchars($product['product_id']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700 border-b"><?= htmlspecialchars($product['category_id']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700 border-b"><?= htmlspecialchars($product['name']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700 border-b"><?= htmlspecialchars($product['description']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700 border-b">LKR <?= number_format($product['price'], 2) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700 border-b"><?= htmlspecialchars($product['stock_quantity']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700 border-b"><?= htmlspecialchars($product['ingredients']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700 border-b"><?= htmlspecialchars($product['usage_tips']) ?></td>
                    <!-- Image URL Column with truncation and limited width -->
                    <td class="px-4 py-2 text-sm text-gray-700 border-b max-w-xs truncate"><?= htmlspecialchars($product['image_url']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<style>
    /* Tailwind max-w-xs ensures the column doesn't get too wide */
    .max-w-xs {
        max-width: 200px;
        /* Adjust this value based on your preference */
    }
</style>
<?php
require_once '../functions.php';

// Fetch products from the database
$products = fetchProducts(1, 20)['data'];
?>

<div class="overflow-x-auto max-h-96">
    <h1 class="text-2xl font-semibold text-gray-900 mb-6">Products Table</h1>
    <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
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
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Image</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product) : ?>
                <tr class="hover:bg-gray-100" id="row-<?= $product['product_id'] ?>">
                    <td class="px-4 py-2 text-sm text-gray-700 border-b"><?= htmlspecialchars($product['product_id']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700 border-b"><?= htmlspecialchars($product['category_id']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700 border-b"><?= htmlspecialchars($product['name']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700 border-b"><?= htmlspecialchars($product['description']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700 border-b">LKR <?= number_format($product['price'], 2) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700 border-b"><?= htmlspecialchars($product['stock_quantity']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700 border-b"><?= htmlspecialchars($product['ingredients']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700 border-b"><?= htmlspecialchars($product['usage_tips']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700 border-b">
                        <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="Product Image" class="w-16 h-16 object-cover rounded">
                    </td>
                    <td class="px-4 py-2 text-sm text-gray-700 border-b">
                        <button class="delete-btn bg-red-500 text-white px-3 py-1 rounded"
                            data-id="<?= $product['product_id'] ?>">
                            Delete
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    // Attach click event to all delete buttons
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');

            // Show confirmation message before deleting
            const confirmDelete = confirm("Are you sure you want to delete this product?");
            if (!confirmDelete) {
                return; // Do nothing if user cancels
            }

            // Send AJAX request to delete the product
            fetch(`http://localhost/Alora/api/products/delete_product.php?id=${productId}`, {
                    method: 'DELETE',
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Remove the row from the table
                        document.getElementById(`row-${productId}`).remove();
                    } else {
                        alert(`Error: ${data.message}`);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the product.');
                });
        });
    });
</script>

<style>
    .max-h-96 {
        max-height: 400px;
        overflow-y: scroll;
    }

    img {
        max-width: 100%;
        height: auto;
    }
</style>
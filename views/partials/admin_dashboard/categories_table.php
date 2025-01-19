<?php
require_once '../functions.php';

// Fetch categories from the database
$categories = fetchCategories()['data'];

?>

<div class="overflow-x-auto">
    <h1 class="text-2xl font-semibold text-gray-900 mb-6">Categories Table</h1>
    <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Category ID</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Category Name</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Description</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category) : ?>
                <tr class="hover:bg-gray-100" id="row-<?= $category['category_id'] ?>">
                    <td class="px-4 py-2 text-sm text-gray-700 border-b"><?= htmlspecialchars($category['category_id']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700 border-b"><?= htmlspecialchars($category['name']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700 border-b"><?= htmlspecialchars($category['description']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700 border-b">
                        <button class="delete-btn bg-red-500 text-white px-3 py-1 rounded"
                            data-id="<?= $category['category_id'] ?>">
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
            const categoryId = this.getAttribute('data-id');

            // Show a confirmation alert before deletion
            const confirmDelete = confirm(`Are you sure you want to delete category with ID ${categoryId}?`);
            if (!confirmDelete) return;

            // Send AJAX request to delete the category
            fetch(`http://localhost/Alora/api/category/delete_category.php?category_id=${categoryId}`, {
                    method: 'DELETE',
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Remove the row from the table
                        document.getElementById(`row-${categoryId}`).remove();
                        alert('Category deleted successfully.');
                    } else {
                        alert(`Error: ${data.message}`);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the category.');
                });
        });
    });
</script>

<style>
    .overflow-x-auto {
        overflow-x: auto;
    }
</style>
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
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category) : ?>
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 text-sm text-gray-700 border-b"><?= htmlspecialchars($category['category_id']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700 border-b"><?= htmlspecialchars($category['name']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700 border-b"><?= htmlspecialchars($category['description']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
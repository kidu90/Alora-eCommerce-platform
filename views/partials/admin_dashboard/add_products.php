<!-- Product Creation Form -->
<?php
require_once '../functions.php';
?>


<div class="max-w-3xl mx-auto mt-10 p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
    <h2 class="text-3xl font-semibold text-center mb-8">Create Product</h2>
    <form action="" method="POST">
        <div class="mb-6">
            <label for="product_name" class="block text-sm font-medium text-gray-700">Product Name</label>
            <input type="text" id="product_name" name="product_name" required class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter product name">
        </div>
        <div class="mb-6">
            <label for="product_description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="product_description" name="product_description" required class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter product description"></textarea>
        </div>
        <div class="mb-6">
            <label for="product_price" class="block text-sm font-medium text-gray-700">Price ($)</label>
            <input type="number" id="product_price" name="product_price" required step="0.01" class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter product price">
        </div>
        <div class="mb-6">
            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
            <select id="category" name="category_id" required class="mt-2 p-3 w-full border border-gray-300 rounded-md">
                <option value="" placeholder="Enter product price"></option>
                <?php
                // Fetch categories from the database
                $categories = fetchCategories()['data'];
                foreach ($categories as $category) {
                    echo '<option value="' . htmlspecialchars($category['id']) . '">' . htmlspecialchars($category['name']) . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="mb-6">
            <label for="product_image" class="block text-sm font-medium text-gray-700">Product Image URL</label>
            <input type="url" id="product_image" name="product_image" required class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter image URL">
        </div>
        <button type="submit" class="w-full bg-blue-500 text-black py-3 rounded-md hover:bg-blue-600">Create Product</button>
    </form>
</div>
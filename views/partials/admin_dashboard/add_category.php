<!-- Category Creation Form -->
<div class="max-w-4xl mx-auto mt-10 p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
    <h2 class="text-2xl font-semibold text-center mb-6">Create Category</h2>
    <form action="create_category.php" method="POST">
        <div class="mb-6">
            <label for="category_name" class="block text-sm font-medium text-gray-700">Category Name</label>
            <input type="text" id="category_name" name="category_name" required class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter category name">
        </div>
        <div class="mb-6">
            <label for="category_description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="category_description" name="category_description" required class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter category description"></textarea>
        </div>
        <button type="submit" class="w-full bg-green-500 text-black py-2 rounded-md hover:bg-green-600">Create Category</button>
    </form>
</div>
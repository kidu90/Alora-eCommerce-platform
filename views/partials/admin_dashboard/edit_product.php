<!-- Edit Product Form -->
<div class="max-w-4xl mx-auto mt-10 p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
    <h2 class="text-2xl font-semibold text-left mb-6">Edit Product</h2>
    <form id="form" method="POST">
        <!-- Product ID (for identification) -->
        <div class="mb-6">
            <label for="product_id" class="block text-sm font-medium text-gray-700">Product ID</label>
            <input type="text" id="product_id" name="product_id" required class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter product ID">
        </div>

        <div class="mb-6">
            <label for="category_id" class="block text-sm font-medium text-gray-700">category Id</label>
            <input type="text" id="category_id" name="category_id" required class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter category_id">
        </div>

        <div class="mb-6">
            <label for="product_name" class="block text-sm font-medium text-gray-700">Product Name</label>
            <input type="text" id="product_name" name="product_name" required class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter product name">
        </div>

        <div class="mb-6">
            <label for="product_description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="product_description" name="product_description" required class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter product description"></textarea>
        </div>

        <div class="mb-6">
            <label for="product_price" class="block text-sm font-medium text-gray-700">Price</label>
            <input type="number" id="product_price" name="product_price" required class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter product price" step="0.01">
        </div>

        <div class="mb-6">
            <label for="product_ingredients" class="block text-sm font-medium text-gray-700">Ingredients</label>
            <textarea id="product_ingredients" name="product_ingredients" required class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter product ingredients"></textarea>
        </div>

        <div class="mb-6">
            <label for="product_usage_tips" class="block text-sm font-medium text-gray-700">Usage Tips</label>
            <textarea id="product_usage_tips" name="product_usage_tips" required class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter usage tips"></textarea>
        </div>

        <div class="mb-6">
            <label for="product_image" class="block text-sm font-medium text-gray-700">Product Image URL</label>
            <input type="url" id="product_image" name="product_image" required class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter product image URL">
        </div>

        <button type="submit" class="w-full bg-gray-200 text-black px-6 py-2 rounded-lg hover:bg-gray-100 mt-4 inline-block">Update Product</button>
    </form>
</div>
<script>
    // JavaScript function to edit a product
    async function editProduct(event) {
        event.preventDefault(); // Prevent default form submission behavior

        // Get form data
        const form = document.getElementById('form');
        const formData = new FormData(form);

        // Convert form data to JSON
        const productData = {
            productid: formData.get('product_id'),
            name: formData.get('product_name'),
            description: formData.get('product_description'),
            price: parseFloat(formData.get('product_price')),
            category_id: parseInt(formData.get('category_id') || 0), // Adjust this if `category_id` is not in your form
            stock_quantity: parseInt(formData.get('stock_quantity') || 0), // Add this if needed
            ingredients: formData.get('product_ingredients'),
            usage_tips: formData.get('product_usage_tips'),
            image_url: formData.get('product_image')
        };

        try {
            // Send the request to the server
            const response = await fetch('http://localhost/Alora/api/products/update_product.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(productData)
            });

            const result = await response.json();

            if (response.ok) {
                alert(result.message || "Product updated successfully!");
                form.reset(); // Optionally reset the form after a successful update
            } else {
                alert(`Error: ${result.message}`);
                console.error("Error details:", result.errors || result.message);
            }
        } catch (error) {
            console.error("An error occurred while updating the product:", error);
            alert("An unexpected error occurred. Please try again.");
        }
    }

    // Attach the function to the form submission
    document.getElementById('form').addEventListener('submit', editProduct);
</script>
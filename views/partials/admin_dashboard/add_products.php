<div class="max-w-3xl mx-auto mt-10 p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
    <h2 class="text-2xl font-semibold text-left mb-8">Add Product</h2>
    <form id="productForm" method="POST">
        <!-- Product Name -->
        <div class="mb-6">
            <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
            <input type="text" id="name" name="name" required class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter product name">
        </div>

        <!-- Product Description -->
        <div class="mb-6">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" required class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter product description"></textarea>
        </div>

        <!-- Price -->
        <div class="mb-6">
            <label for="price" class="block text-sm font-medium text-gray-700">Price ($)</label>
            <input type="number" id="price" name="price" required step="0.01" class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter product price">
        </div>

        <!-- Stock Quantity -->
        <div class="mb-6">
            <label for="stock_quantity" class="block text-sm font-medium text-gray-700">Stock Quantity</label>
            <input type="number" id="stock_quantity" name="stock_quantity" required class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter stock quantity">
        </div>

        <!-- Category -->
        <div class="mb-6">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
            <input type="number" id="category_id" name="category_id" required class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter category ID">
        </div>

        <!-- Ingredients -->
        <div class="mb-6">
            <label for="ingredients" class="block text-sm font-medium text-gray-700">Ingredients</label>
            <textarea id="ingredients" name="ingredients" required class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter product ingredients"></textarea>
        </div>

        <!-- Usage Tips -->
        <div class="mb-6">
            <label for="usage_tips" class="block text-sm font-medium text-gray-700">Usage Tips</label>
            <textarea id="usage_tips" name="usage_tips" required class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter usage tips"></textarea>
        </div>

        <!-- Product Image URL -->
        <div class="mb-6">
            <label for="image_url" class="block text-sm font-medium text-gray-700">Product Image URL</label>
            <input type="url" id="image_url" name="image_url" class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter image URL">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full bg-gray-200 text-black px-6 py-2 rounded-lg hover:bg-gray-100 mt-4 inline-block">Add Product</button>
    </form>
</div>

<script>
    const productForm = document.getElementById('productForm');
    if (productForm) {
        productForm.onsubmit = async function(e) {
            console.log('Product form submitted');

            e.preventDefault();

            const apiUrl = 'http://localhost/Alora/api/products/create_product.php';

            if (!apiUrl) {
                console.log('System is not properly configured. Please try again later.');
                return;
            }

            // Collecting form data
            const formData = new FormData(productForm);
            const productData = {
                category_id: parseInt(formData.get('category_id')),
                name: formData.get('name'),
                description: formData.get('description'),
                price: parseFloat(formData.get('price')),
                stock_quantity: parseInt(formData.get('stock_quantity')),
                ingredients: formData.get('ingredients'),
                usage_tips: formData.get('usage_tips'),
                image_url: formData.get('image_url') || null,
            };

            try {
                // Sending POST request to the server
                const response = await fetch(apiUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(productData),
                });

                const data = await response.json();

                // Check if the response was successful
                if (!response.ok) {
                    throw new Error(data.error || data.errors?.join(', ') || 'Failed to add product');
                }

                console.log('Product added successfully', data);
                alert('Product added successfully');

                productForm.reset();

                console.log('Product has been created successfully');
                alert('Product has been created successfully');
            } catch (error) {
                console.error('Error:', error);
                alert('Failed to create product. Please try again later.');
            }
        };
    }
</script>
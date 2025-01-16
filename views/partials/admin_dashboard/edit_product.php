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

        <button type="submit" class="w-full bg-gray-200 text-black px-6 py-2 rounded-full hover:bg-gray-100 mt-4 inline-block">Update Product</button>
    </form>
</div>

<script>
    document.getElementById('form').onsubmit = async function(e) {
        e.preventDefault(); // Prevent form from submitting the default way

        // Define the API URL for your POST request
        const apiUrl = 'http://localhost/Alora/api/products/update_product.php';

        // Get form data
        const formData = new FormData(this);

        // Create the product data object
        const productData = {
            product_id: formData.get('product_id'),
            name: formData.get('product_name'),
            description: formData.get('product_description'),
            price: parseFloat(formData.get('product_price')),
            ingredients: formData.get('product_ingredients'),
            usage_tips: formData.get('product_usage_tips'),
            image_url: formData.get('product_image')
        };

        console.log(productData); // Check what data is being sent

        // Validate that all fields are filled
        if (!productData.product_id || !productData.name || !productData.description || !productData.price || !productData.ingredients || !productData.usage_tips || !productData.image_url) {
            alert('Error: Please fill in all required fields.');
            return;
        }

        try {
            // Send the POST request with the product data as JSON
            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(productData)
            });

            // Parse the response data
            const data = await response.json();

            // If the response is not ok, throw an error
            if (!response.ok) {
                throw new Error(data.error || 'Failed to update product');
            }

            // Show success message
            alert('Success! Product updated successfully');
            console.log('Product updated successfully');

            // Optionally, redirect to a different page or reset the form
            // window.location.href = '/somewhere'; // or reset the form here
        } catch (error) {
            // Handle any errors that occur during the fetch
            alert(`Error: ${error.message || 'Failed to update product'}`);
            console.log('Error:', error);
        }
    };
</script>
<!-- Delete Product Form -->
<div class="max-w-4xl mx-auto mt-10 p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
    <h2 class="text-2xl font-semibold text-left mb-6">Delete Product</h2>
    <form id="deleteForm" method="POST">
        <!-- Product ID (for identification) -->
        <div class="mb-6">
            <label for="product_id" class="block text-sm font-medium text-gray-700">Product ID</label>
            <input type="text" id="product_id" name="product_id" required class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter product ID">
        </div>

        <button type="submit" class="w-full bg-gray-200 text-black px-6 py-2 rounded-lg hover:bg-gray-100 mt-4 inline-block">Delete Product</button>
    </form>
</div>

<script>
    // JavaScript function to delete a product
    async function deleteProduct(event) {
        event.preventDefault(); // Prevent default form submission behavior

        const productId = document.getElementById('product_id').value;

        if (!productId) {
            alert('Please enter a product ID.');
            return;
        }

        try {
            // Send the DELETE request to the API
            const response = await fetch(`http://localhost/Alora/api/products/delete_product.php?id=${productId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                }
            });

            const result = await response.json();

            if (response.ok) {
                alert(result.message || 'Product deleted successfully!');
                document.getElementById('deleteForm').reset();
            } else {
                alert(`Error: ${result.message}`);
                console.error('Error details:', result.message);
            }
        } catch (error) {
            console.error('An error occurred while deleting the product:', error);
            alert('An unexpected error occurred. Please try again.');
        }
    }

    document.getElementById('deleteForm').addEventListener('submit', deleteProduct);
</script>
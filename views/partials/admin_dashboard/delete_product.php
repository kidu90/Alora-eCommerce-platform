<!-- Delete Product Form -->
<div class="max-w-4xl mx-auto mt-10 p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
    <h2 class="text-2xl font-semibold text-left mb-6">Delete Product</h2>
    <form id="deleteForm" method="POST">
        <!-- Product ID (for identification) -->
        <div class="mb-6">
            <label for="product_id" class="block text-sm font-medium text-gray-700">Product ID</label>
            <input type="text" id="product_id" name="product_id" required class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter product ID">
        </div>

        <button type="submit" class="w-full bg-red-500 text-black px-6 py-2 rounded-full hover:bg-red-400 mt-4 inline-block">Delete Product</button>
    </form>
</div>

<script>
    // Delete Product Form Handler
    const deleteForm = document.querySelector('#deleteForm'); // Select the form
    if (deleteForm) {
        deleteForm.onsubmit = async function(e) {
            e.preventDefault();

            const apiUrl = 'http://localhost/Alora/api/products/delete_product.php'; // Your API URL

            if (!apiUrl) {
                alert('Error! System is not properly configured. Please try again later.');
                console.log('Error: API URL not configured');
                return;
            }

            const productId = document.querySelector('#product_id').value; // Get product ID from input
            console.log('Entered product ID:', productId); // Log the value of productId


            try {
                // Send DELETE request to delete the product
                const response = await fetch(apiUrl, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        product_id: productId
                    }), // Send product ID as JSON body
                });

                const data = await response.json();
                console.log('Response data:', data); // Log the response

                if (!response.ok) {
                    throw new Error(data.error || 'Failed to delete product');
                }

                alert('Success! Product deleted successfully.');
                console.log('Product deleted successfully');
            } catch (error) {
                alert(`Error: ${error.message || 'Failed to delete product'}`);
                console.log('Error:', error);
            }
        };
    }
</script>
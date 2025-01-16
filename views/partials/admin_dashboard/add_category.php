<!-- Category Creation Form -->
<div class="max-w-4xl mx-auto mt-10 p-8 bg-white border border-gray-200 rounded-lg shadow-lg">
    <h2 class="text-2xl font-semibold text-center mb-6">Create Category</h2>
    <form id="categoryForm" method="POST">
        <!-- Category Name -->
        <div class="mb-6">
            <label for="category_name" class="block text-sm font-medium text-gray-700">Category Name</label>
            <input type="text" id="category_name" name="category_name" required class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter category name">
        </div>

        <!-- Category Description -->
        <div class="mb-6">
            <label for="category_description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="category_description" name="category_description" required class="mt-2 p-3 w-full border border-gray-300 rounded-md" placeholder="Enter category description"></textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full bg-gray-200 text-black px-6 py-2 rounded-full hover:bg-gray-100 mt-4 inline-block">Create Category</button>
    </form>
</div>

<script>
    const categoryForm = document.getElementById('categoryForm');
    if (categoryForm) {
        categoryForm.onsubmit = async function(e) {
            console.log('Category form submitted');

            e.preventDefault(); // Prevent the default form submission

            const apiUrl = 'http://localhost/Alora/api/category/create_category.php'; // Updated API URL for category creation

            // Collecting form data
            const formData = new FormData(categoryForm);
            const categoryData = {
                name: formData.get('category_name'),
                description: formData.get('category_description')
            };

            console.log('Category data:', categoryData);

            try {
                // Sending POST request to the server
                const response = await fetch(apiUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(categoryData),
                });

                // Check if the response was successful
                if (!response.ok) {
                    const data = await response.json();
                    throw new Error(data.message || 'Failed to create category');
                }

                const data = await response.json();
                console.log('Category created successfully', data);


                // Log success message
                console.log('Category created successfully');
                alert('Category created successfully');

                // Optionally, reset the form
                categoryForm.reset();
            } catch (error) {
                // Error handling
                console.error('Error:', error);
                console.log('Failed to create category. Please try again later.');
                alert('Failed to create category. Please try again later.');
            }
        };
    }
</script>
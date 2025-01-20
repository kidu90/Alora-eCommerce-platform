<?php
include '../../dbconnection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Search</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <!-- Search Popup -->
    <div id="searchPopup" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden transition-opacity duration-300 opacity-0">
        <div class="bg-white p-10 rounded-lg w-96 shadow-lg transform scale-95 transition-all duration-300 ease-out hover:scale-100">
            <!-- Search Bar -->
            <div class="search-container mb-4">
                <input type="text" id="searchInput" placeholder="Search products by name..." class="px-4 py-3 rounded-lg border border-gray-300 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
            </div>

            <!-- Category Dropdown -->
            <div class="category-container mb-4">
                <select id="categoryDropdown" class="px-4 py-3 rounded-lg border border-gray-300 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <option value="">All Categories</option>
                    <option value="Skincare">Skincare</option>
                    <option value="Haircare">Haircare</option>
                    <option value="Lips">Lips</option>
                    <option value="Eyes">Eyes</option>
                </select>
            </div>

            <div class="mt-4 flex justify-between">
                <button id="closeSearchPopup" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Close</button>
                <button id="searchButton" class="px-6 py-2 bg-blue-500 text-black rounded-lg hover:bg-blue-600 transition">Search</button>
            </div>
        </div>
    </div>

    <!-- Display Products -->
    <div id="productResults" class="container mx-auto mt-10 grid grid-cols-3 gap-6">
        <!-- Dynamic product results will be loaded here -->
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchIcon = document.getElementById("searchIcon");
            const searchPopup = document.getElementById("searchPopup");
            const closeSearchPopup = document.getElementById("closeSearchPopup");
            const searchInput = document.getElementById("searchInput");
            const categoryDropdown = document.getElementById("categoryDropdown");
            const searchButton = document.getElementById("searchButton");
            const productResults = document.getElementById("productResults");

            // Open the search popup when search icon is clicked
            searchIcon.addEventListener("click", function(e) {
                e.preventDefault(); // Prevent the default action (if it's an anchor tag)
                searchPopup.classList.remove("hidden");
                setTimeout(() => {
                    searchPopup.classList.remove("opacity-0");
                    searchPopup.classList.add("opacity-100");
                }, 10);
            });

            // Close the search popup when the close button is clicked
            closeSearchPopup.addEventListener("click", function() {
                searchPopup.classList.remove("opacity-100");
                searchPopup.classList.add("opacity-0");
                setTimeout(() => {
                    searchPopup.classList.add("hidden");
                }, 300);
            });

            // Trigger search when search button is clicked
            searchButton.addEventListener("click", function() {
                const query = searchInput.value;
                const category = categoryDropdown.value;

                // Send an AJAX request to search_products.php
                fetch(`http://localhost/Alora/api/products/search_products.php?query=${query}&category=${category}`)
                    .then(response => response.json())
                    .then(data => {
                        // Clear the previous results
                        productResults.innerHTML = "";

                        // Check if there are products
                        if (data.length > 0) {
                            data.forEach(product => {
                                // Create the product HTML dynamically
                                const productDiv = document.createElement('div');
                                productDiv.classList.add('bg-white', 'rounded-lg', 'shadow-md', 'overflow-hidden');

                                const productImage = document.createElement('img');
                                productImage.src = product.image_url;
                                productImage.alt = product.name;
                                productImage.classList.add('w-full', 'h-48', 'object-cover');

                                const productContent = document.createElement('div');
                                productContent.classList.add('p-4');

                                const productName = document.createElement('h3');
                                productName.classList.add('font-bold', 'mb-2');
                                productName.textContent = product.name;

                                const productPrice = document.createElement('p');
                                productPrice.classList.add('text-gray-600', 'mb-4');
                                productPrice.textContent = `$${product.price.toFixed(2)}`;

                                const viewDetailsLink = document.createElement('a');
                                viewDetailsLink.classList.add('bg-gray-200', 'text-black', 'px-6', 'py-2', 'rounded-lg', 'hover:bg-gray-100', 'mt-4', 'inline-block');
                                viewDetailsLink.href = `index.php?route=single_product&id=${product.product_id}`;
                                viewDetailsLink.textContent = 'View Details';

                                productContent.appendChild(productName);
                                productContent.appendChild(productPrice);
                                productContent.appendChild(viewDetailsLink);

                                productDiv.appendChild(productImage);
                                productDiv.appendChild(productContent);

                                // Append product to results
                                productResults.appendChild(productDiv);
                            });
                        } else {
                            productResults.innerHTML = "<p>No products found for your search.</p>";
                        }
                    })
                    .catch(error => console.error('Error fetching data:', error));
            });
        });
    </script>
</body>

</html>
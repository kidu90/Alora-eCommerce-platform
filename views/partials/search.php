<a href="" id="searchIcon" class="hover:text-gray-600">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
    </svg>
</a>

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
                <option value="Cosmetics">Lips</option>
                <option value="Cosmetics">Eyes</option>
                <!-- Add more categories here as needed -->
            </select>
        </div>

        <div class="mt-4 flex justify-between">
            <button id="closeSearchPopup" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Close</button>
            <button id="searchButton" class="px-6 py-2 bg-blue-500 text-black rounded-lg hover:bg-blue-600 transition">Search</button>
        </div>
    </div>
</div>

<!-- Your existing search icon and popup code remains unchanged -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchIcon = document.getElementById("searchIcon");
        const searchPopup = document.getElementById("searchPopup");
        const closeSearchPopup = document.getElementById("closeSearchPopup");
        const searchInput = document.getElementById("searchInput");
        const categoryDropdown = document.getElementById("categoryDropdown");
        const searchButton = document.getElementById("searchButton");

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

        // Search functionality
        searchButton.addEventListener("click", function() {
            const searchQuery = searchInput.value.trim();
            const selectedCategory = categoryDropdown.value;
            // Call the search function
            fetchAndRenderProducts(searchQuery, selectedCategory); // Ensure this function exists
            searchPopup.classList.remove("opacity-100");
            searchPopup.classList.add("opacity-0");
            setTimeout(() => {
                searchPopup.classList.add("hidden");
            }, 300); // Close the popup after search
        });
    });

    // Fetch and render products function
    function fetchAndRenderProducts(searchQuery, category) {
        const searchURL = `http://localhost/Alora/api/products/search_products.php?query=${encodeURIComponent(searchQuery)}&category=${encodeURIComponent(category)}`;

        fetch(searchURL)
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    alert("No products found!");
                    return;
                }

                renderProducts(data);
            })
            .catch(error => {
                console.error("Error fetching products:", error);
            });
    }

    // Render products to the page
    function renderProducts(products) {
        const productContainer = document.getElementById("productContainer");
        productContainer.innerHTML = ""; // Clear existing content

        products.forEach(product => {
            const productElement = document.createElement("div");
            productElement.classList.add("bg-white", "rounded-lg", "shadow-md", "overflow-hidden");

            productElement.innerHTML = `
            <img src="${product.image}" alt="${product.name}" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="font-bold mb-2">${name}</h3>
                <div class="flex items-center mb-2">
                    <img src="assets/images/star.svg" alt="Star Icon" class="h-5 w-5">
                    <img src="assets/images/star.svg" alt="Star Icon" class="h-5 w-5">
                    <img src="assets/images/star.svg" alt="Star Icon" class="h-5 w-5">
                    <img src="assets/images/star.svg" alt="Star Icon" class="h-5 w-5">
                </div>
                <p class="text-gray-600 mb-4">${product.price}</p> <!-- Added margin-bottom to give space -->
                <a href="index.php?route=single_product&id=${product.id}" class="bg-gray-200 text-black px-6 py-2 rounded-lg hover:bg-gray-100 mt-4 inline-block">
                    View Details
                </a>
            </div>
        `;

            productContainer.appendChild(productElement);
        });
    }
</script>
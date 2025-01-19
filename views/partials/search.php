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
    });
</script>
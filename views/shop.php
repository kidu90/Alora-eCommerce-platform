<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require 'views/partials/header.php'
    ?>
</head>

<body class="font-sans bg-white">
    <?php
    require 'views/partials/navbar.php'
    ?>

    <!-- Hero Banner -->
    <div class="relative w-full h-[400px] mb-12">
        <img src="assets/images/sub.avif" alt="Shop Banner" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-30 flex text-left"></div>
    </div>

    <!-- Filter Section -->
    <div class="container mx-auto px-4 mb-8">
        <div class="flex justify-end gap-4">
            <select id="filter" class="bg-gray-200 px-4 py-2 rounded">
                <option value="">Filter</option>
                <option value="price-low-high">Price: Low to High</option>
                <option value="price-high-low">Price: High to Low</option>
                <option value="newest">Newest</option>
            </select>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="container mx-auto px-4 mb-16">
        <h2 class="text-3xl sm:text-xl font-bold mb-6 sm:mb-8 text-center sm:text-left">Our Products</h2>
        <div id="productsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php
            require_once 'functions.php';

            $products = fetchProducts(1, 12)['data'];
            foreach ($products as $item) {
                $id = $item['product_id'];
                $image = $item['image_url'];
                $alt = $item['name'];
                $text = $item['name'];
                $price = $item['price'];
                $category_name = $item['category_name'];
                $stock_qty = $item['stock_quantity'];
                $description = $item['description'];

                require 'views/partials/product_card.php';
            }
            ?>
        </div>
    </div>

    <?php
    require 'views/partials/footer.php'
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const filterDropdown = document.getElementById("filter");
            const productsGrid = document.getElementById("productsGrid");

            // Fetch products and render
            function fetchAndRenderProducts(filter = "") {
                productsGrid.innerHTML = "<p>Loading products...</p>";

                // Fetch products from the API
                fetch(`http://localhost/Alora/api/products/filter_products.php?filter=${filter}`)
                    .then(response => response.json())
                    .then(products => {
                        productsGrid.innerHTML = "";

                        // Render each product
                        products.forEach(product => {
                            const {
                                product_id,
                                image_url,
                                name,
                                price,
                                category_name,
                                stock_quantity,
                                description
                            } = product;

                            // Generate the URL for the product details page
                            const productDetailUrl = `index.php?route=single_product&id=${product_id}`;

                            const productCard = `
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <img src="${image_url}" alt="${name}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold mb-2">${name}</h3>
                                <div class="flex items-center mb-2">
                                    <img src="assets/images/star.svg" alt="Star Icon" class="h-5 w-5">
                                    <img src="assets/images/star.svg" alt="Star Icon" class="h-5 w-5">
                                    <img src="assets/images/star.svg" alt="Star Icon" class="h-5 w-5">
                                    <img src="assets/images/star.svg" alt="Star Icon" class="h-5 w-5">
                                </div>
                                <p class="text-gray-600 mb-4">$${price}</p>
                                <a href="${productDetailUrl}" class="bg-gray-200 text-black px-6 py-2 rounded-lg hover:bg-gray-100 mt-4 inline-block">
                                    View Details
                                </a>
                            </div>
                        </div>
                    `;

                            // Append the product card to the grid
                            productsGrid.innerHTML += productCard;
                        });

                        if (products.length === 0) {
                            productsGrid.innerHTML = "<p>No products found.</p>";
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching products:", error);
                        productsGrid.innerHTML = "<p>Failed to load products. Please try again later.</p>";
                    });
            }

            fetchAndRenderProducts();

            filterDropdown.addEventListener("change", function() {
                const selectedFilter = filterDropdown.value;
                fetchAndRenderProducts(selectedFilter);
            });
        });
    </script>

</body>

</html>
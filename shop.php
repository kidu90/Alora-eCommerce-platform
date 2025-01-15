<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require 'views/partials/header.php'
    ?>

<body class="font-sans bg-white">
    <?php
    require 'views/partials/navbar.php'
    ?>

    <!-- Hero Banner -->
    <div class="relative w-full h-[400px] mb-12">
        <img src="assets/images/shop.avif" alt="Shop Banner" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-30 flex text-left">

        </div>
    </div>

    <!-- filter section -->
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
        <h2 class="text-3xl  sm:text-xl font-bold mb-6 sm:mb-8 text-center sm:text-left">Our Products</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">


            <?php
            require_once 'functions.php';

            $products = fetchProducts(1, 20)['data'];
            // print_r($products);

            foreach ($products as $item) {
                //print_r($item);
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


</body>

</html>
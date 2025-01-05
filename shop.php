<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alora - Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Cardo:ital,wght@0,400;0,700;1,400&family=Aclonica&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="font-sans bg-primary">
    <?php
    require 'views/partials/navbar.php'
    ?>

    <!-- Hero Banner -->
    <div class="relative w-full h-[400px] mb-12">
        <img src="images/shop1.avif" alt="Shop Banner" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-30 flex text-left">
            <h2 class="text-3xl  sm:text-2xl font-bold mb-6 sm:mb-8 text-center sm:text-left">Our Products</h2>

        </div>
    </div>

    <!-- Filter Section -->
    <div class="container mx-auto px-4 mb-8">
        <div class="flex justify-end gap-4">
            <select class="bg-white px-4 py-2 rounded">
                <option>Filter</option>
                <option>Price: Low to High</option>
                <option>Price: High to Low</option>
                <option>Newest</option>
            </select>
            <select class="bg-white px-4 py-2 rounded">
                <option>Sort by</option>
                <option>Popularity</option>
                <option>Rating</option>
                <option>Featured</option>
            </select>
        </div>
    </div>


    <!-- Products Grid -->
    <div class="container mx-auto px-4 mb-16">
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
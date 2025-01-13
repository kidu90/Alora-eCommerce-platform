<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require 'views/partials/header.php'
    ?>


<body class="font-sans">

    <!-- Navigation -->
    <?php
    require 'views/partials/navbar.php'
    ?>

    <!-- Hero Section -->
    <section class="bg-gray-100 rounded-3xl mx-4 my-8 overflow-hidden">
        <div class="container mx-auto px-4 py-16 flex items-center">
            <div class="w-1/2">
                <h2 class="text-4xl font-bold mb-4">Let Your</h2>
                <h1 class="text-6xl font-bold mb-4">SKIN GLOW</h1>
                <p class="text-xl mb-8">With Alora</p>
            </div>
            <div class="w-1/2">
                <img src="assets/images/new.avif" alt="Woman in white dress" class="w-full h-auto rounded-lg">
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="container mx-auto px-4 ml-9 mb-40 mt-56">
        <h2 class="text-4xl sm:text-5xl font-bold mb-6 sm:mb-8 text-center sm:text-left">About Us</h2>
        <div class="flex flex-col sm:flex-row space-y-6 sm:space-y-0 sm:space-x-8">
            <div class="w-full sm:w-1/2">
                <p class="mb-4 ">
                    Welcome to Aurora, where beauty meets brilliance. Our passion is to empower you with the confidence to show your best self—with innovative cosmetics that celebrate your unique beauty. At Aurora, we believe that makeup is more than just a product—it's an experience, an art form, and a means of self-expression.
                </p>
                <p>
                    Founded with a vision to revolutionize the cosmetic industry, Aurora was born from a desire to offer luxurious, wearable beauty solutions. We are committed to using the finest ingredients and the latest technology to develop cosmetics that not only enhance your natural beauty but also care for your skin.
                </p>
            </div>
            <div class="w-1/2 grid grid-cols-2 gap-4">
                <img src="assets/images/about.png" alt="Makeup product" class="w-full h-48 object-cover rounded-lg">
                <img src="assets/images/about2.png" alt="Makeup application" class="w-full h-48 object-cover rounded-lg">
            </div>
        </div>
    </section>


    <!-- Shop Section -->
    <section class="bg-gray-100  py-20">
        <div class="container mx-auto px-6 py-12">
            <h2 class="text-5xl font-bold mb-20 text-center">SHOP BY CATEGORY</h2>
            <div class="grid grid-cols-3 gap-5">
                <?php
                $categories = [
                    [
                        'name' => 'Lips',
                        'url' => '#lips',
                        'image_url' => 'assets/images/lips-category.png'
                    ],
                    [
                        'name' => 'Eyes',
                        'url' => '#eyes',
                        'image_url' => 'assets/images/eyes-category.png'
                    ],
                    [
                        'name' => 'Face',
                        'url' => '#face',
                        'image_url' => 'assets/images/skin-category.png'
                    ]
                ];

                foreach ($categories as $item) {
                    $text = $item['name'];
                    $image = $item['image_url'];
                    $link = $item['url'];
                    require 'views/partials/category_card.php';
                }
                ?>
            </div>

    </section>

    <!-- product Section -->

    <section class=" py-16 my-16">
        <div class="container mx-auto px-4 flex md:flex-row flex-col items-center">
            <div class="md:w-1/3">
                <img src="assets/images/image 30.png" alt="Nude Lipstick" class="w-full h-auto rounded-3xl">
            </div>
            <div class="md:w-2/3 md:pl-8 md:mt-0 mt-8">
                <h2 class="text-4xl font-bold mb-4">Enhance Your Beauty with Aurora's New "Nude" Lipstick</h2>
                <p class="mb-4">Introducing "Nude" by Aurora – the latest addition to your makeup collection that promises to redefine elegance. This new lipstick shade is designed to complement and enhance your natural lip color, creating a timeless look that's perfect for any occasion.</p>
                <p class="mb-8">"Nude" offers a smooth, creamy texture that ensures long-lasting wear without drying your lips. Infused with nourishing ingredients, it keeps your lips soft and supple throughout the day. Elevate your everyday look or add a touch of subtle beauty with Aurora's "Nude" lipstick.</p>
                <div class="flex space-x-4">
                    <a href="index.php?route=shop">
                        <button class="bg-gray-200 text-black px-6 py-2 rounded-full hover:bg-gray-100">Shop Now</button>
                    </a>
                    <button class="border border-gray-300 px-6 py-2 rounded-full hover:bg-gray-100">Explore</button>
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-bold mb-8">Latest Arrivals</h2>
        <div class="grid sm:grid-col-2 md:grid-cols-4  gap-8">

            <?php
            require_once 'functions.php';

            $products = fetchProducts(1, 4)['data'];
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
    </section>

    <!-- Footer Section -->
    <?php
    require 'views/partials/footer.php'
    ?>

</body>

</html>
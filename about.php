<!DOCTYPE html>
<html lang="en">
<!-- Head section remains the same -->


<?php
require 'views/partials/header.php'
?>

<body class="bg-gray-100 inter">
    <!-- Navigation -->
    <?php
    require 'views/partials/navbar.php'
    ?>

    <section class="relative">
        <div class="relative">
            <!-- Darkened Image -->
            <img src="assets/images/about.avif" alt="About Us" class="w-full h-[400px] object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>


            <!-- Text Overlay -->
            <div class="absolute inset-0 flex flex-col justify-center items-center text-center text-white px-4">
                <h2 class="text-4xl font-bold mb-4">Our Story</h2>
                <p class="mb-4 max-w-3xl">
                    Welcome to Alora, where beauty meets brilliance. Our passion is to empower you with the confidence to show your best self—with innovative cosmetics that celebrate your unique beauty.
                </p>
                <p class="max-w-3xl">
                    Founded with a vision to revolutionize the cosmetic industry, Alora was born from a desire to offer luxurious, wearable beauty solutions. We are committed to using the finest ingredients and the latest technology to develop cosmetics that not only enhance your natural beauty but also care for your skin.
                </p>
            </div>
        </div>
    </section>


    <!-- Beauty Categories with updated images -->
    <section class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-2 gap-8">
            <div class="relative rounded-lg overflow-hidden h-[500px]">
                <img src="https://images.unsplash.com/photo-1552693673-1bf958298935" alt="Glow Naturally" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/20 flex items-end p-8">
                    <h3 class="playfair text-white text-3xl font-semibold">Glow Naturally</h3>
                </div>
            </div>
            <div class="relative rounded-lg overflow-hidden h-[500px]">
                <img src="https://images.unsplash.com/photo-1487412947147-5cebf100ffc2" alt="Express Your Beauty" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/20 flex items-end p-8">
                    <h3 class="playfair text-white text-3xl font-semibold">Express Your Beauty</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team Section with updated image -->
    <section class="bg-white py-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-24 items-center max-w-6xl mx-auto">
                <div class="rounded-lg overflow-hidden">
                    <img src="assets/images/new.avif" alt="Our Team" class="w-full h-[300px] object-cover">
                </div>
                <div class="space-y-6 px-6">
                    <h2 class="playfair text-3xl font-semibold">Our Team</h2>
                    <div class="space-y-4 text-gray-700">
                        <p>At Alora, we are more than just a team—we're a family of passionate individuals dedicated to redefining beauty and wellness. Each member of our team brings unique expertise, ensuring that every product and service we offer meets the highest standards.</p>
                        <p>From our dedicated specialists to our creative brand strategists and select premium items from designers who craft a seamless and user-friendly platform, every detail at Alora is shaped by the hands and minds of people who genuinely care about your journey to self-care and beauty.</p>
                    </div>
                    <button class="bg-gray-200 text-black px-8 py-3 rounded-full hover:bg-gray-100 transition-colors">
                        Contact Us
                    </button>
                </div>
            </div>
        </div>
    </section>



    <!-- Footer remains the same -->
    <?php
    require 'views/partials/footer.php'
    ?>
</body>

</html>
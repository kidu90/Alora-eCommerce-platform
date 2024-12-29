<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alora</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cardo:ital,wght@0,400;0,700;1,400&family=Ga+Maamli&family=Kanit:ital@1&family=Playfair+Display:wght@600&family=Ubuntu:wght@500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Cardo:ital,wght@0,400;0,700;1,400&family=Ga+Maamli&family=Kanit:ital@1&family=Playfair+Display:wght@600&family=Rubik:ital,wght@0,300..900;1,300..900&family=Ubuntu:wght@500&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Cardo', 'sans-serif'],
                        secondary: ['Aclonica']
                    },
                    colors: {
                        'primary': '#BFBFBF',
                        'black': '#000000',
                    }
                }
            }
        }
    </script>
</head>

<body class="font-sans  bg-primary">
    <!-- Navigation -->
    <nav>
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0">
                    <a href="#" class="text-black text-2xl font-bold font-secondary">Aurora</a>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-center space-x-8">
                        <a href="#" class="text-black hover:text-gray-200">About</a>
                        <a href="#" class="text-black hover:text-gray-200">Shop</a>
                        <a href="#" class="text-black hover:text-gray-200">Contact</a>
                        <a href="#" class="text-black hover:text-gray-200">Subscription</a>

                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Account Icon -->
                    <a href="#" class="text-black">
                        <span class="sr-only">Account</span>
                        <img src="images/person.svg" alt="Account" class="h-6 w-6">
                    </a>

                    <!-- Cart Icon -->
                    <a href="#">
                        <span class="sr-only">Cart</span>
                        <img src="images/cart-3-svgrepo-com.svg" alt="Cart" class="h-6 w-6">
                    </a>

                    <!-- Search Icon -->
                    <a href="#">
                        <span class="sr-only">Search</span>
                        <img src="images/search-svgrepo-com.svg" alt="Search" class="h-6 w-6">
                    </a>


                </div>
            </div>
        </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative h-screen">
        <div class="w-[97%] mx-auto flex items-center justify-center">
            <img src="images/image.png" alt="Image description" class="w-full h-auto overflow-hidden object-contain">
            <div class="absolute inset-x-0 bottom-10 left-10 flex flex-col justify-center items-start text-Black">
                <h1 class="text-3xl font-thin ml-9 mb-2">Let Your</h1>
                <h2 class="text-6xl font-bold mb-5 ml-9">SKIN GLOW</h2>
                <p class="text-3xl font-thin ml-9">With AURORA</p>
            </div>

        </div>
    </section>

    <!-- About Section -->
    <section class="container mx-auto px-4 px-4 ml-9 mb-40 mt-56">
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
                <img src="images/about.png" alt="Makeup product" class="w-full h-48 object-cover rounded-lg">
                <img src="images/about2.png" alt="Makeup application" class="w-full h-48 object-cover rounded-lg">
            </div>
        </div>
    </section>


    <!-- Shop Section -->
    <section class="bg-white py-20">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-5xl font-bold mb-20 text-center">SHOP BY CATEGORY</h2>
            <div class="grid grid-cols-3 gap-6">
                <!-- Lips Category -->
                <a href="">
                    <div class="relative rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-200">
                        <img src="images/image 23.png" alt="Lips" class="w-96 md: h-full object-cover rounded-3xl transform transition-transform duration-200 hover:scale-110">
                        <div class="absolute bottom-0 left-0 right-0 text-white p-4">
                            <h3 class="text-2xl font-bold">Lips</h3>
                        </div>
                    </div>
                </a>

                <!-- Eyes Category -->
                <a href="">
                    <div class="relative rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-200">
                        <img src="images/eye.png" alt="Eyes" class="w-96 h-full object-cover rounded-3xl transform transition-transform duration-200 hover:scale-110">
                        <div class="absolute bottom-0 left-0 right-0 text-white p-4">
                            <h3 class="text-2xl font-bold">Eyes</h3>
                        </div>
                    </div>
                </a>

                <!-- Skin Category -->
                <a href="">
                    <div class="relative rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-200">
                        <img src="images/skin.png" alt="Skin" class="w-96 h-full object-cover rounded-3xl transform transition-transform duration-200 hover:scale-110">
                        <div class="absolute bottom-0 left-0 right-0 text-white p-4">
                            <h3 class="text-2xl font-bold">Skin</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- product Section -->

    <section class=" py-16 my-16">
        <div class="container mx-auto px-4 flex items-center">
            <div class="w-1/3">
                <img src="images/image 30.png" alt="Nude Lipstick" class="w-full h-auto rounded-3xl">
            </div>
            <div class="w-2/3 pl-8">
                <h2 class="text-4xl font-bold mb-4">Enhance Your Beauty with Aurora's New "Nude" Lipstick</h2>
                <p class="mb-4">Introducing "Nude" by Aurora – the latest addition to your makeup collection that promises to redefine elegance. This new lipstick shade is designed to complement and enhance your natural lip color, creating a timeless look that's perfect for any occasion.</p>
                <p class="mb-8">"Nude" offers a smooth, creamy texture that ensures long-lasting wear without drying your lips. Infused with nourishing ingredients, it keeps your lips soft and supple throughout the day. Elevate your everyday look or add a touch of subtle beauty with Aurora's "Nude" lipstick.</p>
                <div class="flex space-x-4">
                    <button class="bg-white text-black px-6 py-2 rounded-full hover:bg-gray-100">Shop Now</button>
                    <button class="border border-white px-6 py-2 rounded-full hover:bg-gray-100">Explore</button>
                </div>
            </div>
        </div>
    </section>






</body>

</html>
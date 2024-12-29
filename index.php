<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aurora</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cardo:ital,wght@0,400;0,700;1,400&family=Ga+Maamli&family=Kanit:ital@1&family=Playfair+Display:wght@600&family=Ubuntu:wght@500&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Cardo', 'sans-serif'],
                    },
                    backgroundcolor: {
                        'gray_2': '#BFBFBF',
                    }
                }
            }
        }
    </script>
</head>

<body class="font-sans  bg-gray_2">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-40  bg-gray-200 bg-opacity-20 backdrop-blur-sm">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0">
                    <a href="#" class="text-white text-2xl font-serif">Aurora</a>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-center space-x-8">
                        <a href="#" class="text-white hover:text-gray-200">Home</a>
                        <a href="#" class="text-white hover:text-gray-200">About</a>
                        <a href="#" class="text-white hover:text-gray-200">Shop</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Account Icon -->
                    <a href="#" class="text-white hover:text-gray-200">
                        <span class="sr-only">Account</span>
                        <img src="images/profile.svg" alt="Account" class="h-6 w-6">
                    </a>

                    <!-- Cart Icon -->
                    <a href="#" class="text-white hover:text-gray-200">
                        <span class="sr-only">Cart</span>
                        <img src="images/cart.svg" alt="Cart" class="h-6 w-6">
                    </a>

                    <!-- Search Icon -->
                    <a href="#" class="text-white hover:text-gray-200">
                        <span class="sr-only">Search</span>
                        <img src="images/search.svg" alt="Search" class="h-6 w-6">
                    </a>

                </div>
            </div>
        </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative h-screen">
        <img src="images/heroImage.webp" alt="Beauty close-up" class="object-cover w-full h-full">
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 to-black/60"></div>
        <div class="absolute inset-x-0 bottom-10 left-10 flex flex-col justify-center items-start text-white">
            <h1 class="text-3xl font-light ml-2">Let Your</h1>
            <h2 class="text-8xl font-serif mb-2 ml-2">SKIN GLOW</h2>
            <p class="text-3xl font-light ml-2">With AURORA</p>
        </div>
    </section>




</body>

</html>
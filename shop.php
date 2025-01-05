<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alora - Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cardo:ital,wght@0,400;0,700;1,400&family=Aclonica&display=swap" rel="stylesheet">
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

<body class="font-sans bg-primary">
    <!-- Navigation -->
    <nav>
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0">
                    <a href="#" class="text-black text-2xl font-bold font-secondary">Alora</a>
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
                    <a href="#" class="text-black">
                        <span class="sr-only">Account</span>
                        <img src="images/person.svg" alt="Account" class="h-6 w-6">
                    </a>
                    <a href="#">
                        <span class="sr-only">Cart</span>
                        <img src="images/cart-3-svgrepo-com.svg" alt="Cart" class="h-6 w-6">
                    </a>
                    <a href="#">
                        <span class="sr-only">Search</span>
                        <img src="images/search-svgrepo-com.svg" alt="Search" class="h-6 w-6">
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Banner -->
    <div class="relative w-full h-[400px] mb-12">
        <img src="/placeholder.svg" alt="Shop Banner" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
            <h1 class="text-white text-5xl font-bold">Our Products</h1>
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
            <!-- Product Card 1 -->
            <div class="bg-white rounded-lg overflow-hidden">
                <img src="/placeholder.svg" alt="Nude Red lipstick" class="w-full h-64 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-bold">Nude Red lipstick</h3>
                    <div class="flex items-center mb-2">
                        <span class="text-black">★★★★★</span>
                    </div>
                    <p class="text-black font-bold">Rs. 3000</p>
                </div>
            </div>

            <!-- Product Card 2 -->
            <div class="bg-white rounded-lg overflow-hidden">
                <img src="/placeholder.svg" alt="Nude Red lipstick" class="w-full h-64 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-bold">Nude Red lipstick</h3>
                    <div class="flex items-center mb-2">
                        <span class="text-black">★★★★★</span>
                    </div>
                    <p class="text-black font-bold">Rs. 3000</p>
                </div>
            </div>

            <!-- Product Card 3 -->
            <div class="bg-white rounded-lg overflow-hidden">
                <img src="/placeholder.svg" alt="Nude Red lipstick" class="w-full h-64 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-bold">Nude Red lipstick</h3>
                    <div class="flex items-center mb-2">
                        <span class="text-black">★★★★★</span>
                    </div>
                    <p class="text-black font-bold">Rs. 3000</p>
                </div>
            </div>

            <!-- Product Card 4 -->
            <div class="bg-white rounded-lg overflow-hidden">
                <img src="/placeholder.svg" alt="Nude Red lipstick" class="w-full h-64 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-bold">Nude Red lipstick</h3>
                    <div class="flex items-center mb-2">
                        <span class="text-black">★★★★★</span>
                    </div>
                    <p class="text-black font-bold">Rs. 3000</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white text-black py-8">
        <div class="container mx-auto px-8 py-12">
            <div class="flex flex-wrap justify-between">
                <div class="w-full md:w-1/4 mb-4 md:mb-0">
                    <h2 class="text-3xl font-bold font-secondary mb-4">Alora</h2>
                    <div class="flex space-x-4">
                        <a href="#" class="hover:text-gray-300">
                            <img src="images/facebook.svg" alt="Facebook Icon" class="h-5 w-5">
                        </a>
                        <a href="#" class="hover:text-gray-300">
                            <img src="images/instagram.svg" alt="Instagram Icon" class="h-5 w-5">
                        </a>
                        <a href="#" class="hover:text-gray-300">
                            <img src="images/twitter.svg" alt="Twitter Icon" class="h-5 w-5">
                        </a>
                    </div>
                </div>
                <div class="w-full md:w-1/4 mb-4 md:mb-0">
                    <h3 class="text-lg font-semibold mb-2">Company</h3>
                    <ul>
                        <li><a href="#" class="hover:text-gray-300">Shop</a></li>
                        <li><a href="#" class="hover:text-gray-300">About us</a></li>
                        <li><a href="#" class="hover:text-gray-300">Privacy and Policy</a></li>
                    </ul>
                </div>
                <div class="w-full md:w-1/4 mb-4 md:mb-0">
                    <h3 class="text-lg font-semibold mb-2">Information</h3>
                    <ul>
                        <li><a href="#" class="hover:text-gray-300">Home</a></li>
                        <li><a href="#" class="hover:text-gray-300">FAQ</a></li>
                        <li><a href="#" class="hover:text-gray-300">Contact</a></li>
                    </ul>
                </div>
                <div class="w-full md:w-1/4 mb-4 md:mb-0">
                    <h3 class="text-lg font-semibold mb-2">Information</h3>
                    <ul>
                        <li><a href="#" class="hover:text-gray-300">Home</a></li>
                        <li><a href="#" class="hover:text-gray-300">FAQ</a></li>
                        <li><a href="#" class="hover:text-gray-300">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-300 mt-8 pt-8 text-sm text-center">
                <p>&copy; 2025 Alora. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>
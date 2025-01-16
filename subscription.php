<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscriptions - Aurora Beauty</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>

<body class="bg-gray-50 font-sans">
    <!-- Navigation -->
    <?php require 'views/partials/navbar.php'; ?>
    <!-- Hero Section -->
    <section class="bg-gray-100 rounded-3xl mx-4 my-8 overflow-hidden">
        <div class="container mx-auto px-4 py-16 flex items-center md:flex-row flex-col">
            <div class="md:w-1/2">
                <h2 class="text-4xl md:text-3xl font-bold mb-4">Subscribe to</h2>
                <h1 class="text-6xl font-bold mb-4">BEAUTY BOX</h1>
                <p class="text-xl mb-8">Get monthly curated beauty products</p>
            </div>
            <div class="md:w-1/2">
                <img src="assets/images/subs2.avif" alt="Beauty subscription box" class="w-full h-auto rounded-lg">
            </div>
        </div>
    </section>

    <!-- Subscription Plans -->
    <section class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-bold text-center mb-12">Choose Your Plan</h2>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Basic Plan -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-8">
                    <h3 class="text-2xl font-bold mb-4">Basic Beauty</h3>
                    <div class="text-4xl font-bold mb-4">
                        Rs. 999<span class="text-lg font-normal text-gray-600">/month</span>
                    </div>
                    <p class="text-gray-600 mb-6">Perfect for beauty beginners</p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            4 Beauty Products Monthly
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Free Shipping
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Monthly Beauty Guide
                        </li>
                    </ul>
                    <button class="w-full bg-gray-200 text-black px-6 py-2 rounded-lg hover:bg-gray-100 transition duration-300">
                        Subscribe Now
                    </button>
                </div>
            </div>

            <!-- Premium Plan -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border-2 border-black relative">
                <div class="absolute top-0 right-0 bg-black text-white px-4 py-1 rounded-bl-lg">
                    Popular
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold mb-4">Premium Beauty</h3>
                    <div class="text-4xl font-bold mb-4">
                        Rs. 1999<span class="text-lg font-normal text-gray-600">/month</span>
                    </div>
                    <p class="text-gray-600 mb-6">For the beauty enthusiast</p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            6 Premium Beauty Products
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Express Shipping
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Exclusive Beauty Guide
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Early Access to Sales
                        </li>
                    </ul>
                    <button class="w-full bg-gray-200 text-black px-6 py-2 rounded-lg hover:bg-gray-100 transition duration-300">
                        Subscribe Now
                    </button>
                </div>
            </div>

            <!-- Luxury Plan -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-8">
                    <h3 class="text-2xl font-bold mb-4">Luxury Beauty</h3>
                    <div class="text-4xl font-bold mb-4">
                        Rs. 2999<span class="text-lg font-normal text-gray-600">/month</span>
                    </div>
                    <p class="text-gray-600 mb-6">The ultimate beauty experience</p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            8 Luxury Beauty Products
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Priority Shipping
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Personal Beauty Consultant
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            VIP Event Access
                        </li>
                    </ul>
                    <button class="w-full bg-gray-200 text-black px-6 py-2 rounded-lg hover:bg-gray-100 transition duration-300">
                        Subscribe Now
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-gray-100 py-20 mb-24">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold mb-12 text-center">Why Choose Our Beauty Box?</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Curated Selection</h3>
                    <p class="text-gray-600">Hand-picked products by beauty experts</p>
                </div>
                <div class="text-center">
                    <div class="bg-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Monthly Delivery</h3>
                    <p class="text-gray-600">Regular delivery to your doorstep</p>
                </div>
                <div class="text-center">
                    <div class="bg-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Great Value</h3>
                    <p class="text-gray-600">Products worth more than subscription cost</p>
                </div>
            </div>
        </div>
    </section>
    <?php require 'views/partials/footer.php'; ?>
</body>

</html>
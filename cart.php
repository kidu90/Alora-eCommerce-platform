<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Aurora Beauty</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <?php require 'views/partials/navbar.php'; ?>

    <main class="container mx-auto px-4 py-8 mt-14 mb-32">
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Shopping Cart Section -->
            <div class="md:col-span-2">
                <h1 class="text-3xl font-bold mb-8">Shopping cart</h1>

                <div class="bg-white rounded-lg shadow-sm">
                    <!-- Cart Header -->
                    <div class="grid grid-cols-12 gap-4 p-4 border-b text-sm text-gray-500">
                        <div class="col-span-6">Product details</div>
                        <div class="col-span-2 text-center">Quantity</div>
                        <div class="col-span-2 text-center">Price</div>
                        <div class="col-span-2 text-center">Total</div>
                    </div>

                    <!-- Cart Items -->
                    <div class="divide-y">
                        <!-- Cart Item 1 -->
                        <div class="grid grid-cols-12 gap-4 p-4 items-center">
                            <div class="col-span-6 flex gap-4">
                                <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Screenshot%202025-01-15%20at%2011.54.06%E2%80%AFAM-Ts9HZjjOk0xz6T1syp4JSxu2b3kBqJ.png" alt="Makeup brushes" class="w-20 h-20 object-cover rounded-lg">
                                <div>
                                    <h3 class="font-semibold">Makeup brushes</h3>
                                    <p class="text-sm text-gray-500">P12</p>
                                    <button class="text-sm text-gray-400 hover:text-gray-600">Remove</button>
                                </div>
                            </div>
                            <div class="col-span-2 flex justify-center items-center space-x-2">
                                <button class="w-8 h-8 rounded-full border hover:bg-gray-100">-</button>
                                <input type="number" value="2" class="w-12 text-center border-none" />
                                <button class="w-8 h-8 rounded-full border hover:bg-gray-100">+</button>
                            </div>
                            <div class="col-span-2 text-center">Rs. 400</div>
                            <div class="col-span-2 text-center">Rs. 800</div>
                        </div>

                        <!-- Cart Item 2 -->
                        <div class="grid grid-cols-12 gap-4 p-4 items-center">
                            <div class="col-span-6 flex gap-4">
                                <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Screenshot%202025-01-15%20at%2011.54.06%E2%80%AFAM-Ts9HZjjOk0xz6T1syp4JSxu2b3kBqJ.png" alt="Makeup brushes" class="w-20 h-20 object-cover rounded-lg">
                                <div>
                                    <h3 class="font-semibold">Makeup brushes</h3>
                                    <p class="text-sm text-gray-500">P13</p>
                                    <button class="text-sm text-gray-400 hover:text-gray-600">Remove</button>
                                </div>
                            </div>
                            <div class="col-span-2 flex justify-center items-center space-x-2">
                                <button class="w-8 h-8 rounded-full border hover:bg-gray-100">-</button>
                                <input type="number" value="2" class="w-12 text-center border-none" />
                                <button class="w-8 h-8 rounded-full border hover:bg-gray-100">+</button>
                            </div>
                            <div class="col-span-2 text-center">Rs. 400</div>
                            <div class="col-span-2 text-center">Rs. 800</div>
                        </div>


                    </div>
                </div>
            </div>

            <!-- Order Summary Section -->
            <div class="bg-gray-200 rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6">Order summary</h2>

                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span>ITEMS2</span>
                        <span>Rs.1600</span>
                    </div>

                    <div class="pt-4">
                        <h3 class="font-semibold mb-2">Shipping</h3>
                        <select class="w-full p-2 rounded-lg bg-white border-none">
                            <option>Select shipping method</option>
                            <option>Standard Shipping</option>
                            <option>Express Shipping</option>
                        </select>
                    </div>

                    <div class="border-t border-gray-300 pt-4 mt-4">
                        <div class="flex justify-between font-bold">
                            <span>TOTAL COST</span>
                            <span>Rs.1600</span>
                        </div>
                    </div>

                    <button class="w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800 transition-colors">
                        CHECKOUT
                    </button>
                </div>
            </div>
        </div>
    </main>
    <?php require 'views/partials/footer.php'; ?>
</body>

</html>
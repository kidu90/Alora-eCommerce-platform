<?php
require_once 'dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    logoutUser();
}

?>
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
                    <div id="cart-items" class="divide-y">
                        <!-- Items will be dynamically injected here -->
                    </div>
                </div>
                <form action="" method="POST">
                    <button type="submit" name="logout" class="bg-gray-200 text-black px-6 py-2 rounded-full hover:bg-gray-100 mt-4 inline-block">
                        Logout
                    </button>
                </form>
            </div>

            <!-- Order Summary Section -->
            <div class="bg-gray-200 rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6">Order summary</h2>

                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span>ITEMS<span id="total-items">0</span></span>
                        <span>Rs.<span id="total-cost">0</span></span>
                    </div>

                    <div class="pt-4">
                        <h3 class="font-semibold mb-2">Shipping</h3>
                        <input type="text" placeholder="Enter your address" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black">
                    </div>

                    <div class="border-t border-gray-300 pt-4 mt-4">
                        <div class="flex justify-between font-bold">
                            <span>TOTAL COST</span>
                            <span>Rs.<span id="grand-total">0</span></span>
                        </div>
                    </div>

                    <button id="checkout-btn" class="w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800 transition-colors">
                        CHECKOUT
                    </button>
                </div>
            </div>
        </div>
    </main>
    <?php require 'views/partials/footer.php'; ?>

    <script>
        // Retrieve cart items from local storage
        const cartItems = JSON.parse(localStorage.getItem("userCart")) || [];

        const cartItemsContainer = document.getElementById("cart-items");
        const totalItemsElement = document.getElementById("total-items");
        const totalCostElement = document.getElementById("total-cost");
        const grandTotalElement = document.getElementById("grand-total");

        let totalItems = 0;
        let totalCost = 0;

        // Generate cart HTML
        cartItems.forEach(item => {
            const {
                productId,
                productName,
                productPrice,
                productImage,
                quantity
            } = item;
            const itemTotal = productPrice * quantity;

            // Update totals
            totalItems += quantity;
            totalCost += itemTotal;

            // Add item to cart container
            cartItemsContainer.innerHTML += `
                <div class="grid grid-cols-12 gap-4 p-4 items-center">
                    <div class="col-span-6 flex gap-4">
                        <img src="${productImage}" alt="${productName}" class="w-20 h-20 object-cover rounded-lg">
                        <div>
                            <h3 class="font-semibold">${productName}</h3>
                            <p class="text-sm text-gray-500">P${productId}</p>
                            <button class="text-sm text-gray-400 hover:text-gray-600" onclick="removeItem(${productId})">Remove</button>
                        </div>
                    </div>
                    <div class="col-span-2 flex justify-center items-center space-x-2">
                        <button class="w-8 h-8 rounded-full border hover:bg-gray-100" onclick="decreaseQuantity(${productId})">-</button>
                        <input type="number" value="${quantity}" class="w-12 text-center border-none" readonly />
                        <button class="w-8 h-8 rounded-full border hover:bg-gray-100" onclick="increaseQuantity(${productId})">+</button>
                    </div>
                    <div class="col-span-2 text-center">Rs. ${productPrice}</div>
                    <div class="col-span-2 text-center">Rs. ${itemTotal}</div>
                </div>
            `;
        });

        // Update totals in the UI
        totalItemsElement.textContent = totalItems;
        totalCostElement.textContent = totalCost;
        grandTotalElement.textContent = totalCost;

        // Remove item function
        function removeItem(productId) {
            const updatedCart = cartItems.filter(item => item.productId !== productId);
            localStorage.setItem("userCart", JSON.stringify(updatedCart));
            location.reload();
        }

        // Increase quantity
        function increaseQuantity(productId) {
            const updatedCart = cartItems.map(item => {
                if (item.productId === productId) {
                    item.quantity += 1;
                }
                return item;
            });
            localStorage.setItem("userCart", JSON.stringify(updatedCart));
            location.reload();
        }

        // Decrease quantity
        function decreaseQuantity(productId) {
            const updatedCart = cartItems.map(item => {
                if (item.productId === productId && item.quantity > 1) {
                    item.quantity -= 1;
                }
                return item;
            });
            localStorage.setItem("userCart", JSON.stringify(updatedCart));
            location.reload();
        }

        // Checkout button functionality
        document.getElementById("checkout-btn").addEventListener("click", async () => {
            const shippingAddress = document.querySelector("input[placeholder='Enter your address']").value;

            if (!shippingAddress) {
                alert("Please provide a shipping address.");
                return;
            }

            // Prepare order data
            const orderData = {
                user_id: 1, // Replace with actual logged-in user ID
                shipping_address: shippingAddress,
                order_items: cartItems.map(item => ({
                    product_id: item.productId,
                    quantity: item.quantity,
                    price_per_unit: item.productPrice
                }))
            };

            // Send order data to the backend API
            try {
                const response = await fetch('http://localhost/Alora/api/orders/create_order.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(orderData),
                });

                const result = await response.json();

                if (result.status === 'success') {
                    alert("Order placed successfully!");
                    localStorage.removeItem("userCart"); // Clear cart
                    window.location.reload(); // Reload page or redirect
                } else {
                    alert(`Error: ${result.message}`);
                }
            } catch (error) {
                console.error("Error placing order:", error);
                alert("Failed to place order. Please try again later.");
            }
        });
    </script>
</body>

</html>
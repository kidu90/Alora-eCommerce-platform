<?php

// Get the logged-in user's ID from the session
$userId = $_SESSION['user_id'] ?? null;

require_once 'functions.php'; // Adjust the path to your functions file

// Check if product ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Product ID is missing.";
    exit();
}

$product_id = intval($_GET['id']);

try {
    // Fetch product details using the provided function
    $product = fetchProductsById($product_id);

    // Check if the product data is retrieved
    if ($product) {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo htmlspecialchars($product['name']); ?> - Product Details</title>
            <script src="https://cdn.tailwindcss.com"></script>
        </head>

        <body class="bg-gray-100 ">

            <?php require 'views/partials/navbar.php'; ?>

            <section class="min-h-screen flex flex-col items-center justify-center">
                <div class="flex flex-col md:flex-row bg-white rounded-lg shadow-xl p-6 md:max-w-3xl w-full mt-10">
                    <!-- Product Image -->
                    <div class="md:w-1/2 w-full mb-6 md:mb-0">
                        <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-full h-auto rounded-lg shadow-lg">
                    </div>

                    <!-- Product Details -->
                    <div class="md:w-1/2 w-full md:pl-6">
                        <h1 class="text-4xl font-extrabold text-gray-800"><?php echo htmlspecialchars($product['name']); ?></h1>
                        <p class="text-gray-600 mt-4 text-lg"><strong>Description:</strong> <?php echo htmlspecialchars($product['description']); ?></p>
                        <p class="text-gray-600 mt-4 text-xl"><strong>Price:</strong> LKR <?php echo htmlspecialchars($product['price']); ?></p>
                        <p class="text-gray-600 mt-4 text-lg"><strong>Ingredients:</strong> <?php echo htmlspecialchars($product['ingredients']); ?></p>
                        <p class="text-gray-600 mt-4 text-lg"><strong>Usage Tips:</strong> <?php echo htmlspecialchars($product['usage_tips']); ?></p>

                        <!-- Quantity and Add to Cart Row -->
                        <div class="flex items-center space-x-4 mt-6">
                            <div class="flex items-center border rounded-md">
                                <button id="decreaseButton" class="px-4 py-2 text-xl">-</button>
                                <span id="quantity" class="px-4 py-2 border-x">1</span>
                                <button id="increaseButton" class="px-4 py-2 text-xl">+</button>
                            </div>
                            <button id="addToCartButton" class="inline-block bg-blue-600 text-white py-3 px-6 rounded-lg text-lg hover:bg-blue-700 transition duration-300">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <?php require 'views/partials/footer.php'; ?>

            <script>
                //  quantity buttons and Add to Cart functionality

                const quantityEl = document.getElementById("quantity");
                const addToCartButton = document.getElementById("addToCartButton");

                // Increase quantity
                document.getElementById("increaseButton").addEventListener("click", () => {
                    quantityEl.innerText = parseInt(quantityEl.innerText) + 1;
                });

                // Decrease quantity
                document.getElementById("decreaseButton").addEventListener("click", () => {
                    const currentQuantity = parseInt(quantityEl.innerText);
                    if (currentQuantity > 1) {
                        quantityEl.innerText = currentQuantity - 1;
                    }
                });

                // Add to Cart functionality
                addToCartButton.addEventListener("click", () => {
                    <?php if ($userId): ?>
                        // User is logged in
                        const productId = <?php echo $product_id; ?>;
                        const productName = <?php echo json_encode($product['name']); ?>;
                        const productPrice = <?php echo json_encode($product['price']); ?>;
                        const productImage = <?php echo json_encode($product['image_url']); ?>;
                        const quantity = parseInt(quantityEl.innerText);

                        // Create or update userCart in localStorage
                        let cart = JSON.parse(localStorage.getItem("userCart")) || [];
                        const existingProduct = cart.find(item => item.productId === productId);

                        if (existingProduct) {
                            existingProduct.quantity += quantity;
                        } else {
                            cart.push({
                                productId,
                                productName,
                                productPrice,
                                productImage,
                                quantity
                            });
                        }

                        localStorage.setItem("userCart", JSON.stringify(cart));
                        alert("Product added to cart!");
                    <?php else: ?>
                        // User is not logged in
                        alert("You must log in to add products to the cart.");
                        window.location.href = "login.php"; // Redirect to login page
                    <?php endif; ?>
                });
            </script>

        </body>

        </html>
<?php
    } else {
        echo "Product not found.";
    }
} catch (Exception $e) {
    echo "Error: " . htmlspecialchars($e->getMessage());
}
?>
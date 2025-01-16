<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
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

        <body class="bg-gray-50 min-h-screen flex items-center justify-center">
            <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="w-full md:w-1/2">
                        <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-full h-auto rounded-md">
                    </div>
                    <div class="w-full md:w-1/2 md:pl-6 mt-4 md:mt-0">
                        <h1 class="text-3xl font-bold text-gray-800"><?php echo htmlspecialchars($product['name']); ?></h1>
                        <p class="text-gray-600 mt-4"><strong>Description:</strong> <?php echo htmlspecialchars($product['description']); ?></p>
                        <p class="text-gray-600 mt-2"><strong>Price:</strong> $<?php echo htmlspecialchars($product['price']); ?></p>
                        <p class="text-gray-600 mt-2"><strong>Ingredients:</strong> <?php echo htmlspecialchars($product['ingredients']); ?></p>
                        <p class="text-gray-600 mt-2"><strong>Usage Tips:</strong> <?php echo htmlspecialchars($product['usage_tips']); ?></p>
                        <a href="index.php" class="mt-6 inline-block bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Go Back</a>
                    </div>
                </div>
            </div>
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
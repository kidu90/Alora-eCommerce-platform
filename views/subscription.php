<?php
require_once 'dbconnection.php';

// Check if user is logged in
$userId = $_SESSION['user_id'] ?? null;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscriptions - Aurora Beauty</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&display=swap" rel="stylesheet">
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
            <!-- Monthly Beauty Box Plan -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-8">
                    <h3 class="text-2xl font-bold mb-4">Monthly Beauty Box</h3>
                    <div class="text-4xl font-bold mb-4">
                        Rs. 4999<span class="text-lg font-normal text-gray-600">/month</span>
                    </div>
                    <p class="text-gray-600 mb-6">Curated selection of premium beauty products</p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Curated Beauty Box Monthly
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Free Shipping
                        </li>
                    </ul>
                    <button class="w-full bg-gray-200 text-black px-6 py-2 rounded-lg hover:bg-gray-100 transition duration-300" onclick="openModal('Monthly Beauty Box', 'Rs. 4999', 'Curated selection of premium beauty products')">
                        Subscribe Now
                    </button>
                </div>
            </div>

            <!-- Quarterly Essentials Plan -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border-2 border-black relative">
                <div class="absolute top-0 right-0 bg-black text-white px-4 py-1 rounded-bl-lg">
                    Popular
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold mb-4">Quarterly Essentials</h3>
                    <div class="text-4xl font-bold mb-4">
                        Rs. 12999<span class="text-lg font-normal text-gray-600">/3 months</span>
                    </div>
                    <p class="text-gray-600 mb-6">Seasonal skincare essentials</p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Seasonal Skincare Products
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Free Shipping
                        </li>
                    </ul>
                    <button class="w-full bg-gray-200 text-black px-6 py-2 rounded-lg hover:bg-gray-100 transition duration-300" onclick="openModal('Quarterly Essentials', 'Rs. 12999', 'Seasonal skincare essentials')">
                        Subscribe Now
                    </button>
                </div>
            </div>

            <!-- Annual Beauty Pass Plan -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-8">
                    <h3 class="text-2xl font-bold mb-4">Annual Beauty Pass</h3>
                    <div class="text-4xl font-bold mb-4">
                        Rs. 49999<span class="text-lg font-normal text-gray-600">/year</span>
                    </div>
                    <p class="text-gray-600 mb-6">Year-round beauty favorites</p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Year-Round Beauty Products
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Priority Shipping
                        </li>
                    </ul>
                    <button class="w-full bg-gray-200 text-black px-6 py-2 rounded-lg hover:bg-gray-100 transition duration-300" onclick="openModal('Annual Beauty Pass', 'Rs. 49999', 'Year-round beauty favorites')">
                        Subscribe Now
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-gray-100 py-20 mb-28">
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

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg p-8 max-w-lg w-full">
            <h2 class="text-2xl font-bold mb-4" id="modal-title"></h2>
            <p class="text-xl mb-4" id="modal-description"></p>
            <div class="text-4xl font-bold mb-4" id="modal-price"></div>
            <button class="w-full bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-400 transition duration-300" onclick="confirmSubscription()">
                Confirm Subscription
            </button>
            <button class="w-full mt-4 bg-gray-300 text-black px-6 py-2 rounded-lg hover:bg-gray-200 transition duration-300" onclick="closeModal()">
                Close
            </button>
        </div>
    </div>

    <script>
        function openModal(plan, price, description) {
            document.getElementById('modal-title').innerText = plan;
            document.getElementById('modal-price').innerText = price;
            document.getElementById('modal-description').innerText = description;

            if (!<?php echo json_encode($userId); ?>) {
                alert("You must log in to subscribe. Redirecting to login page.");
                window.location.href = "login.php"; // Redirect to the login page if the user is not logged in
            } else {
                document.getElementById('modal').classList.remove('hidden');
            }
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }

        function confirmSubscription() {
            const userId = <?php echo json_encode($userId); ?>; // Get the logged-in user ID from PHP session
            const planName = document.getElementById('modal-title').innerText;
            let planId = 0;

            if (planName === 'Monthly Beauty Box') {
                planId = 1;
            } else if (planName === 'Quarterly Essentials') {
                planId = 2;
            } else if (planName === 'Annual Beauty Pass') {
                planId = 3;
            }

            if (planId === 0) {
                alert("Invalid plan selected");
                return;
            }

            // Create the subscription by making an API call
            fetch('http://localhost/Alora/api/subs/create_subscription.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        user_id: userId,
                        plan_id: planId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        alert("Subscription confirmed!");
                        closeModal(); // Close the modal after confirmation
                    } else {
                        alert("Failed to create subscription: " + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("An error occurred while processing the subscription");
                });
        }
    </script>

    <!-- Footer -->
    <?php require 'views/partials/footer.php'; ?>
</body>

</html>
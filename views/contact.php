<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Aurora Beauty</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>

<body class="bg-gray-50 font-sans">
    <?php require 'views/partials/navbar.php'; ?>

    <main class="container mx-auto px-6 py-8">
        <h1 class="text-4xl font-bold text-center mb-8">Contact Us</h1>

        <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4">Send us a message</h2>
                <form>
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                        <input type="text" id="name" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="subject" class="block text-gray-700 text-sm font-bold mb-2">Subject</label>
                        <input type="text" id="subject" name="subject" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Message</label>
                        <textarea id="message" name="message" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                    </div>
                    <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">Send Message</button>
                </form>
            </div>

            <div class="bg-gray-100 rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4">Contact Information</h2>
                <div class="space-y-4">
                    <div>
                        <h3 class="text-lg font-semibold">Address</h3>
                        <p class="text-gray-600">123 Beauty Lane, Cosmetic City, 12345</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Phone</h3>
                        <p class="text-gray-600">+1 (555) 123-4567</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Email</h3>
                        <p class="text-gray-600">info@aurorabeauty.com</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Business Hours</h3>
                        <p class="text-gray-600">Monday - Friday: 9am - 5pm</p>
                        <p class="text-gray-600">Saturday: 10am - 4pm</p>
                        <p class="text-gray-600">Sunday: Closed</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require 'views/partials/footer.php'; ?>
</body>

</html>
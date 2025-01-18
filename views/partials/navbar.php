<header class="bg-white shadow-sm">
    <nav class="container mx-auto px-4 py-3 flex justify-between items-center">
        <a href="index.php?route=home" class="text-2xl font-secondary font-bold">Alora</a>
        <ul class="flex space-x-8">
            <li><a href="index.php?route=about" class="hover:text-gray-600">About</a></li>
            <li><a href="index.php?route=shop" class="hover:text-gray-600">Shop</a></li>
            <li><a href="index.php?route=contact" class="hover:text-gray-600">Contact</a></li>
            <li><a href="index.php?route=subscription" class="hover:text-gray-600">Subscription</a></li>
        </ul>
        <div class="flex space-x-4">
            <!-- Account Icon -->
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="index.php?route=profile" class="hover:text-gray-600">
                    <span class="sr-only">Profile</span>
                    <img src="assets/images/person.svg" alt="Account" class="h-6 w-6">
                </a>
            <?php else: ?>
                <a href="index.php?route=login" class="hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </a>
            <?php endif; ?>
            <!-- Search Icon -->
            <?php require 'views/partials/search.php' ?>
            <!-- Cart Icon -->
            <a href="index.php?route=cart" class="hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </a>
        </div>
    </nav>
</header>
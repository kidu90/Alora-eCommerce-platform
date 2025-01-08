<nav>
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex-shrink-0">
                <a href="index.php?route=home" class="text-black text-2xl font-bold font-secondary">Aurora</a>
            </div>
            <div class="hidden md:block">
                <div class="ml-10 flex items-center space-x-8">
                    <a href="index.php?route=about" class="text-black hover:text-gray-200">About</a>
                    <a href="index.php?route=shop" class="text-black hover:text-gray-200">Shop</a>
                    <a href="index.php?route=contact" class="text-black hover:text-gray-200">Contact</a>
                    <a href="index.php?route=subscription" class="text-black hover:text-gray-200">Subscription</a>

                </div>
            </div>
            <div class="flex items-center space-x-4">
                <!-- Account Icon -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- User is logged in, show profile link -->
                    <a href="index.php?route=profile" class="text-black">
                        <span class="sr-only">Profile</span>
                        <img src="images/person.svg" alt="Account" class="h-6 w-6">
                    </a>
                <?php else: ?>
                    <!-- User is not logged in, show login link -->
                    <a href="index.php?route=login" class="text-black">
                        <span class="sr-only">Login</span>
                        <img src="images/person.svg" alt="Account" class="h-6 w-6">
                    </a>
                <?php endif; ?>

                <!-- Cart Icon -->
                <a href="#">
                    <span class="sr-only">Cart</span>
                    <img src="images/cart-3-svgrepo-com.svg" alt="Cart" class="h-6 w-6">
                </a>

                <!-- Search Icon -->
                <a href="#">
                    <span class="sr-only">Search</span>
                    <img src="images/search-svgrepo-com.svg" alt="Search" class="h-6 w-6">
                </a>


            </div>
        </div>
    </div>
    </div>
</nav>
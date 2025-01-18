<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <img src="<?php echo $image ?>" alt="<?php echo $alt; ?>" class="w-full h-48 object-cover">
    <div class="p-4">
        <h3 class="font-bold mb-2"><?php echo $text; ?></h3>
        <div class="flex items-center mb-2">
            <img src="assets/images/star.svg" alt="Star Icon" class="h-5 w-5">
            <img src="assets/images/star.svg" alt="Star Icon" class="h-5 w-5">
            <img src="assets/images/star.svg" alt="Star Icon" class="h-5 w-5">
            <img src="assets/images/star.svg" alt="Star Icon" class="h-5 w-5">
        </div>
        <p class="text-gray-600 mb-4"><?php echo $price; ?></p>
        <a href="index.php?route=single_product&id=<?php echo $id; ?>"
            class="bg-gray-200 text-black px-6 py-2 rounded-lg hover:bg-gray-100 mt-4 inline-block">
            View Details
        </a>
    </div>
</div>
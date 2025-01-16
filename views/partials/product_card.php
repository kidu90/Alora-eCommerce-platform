<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <img src="<?php echo $image ?>" alt="<?php echo $alt; ?>" class="w-full h-48 object-cover">
    <div class="p-4">
        <h3 class="font-bold mb-2"><?php echo $text; ?></h3>
        <div class="flex items-center mb-2">
            <image src="assets/images/star.svg" alt="Star Icon" class="h-5 w-5">
                <image src="assets/images/star.svg" alt="Star Icon" class="h-5 w-5">
                    <image src="assets/images/star.svg" alt="Star Icon" class="h-5 w-5">
                        <image src="assets/images/star.svg" alt="Star Icon" class="h-5 w-5">
        </div>
        <p class="text-gray-600"><?php echo $price; ?></p>
        <a href="index.php?route=single_product&id=<?php echo $id; ?>"
            class="mt-4 inline-block bg-blue-500 text-black py-2 px-4 rounded-md hover:bg-blue-600">
            View Details
        </a>
    </div>
</div>
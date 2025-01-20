-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 20, 2025 at 09:49 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alora_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`) VALUES
(1, 'Skincare', 'Updated category description'),
(2, 'Haircare', 'Hair treatment and maintenance products'),
(3, 'Lips', 'Makeup and beauty products'),
(4, 'Eyes', 'Makeup and beauty products');

-- --------------------------------------------------------

--
-- Table structure for table `customer_subscriptions`
--

CREATE TABLE `customer_subscriptions` (
  `subscription_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `start_date` date NOT NULL,
  `next_delivery_date` date DEFAULT NULL,
  `status` enum('active','paused','cancelled') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_subscriptions`
--

INSERT INTO `customer_subscriptions` (`subscription_id`, `user_id`, `plan_id`, `start_date`, `next_delivery_date`, `status`, `created_at`) VALUES
(3, 7, 1, '2025-01-16', '2025-02-16', 'active', '2025-01-16 12:10:49'),
(5, 8, 1, '2025-01-16', '2025-02-16', 'active', '2025-01-16 12:37:59');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','shipped','delivered','cancelled') DEFAULT 'pending',
  `shipping_address` text DEFAULT NULL,
  `payment_status` enum('pending','completed','failed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `total_amount`, `status`, `shipping_address`, `payment_status`) VALUES
(1, 1, '2025-01-09 15:28:24', 204.94, 'shipped', '123 Main Street, Cityville', 'completed'),
(3, 2, '2025-01-09 16:40:51', 177.89, 'pending', '456 Elm Avenue, Townsville', 'pending'),
(5, 7, '2025-01-16 11:29:23', 84.97, 'shipped', '123 Main St, Colombo, Sri Lanka', 'completed'),
(6, 1, '2025-01-17 10:51:39', 89.97, 'pending', 'delgoda, east', 'completed'),
(10, 1, '2025-01-17 15:42:07', 84.97, 'pending', '123 Main St, Colombo, Sri Lanka', 'pending'),
(11, 1, '2025-01-18 14:44:12', 46.97, 'pending', 'Colombo 6', 'pending'),
(14, 8, '2025-01-19 19:56:25', 22.98, 'pending', 'sdhbcsdvkf', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price_per_unit` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `price_per_unit`, `subtotal`) VALUES
(1, 1, 1, 2, 29.99, 59.98),
(2, 1, 2, 1, 24.99, 24.99),
(3, 1, 3, 3, 39.99, 119.97),
(7, 3, 5, 1, 19.99, 19.99),
(8, 3, 7, 4, 14.50, 58.00),
(9, 3, 10, 2, 49.95, 99.90),
(11, 5, 1, 2, 29.99, 59.98),
(12, 5, 2, 1, 24.99, 24.99),
(13, 6, 3, 2, 39.99, 79.98),
(14, 6, 9, 1, 9.99, 9.99),
(19, 10, 3, 2, 29.99, 59.98),
(20, 10, 2, 1, 24.99, 24.99),
(21, 11, 12, 1, 16.99, 16.99),
(22, 11, 10, 2, 14.99, 29.98),
(27, 14, 9, 1, 9.99, 9.99),
(28, 14, 11, 1, 12.99, 12.99);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `ingredients` text DEFAULT NULL,
  `usage_tips` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `name`, `description`, `price`, `stock_quantity`, `ingredients`, `usage_tips`, `image_url`, `created_at`) VALUES
(1, 1, 'Vitamin C Serum', 'Brightening serum for all skin types', 29.99, 100, 'Vitamin C, Hyaluronic Acid, Ferulic Acid', 'Apply in the morning before moisturizer', 'https://www.nirvanabotanics.com/cdn/shop/files/Brightening-Serum_03.jpg?v=1726489863', '2025-01-05 07:21:09'),
(2, 2, 'Argan Oil Shampoo', 'Nourishing shampoo for dry hair', 24.99, 148, 'Argan Oil, Aloe Vera, Vitamin E', 'Massage into wet hair, rinse thoroughly', 'https://images.ctfassets.net/ya8mvjlg9l8b/3ylk0ZU6DklRO8Bbp5E7iA/d31b534143c65dbeefa721f15c584237/OGX_NA_US_00022796916112_AOM_Shampoo_13oz_00000-1-en-us', '2025-01-05 07:21:09'),
(3, 1, 'Long-wear Foundation', '24-hour wear foundation with SPF', 39.99, 71, 'Titanium Dioxide, Iron Oxides', 'Apply with beauty blender for best results', 'https://www.blushme.lk/cdn/shop/products/NudeB.jpg?v=1655556767&width=1080', '2025-01-05 07:21:09'),
(5, 1, 'Hydrating Face Mask', 'Deeply moisturizes and rejuvenates skin', 27.99, 150, 'Aloe Vera, Vitamin C, Hyaluronic Acid', 'Apply generously to face and leave for 15 minutes, rinse off', 'https://colombomall.lk/wp-content/uploads/2023/10/25-68.jpg', '2025-01-05 07:21:09'),
(6, 1, 'Sunscreen SPF 50', 'Broad-spectrum sunscreen for all skin types', 19.99, 199, 'Zinc Oxide, Titanium Dioxide', 'Apply generously to face and neck 15 minutes before sun exposure', 'https://m.media-amazon.com/images/I/51LawcY+-0L._SL1000_.jpg', '2025-01-05 07:21:09'),
(7, 2, 'Repairing Shampoo', 'Shampoo for damaged hair with protein complex', 21.99, 180, 'Keratin, Argan Oil, Vitamin E', 'Apply to wet hair, massage, and rinse thoroughly', 'https://images-cdn.ubuy.co.in/668401faf739143bec48849c-garnier-whole-blends-honey-treasures.jpg', '2025-01-05 07:21:09'),
(8, 2, 'Nourishing Conditioner', 'Conditioner to restore moisture and shine to dry hair', 22.99, 158, 'Coconut Oil, Shea Butter', 'Massage into damp hair, leave for 3 minutes, rinse well', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ3EBFJneyXScZ8xnhhyKCcX5Y41onieQTcgw&s', '2025-01-05 07:21:09'),
(9, 3, 'Glossy Lip Balm', 'Hydrating lip balm with a shiny finish', 9.99, 299, 'Beeswax, Shea Butter, Vitamin E', 'Apply to lips as needed throughout the day', 'https://m.media-amazon.com/images/I/71RfbIFZxvL.jpg', '2025-01-05 07:21:09'),
(10, 3, 'Matte Lip Crayon', 'Long-lasting matte finish lip color', 14.99, 248, 'Beeswax, Castor Oil, Titanium Dioxide', 'Apply directly to lips for full coverage', 'https://colombomall.lk/wp-content/uploads/2023/10/81-59.jpg', '2025-01-05 07:21:09'),
(11, 4, 'Eyeliner Pencil', 'Smooth application eyeliner for precise lines', 12.99, 348, 'Carnauba Wax, Iron Oxides', 'Apply along the lash line for a bold look', 'https://m.media-amazon.com/images/I/71ZinfmfzKL._AC_UF1000,1000_QL80_.jpg', '2025-01-05 07:21:09'),
(12, 4, 'Volume Mascara', 'Mascara for thick, voluminous lashes', 16.99, 298, 'Beeswax, Vitamin E', 'Apply from root to tip of lashes for volume', 'https://i5.walmartimages.com/seo/Maybelline-Lash-Sensational-Washable-Mascara-Very-Black_a499c6b3-3e46-42b6-841f-1e3d0b2d9547.bcb8eb8baaee81c35536ad4c2510c88a.jpeg', '2025-01-05 07:21:09'),
(14, 3, 'Matte Ink Liquid Lipstick', 'A long-wearing, highly pigmented liquid lipstick that delivers a matte finish for up to 16 hours.', 45.00, 60, 'Isododecane, Dimethicone, Trimethylsiloxysilicate, Iron Oxides, and more.', 'Start by applying in the center of the lips and work your way outwards for a bold matte finish.', 'https://angelsbeauty.lk/cdn/shop/files/tttt.png?v=1708775861', '2025-01-16 09:20:05');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plans`
--

CREATE TABLE `subscription_plans` (
  `plan_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration_months` int(11) NOT NULL,
  `is_custom_box` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscription_plans`
--

INSERT INTO `subscription_plans` (`plan_id`, `name`, `description`, `price`, `duration_months`, `is_custom_box`) VALUES
(1, 'Monthly Beauty Box', 'Curated selection of premium beauty products', 49.99, 1, 1),
(2, 'Quarterly Essentials', 'Seasonal skincare essentials', 129.99, 3, 0),
(3, 'Annual Beauty Pass', 'Year-round beauty favorites', 499.99, 12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `role` enum('admin','customer') DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `phone`, `address`, `role`, `created_at`) VALUES
(1, 'Admin', 'User', 'admin@alora.com', 'admin1234', '1234567890', '123 Admin St', 'admin', '2025-01-05 07:21:09'),
(2, 'Jane', 'Doe', 'jane@example.com', '456', '9876543210', '456 Customer Ave', 'customer', '2025-01-05 07:21:09'),
(3, 'John', 'Smith', 'john@example.com', 'john345', '5555555555', '789 Beauty Ln', 'customer', '2025-01-05 07:21:09'),
(7, '', '', 'hello@example.com', '$2a$12$RqstqzlCHpNw.Qv0owFlhe/rnaQf6jAFU5SolfAWun4nbbdmxpIw.', NULL, NULL, 'admin', '2025-01-11 06:38:20'),
(8, 'Thenara', 'Sithumli', 'thenara@gmail.com', '$2y$10$tHAXrgZFTjRbdfhN9lv.ue3XkWOqwYYqpTnBEb57xOZpeHM2FTvz2', NULL, NULL, 'customer', '2025-01-16 17:04:28'),
(9, 'Masha', 'Kidurangi', 'masha@gmail.com', '$2y$10$qzX7Wu9E4ROY7QkCOhr0vuy4HO5QPcEneVGbTM00Ro6cW/QTrMTJS', NULL, NULL, 'customer', '2025-01-18 14:43:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer_subscriptions`
--
ALTER TABLE `customer_subscriptions`
  ADD PRIMARY KEY (`subscription_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer_subscriptions`
--
ALTER TABLE `customer_subscriptions`
  MODIFY `subscription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_subscriptions`
--
ALTER TABLE `customer_subscriptions`
  ADD CONSTRAINT `customer_subscriptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `customer_subscriptions_ibfk_2` FOREIGN KEY (`plan_id`) REFERENCES `subscription_plans` (`plan_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

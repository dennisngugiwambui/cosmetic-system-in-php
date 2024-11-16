-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2024 at 12:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `glowcosmetics`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `product_name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `quantity` int(11) NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `status` varchar(255) DEFAULT 'Completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `order_date`, `quantity`, `total_cost`, `status`) VALUES
(1, 1, 2, '2024-09-28 07:08:49', 1, 39.99, 'Completed'),
(2, 2, 1, '2024-09-28 07:08:49', 2, 99.98, 'Completed'),
(3, 3, 3, '2024-09-28 07:08:49', 1, 59.99, 'Completed'),
(4, 4, 5, '2024-09-28 07:08:49', 3, 134.97, 'Completed'),
(5, 5, 4, '2024-09-28 07:08:49', 1, 34.99, 'Completed'),
(10, 6, 5, '2024-09-28 14:36:50', 1, 29.99, 'Completed'),
(11, 6, 7, '2024-09-28 14:36:50', 1, 22.75, 'Completed'),
(12, 8, 7, '2024-09-28 14:58:22', 2, 45.50, 'Completed'),
(13, 8, 5, '2024-09-28 14:58:22', 1, 29.99, 'Completed'),
(14, 8, 6, '2024-09-28 14:58:22', 1, 15.49, 'Completed'),
(15, 7, 4, '2024-09-28 14:59:06', 1, 12.00, 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perfumes`
--

CREATE TABLE `perfumes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `category` varchar(50) NOT NULL,
  `capacity` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perfumes`
--

INSERT INTO `perfumes` (`id`, `name`, `cost`, `category`, `capacity`, `image`) VALUES
(1, 'Rose Essence', 49.99, 'Floral', '50ml', 'https://prix.formesdeluxe.com/app/uploads/2022/07/Heinz-Glas-Parfums-Christian-Dior-Miss-Dior-Rose-Essence-01.jpg.webp'),
(2, 'Ocean Breeze', 39.99, 'Fruity', '100ml', 'https://www.wyxloop.com/cdn/shop/files/pixelcut-export-2024-06-11T112540.783.jpg?v=1718210209&width=900'),
(3, 'Musk Ambrosia', 59.99, 'Woody', '30ml', 'https://atelierperfumery.com/wp-content/uploads/2024/02/navitus-ambrosia-imperiale-extrait-de-parfum-125ml-01-800x800.jpg'),
(4, 'Citrus Splash', 34.99, 'Citrus', '75ml', 'https://www.birkholz-perfumes.com/cdn/shop/products/Citrus-Splash.jpg?v=1672754359&width=1080'),
(5, 'Vanilla Dream', 44.99, 'Sweet', '100ml', 'https://bubbletcosmetics.com/cdn/shop/files/vanilla-dream-refreshing-body-mist-moisturising.jpg?v=1714658219&width=600');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `stock` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `created_at`, `stock`, `image`) VALUES
(4, 'Gel', 'The most highest quality of gel ', 12.00, '2024-09-29 05:14:33', 4567, '1727554473_images (1).jpeg'),
(5, 'Radiant Glow Foundation', 'A lightweight foundation for natural, glowing skin.', 29.99, '2024-09-29 05:25:35', 150, '1727555135_DALL·E 2024-09-28 13.25.14 - A series of high-quality cosmetic products, including a radiant glow foundation in a sleek bottle, a velvet matte lipstick in a modern tube, a hydra b.webp'),
(6, 'Velvet Matte Lipstick', 'Long-lasting matte lipstick with a creamy texture.', 15.49, '2024-09-29 05:28:21', 200, '1727555301_DALL·E 2024-09-28 13.26.25 - A high-quality image of a velvet matte lipstick in a sleek, modern black tube. The lipstick is partially uncapped, showing the bold red color of the m.webp'),
(7, 'Hydra Boost Moisturizer', 'Hydrating moisturizer for smooth, supple skin.', 22.75, '2024-09-29 05:29:09', 120, '1727555349_DALL·E 2024-09-28 13.26.35 - A high-quality image of an ultra lash mascara in a glossy black tube. The tube is open, showing the mascara wand with rich black mascara. The design i.webp'),
(8, 'Ultra Lash Mascara', 'Volumizing mascara for bold, dramatic lashes.', 18.99, '2024-09-29 05:29:51', 250, '1727555391_DALL·E 2024-09-28 13.26.38 - A high-quality image of a perfect brow pencil with dual ends. One end has a pencil tip and the other a small brush. The pencil has a sleek black desig.webp'),
(9, 'Perfect Brow Pencil', 'Dual-ended brow pencil for precise definition.', 12.50, '2024-09-29 05:30:48', 80, '1727555448_DALL·E 2024-09-28 13.26.41 - A high-quality image of a silk touch blush in a compact case. The blush is a soft pink shade, and the compact case is sleek with a mirror inside. The .webp');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` enum('admin','customer') DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `usertype`) VALUES
(1, 'Jane Doe', 'jane.doe@example.com', 'hashedpassword123', 'customer'),
(2, 'John Smith', 'john.smith@example.com', 'hashedpassword456', 'customer'),
(3, 'Alice Johnson', 'alice.johnson@example.com', 'hashedpassword789', 'customer'),
(4, 'Bob Brown', 'bob.brown@example.com', 'hashedpassword101', 'customer'),
(5, 'Charlie Green', 'charlie.green@example.com', 'hashedpassword112', 'customer'),
(6, 'admin1', 'admin@gmail.com', '$2y$10$FRhoxWpPq1bkBQR0jsPj0.8dNWeLO0DP6XmU4Gb328ZL05Q7qfb.y', 'admin'),
(7, 'customer1', 'customer1@gmail.com', '$2y$10$w3ZhcWGmDX5mWf085LY62u06ZcmaaX2TXzVC.opPH2RtXwTHnsuV6', 'customer'),
(8, 'admin2', 'admin2@gmail.com', '$2y$10$ThxyfBob3w1KAEF5wZWjyume7RMR1BXGnbikHPePa1mGCKvRgkAKW', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `perfume_id` (`product_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `perfumes`
--
ALTER TABLE `perfumes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perfumes`
--
ALTER TABLE `perfumes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

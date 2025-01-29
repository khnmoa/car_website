-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 29, 2025 at 10:17 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int NOT NULL,
  `make` varchar(100) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `year` int DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `seller_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `make`, `model`, `year`, `price`, `image_url`, `seller_id`) VALUES
(1, 'sunny', '2016', 2016, '3000000.00', 'uploads/Screenshot 2024-11-26 191435.png', 1),
(2, 'sunny', '2016', 2016, '3000000.00', 'uploads/Screenshot 2024-11-26 191435.png', 1),
(3, 'sunny', '2016', 2016, '3000000.00', 'uploads/3.png', 1),
(4, 'sunny', '2016', 2016, '3000000.00', 'uploads/Screenshot 2024-11-26 191435.png', 1),
(5, 'sunny', '2016', 2016, '3000000.00', 'uploads/Screenshot 2024-11-26 191435.png', 1),
(6, 'sunny', '2016', 2016, '3000000.00', 'uploads/3.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `car_id` int NOT NULL,
  `user_id` int NOT NULL,
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','completed','cancelled') DEFAULT 'pending',
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `car_id`, `user_id`, `order_date`, `status`, `price`) VALUES
(1, 1, 1, '2025-01-29 23:51:26', 'completed', NULL),
(2, 2, 1, '2025-01-29 23:51:26', 'pending', NULL),
(3, 1, 2, '2025-01-29 23:55:36', 'pending', '3000000.00'),
(4, 1, 2, '2025-01-29 23:56:28', 'pending', '3000000.00'),
(5, 1, 2, '2025-01-29 23:59:04', 'pending', '3000000.00'),
(6, 1, 2, '2025-01-30 00:00:04', 'pending', '3000000.00'),
(7, 1, 2, '2025-01-30 00:00:13', 'pending', '3000000.00'),
(8, 5, 2, '2025-01-30 00:07:06', 'pending', '3000000.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `role`) VALUES
(1, 'a', 'a@gmail.com', '$2y$10$IChzw22ShIzG0pRa199dK.Hd8K/1mnqBBIh84Y5acxETH8b9qd.2e', '2025-01-29 20:40:13', 'seller'),
(2, 'b', 'b@gmail.com', '$2y$10$noj5fzvhfJ0z7PhtzyoFAOKvEDtpE0FgDLss9AqE42Mg6up3EAjPK', '2025-01-29 21:42:20', 'buyer'),
(3, 'John Doe', 'john@example.com', 'password123', '2025-01-29 21:47:49', 'buyer'),
(4, 'John Doe', 'john@example.com', 'password123', '2025-01-29 21:48:02', 'buyer'),
(5, 'John Doe', 'john@example.com', 'password123', '2025-01-29 21:51:26', 'buyer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_seller` (`seller_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `fk_seller` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

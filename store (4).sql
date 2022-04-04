-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql-server
-- Generation Time: Apr 01, 2022 at 09:53 AM
-- Server version: 8.0.19
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE `action` (
  `action` varchar(100) NOT NULL,
  `controller_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`action`, `controller_id`) VALUES
('index', 1),
('index', 2),
('addorder', 2),
('index', 3),
('add', 3),
('index', 5);

-- --------------------------------------------------------

--
-- Table structure for table `components`
--

CREATE TABLE `components` (
  `controller_id` int NOT NULL,
  `controller` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `components`
--

INSERT INTO `components` (`controller_id`, `controller`) VALUES
(1, 'index'),
(2, 'order'),
(3, 'product'),
(4, 'secure'),
(5, 'settings');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `zipcode` varchar(100) NOT NULL,
  `product` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `address`, `zipcode`, `product`, `quantity`) VALUES
(1, 'ashutosh mishra', 'lucknow', '226020', 'iPhone 13', '1'),
(2, 'rahul gupta', 'lucknow', '226020', 'Ball', '1'),
(3, 'aakash', 'lucknow', '226020', 'Ball', '1'),
(4, 'faiz', 'lucknow', '226005', 'Samsung S20', '1');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `role` varchar(100) NOT NULL,
  `controller` varchar(100) NOT NULL,
  `action` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`role`, `controller`, `action`) VALUES
('admin', 'index', '[\"index\"]'),
('admin', 'order', '[\"index\", \"addorder\"]'),
('admin', 'product', '[\"index\", \"add\"]'),
('admin', 'settings', '[\"index\"]'),
('customer', 'index', '[\"index\"]'),
('customer', 'order', '[\"addorder\"]'),
('customer', 'product', '[\"index\"]'),
('guest', 'index', '[\"index\"]'),
('guest', 'product', '[\"index\"]');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `tags` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `stock` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `tags`, `price`, `stock`) VALUES
(1, 'Ball', 'Tennis Ball', 'new', '100', '50'),
(2, 'iPhone 13', '6gb 128gb', 'trending', '50000', '100'),
(6, 'Samsung S20', '12gb 256gb', 'new', '40000', '50'),
(7, 'Bottel', 'steel copper', 'new', '500', '100'),
(9, 'trend', 'new', 'trend', '1000', '50'),
(10, 'anupamsdg', 'gora', 'sdg', '1000', '50'),
(11, 'footballnew', 'fgfg', 'new', '1000', '50');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role`) VALUES
('admin'),
('customer'),
('guest');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `title_optimization` varchar(100) NOT NULL,
  `default_price` varchar(100) NOT NULL,
  `default_stock` varchar(100) NOT NULL,
  `default_zipcode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title_optimization`, `default_price`, `default_stock`, `default_zipcode`) VALUES
(1, 'with tags', '1000', '50', '226005');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `token` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `token`) VALUES
(1, 'ravinder singh', 'ravinder@gmail.com', '123', 'admin', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImN0eSI6ImFwcGxpY2F0aW9uXC9qc29uIn0.eyJhdWQiOlsiaHR0cHM6XC9cL3RhcmdldC5waGFsY29uLmlvIl0sImV4cCI6MTY0ODg4OTc4OSwianRpIjoiYWJjZDEyMzQ1Njc4OSIsImlhdCI6MTY0ODgwMzM4OSwiaXNzIjoiaHR0cHM6XC9cL3BoYWxjb24uaW8iLCJuYmYiOjE2NDg4MDMzMjksInN1YiI6ImFkbWluIn0.jPo1nAteBV2VdcLgLQGjZudvp4MrjoO4WLHYxJEZt1lRmIYyI1IDDphJ3edNaxUlpXJC_eSscEiSosPC5TjxRw'),
(2, 'faiz', 'faiz@gmail.com', '345', 'customer', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImN0eSI6ImFwcGxpY2F0aW9uXC9qc29uIn0.eyJhdWQiOlsiaHR0cHM6XC9cL3RhcmdldC5waGFsY29uLmlvIl0sImV4cCI6MTY0ODg5MjE5NCwianRpIjoiYWJjZDEyMzQ1Njc4OSIsImlhdCI6MTY0ODgwNTc5NCwiaXNzIjoiaHR0cHM6XC9cL3BoYWxjb24uaW8iLCJuYmYiOjE2NDg4MDU3MzQsInN1YiI6ImN1c3RvbWVyIn0.RZiZ_ceGneZ68-YiDh936AW8sHFgzWwMU5zYznEi7tPwJoIEddUBL1_sWluSMOOXMQvsn59o3HCohHLoc09bGw');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `components`
--
ALTER TABLE `components`
  ADD PRIMARY KEY (`controller_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `components`
--
ALTER TABLE `components`
  MODIFY `controller_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- MySQL shopping cart database
-- Gaby Malaka
-- 4/26/2026

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `shopping_cart`
--
CREATE DATABASE IF NOT EXISTS `shopping_cart` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `shopping_cart`;

--
-- Table structure for table `products`
--
CREATE TABLE `products` (
  `prod_ID` int(11) NOT NULL COMMENT 'PK, Auto increments',
  `prod_name` varchar(255) NOT NULL COMMENT 'product name',
  `prod_desc` text NOT NULL COMMENT 'product description, longer text',
  `prod_price` decimal(10,2) NOT NULL COMMENT 'price w/ cents',
  `prod_quantity` int(11) NOT NULL COMMENT 'quantity available or quantity in cart'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK, Auto increments';
COMMIT;

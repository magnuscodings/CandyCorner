-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2023 at 04:14 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `candycorner`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(255) NOT NULL,
  `cart_user_id` int(11) NOT NULL,
  `cart_product_id` int(11) NOT NULL,
  `cart_quantity` int(11) NOT NULL,
  `cart_status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` text DEFAULT NULL,
  `category_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_status`) VALUES
(1, 'Candy', 0),
(2, 'Chocolate', 0),
(3, 'Milk', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_records`
--

CREATE TABLE `inventory_records` (
  `inventory_record_id` int(11) NOT NULL,
  `inventory_record_prod_id` int(11) NOT NULL,
  `inventory_record_order_id` int(11) NOT NULL,
  `inventory_record_status` int(11) DEFAULT 0,
  `inventory_record_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory_records`
--

INSERT INTO `inventory_records` (`inventory_record_id`, `inventory_record_prod_id`, `inventory_record_order_id`, `inventory_record_status`, `inventory_record_date`) VALUES
(2, 3, 829005, 1, '2023-05-27 20:21:34'),
(3, 1, 70563, 1, '2023-05-27 20:23:51'),
(4, 2, 70563, 1, '2023-05-27 20:23:58'),
(5, 4, 70563, 1, '2023-05-27 20:24:04');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(255) NOT NULL,
  `order_united_id` int(255) NOT NULL,
  `order_product_id` int(255) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `order_status` int(11) NOT NULL DEFAULT 0,
  `order_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_united_id`, `order_product_id`, `order_quantity`, `order_date`, `order_status`, `order_user_id`) VALUES
(13, 70563, 2, 2, '2023-05-25 00:59:33', 5, 25),
(14, 70563, 5, 2, '2023-05-25 00:59:33', 5, 25),
(15, 829005, 2, 3, '2023-05-26 00:31:09', 2, 25),
(16, 829005, 3, 10, '2023-05-26 00:31:09', 2, 25);

-- --------------------------------------------------------

--
-- Table structure for table `order_records`
--

CREATE TABLE `order_records` (
  `order_record_id` int(11) NOT NULL,
  `order_record_user_id` int(11) NOT NULL,
  `order_record_order_id` int(255) NOT NULL,
  `order_record_status` int(11) NOT NULL,
  `order_record_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_records`
--

INSERT INTO `order_records` (`order_record_id`, `order_record_user_id`, `order_record_order_id`, `order_record_status`, `order_record_date`) VALUES
(13, 25, 70563, 3, '2023-05-27 20:24:39'),
(14, 25, 70563, 4, '2023-05-27 20:47:27'),
(15, 25, 70563, 5, '2023-05-27 21:29:07');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_id` int(255) NOT NULL,
  `prod_name` text NOT NULL,
  `prod_category` int(11) DEFAULT NULL,
  `prod_description` text DEFAULT NULL,
  `prod_price` text DEFAULT NULL,
  `prod_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `prod_name`, `prod_category`, `prod_description`, `prod_price`, `prod_status`) VALUES
(1, 'toblerone', 2, 'masarap sya matamisss', '150', 0),
(2, 'milkita', 3, 'matamis kulay whites', '23', 0),
(3, 'toblerone', 2, 'masarap', '125', 0),
(4, 'Max', 1, 'masakit sa ngipen', '1', 0),
(5, 'asdasd', 1, 'asda', '23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL,
  `request_user_id` int(11) NOT NULL,
  `request_prod_id` int(11) NOT NULL,
  `request_qty` text NOT NULL,
  `request_reason` text NOT NULL,
  `request_date` datetime NOT NULL DEFAULT current_timestamp(),
  `request_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`request_id`, `request_user_id`, `request_prod_id`, `request_qty`, `request_reason`, `request_date`, `request_status`) VALUES
(1, 25, 5, '2', 'sira na lagayan', '2023-06-01 21:35:39', 0),
(2, 25, 2, '5', 'sira na kasi lagayan', '2023-06-01 21:36:47', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `stock_id` int(11) NOT NULL,
  `stock_prod_id` int(11) NOT NULL,
  `stock_barcode` text NOT NULL,
  `stock_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `stock_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`stock_id`, `stock_prod_id`, `stock_barcode`, `stock_datetime`, `stock_status`) VALUES
(1, 2, '2-milkita-527173.png', '2023-05-22 19:00:12', 1),
(2, 2, '2-milkita-057524.png', '2023-05-22 19:00:12', 1),
(3, 1, '1-toblerone-965363.png', '2023-05-24 21:00:42', 1),
(4, 1, '1-toblerone-484817.png', '2023-05-24 21:00:42', 1),
(5, 1, '1-toblerone-484817.png', '2023-05-24 21:00:42', 0),
(6, 2, '2-milkita-014172.png', '2023-06-01 18:19:24', 0),
(7, 2, '2-milkita-742781.png', '2023-06-01 18:19:24', 0),
(8, 4, '4-Max-275634.png', '2023-06-01 18:19:55', 0),
(9, 4, '4-Max-419920.png', '2023-06-01 18:19:55', 0),
(10, 4, '4-Max-697431.png', '2023-06-01 18:19:55', 0),
(11, 3, '3-toblerone-648659.png', '2023-06-01 18:20:08', 0),
(12, 3, '3-toblerone-692650.png', '2023-06-01 18:20:08', 0),
(13, 3, '3-toblerone-799979.png', '2023-06-01 18:20:08', 0),
(14, 3, '3-toblerone-082855.png', '2023-06-01 18:20:08', 0),
(15, 3, '3-toblerone-367020.png', '2023-06-01 18:20:08', 0),
(16, 5, '5-asdasd-109771.png', '2023-06-01 18:20:14', 0),
(17, 5, '5-asdasd-190683.png', '2023-06-01 18:20:14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(255) NOT NULL,
  `u_email` text NOT NULL,
  `u_password` text NOT NULL,
  `u_name` text NOT NULL,
  `u_type` int(255) NOT NULL DEFAULT 0,
  `u_status` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_email`, `u_password`, `u_name`, `u_type`, `u_status`) VALUES
(1, 'admin@admin', 'admin@admin', 'Administrator', 2, 0),
(25, 'branch1@branch1', 'branch1@branch1', 'branch1', 0, 0),
(26, 'checker@checker', 'checker@checker', 'Checker', 1, 0),
(27, 'mr.ephraiel@gmail.com', 'asdasd', 'tester', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `inventory_records`
--
ALTER TABLE `inventory_records`
  ADD PRIMARY KEY (`inventory_record_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_records`
--
ALTER TABLE `order_records`
  ADD PRIMARY KEY (`order_record_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `u_email` (`u_email`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inventory_records`
--
ALTER TABLE `inventory_records`
  MODIFY `inventory_record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_records`
--
ALTER TABLE `order_records`
  MODIFY `order_record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

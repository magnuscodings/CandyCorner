-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2023 at 12:01 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` text DEFAULT NULL,
  `category_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_status`) VALUES
(1, 'Candy', 0),
(2, 'Chocolate', 0),
(3, 'Milk', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_united_id`, `order_product_id`, `order_quantity`, `order_date`, `order_status`, `order_user_id`) VALUES
(13, 70563, 2, 3, '2023-05-25 00:59:33', 2, 25),
(14, 70563, 3, 2, '2023-05-25 00:59:33', 2, 25),
(15, 829005, 2, 3, '2023-05-26 00:31:09', 1, 25),
(16, 829005, 3, 10, '2023-05-26 00:31:09', 1, 25);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_records`
--

INSERT INTO `order_records` (`order_record_id`, `order_record_user_id`, `order_record_order_id`, `order_record_status`, `order_record_date`) VALUES
(6, 25, 70563, 2, '2023-05-26 02:16:07'),
(7, 25, 829005, 1, '2023-05-26 02:19:09');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `prod_name`, `prod_category`, `prod_description`, `prod_price`, `prod_status`) VALUES
(1, 'toblerone', 2, 'masarap sya matamisss', '150', 0),
(2, 'milkita', 3, 'matamis kulay whites', '23', 0),
(3, 'toblerone', 2, 'masarap', '125', 0),
(4, 'Max', 1, 'masakit sa ngipen', '1', 0),
(5, 'asdasd', 1, 'asda', '23', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`stock_id`, `stock_prod_id`, `stock_barcode`, `stock_datetime`, `stock_status`) VALUES
(1, 2, '2-milkita-527173.png', '2023-05-22 19:00:12', 0),
(2, 2, '2-milkita-057524.png', '2023-05-22 19:00:12', 0),
(3, 1, '1-toblerone-965363.png', '2023-05-24 21:00:42', 0),
(4, 1, '1-toblerone-484817.png', '2023-05-24 21:00:42', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_email`, `u_password`, `u_name`, `u_type`, `u_status`) VALUES
(1, 'admin@admin', 'admin@admin', 'Administrator', 2, 0),
(11, 'employee@employee', 'employee@employee', 'Employee', 0, 0),
(16, 'daniel@daniel', 'daniel@daniel', 'daniel', 0, 0),
(17, 'daniel@daniel2', 'daniel@daniel', 'daniel', 0, 0),
(18, 'daniel@daniel23', 'daniel@daniel', 'daniel', 0, 0),
(19, 'asd@asd', 'asd@asd', 'asdasd', 0, 0),
(20, 'asdasd2@asd', 'asdasd2@asd', 'asdasd', 0, 0),
(21, 'asdasd@asaaa', 'asdasd@asaaa', 'asdasd@asaaa', 0, 0),
(22, 'dasdasd@aqsedas', 'dasdasd@aqsedas', 'asdas', 0, 0),
(23, 'asda@asds', 'asda@asds', 'asda', 0, 0),
(24, 'dasd@asdasdasd', 'dasd@asdasdasd', 'asdas', 0, 0),
(25, 'branch1@branch1', 'branch1@branch1', 'branch1', 0, 0);

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
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_records`
--
ALTER TABLE `order_records`
  MODIFY `order_record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

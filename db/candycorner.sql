-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2023 at 03:42 PM
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
(1, 'Bulk chocolate', 0),
(2, 'Bulk Gummies', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `order_cancel_records`
--

CREATE TABLE `order_cancel_records` (
  `order_cancel_record_id` int(11) NOT NULL,
  `order_cancel_record_user_id` int(11) NOT NULL,
  `order_cancel_record_reason` text NOT NULL,
  `order_cancel_record_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `order_cancel_record_type` tinyint(4) NOT NULL DEFAULT 0,
  `order_cancel_record_order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
(1, 'Sconza Milk almmond', 1, 'Sconza Milk almmond	', '100', 1),
(2, 'Ce000395', 1, 'Sconza Milk almond', '150', 0),
(3, 'Ce000390', 1, 'Sconza Dark almond', '150', 0),
(4, 'Ce000399', 1, 'Sconza Milk raisins', '150', 0),
(5, 'Ce000394', 1, 'Sconza Dark raisins', '150', 0),
(6, 'Ce000393', 1, 'Sconza Dark maltballs', '150', 0),
(7, 'Ce000391', 1, 'Sconza Dark Espreso beans', '150', 0),
(8, 'Ce000467', 1, 'Kimmie Chocorocks ', '150', 0),
(9, 'Ce000468', 1, 'Kimmie Chocorocks gemstone', '150', 0),
(10, 'Ce000465', 1, 'Kimmie Choco boulders', '150', 0),
(11, 'Ce000470', 1, 'Kimmie Sun flower seeds', '150', 0),
(12, 'Ce000468', 1, 'Kimmie Chocorock caramel', '150', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pullout_records`
--

CREATE TABLE `pullout_records` (
  `pullout_records_id` int(11) NOT NULL,
  `pullout_records_user_id` int(11) NOT NULL,
  `pullout_records_prod_id` int(11) NOT NULL,
  `pullout_records_qty` int(11) NOT NULL,
  `pullout_records_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_delivery`
--

CREATE TABLE `request_delivery` (
  `request_delivery_id` int(11) NOT NULL,
  `request_delivery_user_id` int(11) NOT NULL,
  `request_delivery_request_id` int(11) NOT NULL,
  `request_delivery_date` date NOT NULL,
  `request_delivery_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
(25, 'branch1@branch1', 'branch1@branch1', 'branch1', 0, 2),
(26, 'checker@checker', 'checker@checker', 'Checker', 1, 0),
(27, 'mr.ephraiel@gmail.com', 'mr.ephraiel@gmail.com', 'tester', 0, 2),
(28, 'aasd@adasd', 'aasd@adasd', 'aasd@adasd', 0, 2),
(29, 'name1@name1', 'name1@name1', 'name1', 0, 2),
(30, 'asd@aaa', 'admin@admin', 'test', 0, 0);

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
-- Indexes for table `order_cancel_records`
--
ALTER TABLE `order_cancel_records`
  ADD PRIMARY KEY (`order_cancel_record_id`);

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
-- Indexes for table `pullout_records`
--
ALTER TABLE `pullout_records`
  ADD PRIMARY KEY (`pullout_records_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `request_delivery`
--
ALTER TABLE `request_delivery`
  ADD PRIMARY KEY (`request_delivery_id`);

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
  MODIFY `cart_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory_records`
--
ALTER TABLE `inventory_records`
  MODIFY `inventory_record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_cancel_records`
--
ALTER TABLE `order_cancel_records`
  MODIFY `order_cancel_record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_records`
--
ALTER TABLE `order_records`
  MODIFY `order_record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pullout_records`
--
ALTER TABLE `pullout_records`
  MODIFY `pullout_records_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_delivery`
--
ALTER TABLE `request_delivery`
  MODIFY `request_delivery_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2024 at 06:30 PM
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
-- Database: `bedok_85_nus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `s_user_id` int(11) NOT NULL,
  `stall_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`s_user_id`, `stall_id`) VALUES
(4, 1),
(5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `credit_card`
--

CREATE TABLE `credit_card` (
  `credit_card_id` int(11) NOT NULL,
  `c_user_id` int(11) NOT NULL,
  `credit_card_no` varchar(40) DEFAULT NULL,
  `card_name` varchar(40) DEFAULT NULL,
  `cv2` varchar(10) DEFAULT NULL,
  `expiry_date` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `credit_card`
--

INSERT INTO `credit_card` (`credit_card_id`, `c_user_id`, `credit_card_no`, `card_name`, `cv2`, `expiry_date`) VALUES
(1, 1, '1234567890123456', 'John Calvin', '123', '12/23');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_user_id` int(11) NOT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_user_id`, `first_name`, `last_name`) VALUES
(1, 'john', 'calvin');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_address`
--

CREATE TABLE `delivery_address` (
  `delivery_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(11) NOT NULL,
  `stall_id` int(11) NOT NULL,
  `food_name` varchar(20) DEFAULT NULL,
  `food_description` varchar(20) DEFAULT NULL,
  `food_price` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `stall_id`, `food_name`, `food_description`, `food_price`) VALUES
(1, 1, 'Bak Chor Mee (Small)', 'Small Bak Chor Mee', 3.00),
(1, 2, 'BBQ Wings', 'BBQ Wings', 1.40),
(2, 1, 'Bak Chor Mee (Large)', 'Large Bak Chor Mee', 4.00),
(2, 2, 'Satay', 'Satay', 0.80);

-- --------------------------------------------------------

--
-- Table structure for table `item_preference`
--

CREATE TABLE `item_preference` (
  `order_item_id` int(11) NOT NULL,
  `food_preference` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_preference`
--

INSERT INTO `item_preference` (`order_item_id`, `food_preference`) VALUES
(142, 'Add Mee Pok'),
(142, 'Mee Kia'),
(142, 'Soup'),
(143, 'Lime'),
(143, 'No chilli'),
(144, 'Add bbq sauce'),
(144, 'Add satay sauce'),
(144, 'Mutton'),
(145, 'Add Mee Pok'),
(145, 'Mee Kia'),
(145, 'Soup'),
(146, 'Chilli'),
(146, 'No Lime'),
(147, 'Add Mee Pok'),
(147, 'Mee Kia'),
(147, 'Soup'),
(148, 'Chilli'),
(148, 'No Lime'),
(149, 'Add Mee Pok'),
(149, 'Mee Kia'),
(149, 'Soup'),
(150, 'Chilli'),
(150, 'No Lime'),
(151, 'Add Mee Pok'),
(151, 'Mee Kia'),
(151, 'Soup'),
(152, 'Chilli'),
(152, 'No Lime'),
(153, 'Add Mee Pok'),
(153, 'Mee Kia'),
(153, 'Soup'),
(154, 'Chilli'),
(154, 'No Lime'),
(155, 'Add Mee Pok'),
(155, 'Mee Kia'),
(155, 'Soup'),
(156, 'Chilli'),
(156, 'No Lime'),
(157, 'Add Mee Pok'),
(157, 'Mee Kia'),
(157, 'Soup'),
(158, 'Chilli'),
(158, 'No Lime'),
(159, 'Add Mee Pok'),
(159, 'Mee Kia'),
(159, 'Soup'),
(160, 'Chilli'),
(160, 'No Lime'),
(161, 'Add Mee Pok'),
(161, 'Mee Kia'),
(161, 'Soup'),
(162, 'Chilli'),
(162, 'No Lime'),
(163, 'Add Mee Pok'),
(163, 'Mee Kia'),
(163, 'Soup'),
(164, 'Chilli'),
(164, 'No Lime'),
(165, 'Add Mee Pok'),
(165, 'Mee Kia'),
(165, 'Soup'),
(166, 'Chilli'),
(166, 'No Lime'),
(167, 'Add Mee Pok'),
(167, 'Mee Kia'),
(167, 'Soup'),
(168, 'Chilli'),
(168, 'No Lime');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `datetime_ordered` datetime DEFAULT NULL,
  `datetime_ended` datetime DEFAULT NULL,
  `order_cost` decimal(8,2) DEFAULT NULL,
  `collection_mode` enum('Self-pickup','Delivery') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `customer_id`, `datetime_ordered`, `datetime_ended`, `order_cost`, `collection_mode`) VALUES
(76, 1, '2024-04-06 08:37:19', NULL, 16.90, 'Self-pickup'),
(77, 1, '2024-04-06 11:26:28', NULL, 6.30, 'Self-pickup'),
(78, 1, '2024-04-06 11:26:49', NULL, 6.30, 'Self-pickup'),
(79, 1, '2024-04-06 11:27:25', NULL, 6.30, 'Self-pickup'),
(80, 1, '2024-04-06 11:28:56', NULL, 6.30, 'Self-pickup'),
(81, 1, '2024-04-06 11:29:04', NULL, 6.30, 'Self-pickup'),
(82, 1, '2024-04-06 11:31:45', NULL, 6.30, 'Self-pickup'),
(83, 1, '2024-04-06 11:32:44', NULL, 6.30, 'Self-pickup'),
(84, 1, '2024-04-06 11:47:31', NULL, 6.30, 'Self-pickup'),
(85, 1, '2024-04-06 11:48:44', NULL, 6.30, 'Self-pickup'),
(86, 1, '2024-04-06 11:50:02', NULL, 6.30, 'Self-pickup'),
(87, 1, '2024-04-06 11:54:24', NULL, 6.30, 'Self-pickup'),
(88, 1, '2024-04-06 11:55:36', NULL, 6.30, 'Self-pickup');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `stall_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `item_cost` decimal(8,2) DEFAULT NULL,
  `special_instruction` varchar(100) DEFAULT NULL,
  `order_status` enum('Pending','Confirmed','Ready','Completed','Cancelled') DEFAULT NULL,
  `stall_comment` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_id`, `food_id`, `stall_id`, `quantity`, `item_cost`, `special_instruction`, `order_status`, `stall_comment`) VALUES
(142, 76, 1, 1, 3, 10.50, 'special instruction 1', 'Pending', NULL),
(143, 76, 1, 2, 4, 5.60, 'special instruction 2', 'Pending', NULL),
(144, 76, 2, 2, 1, 0.80, 'special instruction 3', 'Pending', NULL),
(145, 77, 1, 1, 1, 3.50, 'sdfsdf', 'Pending', NULL),
(146, 77, 1, 2, 2, 2.80, 'dsfd', 'Pending', NULL),
(147, 78, 1, 1, 1, 3.50, 'sdfsdf', 'Pending', NULL),
(148, 78, 1, 2, 2, 2.80, 'dsfd', 'Pending', NULL),
(149, 79, 1, 1, 1, 3.50, 'sdfsdf', 'Pending', NULL),
(150, 79, 1, 2, 2, 2.80, 'dsfd', 'Pending', NULL),
(151, 80, 1, 1, 1, 3.50, 'sdfsdf', 'Pending', NULL),
(152, 80, 1, 2, 2, 2.80, 'dsfd', 'Pending', NULL),
(153, 81, 1, 1, 1, 3.50, 'sdfsdf', 'Pending', NULL),
(154, 81, 1, 2, 2, 2.80, 'dsfd', 'Pending', NULL),
(155, 82, 1, 1, 1, 3.50, 'sdfsdf', 'Pending', NULL),
(156, 82, 1, 2, 2, 2.80, 'dsfd', 'Pending', NULL),
(157, 83, 1, 1, 1, 3.50, 'sdfsdf', 'Pending', NULL),
(158, 83, 1, 2, 2, 2.80, 'dsfd', 'Pending', NULL),
(159, 84, 1, 1, 1, 3.50, 'sdfsdf', 'Pending', NULL),
(160, 84, 1, 2, 2, 2.80, 'dsfd', 'Pending', NULL),
(161, 85, 1, 1, 1, 3.50, 'sdfsdf', 'Pending', NULL),
(162, 85, 1, 2, 2, 2.80, 'dsfd', 'Pending', NULL),
(163, 86, 1, 1, 1, 3.50, 'sdfsdf', 'Pending', NULL),
(164, 86, 1, 2, 2, 2.80, 'dsfd', 'Pending', NULL),
(165, 87, 1, 1, 1, 3.50, 'sdfsdf', 'Pending', NULL),
(166, 87, 1, 2, 2, 2.80, 'dsfd', 'Pending', NULL),
(167, 88, 1, 1, 1, 3.50, 'sdfsdf', 'Pending', NULL),
(168, 88, 1, 2, 2, 2.80, 'dsfd', 'Pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stall`
--

CREATE TABLE `stall` (
  `stall_id` int(11) NOT NULL,
  `stall_name` varchar(50) DEFAULT NULL,
  `unit_no` varchar(10) DEFAULT NULL,
  `open_status` bit(1) DEFAULT NULL,
  `announcement` varchar(1000) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `opening_hour_start` datetime DEFAULT NULL,
  `opening_hour_end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stall`
--

INSERT INTO `stall` (`stall_id`, `stall_name`, `unit_no`, `open_status`, `announcement`, `description`, `opening_hour_start`, `opening_hour_end`) VALUES
(1, 'Xing Ji Rou Cuo Mian', '#01-07', b'1', 'This is XJRCM!!!!', 'ssdsfsdfsdfsfdsf', '2014-04-01 07:00:00', '2034-09-05 00:00:00'),
(2, 'Sin BBQ', ' #01-12', b'1', 'We sell very nice BBQ wings and satay. YOYOYOYOYO.', 'We sell very nice BBQ wings and satay. JEWEL!!!', '2014-04-05 13:00:00', '2033-04-05 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `user_type` enum('customer','stall') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `contact_no`, `email`, `address`, `user_type`) VALUES
(1, 'customer1', 'password1', '81234567', 'jannaiheng@hotmail.com', 'Yishun Avenue 1', 'customer'),
(4, 'admin_1', 'password1', '81234567', 'xjrcm@hotmail.com', '85, #01-07 Bedok North Rd, 460085', 'stall'),
(5, 'admin_2', 'password1', '81234567', 'sbbq@hotmail.com', '85 Bedok North Street 4, #01-12', 'stall');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`s_user_id`),
  ADD KEY `admin_ibfk_2` (`stall_id`);

--
-- Indexes for table `credit_card`
--
ALTER TABLE `credit_card`
  ADD PRIMARY KEY (`credit_card_id`),
  ADD KEY `credit_card_ibfk_1` (`c_user_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_user_id`);

--
-- Indexes for table `delivery_address`
--
ALTER TABLE `delivery_address`
  ADD PRIMARY KEY (`delivery_id`),
  ADD KEY `deliver_address_ibfk_1` (`order_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`,`stall_id`),
  ADD KEY `food_ibfk_1` (`stall_id`);

--
-- Indexes for table `item_preference`
--
ALTER TABLE `item_preference`
  ADD PRIMARY KEY (`order_item_id`,`food_preference`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_ibfk_1` (`customer_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_item_ibfk_1` (`order_id`),
  ADD KEY `order_item_ibfk_2` (`food_id`),
  ADD KEY `order_item_ibfk_3` (`stall_id`);

--
-- Indexes for table `stall`
--
ALTER TABLE `stall`
  ADD PRIMARY KEY (`stall_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `credit_card`
--
ALTER TABLE `credit_card`
  MODIFY `credit_card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_address`
--
ALTER TABLE `delivery_address`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `stall`
--
ALTER TABLE `stall`
  MODIFY `stall_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`s_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `admin_ibfk_2` FOREIGN KEY (`stall_id`) REFERENCES `stall` (`stall_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `credit_card`
--
ALTER TABLE `credit_card`
  ADD CONSTRAINT `credit_card_ibfk_1` FOREIGN KEY (`c_user_id`) REFERENCES `customer` (`c_user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`c_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `delivery_address`
--
ALTER TABLE `delivery_address`
  ADD CONSTRAINT `delivery_address_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`stall_id`) REFERENCES `stall` (`stall_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_preference`
--
ALTER TABLE `item_preference`
  ADD CONSTRAINT `item_preference_ibfk_1` FOREIGN KEY (`order_item_id`) REFERENCES `order_item` (`order_item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`c_user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `food` (`food_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_item_ibfk_3` FOREIGN KEY (`stall_id`) REFERENCES `food` (`stall_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

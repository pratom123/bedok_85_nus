-- phpMyAdmin SQL Dump
-- version 4.0.10deb1ubuntu0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 10, 2021 at 10:35 AM
-- Server version: 5.5.62-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bedok_85`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE IF NOT EXISTS `order_items` (
  `order_item_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `dish_id` tinyint(3) unsigned NOT NULL,
  `stall_id` tinyint(3) unsigned NOT NULL,
  `collection_mode` enum('Self-pickup','Delivery') NOT NULL,
  `order_status` enum('Cooking','Ready','Collected','Delivering','Delivered','Cancelled') DEFAULT NULL,
  `remark` varchar(1000) DEFAULT NULL,
  `item_pref` varchar(50) DEFAULT NULL,
  `item_quantity` int(10) unsigned DEFAULT NULL,
  `item_price` float(6,2) DEFAULT NULL,
  PRIMARY KEY (`order_item_id`),
  KEY `account_id` (`account_id`),
  KEY `order_id` (`order_id`),
  KEY `dish_id` (`dish_id`),
  KEY `stall_id` (`stall_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `account_id`, `order_id`, `dish_id`, `stall_id`, `collection_mode`, `order_status`, `remark`, `item_pref`, `item_quantity`, `item_price`) VALUES
(48, 1, 38, 3, 2, 'Delivery', 'Cooking', '', 'Chilli.No Lime.12dasdsada', 1, 1.40),
(49, 1, 38, 4, 2, 'Delivery', 'Cooking', '', 'Chicken.Add satay sauce.Add bbq sauce.asdasdsadsa', 4, 3.20),
(50, 1, 38, 4, 2, 'Delivery', 'Cooking', '', 'Chicken.Add satay sauce.Add bbq sauce', 5, 4.00),
(51, 1, 39, 1, 1, 'Self-pickup', 'Delivered', '', 'Mee Kia.Soup.Add Mee Pok.Add Mee Kia', 5, 20.00),
(52, 1, 39, 2, 1, 'Self-pickup', 'Delivered', '', 'Mee Kia.Soup.Add Mee Pok.Add Mee Kia', 1, 5.00),
(53, 1, 40, 1, 1, 'Self-pickup', 'Cooking', '', 'Mee Kia.Soup.Add Mee Pok.Add Mee Kia.Add Meat', 4, 20.00),
(54, 1, 40, 4, 2, 'Self-pickup', 'Cooking', '', 'Chicken.Add satay sauce.Add bbq sauce.dasdas', 2, 1.60),
(55, 1, 41, 3, 2, 'Delivery', 'Collected', 'Sold out.', 'Chilli.No Lime', 4, 5.60),
(56, 1, 42, 1, 1, 'Delivery', 'Cooking', '', 'Mee Pok.Dry.Add Mee Pok.Add Mee Kia.sdsfsfsdfdsfds', 4, 16.00),
(57, 1, 42, 4, 2, 'Delivery', 'Cooking', '', 'Chicken.Add satay sauce.Add bbq sauce.sfdsfdsfds', 5, 4.00),
(58, 1, 43, 1, 1, 'Delivery', 'Cooking', '', 'Mee Kia.Soup.Add Mee Pok.Add Mee Kia.sdfasfsaf', 4, 16.00),
(59, 1, 43, 4, 2, 'Delivery', 'Cooking', '', 'Chicken.Add bbq sauce.dsfdsfdsf', 1, 0.80),
(60, 1, 43, 3, 2, 'Delivery', 'Cooking', '', 'No chilli.Lime.sdfdsfsdfsfsfsf', 4, 5.60),
(61, 1, 43, 2, 1, 'Delivery', 'Cooking', '', 'Mee Kia.Dry.Add Mee Pok.Add Mee Kia.dfdsfsdsfdfs', 1, 5.00),
(62, 1, 44, 1, 1, 'Self-pickup', 'Delivered', '', 'Mee Pok.Dry.Add Mee Pok.Add Mee Kia.sdfdsfsdf', 3, 12.00),
(63, 1, 45, 1, 1, 'Delivery', 'Cooking', '', 'Mee Kia.Soup.Add Mee Pok.Add Mee Kia', 4, 16.00),
(64, 1, 46, 1, 1, 'Delivery', 'Cooking', '', 'Mee Pok.Dry.Add Mee Pok.Add Mee Kia', 5, 20.00),
(65, 1, 47, 3, 2, 'Delivery', 'Delivered', '', 'No chilli.Lime.faefskfjsdiofs', 7, 9.80),
(66, 1, 48, 4, 2, 'Delivery', 'Delivering', '', 'Chicken.Add satay sauce.Add bbq sauce.dhvfosjfsodj', 4, 3.20),
(67, 1, 49, 4, 2, 'Delivery', 'Cooking', '', 'Mutton.Add satay sauce', 3, 2.40);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `Account_information` (`account_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_3` FOREIGN KEY (`dish_id`) REFERENCES `dishes` (`dish_id`),
  ADD CONSTRAINT `order_items_ibfk_4` FOREIGN KEY (`stall_id`) REFERENCES `stalls` (`stall_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

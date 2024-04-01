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
-- Table structure for table `delivery_address`
--

CREATE TABLE IF NOT EXISTS `delivery_address` (
  `delivery_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`delivery_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `delivery_address`
--

INSERT INTO `delivery_address` (`delivery_id`, `order_id`, `address`) VALUES
(7, 38, 'Nanyang'),
(8, 39, ''),
(9, 40, ''),
(10, 41, 'Nanyang Avenue'),
(11, 42, 'Clementi Avenue'),
(12, 43, 'Tampines 1 Blk 201'),
(13, 44, ''),
(14, 45, 'difmpon'),
(15, 46, '201 Jalan Loyang Besar #03-02'),
(16, 47, '201 Jalan Loyang Besar #03-02'),
(17, 48, 'nfdnsngkdns'),
(18, 49, 'Tampines St 81');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery_address`
--
ALTER TABLE `delivery_address`
  ADD CONSTRAINT `delivery_address_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

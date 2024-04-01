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
-- Table structure for table `dishes`
--

CREATE TABLE IF NOT EXISTS `dishes` (
  `dish_id` tinyint(3) unsigned NOT NULL,
  `dish_name` varchar(50) NOT NULL,
  `stall_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`dish_id`),
  KEY `stall_id` (`stall_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dishes`
--

INSERT INTO `dishes` (`dish_id`, `dish_name`, `stall_id`) VALUES
(1, 'Bak Chor Mee (Small)', 1),
(2, 'Bak Chor Mee (Large)', 1),
(3, 'BBQ Wings', 2),
(4, 'Satay', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dishes`
--
ALTER TABLE `dishes`
  ADD CONSTRAINT `dishes_ibfk_1` FOREIGN KEY (`stall_id`) REFERENCES `stalls` (`stall_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

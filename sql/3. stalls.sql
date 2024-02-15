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
-- Table structure for table `stalls`
--

CREATE TABLE IF NOT EXISTS `stalls` (
  `stall_id` tinyint(3) unsigned NOT NULL,
  `stall_name` varchar(50) NOT NULL,
  `announcement` varchar(1000) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `opening_hour` varchar(50) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `unit_no` varchar(10) DEFAULT NULL,
  `open_status` bit(1) NOT NULL,
  PRIMARY KEY (`stall_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stalls`
--

INSERT INTO `stalls` (`stall_id`, `stall_name`, `announcement`, `description`, `opening_hour`, `contact_no`, `unit_no`, `open_status`) VALUES
(1, 'Xing Ji Rou Cuo Mian', 'This is XJRCM!!!!', 'ssdsfsdfsdfsfdsf', 'sdsdsad', '+65123456', '#01-01', b'1'),
(2, 'Sin BBQ', 'We sell very nice BBQ wings and satay. YOYOYOYOYO.', 'We sell very nice BBQ wings and satay. JEWEL!!!', 'Daily (except Tues): 1-5pm.', '+65132456', '#01-02', b'1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
-- Table structure for table `Account_information`
--

CREATE TABLE IF NOT EXISTS `Account_information` (
  `account_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password_info` varchar(40) NOT NULL,
  `e_mail` varchar(40) NOT NULL,
  `mobile_no` int(10) unsigned NOT NULL,
  `Address1` varchar(40) DEFAULT NULL,
  `Address2` varchar(40) DEFAULT NULL,
  `Address3` varchar(40) DEFAULT NULL,
  `credit_card` varchar(40) NOT NULL,
  `card_name` varchar(40) NOT NULL,
  `cv2` varchar(40) NOT NULL,
  `expirydate` varchar(40) NOT NULL,
  `admin` bit(1) NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Account_information`
--

INSERT INTO `Account_information` (`account_id`, `firstname`, `lastname`, `username`, `password_info`, `e_mail`, `mobile_no`, `Address1`, `Address2`, `Address3`, `credit_card`, `card_name`, `cv2`, `expirydate`, `admin`) VALUES
(1, 'Jannai', 'Heng', 'JHENG016', '123', 'jannaiheng@hotmail.com', 86519663, '201 Jalan Loyang Besar #03-02', 'Nanyang Avenue', 'Tampines St 81', '1234567890123456', 'Jannai Heng', '123', '12/23', b'0'),
(2, 'Jannai', 'Heng', 'admin_1', '123', 'jannaiheng@hotmail.com', 86519663, '201 Jalan Loyang Besar #03-02', 'dsadfsf', NULL, '1234567890123456', 'sdfsdf', '123', '12/23', b'1'),
(4, '', '', 'admin_2', '123', '', 81234567, NULL, NULL, NULL, '', '', '', '', b'1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

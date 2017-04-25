-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 30, 2013 at 05:23 PM
-- Server version: 5.5.31
-- PHP Version: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `qpromo`
--

-- --------------------------------------------------------

--
-- Table structure for table `printing_price`
--

CREATE TABLE IF NOT EXISTS `printing_price` (
  `printing_id` int(11) NOT NULL,
  `colors` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`printing_id`,`colors`,`quantity`),
  KEY `fk_printing` (`printing_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `printing_price`
--

INSERT INTO `printing_price` (`printing_id`, `colors`, `quantity`, `price`) VALUES
(1, 1, 1, 55.00),
(1, 1, 50, 55.00),
(1, 1, 100, 45.00),
(1, 1, 250, 45.00),
(1, 1, 500, 45.00),
(1, 1, 1000, 45.00),
(1, 1, 2500, 45.00),
(1, 1, 5000, 45.00),
(1, 1, 10000, 45.00),
(1, 2, 1, 65.00),
(1, 2, 50, 65.00),
(1, 2, 100, 65.00),
(1, 2, 250, 65.00),
(1, 2, 500, 65.00),
(1, 2, 1000, 65.00),
(1, 2, 2500, 65.00),
(1, 2, 5000, 65.00),
(1, 2, 10000, 65.00),
(1, 3, 1, 100.00),
(1, 3, 50, 100.00),
(1, 3, 100, 90.00),
(1, 3, 250, 90.00),
(1, 3, 500, 90.00),
(1, 3, 1000, 90.00),
(1, 3, 2500, 90.00),
(1, 3, 5000, 90.00),
(1, 3, 10000, 90.00),
(1, 4, 1, 150.00),
(1, 4, 50, 150.00),
(1, 4, 100, 135.00),
(1, 4, 250, 135.00),
(1, 4, 500, 135.00),
(1, 4, 1000, 135.00),
(1, 4, 2500, 135.00),
(1, 4, 5000, 135.00),
(1, 4, 10000, 135.00),
(2, 0, 1, 270.00),
(2, 0, 50, 270.00),
(2, 0, 100, 255.00),
(2, 0, 250, 255.00),
(2, 0, 500, 255.00),
(2, 0, 1000, 255.00),
(2, 0, 2500, 255.00),
(2, 0, 5000, 255.00),
(2, 0, 10000, 255.00),
(3, 0, 1, 55.00),
(3, 0, 50, 55.00),
(3, 0, 100, 45.00),
(3, 0, 250, 45.00),
(3, 0, 500, 45.00),
(3, 0, 1000, 45.00),
(3, 0, 2500, 45.00),
(3, 0, 5000, 45.00),
(3, 0, 10000, 45.00),
(4, 0, 1, 0.00),
(5, 0, 1, 0.00),
(6, 0, 1, 0.00);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `printing_price`
--
ALTER TABLE `printing_price`
  ADD CONSTRAINT `fk_printing` FOREIGN KEY (`printing_id`) REFERENCES `printing` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

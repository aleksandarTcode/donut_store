-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 27, 2022 at 07:10 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sweethouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

DROP TABLE IF EXISTS `offers`;
CREATE TABLE IF NOT EXISTS `offers` (
  `idP` int(11) NOT NULL,
  `product` varchar(45) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`idP`, `product`) VALUES
(1, 'Medium donut  with nutella'),
(2, 'Small donut  with twix'),
(3, 'Big donut  with plazma and coconut');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `idN` int(11) NOT NULL AUTO_INCREMENT,
  `buyer` varchar(45) COLLATE utf8_bin NOT NULL,
  `offer` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(45) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idN`),
  KEY `buyers` (`buyer`),
  KEY `offers` (`offer`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`idN`, `buyer`, `offer`, `date`, `status`) VALUES
(1, 'su', 2, '2021-02-10', 'Accepted'),
(2, 'jake', 1, '2021-02-16', 'Unprocessed');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(45) COLLATE utf8_bin NOT NULL,
  `password` varchar(45) COLLATE utf8_bin NOT NULL,
  `name` varchar(45) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(45) COLLATE utf8_bin NOT NULL,
  `role` varchar(45) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `name`, `lastname`, `role`) VALUES
('jake', 'jake123', 'Jackob', 'Jackobsen', 'buyer'),
('joe', 'john123', 'John', 'Johnson', 'worker'),
('su', 'su123', 'Susan', 'Williams', 'buyer');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `buyer` FOREIGN KEY (`buyer`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `offers` FOREIGN KEY (`offer`) REFERENCES `offers` (`idP`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 21, 2022 at 08:02 AM
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
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idB` int(11) NOT NULL,
  `item` varchar(100) COLLATE utf16_unicode_ci NOT NULL,
  `address` varchar(45) COLLATE utf16_unicode_ci NOT NULL,
  `payment_method` varchar(45) COLLATE utf16_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `status` varchar(45) COLLATE utf16_unicode_ci NOT NULL DEFAULT 'unprocessed',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `buyer` (`idB`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `idB`, `item`, `address`, `payment_method`, `price`, `status`, `date`) VALUES
(28, 7, 'medium with  nothing', 'new street 123', 'cache', 1.5, 'unprocessed', '2022-11-22 10:10:02'),
(29, 7, 'large with nutella, cherry, plazma, coconut and twix', 'new street 145', 'card', 3.7, 'unprocessed', '2022-11-22 10:11:51'),
(30, 7, 'medium with crumbs', 'new street 1888', 'card', 1.8, 'approved', '2022-11-22 10:12:07'),
(31, 7, 'small with crumbs and twix', 'new street 1888 iid', 'card', 1.6, 'unprocessed', '2022-11-22 10:12:25'),
(32, 8, 'large with plazma and coconut', 'nova 123', 'card', 2.6, 'denied', '2022-11-22 10:13:15'),
(33, 8, 'large with nutella, cherry and plazma', 'nova 321', 'cache', 3.1, 'unprocessed', '2022-11-22 10:13:34'),
(34, 8, 'small with crumbs and twix', 'nova 321556', 'card', 1.6, 'approved', '2022-11-22 10:13:51'),
(35, 7, 'large with nutella, cherry, plazma and coconut', 'new belgrade 222', 'card', 3.4, 'unprocessed', '2022-11-23 09:18:35'),
(44, 7, 'large with nutella', 'new address', 'card', 3, 'unprocessed', '2022-11-25 09:50:02'),
(45, 7, 'large with nutella, plazma, coconut and twix', 'new test address', 'card', 3.3, 'unprocessed', '2022-11-30 07:34:11'),
(46, 16, 'large with cherry, coconut and twix', 'nova adresa 123', 'card', 3, 'unprocessed', '2022-12-14 10:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idB` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) COLLATE utf16_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf16_unicode_ci NOT NULL,
  `firstname` varchar(45) COLLATE utf16_unicode_ci NOT NULL,
  `lastname` varchar(45) COLLATE utf16_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf16_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `role` varchar(45) COLLATE utf16_unicode_ci NOT NULL DEFAULT 'buyer',
  PRIMARY KEY (`idB`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idB`, `username`, `password`, `firstname`, `lastname`, `email`, `age`, `role`) VALUES
(4, 'aca', '$2y$10$MHgB5oWsrtWHn5Ykfu/22.Q.n/isHvRlbemRXgGiHpEmiDk4Q1py.', 'Aleksandar', 'Trmcic', 'aleksandar.trmcic@gmail.com', 32, 'worker'),
(7, 'jake', '$2y$10$1lftX3XoSPSPiJoBHgQtpufKZfbuBgICuAWYRv1t/LKSFXJ1AkRle', 'John', 'Johnson', 'jake@gmail.com', 25, 'buyer'),
(8, 'jane', '$2y$10$FfMi6CyX.ztTJo5FzZdLLuKNXoMokXv/klegjxchwHG36/NvO5a.C', 'Joane', 'Williams', 'jane@gmail.com', 33, 'buyer'),
(12, 'mike', '$2y$10$9lo27fSoTO.qcO8SP8C/Zu3.EVXPd63Vy46RmHym89PkKduGcmF5.', 'Mark', 'James', 'mike@gmail.com', 44, 'buyer'),
(13, 'mon', '$2y$10$9KEzCuo5QEoUtUGsrkjLc.IwssThjS6iWHT23dISG4ti4Oto1Ev9K', 'Monica', 'Smith', 'a_trmcic@hotmail.com', 29, 'buyer'),
(14, 'aco', '$2y$10$gZkUnpgMXfQOhlukZfzHD.wwyiyf3reJ78txzrQlO260HrjT/jz2u', 'dfsg', 'fdg', 'aleksandar.trmcic@hotmail.com', 22, 'buyer'),
(15, '1234', '$2y$10$lpmOzmNMjmvBmapvE/jkXOvplfLx0z8oadtdkPhIxly/B8ekj/tfi', 'sdfsdf', 'sdfsdfsdf', 'aleksandartrmcic@gmail.com', 44, 'buyer'),
(16, 'marko123', '$2y$10$EKfXHlT8KaXodiRTaqmQmOZb917huTsHEGtRXnkJa1wSmTmuJa1dq', 'marko', 'markovic', 'marko123@gmail.com', 22, 'buyer'),
(17, 'mike22', '$2y$10$uCXaQDrpHsYNV9fYFkGW9.pN4zHat9PUWMdDAk2r4w.FIb7m.ak4e', 'marko', 'markovic', 'testingtrmcic@gmail.com', 34, 'buyer');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `buyer` FOREIGN KEY (`idB`) REFERENCES `users` (`idB`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

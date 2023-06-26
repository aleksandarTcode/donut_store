-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 26, 2023 at 01:17 PM
-- Server version: 8.0.31
-- PHP Version: 8.1.13

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
  `id` int NOT NULL AUTO_INCREMENT,
  `idB` int NOT NULL,
  `item` varchar(100) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `address` varchar(45) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `payment_method` varchar(45) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `status` varchar(45) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL DEFAULT 'unprocessed',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stripe_session_id` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `buyer` (`idB`)
) ENGINE=InnoDB AUTO_INCREMENT=184 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `idB`, `item`, `address`, `payment_method`, `price`, `status`, `date`, `stripe_session_id`) VALUES
(179, 29, 'medium with crumbs', 'test address', 'cache', 1.8, 'unprocessed', '2023-06-26 13:13:15', NULL),
(180, 29, 'small with crumbs and twix', 'some address', 'stripe', 1.6, 'unprocessed and paid', '2023-06-26 13:13:38', 'cs_test_a1lLpIAwGjYPAFUVjHkNzVu1jNZ7AR9yJ8T16xFFRtQZ07uaXwmNSUj9Qk'),
(181, 29, 'large with cherry, plazma and coconut', 'new address', 'cache', 3, 'unprocessed', '2023-06-26 13:14:50', NULL),
(182, 7, 'small with nothing', 'My Address', 'cache', 1, 'unprocessed', '2023-06-26 13:15:44', NULL),
(183, 7, 'large with plazma and coconut', 'My New Address', 'stripe', 2.6, 'unprocessed and paid', '2023-06-26 13:16:06', 'cs_test_a14sWRzcw6rXcXJYJSiF8MIxDMQndwxVpjCDOdEaGkLvCgVmjygcb9ZbNE');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idB` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `firstname` varchar(45) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `lastname` varchar(45) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `email` varchar(45) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `age` int NOT NULL,
  `role` varchar(45) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL DEFAULT 'buyer',
  PRIMARY KEY (`idB`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idB`, `username`, `password`, `firstname`, `lastname`, `email`, `age`, `role`) VALUES
(4, 'aca', '$2y$10$b2VMQPrGDLPwLt8EyCrAe.ExGX4twqhJE9NflxcrxrRJ.dKhBmrNu', 'Aleksandar', 'Trmcic', 'aleksandar.trmcic@gmail.com', 32, 'worker'),
(7, 'jake', '$2y$10$b2VMQPrGDLPwLt8EyCrAe.ExGX4twqhJE9NflxcrxrRJ.dKhBmrNu', 'John', 'Johnson', 'jake@gmail.com', 25, 'buyer'),
(8, 'jane', '$2y$10$b2VMQPrGDLPwLt8EyCrAe.ExGX4twqhJE9NflxcrxrRJ.dKhBmrNu', 'Joane', 'Williams', 'jane@gmail.com', 33, 'buyer'),
(12, 'mike', '$2y$10$b2VMQPrGDLPwLt8EyCrAe.ExGX4twqhJE9NflxcrxrRJ.dKhBmrNu', 'Mark', 'James', 'mike@gmail.com', 44, 'buyer'),
(13, 'mon', '$2y$10$b2VMQPrGDLPwLt8EyCrAe.ExGX4twqhJE9NflxcrxrRJ.dKhBmrNu', 'Monica', 'Smith', 'a_trmcic@hotmail.com', 29, 'buyer'),
(14, 'aco', '$2y$10$b2VMQPrGDLPwLt8EyCrAe.ExGX4twqhJE9NflxcrxrRJ.dKhBmrNu', 'dfsg', 'fdg', 'aleksandar.trmcic@hotmail.com', 22, 'buyer'),
(15, '1234', '$2y$10$b2VMQPrGDLPwLt8EyCrAe.ExGX4twqhJE9NflxcrxrRJ.dKhBmrNu', 'sdfsdf', 'sdfsdfsdf', 'aleksandartrmcic@gmail.com', 44, 'buyer'),
(16, 'marko123', '$2y$10$b2VMQPrGDLPwLt8EyCrAe.ExGX4twqhJE9NflxcrxrRJ.dKhBmrNu', 'marko', 'markovic', 'marko123@gmail.com', 22, 'buyer'),
(17, 'mike22', '$2y$10$b2VMQPrGDLPwLt8EyCrAe.ExGX4twqhJE9NflxcrxrRJ.dKhBmrNu', 'marko', 'markovic', 'testinggtrmcic@gmail.com', 34, 'buyer'),
(18, 'aco2', '$2y$10$b2VMQPrGDLPwLt8EyCrAe.ExGX4twqhJE9NflxcrxrRJ.dKhBmrNu', 'Aleksandar', 'Trmcic', 'aleksandar.trmcic2@gmail.com', 32, 'buyer'),
(29, 'test', '$2y$10$b2VMQPrGDLPwLt8EyCrAe.ExGX4twqhJE9NflxcrxrRJ.dKhBmrNu', 'test', 'test', 'test@gmail.com', 22, 'buyer');

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

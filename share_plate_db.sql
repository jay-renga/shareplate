-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 18, 2025 at 05:46 PM
-- Server version: 5.6.51
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `share_plate_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `food_items`
--

DROP TABLE IF EXISTS `food_items`;
CREATE TABLE IF NOT EXISTS `food_items` (
  `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_on` datetime NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `contact_phone` varchar(25) NOT NULL,
  `time_of_preparation` time NOT NULL,
  `photo` varchar(225) DEFAULT NULL,
  `location` text NOT NULL,
  `message` text,
  `quantity` varchar(25) NOT NULL,
  `req_quantity` int(10) NOT NULL DEFAULT '0',
  `type_of_food` varchar(25) DEFAULT NULL,
  `lat` varchar(10) DEFAULT NULL,
  `longi` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_items`
--

INSERT INTO `food_items` (`id`, `created_on`, `contact_name`, `contact_phone`, `time_of_preparation`, `photo`, `location`, `message`, `quantity`, `req_quantity`, `type_of_food`, `lat`, `longi`) VALUES
(61, '2025-04-16 11:01:59', 'Vimala', '9123456789', '16:31:00', 'uploads/84a721cb-0bdf-473b-842a-2c294c65b028.jpg', 'Vanimahal, chennai', '', '565', 560, 'italian ', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE IF NOT EXISTS `requests` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `food_id` bigint(10) NOT NULL,
  `name` varchar(225) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `posted_on` datetime NOT NULL,
  `req_qty` int(10) NOT NULL DEFAULT '0',
  `location` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `food_id`, `name`, `phone`, `message`, `posted_on`, `req_qty`, `location`) VALUES
(1, 18, 'Vimala', '343534', 'we need it, but unable to pickup up can one can help', '2024-06-12 19:36:07', 0, ''),
(2, 18, 'Raman ', '7395434', 'gdfsg dsfg dfgdf sdfg sdfgsdfg dsfgsdf gdf\r\ndfgdfg \r\nf sfdg', '2024-06-12 19:36:33', 0, ''),
(3, 18, 'Raman ', '7395434', 'gdfsg dsfg dfgdf sdfg sdfgsdfg dsfgsdf gdf\r\ndfgdfg \r\nf sfdg', '2024-06-12 19:36:56', 0, ''),
(4, 18, 'Raman ', '7395434', 'gdfsg dsfg dfgdf sdfg sdfgsdfg dsfgsdf gdf\r\ndfgdfg \r\nf sfdg', '2024-06-12 19:37:28', 0, ''),
(5, 18, 'Raman ', '7395434', 'gdfsg dsfg dfgdf sdfg sdfgsdfg dsfgsdf gdf\r\ndfgdfg \r\nf sfdg', '2024-06-12 19:38:48', 0, ''),
(6, 18, 'rerw', '890890', 'd dfdg df fdg df gdfdfg d', '2024-06-13 02:10:59', 0, ''),
(7, 25, 'Akshara from abc orphanage', 'jwefioewifjeriu', 'fjioewhfiuergyuer', '2024-06-19 14:58:18', 0, ''),
(8, 25, 'Ramanathan', 'ftyryygy', 'jhbubuyub', '2024-06-20 15:56:46', 0, ''),
(9, 30, 'Vimala', 'jhggjgj', '', '2024-08-30 10:18:12', 0, ''),
(10, 47, 'Vimala', '7395434', '', '2025-01-09 12:24:16', 12, 'al marsa street'),
(16, 48, 'sam', '57989898', 'we are a team of people working as car cleaners ', '2025-01-09 12:55:03', 26, 'Al Quoz'),
(15, 47, 'Ramanathan', '343534', '', '2025-01-09 12:50:39', 20, 'al marsa street'),
(17, 51, 'Karim', '986554332', '', '2025-01-12 15:14:55', 10, 'Dubai'),
(18, 53, 'Vimala', '1234567890', 'no oil', '2025-01-12 16:21:27', 100, 'al marsa street'),
(19, 55, 'jim', 'ftyryygy', 'none', '2025-01-12 17:10:30', 100, 'al marsa street'),
(20, 56, 'Vimala', '1234567890', 'none', '2025-01-12 17:17:33', 150, 'al marsa street'),
(21, 57, 'James Doe', '7395434', 'none', '2025-01-12 17:21:00', 50, 'al marsa street'),
(22, 58, 'James Doe', '445281234', '', '2025-01-13 16:59:52', 150, 'al marsa street'),
(23, 59, 'Ramanathan', '557890234', '', '2025-01-16 06:07:35', 10, 'JBR'),
(24, 60, 'Vimala', '567890023', '', '2025-01-16 06:15:49', 15, 'Dubai Marina'),
(25, 61, 'Ramanathan', 'ftyryygy', '', '2025-04-16 11:02:37', 560, 'al marsa street');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `mobile`, `password`, `created_at`) VALUES
(1, 'john.doe@example.com', 'John Doe', '+11234567890', '6e659deaa85842cdabb5c6305fcc40033ba43772ec00d45c2a3c921741a5e377', '2024-12-25 18:20:30');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 13, 2022 at 10:59 PM
-- Server version: 5.7.36
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ikfstage_metasys`
--

-- --------------------------------------------------------

--
-- Table structure for table `dowonloadform`
--

CREATE TABLE `dowonloadform` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `comapny` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dowonloadform`
--

INSERT INTO `dowonloadform` (`id`, `name`, `email`, `contact`, `comapny`, `created_at`) VALUES
(97, 'Lkendre Lkendre', 'laxmantest2525@gmail.com', '34234234234234', 'Ikf', '2022-11-21 07:54:21'),
(138, 'Laxman kendre', 'wd@ikf.co.in', '848484848484', 'IKF', '2022-12-05 10:08:25'),
(139, 'Adi ', 'aditya.kawankar@ikf.co.in', '8668282906', 'IKF test plz ignore', '2022-12-05 11:31:40'),
(140, 'Laxman Kendre', 'laxman.kendre@ikf.co.in', '8668282906', 'IKF', '2022-12-06 11:33:33'),
(141, 'Shruti', 'shruti.malkar@ikf.co.in', '8888866116', 'IKF', '2022-12-06 13:26:54'),
(142, 'ameya', 'ameyap@metasyssoftware.com', '9022548378', 'testing', '2022-12-07 04:06:01'),
(143, 'ameya', 'ameyap@metasyssoftware.com', '9022548378', 'testing', '2022-12-07 04:36:57'),
(144, 'Shruti', 'shruti.malkar@ikf.co.in', '8888866116', 'IKF', '2022-12-07 05:25:37'),
(145, 'Shruti', 'shruti.malkar@ikf.co.in', '8888866116', 'IKF', '2022-12-07 05:26:13'),
(146, 'ameya', 'ameyap@metasyssoftware.com', '9022548378', 'testing', '2022-12-08 10:05:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dowonloadform`
--
ALTER TABLE `dowonloadform`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dowonloadform`
--
ALTER TABLE `dowonloadform`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2021 at 08:00 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `history`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `story` text NOT NULL,
  `country` varchar(50) NOT NULL,
  `category` varchar(100) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `confirm_email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `confirm_password` varchar(20) NOT NULL,
  `approved` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='keeping information users';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `last_name`, `first_name`, `email`, `confirm_email`, `password`, `confirm_password`, `approved`) VALUES
(1, '920768@swansea.ac.uk', 'Gibson', 'gibson.dzimbiri@gmail.com', 'gibson.dzimbiri@gmail.com', '12', '12', NULL),
(2, 'Dzimbiri', 'Gibson', '', 'gibson.dzi4mbiri@gmail.com', '202cb962ac59075b964b', '123', NULL),
(3, 'Dzimbiri', 'Gibson', '', 'gibson.dzi4mbiri@gmail.com', '202cb962ac59075b964b', '123', NULL),
(4, 'Dzimbiri', 'Gibson', '', 'gibson.dzi4mbiri@gmail.com', '202cb962ac59075b964b', '123', NULL),
(5, 'Dzimbiri', 'Gibson', '', 'gibson.dzi4mbiri@gmail.com', '202cb962ac59075b964b', '123', NULL),
(6, 'Dzimbiri', 'Gibson', '', 'gibson.dzi4mbiri@gmail.com', '202cb962ac59075b964b', '123', NULL),
(7, 'Dzimbiri', 'Gibson', '', 'gibson.dzi4mbiri@gmail.com', '202cb962ac59075b964b', '123', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`) USING HASH;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

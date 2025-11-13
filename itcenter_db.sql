-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2025 at 08:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itcenter_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `itcenter_schedule`
--

CREATE TABLE `itcenter_schedule` (
  `id` int(11) NOT NULL,
  `day_of_week` varchar(10) NOT NULL,
  `opening_time` time NOT NULL,
  `closing_time` time NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Closed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `itcenter_schedule`
--

INSERT INTO `itcenter_schedule` (`id`, `day_of_week`, `opening_time`, `closing_time`, `status`) VALUES
(1, 'Monday', '08:30:00', '19:00:00', 'Closed'),
(2, 'Tuesday', '08:30:00', '19:00:00', 'Open'),
(3, 'Wednesday', '08:30:00', '19:00:00', 'Open'),
(4, 'Thursday', '08:30:00', '19:00:00', 'Closed'),
(5, 'Friday', '08:30:00', '19:00:00', 'Closed'),
(6, 'Saturday', '09:00:00', '17:00:00', 'Closed'),
(7, 'Sunday', '09:00:00', '17:00:00', 'Closed');

-- --------------------------------------------------------

--
-- Table structure for table `library_schedule`
--

CREATE TABLE `library_schedule` (
  `id` int(11) NOT NULL,
  `day_of_week` varchar(10) NOT NULL,
  `opening_time` time NOT NULL,
  `closing_time` time NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Closed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `library_schedule`
--

INSERT INTO `library_schedule` (`id`, `day_of_week`, `opening_time`, `closing_time`, `status`) VALUES
(1, 'Monday', '08:30:00', '19:00:00', 'Closed'),
(2, 'Tuesday', '08:30:00', '19:00:00', 'Open'),
(3, 'Wednesday', '08:30:00', '19:00:00', 'Open'),
(4, 'Thursday', '08:30:00', '19:00:00', 'Closed'),
(5, 'Friday', '08:30:00', '19:00:00', 'Closed'),
(6, 'Saturday', '09:00:00', '17:00:00', 'Closed'),
(7, 'Sunday', '09:00:00', '17:00:00', 'Closed');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'user', 'user123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itcenter_schedule`
--
ALTER TABLE `itcenter_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `library_schedule`
--
ALTER TABLE `library_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `itcenter_schedule`
--
ALTER TABLE `itcenter_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `library_schedule`
--
ALTER TABLE `library_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

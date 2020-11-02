-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2020 at 04:59 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentspay`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `password`) VALUES
(1, '$2y$10$FofvgoasnEWlGo5yhO6cVuzB84V1/8R3r/eUGp78LMavegT/Scora');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course` varchar(100) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'active',
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course`, `status`, `date_added`) VALUES
(1, 'Graphic Design', 'active', '2020-09-05 11:07:01'),
(2, 'Ethical Hacking', 'active', '2020-09-05 11:07:17'),
(3, 'Web Design', 'active', '2020-09-05 11:07:39'),
(4, 'Networking', 'active', '2020-09-05 11:07:50'),
(5, 'Photography', 'active', '2020-09-05 13:35:19');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `receipient` varchar(15) NOT NULL,
  `payment_code` int(11) NOT NULL,
  `Status` set('issued','success','failed','cancelled') NOT NULL DEFAULT 'issued',
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `index_number` varchar(20) NOT NULL,
  `department` varchar(50) NOT NULL,
  `level` int(10) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT '$2y$10$q8GVLHbpN/i185e6.vptHeAOeAvX0OaWMcO1/gjTcd5MVCKRaWODe',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `index_number`, `department`, `level`, `password`, `created_at`) VALUES
(1, 'Kwabena Abobire', '04/2017/1752d', 'Computer Network Management', 200, '$2y$10$q8GVLHbpN/i185e6.vptHeAOeAvX0OaWMcO1/gjTcd5MVCKRaWODe', '2020-07-01 17:40:02'),
(2, 'Gilbert Anfom Evans', '04/2017/1753d', 'Computer Network Management', 200, '$2y$10$q8GVLHbpN/i185e6.vptHeAOeAvX0OaWMcO1/gjTcd5MVCKRaWODe', '2020-07-03 20:54:49'),
(5, 'Issah Gamed', '04/2017/1754d', 'Computer Science', 100, '$2y$10$q8GVLHbpN/i185e6.vptHeAOeAvX0OaWMcO1/gjTcd5MVCKRaWODe', '2020-07-28 09:21:47'),
(6, 'Amo Yaw', '04/2017/1755d', 'Computer Network Management', 100, '$2y$10$q8GVLHbpN/i185e6.vptHeAOeAvX0OaWMcO1/gjTcd5MVCKRaWODe', '2020-07-28 09:27:24'),
(7, 'Yeboa Kwame', '04/2017/1756d', 'Computer Science', 200, '$2y$10$9mB1cyvY5Chtfc5XlGvbie9.K.N5tUbllmi7tXiWkXsTsx3S3koAi', '2020-07-28 09:46:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

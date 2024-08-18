-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2024 at 03:25 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'User ID',
  `email` varchar(150) NOT NULL COMMENT 'E mail',
  `name` varchar(250) NOT NULL COMMENT 'Name',
  `password` varchar(255) NOT NULL COMMENT 'Password',
  `user_type` char(1) NOT NULL COMMENT 'UserType A - Admin, E - Employee',
  `telephone` varchar(10) NOT NULL COMMENT 'Telephone',
  `user_status` int(1) NOT NULL COMMENT 'Status 1 - Active, 0 - Inactive',
  `created_by` int(11) NOT NULL COMMENT 'Created By',
  `created_date` datetime NOT NULL COMMENT 'Created Date'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `name`, `password`, `user_type`, `telephone`, `user_status`, `created_by`, `created_date`) VALUES
(1, 'admin@gmail.com', 'Administrator', '21232f297a57a5a743894a0e4a801fc3', 'A', '715292328', 1, 1, '2024-08-14 00:00:00'),
(2, 'raveensalinda35@gmail.com', 'Raveen Salinda', 'e10adc3949ba59abbe56e057f20f883e', 'A', '715292328', 1, 1, '2024-08-17 02:30:18'),
(3, 'raveen@gmail.com', 'bfdbfdnnhgnhnh', '62fc4943b37bd101a0d164b9692f5f1d', 'A', '4654765768', 0, 2, '2024-08-17 03:01:40'),
(4, 'employee@gmail.com', 'Employee name', 'fa5473530e4d1a5a1e1eb53d2fedb10c', 'E', '8567567657', 1, 1, '2024-08-18 03:23:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_status` (`user_status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User ID', AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

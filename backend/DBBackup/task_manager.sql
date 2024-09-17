-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2024 at 05:48 PM
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
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `activityId` int(11) NOT NULL COMMENT 'Auto ID',
  `taskId` int(11) NOT NULL COMMENT 'Task ID',
  `activity_name` varchar(150) NOT NULL COMMENT 'Activity Name',
  `activity_description` text NOT NULL COMMENT 'Activity Description',
  `date_start` date NOT NULL COMMENT 'Date Start',
  `date_complete` date NOT NULL COMMENT 'Date Complete',
  `activity_status` int(1) NOT NULL COMMENT 'Status 1 - Active, 0 - Inactive',
  `created_by` int(11) NOT NULL COMMENT 'Created By',
  `created_date` datetime NOT NULL COMMENT 'Created Date'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`activityId`, `taskId`, `activity_name`, `activity_description`, `date_start`, `date_complete`, `activity_status`, `created_by`, `created_date`) VALUES
(1, 1, 'Step 01', 'Step 01 Description', '2024-09-01', '2024-09-07', 1, 1, '2024-09-17 01:46:16'),
(2, 1, 'Step 02', 'Step 02 Description', '2024-09-08', '2024-09-14', 1, 1, '2024-09-17 01:46:37'),
(3, 1, 'Step 03', 'Step 03 Description', '2024-09-15', '2024-09-21', 1, 1, '2024-09-17 01:47:16'),
(4, 1, 'Step 04', 'Step 04 Description', '2024-09-22', '2024-09-28', 1, 1, '2024-09-17 01:47:38'),
(5, 1, 'Step 05', 'Step 05 Description', '2024-09-29', '2024-10-05', 1, 1, '2024-09-17 01:47:59'),
(6, 2, 'Activity 01', 'Activity 01 Description', '2024-10-01', '2024-10-07', 1, 1, '2024-09-17 01:48:53'),
(7, 2, 'Activity 02', 'Activity 02 Description', '2024-10-08', '2024-10-14', 1, 1, '2024-09-17 01:49:39'),
(8, 2, 'Activity 03', 'Activity 03 Description', '2024-10-15', '2024-10-21', 1, 1, '2024-09-17 01:50:12'),
(9, 3, 'Position 01', 'Position 01 Description', '2024-11-01', '2024-11-07', 1, 1, '2024-09-17 01:51:38'),
(10, 3, 'Position 02', 'Position 02 Description', '2024-11-08', '2024-10-14', 1, 1, '2024-09-17 01:52:07');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `taskId` int(11) NOT NULL COMMENT 'Auto ID',
  `task_name` varchar(150) NOT NULL COMMENT 'Task Name',
  `task_description` text NOT NULL COMMENT 'Task Description',
  `closing_date` date NOT NULL COMMENT 'Closing Date',
  `task_status` int(1) NOT NULL COMMENT 'Status 1 - Active, 0 - Inactive',
  `created_by` int(11) NOT NULL COMMENT 'Created By',
  `created_date` datetime NOT NULL COMMENT 'Created Date'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`taskId`, `task_name`, `task_description`, `closing_date`, `task_status`, `created_by`, `created_date`) VALUES
(1, 'Task 01', 'Task 01 Description', '2024-09-30', 1, 1, '2024-09-17 01:44:53'),
(2, 'Task 02', 'Task 02 Description', '2024-10-12', 1, 1, '2024-09-17 01:45:13'),
(3, 'Task 03', 'Task 03 Description', '2024-11-06', 1, 1, '2024-09-17 01:45:34');

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
(1, 'admin@gmail.com', 'Administrator', '21232f297a57a5a743894a0e4a801fc3', 'A', '0715292328', 1, 1, '2024-08-14 00:00:00'),
(2, 'raveensalinda35@gmail.com', 'gggggggg', 'e10adc3949ba59abbe56e057f20f883e', 'A', '333333333', 1, 1, '2024-08-17 02:30:18'),
(3, 'raveen@gmail.com', 'bfdbfdnnhgnhnh', '62fc4943b37bd101a0d164b9692f5f1d', 'A', '4654765768', 0, 2, '2024-08-17 03:01:40'),
(4, 'employee@gmail.com', 'Employee', 'e10adc3949ba59abbe56e057f20f883e', 'E', '1234567890', 1, 1, '2024-08-18 03:23:12'),
(5, 'raveensalinda34@gmail.com', 'Employee name', '827ccb0eea8a706c4c34a16891f84e7b', 'E', '8567567657', 1, 1, '2024-08-18 06:41:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_has_tasks`
--

CREATE TABLE `user_has_tasks` (
  `user_task_id` int(11) NOT NULL COMMENT 'Auto ID',
  `user_id` int(11) NOT NULL COMMENT 'User ID',
  `taskId` int(11) NOT NULL COMMENT 'Task ID',
  `activityId` int(11) NOT NULL COMMENT 'Activity ID',
  `user_task_status` int(11) NOT NULL COMMENT 'Status 1 - Start, 2 - Working, 3 - Hold, 4 - Complete'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_has_tasks`
--

INSERT INTO `user_has_tasks` (`user_task_id`, `user_id`, `taskId`, `activityId`, `user_task_status`) VALUES
(1, 4, 1, 1, 0),
(2, 4, 1, 2, 0),
(3, 4, 1, 3, 4),
(4, 4, 1, 4, 0),
(5, 4, 1, 5, 1),
(6, 4, 3, 9, 2),
(7, 4, 3, 10, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activityId`),
  ADD UNIQUE KEY `taskId_2` (`taskId`,`activity_name`),
  ADD KEY `taskId` (`taskId`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`taskId`),
  ADD UNIQUE KEY `task_name` (`task_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_status` (`user_status`);

--
-- Indexes for table `user_has_tasks`
--
ALTER TABLE `user_has_tasks`
  ADD PRIMARY KEY (`user_task_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `activityId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto ID', AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `taskId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto ID', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User ID', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_has_tasks`
--
ALTER TABLE `user_has_tasks`
  MODIFY `user_task_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto ID', AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2021 at 04:01 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ctrl_budget`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `extitle` varchar(255) NOT NULL,
  `exdate` date NOT NULL,
  `amount_spent` int(11) NOT NULL,
  `spent_by` varchar(255) NOT NULL,
  `bill` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `people_in_plan`
--

CREATE TABLE `people_in_plan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pd_id` int(11) NOT NULL,
  `persons` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `plan_details`
--

CREATE TABLE `plan_details` (
  `pd_id` int(11) NOT NULL,
  `duser_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `budget` int(11) NOT NULL,
  `people` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `people_in_plan`
--
ALTER TABLE `people_in_plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pd_id` (`pd_id`);

--
-- Indexes for table `plan_details`
--
ALTER TABLE `plan_details`
  ADD PRIMARY KEY (`pd_id`),
  ADD KEY `duser_id` (`duser_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `people_in_plan`
--
ALTER TABLE `people_in_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `plan_details`
--
ALTER TABLE `plan_details`
  MODIFY `pd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `plan_details` (`pd_id`),
  ADD CONSTRAINT `expenses_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`uid`);

--
-- Constraints for table `people_in_plan`
--
ALTER TABLE `people_in_plan`
  ADD CONSTRAINT `people_in_plan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `people_in_plan_ibfk_2` FOREIGN KEY (`pd_id`) REFERENCES `plan_details` (`pd_id`);

--
-- Constraints for table `plan_details`
--
ALTER TABLE `plan_details`
  ADD CONSTRAINT `plan_details_ibfk_1` FOREIGN KEY (`duser_id`) REFERENCES `users` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

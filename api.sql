-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2018 at 11:22 PM
-- Server version: 5.6.36
-- PHP Version: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api`
--

-- --------------------------------------------------------

--
-- Table structure for table `Goal`
--

CREATE TABLE IF NOT EXISTS `Goal` (
  `id` int(11) unsigned NOT NULL,
  `userId` int(11) unsigned NOT NULL,
  `GoalName` varchar(100) NOT NULL,
  `GoalStart` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `GoalComplete` timestamp NULL DEFAULT NULL,
  `TargetKVI` double NOT NULL,
  `CurrentKVI` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `KVIType`
--

CREATE TABLE IF NOT EXISTS `KVIType` (
  `id` int(11) unsigned NOT NULL,
  `KVIName` varchar(100) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Multiplier` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Milestone`
--

CREATE TABLE IF NOT EXISTS `Milestone` (
  `id` int(11) unsigned NOT NULL,
  `GoalId` int(11) unsigned NOT NULL,
  `KVITypeID` int(11) unsigned NOT NULL,
  `MilestoneName` varchar(100) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `TargetKVI` double NOT NULL,
  `CurrentKVI` double NOT NULL,
  `TargetDate` timestamp NOT NULL,
  `CompletedDate` timestamp NULL DEFAULT NULL,
  `Cap` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Progress`
--

CREATE TABLE IF NOT EXISTS `Progress` (
  `id` int(11) unsigned NOT NULL,
  `MilestoneId` int(11) unsigned NOT NULL,
  `InputValue` double NOT NULL,
  `KVIValue` double NOT NULL,
  `OccurranceDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(11) unsigned NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_password` varchar(300) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Goal`
--
ALTER TABLE `Goal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`userId`);

--
-- Indexes for table `KVIType`
--
ALTER TABLE `KVIType`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Milestone`
--
ALTER TABLE `Milestone`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Goal_id` (`GoalId`),
  ADD KEY `KVITypeID` (`KVITypeID`);

--
-- Indexes for table `Progress`
--
ALTER TABLE `Progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `MilestoneId` (`MilestoneId`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Goal`
--
ALTER TABLE `Goal`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `KVIType`
--
ALTER TABLE `KVIType`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Milestone`
--
ALTER TABLE `Milestone`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Progress`
--
ALTER TABLE `Progress`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Goal`
--
ALTER TABLE `Goal`
  ADD CONSTRAINT `userId` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`);

--
-- Constraints for table `Milestone`
--
ALTER TABLE `Milestone`
  ADD CONSTRAINT `GoalId` FOREIGN KEY (`GoalId`) REFERENCES `Goal` (`id`),
  ADD CONSTRAINT `KVITypeId` FOREIGN KEY (`KVITypeID`) REFERENCES `KVIType` (`id`);

--
-- Constraints for table `Progress`
--
ALTER TABLE `Progress`
  ADD CONSTRAINT `MilestoneId` FOREIGN KEY (`MilestoneId`) REFERENCES `Milestone` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

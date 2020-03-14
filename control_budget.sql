-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 14, 2020 at 04:33 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `control_budget`
--

-- --------------------------------------------------------

--
-- Table structure for table `new_expense_details`
--

DROP TABLE IF EXISTS `new_expense_details`;
CREATE TABLE IF NOT EXISTS `new_expense_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_details_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `amount_spent` int(11) NOT NULL,
  `person` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `plan_details_id` (`plan_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `new_expense_details`
--

INSERT INTO `new_expense_details` (`id`, `plan_details_id`, `title`, `date`, `amount_spent`, `person`, `image_path`) VALUES
(37, 6, 'Lunch Day1', '2020-03-10', 50, 'Ravi Kumar Rai', ''),
(38, 6, 'Dinner Day1', '2020-03-11', 350, 'Ravi Kumar Rai', ''),
(39, 6, 'Breakfast Day2', '2020-03-12', 749, 'Gautam', 'upload/14-03-2020-1584187502.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

DROP TABLE IF EXISTS `plan`;
CREATE TABLE IF NOT EXISTS `plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) NOT NULL,
  `initial_budget` int(11) NOT NULL,
  `number_of_people` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`id`, `user_email`, `initial_budget`, `number_of_people`) VALUES
(7, 'siddhant28r@gmail.com', 10000, 2),
(9, 'siddhant28r@gmail.com', 2000, 4);

-- --------------------------------------------------------

--
-- Table structure for table `plan_details`
--

DROP TABLE IF EXISTS `plan_details`;
CREATE TABLE IF NOT EXISTS `plan_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `initial_budget` int(11) NOT NULL,
  `number_of_people` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `plan_id` (`plan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plan_details`
--

INSERT INTO `plan_details` (`id`, `plan_id`, `title`, `from_date`, `to_date`, `initial_budget`, `number_of_people`) VALUES
(6, 7, 'Trip to Banaras', '2020-03-11', '2020-03-14', 10000, 2),
(7, 9, 'Trip to Shimla', '2020-03-14', '2020-03-17', 2000, 4);

-- --------------------------------------------------------

--
-- Table structure for table `plan_members`
--

DROP TABLE IF EXISTS `plan_members`;
CREATE TABLE IF NOT EXISTS `plan_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `plan_details_id` int(11) NOT NULL,
  `person1` varchar(255) DEFAULT NULL,
  `person2` varchar(255) DEFAULT NULL,
  `person3` varchar(255) DEFAULT NULL,
  `person4` varchar(255) DEFAULT NULL,
  `person5` varchar(255) DEFAULT NULL,
  `person6` varchar(255) DEFAULT NULL,
  `person7` varchar(255) DEFAULT NULL,
  `person8` varchar(255) DEFAULT NULL,
  `person9` varchar(255) DEFAULT NULL,
  `person10` varchar(255) DEFAULT NULL,
  `person11` varchar(255) DEFAULT NULL,
  `person12` varchar(255) DEFAULT NULL,
  `person13` varchar(255) DEFAULT NULL,
  `person14` varchar(255) DEFAULT NULL,
  `person15` varchar(255) DEFAULT NULL,
  `person16` varchar(255) DEFAULT NULL,
  `person17` varchar(255) DEFAULT NULL,
  `person18` varchar(255) DEFAULT NULL,
  `person19` varchar(255) DEFAULT NULL,
  `person20` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_email` (`user_email`),
  KEY `plan_id` (`plan_id`),
  KEY `plan_details_id` (`plan_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plan_members`
--

INSERT INTO `plan_members` (`id`, `user_email`, `plan_id`, `plan_details_id`, `person1`, `person2`, `person3`, `person4`, `person5`, `person6`, `person7`, `person8`, `person9`, `person10`, `person11`, `person12`, `person13`, `person14`, `person15`, `person16`, `person17`, `person18`, `person19`, `person20`) VALUES
(6, 'siddhant28r@gmail.com', 7, 6, 'Ravi Kumar Rai', 'Gautam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'siddhant28r@gmail.com', 9, 7, 'Ravi Kumar Rai', 'Gautam Batra', 'Swetank Chirag', 'Prashant Karan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` bigint(10) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `email`, `password`, `phone_number`) VALUES
('Siddhant', 'siddhant28r@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 8190847372);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `new_expense_details`
--
ALTER TABLE `new_expense_details`
  ADD CONSTRAINT `new_expense_details_ibfk_1` FOREIGN KEY (`plan_details_id`) REFERENCES `plan_details` (`id`);

--
-- Constraints for table `plan`
--
ALTER TABLE `plan`
  ADD CONSTRAINT `plan_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`);

--
-- Constraints for table `plan_details`
--
ALTER TABLE `plan_details`
  ADD CONSTRAINT `plan_details_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `plan` (`id`);

--
-- Constraints for table `plan_members`
--
ALTER TABLE `plan_members`
  ADD CONSTRAINT `plan_members_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`),
  ADD CONSTRAINT `plan_members_ibfk_2` FOREIGN KEY (`plan_id`) REFERENCES `plan` (`id`),
  ADD CONSTRAINT `plan_members_ibfk_3` FOREIGN KEY (`plan_details_id`) REFERENCES `plan_details` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

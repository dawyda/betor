-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2016 at 04:50 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `betips`
--

-- --------------------------------------------------------

--
-- Table structure for table `credits`
--

CREATE TABLE IF NOT EXISTS `credits` (
  `id` bigint(20) unsigned NOT NULL,
  `balance` decimal(5,2) NOT NULL,
  `user_id` int(6) NOT NULL,
  `expiry` datetime NOT NULL,
  `last_trans_id` mediumint(8) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credits`
--

INSERT INTO `credits` (`id`, `balance`, `user_id`, `expiry`, `last_trans_id`) VALUES
(1, '5.00', 1, '2016-06-30 06:00:00', 2323);

-- --------------------------------------------------------

--
-- Table structure for table `member_types`
--

CREATE TABLE IF NOT EXISTS `member_types` (
  `id` smallint(2) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='platimun, premium, normal';

--
-- Dumping data for table `member_types`
--

INSERT INTO `member_types` (`id`, `name`) VALUES
(1, 'free'),
(3, 'platinum'),
(2, 'premium');

-- --------------------------------------------------------

--
-- Table structure for table `predictions`
--

CREATE TABLE IF NOT EXISTS `predictions` (
  `id` bigint(20) unsigned NOT NULL,
  `matchdate` datetime NOT NULL,
  `game` text NOT NULL,
  `prediction` varchar(50) NOT NULL,
  `weight` varchar(50) NOT NULL,
  `home` varchar(10) NOT NULL,
  `draw` varchar(10) NOT NULL,
  `away` varchar(10) NOT NULL,
  `result` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='stores predictions';

--
-- Dumping data for table `predictions`
--

INSERT INTO `predictions` (`id`, `matchdate`, `game`, `prediction`, `weight`, `home`, `draw`, `away`, `result`) VALUES
(1, '2016-05-31 05:16:23', 'Man U v Aston Villa', '1', '10', '1.46', '2.37', '3.01', ''),
(2, '2016-06-15 03:10:00', 'Borussia Dort v Bayern', 'x2', '8', '2.23', '2.30', '2.07', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `avatar` varchar(255) NOT NULL DEFAULT 'default.png',
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `pass_change` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_ip` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `phone`, `email`, `fullname`, `creation_date`, `avatar`, `confirmed`, `pass_change`, `last_login`, `last_ip`) VALUES
(1, 'user1', '797dcbd47cf8b8f1f93bf9365894032c40b82aca', NULL, 'user@domain.com', 'User One', '2016-05-28 21:43:28', 'default.png', 0, NULL, '2016-05-31 17:49:00', '192.168.1.20'),
(3, 'testuser', 'bb7bdeb6946950b1cd202434b4df45e7f20193d2', '0711071104', 'test.user@mail.com', 'Test User', '2016-05-31 17:41:33', 'default.png', 0, NULL, '2016-05-31 17:49:43', NULL),
(4, 'another', '819e4eaa10d6ec7c9fed4a75b0f53ff8c638e046', '0707333222', 'dumb@mail.co.ke', 'Another User', '2016-05-31 17:42:57', 'default.png', 0, NULL, '2016-05-31 17:49:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `value_bets`
--

CREATE TABLE IF NOT EXISTS `value_bets` (
  `id` bigint(20) unsigned NOT NULL,
  `game` varchar(255) NOT NULL,
  `prediction` varchar(10) DEFAULT NULL,
  `result` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='show value bet predictions';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `credits`
--
ALTER TABLE `credits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `member_types`
--
ALTER TABLE `member_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `member_type_name` (`name`);

--
-- Indexes for table `predictions`
--
ALTER TABLE `predictions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `value_bets`
--
ALTER TABLE `value_bets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `credits`
--
ALTER TABLE `credits`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `member_types`
--
ALTER TABLE `member_types`
  MODIFY `id` smallint(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `predictions`
--
ALTER TABLE `predictions`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `value_bets`
--
ALTER TABLE `value_bets`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

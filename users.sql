-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 10, 2020 at 06:11 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `invites`
--

DROP TABLE IF EXISTS `invites`;
CREATE TABLE IF NOT EXISTS `invites` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `used` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invites`
--

INSERT INTO `invites` (`uid`, `code`, `used`) VALUES
(1, 'admin_acc_invite', 1);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `status` int(1) NOT NULL DEFAULT 0,
  `version` int(1) NOT NULL DEFAULT 0,
  `maintenance` int(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`status`, `version`, `maintenance`) VALUES
(0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shoutbox`
--

DROP TABLE IF EXISTS `shoutbox`;
CREATE TABLE IF NOT EXISTS `shoutbox` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `time` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` int(1) NOT NULL DEFAULT 0,
  `hwid` varchar(255) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT 0,
  `banned` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `inject` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `hwid` (`hwid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `admin`, `hwid`, `active`, `banned`, `created_at`, `inject`, `ip`) VALUES
(1, 'admin', '$2y$10$OUK4tSrF3aa3Qm0D/1TcU.iPq5Ptvzik3/OBaMcSSLiUqPOcuOTGy', 1, NULL, 0, 0, '2020-08-10 23:38:23', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

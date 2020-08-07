-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 07, 2020 at 08:05 AM
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
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invites`
--

INSERT INTO `invites` (`uid`, `code`, `used`) VALUES
(47, 'CBYDyJOV5m7QPA58RbIa', 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shoutbox`
--

INSERT INTO `shoutbox` (`id`, `user`, `msg`, `time`) VALUES
(57, 'owbypass', 'hh', '2020-07-01 00:42:29.500466'),
(56, 'owbypass', 'test', '2020-06-30 15:02:11.557872');

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
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `admin`, `hwid`, `active`, `banned`, `created_at`, `inject`, `ip`) VALUES
(30, 'bnt', 'Ymh1c2hhbjk2NDg=', 0, 'S-1-5-21-989917819-3302285190-2103709003-1001', 0, 0, '2020-06-01 20:22:19', '[11.02.52 AM].08-02-2020', '103.85.8.14'),
(1, 'owbypass', 'QkxBQ0tMSVNURUQ=', 1, 'test', 1, 0, '2020-05-29 11:24:51', 'inject', 'ip'),
(29, 'cyrax', 'TnVwdXIxOTA1', 0, 'S-1-5-21-3937958953-466520451-344216845-1005', 1, 0, '2020-06-01 20:21:22', '[10:11:39 PM]:01-11-2020', '103.220.80.181'),
(5, 'jerry', 'cw==', 1, NULL, 1, 0, '2020-06-01 16:26:54', '[7:19:36 PM]:29-19-2020', '45.112.144.39'),
(31, 'Divyansh', 'am9oYXJpMjAwOA==', 0, NULL, 1, 0, '2020-06-01 20:23:35', '[8.29.20 PM].01-29-2020', '122.168.212.109'),
(32, 'Gucci', 'SWx1djJwbGF5', 0, NULL, 0, 0, '2020-06-01 20:24:00', NULL, NULL),
(33, 'champion', 'Y2hhbXAxMDEw', 0, NULL, 1, 0, '2020-06-01 20:45:42', '[10:35:43 AM]:08-35-2020', '103.106.101.216'),
(34, 'Narois', 'YXNiZXN0b3M=', 0, 'S-1-5-21-1189953557-1770101900-3837779971-1001', 1, 0, '2020-06-02 11:58:32', '[12:10:00 AM]:06-10-2020', '49.36.143.235'),
(36, 'nikhil1', 'bmlraGlsQDEyMzQ=', 0, 'S-1-5-21-726042836-3079174021-1289585336-1001', 1, 0, '2020-06-03 20:44:17', '[4:58:47 PM]:26-58-2020', '103.211.152.174'),
(37, 'dead', 'c3dhbmFuZDI3MTI=', 0, 'S-1-5-21-1885581424-1742821737-4291082471-1001', 0, 0, '2020-06-06 16:33:32', '[10:03:43 AM]:08-03-2020', '103.48.103.225'),
(38, 'fury', 'ZnVyeU9Q', 0, 'S-1-5-21-497074016-4101819417-2207986447-1001', 1, 0, '2020-06-12 18:09:10', '[3.56.37 PM].20-56-2020', '183.87.252.18'),
(39, '#tag', 'dmlzaHUxMjU4', 0, NULL, 1, 0, '2020-06-12 18:09:46', NULL, NULL),
(40, 'admin', 'YW5vbnltb3Vz', 0, NULL, 1, 0, '2020-06-17 10:40:09', NULL, NULL),
(41, 'COOLBOY', 'dW1hbmcyMDE=', 0, 'S-1-5-21-3850118675-2841328505-3872384462-1001', 1, 0, '2020-06-19 18:50:27', '[4:59:09 PM]:23-59-2020', '223.238.206.48'),
(42, 'sunil', 'c3VuaWwxOTk5', 0, 'S-1-5-21-4284880812-501470751-2132892171-1001', 1, 0, '2020-06-23 19:00:08', '[11:13:57 AM]:24-13-2020', '106.220.66.191');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 24, 2023 at 12:30 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(128) NOT NULL,
  `FNAME` varchar(128) NOT NULL,
  `LNAME` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `COUNTRY` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `MSTATUS` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `KIDS` int DEFAULT NULL,
  `EMAIL` varchar(128) NOT NULL,
  `PASSWORD_HASH` varchar(255) NOT NULL,
  `IS_ADMIN` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `EMAIL` (`EMAIL`),
  UNIQUE KEY `USERNAME` (`USERNAME`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `USERNAME`, `FNAME`, `LNAME`, `COUNTRY`, `MSTATUS`, `KIDS`, `EMAIL`, `PASSWORD_HASH`, `IS_ADMIN`) VALUES
(22, 'testing', 'test', 'test', 'Bonaire, Sint Eustatius and Saba', 'single', 1, 'test@test.com', '$2y$10$/1Bcz73UgxwZckaQ6Z2hTuzVGn1jWocvk1/DI1dmepwn.8IA5gT5K', 0),
(23, 'Testing01', 'testing', 'testing', 'Macao', 'single', 0, 'testing01@test.com', '$2y$10$UbGqF2zVKdeoScu6fN2bd.SWgMgLmcb/bEXgkxzh8yo4y/dep.FSe', 1),
(24, 'admin02', 'admin', 'admin', NULL, NULL, NULL, 'admin02@admin.com', '$2y$10$2oQiXi8MjLExWtPAh9VMGePdm3rRsby5eq/I6eRv6ijTBO2Ckf5d2', 1),
(25, 'ADmin514', 'admin', 'admin', NULL, NULL, NULL, 'ADmin514@admin.com', '$2y$10$360Fgc7LVNJaO4AEPc08JONTCJmZd.SGB/FnEVOZ2VrLV2XI9Ei66', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

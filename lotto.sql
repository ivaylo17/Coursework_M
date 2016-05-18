-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2016 at 11:07 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lotto`
--

-- --------------------------------------------------------

--
-- Table structure for table `lotto`
--

CREATE TABLE IF NOT EXISTS `lotto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT '0',
  `Game` varchar(20) NOT NULL DEFAULT ' ',
  `Data` varchar(20) NOT NULL DEFAULT ' ',
  `DT` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `type` (`type`,`DT`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `lotto`
--

INSERT INTO `lotto` (`id`, `type`, `Game`, `Data`, `DT`) VALUES
(1, 3, 'Jokerposition', '3,4,8', '2016-05-02 17:00:00'),
(2, 1, '5x35', '5,10,15,20,30', '2016-05-02 19:00:00'),
(3, 2, '6x49', '6,8,14,25,35,49', '2016-05-02 17:00:00'),
(4, 3, 'Jokerposition', '5,7,8', '2016-05-03 17:00:00'),
(5, 1, '5x35', '6,14,16,21,31', '2016-05-03 19:00:00'),
(6, 2, '6x49', '5,7,13,24,34,48', '2016-05-03 17:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

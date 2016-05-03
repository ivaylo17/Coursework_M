-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2016 at 01:37 PM
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
-- Table structure for table `numbers`
--

CREATE TABLE IF NOT EXISTS `numbers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `A1` text NOT NULL,
  `B1` text NOT NULL,
  `C1` text NOT NULL,
  `Jokerposition` text NOT NULL,
  `Jokernumbers` text NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `numbers`
--

INSERT INTO `numbers` (`id`, `A1`, `B1`, `C1`, `Jokerposition`, `Jokernumbers`, `Date`) VALUES
(1, '6,9,21,29,35', '5,7,19,24,31', '6,10,22,34,39,44', '3,4,5', '2,3,4', '2016-04-21'),
(2, '5,10,15,20,25', '7,17,24,27,34', '9,19,19,29,39,49', '1,6,9', '3,6,8', '2016-04-23');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

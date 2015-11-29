-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 29, 2015 at 03:30 PM
-- Server version: 5.5.41-log
-- PHP Version: 5.4.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `comm`
--

CREATE TABLE IF NOT EXISTS `comm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `recipient` text NOT NULL,
  `comment` text NOT NULL,
  `comment_type` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `comm`
--

INSERT INTO `comm` (`id`, `name`, `recipient`, `comment`, `comment_type`, `date`) VALUES
(1, '#Вася', '#all', 'Первый коммент!', 'public', '2015-11-03'),
(2, '#Аркадий', '#Вася', 'Все ок Вася :)', 'public', '2015-11-11'),
(3, '#Димон', '#all', 'Все как раньше !!!', 'public', '2015-11-12'),
(4, '#Карл', '#all', 'Всем привет!', 'public', '2015-11-18'),
(5, '#Валера', '#Карл', 'Чат Бот', 'private', '2015-11-24'),
(6, '#bob', '#Валера', 'это тебе', 'private', '2015-11-17');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `name`, `status`) VALUES
(1, '#all', 'online'),
(2, '#Вася', 'online'),
(3, '#Аркадий', 'online'),
(4, '#Димон', ''),
(5, '#Валера', 'online'),
(6, '#Карл', ''),
(7, '#bob', 'online');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

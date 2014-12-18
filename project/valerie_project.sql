-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2014 at 09:00 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `valerie_project`
--
CREATE DATABASE IF NOT EXISTS `valerie_project` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `valerie_project`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `user_id` smallint(6) NOT NULL,
  `post_id` smallint(6) NOT NULL,
  `body` text NOT NULL,
  `date` date NOT NULL,
  `parent_comment_id` smallint(6) NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  `user_id` smallint(6) NOT NULL,
  `description` varchar(250) NOT NULL,
  `date` date NOT NULL,
  `image` text NOT NULL,
  `theme_id` smallint(6) NOT NULL,
  `room_id` smallint(6) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `user_id`, `description`, `date`, `image`, `theme_id`, `room_id`) VALUES
(1, 'XmasKitchen!', 1, 'This is my Xmas kitchen description. \r\nYou think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don''t k', '2014-12-17', '<img src="https://blackbookkitchendiaries.files.wordpress.com/2010/12/img_3845.jpg">', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `room_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `name`) VALUES
(1, 'Bedroom'),
(2, 'Living Room'),
(3, 'Bathroom'),
(4, 'Kitchen'),
(5, 'Dining Room'),
(6, 'Stairs/Hall');

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

DROP TABLE IF EXISTS `themes`;
CREATE TABLE IF NOT EXISTS `themes` (
  `theme_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`theme_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`theme_id`, `name`) VALUES
(1, 'Holidays'),
(2, 'Beach'),
(3, 'Vintage'),
(4, 'Modern'),
(5, 'Country'),
(6, 'Western'),
(7, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(254) NOT NULL,
  `userpic` text NOT NULL,
  `date_joined` date NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `userpic`, `date_joined`) VALUES
(1, 'valerie', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'valeriec@san.rr.com', '', '2014-12-16'),
(2, 'fakeuser', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'fake@gmail.com', 'http://www.liberal.ru/upload/userpics/no_userpic.gif', '2014-12-17'),
(3, 'user3', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'fake@fake.com', '', '2014-12-18');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

DROP TABLE IF EXISTS `vote`;
CREATE TABLE IF NOT EXISTS `vote` (
  `vote_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `post_id` smallint(6) NOT NULL,
  `user_id` smallint(6) NOT NULL,
  `vote` tinyint(1) NOT NULL,
  PRIMARY KEY (`vote_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

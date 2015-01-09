-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2015 at 08:47 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `post_id`, `body`, `date`, `parent_comment_id`) VALUES
(1, 1, 5, 'testttt', '2015-01-07', 0),
(2, 2, 5, 'I am leaving a comment', '2015-01-07', 0),
(3, 1, 5, 'testing the comments section', '2015-01-08', 0),
(4, 1, 5, 'testing the comments section', '2015-01-08', 0),
(5, 1, 14, 'First comment\r\n =D', '2015-01-08', 0);

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
  `theme_id` smallint(6) NOT NULL,
  `room_id` smallint(6) NOT NULL,
  `weeklydecor` tinyint(1) NOT NULL,
  `image_key` varchar(40) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `user_id`, `description`, `date`, `theme_id`, `room_id`, `weeklydecor`, `image_key`) VALUES
(1, 'XmasKitchen!', 1, 'This is my Xmas kitchen description. \r\nYou think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don''t k', '2014-12-17', 1, 4, 1, '9c1882af6d36f08fe5d0099e26d7f0bc4d3e4105'),
(2, 'Modern Bedroom', 2, 'The description for the modern bedroom.\r\n\r\nLorem ipsum dolor sit amet, eu erat animal cotidieque sea. His eu postea aliquid equidem. Usu movet scaevola ne, dolore ponderum vim at, nulla vivendo intellegebat an his. Ne qui feugait fastidii, congue ref', '2014-12-22', 4, 1, 0, '0b04795b01fecb11074c3416e5bbf6aff6ac5162'),
(3, 'dining room western style', 1, 'Lorem ipsum dolor sit amet, eu erat animal cotidieque sea. His eu postea aliquid equidem. Usu movet scaevola ne, dolore ponderum vim at, nulla vivendo intellegebat an his. Ne qui feugait fastidii, congue referrentur et vel, cum at vocibus commune. Ut', '2014-12-22', 6, 5, 0, 'a091c242e14fbcb598d066ab7f6b632afabc8037'),
(4, 'my Christmas livingroom', 1, 'Lorem ipsum dolor sit amet, eu erat animal cotidieque sea. His eu postea aliquid equidem. Usu movet scaevola ne, dolore ponderum vim at, nulla vivendo intellegebat an his. Ne qui feugait fastidii, congue referrentur et vel, cum at vocibus commune. Ut', '2015-01-05', 1, 2, 0, '29e194eb046c8d9819bbae05ae1fb7f0aba9f32c'),
(5, 'Vintage Bedroom', 1, 'Century-old quilts in Pinwheel (left) and Bear''s Paw patterns dress the antique wrought-iron beds in one of this Nantucket cottage''s bedrooms. The new rag rug was handwoven by area artisans at the Weaving Room, and the demijohn lamp hails from an ant', '2015-01-07', 3, 1, 0, 'c90603f2e5d4fefadf9861a99c1689f16dbdece4'),
(6, 'country living kitchen ', 1, 'Lorem ipsum dolor sit amet, eu erat animal cotidieque sea. His eu postea aliquid equidem. Usu movet scaevola ne, dolore ponderum vim at, nulla vivendo intellegebat an his. Ne qui feugait fastidii, congue referrentur et vel, cum at vocibus commune. Ut', '2015-01-07', 5, 4, 0, '40f803ba88c534e3831080faeb219cab995ba284'),
(14, 'Halloween Stairs', 1, 'Zombie ipsum reversus ab viral inferno, nam rick grimes malum cerebro. De carne lumbering animata corpora quaeritis. Summus brains sitâ€‹â€‹, morbo vel maleficia? De apocalypsi gorger omero undead survivor dictum mauris. Hi mindless mortuis soulless ', '2015-01-07', 1, 6, 0, '0e1f8977da1142a16650647925f52b995b775b30');

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
  `medium_img` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `userpic`, `date_joined`, `medium_img`) VALUES
(1, 'valerie', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'valeriec@san.rr.com', '', '2014-12-16', 'uploads/feb559b2b90d7de688f21fc5045c7288fe9cb6d8_medium_img.jpg'),
(2, 'fakeuser', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'fake@gmail.com', '', '2014-12-17', 'uploads/c79c986cee3e5373bb0d3c579bd3a05b7bb37bd6_medium_img.jpg'),
(3, 'user3', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'fake@fake.com', '', '2014-12-18', ''),
(4, 'melissa', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'mm@gmail.com', '', '2014-12-22', '');

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

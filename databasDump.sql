-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 28, 2013 at 08:48 AM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `TNM065`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `pictureID` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `text` varchar(100) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`commentID`,`pictureID`),
  KEY `userName` (`userName`),
  KEY `pictureID` (`pictureID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentID`, `pictureID`, `userName`, `text`, `time`) VALUES
(1, 1, 'user1', 'This is a comment on a picture.', '2013-11-27 20:58:00'),
(2, 2, 'user1', 'This is a nice picture indeed!', '2013-11-28 08:35:00');

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE `picture` (
  `pictureID` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(100) NOT NULL,
  `picURL` varchar(100) NOT NULL,
  `time` datetime NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`pictureID`,`userName`),
  KEY `userName` (`userName`),
  KEY `pictureID` (`pictureID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`pictureID`, `userName`, `picURL`, `time`, `description`) VALUES
(1, 'user1', 'http://localhost:8888/TNM065/repo/img/user1/testImage.JPG', '2013-11-27 20:55:00', 'This is a testImage to have something to test with.'),
(2, 'user2', 'http://localhost:8888/TNM065/repo/img/user2/testImage2.jpg', '2013-11-28 08:33:00', 'This is an image of a lighthouse in the sunset.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userName` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`userName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userName`, `password`) VALUES
('user1', 'password'),
('user2', 'password2');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`pictureID`) REFERENCES `picture` (`pictureID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`userName`) REFERENCES `user` (`userName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `picture_ibfk_1` FOREIGN KEY (`userName`) REFERENCES `user` (`userName`) ON DELETE CASCADE ON UPDATE CASCADE;

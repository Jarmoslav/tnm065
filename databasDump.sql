-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 15, 2014 at 06:01 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentID`, `pictureID`, `userName`, `text`, `time`) VALUES
(1, 1, 'user1', 'This is a comment on a picture.', '2013-11-27 20:58:00'),
(2, 2, 'user1', 'This is a nice picture indeed!', '2013-11-28 08:35:00'),
(3, 2, 'user2', 'Thank you! I put a lot of work in to this!', '2013-11-28 10:39:00'),
(4, 1, 'user2', 'I really like you comment actually!', '2013-11-30 15:54:09'),
(5, 1, 'user2', 'I really like you comment actually!', '2013-11-30 15:55:22'),
(6, 1, 'user2', 'This picture is colorful!', '2013-11-30 15:56:35'),
(10, 8, 'hollenjohn', 'Nice, found this on my android aswell!', '2013-12-03 22:42:18'),
(11, 2, 'hollenjohn', 'Nice! Where is this taken?', '2013-12-10 19:50:07'),
(12, 1, 'hollenjohn', 'This one is nice!', '2013-12-10 22:22:43'),
(13, 16, 'hollenjohn', 'I like this image!', '2013-12-11 17:19:54'),
(14, 12, 'simonjare', 'Nice! I really like Rayman!', '2013-12-17 21:09:33'),
(16, 11, 'hollenjohn', 'This is really beautiful!', '2013-12-19 20:24:04'),
(18, 1, 'hollenjohn', 'Test', '2013-12-29 14:05:47'),
(21, 8, 'simonjare', 'What are you talking about? This is your image dude!', '2014-01-05 21:51:22'),
(22, 19, 'user1', 'Cool. I like apple computers!', '2014-01-12 11:20:07');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`pictureID`, `userName`, `picURL`, `time`, `description`) VALUES
(1, 'user1', 'img/user1/testImage.JPG', '2013-11-27 20:55:00', 'This is a testImage to have something to test with.'),
(2, 'user2', 'img/user2/testImage2.jpg', '2013-11-28 08:33:00', 'This is an image of a lighthouse in the sunset.'),
(7, 'hollenjohn', 'img/hollenjohn/03390_whalebeachpartii_1440x900.jpg', '2013-12-02 11:12:43', 'First post! A very nice picture of a beach in the sunset!'),
(8, 'hollenjohn', 'img/hollenjohn/wallpaper_51.jpg', '2013-12-02 11:14:50', 'A very nice image of some mountain. Found in Android 4.4 kitkat. '),
(11, 'hollenjohn', 'img/hollenjohn/03422_standingontheedgeofinfinity_1440x900.jpg', '2013-12-06 10:53:57', 'Image of a forest in the fog. And the fog is nice.'),
(12, 'user1', 'img/user1/raymanlegends.jpg', '2013-12-10 22:25:19', 'This is an image of Rayman from the newest game, Rayman Legends.'),
(14, 'user1', 'img/user1/wallpaper-173958.jpg', '2013-12-10 22:31:16', 'A cat trying to not fall down the edge of the screen.'),
(15, 'simonjare', 'img/simonjare/hazyFieldliten.jpg', '2013-12-10 22:33:41', 'Image of a farm in GothenBourg where I live.'),
(16, 'hollenjohn', 'img/hollenjohn/delusion14402.png', '2013-12-11 17:18:20', 'Abstract image of something. '),
(18, 'simonjare', 'img/simonjare/GalaxyMountainLionBrighterjpeg.jpg', '2013-12-19 11:28:47', 'The galaxy found in OS X Mountain Lion. A really cool image actually!'),
(19, 'hollenjohn', 'img/hollenjohn/W8IdvVk.jpg', '2014-01-12 11:17:42', 'The new wallpaper in OS X Mavericks!'),
(21, 'simonjare', 'img/simonjare/7174569831_11b50c5012_k.jpg', '2014-01-12 11:21:48', 'A nice closeup of some grass.');

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
('Hej', '541c57960bb997942655d14e3b9607f9'),
('hollenjohn', '1943b8b39ca8df2919faff021e0aca98'),
('simonjare', '1943b8b39ca8df2919faff021e0aca98'),
('user1', '5f4dcc3b5aa765d61d8327deb882cf99'),
('user2', '6cb75f652a9b52798eb6cf2201057c73');

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

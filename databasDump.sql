-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 11, 2013 at 11:22 AM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `Posts`
--

-- --------------------------------------------------------

--
-- Table structure for table `newsPosts`
--

CREATE TABLE `newsPosts` (
  `Title` varchar(100) NOT NULL,
  `Text` text NOT NULL,
  `Date` datetime NOT NULL,
  `ImageURL` varchar(100) NOT NULL,
  PRIMARY KEY (`Date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsPosts`
--

INSERT INTO `newsPosts` (`Title`, `Text`, `Date`, `ImageURL`) VALUES
('From DataBase!', 'This is actually from a SQL-Database locally on my machine!', '2013-11-26 21:38:00', 'noImage'),
('Another Post!', 'Now I have two posts. Let''s see if they are actually displayed! It is fun coding websites. Did I mention that the database connection is made with PDO? Hello hello my name is John. Tomorrow I will work with the Software Engineering Project all day! Whoo!', '2013-11-26 22:14:23', 'noImage');
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

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
(9, 6, 'hollenjohn', 'Nice! Using this as wallpaper!', '2013-12-03 22:41:45'),
(10, 8, 'hollenjohn', 'Nice, found this on my android aswell!', '2013-12-03 22:42:18'),
(11, 2, 'hollenjohn', 'Nice! Where is this taken?', '2013-12-10 19:50:07'),
(12, 1, 'hollenjohn', 'This one is nice!', '2013-12-10 22:22:43');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`pictureID`, `userName`, `picURL`, `time`, `description`) VALUES
(1, 'user1', 'img/user1/testImage.JPG', '2013-11-27 20:55:00', 'This is a testImage to have something to test with.'),
(2, 'user2', 'img/user2/testImage2.jpg', '2013-11-28 08:33:00', 'This is an image of a lighthouse in the sunset.'),
(6, 'user2', 'img/user2/mountainLionGalaxyMod2.png', '2013-12-01 21:07:17', 'An alternative version to the galaxy found in Apple OS X Mountain Lion.'),
(7, 'hollenjohn', 'img/hollenjohn/03390_whalebeachpartii_1440x900.jpg', '2013-12-02 11:12:43', 'First post! A very nice picture of a beach in the sunset!'),
(8, 'hollenjohn', 'img/hollenjohn/wallpaper_51.jpg', '2013-12-02 11:14:50', 'A very nice image of some mountain. Found in Android 4.4 kitkat. '),
(10, 'hollenjohn', 'img/hollenjohn/wallpaper-859225.jpg', '2013-12-03 22:03:19', 'A clean, minimalistic abstract image. Perfect as a desktop wallpaper. Blue and Black.'),
(11, 'hollenjohn', 'img/hollenjohn/03422_standingontheedgeofinfinity_1440x900.jpg', '2013-12-06 10:53:57', 'Image of a forest in the fog. And the fog is nice.'),
(12, 'user1', 'img/user1/raymanlegends.jpg', '2013-12-10 22:25:19', 'This is an image of Rayman from the newest game, Rayman Legends.'),
(14, 'user1', 'img/user1/wallpaper-173958.jpg', '2013-12-10 22:31:16', 'A cat trying to not fall down the edge of the screen.'),
(15, 'simonjare', 'img/simonjare/hazyFieldliten.jpg', '2013-12-10 22:33:41', 'Image of a farm in GothenBourg where I live.');

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
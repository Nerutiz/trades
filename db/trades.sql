-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 03, 2011 at 08:58 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `trades`
--
CREATE DATABASE `trades` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `trades`;

-- --------------------------------------------------------

--
-- Table structure for table `things`
--

CREATE TABLE `things` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(600) DEFAULT NULL,
  `image` varchar(45) DEFAULT NULL,
  `wishes` varchar(600) DEFAULT NULL,
  `keywords` varchar(45) DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_things_users` (`users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `things`
--

INSERT INTO `things` VALUES(27, 'Sukurtas naujas daiktas', 'su aprasymu', NULL, 'norais', 'ir t.t.', 1);
INSERT INTO `things` VALUES(28, 'Atostogos', 'description', NULL, 'wishes', 'keywords', 1);
INSERT INTO `things` VALUES(29, 'new', 'new', NULL, 'new', 'new', 1);
INSERT INTO `things` VALUES(30, 'dar vienas', 'dar ', NULL, 'vienas', 'dasr', 1);
INSERT INTO `things` VALUES(31, 'Naujas daiktas', 'Naujo daikto aprasymas', NULL, 'noriu keisti i telefona', 'Phone', 2);
INSERT INTO `things` VALUES(32, 'Belekas', 'Belekoks aprasymas', NULL, 'To phone', 'Belekas phone', 3);
INSERT INTO `things` VALUES(33, 'new', 'new desc', NULL, 'new', 'new', 3);
INSERT INTO `things` VALUES(34, 'Turi veikt', 'Turi veikt', NULL, 'Turi veikt', 'Turi veikt', 3);
INSERT INTO `things` VALUES(35, 'daiktas', 'kazkoks', NULL, 'norai', 'keywords', 1);
INSERT INTO `things` VALUES(36, 'daiktas', 'kazkoks', NULL, 'norai', 'keywords', 1);
INSERT INTO `things` VALUES(37, 'sadkaskd;k', 'l;kl;k', NULL, 'l;k', 'l;klasd', 1);
INSERT INTO `things` VALUES(38, 'nuajas sudinas', 'asdasd', NULL, 'asdas', 'sadasdsa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trades`
--

CREATE TABLE `trades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fromuser` int(11) DEFAULT NULL,
  `touser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `trades`
--


-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(100) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `size` varchar(45) DEFAULT NULL,
  `ext` varchar(45) DEFAULT NULL,
  `width` varchar(45) DEFAULT NULL,
  `height` varchar(45) DEFAULT NULL,
  `main` tinyint(1) DEFAULT NULL,
  `things_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_images_things1` (`things_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=225 ;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` VALUES(163, '4e5e25ba4ee5b', 'DSCI0019.JPG', 'image/jpeg', '1816525', 'JPG', '2816', '2112', 0, 29);
INSERT INTO `upload` VALUES(164, '4e5e25ba4f4e8', 'DSCI0021.JPG', 'image/jpeg', '1756814', 'JPG', '2816', '2112', 0, 29);
INSERT INTO `upload` VALUES(165, '4e5e25ba4fa09', 'DSCI0024.JPG', 'image/jpeg', '1817744', 'JPG', '2816', '2112', 0, 29);
INSERT INTO `upload` VALUES(166, '4e5e25ba5003f', 'DSCI0028.JPG', 'image/jpeg', '1746462', 'JPG', '2816', '2112', 1, 29);
INSERT INTO `upload` VALUES(167, '4e900505bd9d7', 'colorfull .png', 'image/png', '1025025', 'png', '1024', '768', NULL, NULL);
INSERT INTO `upload` VALUES(168, '4e90052f0e427', 'DSC00983.JPG', 'image/jpeg', '4660333', 'JPG', '3240', '4320', 1, 32);
INSERT INTO `upload` VALUES(169, '4e9005cec3d72', 'DSC01002.JPG', 'image/jpeg', '5686818', 'JPG', '4320', '3240', NULL, NULL);
INSERT INTO `upload` VALUES(170, '4e9005cee3343', 'DSC01006.JPG', 'image/jpeg', '5462124', 'JPG', '4320', '3240', NULL, NULL);
INSERT INTO `upload` VALUES(171, '4e9005d7a1d52', 'DSC01009.JPG', 'image/jpeg', '5169411', 'JPG', '4320', '3240', NULL, 33);
INSERT INTO `upload` VALUES(172, '4e9005d7cb139', 'DSC01055.JPG', 'image/jpeg', '5394247', 'JPG', '4320', '3240', NULL, 33);
INSERT INTO `upload` VALUES(173, '4e9005d7cb71f', 'DSC01057.JPG', 'image/jpeg', '5521452', 'JPG', '4320', '3240', NULL, 33);
INSERT INTO `upload` VALUES(174, '4e90072c51a1c', 'DSC01000.JPG', 'image/jpeg', '5613906', 'JPG', '4320', '3240', NULL, NULL);
INSERT INTO `upload` VALUES(175, '4e90072c714fa', 'DSC01003.JPG', 'image/jpeg', '5199354', 'JPG', '4320', '3240', NULL, NULL);
INSERT INTO `upload` VALUES(176, '4e90074931805', 'DSC01001.JPG', 'image/jpeg', '4990199', 'JPG', '4320', '3240', NULL, NULL);
INSERT INTO `upload` VALUES(177, '4e9007494f809', 'DSC01004.JPG', 'image/jpeg', '5276249', 'JPG', '4320', '3240', NULL, NULL);
INSERT INTO `upload` VALUES(178, '4e90077e4b8e5', 'DSC00986.JPG', 'image/jpeg', '5797134', 'JPG', '4320', '3240', 0, 34);
INSERT INTO `upload` VALUES(179, '4e90077e6be02', 'DSC01001.JPG', 'image/jpeg', '4990199', 'JPG', '4320', '3240', 0, 34);
INSERT INTO `upload` VALUES(180, '4e90077e6c467', 'DSC01005.JPG', 'image/jpeg', '5739289', 'JPG', '4320', '3240', 0, 34);
INSERT INTO `upload` VALUES(181, '4e900787594a8', 'DSC00986.JPG', 'image/jpeg', '5797134', 'JPG', '4320', '3240', 1, 34);
INSERT INTO `upload` VALUES(182, '4e9007876be88', 'DSC01006.JPG', 'image/jpeg', '5462124', 'JPG', '4320', '3240', 0, 34);
INSERT INTO `upload` VALUES(183, '4e9007876ccf1', 'DSC01008.JPG', 'image/jpeg', '5339364', 'JPG', '4320', '3240', 0, 34);
INSERT INTO `upload` VALUES(184, '4ea980582a56b', 'P4150418.JPG', 'image/jpeg', '2837697', 'JPG', '4288', '3216', 0, 36);
INSERT INTO `upload` VALUES(185, '4ea9805849385', 'P4150421.JPG', 'image/jpeg', '3045358', 'JPG', '4288', '3216', 0, 36);
INSERT INTO `upload` VALUES(186, '4ea98058499a2', 'P4150426.JPG', 'image/jpeg', '2713149', 'JPG', '4288', '3216', 1, 36);
INSERT INTO `upload` VALUES(187, '4ea980670af47', 'P4150436.JPG', 'image/jpeg', '2861617', 'JPG', '4288', '3216', 0, 36);
INSERT INTO `upload` VALUES(188, '4ea980671c1aa', 'P4150438.JPG', 'image/jpeg', '2732949', 'JPG', '4288', '3216', 0, 36);
INSERT INTO `upload` VALUES(189, '4eaad2959ae44', 'P4150419.JPG', 'image/jpeg', '3008883', 'JPG', '3216', '4288', NULL, NULL);
INSERT INTO `upload` VALUES(190, '4eaad2a280c80', 'P4150421.JPG', 'image/jpeg', '3045358', 'JPG', '4288', '3216', NULL, NULL);
INSERT INTO `upload` VALUES(191, '4eaad2fe2324c', 'P4150421.JPG', 'image/jpeg', '3045358', 'JPG', '4288', '3216', NULL, NULL);
INSERT INTO `upload` VALUES(192, '4eaad32fafa4f', 'P4150423.JPG', 'image/jpeg', '3160562', 'JPG', '4288', '3216', NULL, NULL);
INSERT INTO `upload` VALUES(193, '4eaad6eb77a6c', 'P4150423.JPG', 'image/jpeg', '3160562', 'JPG', '4288', '3216', NULL, NULL);
INSERT INTO `upload` VALUES(194, '4eaad7343d34e', 'P4150422.JPG', 'image/jpeg', '3294314', 'JPG', '4288', '3216', NULL, NULL);
INSERT INTO `upload` VALUES(195, '4eaad7ce659c2', 'P4150422.JPG', 'image/jpeg', '3294314', 'JPG', '4288', '3216', NULL, NULL);
INSERT INTO `upload` VALUES(196, '4eaad7f497a14', 'P4150420.JPG', 'image/jpeg', '2973452', 'JPG', '4288', '3216', NULL, NULL);
INSERT INTO `upload` VALUES(197, '4eaad80c55f81', 'P4150422.JPG', 'image/jpeg', '3294314', 'JPG', '4288', '3216', NULL, NULL);
INSERT INTO `upload` VALUES(198, '4eaad81455145', 'P4150424.JPG', 'image/jpeg', '3146648', 'JPG', '3216', '4288', NULL, NULL);
INSERT INTO `upload` VALUES(199, '4eaad8b0974e2', 'P4150421.JPG', 'image/jpeg', '3045358', 'JPG', '4288', '3216', NULL, NULL);
INSERT INTO `upload` VALUES(200, '4eaad8b573ded', 'P4150425.JPG', 'image/jpeg', '2890835', 'JPG', '4288', '3216', NULL, NULL);
INSERT INTO `upload` VALUES(201, '4eaad929796cc', 'P4150422.JPG', 'image/jpeg', '3294314', 'JPG', '4288', '3216', NULL, NULL);
INSERT INTO `upload` VALUES(202, '4eaad99862c9b', 'P4150419.JPG', 'image/jpeg', '3008883', 'JPG', '3216', '4288', NULL, NULL);
INSERT INTO `upload` VALUES(203, '4eaad9c43d7cf', 'P4150423.JPG', 'image/jpeg', '3160562', 'JPG', '4288', '3216', NULL, NULL);
INSERT INTO `upload` VALUES(204, '4eaad9d7d3a5c', 'P4160541.JPG', 'image/jpeg', '3042974', 'JPG', '4288', '3216', NULL, NULL);
INSERT INTO `upload` VALUES(205, '4eaadb02de7f2', 'P4150420.JPG', 'image/jpeg', '2973452', 'JPG', '4288', '3216', NULL, NULL);
INSERT INTO `upload` VALUES(206, '4eaadcb768956', 'P4150423.JPG', 'image/jpeg', '3160562', 'JPG', '4288', '3216', NULL, NULL);
INSERT INTO `upload` VALUES(207, '4eaadf8559bdb', 'P4150421.JPG', 'image/jpeg', '3045358', 'JPG', '4288', '3216', NULL, NULL);
INSERT INTO `upload` VALUES(208, '4eaadf8ebc9e0', 'P4160539.JPG', 'image/jpeg', '3075339', 'JPG', '4288', '3216', NULL, NULL);
INSERT INTO `upload` VALUES(209, '4eaae030c0b51', 'P4150420.JPG', 'image/jpeg', '2973452', 'JPG', '4288', '3216', NULL, NULL);
INSERT INTO `upload` VALUES(210, '4eaae0517816d', 'P4160534.JPG', 'image/jpeg', '2949294', 'JPG', '3216', '4288', NULL, NULL);
INSERT INTO `upload` VALUES(211, '4eaae11c28491', 'P4150420.JPG', 'image/jpeg', '2973452', 'JPG', '4288', '3216', 0, 37);
INSERT INTO `upload` VALUES(212, '4eaae1256caf1', 'P4150420.JPG', 'image/jpeg', '2973452', 'JPG', '4288', '3216', 1, 37);
INSERT INTO `upload` VALUES(213, '4eaae12571ee8', 'P4150442.JPG', 'image/jpeg', '2709598', 'JPG', '3216', '4288', 0, 37);
INSERT INTO `upload` VALUES(214, '4eaae12572423', 'P4150444.JPG', 'image/jpeg', '2899059', 'JPG', '4288', '3216', 0, 37);
INSERT INTO `upload` VALUES(215, '4eaae125728e7', 'P4150448.JPG', 'image/jpeg', '3031377', 'JPG', '4288', '3216', 0, 37);
INSERT INTO `upload` VALUES(216, '4eac1a804d37d', 'P4150415.JPG', 'image/jpeg', '3016549', 'JPG', '4288', '3216', 0, 38);
INSERT INTO `upload` VALUES(217, '4eac1a8063bd4', 'P4150420.JPG', 'image/jpeg', '2973452', 'JPG', '4288', '3216', 0, 38);
INSERT INTO `upload` VALUES(218, '4eac1a8064186', 'P4150424.JPG', 'image/jpeg', '3146648', 'JPG', '3216', '4288', 0, 38);
INSERT INTO `upload` VALUES(219, '4eac1a80646ba', 'P4150426.JPG', 'image/jpeg', '2713149', 'JPG', '4288', '3216', 1, 38);
INSERT INTO `upload` VALUES(220, '4eac1a806c635', 'P4150427.JPG', 'image/jpeg', '3041150', 'JPG', '4288', '3216', 0, 38);
INSERT INTO `upload` VALUES(221, '4eac1ac6b709c', 'P4150421.JPG', 'image/jpeg', '3045358', 'JPG', '4288', '3216', NULL, NULL);
INSERT INTO `upload` VALUES(222, '4eac1ac6c9d7e', 'P4150423.JPG', 'image/jpeg', '3160562', 'JPG', '4288', '3216', NULL, NULL);
INSERT INTO `upload` VALUES(223, '4eac1ac6ca3ad', 'P4150425.JPG', 'image/jpeg', '2890835', 'JPG', '4288', '3216', NULL, NULL);
INSERT INTO `upload` VALUES(224, '4eb2d7c40421f', 'P4150421.JPG', 'image/jpeg', '3045358', 'JPG', '150', '150', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `password` varchar(500) NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `address` varchar(455) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(1, 'Nerutiz', 'Nerijus', '0cc175b9c0f1b6a831c399e269772661', '4eaae0517816d.JPG', 'a@a.com', 'Ausros 94-10 Utena', 'Utena', 'Lithuania');
INSERT INTO `users` VALUES(2, 'local', 'localy', 'f5ddaf0ca7929578b408c909429f68f2', NULL, 'local@local.com', 'local', NULL, NULL);
INSERT INTO `users` VALUES(3, NULL, NULL, '703d438474bd4ce336bd41f74ee528e3', NULL, 'nerijus@dycode.net', NULL, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `things`
--
ALTER TABLE `things`
  ADD CONSTRAINT `fk_things_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `upload`
--
ALTER TABLE `upload`
  ADD CONSTRAINT `fk_images_things1` FOREIGN KEY (`things_id`) REFERENCES `things` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

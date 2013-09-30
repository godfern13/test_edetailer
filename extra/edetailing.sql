-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 06, 2013 at 12:56 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `edetailing`
--

-- --------------------------------------------------------

--
-- Table structure for table `animation`
--

CREATE TABLE IF NOT EXISTS `animation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `del_flag` int(11) NOT NULL DEFAULT '0' COMMENT '0:Active,1:In-Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `del_flag` int(11) NOT NULL DEFAULT '0' COMMENT '0:Active,1:In-Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Stores details of different brands' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `brand_vs_contents`
--

CREATE TABLE IF NOT EXISTS `brand_vs_contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) NOT NULL COMMENT 'Foreign Key-Reference brand table',
  `content_id` int(11) NOT NULL COMMENT 'Foreign Key-Reference content table',
  `del_flag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `child`
--

CREATE TABLE IF NOT EXISTS `child` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL COMMENT 'Foreign Key-Reference parent table',
  `name` varchar(500) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1:Textbox,2:Image,3:Video',
  `content_url` varchar(500) NOT NULL,
  `frame` varchar(500) NOT NULL,
  `isAnimated` int(11) NOT NULL COMMENT '0:No,1:Yes',
  `animType` int(11) NOT NULL COMMENT 'Foreign Key-Reference Animation Table',
  `animPathCord` varchar(1000) NOT NULL,
  `delayTime` int(11) NOT NULL,
  `content_extention` varchar(50) NOT NULL COMMENT 'jpg/gif/png..etc',
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `del_flag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `child_type`
--

CREATE TABLE IF NOT EXISTS `child_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `addded_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `del_flag` int(11) NOT NULL DEFAULT '0' COMMENT '0:Active,1:In-Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `downld_status` int(11) NOT NULL COMMENT '0:False,1:True',
  `isPublished` int(11) NOT NULL COMMENT '0:No,1:Yes',
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `del_flag` int(11) NOT NULL DEFAULT '0' COMMENT '0:Active,1:In-Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE IF NOT EXISTS `parent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL COMMENT 'Foreign Key-Reference content table',
  `name` varchar(500) NOT NULL,
  `content_url` varchar(500) NOT NULL,
  `has_childs` int(11) NOT NULL DEFAULT '0' COMMENT '0:No,1:Yes',
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `del_flag` int(11) NOT NULL DEFAULT '0' COMMENT '0:Active:1:In-Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Stores information of a single slide' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `references`
--

CREATE TABLE IF NOT EXISTS `references` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `child_id` int(11) NOT NULL COMMENT 'Foreign Key-References child table',
  `name` varchar(200) NOT NULL,
  `ref_link` varchar(1000) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `del_flag` int(11) NOT NULL DEFAULT '0' COMMENT '0:Active,1:In-Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `contact` bigint(20) DEFAULT NULL,
  `email_id` varchar(500) NOT NULL,
  `u_type` int(3) NOT NULL COMMENT '0:Admin,1:All users',
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_on` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `del_flag` int(11) NOT NULL DEFAULT '0' COMMENT '0:Active,1:In-Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `country`, `state`, `city`, `contact`, `email_id`, `u_type`, `added_on`, `updated_on`, `del_flag`) VALUES
(1, 'godfrey', 'karbens', '8f41ca03ab6a831622bdabc6a3cbe13b', 'India	', 'Goa', 'verna', 9822101010, 'godfrey@karbens.com', 0, '2013-09-04 11:16:11', '0000-00-00 00:00:00', 0),
(2, 'tony amol', 'aol', 'YW1vbA==', '', '', '', 0, 'godfern13@yahoo.co.in', 1, '2013-09-04 11:30:47', '0000-00-00 00:00:00', 0),
(3, 'john', 'karbens', 'a2FyYmVucw==', 'India', 'Goa', 'Verna', 9822103438, 'godfrey@karbens.com', 1, '2013-09-05 09:06:16', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_vs_brands`
--

CREATE TABLE IF NOT EXISTS `user_vs_brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'Foreign Key-Reference users table',
  `brand_id` int(11) NOT NULL COMMENT 'Foreign Key-Reference brand table',
  `del_flag` int(11) NOT NULL DEFAULT '0' COMMENT '0:Active,1:In-Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

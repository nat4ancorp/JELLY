-- phpMyAdmin SQL Dump
-- version 3.4.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 26, 2013 at 10:37 PM
-- Server version: 5.5.23
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mrnat4an_mts`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_queries`
--

CREATE TABLE IF NOT EXISTS `t_queries` (
  `ticket_id` varchar(300) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `poc` int(10) NOT NULL,
  `reason` int(10) NOT NULL,
  `contact_message` longtext NOT NULL,
  `extra_notes` longtext NOT NULL,
  `status` enum('Open','Escalated','Closed') NOT NULL DEFAULT 'Open',
  `dateandtime` datetime NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_queries`
--

INSERT INTO `t_queries` (`ticket_id`, `contact_name`, `contact_email`, `poc`, `reason`, `contact_message`, `extra_notes`, `status`, `dateandtime`, `is_searchable`) VALUES
('ama6.eha8-n7@3atnnl19mtcia0o7Nh', 'Nathan', 'nathan@email.com', 1, 1, 'I am testing this form out for the reason that I want to', '', 'Open', '2012-09-21 21:30:50', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `t_reasons`
--

CREATE TABLE IF NOT EXISTS `t_reasons` (
  `rcode` int(10) NOT NULL AUTO_INCREMENT,
  `reason` varchar(100) NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`rcode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `t_reasons`
--

INSERT INTO `t_reasons` (`rcode`, `reason`, `is_searchable`) VALUES
(1, 'Example Reason', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `t_staff_types`
--

CREATE TABLE IF NOT EXISTS `t_staff_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `t_staff_types`
--

INSERT INTO `t_staff_types` (`id`, `name`) VALUES
(1, 'Example Test Staff');

-- --------------------------------------------------------

--
-- Table structure for table `t_users`
--

CREATE TABLE IF NOT EXISTS `t_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `upass` varchar(100) NOT NULL,
  `type` enum('user','writer','mod','admin') NOT NULL,
  `is_searchable` enum('yes','no') NOT NULL DEFAULT 'yes',
  `staff_type` int(10) NOT NULL,
  `poc_code` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `t_users`
--

INSERT INTO `t_users` (`id`, `fname`, `lname`, `uname`, `upass`, `type`, `is_searchable`, `staff_type`, `poc_code`) VALUES
(1, 'Johnny', 'Tsunami', 'jtsunami', 'jsu', 'admin', 'no', 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

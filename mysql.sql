-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jul 12, 2014 at 09:11 PM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `empowered`
--

-- --------------------------------------------------------

--
-- Table structure for table `forumposts`
--

CREATE TABLE `forumposts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_id` int(11) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `subject` text NOT NULL,
  `text` text NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `dislikes` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `forumposts`
--

INSERT INTO `forumposts` (`id`, `forum_id`, `user_id`, `parent_id`, `subject`, `text`, `likes`, `dislikes`, `created`, `updated`) VALUES
(1, 1, 1, 0, 'Welcome', 'Welcome to the general discussion area', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 1, 1, '', 'Hello there and how are you?', 0, 0, '2014-07-12 18:58:48', '2014-07-12 18:58:48'),
(4, 1, 7, 1, '', 'Testing', 0, 0, '2014-07-12 19:11:50', '2014-07-12 19:11:50'),
(5, 1, 7, 1, '', 'I am good how are you?', 0, 0, '2014-07-12 19:11:56', '2014-07-12 19:11:56'),
(6, 1, 7, 1, '', 'I am good how are you?', 0, 0, '2014-07-12 19:12:08', '2014-07-12 19:12:08'),
(7, 1, 7, 1, '', 'Yes', 0, 0, '2014-07-12 19:12:48', '2014-07-12 19:12:48'),
(8, 1, 7, 0, 'Hello', 'How are you?', 0, 0, '2014-07-12 19:16:23', '2014-07-12 19:16:23'),
(9, 1, 7, 0, 'This is a test', 'Hello', 0, 0, '2014-07-12 19:16:30', '2014-07-12 19:16:30'),
(10, 1, 7, 9, '', 'Again', 0, 0, '2014-07-12 19:16:55', '2014-07-12 19:16:55'),
(11, 1, 7, 9, '', 'Whats going on', 0, 0, '2014-07-12 19:16:59', '2014-07-12 19:16:59');

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE `forums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` longtext NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`id`, `name`, `description`, `parent_id`, `created`, `updated`) VALUES
(1, 'General Discussion', 'General discussion on topics related to carers', 0, '2014-07-12 18:30:31', '2014-07-12 18:30:31'),
(2, 'Events', 'Discuss upcoming events or organise community events for carers and those being cared for.', 0, '2014-07-12 18:30:31', '2014-07-12 18:30:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `is_carer` int(11) NOT NULL DEFAULT '0',
  `is_disabled` int(11) NOT NULL DEFAULT '0',
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `postcode` text NOT NULL,
  `address` text NOT NULL,
  `state` text NOT NULL,
  `age` int(11) NOT NULL,
  `gender` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `is_carer`, `is_disabled`, `firstname`, `lastname`, `postcode`, `address`, `state`, `age`, `gender`, `created`, `modified`) VALUES
(1, 'admin', '9ad139cdc148bb3bb602c82d7f3f0a3e28cd0a28', 'admin', 0, 0, '', '', '', '', '', 0, '', '2014-07-12 13:59:20', '2014-07-12 13:59:20'),
(7, 'simultech', '3d49fa6d6f5bed7dd46b4d8ffb0d1aeb9f9bd893', 'user', 1, 0, 'Andrew', 'Dekker', '4078', '7 Weyba Close', 'qld', 29, 'female', '2014-07-12 17:20:54', '2014-07-12 17:45:32');

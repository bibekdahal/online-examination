-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2014 at 10:43 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `frobi-online-examination`
--
CREATE DATABASE IF NOT EXISTS `frobi-online-examination` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `frobi-online-examination`;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`user_id`, `time`) VALUES
(1, '1402858428'),
(1, '1402858626'),
(1, '1402858990'),
(1, '1402859003'),
(1, '1402915840'),
(1, '1402915903'),
(1, '1402916307'),
(1, '1402916311'),
(1, '1402916314'),
(1, '1402916318');

-- --------------------------------------------------------

--
-- Table structure for table `question_sets`
--

CREATE TABLE IF NOT EXISTS `question_sets` (
  `setid` int(11) NOT NULL AUTO_INCREMENT,
  `imagesfolder` varchar(100) NOT NULL,
  PRIMARY KEY (`setid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `question_sets`
--

INSERT INTO `question_sets` (`setid`, `imagesfolder`) VALUES
(1, '1acnsj'),
(2, '2acnsj'),
(3, '3acnsj'),
(4, '4acnsj'),
(5, '5acnsj'),
(6, '6acnsj'),
(7, '7acnsj');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `qid` int(11) NOT NULL AUTO_INCREMENT,
  `setid` int(11) NOT NULL,
  `sn` int(11) NOT NULL,
  `question` mediumtext NOT NULL,
  `optiona` mediumtext NOT NULL,
  `optionb` mediumtext NOT NULL,
  `optionc` mediumtext NOT NULL,
  `optiond` mediumtext NOT NULL,
  PRIMARY KEY (`qid`),
  KEY `setid` (`setid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qid`, `setid`, `sn`, `question`, `optiona`, `optionb`, `optionc`, `optiond`) VALUES
(1, 1, 1, 'HELLO?', 'WORLD', 'NOT WORLD', 'BOLD', 'NOT BOLD'),
(2, 1, 2, 'What is <img src="images/1acnsj/2x0.png" />?<br/>', 'TEST', 'sdajhasdj', 'jcxmv', 'qw[e;'),
(3, 1, 3, 'The minimum value of n(A&#8745;B) when n(U) = 120, n(A) = 90, n(B) = 55 is', '40', '25', '50', '30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  `question_set` int(11) NOT NULL,
  `exam_start_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `salt`, `question_set`, `exam_start_time`) VALUES
(1, 'test_user', 'test_user@test.com', '00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc', 'f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef', 1, '2014-06-19 11:28:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`setid`) REFERENCES `question_sets` (`setid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

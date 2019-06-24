-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2016 at 07:59 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `free_paper`
--

-- --------------------------------------------------------

--
-- Table structure for table `paper`
--

CREATE TABLE IF NOT EXISTS `examen` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nombre_exam` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `paper`
--

INSERT INTO `examen` (`id`, `nombre_exam`) VALUES
(2, 'BCA June-2016'),
(3, 'MCA DEC-2016');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `pregunta` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `examen` varchar(255) NOT NULL,
  `pregunta` text NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `obj1` varchar(255) NOT NULL,
  `obj2` varchar(255) NOT NULL,
  `obj3` varchar(255) NOT NULL,
  `obj4` varchar(255) NOT NULL,
  `v_f` varchar(255) NOT NULL,
  `una_palabra` varchar(255) NOT NULL,
  `respuesta` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `pregunta` (`id`, `examen`, `pregunta`, `tipo`, `obj1`, `obj2`, `obj3`, `obj4`, `v_f`, `una_palabra`, `respuesta`) VALUES
(1, '2', 'asdsadsadsa da', 'Multiple Choice', 'eeeee11', 'ddddd', 'rrrrrtt', 'tttttttttgg', '', '', 'eeeee11'),
(2, '2', 'dfds', 'True/False', '', '', '', '', 'True', '', 'True'),
(3, '2', 'sdfdsf', 'One Word', '', '', '', '', '', 'rrrrrrrrrrrr', 'rrrrrrrrrrrr'),
(4, '3', 'xcxz', 'Multiple Choice', 'sad', 'mad', 'pad', 'lad', '', '', 'sad');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `usuario` (`id`, `nombre_usuario`, `password`, `nombre`, `apellido`, `emailid`) VALUES
(1, 'admin', 'admin', 'Aamir', 'Khan', 'aamir@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

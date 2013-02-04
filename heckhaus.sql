-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 28. Feb 2013 um 15:22
-- Server Version: 5.5.20
-- PHP-Version: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `heckhaus`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `primarytasks`
--

CREATE TABLE IF NOT EXISTS `primarytasks` (
  `ptid` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  `duedate` date NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`ptid`),
  UNIQUE KEY `ptid` (`ptid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `primarytasks`
--

INSERT INTO `primarytasks` (`ptid`, `pid`, `duedate`, `name`) VALUES
(1, 10, '2013-01-02', 'E'),
(2, 10, '2013-01-09', 'A'),
(3, 9, '2013-01-15', 'U'),
(4, 9, '2013-01-01', 'Z');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `color` varchar(7) NOT NULL,
  PRIMARY KEY (`pid`),
  UNIQUE KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Daten für Tabelle `projects`
--

INSERT INTO `projects` (`pid`, `name`, `startdate`, `enddate`, `color`) VALUES
(9, 'Reebok', '2013-01-16', '2013-01-18', '#00FF00'),
(10, 'Heckhaus', '2013-01-02', '2013-01-04', '#990000'),
(11, 'Siegerth', '2013-01-02', '2013-01-04', '#990000');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `taskroles`
--

CREATE TABLE IF NOT EXISTS `taskroles` (
  `trid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `color` varchar(7) NOT NULL,
  PRIMARY KEY (`trid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `taskroles`
--

INSERT INTO `taskroles` (`trid`, `name`, `color`) VALUES
(1, 'design', '#7E88AB'),
(2, 'planung', '#A4CAD6');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `tid` int(10) NOT NULL AUTO_INCREMENT,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `pid` int(10) NOT NULL,
  `trid` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  PRIMARY KEY (`tid`),
  UNIQUE KEY `tid` (`tid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Daten für Tabelle `tasks`
--

INSERT INTO `tasks` (`tid`, `startdate`, `enddate`, `pid`, `trid`, `uid`) VALUES
(1, '2013-01-04', '2013-01-05', 9, 1, 1),
(2, '2013-01-02', '2013-01-04', 10, 1, 3),
(4, '2013-01-02', '2013-02-07', 9, 1, 3),
(5, '2013-01-01', '2013-01-24', 10, 1, 2),
(6, '2013-01-01', '2013-01-04', 10, 2, 1),
(7, '2013-01-13', '2013-01-17', 9, 2, 1),
(8, '2013-01-20', '2013-01-24', 9, 1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `role` int(10) NOT NULL,
  `usershortname` varchar(2) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`uid`, `role`, `usershortname`, `username`, `password`) VALUES
(1, 9, 'KS', 'ksiegerth', '987654321'),
(2, 9, 'AS', 'astrehle', '987654321'),
(3, 9, 'HB', 'hbear', '987654321');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

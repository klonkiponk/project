-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 04. Feb 2013 um 15:23
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
  `enddate` date NOT NULL,
  `startdate` date NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`ptid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Daten für Tabelle `primarytasks`
--

INSERT INTO `primarytasks` (`ptid`, `pid`, `enddate`, `startdate`, `name`) VALUES
(19, 10, '2013-02-04', '2013-02-01', 'Einbau'),
(24, 22, '2013-02-15', '2013-02-10', 'Einbau'),
(22, 11, '2013-01-25', '2013-01-15', 'Primary Task'),
(13, 11, '2013-01-09', '2013-01-03', 'erster Task'),
(25, 22, '2013-02-19', '2013-02-16', 'Einbau'),
(21, 17, '2013-02-06', '2013-02-07', 'ghj');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Daten für Tabelle `projects`
--

INSERT INTO `projects` (`pid`, `name`, `startdate`, `enddate`, `color`) VALUES
(10, 'Heckhaus', '2013-01-02', '2013-01-04', 'green'),
(11, 'Siegerth', '2013-01-02', '2013-05-31', 'blue'),
(22, 'Reebok', '2013-02-01', '2013-02-28', 'green');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `taskroles`
--

CREATE TABLE IF NOT EXISTS `taskroles` (
  `trid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `color` varchar(7) NOT NULL,
  PRIMARY KEY (`trid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `taskroles`
--

INSERT INTO `taskroles` (`trid`, `name`, `color`) VALUES
(1, 'design', 'red'),
(2, 'planung', 'black'),
(3, 'primary', '#000000');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Daten für Tabelle `tasks`
--

INSERT INTO `tasks` (`tid`, `startdate`, `enddate`, `pid`, `trid`, `uid`) VALUES
(2, '2013-01-02', '2013-01-04', 10, 1, 3),
(5, '2013-01-01', '2013-01-24', 10, 1, 2),
(6, '2013-01-01', '2013-01-04', 10, 2, 1),
(11, '2013-02-25', '2013-03-13', 10, 1, 3),
(15, '2013-01-01', '2014-01-16', 9, 1, 4),
(21, '2013-01-06', '2013-01-09', 11, 3, 1),
(22, '2013-01-11', '2013-01-31', 11, 2, 3),
(25, '2013-01-15', '2013-01-20', 11, 2, 2),
(26, '2013-02-01', '2013-02-10', 9, 1, 6),
(40, '2013-01-04', '2013-05-01', 9, 1, 5),
(41, '2013-01-01', '2013-01-05', 11, 2, 6),
(42, '2013-02-01', '2013-02-20', 20, 2, 1),
(44, '2013-02-01', '2013-02-28', 22, 2, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `userroles`
--

CREATE TABLE IF NOT EXISTS `userroles` (
  `urid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`urid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `userroles`
--

INSERT INTO `userroles` (`urid`, `name`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'editor');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`uid`, `role`, `usershortname`, `username`, `password`) VALUES
(1, 1, 'KS', 'ksiegerth', '987654321'),
(2, 2, 'AS', 'astrehle', '987654321');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.1.14.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 03. Sep 2014 um 08:15
-- Server Version: 5.1.73-1
-- PHP-Version: 5.3.28-1~nc.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `usr_web836_2`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sensors`
--

CREATE TABLE IF NOT EXISTS `sensors` (
  `sensor_id` int(5) NOT NULL AUTO_INCREMENT,
  `sensor_unit` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sensor_hardware_id` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` int(1) NOT NULL,
  `sensor_group_id` int(5) NOT NULL,
  `sensor_html_color` varchar(7) NOT NULL,
  `sensor_symbol` varchar(25) NOT NULL,
  PRIMARY KEY (`sensor_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `sensors`
--

INSERT INTO `sensors` (`sensor_id`, `sensor_unit`, `name`, `sensor_hardware_id`, `description`, `status`, `sensor_group_id`, `sensor_html_color`, `sensor_symbol`) VALUES
(1, '°C', 'Balkon (Schatten)', '28-000004026ed7', '', 1, 1, '#0d3d6f', 'circle'),
(2, '°C', 'Wohnzimmer Hifi Rack Oben rechts (Router)', '28-000004028a65', '', 0, 1, '#459df6', 'triangle'),
(3, '°C', 'Raspberry Pi CPU Temperatur', '5fd7fe', '', 1, 2, '#ff0000', 'cross'),
(4, '°C', 'Test Sensor', 'asdf', 'asdf', 0, 2, '#fff', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sensor_groups`
--

CREATE TABLE IF NOT EXISTS `sensor_groups` (
  `sensor_group_id` int(5) NOT NULL DEFAULT '0',
  `group_name` varchar(255) NOT NULL,
  `group_description` text NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`sensor_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sensor_values`
--

CREATE TABLE IF NOT EXISTS `sensor_values` (
  `value_id` int(10) NOT NULL AUTO_INCREMENT,
  `value` varchar(20) NOT NULL,
  `sensor_id` varchar(40) NOT NULL,
  `timestamp` int(255) NOT NULL,
  PRIMARY KEY (`value_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;

--
-- Daten für Tabelle `sensor_values`
--

INSERT INTO `sensor_values` (`value_id`, `value`, `sensor_id`, `timestamp`) VALUES
(44, '15.56', '1', 1409699701),
(43, '35.8', '3', 1409698801),
(42, '15.38', '1', 1409698801),
(41, '35.8', '3', 1409697902),
(40, '15.75', '1', 1409697902),
(39, '35.8', '3', 1409697001),
(38, '17.06', '1', 1409697001),
(37, '35.8', '3', 1409696101),
(36, '18.88', '1', 1409696101),
(35, '35.8', '3', 1409695797),
(34, '19.06', '1', 1409695797),
(33, '35.8', '3', 1409695201),
(32, '18.75', '1', 1409695201),
(23, '35.8', '3', 1409693044),
(22, '19.13', '1', 1409693044),
(21, '36.3', '3', 1409692996),
(20, '19.31', '1', 1409692996),
(45, '35.8', '3', 1409699701),
(46, '15.31', '1', 1409700602),
(47, '35.2', '3', 1409700602),
(48, '15.19', '1', 1409701501),
(49, '35.8', '3', 1409701501),
(50, '15', '1', 1409702402),
(51, '34.7', '3', 1409702402),
(52, '14.94', '1', 1409703301),
(53, '34.7', '3', 1409703301),
(54, '14.94', '1', 1409704201),
(55, '34.7', '3', 1409704201),
(56, '14.81', '1', 1409705101),
(57, '34.7', '3', 1409705101),
(58, '14.5', '1', 1409706001),
(59, '34.7', '3', 1409706001),
(60, '14.5', '1', 1409706902),
(61, '34.7', '3', 1409706902),
(62, '14.63', '1', 1409707802),
(63, '34.7', '3', 1409707802),
(64, '14.44', '1', 1409708701),
(65, '34.2', '3', 1409708701),
(66, '14.44', '1', 1409709601),
(67, '33.6', '3', 1409709601),
(68, '14.38', '1', 1409710501),
(69, '34.2', '3', 1409710501),
(70, '14.38', '1', 1409711401),
(71, '34.7', '3', 1409711401),
(72, '14.19', '1', 1409712301),
(73, '34.7', '3', 1409712301),
(74, '14', '1', 1409713202),
(75, '34.7', '3', 1409713202),
(76, '14.13', '1', 1409714101),
(77, '34.7', '3', 1409714101),
(78, '14', '1', 1409715001),
(79, '34.2', '3', 1409715001),
(80, '13.88', '1', 1409715902),
(81, '34.7', '3', 1409715902),
(82, '13.81', '1', 1409716801),
(83, '34.2', '3', 1409716801),
(84, '13.63', '1', 1409717702),
(85, '33.6', '3', 1409717702),
(86, '13.75', '1', 1409718601),
(87, '34.2', '3', 1409718601),
(88, '13.69', '1', 1409719502),
(89, '33.6', '3', 1409719502),
(90, '13.81', '1', 1409720401),
(91, '33.6', '3', 1409720401),
(92, '13.88', '1', 1409721301),
(93, '34.2', '3', 1409721301),
(94, '14.13', '1', 1409722202),
(95, '34.2', '3', 1409722202),
(96, '14.31', '1', 1409723101),
(97, '34.7', '3', 1409723101),
(98, '14.5', '1', 1409724002),
(99, '34.2', '3', 1409724002),
(100, '14.81', '1', 1409724901),
(101, '34.2', '3', 1409724901);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `system_user`
--

CREATE TABLE IF NOT EXISTS `system_user` (
  `system_user_id` int(3) NOT NULL AUTO_INCREMENT,
  `system_user_name` varchar(32) NOT NULL,
  `system_user_login_name` varchar(32) NOT NULL,
  `system_user_email` varchar(64) NOT NULL,
  `system_user_password` varchar(255) NOT NULL,
  `system_user_salt` varchar(255) NOT NULL,
  `system_user_status` int(1) NOT NULL,
  `system_user_last_login` int(30) NOT NULL,
  `system_user_last_ip` varchar(15) NOT NULL,
  PRIMARY KEY (`system_user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `system_user`
--

INSERT INTO `system_user` (`system_user_id`, `system_user_name`, `system_user_login_name`, `system_user_email`, `system_user_password`, `system_user_salt`, `system_user_status`, `system_user_last_login`, `system_user_last_ip`) VALUES
(1, 'Sascha Gering', 'geringsa', 'sascha@gering.it', '', '', 1, 1409452737, ''),
(2, 'Jan Jastrow', 'jastroja', 'jan@jastrow.me', '', '', 1, 1409452772, ''),
(3, 'Erna Test', 'tester', 'erna.test@ichwerdegetestet.de', '', '', 0, 1400160032, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 08, 2013 at 11:44 AM
-- Server version: 5.1.66
-- PHP Version: 5.3.3-7+squeeze14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `comp3715project1`
--

-- --------------------------------------------------------

--
-- Table structure for table `Airlines`
--
-- Creation: Mar 05, 2013 at 01:38 PM
-- Last update: Mar 07, 2013 at 01:47 PM
--

CREATE TABLE IF NOT EXISTS `Airlines` (
  `code` varchar(2) NOT NULL,
  `name` varchar(50) NOT NULL,
  `shortName` varchar(25) NOT NULL,
  UNIQUE KEY `code` (`code`,`name`,`shortName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Airlines`
--

INSERT INTO `Airlines` (`code`, `name`, `shortName`) VALUES
('AA', 'American Airways', 'American'),
('DL', 'Delta Airlines', 'Delta'),
('JB', 'JetBlue Airlines', 'JetBlue'),
('NW', 'Northwest Airlines', 'Northwest'),
('SW', 'Southwest Airlines', 'Southwest'),
('UA', 'United Airlines', 'United');

-- --------------------------------------------------------

--
-- Table structure for table `Airports`
--
-- Creation: Mar 05, 2013 at 04:33 PM
-- Last update: Mar 07, 2013 at 01:47 PM
--

CREATE TABLE IF NOT EXISTS `Airports` (
  `code` varchar(3) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(2) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Airports`
--

INSERT INTO `Airports` (`code`, `city`, `state`) VALUES
('LAX', 'Los Angeles', 'CA'),
('MEM', 'Memphis', 'TN'),
('ATL', 'Atlanta', 'GA'),
('SEA', 'Seattle', 'WA'),
('LGB', 'Long Beach', 'CA'),
('HNL', 'Honolulu', 'HI');

-- --------------------------------------------------------

--
-- Table structure for table `FlightInfo`
--
-- Creation: Mar 05, 2013 at 01:46 PM
-- Last update: Mar 07, 2013 at 01:48 PM
--

CREATE TABLE IF NOT EXISTS `FlightInfo` (
  `airline` varchar(2) NOT NULL,
  `flightNumber` int(4) NOT NULL,
  `origin` varchar(3) NOT NULL,
  `destination` varchar(3) NOT NULL,
  `depart_time` time NOT NULL,
  `arrive_time` time NOT NULL,
  PRIMARY KEY (`airline`,`flightNumber`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `FlightInfo`:
--   `airline`
--       `Airlines` -> `code`
--   `destination`
--       `Airports` -> `code`
--   `origin`
--       `Airports` -> `code`
--

--
-- Dumping data for table `FlightInfo`
--

INSERT INTO `FlightInfo` (`airline`, `flightNumber`, `origin`, `destination`, `depart_time`, `arrive_time`) VALUES
('AA', 9999, 'LAX', 'LAX', '00:00:00', '00:00:00'),
('DL', 1234, 'MEM', 'ATL', '09:00:00', '10:45:00'),
('DL', 5588, 'MEM', 'LAX', '17:30:00', '19:30:00'),
('JB', 5678, 'LGB', 'HNL', '12:00:00', '14:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Flights`
--
-- Creation: Mar 05, 2013 at 01:49 PM
-- Last update: Mar 07, 2013 at 01:47 PM
--

CREATE TABLE IF NOT EXISTS `Flights` (
  `airline` varchar(2) NOT NULL,
  `flightNumber` int(4) NOT NULL,
  `date` date NOT NULL,
  `num_of_seats` int(11) NOT NULL,
  PRIMARY KEY (`airline`,`flightNumber`,`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `Flights`:
--   `airline`
--       `Airlines` -> `code`
--   `flightNumber`
--       `FlightInfo` -> `flightNumber`
--

--
-- Dumping data for table `Flights`
--

INSERT INTO `Flights` (`airline`, `flightNumber`, `date`, `num_of_seats`) VALUES
('DL', 5588, '2013-03-09', 354),
('DL', 1234, '2013-03-06', 100),
('JB', 5678, '2013-03-07', 20),
('DL', 1234, '2013-03-29', 350);

-- --------------------------------------------------------

--
-- Table structure for table `Tickets`
--
-- Creation: Mar 05, 2013 at 02:18 PM
-- Last update: Mar 07, 2013 at 01:24 PM
--

CREATE TABLE IF NOT EXISTS `Tickets` (
  `customerID` int(11) NOT NULL,
  `airline` varchar(2) NOT NULL,
  `flightNumber` varchar(4) NOT NULL,
  `date` date NOT NULL,
  `seat_number` int(11) NOT NULL,
  PRIMARY KEY (`airline`,`flightNumber`,`date`,`seat_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `Tickets`:
--   `airline`
--       `Airlines` -> `code`
--   `flightNumber`
--       `FlightInfo` -> `flightNumber`
--

--
-- Dumping data for table `Tickets`
--


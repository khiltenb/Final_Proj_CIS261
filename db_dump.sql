-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 19, 2021 at 07:54 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `StudyTime`
--
CREATE DATABASE IF NOT EXISTS `StudyTime` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `StudyTime`;

-- --------------------------------------------------------

--
-- Table structure for table `ClassInfo`
--

DROP TABLE IF EXISTS `ClassInfo`;
CREATE TABLE `ClassInfo` (
  `CRN` int(11) NOT NULL,
  `CourseID` varchar(255) NOT NULL,
  `Professor` text NOT NULL,
  `CMON` text NOT NULL,
  `CTUE` text NOT NULL,
  `CWED` text NOT NULL,
  `CTHU` text NOT NULL,
  `CFRI` text NOT NULL,
  `CSAT` text NOT NULL,
  `CSUN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ClassInfo`
--

INSERT INTO `ClassInfo` (`CRN`, `CourseID`, `Professor`, `CMON`, `CTUE`, `CWED`, `CTHU`, `CFRI`, `CSAT`, `CSUN`) VALUES
(0, 'CIS230.120', 'Tim Moriarty', '1:30.pm-3.pm', 'None', '1:30.pm-3.pm', 'None', 'None', 'None', 'None'),
(1, 'CIS115.110', 'Tim Moriarty', 'None', '1:30.pm-3.pm', 'None', '1:30.pm-3.pm', 'None', 'None', 'None'),
(2, 'CIS261.980', 'Garry Daly', 'None', '6.pm-9:30.pm', 'None', 'None', 'None', 'None', 'None'),
(3, 'WEB1115.220', 'Garry Daly', '9.am-12.pm', 'None', '9.am-12.pm', 'None', 'None', 'None', 'None'),
(4, 'CIS130.420', 'Maya Tolappa', 'None', '8:30.am-11.am', 'None', '8:30.am-11.am', 'None', 'None', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `PersonalSchedule`
--

DROP TABLE IF EXISTS `PersonalSchedule`;
CREATE TABLE `PersonalSchedule` (
  `EventNum` text NOT NULL,
  `EventName` text NOT NULL,
  `EMON` text NOT NULL,
  `ETUE` text NOT NULL,
  `EWED` text NOT NULL,
  `ETHU` text NOT NULL,
  `EFRI` text NOT NULL,
  `ESAT` date NOT NULL,
  `ESUN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ProfessorInfo`
--

DROP TABLE IF EXISTS `ProfessorInfo`;
CREATE TABLE `ProfessorInfo` (
  `Professor` text NOT NULL,
  `PMON` text NOT NULL DEFAULT 'None',
  `PTUE` text NOT NULL DEFAULT 'None',
  `PWED` text NOT NULL DEFAULT 'None',
  `PTHU` text NOT NULL DEFAULT 'None',
  `PFRI` text NOT NULL DEFAULT 'None',
  `PSAT` text NOT NULL DEFAULT 'None',
  `PSUN` text NOT NULL DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ProfessorInfo`
--

INSERT INTO `ProfessorInfo` (`Professor`, `PMON`, `PTUE`, `PWED`, `PTHU`, `PFRI`, `PSAT`, `PSUN`) VALUES
('Garry Daly', '8.am-9.am;12:30.pm-2.pm', '4.pm-6.pm', '8.am-9.am;12:30.pm-2.pm', '11.am-4.pm', '11.am-4.pm', '11.am-2.pm', 'None'),
('Maya Tolappa', '8.am-2.pm', '7.am-8:30.am;12.pm-2.pm', '8.am-2.pm', '7.am-8:30.am;12.pm-2.pm', '12.pm-3.pm', '11.am-2.pm', 'None'),
('Tim Moriarty', '11.am-1:20.pm;3.pm-5.pm', '11.am-1:20.pm;3.pm-5.pm', '11.am-1:20.pm;3.pm-5.pm', '11.am-1:20.pm;3.pm-5.pm', '9.am-2.pm', '9.am-12.pm', 'None');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ClassInfo`
--
ALTER TABLE `ClassInfo`
  ADD PRIMARY KEY (`CRN`);

--
-- Indexes for table `PersonalSchedule`
--
ALTER TABLE `PersonalSchedule`
  ADD PRIMARY KEY (`EventNum`(50));

--
-- Indexes for table `ProfessorInfo`
--
ALTER TABLE `ProfessorInfo`
  ADD PRIMARY KEY (`Professor`(50));
COMMIT;

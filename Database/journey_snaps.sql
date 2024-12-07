-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2024 at 01:23 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `journey_snaps`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminEmail` varchar(30) NOT NULL,
  `adminName` varchar(30) NOT NULL,
  `pNumber` varchar(10) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminEmail`, `adminName`, `pNumber`, `password`) VALUES
('pramith@journeysnaps.lk', 'Pramith Fernando', '0768674823', '456456'),
('vishwa@journeysnaps.lk', 'Vishwa Saranga', '0711032918', '123123');

-- --------------------------------------------------------

--
-- Table structure for table `msg`
--

CREATE TABLE `msg` (
  `msgId` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `message` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `msg`
--

INSERT INTO `msg` (`msgId`, `name`, `email`, `message`) VALUES
(1001, 'Vikum', 'vikum@gmail.com', 'Hi! I want to buy printed photos'),
(1002, 'Pathum', 'pathum@gmail.com', 'Hi there, can you contact me asap?'),
(1007, 'Chathura Udayanga', 'chathura@gmail.com', 'I have a problem here'),
(1009, 'Vishwa Saranga', 'saranga@gmail.com', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userName` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pNumber` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `nic` varchar(12) NOT NULL,
  `password` varchar(30) NOT NULL,
  `DPpath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userName`, `email`, `pNumber`, `address`, `nic`, `password`, `DPpath`) VALUES
('Chathura Samarathunga', 'chathura@gmail.com', '0775846921', 'Udahamulla, Sri Lanka', '200015426214', '852852', ''),
('Pramith Fernando', 'pramith@gmail.com', '0777032918', 'Panadura, Sri Lanka', '200025421588', '147147', 'Images/Profile/Screenshot 2024-10-27 184719.png'),
('Vishwa Saranga', 'saranga@gmail.com', '0711075884', 'Malabe, Sri Lanka', '200104602540', '123123', 'Images/Profile/20220508_1215411.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminEmail`);

--
-- Indexes for table `msg`
--
ALTER TABLE `msg`
  ADD PRIMARY KEY (`msgId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `msg`
--
ALTER TABLE `msg`
  MODIFY `msgId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1010;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 16, 2019 at 05:59 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbDevSoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `regID` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `school` varchar(100) NOT NULL,
  `grade` varchar(3) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `regDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`regID`, `firstname`, `lastname`, `school`, `grade`, `phone`, `email`, `regDate`) VALUES
(6, 'Judalyn', 'Rivera', 'Sit', '3', '9772597948', 'judalyn.rivera.8@gmail.com', '2019-09-16'),
(7, 'Jeff', 'Rivera', 'Sit', '3', '09055290921', 'jeff@g.c', '2019-09-16'),
(8, 'Salome', 'Tamondong', 'Hrm', '1', '09081626128', 'salome@g.c', '2019-09-16'),
(9, 'Junrey', 'Rivera', 'Sbaa', '1', '09801234567', 'j@c.v', '2019-09-16'),
(10, 'Jhulyn', 'Gelia', 'Hrm', '1', '09071292387', 'j@c.d', '2019-09-16'),
(11, 'Juanita', 'Gelia', 'Hrm', '1', '9177920652', 'juanita.gelia@gmail.com', '2019-09-16'),
(12, 'Hjk', 'Jk', 'Ghjk', '1', '09876543235', 'j@h.w', '2019-09-16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`regID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `regID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

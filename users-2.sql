-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 13, 2024 at 10:08 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sunnysmile`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `security_question` varchar(255) NOT NULL,
  `security_answer` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `drName` varchar(50) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `security_question`, `security_answer`, `profile_image`, `drName`, `purpose`, `date`) VALUES
(1, 'A', '$2y$10$1gKYaanlnCVUBmkUI2vcdOeTTSFb5XcDFyzz.aWfXzA8j6FmHFBOG', 'A@gmail.com', 'school', 'aa', '', '', '', NULL),
(19, 'aaa', '$2y$10$2xS4Cwqr3t9zQlMcWz8MseHFpGFgaHhnioqjUICbA7ksYo7xvb7ya', 'aaa@gmail.com', 'mother-maiden', 'aaa', '', '', '', NULL),
(21, 'ee', '$2y$10$Zl2KvOgFz1WADTwh82gKzuFJ1SMLE5TGwrp/.CHW/mnkEWaMGxVv2', 'eee@gmail.com', 'first-car', 'eee', '', '', '', NULL),
(23, 'rrr', '$2y$10$RjfI.kQfa/Az50CuIdg4n.aevsBD8GSdoy88aFqwMJ9PNwa.dJSsu', 'rrr@gmail.com', 'school', 'rrr', '', '', '', NULL),
(24, 'uuu', '$2y$10$19/pedg3ta9.dC9QqVc48uGZoiqN23xByxc11DC5lyKjOpAEaAu9K', 'uuu@gmail.com', 'school', 'uuu', '', '', '', NULL),
(26, 'qqq', '$2y$10$1HVAKWSxRXYeLCwp8wZVru2A5UY02.3I7FEssS/lrz7A6nmINk212', 'qqq@gmail.com', 'mother-maiden', 'qqq', '', '', '', NULL),
(27, 'sss', '$2y$10$GqEXSxDFR6uX5b67j3U4Qesu8l5pwvlQzRYHbDwj9J44UxnPprO2m', 'sss@gmail.com', 'pet', 'sss', '', '', '', NULL),
(28, 'eee', '$2y$10$ZHzEFmAyugfAqypWXHCdoO8PtqRIp2qLJAkosMTPRX4Cdb.oQSBHa', 'eee@gmail.com', 'mother-maiden', 'eee', '', '', '', NULL),
(29, 'iii', '$2y$10$KStzqLnKIWrFxyzyPDWMn.2qOGI.JjKgng075f0JpuMD0tFdJ6GPq', 'iii@gmail.com', 'school', 'iii', '', '', '', NULL),
(30, 'ooo', '$2y$10$a1Ehs4xzIe9SIPwH1LHvR.fo7ljN3buA/xV8JVCNQ7zVnjnucYnBO', 'ooo@gmail.com', 'pet', 'ooo', '', '', '', NULL),
(31, 'Rika', '$2y$10$4wJMLVABvevs4.rg3KC68eUrN4I3eoENZd2jSQj2sdJDkfgVsfxqG', 'rika@gmail.com', 'pet', 'rika', NULL, '', '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

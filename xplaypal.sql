-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2023 at 01:01 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xplaypal`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 Member 1 Librarian (Admin) 2 Management',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mob` varchar(10) NOT NULL,
  `reg_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `usertype`, `name`, `email`, `mob`, `reg_at`) VALUES
(1, 'ybtheflash', '$2y$10$ZK7hAmHKmT92M1zNiN1YTu1MdD/EXfzBSV8pK7ecI66hNJ62NwU76', 0, 'Yubaraj', 'ybtheflash@gmail.com', '9883289005', '2023-10-31 03:44:57');

-- --------------------------------------------------------

--
-- Table structure for table `pldiscs`
--

CREATE TABLE `pldiscs` (
  `d_id` int(11) NOT NULL,
  `dname` varchar(255) NOT NULL,
  `dabout` longtext NOT NULL,
  `dgenre` varchar(255) NOT NULL,
  `dtype` tinyint(1) NOT NULL COMMENT '1 CD 2 DVD 3 BD (Blu-Ray)',
  `dstock` varchar(1000) NOT NULL DEFAULT '0',
  `dadded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pldiscs`
--

INSERT INTO `pldiscs` (`d_id`, `dname`, `dabout`, `dgenre`, `dtype`, `dstock`, `dadded`) VALUES
(1, 'Hybrid Theory - Linkin Park', 'Hybrid Theory is the debut studio album by American rock band Linkin Park, released on October 24, 2000, through Warner Bros. Records.', 'Music', 1, '50', '2023-10-30 09:40:17'),
(2, 'V - Maroon 5', 'V is the fifth studio album by American band Maroon 5. The album was released on August 29, 2014, through 222 and Interscope Records. V was Maroon 5\'s first album to be released through Interscope after the band\'s previous label, A&M Octone Records, transferred them along with most of its artists to Interscope.', 'Music', 2, '1000', '2023-10-30 09:43:22'),
(3, 'The Elephant Whisperers', 'Bomman and Bellie, a couple in South India, devote their lives to caring for an orphaned baby elephant named Raghu, forging a family like no other that tests the barrier between the human and the animal world.', 'Documentary', 3, '2', '2023-10-30 09:43:22'),
(4, 'Meteora - Linkin Park', 'Meteora is the second studio album by American rock band Linkin Park. It was released on March 25, 2003, through Warner Bros. Records, following Reanimation, a collaboration album which featured remixes of songs included on their 2000 debut studio album Hybrid Theory.', 'Music', 1, '100', '2023-10-30 10:15:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pldiscs`
--
ALTER TABLE `pldiscs`
  ADD PRIMARY KEY (`d_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pldiscs`
--
ALTER TABLE `pldiscs`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

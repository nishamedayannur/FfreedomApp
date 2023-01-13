-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2023 at 09:59 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `role` enum('Relationship Manager','Team Leader','Assistant Manager','Manager','AVP','VP','CEO') NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `role`, `parent_id`, `date`, `status`) VALUES
(1, 'Mohit', 'VP', 0, '2023-01-13 11:15:20', 1),
(2, 'Ram', 'VP', 0, '2023-01-13 11:15:20', 1),
(3, 'Senthil', 'AVP', 1, '2023-01-13 11:15:20', 1),
(4, 'Kumar', 'AVP', 1, '2023-01-13 11:15:20', 1),
(5, 'Raj', 'AVP', 1, '2023-01-13 11:15:20', 1),
(6, 'Raja', 'AVP', 2, '2023-01-13 11:15:20', 1),
(7, 'Karan', 'AVP', 2, '2023-01-13 11:15:20', 1),
(8, 'Raja', 'Manager', 3, '2023-01-13 11:15:20', 1),
(9, 'Ramu', 'Manager', 4, '2023-01-13 11:15:20', 1),
(10, 'Rajesh', 'Manager', 5, '2023-01-13 11:15:20', 1),
(11, 'Vijay', 'Manager', 6, '2023-01-13 11:15:20', 1),
(12, 'Vijayan', 'Manager', 7, '2023-01-13 11:15:20', 1),
(13, 'Kavya', 'Manager', 7, '2023-01-13 11:15:20', 1),
(14, 'Vivek', 'Team Leader', 8, '2023-01-13 11:15:20', 1),
(15, 'Arun', 'Team Leader', 9, '2023-01-13 11:15:20', 1),
(16, 'Siva', 'Team Leader', 10, '2023-01-13 11:15:20', 1),
(17, 'Kanana', 'Team Leader', 11, '2023-01-13 11:15:20', 1),
(18, 'Sathish', 'Team Leader', 12, '2023-01-13 11:15:20', 1),
(19, 'Santhosh', 'Team Leader', 12, '2023-01-13 11:15:20', 1),
(20, 'Arun', 'Team Leader', 12, '2023-01-13 11:15:20', 1),
(21, 'Tharun', 'Team Leader', 13, '2023-01-13 11:15:20', 1),
(22, 'Varun', 'Team Leader', 13, '2023-01-13 11:15:20', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2017 at 10:46 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hijab`
--

-- --------------------------------------------------------

--
-- Table structure for table `px_useraccess`
--

CREATE TABLE `px_useraccess` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_usergroup` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `act_create` int(11) NOT NULL,
  `act_read` int(11) NOT NULL,
  `act_update` int(11) NOT NULL,
  `act_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `px_useraccess`
--

INSERT INTO `px_useraccess` (`id`, `id_usergroup`, `id_menu`, `act_create`, `act_read`, `act_update`, `act_delete`) VALUES
(1, 1, 1, 1, 1, 1, 1),
(2, 1, 2, 1, 1, 1, 1),
(3, 1, 3, 1, 1, 1, 1),
(4, 1, 4, 1, 1, 1, 1),
(5, 1, 5, 1, 1, 1, 1),
(6, 1, 6, 1, 1, 1, 1),
(7, 1, 7, 1, 1, 1, 1),
(8, 1, 8, 1, 1, 1, 1),
(9, 1, 9, 1, 1, 1, 1),
(19, 1, 10, 1, 1, 1, 1),
(80, 1, 11, 1, 1, 1, 1),
(81, 1, 12, 1, 1, 1, 1),
(82, 1, 13, 1, 1, 1, 1),
(86, 1, 21, 1, 1, 1, 1),
(87, 1, 17, 1, 1, 1, 1),
(92, 1, 23, 1, 1, 1, 1),
(126, 1, 35, 1, 1, 1, 1),
(132, 1, 41, 1, 1, 1, 1),
(134, 1, 43, 1, 1, 1, 1),
(136, 1, 45, 1, 1, 1, 1),
(144, 1, 53, 1, 1, 1, 1),
(145, 1, 56, 1, 1, 1, 1),
(146, 1, 55, 1, 1, 1, 1),
(147, 1, 54, 1, 1, 1, 1),
(148, 1, 59, 1, 1, 1, 1),
(151, 1, 60, 1, 1, 1, 1),
(152, 1, 61, 1, 1, 1, 1),
(153, 1, 62, 1, 1, 1, 1),
(154, 1, 63, 1, 1, 1, 1),
(156, 1, 64, 1, 1, 1, 1),
(158, 1, 67, 1, 1, 1, 1),
(159, 1, 68, 1, 1, 1, 1),
(160, 1, 69, 1, 1, 1, 1),
(161, 1, 70, 1, 1, 1, 1),
(162, 1, 71, 1, 1, 1, 1),
(163, 1, 72, 1, 1, 1, 1),
(164, 1, 73, 1, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `px_useraccess`
--
ALTER TABLE `px_useraccess`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `px_useraccess`
--
ALTER TABLE `px_useraccess`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

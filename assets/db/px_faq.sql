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
-- Table structure for table `px_faq`
--

CREATE TABLE `px_faq` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `px_faq`
--

INSERT INTO `px_faq` (`id`, `title`, `content`, `date_modified`) VALUES
(1, 'DO YOU SHIP INTERNATIONALLY?', '<p><span style="color: rgb(85, 85, 85); font-family: Lato, sans-serif; font-size: 13px;">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Foosd truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim ke ffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farmto-tab le, raw denim aesthetic synth nesciunt you probably haven''t heard of them accusamus labore sustainable VHS. Nihil anim keffiyeh helvetica, craft beer labore wes ande rso cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farmto-tab le,</span><br></p>', '2017-01-10 14:07:23'),
(2, 'WHO SHOULD I TO CONTACT IF I HAVE ANY QUESTION?', '<p><span style="color: rgb(85, 85, 85); font-family: Lato, sans-serif; font-size: 13px;">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Foosd truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim ke ffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farmto-tab le, raw denim aesthetic synth nesciunt you probably haven''t heard of them accusamus labore sustainable VHS. Nihil anim keffiyeh helvetica, craft beer labore wes ande rso cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farmto-tab le,</span><br></p>', '2017-01-10 14:11:35'),
(3, 'HOW CAN I CANCEL OR CHANGE MY ORDER?', '<p><span style="color: rgb(85, 85, 85); font-family: Lato, sans-serif; font-size: 13px;">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Foosd truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim ke ffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farmto-tab le, raw denim aesthetic synth nesciunt you probably haven''t heard of them accusamus labore sustainable VHS. Nihil anim keffiyeh helvetica, craft beer labore wes ande rso cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farmto-tab le,</span><br></p>', '2017-01-10 14:13:38'),
(4, 'HOW CAN I RETURN A PRODUCT?', '<p><span style="color: rgb(85, 85, 85); font-family: Lato, sans-serif; font-size: 13px;">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Foosd truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim ke ffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farmto-tab le, raw denim aesthetic synth nesciunt you probably haven''t heard of them accusamus labore sustainable VHS. Nihil anim keffiyeh helvetica, craft beer labore wes ande rso cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farmto-tab le,</span><br></p>', '2017-01-10 14:14:12'),
(5, 'HOW LONG WILLIT TAKE TO GET MY PACKAGE?', '<p><span style="color: rgb(85, 85, 85); font-family: Lato, sans-serif; font-size: 13px;">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Foosd truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim ke ffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farmto-tab le, raw denim aesthetic synth nesciunt you probably haven''t heard of them accusamus labore sustainable VHS. Nihil anim keffiyeh helvetica, craft beer labore wes ande rso cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farmto-tab le,</span><br></p>', '2017-01-10 14:14:46'),
(6, 'WHAT SHIPPING METHODS ARE AVAILABLE?', '<p><span style="color: rgb(85, 85, 85); font-family: Lato, sans-serif; font-size: 13px;">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Foosd truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim ke ffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farmto-tab le, raw denim aesthetic synth nesciunt you probably haven''t heard of them accusamus labore sustainable VHS. Nihil anim keffiyeh helvetica, craft beer labore wes ande rso cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farmto-tab le,</span><br></p>', '2017-01-10 14:15:12'),
(7, 'DO YOU PROVIDE ANY WARRANTY', '<p><span style="color: rgb(85, 85, 85); font-family: Lato, sans-serif; font-size: 13px;">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Foosd truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim ke ffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farmto-tab le, raw denim aesthetic synth nesciunt you probably haven''t heard of them accusamus labore sustainable VHS. Nihil anim keffiyeh helvetica, craft beer labore wes ande rso cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farmto-tab le,</span><br></p>', '2017-01-10 14:15:40'),
(8, 'DO YOU HAVE REPLACEMENT GUARANTEE?', '<p><span style="color: rgb(85, 85, 85); font-family: Lato, sans-serif; font-size: 13px;">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Foosd truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim ke ffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farmto-tab le, raw denim aesthetic synth nesciunt you probably haven''t heard of them accusamus labore sustainable VHS. Nihil anim keffiyeh helvetica, craft beer labore wes ande rso cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farmto-tab le,</span><br></p>', '2017-01-10 14:16:08'),
(9, 'HOW CAN I CANCEL OR CHANGE MY ORDER?', '<p><span style="color: rgb(85, 85, 85); font-family: Lato, sans-serif; font-size: 13px;">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Foosd truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim ke ffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farmto-tab le, raw denim aesthetic synth nesciunt you probably haven''t heard of them accusamus labore sustainable VHS. Nihil anim keffiyeh helvetica, craft beer labore wes ande rso cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farmto-tab le,</span><br></p>', '2017-01-10 14:16:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `px_faq`
--
ALTER TABLE `px_faq`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `px_faq`
--
ALTER TABLE `px_faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
-- Table structure for table `px_menu`
--

CREATE TABLE `px_menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(225) NOT NULL,
  `target` varchar(225) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `icon` varchar(225) NOT NULL,
  `orders` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `px_menu`
--

INSERT INTO `px_menu` (`id`, `name`, `target`, `id_parent`, `icon`, `orders`) VALUES
(1, 'Dashboard', 'admin', 0, 'fa-dashboard', 1),
(2, 'System', 'admin_system', 0, 'fa-cog', 8),
(3, 'User', 'user', 2, 'fa-user', 3),
(4, 'User Group', 'usergroup', 2, 'fa-users', 5),
(5, 'Master Data', 'master_data', 2, 'fa-database', 8),
(6, 'Menu', 'menu', 2, 'fa-link', 6),
(7, 'Pengaturan', 'settings', 2, 'fa-cogs', 9),
(8, 'Urutan Menu', 'menu_orders', 2, 'fa-list', 7),
(9, 'User Akses', 'useraccess', 2, 'fa-check-circle', 4),
(11, 'Site Content', 'admin_site_content', 0, 'fa-globe', 7),
(12, 'Static Content', 'static_content', 11, 'fa-book', 13),
(13, 'Banner', 'banner', 11, 'fa-image', 1),
(17, 'News', 'news', 11, 'fa-globe', 11),
(21, 'My Profile', 'my_profile', 2, 'fa-user', 2),
(35, 'Albums', 'album', 11, 'fa-image', 3),
(53, 'Product', 'admin_product', 0, 'fa-shopping-cart', 2),
(54, 'Category List', 'category', 53, 'fa-adjust', 1),
(55, 'Color List', 'color', 53, 'fa-adjust', 2),
(56, 'Size List', 'size', 53, 'fa-adjust', 3),
(59, 'Product List', 'product_list', 53, 'fa-shopping-cart', 7),
(60, 'Brand List', 'brand', 53, 'fa-adjust', 4),
(61, 'Customer', 'admin_customer', 0, 'fa-users', 3),
(62, 'Customer List', 'customer_list', 61, 'fa-user', 0),
(63, 'Order', 'admin_order', 0, 'fa-shopping-cart', 4),
(64, 'Order List', 'order_list', 63, 'fa-shopping-cart', 2),
(67, 'Editor Pick', 'editor_picks', 53, 'fa-calendar', 5),
(68, 'Product Grup', 'product_group_list', 53, 'fa-list', 6),
(69, 'Shipping Cost', 'admin_shipping_cost', 0, 'fa-cube', 6),
(70, 'Shipping Cost List', 'shipping_cost_list', 69, 'fa-adjust', 0),
(71, 'faq', 'faq', 11, 'fa-question', 0),
(72, 'Voucher', 'admin_voucher', 0, 'fa-tag', 5),
(73, 'Global Voucher', 'global_voucher', 72, 'fa-adjust', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `px_menu`
--
ALTER TABLE `px_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `px_menu`
--
ALTER TABLE `px_menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

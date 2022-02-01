-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2022 at 06:43 AM
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
-- Database: `admin_panel_cake`
--

-- --------------------------------------------------------

--
-- Table structure for table `cake_flavor_info`
--

CREATE TABLE `cake_flavor_info` (
  `cake_id` int(6) NOT NULL,
  `cake_flavor_types` varchar(50) NOT NULL,
  `total_price` int(11) NOT NULL,
  `discount` varchar(3) NOT NULL,
  `sold_out` int(11) NOT NULL,
  `sell_without_dis` int(11) NOT NULL,
  `sold_out_dis` int(11) NOT NULL,
  `sell_with_dis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cake_flavor_info`
--

INSERT INTO `cake_flavor_info` (`cake_id`, `cake_flavor_types`, `total_price`, `discount`, `sold_out`, `sell_without_dis`, `sold_out_dis`, `sell_with_dis`) VALUES
(1, 'Black Forest', 780, '5%', 0, 0, 5, 3705),
(2, 'Vanilla Cake', 600, '5%', 0, 0, 7, 3990),
(3, 'Red Velvet Cakes', 800, '5%', 0, 0, 10, 7600);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_cost`
--

CREATE TABLE `inventory_cost` (
  `cost_id` int(11) NOT NULL,
  `cake_id` int(11) NOT NULL,
  `material_cost` int(11) NOT NULL,
  `transportation_cost` int(11) NOT NULL,
  `utility_cost` varchar(8) NOT NULL,
  `space_cost` int(11) NOT NULL,
  `staff_cost` int(11) NOT NULL,
  `total_cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory_cost`
--

INSERT INTO `inventory_cost` (`cost_id`, `cake_id`, `material_cost`, `transportation_cost`, `utility_cost`, `space_cost`, `staff_cost`, `total_cost`) VALUES
(1, 1, 180, 150, '3%=9.9', 50, 60, 449),
(2, 2, 150, 150, '3%=9', 50, 60, 419),
(3, 3, 220, 150, '3%=11.1', 50, 60, 491);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(2) NOT NULL,
  `username` varchar(6) NOT NULL,
  `passwords` varchar(10) NOT NULL,
  `helper_password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `passwords`, `helper_password`) VALUES
(1, 'Salman', 'Vai', 'Abdullah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cake_flavor_info`
--
ALTER TABLE `cake_flavor_info`
  ADD PRIMARY KEY (`cake_id`);

--
-- Indexes for table `inventory_cost`
--
ALTER TABLE `inventory_cost`
  ADD PRIMARY KEY (`cost_id`),
  ADD KEY `cake_id` (`cake_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cake_flavor_info`
--
ALTER TABLE `cake_flavor_info`
  MODIFY `cake_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inventory_cost`
--
ALTER TABLE `inventory_cost`
  MODIFY `cost_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory_cost`
--
ALTER TABLE `inventory_cost`
  ADD CONSTRAINT `inventory_cost_ibfk_1` FOREIGN KEY (`cake_id`) REFERENCES `cake_flavor_info` (`cake_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

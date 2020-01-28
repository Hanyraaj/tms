-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2020 at 05:29 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `frock`
--

CREATE TABLE `frock` (
  `id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `c_name` varchar(1000) NOT NULL,
  `c_email` varchar(1000) NOT NULL,
  `c_contact` varchar(1000) NOT NULL,
  `c_address` varchar(1000) NOT NULL,
  `c_height` float NOT NULL,
  `c_chest` float NOT NULL,
  `c_weight` float NOT NULL,
  `c_hip` float NOT NULL,
  `c_inseam` float NOT NULL,
  `a10` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `frock`
--

INSERT INTO `frock` (`id`, `order_date`, `c_name`, `c_email`, `c_contact`, `c_address`, `c_height`, `c_chest`, `c_weight`, `c_hip`, `c_inseam`, `a10`) VALUES
(1, '2018-05-01 22:57:47', 'Sadia Islam', 'sadia620@gmail.com', '01734433661', 'dhanmondi - Dhaka', 5.5, 4.5, 4.8, 8.8, 3.5, ''),
(2, '2018-08-11 02:12:33', 'Sadia Islam', 'sadia@gmail.com', '01734433661', 'Star coder bd', 5, 55.77, 55, 4.36, 555.88, ''),
(3, '2018-08-13 00:20:33', 'Sarmin Antora', 'antora@gmail.com', '01734433661', 'Who are the Rohingya?', 5, 55.77, 55, 4.36, 555.88, ''),
(4, '2018-08-15 05:07:18', 'Kuddos', 'kuddos@gmail.com', '01734433661', 'boyrat', 4, 233, 4.4, 343, 24, '');

-- --------------------------------------------------------

--
-- Table structure for table `kameez`
--

CREATE TABLE `kameez` (
  `c_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `c_name` varchar(1000) NOT NULL,
  `c_email` varchar(1000) NOT NULL,
  `c_contact` varchar(1000) NOT NULL,
  `c_address` varchar(1000) NOT NULL,
  `c_body_length` varchar(1000) NOT NULL,
  `c_shoulder` varchar(1000) NOT NULL,
  `c_chest` varchar(1000) NOT NULL,
  `c_waist` varchar(1000) NOT NULL,
  `a9` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kameez`
--

INSERT INTO `kameez` (`c_id`, `order_date`, `c_name`, `c_email`, `c_contact`, `c_address`, `c_body_length`, `c_shoulder`, `c_chest`, `c_waist`, `a9`) VALUES
(1, '2018-05-02 04:57:47', 'Ataur Rshman', 'ataur2620@gmail.com', '01734433661', 'dhanmondi - Dhaka', '5', '4', '1', '1', ''),
(2, '2018-08-11 01:45:55', 'Sadia Islam', 'sadia@gmail.com', '01734433661', 'Rohingya Crisis.', '5.0', '55.77', '55.0', '4.36', ''),
(3, '2018-08-11 01:47:29', 'Rany Raz', 'ataur2620@gmail.com', '01734433661', 'Who are the Rohingya?', '5.0', '55.77', '55.0', '4.36', ''),
(4, '2018-08-13 00:04:29', 'NUSRAT FARIA', 'nusrat@gmai.com', '209238', 'hanir basha ', '5.0', '53.0', '5', '4800', ''),
(5, '2018-08-15 04:44:50', 'Kuddos ', 'kuddos@gmail.com', '01734433661', 'boyrat', '312', '24', '233', '3.7', '');

-- --------------------------------------------------------

--
-- Table structure for table `logintb`
--

CREATE TABLE `logintb` (
  `username` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logintb`
--

INSERT INTO `logintb` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `c_name` varchar(256) NOT NULL,
  `c_contact` varchar(256) NOT NULL,
  `s_name` varchar(256) NOT NULL,
  `d_date` varchar(256) NOT NULL,
  `amount_of_order` varchar(256) NOT NULL,
  `amount` varchar(256) NOT NULL,
  `paid` varchar(256) NOT NULL,
  `due` varchar(256) NOT NULL,
  `order_details` varchar(256) NOT NULL,
  `a10` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `date`, `c_name`, `c_contact`, `s_name`, `d_date`, `amount_of_order`, `amount`, `paid`, `due`, `order_details`, `a10`) VALUES
(1, '2018-05-02 10:57:47', 'Rafi Kafi', '01734433661', 'Hany Raaj', '08/15/2018', '5', '400', '200', '200', 'askhfdsdkfhsdghf', 1),
(2, '2018-05-02 10:57:47', 'who', '01734433661', 'Hany Raaj', '08/15/2018', '5', '400', '200', '200', 'askhfdsdkfhsdghf', 1),
(3, '2018-05-02 10:57:47', 'Rafi Kafi', '01734433661', 'Hany Raaj', '08/15/2018', '5', '400', '200', '200', 'askhfdsdkfhsdghf', 2),
(4, '2018-08-12 18:15:51', 'Ataur Rahman', '123456', 'whatever', '08/13/2018', '6', '5000', '200', '4800', 'whatever', 3),
(5, '2018-08-12 18:19:53', 'Sadia Islam', '123456', 'dwefef', '08/24/2018', '6', '5000', '200', '4800', 'whatever', 4),
(6, '2018-08-13 13:57:20', 'Ataur Rahman', 'ataur2620@gmail.com', '01734433661', '08/16/2018', '6', '', '200', '4800', 'whatever', 3),
(7, '2018-08-13 14:04:12', 'Suki Rahman', 'suki@gmail.com', 'Rajon Ali', '08/31/2018', '3', '1500', '500', '1000', 'Spacial', 2),
(8, '2018-08-15 23:24:28', 'efaefg', '1545225', 'dgdsfg', '08/15/2018', 'gdfg', '2585', '25', '25', '2', 0),
(9, '2018-08-15 23:30:24', 'dsfasdf', '5461651321`', 'asdifsiupn', '08/09/2018', '52', '50662', '6452', '6632', '4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pant`
--

CREATE TABLE `pant` (
  `c_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `c_name` varchar(1000) NOT NULL,
  `c_email` varchar(1000) NOT NULL,
  `c_contact` varchar(1000) NOT NULL,
  `c_address` varchar(1000) NOT NULL,
  `c_waist` float NOT NULL,
  `c_length` float NOT NULL,
  `c_hight` float NOT NULL,
  `c_open` float NOT NULL,
  `c_under` float NOT NULL,
  `c_back_pocket` float NOT NULL,
  `a11` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pant`
--

INSERT INTO `pant` (`c_id`, `order_date`, `c_name`, `c_email`, `c_contact`, `c_address`, `c_waist`, `c_length`, `c_hight`, `c_open`, `c_under`, `c_back_pocket`, `a11`) VALUES
(1, '2018-05-01 22:57:47', 'Sadia Islam', 'sadia620@gmail.com', '01734433661', 'dhanmondi - Dhaka', 0.99, 0.99, 0.99, 0.99, 0.99, 0.99, ''),
(2, '2018-05-01 22:57:47', 'Sadia Islam', 'sadia620@gmail.com', '01734433661', 'dhanmondi - Dhaka', 0.99, 0.99, 0.99, 0.99, 0.99, 0.99, ''),
(3, '2018-05-01 22:57:47', 'Sadia Islam', 'sadia620@gmail.com', '01734433661', 'dhanmondi - Dhaka', 5.5, 0.99, 0.99, 0.99, 0.99, 0.99, ''),
(4, '2018-05-01 22:57:47', 'Sadia Islam', 'sadia620@gmail.com', '01734433661', 'dhanmondi - Dhaka', 5.5, 4.5, 4.8, 8.8, 9.9, 5.5, ''),
(5, '2018-08-11 01:06:35', '', '', '', '', 5, 55.77, 55, 0, 0, 0, ''),
(6, '2018-08-11 01:10:28', 'Rany Raz', 'hani@gmail.xom', '01734433661', 'kalabagan', 5300, 53, 5.55, 4.36, 555.88, 0, ''),
(7, '2018-08-11 01:33:45', 'Ataur Rahman', 'ataur2620@gmail.com', '01734433661', 'Star coder bd', 5, 55.77, 55, 4.36, 555.88, 2, ''),
(8, '2018-08-11 06:06:09', 'Ataur Rahman', 'ataur2620@gmail.com', '01734433661', 'Star coder bd', 5, 55.77, 55, 4.36, 555.88, 1, ''),
(9, '2018-08-11 06:07:08', 'Ataur Rahman', 'ataur2620@gmail.com', '01734433661', 'Star coder bd', 5, 55.77, 55, 4.36, 555.88, 1, ''),
(10, '2018-08-11 06:10:14', 'Ataur Rahman', 'ataur2620@gmail.com', '01734433661', 'Star coder bd', 5, 55.77, 55, 4.36, 555.88, 1, ''),
(11, '2018-08-11 11:14:47', 'Ataur Rahman', 'ataur2620@gmail.com', '01734433661', 'rajbari', 5, 55.77, 55, 4.36, 555.88, 1, ''),
(12, '2018-08-12 04:51:17', 'Ataur Rahman', 'ataur2620@gmail.com', '01734433661', 'Rohingya Crisis.', 5, 55.77, 55, 4.36, 555.88, 1, ''),
(13, '2018-08-12 23:52:01', 'Ratul raihan', 'sadia@gmail.com', '01734433661', 'Star coder bd', 5, 55.77, 55, 4.36, 555.88, 2, ''),
(14, '2018-08-15 02:59:19', '', '', '', '', 0, 0, 0, 0, 0, 0, ''),
(15, '2018-08-15 03:08:34', '', '', '', '', 0, 0, 0, 0, 0, 0, ''),
(16, '2018-08-15 03:13:38', 'Kuddos', 'kuddos@gmail.com', '01734433661', 'boyrat', 56, 6.9, 6.9, 87, 6.9, 1, ''),
(17, '2018-08-15 10:57:58', 'wdwd', 'asfasf@asf.vom', 'safas', 'safas', 0, 0, 0, 0, 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `shirt`
--

CREATE TABLE `shirt` (
  `c_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `c_name` varchar(1000) NOT NULL,
  `c_email` varchar(1000) NOT NULL,
  `c_contact` varchar(1000) NOT NULL,
  `c_address` varchar(1000) NOT NULL,
  `c_higth` varchar(1000) NOT NULL,
  `c_weigth` varchar(1000) NOT NULL,
  `c_shoulder` varchar(1000) NOT NULL,
  `c_half_chest` varchar(1000) NOT NULL,
  `c_halp_weight` varchar(1000) NOT NULL,
  `c_sleeve` varchar(1000) NOT NULL,
  `c_chest_pocket` varchar(1000) NOT NULL,
  `a12` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shirt`
--

INSERT INTO `shirt` (`c_id`, `order_date`, `c_name`, `c_email`, `c_contact`, `c_address`, `c_higth`, `c_weigth`, `c_shoulder`, `c_half_chest`, `c_halp_weight`, `c_sleeve`, `c_chest_pocket`, `a12`) VALUES
(3, '2018-08-11 01:31:06', 'Ataur Rahman', 'ataur2620@gmail.com', '01734433661', 'Star coder bd', '5.0', '53.0', '55.0', '4.36', '555.88', '5.00', 'No', ''),
(4, '2018-08-12 13:19:27', 'Masudur Rahman', 'ataur2620@gmail.com', '01734433661', 'Star coder bd', '5.0', '55.77', '55.0', '4.36', '555.88', '5.00', '2', ''),
(7, '2018-08-12 13:33:33', 'Sadia Islam', 'ataur2620@gmail.com', '01734433661', 'Star coder bd', '5.0', '55.77', '55.0', '4.36', '555.88', '5.00', '1', ''),
(8, '2018-08-15 04:18:42', 'Kuddos', 'kuddos@gmail.com', '01734433661', 'boyrat', '342', '343', '3423', '343', '34', '3.9', 'No', '');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `c_name` varchar(1000) NOT NULL,
  `c_email` varchar(1000) NOT NULL,
  `c_contact` varchar(1000) NOT NULL,
  `c_address` varchar(1000) NOT NULL,
  `c_salary` varchar(1000) NOT NULL,
  `c_position` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `date`, `c_name`, `c_email`, `c_contact`, `c_address`, `c_salary`, `c_position`) VALUES
(1, '2018-05-01 22:57:47', 'Ataur Rshman', 'ataur2620@gmail.com', '01734433661', 'dhanmondi - Dhaka', '1000', 'staff'),
(2, '2018-08-11 00:18:07', 'Ataur Rahman', 'ataur2620@gmail.com', '01734433661', 'Star coder bd', '10000', 'asistant'),
(3, '2018-08-13 01:02:07', 'Rafat Maraz', 'rafat@gmail.com', '01735566994', 'kalabagan', '10000000000', 'developer'),
(4, '2018-08-13 01:04:09', 'Rafat Maraz', 'sadia@gmail.com', '01734433661', 'kalabagan', '5300', 'developer'),
(5, '2018-08-15 11:08:58', '', '', '', '', '', ''),
(6, '2018-08-15 11:11:50', '', '', '', '', '', ''),
(7, '2018-08-15 11:12:17', 'DSfs', 'dzgdz@fd.ovm', '6562325', 'sdfasfaszd', '500', 'sdfsd'),
(8, '2020-01-20 16:18:35', 'Ataur Rahman', 'ataur2620@gmail.com', '01734433661', '153/A, Dhanmondi 19., Dhaka 1209,', '1000', 'Manager');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `frock`
--
ALTER TABLE `frock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kameez`
--
ALTER TABLE `kameez`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pant`
--
ALTER TABLE `pant`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `shirt`
--
ALTER TABLE `shirt`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `frock`
--
ALTER TABLE `frock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kameez`
--
ALTER TABLE `kameez`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pant`
--
ALTER TABLE `pant`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `shirt`
--
ALTER TABLE `shirt`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2021 at 07:59 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ddp`
--

-- --------------------------------------------------------

--
-- Table structure for table `alert_tab`
--

CREATE TABLE `alert_tab` (
  `sn` int(11) NOT NULL,
  `alert_id` varchar(255) NOT NULL,
  `alert_detail` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ipaddress` varchar(255) NOT NULL,
  `computer` varchar(255) NOT NULL,
  `seen_status` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alert_tab`
--

INSERT INTO `alert_tab` (`sn`, `alert_id`, `alert_detail`, `user_id`, `name`, `ipaddress`, `computer`, `seen_status`, `date`) VALUES
(1, 'ALT1', 'Success Alert: A new merchant have just sighn-up. Details  : MIKE AFOLABI | sunaf4rea@gmail.com | 08131252996', 'DDP002', 'MIKE AFOLABI', '127.0.0.1', 'AfooTECH-Global', 0, '2021-09-18 13:49:44'),
(2, 'ALT2', 'Success Alert: Project Created successfully by MIKE AFOLABI. ID: DDP_P001 ', 'DDP002', 'MIKE AFOLABI', '127.0.0.1', 'AfooTECH-Global', 0, '2021-09-18 14:15:53'),
(3, 'ALT3', 'Success Alert: Payout Setup Saved successfully by MIKE AFOLABI. Details---- ID: DDP_P001 | Name: AFOOTECH GLOBAL I. T. SOLUTION | Bank: Access Bank (Diamond) | Accoun Number: 0096540100', 'DDP002', 'MIKE AFOLABI', '127.0.0.1', 'AfooTECH-Global', 0, '2021-09-18 14:18:23'),
(4, 'ALT4', 'Success Alert: Project Activation Requested successfully by MIKE AFOLABI. Details---- ID: DDP_P001, Name: AFOOTECH GLOBAL I. T. SOLUTION ', 'DDP002', 'MIKE AFOLABI', '127.0.0.1', 'AfooTECH-Global', 0, '2021-09-18 14:19:06'),
(5, 'ALT5', 'Success Alert: Project Created successfully by MIKE AFOLABI. ID: DDP_P002 ', 'DDP002', 'MIKE AFOLABI', '127.0.0.1', 'AfooTECH-Global', 0, '2021-09-18 14:26:31'),
(6, 'ALT6', 'Success Alert: A project named: AFOOTECH GLOBAL I. T. SOLUTION was activated successfully.  Action By: MIKE AFOLABI', 'DDP000', 'MIKE AFOLABI', '::1', 'AfooTECH-Global', 0, '2021-09-18 14:30:41'),
(7, 'ALT7', 'Success Alert: Project Switched to AFOOTECH GLOBAL I. T. SOLUTION successfully by MIKE AFOLABI. ID: DDP_P001 ', 'DDP002', 'MIKE AFOLABI', '127.0.0.1', 'AfooTECH-Global', 0, '2021-09-18 14:30:57'),
(8, 'ALT8', 'Success Alert: Payout Setup Saved successfully by MIKE AFOLABI. Details---- ID: DDP_P001 | Name: AFOOTECH GLOBAL I. T. SOLUTION | MoMo Name: MTN Momo | MoMo Number: 0544000602', 'DDP002', 'MIKE AFOLABI', '127.0.0.1', 'AfooTECH-Global', 0, '2021-09-18 14:33:23'),
(9, 'ALT9', 'Success Alert: Project Switched to BOVIC ART AND PRINT successfully by MIKE AFOLABI. ID: DDP_P002 ', 'DDP002', 'MIKE AFOLABI', '127.0.0.1', 'AfooTECH-Global', 0, '2021-09-18 19:06:10'),
(10, 'ALT10', 'Success Alert: Project Switched to AFOOTECH GLOBAL I. T. SOLUTION successfully by MIKE AFOLABI. ID: DDP_P001 ', 'DDP002', 'MIKE AFOLABI', '127.0.0.1', 'AfooTECH-Global', 0, '2021-09-18 19:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `country_tab`
--

CREATE TABLE `country_tab` (
  `sn` int(11) NOT NULL,
  `country_code` varchar(50) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `country_alias` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country_tab`
--

INSERT INTO `country_tab` (`sn`, `country_code`, `country_name`, `country_alias`) VALUES
(1, '234', 'nigeria', 'ng'),
(2, '44', 'united kingdom', 'eu');

-- --------------------------------------------------------

--
-- Table structure for table `masters_tab`
--

CREATE TABLE `masters_tab` (
  `sn` int(10) NOT NULL,
  `mast_id` varchar(100) NOT NULL,
  `mast_name` varchar(100) NOT NULL,
  `mast_val` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masters_tab`
--

INSERT INTO `masters_tab` (`sn`, `mast_id`, `mast_name`, `mast_val`) VALUES
(1, 'DDP', 'STAFF ID COUNT', '2'),
(2, 'ALT', 'OPERATION ALERT', '10'),
(3, 'DDP_P', 'PROJECT CREATION ID COUNT', '2');

-- --------------------------------------------------------

--
-- Table structure for table `payout_type_tab`
--

CREATE TABLE `payout_type_tab` (
  `sn` int(11) NOT NULL,
  `payout_type_id` varchar(50) NOT NULL,
  `payout_type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payout_type_tab`
--

INSERT INTO `payout_type_tab` (`sn`, `payout_type_id`, `payout_type_name`) VALUES
(1, 'momo', 'MoMo'),
(2, 'bank', 'BANK');

-- --------------------------------------------------------

--
-- Table structure for table `projects_bank_detail_tab`
--

CREATE TABLE `projects_bank_detail_tab` (
  `sn` int(11) NOT NULL,
  `project_id` varchar(50) NOT NULL,
  `payout_type_id` varchar(50) NOT NULL,
  `bank_id` varchar(50) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `business_certificate` varchar(255) NOT NULL,
  `business_reg_number` varchar(100) NOT NULL,
  `activation_status_id` varchar(5) NOT NULL,
  `collection_service_charge` decimal(10,2) NOT NULL,
  `collection_charge_type` varchar(50) NOT NULL,
  `payout_service_charge` decimal(10,2) NOT NULL,
  `payout_charge_type` varchar(50) NOT NULL,
  `staff_id` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects_bank_detail_tab`
--

INSERT INTO `projects_bank_detail_tab` (`sn`, `project_id`, `payout_type_id`, `bank_id`, `bank_name`, `account_number`, `account_name`, `business_certificate`, `business_reg_number`, `activation_status_id`, `collection_service_charge`, `collection_charge_type`, `payout_service_charge`, `payout_charge_type`, `staff_id`, `date`) VALUES
(1, 'DDP_P001', 'momo', 'mtn', 'MTN Momo', '0544000602', 'SUNDAY OLUWAGBENGA AFOLABI', '20210918031906_Afootech Certificate.pdf', '12345678', 'A', '5.00', 'percentage', '3.50', 'wholenumber', 'DDP000', '2021-09-18 14:33:23');

-- --------------------------------------------------------

--
-- Table structure for table `projects_tab`
--

CREATE TABLE `projects_tab` (
  `sn` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `project_id` varchar(50) NOT NULL,
  `project_client_id` varchar(50) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_email` varchar(255) NOT NULL,
  `project_phone` varchar(50) NOT NULL,
  `project_password` varchar(255) NOT NULL,
  `status_id` varchar(50) NOT NULL,
  `country_code` varchar(50) NOT NULL,
  `current_project` varchar(5) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects_tab`
--

INSERT INTO `projects_tab` (`sn`, `user_id`, `project_id`, `project_client_id`, `project_name`, `project_email`, `project_phone`, `project_password`, `status_id`, `country_code`, `current_project`, `date`) VALUES
(1, 'DDP002', 'DDP_P001', '4YODx', 'AFOOTECH GLOBAL I. T. SOLUTION', 'afootechglobal@gmail.com', '08131252996', 'ddp_pass', 'A', '44', 'Y', '2021-09-18 19:13:42'),
(2, 'DDP002', 'DDP_P002', 'paJI6', 'BOVIC ART AND PRINT', 'sunaf4real@gmail.com', '08149626461', 'ddp_pass', 'P', '44', 'N', '2021-09-18 19:06:10');

-- --------------------------------------------------------

--
-- Table structure for table `role_tab`
--

CREATE TABLE `role_tab` (
  `sn` int(10) UNSIGNED NOT NULL,
  `role_id` int(100) NOT NULL,
  `role_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_tab`
--

INSERT INTO `role_tab` (`sn`, `role_id`, `role_name`) VALUES
(1, 1, 'STAFF'),
(2, 2, 'ADMIN'),
(3, 3, 'SUPER ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `service_charge_type_tab`
--

CREATE TABLE `service_charge_type_tab` (
  `sn` int(11) NOT NULL,
  `service_charge_type_id` varchar(50) NOT NULL,
  `service_charge_type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_charge_type_tab`
--

INSERT INTO `service_charge_type_tab` (`sn`, `service_charge_type_id`, `service_charge_type_name`) VALUES
(1, 'percentage', '%'),
(2, 'wholenumber', 'W');

-- --------------------------------------------------------

--
-- Table structure for table `status_tab`
--

CREATE TABLE `status_tab` (
  `sn` int(10) UNSIGNED NOT NULL,
  `status_id` varchar(100) NOT NULL,
  `status_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_tab`
--

INSERT INTO `status_tab` (`sn`, `status_id`, `status_name`) VALUES
(1, 'A', 'ACTIVE'),
(2, 'I', 'INACTIVE'),
(3, 'S', 'SUSPEND'),
(4, 'P', 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `url_tab`
--

CREATE TABLE `url_tab` (
  `sn` int(11) NOT NULL,
  `url_id` varchar(50) NOT NULL,
  `url_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `url_tab`
--

INSERT INTO `url_tab` (`sn`, `url_id`, `url_desc`) VALUES
(1, 'UAT', 'http://18.216.34.0:5349'),
(2, 'PROD', 'http://104.248.131.51:3000');

-- --------------------------------------------------------

--
-- Table structure for table `users_tab`
--

CREATE TABLE `users_tab` (
  `sn` int(11) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passport` varchar(255) NOT NULL,
  `role_id` varchar(100) NOT NULL,
  `status_id` varchar(100) NOT NULL,
  `otp` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` datetime NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_tab`
--

INSERT INTO `users_tab` (`sn`, `user_type`, `user_id`, `fullname`, `mobile`, `email`, `passport`, `role_id`, `status_id`, `otp`, `password`, `reg_date`, `last_login`) VALUES
(1, 'ST', 'DDP000', 'MIKE AFOLABI', '08131252996', 'sunaf4real@gmail.com', '202108280413_IMG_20151121_130628 copyjpg20180201010648pm.jpg', '3', 'A', '839455', '1ffc510109576e14b257a2ebdcbab01c', '2021-08-17 17:48:40', '2021-09-18 14:21:19'),
(2, 'CUS', 'DDP001', 'MIKE AFOLABI', '08131252996', 'afootech2016@gmail.com', '202109040125_afoo.jpg', '', 'A', '', '1ffc510109576e14b257a2ebdcbab01c', '2021-09-04 00:03:49', '2021-09-11 10:36:47'),
(3, 'CUS', 'DDP002', 'MIKE AFOLABI', '08131252996', 'sunaf4real@gmail.com', '', '', 'A', '', '1ffc510109576e14b257a2ebdcbab01c', '2021-09-18 13:49:44', '2021-09-18 19:35:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alert_tab`
--
ALTER TABLE `alert_tab`
  ADD PRIMARY KEY (`sn`),
  ADD KEY `seen_status` (`seen_status`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `country_tab`
--
ALTER TABLE `country_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `masters_tab`
--
ALTER TABLE `masters_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `payout_type_tab`
--
ALTER TABLE `payout_type_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `projects_bank_detail_tab`
--
ALTER TABLE `projects_bank_detail_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `projects_tab`
--
ALTER TABLE `projects_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `role_tab`
--
ALTER TABLE `role_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `service_charge_type_tab`
--
ALTER TABLE `service_charge_type_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `status_tab`
--
ALTER TABLE `status_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `url_tab`
--
ALTER TABLE `url_tab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `users_tab`
--
ALTER TABLE `users_tab`
  ADD PRIMARY KEY (`sn`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `email` (`email`),
  ADD KEY `password` (`password`),
  ADD KEY `status_id` (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alert_tab`
--
ALTER TABLE `alert_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `country_tab`
--
ALTER TABLE `country_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `masters_tab`
--
ALTER TABLE `masters_tab`
  MODIFY `sn` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payout_type_tab`
--
ALTER TABLE `payout_type_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `projects_bank_detail_tab`
--
ALTER TABLE `projects_bank_detail_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `projects_tab`
--
ALTER TABLE `projects_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_tab`
--
ALTER TABLE `role_tab`
  MODIFY `sn` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service_charge_type_tab`
--
ALTER TABLE `service_charge_type_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status_tab`
--
ALTER TABLE `status_tab`
  MODIFY `sn` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `url_tab`
--
ALTER TABLE `url_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_tab`
--
ALTER TABLE `users_tab`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

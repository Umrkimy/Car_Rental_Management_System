-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2024 at 06:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `admin_name`) VALUES
(1, '1', '$2y$10$ZHtz9NQ0BhNNFfUjDsgdguTvfbEWwXMAaHNBx1cOdafLPOA7UcX.C', 'umar');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_num` varchar(255) NOT NULL,
  `cars_name` varchar(255) NOT NULL,
  `ic_no` varchar(255) NOT NULL,
  `driver_no` varchar(255) NOT NULL,
  `days_rented` int(255) NOT NULL,
  `deposit` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `pickup_location` varchar(255) DEFAULT NULL,
  `dropoff_location` varchar(255) DEFAULT NULL,
  `pickup_date` datetime DEFAULT NULL,
  `dropoff_date` datetime DEFAULT NULL,
  `invoice_no` varchar(255) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `full_name`, `user_name`, `client_name`, `email`, `phone_num`, `cars_name`, `ic_no`, `driver_no`, `days_rented`, `deposit`, `total`, `status`, `pickup_location`, `dropoff_location`, `pickup_date`, `dropoff_date`, `invoice_no`, `invoice_date`, `state`, `city`, `payment_method`) VALUES
(3, '12312312312', '12312', 'Haiqal', 'mgeek573@gmail.com', '123123123', 'Myvi', '123123', '12312312', 4, 'RM 160.00', 'RM 1,760.00', 'Paid', 'Pekan', 'Pekan', '2024-12-08 02:12:00', '2024-12-12 02:12:00', 'INV6758bb30c18ef', '2024-12-08', 'Pahang', 'Pekan', 'Pending'),
(4, '123123', '12312', 'Umar', 'mgeek573@gmail.com', '123123123', 'Proton Saga', '123123', '12312321', 3, 'RM 120.00', 'RM 1,320.00', 'Cancelled', 'Pekan', 'Pekan', '2024-12-08 03:17:00', '2024-12-11 03:17:00', 'INV6758bc2cd2f8f', '2024-12-08', 'Setapak', 'Kuala Lumpur', 'Online Transaction'),
(11, '123123', '12312', 'Haiqal', '123@gmail.com', '123123123', 'Myvi', '123123123', '312312321', 1, 'RM 40.00', 'RM 440.00', 'Pending', 'Pekan', 'Pekan', '2024-12-09 03:58:00', '2024-12-10 03:58:00', 'INV6755fa7729547', '2024-12-09', 'Kuala Lumpur', 'Setapak', 'Online Transaction'),
(13, '12312312312', '12312', 'Haiqal', '123@gmail.com', '123123123', 'Myvi', '123123', '123123', 19, 'RM 760.00', 'RM 8,360.00', 'Paid', 'Pekan', 'Pekan', '2024-12-01 01:19:00', '2024-12-20 01:19:00', 'INV675f0fdb68f4a', '2024-12-16', 'Kuala Lumpur', 'Setapak', 'Online Transaction');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `seats` int(200) NOT NULL,
  `trans` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `price`, `seats`, `trans`, `image`, `client_name`, `state`, `city`) VALUES
(1, 'Myvi', 'RM 400.00', 4, 'Automatic', '../imgs/car_67485eb1f40489.87576547.png', 'Haiqal', 'Kuala Lumpur', 'Setapak'),
(2, 'Proton Saga', 'RM 400.00', 5, 'Automatic', '../imgs/car_675331471da1b0.53457592.png', 'Umar', 'Pahang', 'Kuantan'),
(3, 'Civic', 'RM 650.00', 4, 'Automatic', '../imgs/car_6755ad56dfe5c5.20662518.png', 'Darwish123', NULL, NULL),
(5, 'GTR', 'RM 1,200.00', 5, 'Manual', '../imgs/car_6755ae6dc1d8f1.37873451.jpg', 'Umar', NULL, NULL),
(6, 'Alza', 'RM 600.00', 5, 'Automatic', '../imgs/car_6755ae8a427d45.82187631.jpg', 'Haiqal', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `phone_num` varchar(64) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `ic_no` varchar(255) DEFAULT NULL,
  `driver_no` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `email`, `password`, `client_name`, `phone_num`, `full_name`, `address`, `status`, `ic_no`, `driver_no`, `date`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(1, 'muhammadhaiqalh96@gmail.com', '$2y$10$RpIkriSijsyqvvga3VAvleUWa9Q7EWvOzWi2QuPvj4oODTmdFH1l.', 'Haiqal', '01123912039', 'Muhammad Haiqal', '123123123', '', NULL, NULL, NULL, 'a4bf7f33bd016de805be51ef53d6f5c794e3a3c89b994f48752dd6ff113dea3b', '2024-11-20'),
(2, 'shauqi@gmail.com', '$2y$10$jUfGXIrS1/IhSvE114sxkuOFbsNGr6qrQMAGzm9P.zo7lMja5n5F6', 'shauqi', '123123123123', 'shauqi123', '123123123', 'Approved', '', '', NULL, NULL, NULL),
(3, 'darwish@gmail.com', '$2y$10$rm5CTKNs6TbB8WGEA5cTYeO0//h0WX/GJd/z7HSBFc75RbEHBQU16', 'Darwish', '123123', 'Darwish', '', 'Rejected', '01231231', '51123123', '2024-11-23 04:11:27', NULL, NULL),
(4, 'UMARHAKIMI987@GMAIL.COM', '$2y$10$5FiA78arm5FOIr2XWXghKeY.x9w3rZAqspdFrz2bWJo/5BZjhVC5S', 'umar123', '123123', 'Umar', 'sdasda', 'Approved', NULL, NULL, '2024-11-23 06:02:40', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `phone_num` varchar(64) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `ic_no` varchar(255) NOT NULL,
  `driver_no` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` datetime DEFAULT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `user_name`, `phone_num`, `full_name`, `address`, `ic_no`, `driver_no`, `status`, `date`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(2, 'shauqi@gmail.com', '$2y$10$zQi1Rea9ursdUlLOn83v0uBoZEGXHbPukaZp2ZBaNUdEkKhpZNMkC', '123', '123213123', '21313', '', '0293085123', '1023910549', 'Pending', '2024-11-23 04:03:52', NULL, NULL),
(3, '123@gmail.com', '$2y$10$s5ZdJWO9bKKReIPgcZ6PrO8/0MV4cnXquHtBgARvTw7PqVB55dYta', '12312', '123123123', '12312312312', '123213123', '1023905180131', '1231231231251', 'Rejected', '2024-11-23 05:49:37', NULL, NULL),
(4, '1234@gmail.com', '$2y$10$1/pucoBB2qMhY2dElrvkFe/S3C2va/qXizxsrmwBsqfK44NqabpUe', '1234', '1234124', '', '123213123', '', '', 'Disapproved', '2024-11-23 06:04:30', NULL, NULL),
(6, 'UMARHAKIMI987@GMAIL.COM', '$2y$10$1TxOLNaduGC.Xs3A1J8kEeqXqwb7Q3jGLHcLWmSMWNmP4UeN/mtlm', 'umar', '123123', '', '', '', '', 'Pending', '2024-12-11 07:34:56', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

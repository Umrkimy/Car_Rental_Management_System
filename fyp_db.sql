-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2025 at 02:51 PM
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
  `id` int(11) NOT NULL,
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
  `user_name` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `cars_name` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_num` varchar(255) NOT NULL,
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
  `payment_method` varchar(255) NOT NULL,
  `stripe_id` varchar(255) NOT NULL,
  `refund_id` varchar(255) NOT NULL,
  `refund_date` datetime DEFAULT NULL,
  `refund_total` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_name`, `client_name`, `cars_name`, `full_name`, `email`, `phone_num`, `ic_no`, `driver_no`, `days_rented`, `deposit`, `total`, `status`, `pickup_location`, `dropoff_location`, `pickup_date`, `dropoff_date`, `invoice_no`, `invoice_date`, `state`, `city`, `payment_method`, `stripe_id`, `refund_id`, `refund_date`, `refund_total`) VALUES
(1, 'Umar', 'Umar', 'Myvi', 'Muhammad Umar Hakimi bin abdul aziz', 'UMARHAKIMI987@GMAIL.COM', '01161310512', '040815060327', '2132132131231', 2, 'RM 60.00', 'RM 660.00', 'Refunded', 'Setapak Mall', 'Setapak Mall', '2024-12-22 04:23:00', '2024-12-24 04:23:00', 'INV676bef208208d', '2024-12-22', 'Setapak', 'Kuala Lumpur', 'Online Transaction', 'cs_test_a1S8cUoEkFLGmMUd8wpfeLANiqjx84lumY7TeswXKsCbGHxqaDRtgbhIVH', 're_3QYZD9GVwmcrp8zo3Ghl1Rts', '2025-01-01 00:01:32', 'RM 60.00'),
(3, 'Umar', 'Umar', 'Proton Saga', 'Muhammad Umar Hakimi bin abdul aziz', 'UMARHAKIMI987@GMAIL.COM', '01161310512', '040815060327', '2132132131231', 2, 'RM 80.00', 'RM 880.00', 'Cancelled', 'Mall', 'Mall', '2024-12-26 19:17:00', '2024-12-28 19:17:00', 'INV676be9f97d376', '2024-12-25', 'Kuala Lumpur', 'Setapak', 'Online Transaction', 'cs_test_a1qoXq9CteaV9lpSmp7wo0HRRGqPv3yUPTiFC6fzt3EoP689d3IinyhX3U', 're_3QZsbTGVwmcrp8zo2Df7qWTZ', '2024-12-25 19:27:30', 'RM 880.00'),
(4, 'Umar', 'Umar', 'GTR', 'Muhammad Umar Hakimi bin abdul aziz', 'UMARHAKIMI987@GMAIL.COM', '01161310512', '040815060327', '2132132131231', 1, 'RM 120.00', 'RM 1,320.00', 'Cancelled', 'Mall', 'Setapak Mall', '2024-12-29 19:33:00', '2024-12-30 19:33:00', 'INV676beda2436bd', '2024-12-25', 'Kuala Lumpur', 'Setapak', 'Online Transaction', 'cs_test_a1ZPDhreFbbhl2w4iUVkiJnOFqIBEFZwXOue18gIUvogcL3WUuWTg67brz', 're_3QZsqZGVwmcrp8zo2IAAOdsc', '2024-12-25 19:34:38', 'RM 1,320.00'),
(6, 'Umar', 'Umar', 'Proton Saga', 'Muhammad Umar Hakimi bin abdul aziz', 'UMARHAKIMI987@GMAIL.COM', '01161310512', '040815060327', '013135131', 1, 'RM 40.00', 'RM 440.00', 'Refunded', 'Pekan', 'Pekan', '2024-12-31 23:46:00', '2025-01-01 23:47:00', 'INV677414aeb3f2d', '2024-12-31', 'Setapak', 'Kuala Lumpur', 'Online Transaction', 'cs_test_a1ZDjbYvRZn8fQ6lWsWhAClWiZ19ggd8BQemeqtEuKnYUHtOuLNTZZituG', 're_3Qc7fbGVwmcrp8zo16xGu5hl', '2025-01-01 00:05:12', 'RM 40.00'),
(10, 'Umar', 'Umar', 'Myvi', 'Muhammad Umar Hakimi bin abdul aziz', 'UMARHAKIMI987@GMAIL.COM', '01161310512', '040815060327', '013135131', 1, 'RM 30.00', 'RM 330.00', 'Refunded', 'Pekan', 'Pekan', '2025-01-01 00:08:00', '2025-01-02 00:08:00', 'INV6774174545c36', '2025-01-01', 'Setapak', 'Kuala Lumpur', 'Online Transaction', 'cs_test_a1MJLSVp7gv9rvLn5QEfbIEhE1NIV60mzCue4eAp3FgFV52cWEWFZFLz9e', 're_3Qc805GVwmcrp8zo1g7CHLWL', '2025-01-01 00:10:03', 'RM 30.00'),
(11, 'Umar', 'Umar', 'GTR', 'Muhammad Umar Hakimi bin abdul aziz', 'UMARHAKIMI987@GMAIL.COM', '01161310512', '040815060327', '013135131', 1, 'RM 120.00', 'RM 1,320.00', 'Confirmed', 'Pekan', 'Pekan', '2025-01-01 00:09:00', '2025-01-02 00:09:00', 'INV677418d5355d6', '2025-01-01', 'Kuala Lumpur', 'Setapak', 'Online Transaction', 'cs_test_a1p2zym4o2DBqSK3Ktik5K6bbj4IIetEXxVG8tLOt36JMOFlbo7XLckRNG', 're_3Qc80ZGVwmcrp8zo3YJvMVQ1', '2025-01-01 00:10:04', 'RM 120.00');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `seats` int(200) NOT NULL,
  `trans` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `client_name`, `price`, `seats`, `trans`, `image`, `state`, `city`) VALUES
(1, 'Myvi', 'Umar', 'RM 300.00', 5, 'Automatic', '../imgs/cars/car_676722484a9ed0.73974623.jpg', 'Kuala Lumpur', 'Setapak'),
(2, 'GTR', 'Umar', 'RM 1,200.00', 4, 'Manual', '../imgs/cars/car_676897a44e1201.77482175.jpg', 'Kuala Lumpur', 'Setapak'),
(3, 'Proton Saga', 'Umar', 'RM 400.00', 5, 'Automatic', '../imgs/cars/car_67689932e08039.44300471.jpg', 'Kuala Lumpur', 'Setapak');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `phone_num` varchar(64) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `ic_no` varchar(255) DEFAULT NULL,
  `driver_no` varchar(255) DEFAULT NULL,
  `bank_no` varchar(30) NOT NULL,
  `driver_img` varchar(255) NOT NULL,
  `bank_type` varchar(100) NOT NULL,
  `date` datetime DEFAULT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `email`, `password`, `client_name`, `phone_num`, `full_name`, `address`, `status`, `ic_no`, `driver_no`, `bank_no`, `driver_img`, `bank_type`, `date`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(1, 'UMARHAKIMI987@GMAIL.COM', '$2y$10$qQ.r6Aij9VwtB0bVOZU07OqC2bO5.8RlDynGn77RgFnpCqSjqPrgC', 'Umar', '01161310512', 'Muhammad Umar Hakimi bin abdul aziz', 'PV 20', 'Verified', '040815060327', '12313515123', '06189681033123', '../imgs/driver/driver676721ff894469.77715198.jpg', 'Maybank', '2024-12-22 04:06:30', NULL, NULL),
(3, 'darwish@gmail.com', '$2y$10$zj6dwi2Jkz.asmPD7d33Wu9FZ4QUgLhCbKPxw5GFuaE6n2n8yk3ni', 'darwish', '0131313515131', 'Darwish', 'Setapak', 'Rejected', '0413060312115', '15151312151412', '1232131', '../imgs/driver/driver676be27ea04890.46790505.png', 'Maybank', '2024-12-25 18:44:33', NULL, NULL),
(4, 'Haiqal@gmail.com', '$2y$10$df32uiCnw4ONJ27rtWvKkOYW4Ga/5T9zg5GVrCCExixKbYByvcst.', 'Haiqal', '123123', 'Haiqal', '123123', 'Verified', '12312312', '312312313', '123123123', '../imgs/driver/driver67740adff0f367.53683890.png', 'Maybank', '2024-12-31 23:15:31', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
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

INSERT INTO `users` (`id`, `user_name`, `email`, `password`, `phone_num`, `full_name`, `address`, `ic_no`, `driver_no`, `status`, `date`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(1, 'Umar', 'UMARHAKIMI987@GMAIL.COM', '$2y$10$npX3WIdB4skyuJUM1ql3TOnEUurlnEojgmqRxcD1SPtLxW63R/H0K', '01161310512', 'Muhammad Umar Hakimi bin abdul aziz', '', '040815060327', '013135131', 'Unverified', '2024-12-22 04:05:06', NULL, NULL);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `name_fk` (`user_name`,`client_name`),
  ADD KEY `cars_name_fk` (`cars_name`),
  ADD KEY `fk_client_name` (`client_name`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_name_fk` (`client_name`),
  ADD KEY `cars_name_fk` (`name`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`),
  ADD KEY `client_name_fk` (`client_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`),
  ADD KEY `user_name_fk` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `cars_name` FOREIGN KEY (`cars_name`) REFERENCES `cars` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_client_name` FOREIGN KEY (`client_name`) REFERENCES `clients` (`client_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_name` FOREIGN KEY (`user_name`) REFERENCES `users` (`user_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `client_name` FOREIGN KEY (`client_name`) REFERENCES `clients` (`client_name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

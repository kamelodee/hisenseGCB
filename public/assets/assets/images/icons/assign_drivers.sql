-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2022 at 07:36 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hisms`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_drivers`
--

CREATE TABLE `assign_drivers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `truct_order_id` bigint(20) UNSIGNED NOT NULL,
  `truck_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assign_drivers`
--

INSERT INTO `assign_drivers` (`id`, `truct_order_id`, `truck_id`, `name`, `number`, `driver_id`, `status`, `created_at`, `updated_at`) VALUES
(35, 7, 2, 'Owia', 'gr12344', NULL, NULL, '2022-08-22 16:34:37', '2022-08-22 16:34:37'),
(36, 7, 5, 'Owia', 'gr12344', NULL, NULL, '2022-08-22 16:34:46', '2022-08-22 16:34:46'),
(37, 7, 1, 'big truck', 'gr12344', NULL, 'ASSIGN', '2022-08-22 16:48:42', '2022-08-22 16:48:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_drivers`
--
ALTER TABLE `assign_drivers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assign_drivers_truct_order_id_foreign` (`truct_order_id`),
  ADD KEY `assign_drivers_truck_id_foreign` (`truck_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_drivers`
--
ALTER TABLE `assign_drivers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assign_drivers`
--
ALTER TABLE `assign_drivers`
  ADD CONSTRAINT `assign_drivers_truck_id_foreign` FOREIGN KEY (`truck_id`) REFERENCES `trucks` (`id`),
  ADD CONSTRAINT `assign_drivers_truct_order_id_foreign` FOREIGN KEY (`truct_order_id`) REFERENCES `truct_orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

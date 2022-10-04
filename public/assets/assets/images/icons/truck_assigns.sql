-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2022 at 02:15 AM
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
-- Table structure for table `truck_assigns`
--

CREATE TABLE `truck_assigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `truct_order_id` bigint(20) UNSIGNED NOT NULL,
  `truck_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `truck_assigns`
--

INSERT INTO `truck_assigns` (`id`, `truct_order_id`, `truck_id`, `status`, `added_by`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'ASSIGN', NULL, '2022-08-23 16:56:45', '2022-08-23 16:56:45'),
(2, 2, 2, 'ASSIGN', NULL, '2022-08-23 16:56:45', '2022-08-23 16:56:45'),
(3, 2, 3, 'ASSIGN', NULL, '2022-08-23 16:56:45', '2022-08-23 16:56:45'),
(4, 2, 4, 'ASSIGN', NULL, '2022-08-23 16:56:45', '2022-08-23 16:56:45'),
(5, 2, 5, 'ASSIGN', NULL, '2022-08-23 16:56:45', '2022-08-23 16:56:45'),
(6, 2, 6, 'ASSIGN', NULL, '2022-08-23 16:56:45', '2022-08-23 16:56:45'),
(7, 2, 7, 'ASSIGN', NULL, '2022-08-23 16:56:45', '2022-08-23 16:56:45'),
(8, 2, 8, 'ASSIGN', NULL, '2022-08-23 16:56:45', '2022-08-23 16:56:45'),
(9, 3, 1, 'ASSIGN', NULL, '2022-08-23 17:03:09', '2022-08-23 17:03:09'),
(10, 3, 2, 'ASSIGN', NULL, '2022-08-23 17:03:09', '2022-08-23 17:03:09'),
(11, 3, 3, 'ASSIGN', NULL, '2022-08-23 17:06:40', '2022-08-23 17:06:40'),
(12, 3, 4, 'ASSIGN', NULL, '2022-08-23 17:06:40', '2022-08-23 17:06:40'),
(13, 3, 5, 'ASSIGN', NULL, '2022-08-23 17:06:40', '2022-08-23 17:06:40'),
(14, 3, 6, 'ASSIGN', NULL, '2022-08-23 17:06:40', '2022-08-23 17:06:40'),
(15, 3, 7, 'ASSIGN', NULL, '2022-08-23 17:06:40', '2022-08-23 17:06:40'),
(16, 3, 8, 'ASSIGN', NULL, '2022-08-23 17:06:40', '2022-08-23 17:06:40'),
(17, 9, 9, 'ASSIGN', NULL, '2022-08-23 23:53:31', '2022-08-23 23:53:31'),
(18, 9, 8, 'ASSIGN', '5', '2022-08-23 23:55:59', '2022-08-23 23:55:59'),
(19, 9, 7, 'ASSIGN', '5', '2022-08-23 23:55:59', '2022-08-23 23:55:59'),
(20, 9, 6, 'ASSIGN', '5', '2022-08-23 23:55:59', '2022-08-23 23:55:59'),
(21, 9, 5, 'ASSIGN', '5', '2022-08-23 23:55:59', '2022-08-23 23:55:59'),
(22, 9, 4, 'ASSIGN', '5', '2022-08-23 23:55:59', '2022-08-23 23:55:59'),
(23, 9, 3, 'ASSIGN', '5', '2022-08-23 23:55:59', '2022-08-23 23:55:59'),
(24, 9, 2, 'ASSIGN', '5', '2022-08-23 23:55:59', '2022-08-23 23:55:59'),
(25, 9, 1, 'ASSIGN', '5', '2022-08-23 23:55:59', '2022-08-23 23:55:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `truck_assigns`
--
ALTER TABLE `truck_assigns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `truck_assigns_truct_order_id_foreign` (`truct_order_id`),
  ADD KEY `truck_assigns_truck_id_foreign` (`truck_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `truck_assigns`
--
ALTER TABLE `truck_assigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `truck_assigns`
--
ALTER TABLE `truck_assigns`
  ADD CONSTRAINT `truck_assigns_truck_id_foreign` FOREIGN KEY (`truck_id`) REFERENCES `trucks` (`id`),
  ADD CONSTRAINT `truck_assigns_truct_order_id_foreign` FOREIGN KEY (`truct_order_id`) REFERENCES `truct_orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2022 at 02:17 AM
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
-- Table structure for table `truck_users`
--

CREATE TABLE `truck_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_by` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `truck_users`
--

INSERT INTO `truck_users` (`id`, `name`, `email`, `added_by`, `phone`, `position`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, '', 'admin@gmail.com', NULL, NULL, NULL, '$2y$10$z2WRZHDAvYhP3L5Al89sceYs/zLehiUv8XMLY3wCjmfsqd.LQA1aK', NULL, '2022-06-28 01:50:30', '2022-06-28 01:50:30'),
(5, 'Kamilo mamudu', 'kamelodee@gmail.com', '4', NULL, NULL, '$2y$10$hf.D7tPXonemFeX6oi27y.1GlRJ9e75Xb54H39WQQ9MPr7BgPehG6', NULL, '2022-08-23 22:01:52', '2022-08-23 22:01:52'),
(9, 'Kamilo mamudu', 'kamilomamudu3@gmail.com', '4', '+233248907443', NULL, '$2y$10$70ChbKypgJxDYGMquILdI.bpvMNkgsO5lnJbJKyXVrlWhhmDWnX0.', NULL, '2022-08-23 22:07:07', '2022-08-23 22:07:07'),
(10, 'Kamilo mamudu', 'kamelodee@gmai3l.com', '4', '+233248907433', NULL, '$2y$10$2IX96PEvlCCv/VAZusCQW.G3rS2LQ.c7xCU374GBTs9xL.pomV/D.', NULL, '2022-08-23 22:09:12', '2022-08-23 22:09:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `truck_users`
--
ALTER TABLE `truck_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `truck_users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `truck_users`
--
ALTER TABLE `truck_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

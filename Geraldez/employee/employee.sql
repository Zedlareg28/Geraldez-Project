-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2025 at 08:34 AM
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
-- Database: `employee`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `position` varchar(100) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT 0.00,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `status` enum('active','inactive','resigned') NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `fullname`, `position`, `salary`, `phone`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 'Fernando Gerladez', 'IT Staff', 20000.00, '09635321628', 'fernandoogeraldez@asscat.edu.ph', 'active', '2025-10-25 15:13:15', '2025-10-25 15:22:37'),
(2, '2', 'Mark Gementiza', 'IT', 25000.00, '0987654321', 'marktahimik@gmail.com', 'active', '2025-11-09 07:32:04', '2025-11-09 07:46:32'),
(3, 'm-192', 'aevan ', 'studyante', 312.00, '099243377978', 'kimmy@gmail.com', 'active', '2025-11-09 11:14:32', '2025-11-28 15:14:01'),
(4, 'm-123', 'Joel Rey', 'Student', 99999999.99, '1342342', 'kaizenjoel101@gmail.com', 'active', '2025-11-09 11:15:37', '2025-11-09 11:15:52');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-10-25-150307', 'App\\Database\\Migrations\\CreateEmployeesTable', 'default', 'App', 1761405062, 1),
(2, '2025-10-25-151543', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1761405379, 2);

-- --------------------------------------------------------

--
-- Table structure for table `system_status`
--

CREATE TABLE `system_status` (
  `id` int(11) NOT NULL,
  `status` enum('online','maintenance') DEFAULT 'online'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_status`
--

INSERT INTO `system_status` (`id`, `status`) VALUES
(1, 'online');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff') NOT NULL DEFAULT 'staff',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Fernando Gerladez', 'Admin', '$2y$10$kXyLrd2Vyr/dOqdRxf44ZeOLJ64JccX7k4sjYiwy.N/G4iNRoOF8i', 'admin', '2025-10-25 15:21:11', '2025-10-25 15:21:11'),
(2, 'Fernando Gerladez', 'Fernando', '$2y$10$ULLARB75Of3fmMazMdKfTOrkY0gF75mJXMB/ctKjatQ5s8Ht24SO2', 'staff', '2025-10-25 15:21:50', '2025-10-25 15:21:50'),
(4, 'Fernando Gerladez', 'Geraldez', '$2y$10$TVGtSDXLActwapGX6pq7XO1jFVQ3Y8p0M1ZnUxNIQTb15ZMz2/cwe', 'staff', '2025-10-25 15:22:04', '2025-10-25 15:22:04'),
(5, 'aevan krizl', 'vanvan', '$2y$10$XM2.KlfoPBflSK1csC3a9eYQ5z9019aTyxDNZPzeA.Bc0AqecXfLa', 'staff', '2025-11-09 11:13:10', '2025-11-09 11:13:10'),
(6, 'Joel Rey ', 'Joel Rey', '$2y$10$tIHIqvZGlHq3hCyZtbV0Y.p4LWPOX4RRRbTjFnj0k17qEL2y8Knhy', 'staff', '2025-11-09 11:13:26', '2025-11-09 11:13:26'),
(7, 'jelyn Rodrigo', 'jelyn', '$2y$10$bNrLALHkV0gWi2caG3Fi9udhRRs8i.CLj1CfJ4iBQiTH/oyfrH7sK', 'staff', '2025-11-09 11:15:44', '2025-11-09 11:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `user_activities`
--

CREATE TABLE `user_activities` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `activity` text NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `mac_address` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_activities`
--

INSERT INTO `user_activities` (`id`, `user_id`, `username`, `activity`, `ip_address`, `mac_address`, `created_at`) VALUES
(1, 1, 'Admin', 'User logged out', '::1', NULL, '2025-11-09 07:46:06'),
(2, 2, 'Fernando', 'User logged in', '::1', NULL, '2025-11-09 07:46:17'),
(3, 2, 'Fernando', 'Updated employee ID: 2', '::1', NULL, '2025-11-09 07:46:32'),
(4, 1, 'Admin', 'User logged in', '::1', NULL, '2025-11-09 07:46:51'),
(5, 1, 'Admin', 'User logged out', '::1', NULL, '2025-11-09 07:47:37'),
(6, 1, 'Admin', 'User logged in', '::1', NULL, '2025-11-09 08:32:23'),
(7, 1, 'Admin', 'System mode changed to maintenance', '::1', NULL, '2025-11-09 08:39:18'),
(8, 1, 'Admin', 'System mode changed to online', '::1', NULL, '2025-11-09 08:39:21'),
(9, 1, 'Admin', 'System mode changed to maintenance', '::1', NULL, '2025-11-09 08:39:23'),
(10, 1, 'Admin', 'System mode changed to online', '::1', NULL, '2025-11-09 08:39:25'),
(11, 1, 'Admin', 'User logged out', '::1', NULL, '2025-11-09 08:39:49'),
(12, 2, 'Fernando', 'User logged in', '::1', NULL, '2025-11-09 08:39:58'),
(13, 2, 'Fernando', 'User logged out', '::1', NULL, '2025-11-09 08:40:44'),
(14, 1, 'Admin', 'User logged in', '::1', NULL, '2025-11-09 08:40:56'),
(15, 1, 'Admin', 'System mode changed to maintenance', '::1', NULL, '2025-11-09 08:41:04'),
(16, 1, 'Admin', 'User logged out', '::1', NULL, '2025-11-09 08:41:07'),
(17, 1, 'Admin', 'User logged in', '::1', NULL, '2025-11-09 08:41:19'),
(18, 1, 'Admin', 'User logged out', '::1', NULL, '2025-11-09 08:41:23'),
(19, 2, 'Fernando', 'User logged in', '::1', NULL, '2025-11-09 08:41:33'),
(20, 2, 'Fernando', 'User logged out', '::1', NULL, '2025-11-09 08:41:39'),
(21, 1, 'Admin', 'User logged in', '::1', NULL, '2025-11-09 08:41:55'),
(22, 1, 'Admin', 'System mode changed to online', '::1', NULL, '2025-11-09 08:42:20'),
(23, 1, 'Admin', 'User logged out', '::1', NULL, '2025-11-09 08:42:22'),
(24, 1, 'Admin', 'User logged in', '192.168.20.24', NULL, '2025-11-09 10:11:07'),
(25, 1, 'Admin', 'User logged in', '192.168.20.25', NULL, '2025-11-09 10:11:35'),
(26, 2, 'Fernando', 'User logged in', '192.168.20.24', NULL, '2025-11-09 10:17:25'),
(27, 2, 'Fernando', 'User logged out', '192.168.20.24', NULL, '2025-11-09 10:17:30'),
(28, 2, 'Fernando', 'User logged in', '192.168.20.24', NULL, '2025-11-09 10:17:37'),
(29, 2, 'Fernando', 'User logged out', '192.168.20.24', NULL, '2025-11-09 10:17:43'),
(30, 1, 'Admin', 'User logged in', '192.168.20.24', NULL, '2025-11-09 10:17:49'),
(31, 1, 'Admin', 'User logged in', '192.168.15.12', NULL, '2025-11-09 11:13:02'),
(32, NULL, 'Guest', 'New user registered: vanvan', '192.168.15.11', NULL, '2025-11-09 11:13:10'),
(33, 5, 'vanvan', 'User logged in', '192.168.15.11', NULL, '2025-11-09 11:13:22'),
(34, NULL, 'Guest', 'New user registered: Joel Rey', '192.168.15.10', NULL, '2025-11-09 11:13:26'),
(35, 6, 'Joel Rey', 'User logged in', '192.168.15.10', NULL, '2025-11-09 11:13:35'),
(36, 5, 'vanvan', 'Added new employee: Kimberly Kim', '192.168.15.11', NULL, '2025-11-09 11:14:32'),
(37, 5, 'vanvan', 'Updated employee ID: 3', '192.168.15.11', NULL, '2025-11-09 11:14:51'),
(38, 6, 'Joel Rey', 'Added new employee: Joel Rey', '192.168.15.10', NULL, '2025-11-09 11:15:37'),
(39, NULL, 'Guest', 'New user registered: jelyn', '192.168.15.15', NULL, '2025-11-09 11:15:44'),
(40, 7, 'jelyn', 'User logged in', '192.168.15.15', NULL, '2025-11-09 11:15:51'),
(41, 6, 'Joel Rey', 'Updated employee ID: 4', '192.168.15.10', NULL, '2025-11-09 11:15:52'),
(42, 6, 'Joel Rey', 'Updated employee ID: 3', '192.168.15.10', NULL, '2025-11-09 11:16:02'),
(43, 1, 'Admin', 'System mode changed to maintenance', '192.168.15.12', NULL, '2025-11-09 11:16:09'),
(44, 1, 'Admin', 'System mode changed to online', '192.168.15.12', NULL, '2025-11-09 11:16:59'),
(45, 1, 'Admin', 'System mode changed to maintenance', '192.168.15.12', NULL, '2025-11-09 11:17:01'),
(46, 5, 'vanvan', 'User logged in', '192.168.15.11', NULL, '2025-11-09 11:17:24'),
(47, 1, 'Admin', 'User logged out', '192.168.15.12', NULL, '2025-11-09 11:21:18'),
(48, 1, 'Admin', 'User logged in', '192.168.15.12', NULL, '2025-11-09 13:26:09'),
(49, 1, 'Admin', 'System mode changed to online', '192.168.15.12', NULL, '2025-11-09 13:26:12'),
(50, 1, 'Admin', 'User logged out', '192.168.15.12', NULL, '2025-11-09 13:26:18'),
(51, 2, 'Fernando', 'User logged in', '192.168.15.12', NULL, '2025-11-09 13:26:24'),
(52, 2, 'Fernando', 'User logged out', '192.168.15.12', NULL, '2025-11-09 13:26:32'),
(53, 1, 'Admin', 'User logged in', '192.168.15.12', NULL, '2025-11-09 13:26:38'),
(54, 1, 'Admin', 'System mode changed to maintenance', '192.168.15.12', NULL, '2025-11-09 13:26:41'),
(55, 1, 'Admin', 'User logged out', '192.168.15.12', NULL, '2025-11-09 13:26:44'),
(56, 2, 'Fernando', 'User logged in', '192.168.15.12', NULL, '2025-11-09 13:26:53'),
(57, 2, 'Fernando', 'User logged out', '192.168.15.12', NULL, '2025-11-09 13:27:00'),
(58, 1, 'Admin', 'User logged in', '192.168.15.12', NULL, '2025-11-09 13:32:16'),
(59, 1, 'Admin', 'System mode changed to online', '192.168.15.12', NULL, '2025-11-09 13:32:48'),
(60, 1, 'Admin', 'System mode changed to maintenance', '192.168.15.12', NULL, '2025-11-09 13:32:52'),
(61, 1, 'Admin', 'System mode changed to online', '192.168.15.12', NULL, '2025-11-09 13:33:01'),
(62, 1, 'Admin', 'User logged in', '::1', NULL, '2025-11-28 05:51:47'),
(63, 1, 'Admin', 'System mode changed to maintenance', '::1', NULL, '2025-11-28 05:51:52'),
(64, 1, 'Admin', 'System mode changed to online', '::1', NULL, '2025-11-28 05:51:55'),
(65, 1, 'Admin', 'System mode changed to maintenance', '::1', NULL, '2025-11-28 05:53:17'),
(66, 1, 'Admin', 'User logged out', '::1', NULL, '2025-11-28 05:53:19'),
(67, 2, 'Fernando', 'User logged in', '::1', NULL, '2025-11-28 05:53:28'),
(68, 2, 'Fernando', 'User logged out', '::1', NULL, '2025-11-28 05:53:32'),
(69, 2, 'Fernando', 'User logged in', '::1', NULL, '2025-11-28 05:53:41'),
(70, 2, 'Fernando', 'User logged out', '::1', NULL, '2025-11-28 05:53:46'),
(71, 1, 'Admin', 'User logged in', '::1', NULL, '2025-11-28 14:00:22'),
(72, 1, 'Admin', 'User logged out', '::1', NULL, '2025-11-28 14:02:03'),
(73, 2, 'Fernando', 'User logged in', '::1', NULL, '2025-11-28 14:02:34'),
(74, 2, 'Fernando', 'User logged out', '::1', NULL, '2025-11-28 14:02:36'),
(75, 1, 'Admin', 'User logged in', '::1', NULL, '2025-11-28 14:02:47'),
(76, 1, 'Admin', 'System mode changed to online', '::1', NULL, '2025-11-28 14:02:49'),
(77, 1, 'Admin', 'User logged out', '::1', NULL, '2025-11-28 14:02:51'),
(78, 2, 'Fernando', 'User logged in', '::1', NULL, '2025-11-28 14:03:01'),
(79, 2, 'Fernando', 'User logged in', '::1', NULL, '2025-11-28 14:03:16'),
(80, NULL, 'Fernando', 'User logged out', '::1', NULL, '2025-11-28 14:10:45'),
(81, NULL, 'Admin', 'User logged in', '::1', NULL, '2025-11-28 14:10:53'),
(82, NULL, 'Admin', 'User logged out', '::1', NULL, '2025-11-28 14:14:24'),
(83, NULL, 'Fernando', 'User logged in: Fernando', '::1', NULL, '2025-11-28 14:14:31'),
(84, NULL, 'Admin', 'User logged in: Admin', '::1', NULL, '2025-11-28 14:14:44'),
(85, NULL, 'Admin', 'User logged out: Admin', '::1', NULL, '2025-11-28 14:21:17'),
(86, NULL, 'Fernando', 'Staff logged in: Fernando', '::1', NULL, '2025-11-28 14:21:25'),
(87, NULL, 'Fernando', 'User logged out: Fernando', '::1', NULL, '2025-11-28 14:21:28'),
(88, NULL, 'Admin', 'Admin logged in: Admin', '::1', NULL, '2025-11-28 15:05:53'),
(89, NULL, 'Admin', 'System mode changed to maintenance', '::1', NULL, '2025-11-28 15:09:47'),
(90, NULL, 'Admin', 'System mode changed to online', '::1', NULL, '2025-11-28 15:09:52'),
(91, NULL, 'Admin', 'User logged out: Admin', '::1', NULL, '2025-11-28 15:10:22'),
(92, NULL, 'Admin', 'Admin logged in: Admin', '::1', NULL, '2025-11-28 15:11:09'),
(93, NULL, 'Fernando', 'Staff logged in: Fernando', '::1', NULL, '2025-11-28 15:11:41'),
(94, NULL, 'Fernando', 'Updated employee ID: 3', '::1', NULL, '2025-11-28 15:14:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_status`
--
ALTER TABLE `system_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `system_status`
--
ALTER TABLE `system_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_activities`
--
ALTER TABLE `user_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

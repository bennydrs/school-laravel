-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2020 at 11:40 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `nip` char(6) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `tempat_lahir` varchar(120) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` char(10) NOT NULL,
  `agama` varchar(11) NOT NULL,
  `telp` char(15) NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `nip`, `user_id`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `telp`, `alamat`, `foto`, `created_at`, `updated_at`) VALUES
(1, '123456', 36, 'Zahir', 'Bogor', '2020-02-01', 'Laki-laki', 'Islam', '081-8181-8181', 'Bogor', NULL, '2020-02-18 20:10:26', '2020-02-18 21:20:02');

-- --------------------------------------------------------

--
-- Table structure for table `class_learns`
--

CREATE TABLE `class_learns` (
  `id` int(11) NOT NULL,
  `class_room_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_learns`
--

INSERT INTO `class_learns` (`id`, `class_room_id`, `semester_id`, `subject_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2020-02-16 02:30:11', '2020-02-17 02:17:58'),
(9, 3, 1, 1, '2020-02-15 21:53:27', '2020-02-16 04:53:27'),
(10, 1, 1, 2, '2020-02-16 19:43:25', '2020-02-17 02:43:25'),
(11, 1, 2, 1, '2020-02-19 21:18:33', '2020-02-20 04:18:33'),
(12, 2, 1, 1, '2020-02-19 22:47:15', '2020-02-20 05:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `class_rooms`
--

CREATE TABLE `class_rooms` (
  `id` int(11) NOT NULL,
  `kode_kelas` char(6) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_rooms`
--

INSERT INTO `class_rooms` (`id`, `kode_kelas`, `nama`, `teacher_id`, `created_at`, `updated_at`) VALUES
(1, 'K100', 'XI A', 1, '2020-02-11 20:25:15', '2020-02-12 18:49:00'),
(2, 'K101', 'XI C', 2, '2020-02-11 20:27:29', '2020-02-11 21:11:21'),
(3, 'K102', 'XI D', 3, '2020-02-12 20:33:50', '2020-02-12 20:33:50');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_learn_id` int(11) NOT NULL,
  `nilai_tugas_1` char(3) NOT NULL,
  `nilai_tugas_2` char(3) NOT NULL,
  `nilai_uts` char(3) NOT NULL,
  `nilai_uas` char(3) NOT NULL,
  `absen_hadir` char(3) NOT NULL,
  `absen_izin` char(3) NOT NULL,
  `absen_sakit` char(3) NOT NULL,
  `absen_alpha` char(3) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_02_07_092805_create_siswa_table', 1),
(4, '2020_02_07_092805_create_students_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `jam_mulai` char(6) NOT NULL,
  `jam_selesai` char(6) NOT NULL,
  `class_room_id` int(11) NOT NULL,
  `class_learn_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `hari`, `jam_mulai`, `jam_selesai`, `class_room_id`, `class_learn_id`, `semester_id`, `teacher_id`, `created_at`, `updated_at`) VALUES
(7, 'Senin', '07:00', '08:00', 1, 1, 1, 1, '2020-02-21 22:20:57', '2020-02-21 22:20:57'),
(9, 'Senin', '09:00', '10:00', 1, 11, 2, 1, '2020-02-22 22:06:28', '2020-02-22 22:06:28'),
(10, 'Senin', '12:30', '13:30', 2, 12, 1, 2, '2020-02-22 22:30:41', '2020-02-22 22:30:41'),
(11, 'Selasa', '09:00', '10:00', 1, 10, 1, 3, '2020-02-23 18:58:57', '2020-02-23 18:58:57'),
(12, 'Selasa', '09:30', '10:30', 1, 1, 1, 2, '2020-02-23 19:23:50', '2020-02-23 19:23:50'),
(13, 'Selasa', '10:30', '11:30', 2, 12, 1, 2, '2020-02-23 19:25:05', '2020-02-23 19:25:05'),
(14, 'Senin', '07:00', '08:00', 3, 9, 1, 2, '2020-02-23 19:30:55', '2020-02-23 19:30:55'),
(15, 'Kamis', '11:00', '12:00', 3, 9, 1, 1, '2020-02-23 21:12:00', '2020-02-23 21:12:00'),
(17, 'Sabtu', '09:30', '10:30', 1, 1, 1, 2, '2020-02-23 21:32:05', '2020-02-24 03:07:50');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(11) NOT NULL,
  `kode_semester` char(8) NOT NULL,
  `semester` varchar(120) NOT NULL,
  `tahun_ajaran` varchar(120) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `kode_semester`, `semester`, `tahun_ajaran`, `created_at`, `updated_at`) VALUES
(1, 'SM192001', 'Genap', '2019/2020', '2020-02-14 22:06:45', '2020-02-14 22:06:45'),
(2, 'SM192002', 'Ganjil', '2019/2020', '2020-02-14 22:12:43', '2020-02-14 22:12:43');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nis` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_room_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `nis`, `user_id`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `alamat`, `foto`, `class_room_id`, `created_at`, `updated_at`) VALUES
(6, '33333', 23, 'Apri', 'Bogor', '2003-04-01', 'Perempuan', 'Islam', 'Bogor', NULL, 1, '2020-02-09 19:25:27', '2020-02-09 19:25:27');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `kode_mapel` char(6) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `kode_mapel`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'MP101', 'Matematika', '2020-02-12 18:38:17', '2020-02-12 18:38:17'),
(2, 'MP102', 'Bahasa Indonesia', '2020-02-16 19:43:00', '2020-02-16 19:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `nrg` char(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `tempat_lahir` varchar(120) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(11) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `telp` char(16) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `nrg`, `user_id`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `telp`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'G1234', 24, 'Supardi', 'Arab', '1995-02-10', 'Laki-laki', 'Islam', '087-8555-4444', 'Arab', '2020-02-09 21:41:40', '2020-02-11 19:39:24'),
(2, 'G1235', 29, 'Samson', 'Jakarta', '1988-02-01', 'Laki-laki', 'Islam', '085-0005-5454', 'Jakarta Barat', '2020-02-11 19:13:33', '2020-02-11 19:13:33'),
(3, 'G1236', 30, 'Sayuti', 'Jakarta', '2020-02-02', 'Laki-laki', 'Islam', '090-9090-9090', 'jakarta', '2020-02-12 20:12:28', '2020-02-12 20:12:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `role`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(23, '33333', 'siswa', 'Apri', 'apri@mail.com', NULL, '$2y$10$6fKye28Kso52wkdrClJ4gOMzE7IDfCcDsSdn0WdY5y6JDgBc./T2m', 'CGpJDIY4zRADsK3LOI16WR2HcHM7k8Pezp1kiIjrbhP071uZYZDH2WRijwnE', '2020-02-09 19:25:27', '2020-02-09 19:25:27'),
(24, 'G1234', 'guru', 'Supardi', 'supardi@mail.com', NULL, '$2y$10$MpzZuI2LRl7qFTcr9/Sy9ezVbXqvLK4sG4W/SJeJHVi1bH8oWPho.', 'KQXlmGZTESfnrKON6yaQrKeNdhocSQLBUXBccukcCIhRrudY20pXGfXJtKwM', '2020-02-09 21:41:40', '2020-02-09 21:41:40'),
(29, 'G1235', 'guru', 'Samson', 'samson@mail.com', NULL, '$2y$10$pvs48mb4u/w6dXPy1MQ9xObNTl4VYRN7AiPITwazFLi4l2J4YNFna', 'ODWlAZYvgxLU9FUmkE1Lu2t4JVtaNHg4WTduNUfx5DRZyqh7gSy2VaV9ut6j', '2020-02-11 19:13:33', '2020-02-11 19:13:33'),
(30, 'G1236', 'guru', 'Sayuti', 'hgs@jdhd.com', NULL, '$2y$10$sXxNKPGogvwIefpVB20a.Oc/XjOdoCFfas.ZC9oUMNL/gRVDfrywe', '3M35PRNlm4PzBYEJE0PHIs5G7ESJmtuLLcVk89d5c6d6LXQrXuLpmMfPeU3y', '2020-02-12 20:12:28', '2020-02-12 20:12:28'),
(36, '123456', 'admin', 'Zahir', 'zahir@mail.com', NULL, '$2y$10$PwmTNJ10UDEdHjvb1LCm0uRLUQm45KGh9piBTnR.9mF1hVQmHwiRS', 'iScDh1ikN5KNwmOTCDW3fG2lg3Tn6uOmddzfCAXzuJvYQbjQLXPXESGutbPT', '2020-02-18 20:10:26', '2020-02-18 20:10:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_learns`
--
ALTER TABLE `class_learns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_rooms`
--
ALTER TABLE `class_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `class_learns`
--
ALTER TABLE `class_learns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `class_rooms`
--
ALTER TABLE `class_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

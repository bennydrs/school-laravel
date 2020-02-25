-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2020 at 05:57 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

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
  `nama` varchar(128) NOT NULL,
  `tempat_lahir` varchar(120) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` varchar(11) NOT NULL,
  `telp` char(15) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `class_learns`
--

CREATE TABLE `class_learns` (
  `id` int(11) NOT NULL,
  `class_room_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_learns`
--

INSERT INTO `class_learns` (`id`, `class_room_id`, `semester_id`, `subject_id`, `teacher_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 3, '2020-02-16 02:30:11', '2020-02-17 02:17:58'),
(9, 3, 1, 1, 1, '2020-02-15 21:53:27', '2020-02-16 04:53:27'),
(10, 1, 1, 2, 1, '2020-02-16 19:43:25', '2020-02-17 02:43:25');

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
(2, 'SM192002', 'Ganjil', '2019/2020', '2020-02-14 22:12:43', '2020-02-14 22:12:43'),
(3, 'SM202101', 'Genap', '2020/2021', '2020-02-14 22:21:29', '2020-02-14 22:21:29');

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
(2, '12345', 14, 'Afkar Zahir', 'Bogor', '2018-06-22', 'Laki-laki', 'Islam', 'bogor', '9f9045c2cb3be223e794c24184068da157fddbb2.jpg', 1, '2020-02-07 21:53:40', '2020-02-08 20:07:32'),
(4, '22222', 21, 'Izma', 'Bogor', '2020-02-01', 'Perempuan', 'Islam', 'Bogor', NULL, 1, '2020-02-09 18:49:14', '2020-02-09 18:49:14'),
(6, '33333', 23, 'Apri', 'Bogor', '2003-04-01', 'Perempuan', 'Islam', 'Bogor', NULL, 1, '2020-02-09 19:25:27', '2020-02-09 19:25:27'),
(9, '44444', 27, 'Samsul', 'Jakarta', '2020-02-01', 'Laki-laki', 'Islam', 'jakarta', NULL, 1, '2020-02-10 21:46:59', '2020-02-10 21:46:59'),
(10, '44445', 28, 'Udin', 'Arab', '2020-02-02', 'Laki-laki', 'Islam', 'Arab', '2aca8c8bf01d3085d2abda3bb64cc5ee9f72435a.jpg', 2, '2020-02-10 21:56:17', '2020-02-10 21:56:17');

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
(14, '12345', 'admin', 'Afkar Zahir', 'afkar@gmail.com', NULL, '$2y$10$sMU3cQeFcDpSfAUEpb07t.Oo91XO/vwU5w1.JQw1uCu1hY4vp3Nx6', 'DRLLuoqEUMam7TiIC8VqYM0B8KG29F9QX3S8qHTmiyWmPqURDgMKd0J6yla5', '2020-02-07 21:53:40', '2020-02-07 21:53:40'),
(21, '22222', 'siswa', 'Izma', 'izma@mail.com', NULL, '$2y$10$E0E9epIOkok6zas2q8AuHeRjLpjOgsnQT38wjWn/t6FrkD5G60G9G', 'ai5TwoNCkOPpbpAD8vpsQ0xAS099H4zS48oqHfaegYNt4FFevniDw2WCry9R', '2020-02-09 18:49:14', '2020-02-09 18:49:14'),
(23, '33333', 'siswa', 'Apri', 'apri@mail.com', NULL, '$2y$10$6fKye28Kso52wkdrClJ4gOMzE7IDfCcDsSdn0WdY5y6JDgBc./T2m', 'CGpJDIY4zRADsK3LOI16WR2HcHM7k8Pezp1kiIjrbhP071uZYZDH2WRijwnE', '2020-02-09 19:25:27', '2020-02-09 19:25:27'),
(24, 'G1234', 'guru', 'Supardi', 'supardi@mail.com', NULL, '$2y$10$MpzZuI2LRl7qFTcr9/Sy9ezVbXqvLK4sG4W/SJeJHVi1bH8oWPho.', 'KQXlmGZTESfnrKON6yaQrKeNdhocSQLBUXBccukcCIhRrudY20pXGfXJtKwM', '2020-02-09 21:41:40', '2020-02-09 21:41:40'),
(27, '44444', 'siswa', 'Samsul', 'samsul@gh.com', NULL, '$2y$10$n1BHr4Iy2UD/03ZIYty9w.oqourQ1CYtreU4EcvRagsVXWfk1IkK6', '7JCk52vh60RePwrc7PplCL3rZeLCxwXVfqINNRoeoOaO4YnJXoxLbypifrNH', '2020-02-10 21:46:59', '2020-02-10 21:46:59'),
(28, '44445', 'siswa', 'Udin', 'udin@mail.com', NULL, '$2y$10$or2AEzqhmG9O11cCGHpN2eT7SbP1LXxCoXA03lv3D77J8wvQ.KrLq', 'R8guKnnPjCcQIqdrkyRHAnai70RGaiETF7ueEOmRwr0YrsNLBP1GlNcWSWIq', '2020-02-10 21:56:17', '2020-02-10 21:56:17'),
(29, 'G1235', 'guru', 'Samson', 'samson@mail.com', NULL, '$2y$10$pvs48mb4u/w6dXPy1MQ9xObNTl4VYRN7AiPITwazFLi4l2J4YNFna', 'ODWlAZYvgxLU9FUmkE1Lu2t4JVtaNHg4WTduNUfx5DRZyqh7gSy2VaV9ut6j', '2020-02-11 19:13:33', '2020-02-11 19:13:33'),
(30, 'G1236', 'guru', 'Sayuti', 'hgs@jdhd.com', NULL, '$2y$10$sXxNKPGogvwIefpVB20a.Oc/XjOdoCFfas.ZC9oUMNL/gRVDfrywe', '3M35PRNlm4PzBYEJE0PHIs5G7ESJmtuLLcVk89d5c6d6LXQrXuLpmMfPeU3y', '2020-02-12 20:12:28', '2020-02-12 20:12:28');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class_learns`
--
ALTER TABLE `class_learns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `class_rooms`
--
ALTER TABLE `class_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

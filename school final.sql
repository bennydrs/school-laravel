-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2020 at 05:53 AM
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
(1, '123456', 36, 'Zahir', 'Bogor', '2020-02-01', 'Laki-laki', 'Islam', '081-8181-8181', 'Bogor, Jawa Barat', NULL, '2020-02-18 20:10:26', '2020-03-29 20:27:27'),
(3, '666666', 43, 'Namaku', 'Jakarta', '2020-03-01', 'Laki-laki', 'Islam', '087-8888-8888', 'sdsd', NULL, '2020-03-29 20:32:56', '2020-03-29 20:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `class_learns`
--

CREATE TABLE `class_learns` (
  `id` int(11) NOT NULL,
  `class_room_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_learns`
--

INSERT INTO `class_learns` (`id`, `class_room_id`, `subject_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-02-16 02:30:11', '2020-02-17 02:17:58'),
(9, 3, 1, '2020-02-15 21:53:27', '2020-02-16 04:53:27'),
(10, 1, 2, '2020-02-16 19:43:25', '2020-02-17 02:43:25'),
(12, 2, 1, '2020-02-19 22:47:15', '2020-02-20 05:47:15'),
(13, 3, 2, '2020-02-28 20:23:27', '2020-02-29 03:23:27'),
(14, 1, 4, '2020-03-06 21:13:58', '2020-03-07 04:13:58');

-- --------------------------------------------------------

--
-- Table structure for table `class_rooms`
--

CREATE TABLE `class_rooms` (
  `id` int(11) NOT NULL,
  `kode_kelas` char(6) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_rooms`
--

INSERT INTO `class_rooms` (`id`, `kode_kelas`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'K100', '10 A', '2020-02-11 20:25:15', '2020-03-25 03:17:05'),
(2, 'K101', '10 B', '2020-02-11 20:27:29', '2020-03-25 03:17:38'),
(3, 'K102', '10 C', '2020-02-12 20:33:50', '2020-03-25 03:17:54');

-- --------------------------------------------------------

--
-- Table structure for table `class_students`
--

CREATE TABLE `class_students` (
  `id` int(11) NOT NULL,
  `class_room_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_students`
--

INSERT INTO `class_students` (`id`, `class_room_id`, `student_id`, `semester_id`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 1, '2020-03-03 04:17:33', NULL),
(4, 2, 11, 1, '2020-03-03 10:40:55', NULL),
(5, 1, 12, 1, '2020-03-07 04:48:01', NULL),
(6, 1, 14, 1, '2020-03-12 03:23:46', '2020-03-12 03:23:46'),
(7, 3, 13, 1, '2020-03-13 03:36:53', '2020-03-13 03:36:53'),
(12, 2, 11, 4, '2020-03-13 21:08:33', '2020-03-13 21:08:33'),
(13, 2, 6, 4, '2020-03-13 21:54:32', '2020-03-13 21:54:32'),
(14, 2, 13, 4, '2020-03-13 21:54:32', '2020-03-13 21:54:32'),
(15, 2, 12, 4, '2020-03-13 21:54:32', '2020-03-13 21:54:32'),
(16, 2, 14, 4, '2020-03-13 21:54:32', '2020-03-13 21:54:32');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `class_learn_id` int(11) NOT NULL,
  `class_room_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `class_student_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `nilai_tugas_1` char(3) NOT NULL,
  `nilai_tugas_2` char(3) NOT NULL,
  `nilai_uts` char(3) NOT NULL,
  `nilai_uas` char(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `class_learn_id`, `class_room_id`, `semester_id`, `class_student_id`, `student_id`, `teacher_id`, `nilai_tugas_1`, `nilai_tugas_2`, `nilai_uts`, `nilai_uas`, `created_at`, `updated_at`) VALUES
(49, 10, 1, 1, 1, 6, 3, '75', '80', '90', '85', '2020-03-04 22:28:13', '2020-03-04 22:28:13'),
(51, 1, 1, 1, 1, 6, 1, '80', '85', '80', '85', '2020-03-05 03:03:27', '2020-03-05 03:03:27'),
(56, 1, 1, 2, 1, 6, 1, '80', '85', '90', '85', '2020-03-17 21:52:14', '2020-03-17 21:52:14'),
(62, 1, 1, 1, 5, 12, 1, '80', '80', '90', '85', '2020-05-22 20:10:16', '2020-05-22 20:10:16'),
(63, 1, 1, 1, 6, 14, 1, '80', '75', '80', '80', '2020-05-22 20:10:16', '2020-05-22 20:10:16'),
(64, 1, 1, 2, 5, 12, 1, '80', '80', '90', '85', '2020-05-22 20:15:29', '2020-05-22 20:15:29'),
(65, 1, 1, 2, 6, 14, 1, '80', '80', '90', '85', '2020-05-22 20:15:29', '2020-05-22 20:15:29');

-- --------------------------------------------------------

--
-- Table structure for table `homeroom_teachers`
--

CREATE TABLE `homeroom_teachers` (
  `id` int(11) NOT NULL,
  `class_room_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `homeroom_teachers`
--

INSERT INTO `homeroom_teachers` (`id`, `class_room_id`, `teacher_id`, `semester_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2020-03-04 04:30:51', NULL),
(3, 2, 2, 1, '2020-03-04 03:25:44', '2020-03-04 03:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `informations`
--

CREATE TABLE `informations` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `publish` int(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `informations`
--

INSERT INTO `informations` (`id`, `judul`, `konten`, `user_id`, `updated_by`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'Libur', '<p>Besok libur.</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. <b>Iure </b>ut ipsum quam <i>maxime </i>aspernatur natus voluptates soluta, exercitationem, minus impedit inventore culpa voluptate. Laborum in reprehenderit inventore! Impedit, modi a.</p>', 1, 36, 1, '2020-03-15 04:20:57', '2020-03-15 20:16:44'),
(2, 'Besok Lebaran', '<p>jkshdkjdkdj hdldhkjdh dkjdkjhdj</p>', 36, 0, 0, '2020-03-14 22:23:06', '2020-03-14 22:23:06'),
(3, 'Ujian', '<p>minggu depan ujian</p>', 36, NULL, 1, '2020-03-15 20:24:05', '2020-03-15 20:24:05');

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
(11, 'Selasa', '09:00', '10:00', 1, 10, 1, 3, '2020-02-23 18:58:57', '2020-02-23 18:58:57'),
(12, 'Selasa', '11:00', '12:00', 1, 1, 1, 2, '2020-02-23 19:23:50', '2020-03-06 22:18:17'),
(17, 'Sabtu', '09:30', '10:30', 1, 1, 1, 2, '2020-02-23 21:32:05', '2020-02-24 03:07:50'),
(18, 'Kamis', '10:00', '10:30', 1, 10, 1, 2, '2020-02-28 20:03:16', '2020-02-28 20:03:16'),
(19, 'Sabtu', '12:00', '13:00', 1, 10, 1, 3, '2020-03-03 21:51:32', '2020-03-03 21:51:32'),
(20, 'Selasa', '12:00', '13:00', 1, 1, 2, 1, '2020-03-03 21:52:01', '2020-03-03 21:52:01'),
(21, 'Senin', '07:00', '08:00', 1, 10, 2, 3, '2020-03-03 21:52:34', '2020-03-03 21:52:34'),
(22, 'Kamis', '09:00', '10:30', 1, 14, 1, 2, '2020-03-06 21:15:10', '2020-03-06 21:15:10'),
(27, 'Senin', '14:30', '15:30', 2, 12, 1, 3, '2020-03-17 21:37:48', '2020-03-17 21:37:48');

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
(4, 'SM212201', 'Genap', '2021/2022', '2020-03-03 21:16:22', '2020-03-03 21:16:22'),
(5, 'SM212202', 'Ganjil', '2021/2022', '2020-03-03 21:17:26', '2020-03-03 21:17:26'),
(6, 'SM222301', 'Genap', '2022/2023', '2020-03-13 21:09:26', '2020-03-13 21:09:26');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nis` char(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `nis`, `user_id`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `alamat`, `foto`, `created_at`, `updated_at`) VALUES
(6, '20201000', 23, 'Apri', 'Bogor', '2003-04-01', 'Perempuan', 'Islam', 'Bogor, Jawa Barat', NULL, '2020-02-09 19:25:27', '2020-03-29 21:26:48'),
(11, '20201001', 39, 'Udin', 'Bogor', '2020-02-01', 'Laki-laki', 'Islam', 'Udin', NULL, '2020-02-26 20:42:38', '2020-02-26 20:42:38'),
(12, '20201002', 40, 'Izma', 'Bogor', '2020-02-02', 'Perempuan', 'Islam', 'ss', NULL, '2020-02-28 21:41:50', '2020-02-28 21:41:50'),
(13, '20201003', 41, 'Arif', 'Bogor', '2017-03-01', 'Laki-laki', 'Islam', 'arab', 'afkarun_depth.jpg', '2020-03-08 21:36:23', '2020-03-24 05:16:28'),
(14, '20201004', 42, 'Ruben', 'Jakarta', '1997-03-09', 'Laki-laki', 'Kristen', 'khkj', NULL, '2020-03-08 22:16:26', '2020-03-08 22:16:26');

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
(2, 'MP102', 'Bahasa Indonesia', '2020-02-16 19:43:00', '2020-02-16 19:43:00'),
(4, 'MP103', 'PKN', '2020-03-06 21:13:33', '2020-03-06 21:13:33');

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
(23, '20201000', 'siswa', 'Apri', 'apri@mail.com', NULL, '$2y$10$Fn7rNvoA.9uWHpOKGo/4q.xYGubrqnwL2ZbbfD/bgo9.cYZ8KgIBm', 'q92EKwFzjhqXXfguv2zDmpJn7yVaWNYUuT7wqaQepUqYUw0Ilx8ynDbxuKx7', '2020-02-09 19:25:27', '2020-03-29 19:38:10'),
(24, 'G1234', 'guru', 'Supardi', 'supardi@mail.com', NULL, '$2y$10$MpzZuI2LRl7qFTcr9/Sy9ezVbXqvLK4sG4W/SJeJHVi1bH8oWPho.', '6E8QqbiurcMHbC1RKM1TsJbhDxPESNpiuJwsI89HZ6lbxt44DjwJ0OXgqrrE', '2020-02-09 21:41:40', '2020-02-09 21:41:40'),
(29, 'G1235', 'guru', 'Samson', 'samson@mail.com', NULL, '$2y$10$pvs48mb4u/w6dXPy1MQ9xObNTl4VYRN7AiPITwazFLi4l2J4YNFna', 'ODWlAZYvgxLU9FUmkE1Lu2t4JVtaNHg4WTduNUfx5DRZyqh7gSy2VaV9ut6j', '2020-02-11 19:13:33', '2020-02-11 19:13:33'),
(30, 'G1236', 'guru', 'Sayuti', 'hgs@jdhd.com', NULL, '$2y$10$sXxNKPGogvwIefpVB20a.Oc/XjOdoCFfas.ZC9oUMNL/gRVDfrywe', '3M35PRNlm4PzBYEJE0PHIs5G7ESJmtuLLcVk89d5c6d6LXQrXuLpmMfPeU3y', '2020-02-12 20:12:28', '2020-02-12 20:12:28'),
(36, '123456', 'admin', 'Zahir', 'zahir@mail.com', NULL, '$2y$10$PwmTNJ10UDEdHjvb1LCm0uRLUQm45KGh9piBTnR.9mF1hVQmHwiRS', '9N2SzpSSrUR0ti8FLAUWtvXg0ejXBUyeNzwO7GiVZ6gaKly1NYsC9Bgibpoj', '2020-02-18 20:10:26', '2020-02-18 20:10:26'),
(39, '20201001', 'siswa', 'Udin', 'udin@mail.com', NULL, '$2y$10$1uGt7YoU4yOEmUvr2Fg7Z.Xk.8Od0HztnbV4zXSNO0XdWZC650B5u', 'poecEQnPi3ivIlndqFUSMbfyoFUV0w1pJD8MLVlevGLlTWw0rwwHiDxHzV7d', '2020-02-26 20:42:38', '2020-02-26 20:42:38'),
(40, '20201002', 'siswa', 'Izma', 'izma@mail.com', NULL, '$2y$10$ve6uGfsp3qB3wn2.COqj7.TrqMvyqvsLZ.A1agSHVng7KeTDF7ZLK', '4tFaz989sW8DD56FZoLUdHXcqj3xQxCcnmDJ3g6dLMuCa4taZxulzJvOeiSI', '2020-02-28 21:41:49', '2020-02-28 21:41:49'),
(41, '20201003', 'siswa', 'Arif', 'arif@mail.com', NULL, '$2y$10$WeRmoZ/ghCtUUB8vI2FVxOxOhLRuIu8NiSAGkjD9a1CsHdeV77h8G', 'TkCVzEHcNdyTIO12qRAp9nssdBllsDRAqsZmzpRiM33zgEygT7US1Izs4IHZ', '2020-03-08 21:36:23', '2020-03-08 21:36:23'),
(42, '20201004', 'siswa', 'Ruben', 'ruben@mail.com', NULL, '$2y$10$9b5WuTH2jBc3jjxfLQlUhuxCIsb1fJNl.eD4p.Xvuqw2WUaOus.o2', 'e2iQda8y2cPNE96kMyimzaVWnpNB1h3VMv9O2CrV7iG4wCjm8ZzNssX46tFG', '2020-03-08 22:16:26', '2020-03-08 22:16:26'),
(43, '666666', 'admin', 'Namaku', 'namaku@mail.com', NULL, '$2y$10$CTgdaztUbg0OHKf77lzKLeEqSZhMVKlvvAZvZlpmIC6WdMCK/mGr2', 'rVxGGAW62jRsnTjYj2aWZcYqGMTYaNQ8reC9REsG563KlcxSV6MSWD6n6HPM', '2020-03-29 20:32:56', '2020-03-29 20:32:56');

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
-- Indexes for table `class_students`
--
ALTER TABLE `class_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeroom_teachers`
--
ALTER TABLE `homeroom_teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `informations`
--
ALTER TABLE `informations`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `class_learns`
--
ALTER TABLE `class_learns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `class_rooms`
--
ALTER TABLE `class_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `class_students`
--
ALTER TABLE `class_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `homeroom_teachers`
--
ALTER TABLE `homeroom_teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `informations`
--
ALTER TABLE `informations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

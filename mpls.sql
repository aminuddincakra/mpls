-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 10, 2020 at 09:03 AM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 5.6.40-10+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mpls`
--

-- --------------------------------------------------------

--
-- Table structure for table `jurusans`
--

CREATE TABLE `jurusans` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurusans`
--

INSERT INTO `jurusans` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Teknik komputer jaringan', '2020-07-10 00:01:52', '2020-07-10 00:07:01', NULL);

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
(3, '2017_10_24_014234_create_perms_table', 1),
(4, '2017_10_25_095142_add_collumn_user', 1),
(5, '2018_01_23_140732_alter_users_table_add_activated_col', 1),
(9, '2018_12_31_214250_create_mapels_table', 2),
(10, '2018_12_31_342530_create_ujians_table', 2),
(12, '2019_01_01_061114_create_soals_table', 3),
(13, '2019_01_05_042249_addProviderUser', 4),
(14, '2019_01_14_220600_addColumSourceSoal', 5),
(15, '2019_01_19_072833_create_kelas_table', 5),
(16, '2019_01_19_085907_create_dkelas_table', 5),
(39, '2019_04_18_233022_create_servers_table', 6),
(40, '2019_04_19_144142_create_siswas_table', 6),
(41, '2019_04_21_021825_create_sesis_table', 6),
(42, '2019_04_27_003909_create_ssesis_table', 6),
(43, '2019_04_28_222613_create_sujians_table', 6),
(44, '2019_05_01_072410_create_dsesis_table', 6),
(45, '2019_05_03_222839_create_identitas_table', 6),
(46, '2019_05_07_024720_create_logins_table', 7),
(47, '2019_05_11_150634_create_tokens_table', 8),
(48, '2019_05_18_002322_create_logons_table', 9),
(50, '2019_05_25_064325_add_column_sesi', 10),
(51, '2019_05_26_075827_create_detsesis_table', 11),
(52, '2019_07_04_141349_create_updates_table', 12),
(55, '2019_07_07_123528_create_materis_table', 13),
(56, '2019_07_20_021609_add_column_artisan', 14),
(57, '2019_07_21_012304_create_views_table', 15),
(58, '2019_07_28_014145_add_column_user_id_materis', 16),
(59, '2020_01_11_032054_add_column_siswa_id_waktu', 17),
(60, '2020_01_18_005118_add_column_nilai_waktu', 18),
(61, '2020_01_22_020839_add_column_npsn_identitas', 18),
(63, '2020_02_11_011841_create_pengaturans_table', 19),
(64, '2020_02_13_131150_add_column_status_sekolah', 20),
(65, '2020_02_13_134835_add_column_tim_teknis_pengaturan', 21),
(66, '2020_02_16_075028_create_sinkrons_table', 22),
(67, '2020_02_17_071213_add_column_sesi_id_sinkron', 23),
(68, '2020_03_26_160848_add_column_token_setting', 24),
(69, '2020_03_29_153141_add_column_additional', 25),
(70, '2020_05_14_062755_add_column_agama_siswa', 26),
(71, '2020_05_20_220253_create_khususes_table', 27),
(72, '2020_05_30_140533_add_column_tambahan_user', 28),
(73, '2020_07_10_065000_create_jurusans_table', 29),
(74, '2020_07_10_072501_create_posts_table', 30);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('hajee.network@gmail.com', '$2y$10$nI0c.FBESkzogYn0OZaehu82ToGIdP8Y7YSyjylhgO4dgxr5SJdJG', '2019-01-12 23:47:06');

-- --------------------------------------------------------

--
-- Table structure for table `perms`
--

CREATE TABLE `perms` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perms`
--

INSERT INTO `perms` (`id`, `name`, `permission`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'a:5:{i:0;s:4:\"User\";i:1;s:4:\"Role\";i:2;s:7:\"Jurusan\";i:3;s:5:\"Siswa\";i:4;s:4:\"Post\";}', NULL, '2020-07-10 00:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '0',
  `pinned` int(11) NOT NULL DEFAULT '0',
  `embed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jurusan_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `name`, `text`, `status`, `pinned`, `embed`, `jurusan_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'First post', '<p>First sample post desc edited</p>', 1, 1, 'Http://facebook.com', NULL, '2020-07-10 00:45:13', '2020-07-10 00:50:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `perm_id` int(10) UNSIGNED DEFAULT NULL,
  `activate` int(11) NOT NULL DEFAULT '0',
  `token` text COLLATE utf8mb4_unicode_ci,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `jk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `perm_id`, `activate`, `token`, `provider`, `provider_id`, `alamat`, `jk`, `tempat_lahir`, `tgl_lahir`) VALUES
(1, 'Admin Ujian Edited', 'admin@email.com', '$2y$10$fzk7HVXqyCWmF0Ovvj.XNuDt6pC2AVfZWpWLwDMRPj00IPoU1NGBy', 'tnKeQNmplMb6mgSvuWSqVBFAmExvvgvQmKbwOWHfsrVW5axBkp0bmvi5MElc', NULL, '2019-01-07 21:30:23', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jurusans`
--
ALTER TABLE `jurusans`
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
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `perms`
--
ALTER TABLE `perms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_jurusan_id_foreign` (`jurusan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jurusans`
--
ALTER TABLE `jurusans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `perms`
--
ALTER TABLE `perms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusans` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

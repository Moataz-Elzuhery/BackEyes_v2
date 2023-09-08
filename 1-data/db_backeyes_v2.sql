-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2023 at 02:51 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_backeyes_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE `alerts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `alert_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alerts`
--

INSERT INTO `alerts` (`id`, `user_id`, `alert_image`, `created_at`, `updated_at`) VALUES
(2, 2, '/storage/uploads/alerts/hQh0X7akAzxhaghs8ZxlnjaVAPMacdheisT6dxK7.jpg', '2023-03-14 11:13:18', '2023-03-14 11:13:18');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `member_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `user_id`, `member_image`, `created_at`, `updated_at`) VALUES
(6, 1, '/storage/uploads/members/VvfKRBPoP6LQKtgHOlVoo9aMGs08dlkCoO7WUtm4.jpg', '2023-03-14 10:51:45', '2023-03-14 10:51:45'),
(7, 2, '/storage/uploads/members/bmnMvWTlA0RQ8f7k3lmu8GiuyShhDsMIA9yqxzi8.jpg', '2023-03-14 10:52:27', '2023-03-14 10:52:27');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_03_14_122520_create_members_table', 2),
(7, '2023_03_14_125609_create_alerts_table', 3),
(8, '2023_03_14_125654_create_places_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('abdo@5.com', '$2y$10$Pe6Qm/70tgyeDo0Ffs.FHeqI/MBocEYhKaYIMJQftVw7zyzZKvmXy', '2023-05-01 13:18:43');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(7, 'App\\Models\\User', 3, 'auth_token', '0d0452793d602aab2a8b96609a49a9abb42dd31950bc0ca7d0d6da0cd30fe40f', '[\"*\"]', '2023-03-14 14:16:25', NULL, '2023-03-14 14:14:08', '2023-03-14 14:16:25'),
(8, 'App\\Models\\User', 3, 'auth_token', '0f503f6e4b0b2d01c63ab0509e0b1a6ee20117dc931a3f8c28a802651908f45c', '[\"*\"]', '2023-03-14 14:25:24', NULL, '2023-03-14 14:16:37', '2023-03-14 14:25:24'),
(11, 'App\\Models\\User', 5, 'auth_token', '7dd189b7c18ee6057517dec75c7a933c66b752302fdda841958c23c9454dba61', '[\"*\"]', NULL, NULL, '2023-05-01 12:33:48', '2023-05-01 12:33:48'),
(12, 'App\\Models\\User', 5, 'auth_token', '248b237aa72166c7f18e7381b767ab9f342a62538c026a4e6fd800c117fa651a', '[\"*\"]', NULL, NULL, '2023-05-01 12:41:43', '2023-05-01 12:41:43'),
(14, 'App\\Models\\User', 6, 'auth_token', '95111248c1b4d27047edc412085e97c5b5cd52ab66aa6e6a52c7288b8df858c5', '[\"*\"]', NULL, NULL, '2023-05-01 13:20:54', '2023-05-01 13:20:54');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `place_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `user_id`, `place_image`, `created_at`, `updated_at`) VALUES
(2, 2, '/storage/uploads/places/lUD560alAmVx4NtdZ00Ubp15zE8bYMOSefR3ii74.jpg', '2023-03-14 11:26:03', '2023-03-14 11:26:03');

-- --------------------------------------------------------

--
-- Table structure for table `reset_code_passwords`
--

CREATE TABLE `reset_code_passwords` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` varchar(100) NOT NULL,
  `token` longtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `verified` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `verified`, `created_at`, `updated_at`) VALUES
(1, 'Mahmoud', 'mahmoud@2.com', NULL, '$2y$10$Qffj3KlVAX8J..ZRBaMQcOOkO.gObs/Jd1YwEjpPJSVnapSrX/tRu', NULL, 0, '2023-03-14 10:15:13', '2023-03-14 10:15:13'),
(2, 'ahmed', 'ahmed@2.com', NULL, '$2y$10$LkRmymhaDkBnT5uY7pyOyOA6X9Ey/YwK/Xmf7cjm4TawLMvLnlTMy', NULL, 0, '2023-03-14 10:52:17', '2023-03-14 10:52:17'),
(3, 'ramy', 'r@2.com', NULL, '$2y$10$etpbhC4bpz733PHu/OY04eApqQWr0MaIohadxkVY8.wDbNtZGffbi', NULL, 0, '2023-03-14 13:28:22', '2023-03-14 13:28:22'),
(4, 'ahmed', 'ahmed@22.com', NULL, '$2y$10$FhKCOgHwNorVOGa5pq.qEOouNAv3VPDW0JGsQfinZrl2XL4P/9fnq', NULL, 0, '2023-03-20 18:16:58', '2023-03-20 18:16:58'),
(5, 'abdo', 'abdo@0.com', NULL, '$2y$10$nQXcdxtq09cqm54i3SP1fuEf.k066w2/LI/C53RNLT6mEzFFidjCK', NULL, 0, '2023-03-20 18:30:53', '2023-03-20 18:30:53'),
(6, 'abdo', 'abdo@5.com', NULL, '$2y$10$.Zkrdt0Dvfq5R.d.lHg9GOXcsvvguvWG4sB242xFo7I7c52s3MLZ6', NULL, 0, '2023-05-01 12:55:44', '2023-05-01 12:55:44'),
(7, 'Mahmoud', 'ma7mooudsayed@gmail.com', NULL, '$2y$10$3NPP3eJ23TYAb2ZcofED9Oh30hXw7/rgxzhueEpTvTS2PloIVyjz.', NULL, 0, '2023-05-01 13:02:15', '2023-05-01 13:02:15'),
(12, 'amr', 'saidoraby666@gmail.com', NULL, '$2y$10$3oHpljhv/YE1MVUUjK7tV.XqZNX4Iqq8DZ0u4Rw52f9RJjPzvnj7.', NULL, 0, '2023-05-03 22:21:48', '2023-05-03 22:33:43');

-- --------------------------------------------------------

--
-- Table structure for table `verify_user`
--

CREATE TABLE `verify_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` longtext NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `verify_user`
--

INSERT INTO `verify_user` (`id`, `user_id`, `code`, `status`, `created_at`, `updated_at`) VALUES
(10, 12, '186354', 0, '2023-05-03 22:46:38', '2023-05-03 22:46:38'),
(11, 12, '591383', 0, '2023-05-03 22:49:17', '2023-05-03 22:49:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alerts_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `members_user_id_foreign` (`user_id`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`),
  ADD KEY `places_user_id_foreign` (`user_id`);

--
-- Indexes for table `reset_code_passwords`
--
ALTER TABLE `reset_code_passwords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `verify_user`
--
ALTER TABLE `verify_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alerts`
--
ALTER TABLE `alerts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reset_code_passwords`
--
ALTER TABLE `reset_code_passwords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `verify_user`
--
ALTER TABLE `verify_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alerts`
--
ALTER TABLE `alerts`
  ADD CONSTRAINT `alerts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `places`
--
ALTER TABLE `places`
  ADD CONSTRAINT `places_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

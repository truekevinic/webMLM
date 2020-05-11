-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2020 at 11:51 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `upgrade_cost` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `upgrade_cost`, `created_at`, `updated_at`) VALUES
(1, 0, NULL, NULL),
(2, 58, NULL, NULL),
(3, 105, NULL, NULL),
(4, 210, NULL, NULL),
(5, 420, NULL, NULL),
(6, 840, NULL, NULL),
(7, 1680, NULL, NULL),
(8, 3360, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_source` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bonus_types`
--

CREATE TABLE `bonus_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bonus_type_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bonus_types`
--

INSERT INTO `bonus_types` (`id`, `bonus_type_name`, `created_at`, `updated_at`) VALUES
(1, 'direct', NULL, NULL),
(2, 'pairing', NULL, NULL),
(3, 'jackpot', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_01_18_040914_create_accounts_table', 1),
(2, '2020_01_18_052621_create_packages_table', 1),
(3, '2020_02_23_112139_create_bonus_types_table', 1),
(4, '2020_03_03_231059_create_users_table', 1),
(5, '2020_03_03_231060_create_password_resets_table', 1),
(6, '2020_03_03_231062_create_wallet_types_table', 1),
(7, '2020_03_03_231063_create_wallets_table', 1),
(8, '2020_03_04_113610_create_summaries_table', 1),
(9, '2020_04_23_152328_create_pairings_table', 1),
(10, '2020_05_10_031805_create_advertisements_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_cost` bigint(20) NOT NULL,
  `max_balance` bigint(20) NOT NULL,
  `max_withdraw` double NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `package_cost`, `max_balance`, `max_withdraw`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 100, 100, 2, 0, NULL, NULL),
(2, 300, 300, 2, 0, NULL, NULL),
(3, 1000, 1000, 2, 0, NULL, NULL),
(4, 3000, 3000, 2.5, 0, NULL, NULL),
(5, 5000, 5000, 2.5, 0, NULL, NULL),
(6, 10000, 10000, 3, 0, NULL, NULL),
(7, 30000, 30000, 4, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pairings`
--

CREATE TABLE `pairings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_deposit` bigint(20) NOT NULL,
  `prize` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pairings`
--

INSERT INTO `pairings` (`id`, `group_deposit`, `prize`, `created_at`, `updated_at`) VALUES
(1, 10000, '500', NULL, NULL),
(2, 30000, '1000', NULL, NULL),
(3, 80000, '2000', NULL, NULL),
(4, 200000, '5000', NULL, NULL),
(5, 500000, '10000', NULL, NULL),
(6, 1000000, '20000', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `summaries`
--

CREATE TABLE `summaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bonus_type_id` bigint(20) UNSIGNED NOT NULL,
  `balance` bigint(20) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `summaries`
--

INSERT INTO `summaries` (`id`, `user_id`, `bonus_type_id`, `balance`, `status`, `text`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 30, 'increment', '30 from user with id 2 because of a first registration', '2020-05-11 02:42:03', '2020-05-11 02:42:03'),
(2, 1, 1, 20, 'increment', '20 from user with id 2 because of a first registration', '2020-05-11 02:42:03', '2020-05-11 02:42:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_1` bigint(20) DEFAULT NULL,
  `parent_2` bigint(20) DEFAULT NULL,
  `parent_3` bigint(20) DEFAULT NULL,
  `parent_4` bigint(20) DEFAULT NULL,
  `parent_5` bigint(20) DEFAULT NULL,
  `parent_6` bigint(20) DEFAULT NULL,
  `parent_7` bigint(20) DEFAULT NULL,
  `parent_8` bigint(20) DEFAULT NULL,
  `referral_id` bigint(20) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referral_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suspend_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `parent_1`, `parent_2`, `parent_3`, `parent_4`, `parent_5`, `parent_6`, `parent_7`, `parent_8`, `referral_id`, `name`, `username`, `email`, `email_verified_at`, `password`, `status`, `active_status`, `profile_image`, `referral_code`, `role_status`, `suspend_status`, `package_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', 'admin', 'admin@gmail.com', NULL, '$2y$10$qnYtrcRAp0dPrMGMgjtG4OaKoMeCEvBdrk7/x4.4Da14dI5CD1/km', 'admin', 'active', 'dummy.png', 'amd1in0', 'admin', 'unsuspend', NULL, NULL, NULL, NULL),
(2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'dev', 'dev', 'devincalimto@gmail.com', NULL, '$2y$10$m5gaJnBroEluGoI2/7BxgeAHryKl0BHyDYitWQTCoYhm7jYpnFfvW', 'member', 'active', 'dummy.png', '0967b52b', 'approved', 'unsuspend', 1, NULL, '2020-05-11 02:41:09', '2020-05-11 02:42:03');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `wallet_type_id` bigint(20) UNSIGNED NOT NULL,
  `balance` bigint(20) NOT NULL,
  `max_balance` bigint(20) DEFAULT NULL,
  `max_withdraw` bigint(20) DEFAULT NULL,
  `level` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `wallet_type_id`, `balance`, `max_balance`, `max_withdraw`, `level`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 20, NULL, NULL, NULL, NULL, '2020-05-11 02:42:03'),
(2, 1, 2, 0, NULL, NULL, 1, NULL, NULL),
(3, 1, 3, 30, NULL, NULL, NULL, NULL, '2020-05-11 02:42:03'),
(4, 2, 1, 0, 100, 200, NULL, '2020-05-11 02:42:03', '2020-05-11 02:42:03'),
(5, 2, 2, 0, 0, 0, 1, '2020-05-11 02:42:03', '2020-05-11 02:42:03'),
(6, 2, 3, 0, 0, 0, 1, '2020-05-11 02:42:03', '2020-05-11 02:42:03');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_types`
--

CREATE TABLE `wallet_types` (
  `wallet_type_id` bigint(20) UNSIGNED NOT NULL,
  `type_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallet_types`
--

INSERT INTO `wallet_types` (`wallet_type_id`, `type_name`, `created_at`, `updated_at`) VALUES
(1, 'direct', NULL, NULL),
(2, 'pairing', NULL, NULL),
(3, 'jackpot', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advertisements_user_id_foreign` (`user_id`);

--
-- Indexes for table `bonus_types`
--
ALTER TABLE `bonus_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pairings`
--
ALTER TABLE `pairings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `summaries`
--
ALTER TABLE `summaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `summaries_user_id_foreign` (`user_id`),
  ADD KEY `summaries_bonus_type_id_foreign` (`bonus_type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_package_id_foreign` (`package_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallets_wallet_type_id_foreign` (`wallet_type_id`);

--
-- Indexes for table `wallet_types`
--
ALTER TABLE `wallet_types`
  ADD PRIMARY KEY (`wallet_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bonus_types`
--
ALTER TABLE `bonus_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pairings`
--
ALTER TABLE `pairings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `summaries`
--
ALTER TABLE `summaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wallet_types`
--
ALTER TABLE `wallet_types`
  MODIFY `wallet_type_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD CONSTRAINT `advertisements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `summaries`
--
ALTER TABLE `summaries`
  ADD CONSTRAINT `summaries_bonus_type_id_foreign` FOREIGN KEY (`bonus_type_id`) REFERENCES `bonus_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `summaries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_wallet_type_id_foreign` FOREIGN KEY (`wallet_type_id`) REFERENCES `wallet_types` (`wallet_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

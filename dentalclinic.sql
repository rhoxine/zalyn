-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2023 at 06:53 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dentalclinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT '0-pending; 1-Scheduled/Approved; 2-Canceled; 3-Completed;',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `service_id`, `date`, `status`, `description`, `reason`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, '2023-12-21 16:00:00', 1, NULL, NULL, '2023-12-15 04:55:28', '2023-12-15 04:59:54'),
(2, 3, NULL, '2023-12-24 16:00:00', 2, NULL, 'Sarado Kami, please resched another day. Thankyou', '2023-12-15 04:55:39', '2023-12-15 05:00:25'),
(3, 4, NULL, '2023-12-27 16:00:00', 0, NULL, NULL, '2023-12-15 04:57:45', '2023-12-15 04:57:45'),
(4, 4, NULL, '2024-01-29 16:00:00', 1, NULL, NULL, '2023-12-15 04:58:05', '2023-12-15 05:00:33');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_desc`, `created_at`, `updated_at`) VALUES
(1, 'Infection Control and Personal Protective', 'For safety', '2023-12-15 05:10:39', '2023-12-15 05:10:39'),
(2, 'Restorative Materials', 'Used to restore damaged or missing teeth structures', '2023-12-15 05:10:58', '2023-12-15 05:10:58'),
(3, 'X-ray Supplies', 'None', '2023-12-15 05:11:28', '2023-12-15 05:11:28'),
(4, 'Orthondic Supplies', 'for braces', '2023-12-15 05:11:49', '2023-12-15 05:11:49');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `footers`
--

CREATE TABLE `footers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` blob NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` bigint(20) NOT NULL,
  `copyright` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `days` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hours` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footers`
--

INSERT INTO `footers` (`id`, `logo`, `facebook`, `address`, `phone`, `copyright`, `days`, `hours`, `created_at`, `updated_at`) VALUES
(1, 0x75706c6f6164732f33443368364a7367736448613054384e4d4f4e704266754348314549436479366a63367a463030502e706e67, 'Saura Dental Clinic', 'Corner Pecson, Burgos St. Poblacion, Anda, Pangasinan', 9602885316, '2023 Saura@DentalClinic. All Rights', 'Monday-Saturday', '8:00-5:00', '2023-12-15 04:51:06', '2023-12-15 04:51:06');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gallery_before` blob NOT NULL,
  `gallery_after` blob NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `gallery_before`, `gallery_after`, `created_at`, `updated_at`) VALUES
(1, 0x75706c6f6164732f37596a7769716f457a3658564d425550355a62476c667851356e6f504c6647616656537a6c50586f2e6a7067, 0x75706c6f6164732f7463363077486250476f5273333547574361744b33536351624a46634c4a64795348744f327732752e6a7067, '2023-12-15 04:48:52', '2023-12-15 04:48:52'),
(2, 0x75706c6f6164732f6b7763726953686a58416c494a4e367241733443775336436237334e3376316144506d574e5969652e6a7067, 0x75706c6f6164732f4b723861797235773776484d6b6c6e596b5154717366454353635579324349794e4e364a556377562e6a7067, '2023-12-15 04:49:12', '2023-12-15 04:49:12'),
(3, 0x75706c6f6164732f49476167676870367a5248336c466b3864634673377339487541467a73324c506a67777a773044472e6a7067, 0x75706c6f6164732f654248696a713044504f786865564c565266596a554a524c68714e576f70624737726b584d414c782e6a7067, '2023-12-15 04:49:31', '2023-12-15 04:49:31');

-- --------------------------------------------------------

--
-- Table structure for table `medhistory`
--

CREATE TABLE `medhistory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `yes` tinyint(1) DEFAULT 0,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medhistory`
--

INSERT INTO `medhistory` (`id`, `user_id`, `question_id`, `yes`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, NULL, '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(2, 1, 2, 0, NULL, '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(3, 1, 3, 0, NULL, '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(4, 1, 4, 0, NULL, '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(5, 1, 5, 0, NULL, '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(6, 1, 6, 0, NULL, '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(7, 2, 1, 0, NULL, '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(8, 2, 2, 0, NULL, '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(9, 2, 3, 0, NULL, '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(10, 2, 4, 0, NULL, '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(11, 2, 5, 0, NULL, '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(12, 2, 6, 0, NULL, '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(13, 3, 1, 1, 'Paracetamol', '2023-12-15 04:53:39', '2023-12-15 04:56:47'),
(14, 3, 2, 0, NULL, '2023-12-15 04:53:39', '2023-12-15 04:56:47'),
(15, 3, 3, 0, NULL, '2023-12-15 04:53:39', '2023-12-15 04:56:47'),
(16, 3, 4, 0, NULL, '2023-12-15 04:53:39', '2023-12-15 04:56:47'),
(17, 3, 5, 0, NULL, '2023-12-15 04:53:39', '2023-12-15 04:56:47'),
(18, 3, 6, 1, 'sensitivity', '2023-12-15 04:53:39', '2023-12-15 04:56:47'),
(19, 4, 1, 0, NULL, '2023-12-15 04:57:28', '2023-12-15 04:59:14'),
(20, 4, 2, 1, 'nangangati sa anesthesia', '2023-12-15 04:57:28', '2023-12-15 04:59:14'),
(21, 4, 3, 0, NULL, '2023-12-15 04:57:28', '2023-12-15 04:59:14'),
(22, 4, 4, 0, NULL, '2023-12-15 04:57:28', '2023-12-15 04:59:14'),
(23, 4, 5, 0, NULL, '2023-12-15 04:57:28', '2023-12-15 04:59:14'),
(24, 4, 6, 1, 'bleeding gums', '2023-12-15 04:57:28', '2023-12-15 04:59:14');

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_22_140334_create_permission_tables', 1),
(6, '2023_10_24_115112_create_services_table', 1),
(7, '2023_11_01_135420_create_questions_table', 1),
(8, '2023_11_01_140945_create_medhistory_table', 1),
(9, '2023_11_05_041023_create_appointments_table', 1),
(10, '2023_12_03_121204_create_review', 1),
(11, '2023_12_03_121233_create_services_content', 1),
(12, '2023_12_03_121244_create_footer_tbl', 1),
(13, '2023_12_03_121253_create_gallery', 1),
(14, '2023_12_03_121304_category_table', 1),
(15, '2023_12_03_121318_products_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `prod_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manufacturer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `purchased_date` date NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `prod_name`, `serial_num`, `manufacturer`, `price`, `qty`, `purchased_date`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 'Gloves', 'GL9264749', 'Dental Domain Corp.', 1000, 50, '2023-12-14', 'N/A', '2023-12-15 05:13:41', '2023-12-15 05:16:19'),
(2, 2, 'Cements', 'HS3006465', 'Dental Domain Corp.', 3000, 60, '2023-12-06', 'N/A', '2023-12-15 05:14:34', '2023-12-15 05:14:34'),
(3, 3, 'Syringes and Needles', 'SN75574', 'Dental Domain Corp.', 3000, 56, '2023-12-08', 'N/A', '2023-12-15 05:15:04', '2023-12-15 05:16:22');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `created_at`, `updated_at`) VALUES
(1, 'Are you currently taking any medications?', '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(2, 'Do you have any known alergies to medications and anesthesia?', '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(3, 'Are you pregnant?', '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(4, 'Do you have fever?', '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(5, 'Do you have any medical conditions such as diabetes or heart disease?', '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(6, 'Do you have any pain, sensitivity, or bleeding gums?', '2023-12-15 04:39:50', '2023-12-15 04:39:50');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(2, 'User', 'web', '2023-12-15 04:39:50', '2023-12-15 04:39:50');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Tooth Restoration (Pasta)', '800', '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(2, 'Tooth Whitening (Pampaputi ng ngipin)', '500', '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(3, 'Oral Prophylaxis (linis ng ngipin)', '1000', '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(4, 'Veneers', '18500', '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(5, 'Jacket Crown', '15000', '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(6, 'Fixed Bridge', '20000', '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(7, 'Dentures', '21000', '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(8, 'Surgery (bunot)', '500', '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(9, 'Root Canal Treatment', '9000', '2023-12-15 04:39:50', '2023-12-15 04:39:50');

-- --------------------------------------------------------

--
-- Table structure for table `services_websites`
--

CREATE TABLE `services_websites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `services_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `services_image` blob NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services_websites`
--

INSERT INTO `services_websites` (`id`, `services_name`, `price`, `desc`, `services_image`, `created_at`, `updated_at`) VALUES
(1, 'Tooth Restoration (Pasta)', 800, 'When a tooth has a small cavity or decay, we often use tooth restoration instead of bunot. We removes the decayed portion of the tooth and fills the space with the chosen material.', 0x75706c6f6164732f437162384c524e306565544938667a39673259694c556b6c433765783346624c644b3171553155522e706e67, '2023-12-15 04:42:48', '2023-12-15 04:42:48'),
(2, 'Maryland Bridge', 20000, 'Maryland bridges are used when the adjacent teeth on either side of the missing tooth are healthy and don\'t need extensive dental work. Unlike traditional bridges, Maryland bridges require minimal tooth reduction, as they are affixed to the back of the adjacent teeth using metal or porcelain wings.', 0x75706c6f6164732f6539706a704f45755138366e6b39545159364674514b676763705962306434385a306a745366384d2e706e67, '2023-12-15 04:43:32', '2023-12-15 04:43:32'),
(3, 'Whitening', 5000, 'Do your teeth have stains or discoloration? We offer tooth whitening that lasts for a year or more, helping to bring back your confident smile.', 0x75706c6f6164732f46486356786d36336e6e4676795441416765546d53324d625258317079746d6843476a31327556352e706e67, '2023-12-15 04:44:32', '2023-12-15 04:45:19'),
(4, 'Veneers', 18500, 'If your teeth have severe staining or discoloration that doesn\'t respond to teeth whitening, you might consider opting for veneers. They are typically used to improve the appearance of your teeth by covering imperfections like staining, chipping, or gaps.\"', 0x75706c6f6164732f577165706b344239304d323768764d6e6d4e51385857384768616b766e39424848316c6a3266314a2e706e67, '2023-12-15 04:45:05', '2023-12-15 04:45:05'),
(5, 'Oral Prophylaxis (linis ng ngipin)', 1000, 'Oral prophylaxis done every six months, brushing our teeth is not enough to remove the tartar or plaque. Regular cleanings help prevent the buildup of plaque and tartar, reducing the risk of dental issues like cavities and gum disease.', 0x75706c6f6164732f416943645565436a30785a6f69704652364d7558725637423553726f386f68746e6b7a783463534f2e706e67, '2023-12-15 04:45:53', '2023-12-15 04:45:53'),
(6, 'Jacket Crown', 15000, 'Your teeth has extensive decay, extensive fractures or cracks and cannot be adequately restored with a filling?, a jacket crown can be placed to cover and protect the remaining tooth structure.', 0x75706c6f6164732f7547373759656e534e4751516c486c476853633346696748787455646e6d59544d375854786676342e706e67, '2023-12-15 04:46:24', '2023-12-15 04:46:24'),
(7, 'Dentures', 21000, 'Are you tired of hiding your smile because of missing teeth? Dentures are the ideal choice, it provide a complete set of artificial teeth that look and function just like the real thing.', 0x75706c6f6164732f7570774733797839786a54456155636d414247706846777575735a697148456d32474359726347512e706e67, '2023-12-15 04:47:01', '2023-12-15 04:47:01'),
(8, 'Bunot', 500, 'You has tooth decay becomes so extensive that it cannot be effectively treated with fillings or other restorative measures? or wisdom teeth (third molars) do not have enough space to emerge properly or grow at an angle, they can cause pain, infection, or damage to neighboring teeth.Dental surgery becomes the path to eliminate pain and prevent further dental issues.', 0x75706c6f6164732f525654376e5279776f687643397259624d5469666b6d583637675a4d696a326368466275617761532e706e67, '2023-12-15 04:47:59', '2023-12-15 04:47:59'),
(9, 'Root Canal Treatment', 9000, 'When a toothache strikes with intense, throbbing pain, it can be a sign of an infected or damaged pulp within the tooth. Root canal therapy is the answer to your relief, alleviating the pain and saving your natural tooth. Don\'t let a toothache steal your smile!', 0x75706c6f6164732f35434b5a526d68583030724e3673315334764d37416d3044394653337246736a4342777148494a722e706e67, '2023-12-15 04:48:34', '2023-12-15 04:48:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonenum` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `sex` tinyint(1) DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phonenum`, `bdate`, `sex`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@sample.com', NULL, NULL, 0, NULL, '$2y$10$ONIQawEiOzRj9Yz8tlbL1u1YkhJIwf9JUp/pcQvABhN75UACPR3H.', NULL, '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(2, 'User', 'user@sample.com', NULL, NULL, 0, NULL, '$2y$10$4Jyzz9fVZc5TMWrnVwgBbO6Xff/Kdc23FASaTVb/DYQTVBUAf.Lfy', NULL, '2023-12-15 04:39:50', '2023-12-15 04:39:50'),
(3, 'Mario Celeste', 'mario@gmail.com', '09283736734', '2001-01-19', 0, NULL, '$2y$10$yNuSCzViYmeA9ZvH70LvAOYCUR3G7QAHdYKP7vu7NCLe6sVZkenXS', NULL, '2023-12-15 04:53:39', '2023-12-15 04:56:26'),
(4, 'Sanya Lopez', 'sanya@gmail.com', '09384726398', '2001-02-09', 1, NULL, '$2y$10$WAYD46u3rGcUYTLGDcaOR.ckiWYFnQBPHYI1Vtob60Y3a/7qH/kQW', NULL, '2023-12-15 04:57:28', '2023-12-15 04:58:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `footers`
--
ALTER TABLE `footers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medhistory`
--
ALTER TABLE `medhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services_websites`
--
ALTER TABLE `services_websites`
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
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `footers`
--
ALTER TABLE `footers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medhistory`
--
ALTER TABLE `medhistory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `services_websites`
--
ALTER TABLE `services_websites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

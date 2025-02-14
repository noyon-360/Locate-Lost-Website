-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2025 at 07:07 PM
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
-- Database: `locat_lost`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `image`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'noyon@gmail.com', '', '$2y$12$Lo1OZLJY6emI5kZcAnoCQO8XigF/7YkDFrbqdo21F0S3mowdPmIta', '2025-02-03 11:18:30', '2025-02-03 11:18:30');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `missing_report_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `commentable_type` varchar(255) NOT NULL,
  `commentable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `missing_report_id`, `content`, `commentable_type`, `commentable_id`, `created_at`, `updated_at`) VALUES
(1, 2, 'Train station', 'App\\Models\\User', 3, '2025-02-03 11:32:45', '2025-02-03 11:32:45'),
(2, 2, '555 Elm St, San Francisco, CA', 'App\\Models\\User', 2, '2025-02-03 11:33:52', '2025-02-03 11:33:52');

-- --------------------------------------------------------

--
-- Table structure for table `completions`
--

CREATE TABLE `completions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `found_date` date NOT NULL,
  `missing_person_id` bigint(20) UNSIGNED NOT NULL,
  `found_location` varchar(255) NOT NULL,
  `recovery_details` text NOT NULL,
  `documents` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`documents`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `completions`
--

INSERT INTO `completions` (`id`, `found_date`, `missing_person_id`, `found_location`, `recovery_details`, `documents`, `created_at`, `updated_at`) VALUES
(1, '2025-02-04', 1, '666 Willow St, Phoenix, AZ', 'Null', '[]', '2025-02-03 12:03:12', '2025-02-03 12:03:12'),
(2, '2025-02-04', 3, '666 Willow St, Phoenix, AZ', 'Noting', '[]', '2025-02-03 12:06:46', '2025-02-03 12:06:46');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(13, '0001_01_01_000000_create_users_table', 1),
(14, '0001_01_01_000001_create_cache_table', 1),
(15, '0001_01_01_000002_create_jobs_table', 1),
(16, '2024_12_26_094440_create_missing_people_table', 1),
(17, '2024_12_26_144412_create_admins_table', 1),
(18, '2024_12_31_182802_create_notifiations_table', 1),
(19, '2025_01_22_083637_create_stations_table', 1),
(20, '2025_01_24_014429_create_station_names_locations_table', 1),
(21, '2025_01_25_022213_create_missing_reports_table', 1),
(22, '2025_01_28_201756_create_comments_table', 1),
(23, '2025_01_29_130452_create_completions_table', 1),
(24, '2025_02_03_165632_add_missing_reports_info_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `missing_people`
--

CREATE TABLE `missing_people` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `permanent_address` varchar(255) NOT NULL,
  `last_seen_location_description` text NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `front_image` varchar(255) NOT NULL,
  `additional_pictures` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`additional_pictures`)),
  `missing_date` date DEFAULT NULL,
  `status` enum('pending','completed') NOT NULL DEFAULT 'pending',
  `submitted_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `missing_people`
--

INSERT INTO `missing_people` (`id`, `fullname`, `date_of_birth`, `gender`, `permanent_address`, `last_seen_location_description`, `father_name`, `mother_name`, `contact_number`, `email`, `front_image`, `additional_pictures`, `missing_date`, `status`, `submitted_by`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', '2005-06-15', 'male', '123 Main St, New York, NY', 'Central Park near the fountain', 'Robert Doe', 'Jane Doe', '9876543210', 'johndoe@email.com', 'uploads/front_images/apYpYFzo1V2LDC1hjageAuyeseIgoVqGdvnxoLIT.jpg', '[\"uploads\\/additional_pictures\\/le7YDMShBQpDtBjN3lkYs7TIyzWI2F4xbj17Vbdq.jpg\",\"uploads\\/additional_pictures\\/3x9ggSRwj6TdmjFb5jdakmNelULrv3aiT0dF7RtQ.jpg\"]', '2025-01-15', 'completed', 'centralgateway@gmail.com', '2025-02-03 11:21:56', '2025-02-03 12:03:12'),
(2, 'Emily Smith', '1998-03-22', 'female', '789 Park Ave, Los Angeles, CA', 'Near Metro Station', 'Thomas Smith', 'Linda Smith', '8765432109', 'emilysmith@email.com', 'uploads/front_images/SmZOrpiMQZGteKfn95IB8oBSgThUqppVhGD4HyLG.jpg', '[\"uploads\\/additional_pictures\\/iOZe4KQuFJE65Xpg6f9S3OIioWQks9hIvwdcmQ4P.jpg\",\"uploads\\/additional_pictures\\/MBAXqquwbcpNqItV3pwgJv56IjVDoIpD33uQtQJz.jpg\"]', '2025-01-10', 'pending', 'centralgateway@gmail.com', '2025-02-03 11:23:34', '2025-02-03 11:23:34'),
(3, 'Michael Johnson', '2010-11-05', 'male', '555 Oak St, Chicago, IL', 'Shopping mall entrance', 'David Johnson', 'Sarah Johnson', '7654321098', 'michaelj@email.com', 'uploads/front_images/kyBVLD30GlMN628hGpfGNOJCfJW2tQ7MGTFPPj5b.jpg', '[\"uploads\\/additional_pictures\\/Rou4LHZ8ALlJa4h07PSrb1juVaUa3UFOZz1dNvXF.jpg\",\"uploads\\/additional_pictures\\/E0mmmA2Vjg3TCk29zStlQqg74Y1YmwrhBVa7Xrks.jpg\"]', '2025-01-20', 'completed', 'easternjunction@gmail.com', '2025-02-03 11:25:24', '2025-02-03 12:06:46'),
(4, 'Sophia Brown', '2002-07-12', 'female', '102 Pine St, Houston, TX', 'Near the university campus', 'James Brown', 'Mary Brown', '6543210987', 'sophiab@email.com', 'uploads/front_images/LwaXfSLK9s4TCntnJpdCpRqeB5VbH0OatjBKycLr.jpg', '[\"uploads\\/additional_pictures\\/C1WMrUuNRmSRcaBpGpJnSt0gfQVQtWLTcqty3Woh.jpg\",\"uploads\\/additional_pictures\\/wDk7GXhAKbKh0af6AYu0BjiJ5qZ0xUTowu4518KM.jpg\",\"uploads\\/additional_pictures\\/frtTcOSgcj3aQId1wWVa1Naukp0VD6ADx141LoR3.jpg\"]', '2025-01-05', 'pending', 'easternjunction@gmail.com', '2025-02-03 11:26:58', '2025-02-03 11:26:58'),
(5, 'Daniel Wilson', '1995-09-18', 'male', '333 Cedar St, Miami, FL', 'Gas station', 'Henry Wilson', 'Patricia Wilson', '5432109876', 'danielw@email.com', 'uploads/front_images/32LAP8BLIPKm1p9nzbKPjmadmRogmIApdsVLn6Dg.jpg', '[\"uploads\\/additional_pictures\\/jumr65gfa5VpJ0f5BNEiqK2lsIGBqm9hSuV8SSON.jpg\",\"uploads\\/additional_pictures\\/ixgXdvvwGsVVIvgeKgbw9isBtBVQ2nQGhmf3WTZ9.jpg\"]', '2025-01-12', 'pending', 'northernhub@gmail.com', '2025-02-03 11:37:45', '2025-02-03 11:37:45');

-- --------------------------------------------------------

--
-- Table structure for table `missing_reports`
--

CREATE TABLE `missing_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `missing_person_id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `station_id` bigint(20) UNSIGNED DEFAULT NULL,
  `submitted_by` varchar(255) DEFAULT NULL,
  `station_name` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `seen_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `missing_reports`
--

INSERT INTO `missing_reports` (`id`, `missing_person_id`, `description`, `latitude`, `longitude`, `user_id`, `station_id`, `submitted_by`, `station_name`, `role`, `seen_at`, `created_at`, `updated_at`) VALUES
(1, 2, '888 Maple St, Boston, MA', 23.9789834, 90.6507847, 3, NULL, 'mizan@gmail.com', NULL, 'user', '2025-02-02 11:31:00', '2025-02-03 11:32:30', '2025-02-03 11:32:30'),
(2, 2, '555 Elm St, San Francisco, CA', 23.9396026, 90.6159952, 2, NULL, 'alif@gmail.com', NULL, 'user', '2025-02-02 11:31:00', '2025-02-03 11:34:40', '2025-02-03 11:34:40');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 'station', '\"{\\\"name\\\":\\\"Northern Hub\\\",\\\"email\\\":\\\"northernhub@gmail.com\\\",\\\"image\\\":\\\"uploads\\\\\\/station_pictures\\\\\\/CqJBNx46HAsN9VQJNiC6UQNLobUzEJqgSrQCHhcr.jpg\\\"}\"', NULL, '2025-02-03 11:18:50', '2025-02-03 11:18:50'),
(2, 'station', '\"{\\\"name\\\":\\\"Central Gateway\\\",\\\"email\\\":\\\"centralgateway@gmail.com\\\",\\\"image\\\":\\\"uploads\\\\\\/station_pictures\\\\\\/Di0IpSYrj2UijKGckwgz20Yf7sJiZNe2KboMLMHm.jpg\\\"}\"', '2025-02-03 11:19:47', '2025-02-03 11:19:01', '2025-02-03 11:19:47'),
(3, 'station', '\"{\\\"name\\\":\\\"Eastern Junction\\\",\\\"email\\\":\\\"easternjunction@gmail.com\\\",\\\"image\\\":\\\"uploads\\\\\\/station_pictures\\\\\\/qTzZ4ElB8iKQXbkQ06AA46Nh7BGhD2y05SxTJGgC.jpg\\\"}\"', '2025-02-03 11:30:28', '2025-02-03 11:19:14', '2025-02-03 11:30:28'),
(4, 'station', '\"{\\\"name\\\":\\\"Uttara Terminus\\\",\\\"email\\\":\\\"uttaraterminus@gmail.com\\\",\\\"image\\\":\\\"uploads\\\\\\/station_pictures\\\\\\/8ijhIyrIWhjrPYP9oJLGOnseUApSmxaf7tlNTmc4.jpg\\\"}\"', NULL, '2025-02-03 11:19:27', '2025-02-03 11:19:27'),
(5, 'user', '\"{\\\"name\\\":\\\"Noyon\\\",\\\"email\\\":\\\"noyon@gmail.com\\\",\\\"image\\\":null}\"', NULL, '2025-02-03 11:28:24', '2025-02-03 11:28:24'),
(6, 'user', '\"{\\\"name\\\":\\\"Alif\\\",\\\"email\\\":\\\"alif@gmail.com\\\",\\\"image\\\":null}\"', NULL, '2025-02-03 11:29:22', '2025-02-03 11:29:22'),
(7, 'user', '\"{\\\"name\\\":\\\"Mizan\\\",\\\"email\\\":\\\"mizan@gmail.com\\\",\\\"image\\\":null}\"', NULL, '2025-02-03 11:29:51', '2025-02-03 11:29:51'),
(8, 'user', '\"{\\\"name\\\":\\\"Unknown\\\",\\\"email\\\":\\\"unknown@gmail.com\\\",\\\"image\\\":null}\"', NULL, '2025-02-03 11:59:12', '2025-02-03 11:59:12');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('aCx1do24KjJpG2S2eBLeDsRgHrRJyhCZLUvSj74C', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSkpQWWRpaElRdHhadnNyTkF3bTJaTEg5V053U0pKell2QmFpV25LUyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdGF0aW9uL2Rhc2hib2FyZCI7fXM6NTQ6ImxvZ2luX3N0YXRpb25fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1738606006),
('zQ2AYqAMgxGq3giYFYtrixjI5sslkgWS4qMOH8cN', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 Edg/132.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibXdzYWFISkl5VTNNUnFzY3o4dGRoaVhxTkxodVU3a1VtSzd4OWswcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1738605552);

-- --------------------------------------------------------

--
-- Table structure for table `stations`
--

CREATE TABLE `stations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `station_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `station_picture` varchar(255) DEFAULT NULL,
  `last_login_at` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'station',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stations`
--

INSERT INTO `stations` (`id`, `station_name`, `email`, `password`, `station_picture`, `last_login_at`, `status`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Northern Hub', 'northernhub@gmail.com', '$2y$12$32qQJ8UlhNXQaRBXpRcSf.D5p6qjUj01tObkejfkhW1upO0BdRKX6', 'uploads/station_pictures/CqJBNx46HAsN9VQJNiC6UQNLobUzEJqgSrQCHhcr.jpg', '2025-02-03 17:36:03', 'approved', 'station', NULL, '2025-02-03 11:18:50', '2025-02-03 11:36:03'),
(2, 'Central Gateway', 'centralgateway@gmail.com', '$2y$12$2RvLusEnkboXuRsNVqfefOt2ZXzZ4r73W.wbAmxkeXXcaxYm..3Le', 'uploads/station_pictures/Di0IpSYrj2UijKGckwgz20Yf7sJiZNe2KboMLMHm.jpg', '2025-02-03 18:01:00', 'approved', 'station', NULL, '2025-02-03 11:19:01', '2025-02-03 12:01:00'),
(3, 'Eastern Junction', 'easternjunction@gmail.com', '$2y$12$0gwszc5LMP.u4.o70cWSDuP6QiHLgvuwisBd4Ia8y6Bk7z6uMjIrm', 'uploads/station_pictures/qTzZ4ElB8iKQXbkQ06AA46Nh7BGhD2y05SxTJGgC.jpg', '2025-02-03 18:06:17', 'approved', 'station', NULL, '2025-02-03 11:19:14', '2025-02-03 12:06:17'),
(4, 'Uttara Terminus', 'uttaraterminus@gmail.com', '$2y$12$SK890Na7oQ0RXOwB2fhEauiFai2Jcnu.BCwSl8eUy6DGknxEJnDoe', 'uploads/station_pictures/8ijhIyrIWhjrPYP9oJLGOnseUApSmxaf7tlNTmc4.jpg', '2025-02-03 17:19:27', 'pending', 'station', NULL, '2025-02-03 11:19:27', '2025-02-03 11:19:27');

-- --------------------------------------------------------

--
-- Table structure for table `station_names_locations`
--

CREATE TABLE `station_names_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `station_name` varchar(255) NOT NULL,
  `locations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`locations`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `station_names_locations`
--

INSERT INTO `station_names_locations` (`id`, `station_name`, `locations`, `created_at`, `updated_at`) VALUES
(1, 'Northern Hub', '[\"Airport\",\"Kawla\",\"Khilkhet\",\"Shewra\",\"Banani\",\"Chairman Bari\",\"Mohakhali\"]', NULL, NULL),
(2, 'Central Gateway', '[\"Station Road\",\"Abdullahpur\",\"House Building\",\"Rajlakshmi\",\"Jashimuddin\"]', NULL, NULL),
(3, 'Eastern Junction', '[\"Hosain Market\",\"Shofiuddin\",\"Collage Gate\",\"Cherag Ali\",\"Mill Gate\"]', NULL, NULL),
(4, 'Uttara Terminus', '[\"Sector 4\",\"Sector 9\",\"Uttara Model Town\",\"Diabari\",\"Azampur\"]', NULL, NULL),
(5, 'Bashundhara Link', '[\"Bashundhara Residential Area\",\"Jamuna Future Park\",\"Baridhara DOHS\",\"Kuril\",\"Notun Bazar\"]', NULL, NULL),
(6, 'Old Dhaka Point', '[\"Sadarghat\",\"Chawk Bazar\",\"Lalbagh\",\"Ahsan Manzil\",\"Shankhari Bazar\"]', NULL, NULL),
(7, 'Gulshan Circle', '[\"Gulshan 1\",\"Gulshan 2\",\"Banani Lake\",\"Baridhara\",\"Tejgaon-Gulshan Link Road\"]', NULL, NULL),
(8, 'Mirpur Exchange', '[\"Mirpur 1\",\"Mirpur 10\",\"Pallabi\",\"Kazipara\",\"Agargaon\"]', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `submitted_infos`
--

CREATE TABLE `submitted_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `missing_person_id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `station_id` bigint(20) UNSIGNED DEFAULT NULL,
  `submitted_by` varchar(255) DEFAULT NULL,
  `station_name` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `last_login_at` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `station_name` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `password`, `role`, `profile_picture`, `last_login_at`, `status`, `station_name`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Noyon', 'noyon@gmail.com', '123456789', '$2y$12$7llt0gDkP8u0LY./kuyWvOvhYK5BddithnGTSsn83MTKLw5s7lcf2', 'user', 'uploads/profile_pictures/NVKqolSdDIwghrBFq1A16qo3UUxL4ebnDFZLHwtB.jpg', NULL, 'approved', 'Northern Hub', NULL, '2025-02-03 11:28:24', '2025-02-03 11:30:23'),
(2, 'Alif', 'alif@gmail.com', '123456789', '$2y$12$2.J8UdUy3vKge4poxg2m6OHEDwhq4APSrJyS3kV10NZiUN0TJFKOS', 'user', 'uploads/profile_pictures/3jeSepy7uupiCaKwR9eYJJxjHh8DTeJYq8VCM2ja.jpg', '2025-02-03 17:33:30', 'approved', 'Central Gateway', NULL, '2025-02-03 11:29:22', '2025-02-03 11:33:30'),
(3, 'Mizan', 'mizan@gmail.com', '123456789', '$2y$12$TP.e1wB6MSec75MkksRb0u6ulzHtG1kKh77G37u.8VZtxDtPNh7c.', 'user', 'uploads/profile_pictures/fkzT0RWGSg09eMLJFTBDkvY0KP7hgfsAvTG6y3iu.jpg', '2025-02-03 17:30:53', 'approved', 'Eastern Junction', NULL, '2025-02-03 11:29:51', '2025-02-03 11:30:53'),
(4, 'Unknown', 'unknown@gmail.com', '123456789', '$2y$12$xNjxJvRDNnn.ni1qxP1b/OwuYssI4W4h3HUeeTR1D.D4OCbXZYVv2', 'user', 'uploads/profile_pictures/lAtYb2S5yW5tP7SD3fb4I9FsYv2sEcmzzq3UjmVj.jpg', NULL, 'pending', 'Northern Hub', NULL, '2025-02-03 11:59:12', '2025-02-03 11:59:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_commentable_type_commentable_id_index` (`commentable_type`,`commentable_id`),
  ADD KEY `comments_missing_report_id_foreign` (`missing_report_id`);

--
-- Indexes for table `completions`
--
ALTER TABLE `completions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `completions_missing_person_id_foreign` (`missing_person_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `missing_people`
--
ALTER TABLE `missing_people`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `missing_people_contact_number_unique` (`contact_number`),
  ADD UNIQUE KEY `missing_people_email_unique` (`email`);

--
-- Indexes for table `missing_reports`
--
ALTER TABLE `missing_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `missing_reports_missing_person_id_foreign` (`missing_person_id`),
  ADD KEY `missing_reports_user_id_foreign` (`user_id`),
  ADD KEY `missing_reports_station_id_foreign` (`station_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stations_email_unique` (`email`);

--
-- Indexes for table `station_names_locations`
--
ALTER TABLE `station_names_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submitted_infos`
--
ALTER TABLE `submitted_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submitted_infos_missing_person_id_foreign` (`missing_person_id`),
  ADD KEY `submitted_infos_user_id_foreign` (`user_id`),
  ADD KEY `submitted_infos_station_id_foreign` (`station_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `completions`
--
ALTER TABLE `completions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `missing_people`
--
ALTER TABLE `missing_people`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `missing_reports`
--
ALTER TABLE `missing_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stations`
--
ALTER TABLE `stations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `station_names_locations`
--
ALTER TABLE `station_names_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `submitted_infos`
--
ALTER TABLE `submitted_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_missing_report_id_foreign` FOREIGN KEY (`missing_report_id`) REFERENCES `missing_people` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `completions`
--
ALTER TABLE `completions`
  ADD CONSTRAINT `completions_missing_person_id_foreign` FOREIGN KEY (`missing_person_id`) REFERENCES `missing_people` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `missing_reports`
--
ALTER TABLE `missing_reports`
  ADD CONSTRAINT `missing_reports_missing_person_id_foreign` FOREIGN KEY (`missing_person_id`) REFERENCES `missing_people` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `missing_reports_station_id_foreign` FOREIGN KEY (`station_id`) REFERENCES `stations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `missing_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `submitted_infos`
--
ALTER TABLE `submitted_infos`
  ADD CONSTRAINT `submitted_infos_missing_person_id_foreign` FOREIGN KEY (`missing_person_id`) REFERENCES `missing_people` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `submitted_infos_station_id_foreign` FOREIGN KEY (`station_id`) REFERENCES `stations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `submitted_infos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

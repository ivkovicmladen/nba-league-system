-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2025 at 04:22 AM
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
-- Database: `nba_league_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('nba-league-system-cache-boston@nba.com|127.0.0.1', 'i:1;', 1764452945),
('nba-league-system-cache-boston@nba.com|127.0.0.1:timer', 'i:1764452945;', 1764452945);

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
-- Table structure for table `coach_stats`
--

CREATE TABLE `coach_stats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `wins` int(11) NOT NULL DEFAULT 0,
  `losses` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coach_stats`
--

INSERT INTO `coach_stats` (`id`, `user_id`, `wins`, `losses`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 1, '2025-11-18 01:46:48', '2025-11-29 20:50:24'),
(2, 5, 1, 1, '2025-11-18 01:46:48', '2025-11-29 20:50:24'),
(3, 28, 0, 0, '2025-11-26 00:59:41', '2025-11-26 00:59:41'),
(4, 54, 1, 0, '2025-11-29 22:12:40', '2025-11-29 21:15:11'),
(5, 53, 0, 0, '2025-11-29 22:12:40', '2025-11-29 22:12:40'),
(7, 56, 0, 0, '2025-11-29 22:12:40', '2025-11-29 22:12:40'),
(8, 55, 0, 1, '2025-11-29 22:12:40', '2025-11-29 21:15:11');

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `status` enum('Active','Completed','Pending','Rejected','Terminated') NOT NULL DEFAULT 'Pending',
  `salary` decimal(12,2) NOT NULL,
  `role` enum('coach','player','referee') NOT NULL,
  `employer_id` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`id`, `user_id`, `date_from`, `date_to`, `status`, `salary`, `role`, `employer_id`, `created_at`, `updated_at`) VALUES
(1, 4, '2025-11-18', NULL, 'Active', 8000000.00, 'coach', '2', '2025-11-18 01:46:48', '2025-11-18 01:46:48'),
(2, 5, '2025-11-18', NULL, 'Active', 11000000.00, 'coach', '3', '2025-11-18 01:46:48', '2025-11-18 01:46:48'),
(3, 6, '2025-11-18', NULL, 'Active', 47000000.00, 'player', '2', '2025-11-18 01:46:48', '2025-11-18 01:46:48'),
(4, 7, '2025-11-18', NULL, 'Active', 40000000.00, 'player', '2', '2025-11-18 01:46:48', '2025-11-18 01:46:48'),
(5, 8, '2025-11-18', NULL, 'Active', 2000000.00, 'player', '2', '2025-11-18 01:46:48', '2025-11-18 01:46:48'),
(6, 9, '2025-11-18', NULL, 'Active', 17000000.00, 'player', '2', '2025-11-18 01:46:49', '2025-11-18 01:46:49'),
(7, 10, '2025-11-18', NULL, 'Active', 18000000.00, 'player', '2', '2025-11-18 01:46:49', '2025-11-18 01:46:49'),
(8, 11, '2025-11-18', NULL, 'Active', 10000000.00, 'player', '2', '2025-11-18 01:46:49', '2025-11-18 01:46:49'),
(9, 12, '2025-11-18', NULL, 'Active', 2000000.00, 'player', '2', '2025-11-18 01:46:49', '2025-11-18 01:46:49'),
(10, 13, '2025-11-18', NULL, 'Active', 4000000.00, 'player', '2', '2025-11-18 01:46:49', '2025-11-18 01:46:49'),
(11, 14, '2025-11-18', NULL, 'Active', 11000000.00, 'player', '2', '2025-11-18 01:46:50', '2025-11-18 01:46:50'),
(12, 15, '2025-11-18', NULL, 'Active', 3000000.00, 'player', '2', '2025-11-18 01:46:50', '2025-11-18 01:46:50'),
(13, 16, '2025-11-18', NULL, 'Active', 34000000.00, 'player', '3', '2025-11-18 01:46:50', '2025-11-18 01:46:50'),
(14, 17, '2025-11-18', NULL, 'Active', 28000000.00, 'player', '3', '2025-11-18 01:46:50', '2025-11-18 01:46:50'),
(15, 18, '2025-11-18', NULL, 'Active', 36000000.00, 'player', '3', '2025-11-18 01:46:51', '2025-11-18 01:46:51'),
(16, 19, '2025-11-18', NULL, 'Active', 18000000.00, 'player', '3', '2025-11-18 01:46:51', '2025-11-18 01:46:51'),
(17, 20, '2025-11-18', NULL, 'Active', 30000000.00, 'player', '3', '2025-11-18 01:46:51', '2025-11-18 01:46:51'),
(18, 21, '2025-11-18', NULL, 'Active', 10000000.00, 'player', '3', '2025-11-18 01:46:51', '2025-11-18 01:46:51'),
(19, 22, '2025-11-18', NULL, 'Active', 2000000.00, 'player', '3', '2025-11-18 01:46:51', '2025-11-18 01:46:51'),
(20, 23, '2025-11-18', NULL, 'Active', 4000000.00, 'player', '3', '2025-11-18 01:46:52', '2025-11-18 01:46:52'),
(21, 24, '2025-11-18', NULL, 'Active', 2000000.00, 'player', '3', '2025-11-18 01:46:52', '2025-11-18 01:46:52'),
(22, 25, '2025-11-18', NULL, 'Active', 2000000.00, 'player', '3', '2025-11-18 01:46:52', '2025-11-18 01:46:52'),
(23, 26, '2025-11-18', NULL, 'Active', 500000.00, 'referee', 'admin', '2025-11-18 01:46:52', '2025-11-18 01:46:52'),
(24, 27, '2025-11-18', NULL, 'Active', 500000.00, 'referee', 'admin', '2025-11-18 01:46:52', '2025-11-18 01:46:52'),
(25, 28, '2025-11-26', '2025-11-27', 'Terminated', 5000000.00, 'player', 'admin', '2025-11-26 00:57:12', '2025-11-27 01:55:42'),
(26, 28, '2025-11-26', '2025-11-29', 'Terminated', 2000000.00, 'coach', 'admin', '2025-11-26 00:57:21', '2025-11-29 21:17:03'),
(29, 29, '2025-11-26', NULL, 'Active', 4000000.00, 'player', '2', '2025-11-26 02:58:11', '2025-11-26 02:59:32'),
(31, 30, NULL, '2026-11-27', 'Rejected', 100000.00, 'referee', 'admin', '2025-11-27 01:49:08', '2025-11-27 01:54:23'),
(32, 30, '2025-11-27', '2025-11-29', 'Terminated', 200000.00, 'referee', 'admin', '2025-11-27 01:49:20', '2025-11-29 21:17:06'),
(33, 36, '2024-10-01', NULL, 'Active', 22500000.00, 'player', '32', '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(34, 38, '2024-10-01', NULL, 'Active', 2803320.00, 'player', '32', '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(35, 40, '2024-10-01', NULL, 'Active', 1836090.00, 'player', '32', '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(36, 34, '2024-10-01', NULL, 'Active', 36016200.00, 'player', '32', '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(37, 42, '2024-10-01', NULL, 'Active', 2306880.00, 'player', '32', '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(38, 37, '2024-10-01', NULL, 'Active', 15400000.00, 'player', '32', '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(39, 35, '2024-10-01', NULL, 'Active', 35859950.00, 'player', '32', '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(40, 33, '2024-10-01', NULL, 'Active', 51415938.00, 'player', '32', '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(41, 41, '2024-10-01', NULL, 'Active', 2455680.00, 'player', '32', '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(42, 39, '2024-10-01', NULL, 'Active', 5250000.00, 'player', '32', '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(48, 52, '2024-10-01', NULL, 'Active', 1985800.00, 'player', '31', '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(49, 50, '2024-10-01', NULL, 'Active', 4208879.00, 'player', '31', '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(50, 47, '2024-10-01', NULL, 'Active', 11700000.00, 'player', '31', '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(51, 45, '2024-10-01', NULL, 'Active', 35640000.00, 'player', '31', '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(52, 43, '2024-10-01', NULL, 'Active', 49224000.00, 'player', '31', '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(53, 51, '2024-10-01', NULL, 'Active', 5600000.00, 'player', '31', '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(54, 49, '2024-10-01', NULL, 'Active', 19000000.00, 'player', '31', '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(55, 44, '2024-10-01', NULL, 'Active', 45640084.00, 'player', '31', '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(56, 46, '2024-10-01', NULL, 'Active', 3833333.00, 'player', '31', '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(57, 48, '2024-10-01', NULL, 'Active', 11235955.00, 'player', '31', '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(63, 53, '2024-10-01', NULL, 'Active', 5000000.00, 'coach', '32', '2025-11-29 22:12:40', '2025-11-29 22:12:40'),
(64, 54, '2024-10-01', NULL, 'Active', 1500000.00, 'coach', '32', '2025-11-29 22:12:40', '2025-11-29 22:12:40'),
(65, 55, '2024-10-01', NULL, 'Active', 7000000.00, 'coach', '31', '2025-11-29 22:12:40', '2025-11-29 22:12:40'),
(66, 56, '2024-10-01', NULL, 'Active', 1200000.00, 'coach', '31', '2025-11-29 22:12:40', '2025-11-29 22:12:40'),
(67, 60, '2024-10-01', NULL, 'Active', 475000.00, 'referee', 'admin', '2025-11-29 22:23:13', '2025-11-29 22:23:13'),
(68, 59, '2024-10-01', NULL, 'Active', 550000.00, 'referee', 'admin', '2025-11-29 22:23:13', '2025-11-29 22:23:13'),
(69, 61, '2024-10-01', NULL, 'Active', 450000.00, 'referee', 'admin', '2025-11-29 22:23:13', '2025-11-29 22:23:13'),
(70, 57, '2024-10-01', NULL, 'Active', 500000.00, 'referee', 'admin', '2025-11-29 22:23:13', '2025-11-29 22:23:13'),
(71, 62, '2024-10-01', NULL, 'Active', 425000.00, 'referee', 'admin', '2025-11-29 22:23:13', '2025-11-29 22:23:13'),
(72, 58, '2024-10-01', NULL, 'Active', 500000.00, 'referee', 'admin', '2025-11-29 22:23:13', '2025-11-29 22:23:13');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team1_id` bigint(20) UNSIGNED NOT NULL,
  `team2_id` bigint(20) UNSIGNED NOT NULL,
  `points1` int(11) NOT NULL DEFAULT 0,
  `points2` int(11) NOT NULL DEFAULT 0,
  `referee_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `referee_rating` tinyint(4) DEFAULT NULL,
  `game_status` enum('scheduled','completed','cancelled') NOT NULL DEFAULT 'scheduled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `team1_id`, `team2_id`, `points1`, `points2`, `referee_id`, `date`, `referee_rating`, `game_status`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 18, 0, 26, '2025-11-20', 4, 'completed', '2025-11-20 03:00:24', '2025-11-20 03:00:24'),
(2, 2, 3, 46, 109, 27, '2025-11-30', 2, 'completed', '2025-11-29 20:50:24', '2025-11-29 20:50:24'),
(3, 32, 31, 123, 116, 26, '2025-11-29', 5, 'completed', '2025-11-29 21:15:11', '2025-11-29 21:15:11');

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
(1, '2025_11_18_023108_create_users_table', 1),
(2, '2025_11_18_023109_create_coach_stats_table', 1),
(3, '2025_11_18_023109_create_contracts_table', 1),
(4, '2025_11_18_023109_create_player_stats_table', 1),
(5, '2025_11_18_023110_create_referee_stats_table', 1),
(6, '2025_11_18_023110_create_team_stats_table', 1),
(7, '2025_11_18_023114_create_games_table', 1),
(8, '2025_11_20_035813_create_sessions_table', 2),
(9, '2025_11_25_043410_create_cache_table', 3),
(10, '2025_11_27_023413_expand_contract_status_enum', 4),
(11, '2025_11_29_055507_add_image_to_users_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `player_stats`
--

CREATE TABLE `player_stats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `rebounds` int(11) NOT NULL DEFAULT 0,
  `assists` int(11) NOT NULL DEFAULT 0,
  `games_played` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `player_stats`
--

INSERT INTO `player_stats` (`id`, `user_id`, `points`, `rebounds`, `assists`, `games_played`, `created_at`, `updated_at`) VALUES
(1, 6, 32, 16, 15, 2, '2025-11-18 01:46:48', '2025-11-29 20:50:24'),
(2, 7, 11, 8, 7, 2, '2025-11-18 01:46:48', '2025-11-29 20:50:24'),
(3, 8, 13, 0, 8, 2, '2025-11-18 01:46:48', '2025-11-29 20:50:24'),
(4, 9, 0, 0, 0, 2, '2025-11-18 01:46:49', '2025-11-29 20:50:24'),
(5, 10, 0, 0, 0, 2, '2025-11-18 01:46:49', '2025-11-29 20:50:24'),
(6, 11, 0, 0, 6, 2, '2025-11-18 01:46:49', '2025-11-29 20:50:24'),
(7, 12, 0, 7, 0, 2, '2025-11-18 01:46:49', '2025-11-29 20:50:24'),
(8, 13, 8, 0, 0, 2, '2025-11-18 01:46:49', '2025-11-29 20:50:24'),
(9, 14, 0, 0, 0, 1, '2025-11-18 01:46:50', '2025-11-20 03:00:24'),
(10, 15, 0, 0, 0, 0, '2025-11-18 01:46:50', '2025-11-18 01:46:50'),
(11, 16, 19, 0, 13, 2, '2025-11-18 01:46:50', '2025-11-29 20:50:24'),
(12, 17, 13, 0, 5, 2, '2025-11-18 01:46:50', '2025-11-29 20:50:24'),
(13, 18, 14, 4, 4, 2, '2025-11-18 01:46:51', '2025-11-29 20:50:24'),
(14, 19, 14, 3, 5, 2, '2025-11-18 01:46:51', '2025-11-29 20:50:24'),
(15, 20, 13, 2, 4, 2, '2025-11-18 01:46:51', '2025-11-29 20:50:24'),
(16, 21, 14, 6, 0, 2, '2025-11-18 01:46:51', '2025-11-29 20:50:24'),
(17, 22, 14, 8, 4, 2, '2025-11-18 01:46:51', '2025-11-29 20:50:24'),
(18, 23, 8, 7, 0, 2, '2025-11-18 01:46:52', '2025-11-29 20:50:24'),
(19, 24, 0, 0, 0, 1, '2025-11-18 01:46:52', '2025-11-20 03:00:24'),
(20, 25, 0, 0, 0, 1, '2025-11-18 01:46:52', '2025-11-20 03:00:24'),
(21, 28, 0, 0, 0, 0, '2025-11-26 00:59:34', '2025-11-26 00:59:34'),
(22, 29, 0, 0, 0, 0, '2025-11-26 02:59:32', '2025-11-26 02:59:32'),
(23, 36, 6, 8, 1, 1, '2025-11-29 22:09:34', '2025-11-29 21:15:11'),
(24, 38, 7, 6, 2, 1, '2025-11-29 22:09:34', '2025-11-29 21:15:11'),
(25, 40, 6, 7, 2, 1, '2025-11-29 22:09:34', '2025-11-29 21:15:11'),
(26, 34, 26, 5, 1, 1, '2025-11-29 22:09:34', '2025-11-29 21:15:11'),
(27, 42, 11, 1, 8, 1, '2025-11-29 22:09:34', '2025-11-29 21:15:11'),
(28, 37, 16, 4, 6, 1, '2025-11-29 22:09:34', '2025-11-29 21:15:11'),
(29, 35, 22, 9, 1, 1, '2025-11-29 22:09:34', '2025-11-29 21:15:11'),
(30, 33, 29, 10, 12, 1, '2025-11-29 22:09:34', '2025-11-29 21:15:11'),
(31, 41, 0, 0, 0, 0, '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(32, 39, 0, 0, 0, 0, '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(38, 52, 0, 0, 0, 0, '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(39, 50, 0, 0, 0, 0, '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(40, 47, 22, 12, 5, 1, '2025-11-29 22:09:34', '2025-11-29 21:15:11'),
(41, 45, 28, 4, 9, 1, '2025-11-29 22:09:34', '2025-11-29 21:15:11'),
(42, 43, 24, 8, 5, 1, '2025-11-29 22:09:34', '2025-11-29 21:15:11'),
(43, 51, 6, 0, 0, 1, '2025-11-29 22:09:34', '2025-11-29 21:15:11'),
(44, 49, 10, 0, 0, 1, '2025-11-29 22:09:34', '2025-11-29 21:15:11'),
(45, 44, 11, 0, 0, 1, '2025-11-29 22:09:34', '2025-11-29 21:15:11'),
(46, 46, 10, 11, 10, 1, '2025-11-29 22:09:34', '2025-11-29 21:15:11'),
(47, 48, 5, 8, 5, 1, '2025-11-29 22:09:34', '2025-11-29 21:15:11');

-- --------------------------------------------------------

--
-- Table structure for table `referee_stats`
--

CREATE TABLE `referee_stats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `games_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referee_stats`
--

INSERT INTO `referee_stats` (`id`, `user_id`, `points`, `games_count`, `created_at`, `updated_at`) VALUES
(1, 26, 9, 2, '2025-11-18 01:46:52', '2025-11-29 21:15:11'),
(2, 27, 2, 1, '2025-11-18 01:46:52', '2025-11-29 20:50:24'),
(3, 30, 0, 0, '2025-11-27 01:54:25', '2025-11-27 01:54:25'),
(4, 60, 0, 0, '2025-11-29 22:23:13', '2025-11-29 22:23:13'),
(5, 59, 0, 0, '2025-11-29 22:23:13', '2025-11-29 22:23:13'),
(6, 61, 0, 0, '2025-11-29 22:23:13', '2025-11-29 22:23:13'),
(7, 57, 0, 0, '2025-11-29 22:23:13', '2025-11-29 22:23:13'),
(8, 62, 0, 0, '2025-11-29 22:23:13', '2025-11-29 22:23:13'),
(9, 58, 0, 0, '2025-11-29 22:23:13', '2025-11-29 22:23:13');

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
('cxLLRks708eY7yPD2pNm2VYVCiGOcwUqtewg1tYW', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ3o1RjdtdXN5SFpZcE1kMHQ4Rnd5WjVYTXRRNTVWNGxEZ1c3eUdYNSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9jb250cmFjdHMvbXktb2ZmZXJzIjtzOjU6InJvdXRlIjtzOjE5OiJjb250cmFjdHMubXktb2ZmZXJzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1764454627),
('g8QUrcKZl5i92FVYcumr9QqTz5PJGwAVPxcrUYFq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ1ZxWGpyS1E1QmRYdWxEeERJWmRKNEFWbTZWdzZrVkc4V0ZKS01tNyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNDoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL3Byb2ZpbGUvZWRpdCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM0OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvcHJvZmlsZS9lZGl0IjtzOjU6InJvdXRlIjtzOjEyOiJwcm9maWxlLmVkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1764449953);

-- --------------------------------------------------------

--
-- Table structure for table `team_stats`
--

CREATE TABLE `team_stats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `games_played` int(11) NOT NULL DEFAULT 0,
  `wins` int(11) NOT NULL DEFAULT 0,
  `losses` int(11) NOT NULL DEFAULT 0,
  `points_scored` int(11) NOT NULL DEFAULT 0,
  `points_conceded` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_stats`
--

INSERT INTO `team_stats` (`id`, `team_id`, `games_played`, `wins`, `losses`, `points_scored`, `points_conceded`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 1, 1, 64, 109, '2025-11-18 01:46:47', '2025-11-29 20:50:24'),
(2, 3, 2, 1, 1, 109, 64, '2025-11-18 01:46:47', '2025-11-29 20:50:24'),
(3, 31, 1, 0, 1, 116, 123, '2025-11-29 21:04:23', '2025-11-29 21:15:11'),
(4, 32, 1, 1, 0, 123, 116, '2025-11-29 21:05:15', '2025-11-29 21:15:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `type` enum('team','admin','person') NOT NULL DEFAULT 'person',
  `image` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `date_of_birth`, `type`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'User', 'admin@nba.com', '$2y$12$jHRZXRm.dLJCfNc9FP9BY.d78msN.iebl4fokgEU0A7GHJD1A3euW', NULL, 'admin', 'avatars/kvd9Pr73ERwegw8qeb3XgYsNru30vF6vcvXn2t5y.jpg', NULL, '2025-11-18 01:46:47', '2025-11-29 05:37:19'),
(2, 'Los Angeles', 'Lakers', 'lakers@nba.com', '$2y$12$lcYhK/Xeakx93MD3HUyKeeGwHmqUtMA2pDLhWVkRkmtFBc74vgC.u', '1947-01-01', 'team', 'avatars/cm0xoFKhfHdDPIUhX7uPyfiKhZ6UTHJzjraeADyE.jpg', NULL, '2025-11-18 01:46:47', '2025-11-29 20:47:53'),
(3, 'Boston', 'Celtics', 'celtics@nba.com', '$2y$12$2gfTpdtF/.s06lJaMrVh..PARwhF3Uz0txSnzlUpZbzcJrUDZ81mG', '1946-06-06', 'team', 'avatars/S78dcyJpfMLYGcRwptWeQgZfhMLe6qfPmq8W6Whe.jpg', NULL, '2025-11-18 01:46:47', '2025-11-29 20:48:25'),
(4, 'Phil', 'Jackson', 'pjackson@nba.com', '$2y$12$2UK7qiDxRj3Yceuxo2t0s.GnC8u2W0GeAXYlJFyBPveNP8.CSW03a', '1945-09-17', 'person', NULL, NULL, '2025-11-18 01:46:48', '2025-11-18 01:46:48'),
(5, 'Gregg', 'Popovich', 'popovich@nba.com', '$2y$12$br/.VymtiSW406r7Ehk60OlEOa0xf3D389kURYOH50HpfHawyicy2', '1949-01-28', 'person', NULL, NULL, '2025-11-18 01:46:48', '2025-11-18 01:46:48'),
(6, 'LeBron', 'James', 'lebron@nba.com', '$2y$12$mwZhMhnfaNYORioBnyfU7eZ9QukpYs61DUDPfI0f0LEOKOipkCID.', '1984-12-30', 'person', NULL, NULL, '2025-11-18 01:46:48', '2025-11-18 01:46:48'),
(7, 'Anthony', 'Davis', 'adavis@nba.com', '$2y$12$7UavidRm6q.CsYpBbCXrjev5eCjf8so00bfnzKt.dC5VPnQLafxWy', '1993-03-11', 'person', NULL, NULL, '2025-11-18 01:46:48', '2025-11-18 01:46:48'),
(8, 'Austin', 'Reaves', 'areaves@nba.com', '$2y$12$M2A42qeWZlgkcfR554lpLe56WhP/YgRTBPoQPTxslzBtOGUB2S/.a', '1998-05-29', 'person', NULL, NULL, '2025-11-18 01:46:48', '2025-11-18 01:46:48'),
(9, 'Rui', 'Hachimura', 'rhachimura@nba.com', '$2y$12$DAWLsmYUjACqEff4cOlEqe80.AL/pHg7Zu8uU2g6AEnVk8ZSVaDUW', '1998-02-08', 'person', NULL, NULL, '2025-11-18 01:46:49', '2025-11-18 01:46:49'),
(10, 'DAngelo', 'Russell', 'drussell@nba.com', '$2y$12$sr6/jM3.HqtCNuHK1akt.uWdNyRyqsssuN8J6miROUhCQRQWNqDDa', '1996-02-23', 'person', NULL, NULL, '2025-11-18 01:46:49', '2025-11-18 01:46:49'),
(11, 'Jarred', 'Vanderbilt', 'jvanderbilt@nba.com', '$2y$12$zGcRQQHSGlS9i82B89ZJiuqxj1wlcYjQDXG9XE7yd.GdUc7SJwFf6', '1999-04-03', 'person', NULL, NULL, '2025-11-18 01:46:49', '2025-11-18 01:46:49'),
(12, 'Jaxson', 'Hayes', 'jhayes@nba.com', '$2y$12$MTSbZNEYp6alz5NLoS0FZuDhaw3dmkazZW9rh/3hY2srZCIEuneii', '2000-05-23', 'person', NULL, NULL, '2025-11-18 01:46:49', '2025-11-18 01:46:49'),
(13, 'Taurean', 'Prince', 'tprince@nba.com', '$2y$12$DflLJMUrWzaQ7yYKR.ikj.mFCOvMlFBxHlmyNqUa5I384HRX8FF9e', '1994-03-22', 'person', NULL, NULL, '2025-11-18 01:46:49', '2025-11-18 01:46:49'),
(14, 'Gabe', 'Vincent', 'gvincent@nba.com', '$2y$12$e3p3o7C8IMuoxmfG3oHPVusPBwULv0wdZOsuu6I4dBfJlJtmvMkY6', '1996-06-14', 'person', NULL, NULL, '2025-11-18 01:46:50', '2025-11-18 01:46:50'),
(15, 'Christian', 'Wood', 'cwood@nba.com', '$2y$12$UJAfoCZvSUyFlUNlm0QY2eJZLXbl4.ypLKhZiZLwbkAaQj/v35oNu', '1995-09-27', 'person', NULL, NULL, '2025-11-18 01:46:50', '2025-11-18 01:46:50'),
(16, 'Jayson', 'Tatum', 'jtatum@nba.com', '$2y$12$kh05tPgmFp8NyjVh6sc0huG6mMVF6vKaPXajriqlx0twWiEvtQHVi', '1998-03-03', 'person', NULL, NULL, '2025-11-18 01:46:50', '2025-11-18 01:46:50'),
(17, 'Jaylen', 'Brown', 'jbrown@nba.com', '$2y$12$FPidl3YpmdUwZ7izgbk6VurNeLXhZ/LNKVaJHouhIiFkWhlf7qniG', '1996-10-24', 'person', NULL, NULL, '2025-11-18 01:46:50', '2025-11-18 01:46:50'),
(18, 'Kristaps', 'Porzingis', 'kporzingis@nba.com', '$2y$12$yWcfQpOIN8nOj0nU1j37auEhdQpx0DaliXhItGXGx2EnIuvGx7eFi', '1995-08-02', 'person', NULL, NULL, '2025-11-18 01:46:51', '2025-11-18 01:46:51'),
(19, 'Derrick', 'White', 'dwhite@nba.com', '$2y$12$io0Sso0EAWjFZHeL0en69eTXvO.H1RnwjKZo9BhQQjxTgcoJeTFGK', '1994-07-02', 'person', NULL, NULL, '2025-11-18 01:46:51', '2025-11-18 01:46:51'),
(20, 'Jrue', 'Holiday', 'jholiday@nba.com', '$2y$12$vJRGXt.VNdLrfx5B3jCKzu5bqaITF50tj7DeCDgq4vWMb3i8mCSfe', '1990-06-12', 'person', NULL, NULL, '2025-11-18 01:46:51', '2025-11-18 01:46:51'),
(21, 'Al', 'Horford', 'ahorford@nba.com', '$2y$12$w7VOfHOn.kyhJwqs7b8P8ufMBQiDUzBHIMfkIW1xSJXXjE01k0uO2', '1986-06-03', 'person', NULL, NULL, '2025-11-18 01:46:51', '2025-11-18 01:46:51'),
(22, 'Sam', 'Hauser', 'shauser@nba.com', '$2y$12$90FSZ67uL1nQUEjNSE4y3ewbwQpBF9H4imTv0KN8eCqjbPYKKkJWa', '1997-12-08', 'person', NULL, NULL, '2025-11-18 01:46:51', '2025-11-18 01:46:51'),
(23, 'Payton', 'Pritchard', 'ppritchard@nba.com', '$2y$12$SIa0gqzwpgf8jeyEwt4Bu.vLHi.yBeFlD22ftxs9San0GcG06fru2', '1998-01-28', 'person', NULL, NULL, '2025-11-18 01:46:52', '2025-11-18 01:46:52'),
(24, 'Luke', 'Kornet', 'lkornet@nba.com', '$2y$12$RNPCoKfZG9ha7S/83WOmQOBJHfloebjMLHpaXQHSTPw0ixoQnKhPO', '1995-07-15', 'person', NULL, NULL, '2025-11-18 01:46:52', '2025-11-18 01:46:52'),
(25, 'Oshae', 'Brissett', 'obrissett@nba.com', '$2y$12$NU6cLGowe2hSqsyiZLP6g.PnSDeZxEB9YCzbBgjc71Cvauk0PivJe', '1998-06-20', 'person', NULL, NULL, '2025-11-18 01:46:52', '2025-11-18 01:46:52'),
(26, 'Scott', 'Foster', 'sfoster@nba.com', '$2y$12$f1OsM.M91AzBCrS8BrmC8OHbxQUxV0AiCeocptQ.pEYIyrh45PEzq', '1970-01-01', 'person', NULL, NULL, '2025-11-18 01:46:52', '2025-11-18 01:46:52'),
(27, 'Tony', 'Brothers', 'tbrothers@nba.com', '$2y$12$1gRCTRZzI0Bf4he9gFC64.g6AhgTm3krERN6uFOF7JkTaMX74XG.m', '1968-01-01', 'person', NULL, NULL, '2025-11-18 01:46:52', '2025-11-18 01:46:52'),
(28, 'Test', 'Testic', 'test@test.com', '$2y$12$NgGS8oaNiZyC3C6SAssU..jxTdVEZOHT8nM9aHhATpnYZlF5PYgd.', NULL, 'person', NULL, NULL, '2025-11-25 03:28:40', '2025-11-25 03:28:40'),
(29, 'tester', 'testic', 'test2@test.com', '$2y$12$e.cp6sgdn.qXqdkYJ7qpLu5iXpBV7puNaxQB9v0Kial5qW8WSHGMq', '2017-11-17', 'person', NULL, NULL, '2025-11-25 03:32:14', '2025-11-25 03:32:14'),
(30, 'Test', 'Test4', 'test4@test.com', '$2y$12$T3c8E19AA.ZJJY5RKFwhwO7IY9htvLVAtdKXwpfeX4WIXuQD8E4Qi', '2025-10-28', 'person', NULL, NULL, '2025-11-27 01:45:35', '2025-11-27 01:45:35'),
(31, 'Los Angeles', 'Clippers', 'clippers@nba.com', '$2y$12$LARhEU9ullnai4M4i/JvYuKG1ES0/zMpJL63yoOLVTjwCEjn2nTdK', '1970-01-30', 'team', 'avatars/yMfgzzI7G7e05PD7pvWZIbBqQ04GjrvGOebjmThf.png', NULL, '2025-11-29 21:04:23', '2025-11-29 21:04:23'),
(32, 'Denver', 'Nuggets', 'nuggets@nba.com', '$2y$12$3yxy1hNEy77z.YU923Tz8uy1Yw4TgBwNDWwrubxmR/CDiwrUwMIN2', '1967-06-15', 'team', 'avatars/09t4mZbBv9Tfn8glFJr92y8Zz6mNZFpjeXix1iDX.jpg', NULL, '2025-11-29 21:05:15', '2025-11-29 21:05:15'),
(33, 'Nikola', 'Jokic', 'nikola.jokic@nuggets.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1995-02-19', 'person', NULL, NULL, '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(34, 'Jamal', 'Murray', 'jamal.murray@nuggets.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1997-02-23', 'person', NULL, NULL, '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(35, 'Michael', 'Porter Jr', 'mpj@nuggets.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1998-06-29', 'person', NULL, NULL, '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(36, 'Aaron', 'Gordon', 'aaron.gordon@nuggets.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1995-09-16', 'person', NULL, NULL, '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(37, 'Kentavious', 'Caldwell-Pope', 'kcp@nuggets.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1993-02-18', 'person', NULL, NULL, '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(38, 'Christian', 'Braun', 'christian.braun@nuggets.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2001-04-17', 'person', NULL, NULL, '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(39, 'Reggie', 'Jackson', 'reggie.jackson@nuggets.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1990-04-16', 'person', NULL, NULL, '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(40, 'DeAndre', 'Jordan', 'deandre.jordan@nuggets.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1988-07-21', 'person', NULL, NULL, '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(41, 'Peyton', 'Watson', 'peyton.watson@nuggets.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2002-09-11', 'person', NULL, NULL, '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(42, 'Julian', 'Strawther', 'julian.strawther@nuggets.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2002-04-18', 'person', NULL, NULL, '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(43, 'Kawhi', 'Leonard', 'kawhi.leonard@clippers.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1991-06-29', 'person', NULL, NULL, '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(44, 'Paul', 'George', 'paul.george@clippers.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1990-05-02', 'person', NULL, NULL, '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(45, 'James', 'Harden', 'james.harden@clippers.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1989-08-26', 'person', NULL, NULL, '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(46, 'Russell', 'Westbrook', 'russell.westbrook@clippers.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1988-11-12', 'person', NULL, NULL, '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(47, 'Ivica', 'Zubac', 'ivica.zubac@clippers.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1997-03-18', 'person', NULL, NULL, '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(48, 'Terance', 'Mann', 'terance.mann@clippers.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1996-10-18', 'person', NULL, NULL, '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(49, 'Norman', 'Powell', 'norman.powell@clippers.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1993-05-25', 'person', NULL, NULL, '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(50, 'Bones', 'Hyland', 'bones.hyland@clippers.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2000-09-14', 'person', NULL, NULL, '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(51, 'Mason', 'Plumlee', 'mason.plumlee@clippers.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1990-03-05', 'person', NULL, NULL, '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(52, 'Amir', 'Coffey', 'amir.coffey@clippers.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1997-06-17', 'person', NULL, NULL, '2025-11-29 22:09:34', '2025-11-29 22:09:34'),
(53, 'Michael', 'Malone', 'michael.malone@nuggets.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1971-09-15', 'person', NULL, NULL, '2025-11-29 22:12:40', '2025-11-29 22:12:40'),
(54, 'David', 'Adelman', 'david.adelman@nuggets.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1979-11-10', 'person', NULL, NULL, '2025-11-29 22:12:40', '2025-11-29 22:12:40'),
(55, 'Tyronn', 'Lue', 'tyronn.lue@clippers.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1977-05-03', 'person', NULL, NULL, '2025-11-29 22:12:40', '2025-11-29 22:12:40'),
(56, 'Dan', 'Craig', 'dan.craig@clippers.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1978-08-22', 'person', NULL, NULL, '2025-11-29 22:12:40', '2025-11-29 22:12:40'),
(57, 'Marc', 'Davis', 'marc.davis@nba.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1973-02-14', 'person', NULL, NULL, '2025-11-29 22:23:13', '2025-11-29 22:23:13'),
(58, 'Zach', 'Zarba', 'zach.zarba@nba.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1975-06-05', 'person', NULL, NULL, '2025-11-29 22:23:13', '2025-11-29 22:23:13'),
(59, 'James', 'Capers', 'james.capers@nba.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1966-03-31', 'person', NULL, NULL, '2025-11-29 22:23:13', '2025-11-29 22:23:13'),
(60, 'Ed', 'Malloy', 'ed.malloy@nba.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1971-09-18', 'person', NULL, NULL, '2025-11-29 22:23:13', '2025-11-29 22:23:13'),
(61, 'John', 'Goble', 'john.goble@nba.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1969-07-24', 'person', NULL, NULL, '2025-11-29 22:23:13', '2025-11-29 22:23:13'),
(62, 'Pat', 'Fraher', 'pat.fraher@nba.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1974-04-12', 'person', NULL, NULL, '2025-11-29 22:23:13', '2025-11-29 22:23:13');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `coach_stats`
--
ALTER TABLE `coach_stats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coach_stats_user_id_unique` (`user_id`),
  ADD KEY `coach_stats_wins_index` (`wins`);

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contracts_user_id_index` (`user_id`),
  ADD KEY `contracts_status_index` (`status`),
  ADD KEY `contracts_role_index` (`role`),
  ADD KEY `contracts_employer_id_index` (`employer_id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `games_date_index` (`date`),
  ADD KEY `games_team1_id_index` (`team1_id`),
  ADD KEY `games_team2_id_index` (`team2_id`),
  ADD KEY `games_referee_id_index` (`referee_id`),
  ADD KEY `games_game_status_index` (`game_status`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `player_stats`
--
ALTER TABLE `player_stats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `player_stats_user_id_unique` (`user_id`),
  ADD KEY `player_stats_points_index` (`points`),
  ADD KEY `player_stats_games_played_index` (`games_played`);

--
-- Indexes for table `referee_stats`
--
ALTER TABLE `referee_stats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `referee_stats_user_id_unique` (`user_id`),
  ADD KEY `referee_stats_games_count_index` (`games_count`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `team_stats`
--
ALTER TABLE `team_stats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_stats_team_id_unique` (`team_id`),
  ADD KEY `team_stats_wins_index` (`wins`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_type_index` (`type`),
  ADD KEY `users_last_name_first_name_index` (`last_name`,`first_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coach_stats`
--
ALTER TABLE `coach_stats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `player_stats`
--
ALTER TABLE `player_stats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `referee_stats`
--
ALTER TABLE `referee_stats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `team_stats`
--
ALTER TABLE `team_stats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coach_stats`
--
ALTER TABLE `coach_stats`
  ADD CONSTRAINT `coach_stats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contracts`
--
ALTER TABLE `contracts`
  ADD CONSTRAINT `contracts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_referee_id_foreign` FOREIGN KEY (`referee_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `games_team1_id_foreign` FOREIGN KEY (`team1_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `games_team2_id_foreign` FOREIGN KEY (`team2_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `player_stats`
--
ALTER TABLE `player_stats`
  ADD CONSTRAINT `player_stats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `referee_stats`
--
ALTER TABLE `referee_stats`
  ADD CONSTRAINT `referee_stats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `team_stats`
--
ALTER TABLE `team_stats`
  ADD CONSTRAINT `team_stats_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

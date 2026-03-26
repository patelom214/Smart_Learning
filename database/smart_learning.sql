-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 12, 2026 at 11:26 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_learning`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Hello', '2026-02-09 23:21:48', '2026-02-09 23:21:48'),
(2, 1, 5, 'hi Python', '2026-02-09 23:33:25', '2026-02-09 23:33:25'),
(3, 4, 7, 'hi Python Learner', '2026-02-12 04:08:48', '2026-02-12 04:08:48');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` bigint UNSIGNED NOT NULL,
  `follower_id` bigint UNSIGNED NOT NULL,
  `following_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `follower_id`, `following_id`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '2026-02-12 04:14:16', '2026-02-12 04:14:16'),
(9, 1, 5, '2026-02-12 04:59:36', '2026-02-12 04:59:36'),
(10, 4, 1, '2026-02-12 05:11:08', '2026-02-12 05:11:08'),
(12, 5, 1, '2026-02-12 05:13:09', '2026-02-12 05:13:09'),
(13, 5, 4, '2026-02-12 05:13:11', '2026-02-12 05:13:11');

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `sender_id` bigint UNSIGNED NOT NULL,
  `receiver_id` bigint UNSIGNED NOT NULL,
  `status` enum('pending','accepted') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `friend_requests`
--

INSERT INTO `friend_requests` (`id`, `sender_id`, `receiver_id`, `status`, `created_at`, `updated_at`) VALUES
(8, 4, 5, 'accepted', '2026-02-12 05:11:25', '2026-02-12 05:13:11'),
(11, 1, 4, 'accepted', '2026-02-12 05:38:00', '2026-02-12 05:38:46'),
(12, 1, 5, 'accepted', '2026-02-12 05:38:19', '2026-02-12 05:39:45');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(14, 1, 4, '2026-02-10 00:10:48', '2026-02-10 00:10:48'),
(16, 1, 1, '2026-02-10 00:12:52', '2026-02-10 00:12:52'),
(18, 1, 5, '2026-02-10 00:13:06', '2026-02-10 00:13:06'),
(19, 1, 3, '2026-02-10 01:00:33', '2026-02-10 01:00:33'),
(20, 4, 7, '2026-02-12 04:08:36', '2026-02-12 04:08:36'),
(21, 1, 8, '2026-02-12 04:14:37', '2026-02-12 04:14:37'),
(22, 1, 7, '2026-02-12 04:14:40', '2026-02-12 04:14:40'),
(23, 5, 8, '2026-02-12 05:13:03', '2026-02-12 05:13:03');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_19_071004_add_provider_to_users_table', 1),
(5, '2026_01_19_095306_add_google_id_to_users_table', 1),
(6, '2026_01_21_084632_create_password_resets_table', 1),
(7, '2026_01_21_101405_add_missing_fields_to_users_table', 2),
(8, '2026_01_22_091429_add_profile_photo_to_users_table', 3),
(9, '2026_01_22_105755_create_posts_table', 4),
(10, '2026_02_09_044613_create_followers_table', 5),
(11, '2026_02_09_044743_create_likes_table', 6),
(12, '2026_02_09_044844_create_comments_table', 7),
(13, '2026_02_09_112155_create_shares_table', 8),
(14, '2026_02_10_092005_create_friend_requests_table', 9),
(15, '2026_02_11_090058_create_skills_table', 9),
(16, '2026_02_11_090101_create_roadmaps_table', 9),
(17, '2026_02_11_090102_create_roadmap_tasks_table', 9),
(18, '2026_02_11_090103_create_user_skills_table', 9);

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
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `media` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `content`, `media`, `created_at`, `updated_at`) VALUES
(1, 1, 'Working on my Laravel project today 🚀\r\n\r\nI successfully created a dynamic post system where users can:\r\n✔ Create posts\r\n✔ Upload images\r\n✔ View feed like LinkedIn\r\n\r\nStill learning, but enjoying the journey 😊\r\n\r\n#Laravel #PHP #WebDeveloper #LearningInPublic', 'posts/pbvPerPpeQeCOGJaQxREN3eOPQR7LuKyLJokB513.png', '2026-02-09 01:10:53', '2026-02-09 01:10:53'),
(3, 1, '🚀 \r\nSmart Learning with Laravel\r\nLaravel makes web development faster, cleaner, and smarter Elegant routing for RESTful APIs lade templates for reusable views Eloquent ORM for smooth database handling Artisan CLI to automate tasks', 'posts/yU2BLmEZHqsqOW9LUR3AYEF2C2DYVfH4Ax3SXzv6.png', '2026-02-09 04:47:35', '2026-02-09 04:47:35'),
(4, 1, '<strong></strong><p><strong>Learning Laravel the Smart Way</strong><br>\r\nWhy struggle with boilerplate code when Laravel gives you:<br>\r\n✔️ Built-in validation<br>\r\n✔️ Database ORM<br>\r\n✔️ Blade templating<br>\r\n✔️ Artisan automation</p>\r\n<p>Every project is a chance to learn smarter, not harder. 🚀</p>\r\n<p>#Laravel #SmartLearning #DevLife</p>\r\n<p></p>\r\n<p><br></p>', 'posts/MzuQ6sspRGTBRsXP6WWg9d0Ymg9c0UldKZNbOQ04.png', '2026-02-09 04:57:05', '2026-02-09 04:57:05'),
(5, 1, '<em></em><p><em>Why Python is Perfect for Beginners</em></p>\r\n<p><strong>Body:</strong><br>\r\nPython is one of the most beginner‑friendly programming languages. Its simple syntax makes it easy to read and write, while still being powerful enough to build web apps, data science projects, and even AI models.</p>\r\n<p>✨ Key reasons to start with Python:</p>\r\n<ul><li>Clean and readable syntax (like writing English).</li>\r\n<li>Huge community support and libraries.</li>\r\n<li>Versatile: from web development to machine learning.</li>\r\n</ul>', 'posts/Zyx72SjNDZcavrkbhiy037uiBNY85qfrUVgj89ni.png', '2026-02-09 06:00:53', '2026-02-09 06:00:53'),
(7, 4, '<p style=\"border: 0px; border-collapse: collapse; border-spacing: 0px; list-style-position: initial; list-style-image: initial; list-style-type: revert; margin: 4px; padding: revert; -webkit-line-clamp: revert; line-height: inherit; color: rgba(0, 0, 0, 0.8); font-family: Roboto, Helvetica, sans-serif; font-size: 16px;\">Python is a&nbsp;<span style=\"font-weight: 700;\">high-level, interpreted, general-purpose programming language</span>&nbsp;known for its&nbsp;<span style=\"font-weight: 700;\">simple, readable syntax</span>. It is widely used in&nbsp;<span style=\"font-weight: 700;\">web development, data analysis, artificial intelligence, automation, scientific computing, and more</span>.</p><h2 style=\"border: 0px; border-collapse: collapse; border-spacing: 0px; list-style-position: initial; list-style-image: initial; list-style-type: revert; margin: revert; padding: revert; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-language-override: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 22px; line-height: 24px; font-family: Roboto, Helvetica, sans-serif; height: 32px; -webkit-line-clamp: 1; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-box-orient: vertical; color: rgba(0, 0, 0, 0.8);\"><span style=\"font-weight: 700;\">Key Features</span></h2><ul style=\"border: 0px; border-collapse: collapse; border-spacing: 0px; list-style-position: initial; list-style-image: initial; list-style-type: revert; margin: revert; padding: revert; color: rgba(0, 0, 0, 0.8); font-family: Roboto, Helvetica, sans-serif; font-size: 16px;\"><li style=\"border: 0px; border-collapse: collapse; border-spacing: 0px; list-style-position: initial; list-style-image: initial; list-style-type: revert; margin-top: revert; margin-right: revert; margin-bottom: 8px; margin-left: revert; padding: revert;\"><span style=\"font-weight: 700;\">Easy to Learn &amp; Readable</span>&nbsp;– Syntax is close to plain English.</li><li style=\"border: 0px; border-collapse: collapse; border-spacing: 0px; list-style-position: initial; list-style-image: initial; list-style-type: revert; margin-top: revert; margin-right: revert; margin-bottom: 8px; margin-left: revert; padding: revert;\"><span style=\"font-weight: 700;\">Interpreted</span>&nbsp;– No need to compile; runs directly from source code.</li><li style=\"border: 0px; border-collapse: collapse; border-spacing: 0px; list-style-position: initial; list-style-image: initial; list-style-type: revert; margin-top: revert; margin-right: revert; margin-bottom: 8px; margin-left: revert; padding: revert;\"><span style=\"font-weight: 700;\">Cross-Platform</span>&nbsp;– Works on Windows, macOS, Linux, and more.</li><li style=\"border: 0px; border-collapse: collapse; border-spacing: 0px; list-style-position: initial; list-style-image: initial; list-style-type: revert; margin-top: revert; margin-right: revert; margin-bottom: 8px; margin-left: revert; padding: revert;\"><span style=\"font-weight: 700;\">Dynamically Typed</span>&nbsp;– No need to declare variable types explicitly.</li><li style=\"border: 0px; border-collapse: collapse; border-spacing: 0px; list-style-position: initial; list-style-image: initial; list-style-type: revert; margin-top: revert; margin-right: revert; margin-bottom: 8px; margin-left: revert; padding: revert;\"><span style=\"font-weight: 700;\">Extensive Libraries</span>&nbsp;– Thousands of built-in and third-party modules.</li><li style=\"border: 0px; border-collapse: collapse; border-spacing: 0px; list-style-position: initial; list-style-image: initial; list-style-type: revert; margin-top: revert; margin-right: revert; margin-bottom: 8px; margin-left: revert; padding: revert;\"><span style=\"font-weight: 700;\">Versatile</span>&nbsp;– Supports multiple programming paradigms&nbsp;</li></ul>', 'posts/GZXqdtrzAjcdznZvYSJZ44bcgf6WYdktDiUwL9oo.png', '2026-02-12 04:08:29', '2026-02-12 04:08:29'),
(8, 5, '<span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, Helvetica, sans-serif; font-size: 14px; background-color: rgb(248, 244, 241);\">&nbsp;is a&nbsp;</span><span style=\"font-weight: 700; color: rgba(0, 0, 0, 0.8); font-family: Roboto, Helvetica, sans-serif; font-size: 14px; background-color: rgb(248, 244, 241);\">general-purpose, structured, and machine-independent</span><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, Helvetica, sans-serif; font-size: 14px; background-color: rgb(248, 244, 241);\">&nbsp;programming language created by&nbsp;</span><span style=\"font-weight: 700; color: rgba(0, 0, 0, 0.8); font-family: Roboto, Helvetica, sans-serif; font-size: 14px; background-color: rgb(248, 244, 241);\">Dennis M. Ritchie</span><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, Helvetica, sans-serif; font-size: 14px; background-color: rgb(248, 244, 241);\">&nbsp;at Bell Labs in&nbsp;</span><span style=\"font-weight: 700; color: rgba(0, 0, 0, 0.8); font-family: Roboto, Helvetica, sans-serif; font-size: 14px; background-color: rgb(248, 244, 241);\">1972</span><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, Helvetica, sans-serif; font-size: 14px; background-color: rgb(248, 244, 241);\">. Initially developed for building the UNIX operating system, it has since become one of the&nbsp;</span><span style=\"font-weight: 700; color: rgba(0, 0, 0, 0.8); font-family: Roboto, Helvetica, sans-serif; font-size: 14px; background-color: rgb(248, 244, 241);\">most widely used languages</span><span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, Helvetica, sans-serif; font-size: 14px; background-color: rgb(248, 244, 241);\">&nbsp;for system software, embedded systems, and performance-critical applications.</span>', 'posts/zyFMWOzhIkFKOyWC7ISLK1nwpmgeIkaFKHLQbOHX.png', '2026-02-12 04:13:36', '2026-02-12 04:13:36');

-- --------------------------------------------------------

--
-- Table structure for table `roadmaps`
--

CREATE TABLE `roadmaps` (
  `id` bigint UNSIGNED NOT NULL,
  `skill_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roadmaps`
--

INSERT INTO `roadmaps` (`id`, `skill_id`, `title`, `created_at`, `updated_at`) VALUES
(1, 1, 'Laravel Beginner to Advanced', '2026-02-12 03:59:22', '2026-02-12 03:59:22');

-- --------------------------------------------------------

--
-- Table structure for table `roadmap_tasks`
--

CREATE TABLE `roadmap_tasks` (
  `id` bigint UNSIGNED NOT NULL,
  `roadmap_id` bigint UNSIGNED NOT NULL,
  `task_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roadmap_tasks`
--

INSERT INTO `roadmap_tasks` (`id`, `roadmap_id`, `task_name`, `is_completed`, `created_at`, `updated_at`) VALUES
(1, 1, 'Learn PHP basics', 0, '2026-02-12 03:59:34', '2026-02-12 03:59:34'),
(2, 1, 'Understand MVC concept', 0, '2026-02-12 03:59:34', '2026-02-12 03:59:34'),
(3, 1, 'Install Laravel', 0, '2026-02-12 03:59:34', '2026-02-12 03:59:34'),
(4, 1, 'Routing and Controllers', 0, '2026-02-12 03:59:34', '2026-02-12 03:59:34'),
(5, 1, 'Blade templates', 0, '2026-02-12 03:59:34', '2026-02-12 03:59:34'),
(6, 1, 'Build CRUD project', 0, '2026-02-12 03:59:34', '2026-02-12 03:59:34'),
(7, 1, 'Authentication system', 0, '2026-02-12 03:59:34', '2026-02-12 03:59:34'),
(8, 1, 'Deploy project', 0, '2026-02-12 03:59:34', '2026-02-12 03:59:34');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('UftHlqXzUDrvuvLx9bXmnuFbP6Hn8mxohMsC2lAS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidDc0Mzl4Y2w0eXpuU2pYdkRibFJlZjRhSTZVWWlOaGVrVzB5blVGQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo3OiJ3ZWxjb21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1770888089),
('utMoW3sL6TlpA4r25qU00yMy1zywcYTxrmm3Coaq', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidExXajJNWjA1U25ZWUtFeTh1akNoN1F4ZGNoQjNxUkVNZ2NSelJFdiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9mZWVkIjtzOjU6InJvdXRlIjtzOjQ6ImZlZWQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O30=', 1770895475);

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

CREATE TABLE `shares` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` bigint UNSIGNED NOT NULL,
  `skill_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `skill_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Laravel', 'PHP web framework', '2026-02-12 03:58:28', '2026-02-12 03:58:28'),
(2, 'React', 'Frontend JavaScript library', '2026-02-12 03:58:28', '2026-02-12 03:58:28'),
(3, 'Data Structures', 'Core programming concepts', '2026-02-12 03:58:28', '2026-02-12 03:58:28'),
(4, 'Python', 'General purpose programming', '2026-02-12 03:58:29', '2026-02-12 03:58:29'),
(5, 'Machine Learning', 'AI and data science', '2026-02-12 03:58:29', '2026-02-12 03:58:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `bio` text COLLATE utf8mb4_unicode_ci,
  `profile_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reputation_points` int NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_refresh_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `google_id`, `email_verified_at`, `password`, `role`, `bio`, `profile_photo`, `reputation_points`, `status`, `provider_id`, `provider_name`, `provider_token`, `provider_refresh_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Om Patel', 'pom323701@gmail.com', NULL, NULL, '$2y$12$i4g910UtJO3AVAa8jCC4WurT8zNoLS5RFLXtN3lGg4gVbvgd5guHy', 'user', 'Hello Laravel Developer', 'profiles/QQKDYd3LdZYhWEKccaoGnYu6w1dhIEHTgavZhdFB.jpg', 0, 'active', NULL, NULL, NULL, NULL, 'i8DT93DWp9LNBTodwAKS4vlU3nul2MHzVTlCDFVDZz872mgeoGRVihw1LE7A', '2026-01-21 04:47:05', '2026-02-08 23:44:06'),
(4, 'MANN PATEL', 'patelmann13301@gmail.com', NULL, NULL, '$2y$12$Hv0ytqeMqntcgzFi83nWheNCOQByTrcUhaJp8xLV3fYcCISk9V7rC', 'user', 'Python Developer', 'profiles/6hR1lhC512jKRW1g8nOiA7VEhYqUDFGBE8de3wT3.jpg', 0, 'active', NULL, NULL, NULL, NULL, NULL, '2026-02-12 04:01:53', '2026-02-12 04:01:53'),
(5, 'Patel Dhruv', 'dhruv23807@gmail.com', NULL, NULL, '$2y$12$7UCUMBpFYCrPATy6T7P4kesto7OAwFbE05gwzbAF7ypOEWoTO8iW2', 'user', 'Mechanical Engineer', 'profiles/JUatSnkha55ghtslHX9qCatwksiNx7huhlRQpc0m.jpg', 0, 'active', NULL, NULL, NULL, NULL, NULL, '2026-02-12 04:12:04', '2026-02-12 04:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_skills`
--

CREATE TABLE `user_skills` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `skill_id` bigint UNSIGNED NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Beginner',
  `progress_percentage` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_skills`
--

INSERT INTO `user_skills` (`id`, `user_id`, `skill_id`, `level`, `progress_percentage`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Beginner', 0, '2026-02-12 03:59:56', '2026-02-12 03:59:56');

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
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_post_id_foreign` (`post_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `followers_follower_id_following_id_unique` (`follower_id`,`following_id`),
  ADD KEY `followers_following_id_foreign` (`following_id`);

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `friend_requests_sender_id_receiver_id_unique` (`sender_id`,`receiver_id`),
  ADD KEY `friend_requests_receiver_id_foreign` (`receiver_id`);

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
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `likes_user_id_post_id_unique` (`user_id`,`post_id`),
  ADD KEY `likes_post_id_foreign` (`post_id`);

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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `roadmaps`
--
ALTER TABLE `roadmaps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roadmaps_skill_id_foreign` (`skill_id`);

--
-- Indexes for table `roadmap_tasks`
--
ALTER TABLE `roadmap_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roadmap_tasks_roadmap_id_foreign` (`roadmap_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shares`
--
ALTER TABLE `shares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shares_user_id_foreign` (`user_id`),
  ADD KEY `shares_post_id_foreign` (`post_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_skills`
--
ALTER TABLE `user_skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_skills_user_id_foreign` (`user_id`),
  ADD KEY `user_skills_skill_id_foreign` (`skill_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roadmaps`
--
ALTER TABLE `roadmaps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roadmap_tasks`
--
ALTER TABLE `roadmap_tasks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shares`
--
ALTER TABLE `shares`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_skills`
--
ALTER TABLE `user_skills`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_follower_id_foreign` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `followers_following_id_foreign` FOREIGN KEY (`following_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD CONSTRAINT `friend_requests_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `friend_requests_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `roadmaps`
--
ALTER TABLE `roadmaps`
  ADD CONSTRAINT `roadmaps_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `roadmap_tasks`
--
ALTER TABLE `roadmap_tasks`
  ADD CONSTRAINT `roadmap_tasks_roadmap_id_foreign` FOREIGN KEY (`roadmap_id`) REFERENCES `roadmaps` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shares`
--
ALTER TABLE `shares`
  ADD CONSTRAINT `shares_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shares_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_skills`
--
ALTER TABLE `user_skills`
  ADD CONSTRAINT `user_skills_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_skills_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 18, 2026 at 07:13 AM
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
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `parent_id`, `comment`, `created_at`, `updated_at`) VALUES
(17, 1, 23, NULL, 'Great Steps', '2026-02-22 23:36:17', '2026-02-22 23:36:17'),
(18, 1, 23, 17, 'Thanks', '2026-02-22 23:36:33', '2026-02-22 23:36:33'),
(19, 5, 23, 17, 'Good Work', '2026-02-27 03:41:19', '2026-02-27 03:41:19');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `created_at`, `updated_at`) VALUES
(1, 'OM PATEL', 'pom323701@gmail.com', 'Good Work To Create the learning environment', '2026-02-16 00:09:50', '2026-02-16 00:09:50');

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
(16, 5, 1, '2026-02-13 00:38:20', '2026-02-13 00:38:20'),
(17, 4, 5, '2026-02-13 00:42:48', '2026-02-13 00:42:48'),
(20, 1, 5, '2026-02-13 03:32:18', '2026-02-13 03:32:18'),
(26, 5, 7, '2026-02-18 01:32:44', '2026-02-18 01:32:44'),
(35, 8, 1, '2026-03-03 05:06:34', '2026-03-03 05:06:34'),
(36, 7, 8, '2026-03-03 05:07:08', '2026-03-03 05:07:08'),
(37, 5, 8, '2026-03-03 05:07:34', '2026-03-03 05:07:34'),
(38, 4, 8, '2026-03-03 05:07:58', '2026-03-03 05:07:58'),
(40, 1, 4, '2026-03-11 00:39:20', '2026-03-11 00:39:20'),
(41, 7, 1, '2026-03-11 00:40:03', '2026-03-11 00:40:03'),
(42, 7, 4, '2026-03-11 00:40:07', '2026-03-11 00:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `sender_id` bigint UNSIGNED NOT NULL,
  `receiver_id` bigint UNSIGNED NOT NULL,
  `status` enum('pending','accepted','declined') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `friend_requests`
--

INSERT INTO `friend_requests` (`id`, `sender_id`, `receiver_id`, `status`, `created_at`, `updated_at`) VALUES
(23, 5, 1, 'accepted', '2026-02-13 03:30:08', '2026-02-13 03:32:18'),
(24, 5, 4, 'accepted', '2026-02-13 03:30:10', '2026-02-13 03:31:27'),
(30, 7, 5, 'accepted', '2026-02-18 01:29:00', '2026-02-18 01:32:44'),
(39, 1, 8, 'accepted', '2026-03-03 05:06:10', '2026-03-03 05:06:34'),
(40, 8, 4, 'accepted', '2026-03-03 05:06:37', '2026-03-03 05:07:58'),
(41, 8, 5, 'accepted', '2026-03-03 05:06:38', '2026-03-03 05:07:34'),
(42, 8, 7, 'accepted', '2026-03-03 05:06:39', '2026-03-03 05:07:08'),
(44, 1, 7, 'accepted', '2026-03-11 00:28:02', '2026-03-11 00:40:03'),
(45, 4, 1, 'accepted', '2026-03-11 00:29:34', '2026-03-11 00:39:20'),
(46, 4, 7, 'accepted', '2026-03-11 00:38:24', '2026-03-11 00:40:06');

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
(164, 7, 23, '2026-02-23 01:50:37', '2026-02-23 01:50:37'),
(165, 7, 27, '2026-02-27 03:35:16', '2026-02-27 03:35:16'),
(166, 7, 30, '2026-02-27 03:36:59', '2026-02-27 03:36:59'),
(167, 5, 30, '2026-02-27 03:40:55', '2026-02-27 03:40:55'),
(168, 5, 27, '2026-02-27 03:40:57', '2026-02-27 03:40:57'),
(169, 5, 23, '2026-02-27 03:41:02', '2026-02-27 03:41:02');

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
(18, '2026_02_11_090103_create_user_skills_table', 9),
(19, '2026_02_13_050025_create_notifications_table', 10),
(20, '2026_02_16_051520_create_contacts_table', 11),
(21, '2026_02_20_091942_add_title_and_type_to_posts_table', 12),
(22, '2026_02_20_111044_add_parent_id_to_comments_table', 13),
(23, '2026_02_23_051237_add_tags_to_posts_table', 14),
(24, '2026_03_18_063759_add_completed_tasks_to_user_skills', 15),
(25, '2026_03_18_064800_add_completed_tasks_to_user_skills', 16);

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
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('public','friends') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci,
  `media` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `type`, `content`, `tags`, `media`, `created_at`, `updated_at`) VALUES
(23, 1, 'How to Set Up Laravel in Windows 11?', 'public', '<h2 data-start=\"74\" data-end=\"98\" style=\"color: rgb(0, 0, 0);\">✅ 1️⃣ Install XAMPP</h2><h2 data-start=\"74\" data-end=\"98\" style=\"color: rgb(0, 0, 0);\"><ul data-start=\"99\" data-end=\"216\" style=\"font-size: medium;\"><li data-start=\"99\" data-end=\"147\"><p data-start=\"101\" data-end=\"147\">Download from: <a data-start=\"116\" data-end=\"145\" rel=\"noopener\" target=\"_new\" class=\"decorated-link\" href=\"https://www.apachefriends.org\">https://www.apachefriends.org<span aria-hidden=\"true\" class=\"ms-0.5 inline-block align-middle leading-none\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" aria-hidden=\"true\" data-rtl-flip=\"\" class=\"block h-[0.75em] w-[0.75em] stroke-current stroke-[0.75]\"><use href=\"/cdn/assets/sprites-core-jxe2m7va.svg#304883\" fill=\"currentColor\"></use></svg></span></a></p></li><li data-start=\"148\" data-end=\"216\"><p data-start=\"150\" data-end=\"216\">Install and start <strong data-start=\"168\" data-end=\"178\">Apache</strong> &amp; <strong data-start=\"181\" data-end=\"190\">MySQL</strong> from XAMPP Control Panel.</p></li></ul><hr data-start=\"218\" data-end=\"221\" style=\"font-size: medium;\"></h2><h2 data-start=\"223\" data-end=\"250\" style=\"color: rgb(0, 0, 0);\">✅ 2️⃣ Install Composer</h2><h2 data-start=\"74\" data-end=\"98\" style=\"color: rgb(0, 0, 0);\"><ul data-start=\"251\" data-end=\"355\" style=\"font-size: medium;\"><li data-start=\"251\" data-end=\"293\"><p data-start=\"253\" data-end=\"293\">Download from: <a data-start=\"268\" data-end=\"291\" rel=\"noopener\" target=\"_new\" class=\"decorated-link\" href=\"https://getcomposer.org\">https://getcomposer.org<span aria-hidden=\"true\" class=\"ms-0.5 inline-block align-middle leading-none\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" aria-hidden=\"true\" data-rtl-flip=\"\" class=\"block h-[0.75em] w-[0.75em] stroke-current stroke-[0.75]\"><use href=\"/cdn/assets/sprites-core-jxe2m7va.svg#304883\" fill=\"currentColor\"></use></svg></span></a></p></li><li data-start=\"294\" data-end=\"355\"><p data-start=\"296\" data-end=\"355\">Install it (it will automatically detect PHP from XAMPP).</p></li></ul><p data-start=\"357\" data-end=\"400\" style=\"font-size: medium;\">👉 Check installation:<br data-start=\"379\" data-end=\"382\">Open CMD and type:</p><pre class=\"overflow-visible! px-0!\" data-start=\"401\" data-end=\"420\" style=\"font-size: medium;\"><div class=\"w-full my-4\"><div class=\"\"><div class=\"relative\"><div class=\"h-full min-h-0 min-w-0\"><div class=\"h-full min-h-0 min-w-0\"><div class=\"border corner-superellipse/1.1 border-token-border-light bg-token-bg-elevated-secondary rounded-3xl\"><div class=\"pointer-events-none absolute inset-x-4 top-12 bottom-4\"><div class=\"pointer-events-none sticky z-40 shrink-0 z-1!\"><div class=\"sticky bg-token-border-light\"></div></div></div><div class=\"pointer-events-none absolute inset-x-px top-0 bottom-96\"><div class=\"pointer-events-none sticky z-40 shrink-0 z-1!\"><div class=\"sticky bg-token-bg-elevated-secondary\"></div></div></div><div class=\"corner-superellipse/1.1 rounded-3xl bg-token-bg-elevated-secondary\"><div class=\"relative z-0 flex max-w-full\"><div id=\"code-block-viewer\" dir=\"ltr\" class=\"q9tKkq_viewer cm-editor z-10 light:cm-light dark:cm-light flex h-full w-full flex-col items-stretch ͼk ͼy\"><div class=\"cm-scroller\"><div class=\"cm-content q9tKkq_readonly\">composer -v</div></div></div></div></div></div></div></div><div class=\"\"><div class=\"\"></div></div></div></div></div></pre><p data-start=\"421\" data-end=\"451\" style=\"font-size: medium;\">If version shows → ✅ Installed</p><hr data-start=\"453\" data-end=\"456\" style=\"font-size: medium;\"></h2><h2 data-start=\"458\" data-end=\"499\" style=\"color: rgb(0, 0, 0);\">✅ 3️⃣ Install Laravel (Create Project)</h2><h2 data-start=\"74\" data-end=\"98\" style=\"color: rgb(0, 0, 0);\"><p data-start=\"501\" data-end=\"534\" style=\"font-size: medium;\">Open CMD and go to htdocs folder:</p><pre class=\"overflow-visible! px-0!\" data-start=\"535\" data-end=\"561\" style=\"font-size: medium;\"><div class=\"w-full my-4\"><div class=\"\"><div class=\"relative\"><div class=\"h-full min-h-0 min-w-0\"><div class=\"h-full min-h-0 min-w-0\"><div class=\"border corner-superellipse/1.1 border-token-border-light bg-token-bg-elevated-secondary rounded-3xl\"><div class=\"pointer-events-none absolute inset-x-4 top-12 bottom-4\"><div class=\"pointer-events-none sticky z-40 shrink-0 z-1!\"><div class=\"sticky bg-token-border-light\"></div></div></div><div class=\"pointer-events-none absolute inset-x-px top-0 bottom-96\"><div class=\"pointer-events-none sticky z-40 shrink-0 z-1!\"><div class=\"sticky bg-token-bg-elevated-secondary\"></div></div></div><div class=\"corner-superellipse/1.1 rounded-3xl bg-token-bg-elevated-secondary\"><div class=\"relative z-0 flex max-w-full\"><div id=\"code-block-viewer\" dir=\"ltr\" class=\"q9tKkq_viewer cm-editor z-10 light:cm-light dark:cm-light flex h-full w-full flex-col items-stretch ͼk ͼy\"><div class=\"cm-scroller\"><div class=\"cm-content q9tKkq_readonly\">cd C:\\xampp\\htdocs</div></div></div></div></div></div></div></div><div class=\"\"><div class=\"\"></div></div></div></div></div></pre><p data-start=\"563\" data-end=\"567\" style=\"font-size: medium;\">Run:</p><pre class=\"overflow-visible! px-0!\" data-start=\"568\" data-end=\"627\" style=\"font-size: medium;\"><div class=\"w-full my-4\"><div class=\"\"><div class=\"relative\"><div class=\"h-full min-h-0 min-w-0\"><div class=\"h-full min-h-0 min-w-0\"><div class=\"border corner-superellipse/1.1 border-token-border-light bg-token-bg-elevated-secondary rounded-3xl\"><div class=\"pointer-events-none absolute inset-x-4 top-12 bottom-4\"><div class=\"pointer-events-none sticky z-40 shrink-0 z-1!\"><div class=\"sticky bg-token-border-light\"></div></div></div><div class=\"pointer-events-none absolute inset-x-px top-0 bottom-96\"><div class=\"pointer-events-none sticky z-40 shrink-0 z-1!\"><div class=\"sticky bg-token-bg-elevated-secondary\"></div></div></div><div class=\"corner-superellipse/1.1 rounded-3xl bg-token-bg-elevated-secondary\"><div class=\"relative z-0 flex max-w-full\"><div id=\"code-block-viewer\" dir=\"ltr\" class=\"q9tKkq_viewer cm-editor z-10 light:cm-light dark:cm-light flex h-full w-full flex-col items-stretch ͼk ͼy\"><div class=\"cm-scroller\"><div class=\"cm-content q9tKkq_readonly\">composer create-project laravel/laravel projectname</div></div></div></div></div></div></div></div><div class=\"\"><div class=\"\"></div></div></div></div></div></pre><p data-start=\"629\" data-end=\"637\" style=\"font-size: medium;\">Example:</p><pre class=\"overflow-visible! px-0!\" data-start=\"638\" data-end=\"691\" style=\"font-size: medium;\"><div class=\"w-full my-4\"><div class=\"\"><div class=\"relative\"><div class=\"h-full min-h-0 min-w-0\"><div class=\"h-full min-h-0 min-w-0\"><div class=\"border corner-superellipse/1.1 border-token-border-light bg-token-bg-elevated-secondary rounded-3xl\"><div class=\"pointer-events-none absolute inset-x-4 top-12 bottom-4\"><div class=\"pointer-events-none sticky z-40 shrink-0 z-1!\"><div class=\"sticky bg-token-border-light\"></div></div></div><div class=\"pointer-events-none absolute inset-x-px top-0 bottom-96\"><div class=\"pointer-events-none sticky z-40 shrink-0 z-1!\"><div class=\"sticky bg-token-bg-elevated-secondary\"></div></div></div><div class=\"corner-superellipse/1.1 rounded-3xl bg-token-bg-elevated-secondary\"><div class=\"relative z-0 flex max-w-full\"><div id=\"code-block-viewer\" dir=\"ltr\" class=\"q9tKkq_viewer cm-editor z-10 light:cm-light dark:cm-light flex h-full w-full flex-col items-stretch ͼk ͼy\"><div class=\"cm-scroller\"><div class=\"cm-content q9tKkq_readonly\">composer create-project laravel/laravel myapp</div></div></div></div></div></div></div></div><div class=\"\"><div class=\"\"></div></div></div></div></div></pre><hr data-start=\"693\" data-end=\"696\" style=\"font-size: medium;\"></h2><h2 data-start=\"698\" data-end=\"726\" style=\"color: rgb(0, 0, 0);\">✅ 4️⃣ Run Laravel Project</h2><h2 data-start=\"74\" data-end=\"98\" style=\"color: rgb(0, 0, 0);\"><p data-start=\"728\" data-end=\"753\" style=\"font-size: medium;\">Go inside project folder:</p><pre class=\"overflow-visible! px-0!\" data-start=\"754\" data-end=\"770\" style=\"font-size: medium;\"><div class=\"w-full my-4\"><div class=\"\"><div class=\"relative\"><div class=\"h-full min-h-0 min-w-0\"><div class=\"h-full min-h-0 min-w-0\"><div class=\"border corner-superellipse/1.1 border-token-border-light bg-token-bg-elevated-secondary rounded-3xl\"><div class=\"pointer-events-none absolute inset-x-4 top-12 bottom-4\"><div class=\"pointer-events-none sticky z-40 shrink-0 z-1!\"><div class=\"sticky bg-token-border-light\"></div></div></div><div class=\"pointer-events-none absolute inset-x-px top-0 bottom-96\"><div class=\"pointer-events-none sticky z-40 shrink-0 z-1!\"><div class=\"sticky bg-token-bg-elevated-secondary\"></div></div></div><div class=\"corner-superellipse/1.1 rounded-3xl bg-token-bg-elevated-secondary\"><div class=\"relative z-0 flex max-w-full\"><div id=\"code-block-viewer\" dir=\"ltr\" class=\"q9tKkq_viewer cm-editor z-10 light:cm-light dark:cm-light flex h-full w-full flex-col items-stretch ͼk ͼy\"><div class=\"cm-scroller\"><div class=\"cm-content q9tKkq_readonly\">cd myapp</div></div></div></div></div></div></div></div><div class=\"\"><div class=\"\"></div></div></div></div></div></pre><p data-start=\"772\" data-end=\"776\" style=\"font-size: medium;\">Run:</p><pre class=\"overflow-visible! px-0!\" data-start=\"777\" data-end=\"802\" style=\"font-size: medium;\"><div class=\"w-full my-4\"><div class=\"\"><div class=\"relative\"><div class=\"h-full min-h-0 min-w-0\"><div class=\"h-full min-h-0 min-w-0\"><div class=\"border corner-superellipse/1.1 border-token-border-light bg-token-bg-elevated-secondary rounded-3xl\"><div class=\"pointer-events-none absolute inset-x-4 top-12 bottom-4\"><div class=\"pointer-events-none sticky z-40 shrink-0 z-1!\"><div class=\"sticky bg-token-border-light\"></div></div></div><div class=\"pointer-events-none absolute inset-x-px top-0 bottom-96\"><div class=\"pointer-events-none sticky z-40 shrink-0 z-1!\"><div class=\"sticky bg-token-bg-elevated-secondary\"></div></div></div><div class=\"corner-superellipse/1.1 rounded-3xl bg-token-bg-elevated-secondary\"><div class=\"relative z-0 flex max-w-full\"><div id=\"code-block-viewer\" dir=\"ltr\" class=\"q9tKkq_viewer cm-editor z-10 light:cm-light dark:cm-light flex h-full w-full flex-col items-stretch ͼk ͼy\"><div class=\"cm-scroller\"><div class=\"cm-content q9tKkq_readonly\">php artisan serve</div></div></div></div></div></div></div></div><div class=\"\"><div class=\"\"></div></div></div></div></div></pre><p data-start=\"804\" data-end=\"817\" style=\"font-size: medium;\">You will see:</p><pre class=\"overflow-visible! px-0!\" data-start=\"818\" data-end=\"865\" style=\"font-size: medium;\"><div class=\"w-full my-4\"><div class=\"\"><div class=\"relative\"><div class=\"h-full min-h-0 min-w-0\"><div class=\"h-full min-h-0 min-w-0\"><div class=\"border corner-superellipse/1.1 border-token-border-light bg-token-bg-elevated-secondary rounded-3xl\"><div class=\"pointer-events-none absolute inset-x-4 top-12 bottom-4\"><div class=\"pointer-events-none sticky z-40 shrink-0 z-1!\"><div class=\"sticky bg-token-border-light\"></div></div></div><div class=\"pointer-events-none absolute inset-x-px top-0 bottom-96\"><div class=\"pointer-events-none sticky z-40 shrink-0 z-1!\"><div class=\"sticky bg-token-bg-elevated-secondary\"></div></div></div><div class=\"corner-superellipse/1.1 rounded-3xl bg-token-bg-elevated-secondary\"><div class=\"relative z-0 flex max-w-full\"><div id=\"code-block-viewer\" dir=\"ltr\" class=\"q9tKkq_viewer cm-editor z-10 light:cm-light dark:cm-light flex h-full w-full flex-col items-stretch ͼk ͼy\"><div class=\"cm-scroller\"><div class=\"cm-content q9tKkq_readonly\">Server running on http://127.0.0.1:8000</div></div></div></div></div></div></div></div><div class=\"\"><div class=\"\"></div></div></div></div></div></pre><p data-start=\"867\" data-end=\"910\" style=\"font-size: medium;\">Open browser →<br data-start=\"881\" data-end=\"884\">👉 <a data-start=\"887\" data-end=\"908\" rel=\"noopener\" target=\"_new\" class=\"decorated-link cursor-pointer\">http://127.0.0.1:8000<span aria-hidden=\"true\" class=\"ms-0.5 inline-block align-middle leading-none\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" aria-hidden=\"true\" data-rtl-flip=\"\" class=\"block h-[0.75em] w-[0.75em] stroke-current stroke-[0.75]\"><use href=\"/cdn/assets/sprites-core-jxe2m7va.svg#304883\" fill=\"currentColor\"></use></svg></span></a></p><p data-start=\"912\" data-end=\"934\" style=\"font-size: medium;\">🎉 Laravel is working!</p><hr data-start=\"936\" data-end=\"939\" style=\"font-size: medium;\"></h2><h2 data-start=\"941\" data-end=\"989\" style=\"color: rgb(0, 0, 0);\">✅ 5️⃣ Database Setup (Optional but Important)</h2><h2 data-start=\"74\" data-end=\"98\" style=\"color: rgb(0, 0, 0);\"><ol data-start=\"991\" data-end=\"1140\" style=\"font-size: medium;\"><li data-start=\"991\" data-end=\"1045\"><p data-start=\"994\" data-end=\"1045\">Open <strong data-start=\"999\" data-end=\"1013\">phpMyAdmin</strong> → <a data-start=\"1016\" data-end=\"1043\" rel=\"noopener\" target=\"_new\" class=\"decorated-link cursor-pointer\">http://localhost/phpmyadmin<span aria-hidden=\"true\" class=\"ms-0.5 inline-block align-middle leading-none\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" aria-hidden=\"true\" data-rtl-flip=\"\" class=\"block h-[0.75em] w-[0.75em] stroke-current stroke-[0.75]\"><use href=\"/cdn/assets/sprites-core-jxe2m7va.svg#304883\" fill=\"currentColor\"></use></svg></span></a></p></li><li data-start=\"1046\" data-end=\"1092\"><p data-start=\"1049\" data-end=\"1092\">Create new database (example: <code data-start=\"1079\" data-end=\"1089\">myapp_db</code>)</p></li><li data-start=\"1093\" data-end=\"1129\"><p data-start=\"1096\" data-end=\"1129\">Open <code data-start=\"1101\" data-end=\"1107\">.env</code> file inside project</p></li><li data-start=\"1130\" data-end=\"1140\"><p data-start=\"1133\" data-end=\"1140\">Update:</p></li></ol><pre class=\"overflow-visible! px-0!\" data-start=\"1142\" data-end=\"1200\" style=\"font-size: medium;\"><div class=\"w-full my-4\"><div class=\"\"><div class=\"relative\"><div class=\"h-full min-h-0 min-w-0\"><div class=\"h-full min-h-0 min-w-0\"><div class=\"border corner-superellipse/1.1 border-token-border-light bg-token-bg-elevated-secondary rounded-3xl\"><div class=\"pointer-events-none absolute inset-x-4 top-12 bottom-4\"><div class=\"pointer-events-none sticky z-40 shrink-0 z-1!\"><div class=\"sticky bg-token-border-light\"></div></div></div><div class=\"pointer-events-none absolute inset-x-px top-0 bottom-96\"><div class=\"pointer-events-none sticky z-40 shrink-0 z-1!\"><div class=\"sticky bg-token-bg-elevated-secondary\"></div></div></div><div class=\"corner-superellipse/1.1 rounded-3xl bg-token-bg-elevated-secondary\"><div class=\"relative z-0 flex max-w-full\"><div id=\"code-block-viewer\" dir=\"ltr\" class=\"q9tKkq_viewer cm-editor z-10 light:cm-light dark:cm-light flex h-full w-full flex-col items-stretch ͼk ͼy\"><div class=\"cm-scroller\"><div class=\"cm-content q9tKkq_readonly\">DB_DATABASE=myapp_db<br>DB_USERNAME=root<br>DB_PASSWORD=</div></div></div></div></div></div></div></div><div class=\"\"><div class=\"\"></div></div></div></div></div></pre><p data-start=\"1202\" data-end=\"1212\" style=\"font-size: medium;\">Save file.</p><p data-start=\"1214\" data-end=\"1228\" style=\"font-size: medium;\">Run migration:</p><pre class=\"overflow-visible! px-0!\" data-start=\"1229\" data-end=\"1256\" style=\"font-size: medium;\"><div class=\"w-full my-4\"><div class=\"\"><div class=\"relative\"><div class=\"h-full min-h-0 min-w-0\"><div class=\"h-full min-h-0 min-w-0\"><div class=\"border corner-superellipse/1.1 border-token-border-light bg-token-bg-elevated-secondary rounded-3xl\"><div class=\"pointer-events-none absolute inset-x-4 top-12 bottom-4\"><div class=\"pointer-events-none sticky z-40 shrink-0 z-1!\"><div class=\"sticky bg-token-border-light\"></div></div></div><div class=\"pointer-events-none absolute inset-x-px top-0 bottom-96\"><div class=\"pointer-events-none sticky z-40 shrink-0 z-1!\"><div class=\"sticky bg-token-bg-elevated-secondary\"></div></div></div><div class=\"corner-superellipse/1.1 rounded-3xl bg-token-bg-elevated-secondary\"><div class=\"relative z-0 flex max-w-full\"><div id=\"code-block-viewer\" dir=\"ltr\" class=\"q9tKkq_viewer cm-editor z-10 light:cm-light dark:cm-light flex h-full w-full flex-col items-stretch ͼk ͼy\"><div class=\"cm-scroller\"><div class=\"cm-content q9tKkq_readonly\">php artisan migrate</div></div></div></div></div></div></div></div></div></div></div></pre></h2>', 'Laravel,php', NULL, '2026-02-22 23:35:54', '2026-02-23 01:20:26'),
(27, 1, 'How to apply middleware ?', 'friends', 'User clicks /admin/dashboard\r\n\r\nMiddleware runs first\r\n\r\nIt checks:\r\n\r\nIs user logged in?\r\n\r\nIs user role admin?\r\n\r\nIf both true → open dashboard\r\n\r\nIf false → block access\r\n\r\n✅ Real-Life Example\r\n\r\nThink middleware like:\r\n\r\n🏢 Security guard at office entrance\r\n\r\n🎟 Ticket checker at cinema\r\n\r\n🔑 Password lock on phone\r\n\r\nWithout permission → no entry.', 'laravel', NULL, '2026-02-24 01:40:03', '2026-02-25 00:03:38'),
(30, 7, 'How It Matches Proper DFD Structure?', 'friends', '<ol><li><b><i>✔ External entity (User)</i></b></li><li><b><i>\r\n✔ Multiple internal processes</i></b></li><li><b><i>\r\n✔ Proper data stores</i></b></li><li><b><i>\r\n✔ Labeled data flow arrows</i></b></li><li><b><i>\r\n✔ Validation return flow</i></b></li></ol>', 'Laravel,Diagram', NULL, '2026-02-27 03:36:55', '2026-02-27 03:36:55');

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
(2, 2, 'React ES6', '2026-02-24 05:17:47', '2026-02-24 05:17:47'),
(3, 1, 'Laravel Setup And Basics', '2026-02-24 05:36:06', '2026-02-25 00:23:32'),
(4, 1, 'Routing & Controllers', '2026-02-25 00:04:39', '2026-02-25 00:27:19');

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
(10, 3, 'Install XAMPP / Laravel Installer', 1, '2026-02-24 05:52:43', '2026-03-18 01:42:48'),
(11, 3, 'Create First Laravel Project', 1, '2026-02-25 00:24:24', '2026-03-18 01:42:46'),
(12, 3, 'Understand Project Folder Structure', 1, '2026-02-25 00:24:46', '2026-03-18 01:36:04'),
(13, 3, 'Configure .env File', 1, '2026-02-25 00:25:01', '2026-03-18 01:35:59'),
(14, 3, 'Setup Database Connection', 1, '2026-02-25 00:25:23', '2026-03-18 01:36:01'),
(15, 3, 'Run Migrations', 1, '2026-02-25 00:25:44', '2026-03-18 01:36:07'),
(16, 3, 'Create First Route', 1, '2026-02-25 00:26:07', '2026-03-18 01:36:11'),
(17, 3, 'Create First Controller', 1, '2026-02-25 00:26:19', '2026-03-18 01:36:12'),
(18, 3, 'Return View from Controller', 1, '2026-02-25 00:26:34', '2026-03-18 01:36:12'),
(19, 3, 'Use Blade Template Basics', 1, '2026-02-25 00:26:56', '2026-03-18 01:36:27'),
(20, 4, 'Route Parameters', 1, '2026-02-25 00:27:41', '2026-03-18 01:35:16'),
(21, 4, 'Named Routes', 1, '2026-02-25 00:28:01', '2026-03-18 01:35:19'),
(22, 4, 'Route Groups', 0, '2026-02-25 00:28:21', '2026-02-25 04:03:03'),
(23, 4, 'Resource Controllers', 0, '2026-02-25 00:28:39', '2026-02-25 04:03:18'),
(24, 4, 'Form Handling (POST Request)', 0, '2026-02-25 00:28:59', '2026-02-25 04:03:15'),
(25, 4, 'CSRF Protection', 0, '2026-02-25 00:29:26', '2026-02-25 04:03:11'),
(26, 4, 'Redirect with Flash Messages', 0, '2026-02-25 00:29:43', '2026-02-25 04:03:07'),
(27, 2, 'Arrow Function', 0, '2026-02-27 03:25:29', '2026-02-27 03:25:29');

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
('TrWE2rrqsdtISxg3MgvYT7Ojfvu7WqSdybUOYR1r', 12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiblhFS2VsV0NqdlhNMEE1cXdhYVVFYTZiZDdWczF3TmFJaTM3eko1RCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yb2FkbWFwL3Rhc2tzLzMiO3M6NToicm91dGUiO3M6MTM6InJvYWRtYXAudGFza3MiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxMjt9', 1773817968);

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
(6, 'Machine Learning', 'Introducing to Machine Logic', '2026-02-24 05:00:44', '2026-02-24 05:01:35');

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `google_id`, `email_verified_at`, `password`, `role`, `bio`, `profile_photo`, `reputation_points`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Om Patel', 'pom323701@gmail.com', NULL, NULL, '$2y$12$i4g910UtJO3AVAa8jCC4WurT8zNoLS5RFLXtN3lGg4gVbvgd5guHy', 'admin', 'Hello Laravel Developer', 'profiles/QQKDYd3LdZYhWEKccaoGnYu6w1dhIEHTgavZhdFB.jpg', 0, 'active', '8KqcsJBb6atRmyzhAVYO1I0fZnj5zTTkvdLwkpXrJyINvXcWrLXLymco1ldh', '2026-01-21 04:47:05', '2026-02-08 23:44:06'),
(4, 'Mann Patel', 'patelmann13301@gmail.com', NULL, NULL, '$2y$12$Hv0ytqeMqntcgzFi83nWheNCOQByTrcUhaJp8xLV3fYcCISk9V7rC', 'user', 'Python Developer', 'profiles/6hR1lhC512jKRW1g8nOiA7VEhYqUDFGBE8de3wT3.jpg', 0, 'active', NULL, '2026-02-12 04:01:53', '2026-02-12 04:01:53'),
(5, 'Dhruv Patel', 'dhruv23807@gmail.com', NULL, NULL, '$2y$12$7UCUMBpFYCrPATy6T7P4kesto7OAwFbE05gwzbAF7ypOEWoTO8iW2', 'user', 'Mechanical Engineer', 'profiles/JUatSnkha55ghtslHX9qCatwksiNx7huhlRQpc0m.jpg', 0, 'active', NULL, '2026-02-12 04:12:04', '2026-02-12 04:12:04'),
(7, 'OM PATEL', 'patelom4136@gmail.com', NULL, NULL, '$2y$12$WHaShXOAOpN1yupGgtyYs.ENbcD2/bzFAR3sFO9km/yPFj38IDqoK', 'user', 'Laravel Developer', 'profiles/BlPLFS1dCG5arODzNXPfnilJIgV9VXYLaspdzCcz.jpg', 0, 'active', NULL, '2026-02-18 01:28:12', '2026-02-18 06:00:43'),
(8, 'Shan Patel', 'patelshan2310@gmail.com', NULL, NULL, '$2y$12$Y2WmeRzaZhdsL4PbAjEZTeKCCNviC11S4tevN19HrKQQfCDxELe3y', 'user', NULL, 'profiles/AyyqgrmOlWSDHtj05GD4FdEP5EurYOupA98xxkhZ.jpg', 0, 'active', NULL, '2026-02-24 00:25:35', '2026-03-03 05:06:00'),
(12, 'Patel Omkumar', 'patelom123@gmail.com', NULL, NULL, '$2y$12$mh1PW9vWqzyTvYSbiLxRJ.PhG4qjKlE5KTo0V8FWv7l.jUqnE68Km', 'user', 'React Developer', 'profiles/tmAUWnU1c60oK7IOsRUhN8RyPowlLyfTCUbp3v3I.jpg', 0, 'active', NULL, '2026-03-18 00:46:45', '2026-03-18 00:46:45');

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `completed_tasks` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_skills`
--

INSERT INTO `user_skills` (`id`, `user_id`, `skill_id`, `level`, `progress_percentage`, `created_at`, `updated_at`, `completed_tasks`) VALUES
(1, 1, 1, 'Beginner', 0, '2026-02-12 03:59:56', '2026-02-12 03:59:56', 0),
(4, 7, 1, 'Beginner', 0, '2026-02-25 01:23:37', '2026-02-25 01:23:37', 0),
(6, 7, 2, 'Beginner', 0, '2026-02-25 03:52:54', '2026-02-25 03:52:54', 0),
(7, 12, 1, 'Beginner', 100, '2026-03-18 00:49:16', '2026-03-18 01:42:48', 10),
(8, 12, 2, 'Beginner', 0, '2026-03-18 00:49:19', '2026-03-18 00:49:19', 0);

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
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `roadmaps`
--
ALTER TABLE `roadmaps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roadmap_tasks`
--
ALTER TABLE `roadmap_tasks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `shares`
--
ALTER TABLE `shares`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_skills`
--
ALTER TABLE `user_skills`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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

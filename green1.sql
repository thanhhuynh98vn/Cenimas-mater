-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 26, 2018 lúc 04:32 PM
-- Phiên bản máy phục vụ: 10.1.34-MariaDB
-- Phiên bản PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `green1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booking_seat`
--

CREATE TABLE `booking_seat` (
  `id` int(10) UNSIGNED NOT NULL,
  `film_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seat_number` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `booking_seat`
--

INSERT INTO `booking_seat` (`id`, `film_id`, `name`, `type`, `seat_number`, `user_id`, `room_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'K6', 'K', 6, 331, 1, '2018-08-22 18:14:28', '2018-08-23 02:17:26'),
(2, 1, 'K7', 'K', 7, 330, 1, '2018-08-22 18:14:28', '2018-08-26 06:53:12'),
(3, 1, 'K8', 'K', 8, NULL, 1, '2018-08-22 18:14:28', '2018-08-26 05:44:42'),
(4, 1, 'K9', 'K', 9, 331, 1, '2018-08-22 18:14:28', '2018-08-26 05:36:27'),
(5, 1, 'K10', 'K', 10, NULL, 1, '2018-08-22 18:14:28', '2018-08-26 05:44:18'),
(6, 1, 'K11', 'K', 11, 330, 1, '2018-08-22 18:14:28', '2018-08-26 06:53:12'),
(7, 1, 'K12', 'K', 12, 330, 1, '2018-08-22 18:14:28', '2018-08-26 06:53:12'),
(8, 1, 'K13', 'K', 13, 331, 1, '2018-08-22 18:14:28', '2018-08-26 05:37:16'),
(9, 1, 'K14', 'K', 14, 330, 1, '2018-08-22 18:14:28', '2018-08-26 06:53:12'),
(10, 1, 'K15', 'K', 15, 1, 1, '2018-08-22 18:14:28', '2018-08-26 07:11:32'),
(11, 1, 'K16', 'K', 16, 1, 1, '2018-08-22 18:14:28', '2018-08-26 07:11:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cinemas`
--

CREATE TABLE `cinemas` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cinemas`
--

INSERT INTO `cinemas` (`id`, `name`, `parent_id`, `address`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'CGV', NULL, '', NULL, '2018-07-18 02:21:58', '2018-07-18 02:21:58'),
(2, 'CGV Vĩnh Trung Plaza', 1, '255-257 đường Hùng Vương Quận Thanh Khê Tp. Đà Nẵng', 19006017, '2018-07-18 02:21:58', '2018-07-18 02:21:58'),
(5, 'Galaxy Cinema', NULL, NULL, NULL, '2018-07-23 00:33:36', '2018-07-24 00:09:21'),
(6, 'CGV Vincom Đà Nẵng', 1, 'Tầng 4, TTTM Vincom Đà Nẵng, đường Ngô Quyền, P.An Hải Bắc, Q.Sơn Trà, TP. Đà Nẵng\n', 19006017, '2018-07-18 02:21:58', '2018-07-18 02:21:58'),
(7, 'Galaxy Điện Biên Phủ', 5, 'Điện biên phủ', 113, '2018-07-23 00:33:36', '2018-07-23 00:33:36'),
(29, 'Lotte Cinema', NULL, NULL, NULL, '2018-07-24 00:07:37', '2018-07-24 00:07:37'),
(30, 'Platinum Cineplex', NULL, NULL, NULL, '2018-07-24 00:08:31', '2018-07-24 00:08:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dashboard_repositories`
--

CREATE TABLE `dashboard_repositories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_07_04_080728_create_dashboard_repositories_table', 1),
(4, '2018_07_04_081242_create_post_repositories_table', 1),
(5, '2018_07_04_083238_create_repository_interfaces_table', 1),
(6, '2018_07_05_081451_create_posts_table', 1),
(7, '2018_07_06_094158_entrust_setup_tables', 1),
(8, '2018_07_12_093807_create_jobs_table', 2),
(9, '2018_07_12_093902_create_failed_jobs_table', 2),
(10, '2018_07_16_065857_create_socials_table', 3),
(12, '2018_07_17_040552_create_tags_table', 4),
(13, '2018_07_17_040710_create_post_tag_table', 4),
(14, '2018_07_17_041432_create_edit_post_table', 4),
(15, '2018_07_19_044348_create_categories_table', 5),
(17, '2018_07_23_041045_create_cinemas_table', 6),
(19, '2018_07_24_025811_create_rooms_table', 7),
(23, '2018_07_25_041327_create_votes_table', 8),
(25, '2018_07_25_082110_create_vvalue_table', 9),
(26, '2018_07_27_021639_create_add_month_votes_table', 10),
(27, '2018_07_27_064121_create_vote_value_user_table', 11),
(28, '2018_07_31_025542_add_time_to_vote_value_table', 12),
(30, '2018_07_31_091923_create_tickets_table', 13),
(32, '2018_08_06_090117_create_room_type_table', 14),
(33, '2018_08_06_095407_create_room_settings_table', 15),
(34, '2018_08_07_080329_create_addspace_table', 16),
(39, '2018_08_14_071958_create_booking_seat_table', 17),
(40, '2018_08_20_063339_create_expiry_date_ticket_table', 18);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('mrphong678@greenglobal.vn', '$2y$10$.BomzngrL2a4yVGBHdzBceqPQHSA3E25QG2etncb1Wk36VdmZ8K7u', '2018-07-16 18:37:46'),
('okebaby701@greenglobal.vn', '$2y$10$lTjvV2DyzEVzWw4.GWAHN.4i5fosQER3P25yxG6gbOemdNwhLQqTa', '2018-07-16 18:59:36'),
('mrphong91011@gmail.com', '$2y$10$g4If4A/ZvR9oqlNSFceznOD6zFsoBoabQDx57c9ei0Xf5DSfc5MTy', '2018-07-16 20:16:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'create_user', 'Create users', 'Create new users', '2018-07-08 19:04:22', '2018-07-08 19:04:22'),
(2, 'edit_user', 'Edit user', 'Edit a users', '2018-07-08 19:04:22', '2018-07-08 19:04:22'),
(3, 'dell_user', 'Delete users', 'Delete a users', '2018-07-08 19:04:22', '2018-07-08 19:04:22'),
(4, 'editor_post', 'Editor post', 'Editor can edit your writing', '2018-07-08 19:04:22', '2018-07-08 19:04:22'),
(5, 'create_post', 'Create post', 'Create post', '2018-07-08 19:04:22', '2018-07-08 19:04:22'),
(6, 'dell_post', 'Delete post', 'Delete a post', '2018-07-08 19:04:22', '2018-07-08 19:04:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 7),
(5, 1),
(5, 7),
(6, 1),
(6, 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `view` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `content`, `avatar`, `slug`, `view`, `author_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Một khi các mối quan hệ được xác định, bạn có thể truy cập vào roles bằng cách truy cập dynamic property:', 'Một khi các mối quan hệ được xác định, bạn có thể truy cập vào roles bằng cách truy cập dynamic property:', '<p>Một khi c&aacute;c mối quan hệ được x&aacute;c định, bạn c&oacute; thể truy cập v&agrave;o roles bằng c&aacute;ch truy cập dynamic property:</p>\r\n\r\n<p>&nbsp;</p>', 'ZFF9ZspK9G2Fzu5QAX0rk1nEW522M43eAWNKUJkZ.jpeg', 'laravel.html', 100, 1, '2018-07-18 02:21:58', '2018-07-20 00:50:53', NULL),
(2, 'But, before diving too deep into using relationships, let\'s learn how to define each type.', 'But, before diving too deep into using relationships, let\'s learn how to define each type.', '<p>But, before diving too deep into using relationships, let&#39;s learn how to define each type.</p>', 'FJIRmssQUOQ4YYNz9auG2qRhlCssYU8Npc8nAbda.jpeg', 'But, before diving too deep into using relationships, let\'s learn how to define each type.', 200, 1, '2018-07-18 02:24:15', '2018-07-18 18:14:04', NULL),
(3, 'Although this project is completely free for use, I appreciate any support!', 'Một khi các mối quan hệ được xác định, bạn có thể truy cập vào roles bằng cách truy cập dynamic property:', '<p><img alt=\"\" src=\"/storage/app/files/images/7.jpg\" style=\"height:200px; width:300px\" /></p>\r\n\r\n<p>But, before diving too deep into using relationships, let&#39;s learn how to define each type.<a name=\"one-to-one\"></a></p>', 'xwRmpaKHak87NEuKoYEbZiOCh3j6utlf8XydobmS.jpeg', 'ssss.html', 300, 1, '2018-07-18 02:39:37', '2018-07-18 02:43:19', NULL),
(9, 'xin chao', '123123', '123123', 'AngPoFbEXcjrur7VwkOM4K9OvttekRA2FjUNk5Lw.jpeg', 'xinchao.lll', 0, 1, '2018-07-20 00:53:06', '2018-07-20 00:53:06', NULL),
(10, 'Hello', 'Hello', '<p>Hello</p>', '3uPEwEelddBQE4KM53ve4pTWMM0A87pE7SCuJCej.jpeg', 'hello.kkk', 0, 1, '2018-07-20 00:54:11', '2018-07-22 03:50:18', NULL),
(11, 'các bạn thật đẹp', 'xxxx', '<p>xxxx</p>', 'Mo9wkU92uoOs1On5mZ2dlvyAnh5zMWb9N8xJ3oBb.jpeg', 'cac-ban-that-dep.html', 0, 331, '2018-07-22 04:22:13', '2018-07-22 06:50:12', NULL),
(12, 'xin chào các bạn2', 'xin chao2', '<p>xin chao2</p>', 'xFPoy2EySyyyisiOXgeKkviyg4sBpbxkiu8mreUc.jpeg', 'xin-chao-cac-ban2.html', 0, 1, '2018-07-22 06:51:30', '2018-07-28 06:43:20', NULL),
(13, 'Newest U.S. Strategy in Afghanistan Mirrors Past Plans for Retreat', 'Newest U.S. Strategy in Afghanistan Mirrors Past Plans for Retreat', '<p>Newest U.S. Strategy in Afghanistan Mirrors Past Plans for Retreat</p>', 'oxMBWpioNPWKGxYTvVW4hLtfYVVTjyXRWuSOFfx2.jpeg', 'newest-u-s--strategy-in-afghanistan-mirrors-past-plans-for-retreat.html', 0, 1, '2018-07-29 04:35:53', '2018-07-29 04:36:04', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_repositories`
--

CREATE TABLE `post_repositories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_tag`
--

CREATE TABLE `post_tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post_tag`
--

INSERT INTO `post_tag` (`id`, `id_post`, `id_tag`, `created_at`, `updated_at`) VALUES
(25, 3, 5, NULL, NULL),
(26, 3, 1, NULL, NULL),
(27, 3, 2, NULL, NULL),
(35, 2, 8, NULL, NULL),
(61, 9, 13, NULL, NULL),
(64, 1, 4, NULL, NULL),
(65, 1, 9, NULL, NULL),
(67, 10, 15, NULL, NULL),
(71, 11, 16, NULL, NULL),
(73, 12, 1, NULL, NULL),
(74, 12, 13, NULL, NULL),
(75, 12, 18, NULL, NULL),
(79, 13, 1, NULL, NULL),
(80, 13, 13, NULL, NULL),
(81, 13, 19, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `repository_interfaces`
--

CREATE TABLE `repository_interfaces` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'super admin', 'lv1', '2018-04-05 07:27:51', '2018-04-05 07:27:51'),
(2, 'admin', 'admin', 'lv2', '2018-04-05 07:27:51', '2018-04-05 07:27:51'),
(7, 'editor', 'Editor post', 'Editor can edit your writing', '2018-07-18 19:22:05', '2018-07-18 19:22:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(2, 2),
(3, 2),
(331, 7),
(338, 7),
(339, 2),
(340, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rooms`
--

CREATE TABLE `rooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` bigint(20) NOT NULL,
  `cinemas_id` int(11) NOT NULL,
  `space` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `number`, `cinemas_id`, `space`, `created_at`, `updated_at`) VALUES
(1, 'Room3', 173, 2, 'A3,A4,B3,B4,C3,C4,D3,D4,E3,E4,F3,F4,G3,G4,H3,H4,J3,J4', '2018-07-18 02:21:58', '2018-08-08 18:50:07'),
(2, 'Room4', 233, 2, 'A3,A4,B3,B4,C3,C4,D3,D4,E3,E4,F3,F4,G3,G4,H3,H4,J3,J4', '2018-07-23 20:44:47', '2018-08-08 08:02:38'),
(3, 'Room5', 111, 2, 'A1,B1,C1,D1,E1,F1,G1,H1,J1', '2018-07-23 20:59:11', '2018-08-08 18:35:23'),
(4, 'Room1', 133, 2, 'A1,B1,C1,D1,E1,F1,G1,H1,J1', '2018-07-23 21:16:55', '2018-08-08 08:40:17'),
(5, 'Room2', 173, 2, 'A16,A17,B16,B17,C16,C17,D16,D17,E16,E17,F16,F17,G16,G17,H16,H17,J16,J17', '2018-08-03 02:27:43', '2018-08-08 18:49:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_settings`
--

CREATE TABLE `room_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `number` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `alphabet_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `room_settings`
--

INSERT INTO `room_settings` (`id`, `number`, `room_id`, `alphabet_id`, `created_at`, `updated_at`) VALUES
(2, 13, 4, 2, '2018-08-06 06:22:53', '2018-08-06 06:43:37'),
(3, 13, 4, 3, '2018-08-06 06:39:34', '2018-08-06 06:39:34'),
(4, 13, 4, 4, '2018-08-06 06:39:42', '2018-08-06 06:39:42'),
(5, 13, 4, 5, '2018-08-06 06:39:50', '2018-08-06 06:39:50'),
(6, 13, 4, 6, '2018-08-06 06:39:58', '2018-08-06 06:39:58'),
(7, 13, 4, 1, '2018-08-06 06:41:13', '2018-08-06 06:41:13'),
(8, 13, 4, 7, '2018-08-06 06:41:37', '2018-08-06 06:41:37'),
(9, 13, 4, 8, '2018-08-06 06:41:46', '2018-08-06 06:41:46'),
(10, 16, 4, 11, '2018-08-06 06:42:48', '2018-08-06 21:24:24'),
(11, 13, 4, 10, '2018-08-06 06:44:22', '2018-08-06 06:46:02'),
(13, 17, 5, 1, '2018-08-06 20:41:55', '2018-08-06 20:41:55'),
(14, 17, 5, 2, '2018-08-06 20:42:03', '2018-08-06 20:42:03'),
(15, 17, 5, 3, '2018-08-06 20:42:11', '2018-08-06 20:42:11'),
(16, 17, 5, 4, '2018-08-06 20:42:27', '2018-08-06 20:42:27'),
(17, 17, 5, 5, '2018-08-06 20:42:35', '2018-08-06 20:42:35'),
(18, 17, 5, 6, '2018-08-06 20:42:47', '2018-08-06 20:42:47'),
(19, 17, 5, 7, '2018-08-06 20:42:56', '2018-08-06 20:42:56'),
(20, 17, 5, 10, '2018-08-06 20:43:17', '2018-08-06 20:43:17'),
(21, 20, 5, 11, '2018-08-06 20:43:40', '2018-08-06 20:43:40'),
(22, 17, 1, 1, '2018-08-06 20:46:48', '2018-08-06 20:46:48'),
(23, 17, 1, 2, '2018-08-06 20:46:55', '2018-08-06 20:46:55'),
(24, 17, 1, 3, '2018-08-06 20:47:00', '2018-08-06 20:47:00'),
(25, 17, 1, 4, '2018-08-06 20:47:08', '2018-08-06 20:47:08'),
(26, 17, 1, 5, '2018-08-06 20:47:18', '2018-08-06 20:47:18'),
(27, 17, 1, 6, '2018-08-06 20:47:36', '2018-08-06 20:47:36'),
(28, 17, 1, 7, '2018-08-06 20:48:07', '2018-08-06 20:48:07'),
(29, 17, 1, 8, '2018-08-06 20:50:01', '2018-08-06 20:50:01'),
(30, 17, 1, 10, '2018-08-06 20:50:13', '2018-08-06 20:50:13'),
(31, 20, 1, 11, '2018-08-06 20:50:19', '2018-08-06 20:50:19'),
(32, 23, 2, 1, '2018-08-06 20:52:20', '2018-08-06 20:52:20'),
(33, 23, 2, 2, '2018-08-06 20:52:26', '2018-08-06 20:52:26'),
(34, 23, 2, 3, '2018-08-06 20:52:33', '2018-08-06 20:52:33'),
(35, 23, 2, 4, '2018-08-06 20:52:43', '2018-08-06 20:52:43'),
(36, 23, 2, 5, '2018-08-06 20:52:49', '2018-08-06 20:52:49'),
(37, 23, 2, 6, '2018-08-06 20:53:04', '2018-08-06 20:53:04'),
(38, 23, 2, 7, '2018-08-06 20:53:10', '2018-08-06 20:53:10'),
(39, 23, 2, 8, '2018-08-06 20:53:17', '2018-08-06 20:53:17'),
(40, 23, 2, 10, '2018-08-06 20:53:25', '2018-08-06 20:53:25'),
(41, 26, 2, 11, '2018-08-06 20:53:38', '2018-08-06 20:53:38'),
(42, 11, 3, 1, '2018-08-06 20:54:12', '2018-08-06 20:54:12'),
(43, 11, 3, 2, '2018-08-06 20:54:18', '2018-08-06 20:54:18'),
(44, 11, 3, 3, '2018-08-06 20:54:35', '2018-08-06 20:54:35'),
(45, 11, 3, 4, '2018-08-06 20:54:41', '2018-08-06 20:54:41'),
(46, 11, 3, 5, '2018-08-06 20:54:48', '2018-08-06 20:54:48'),
(47, 11, 3, 6, '2018-08-06 20:54:55', '2018-08-06 20:54:55'),
(48, 11, 3, 7, '2018-08-06 20:55:09', '2018-08-06 20:55:09'),
(49, 11, 3, 8, '2018-08-06 20:55:23', '2018-08-06 20:55:23'),
(50, 11, 3, 10, '2018-08-06 20:55:30', '2018-08-06 20:55:30'),
(51, 12, 3, 11, '2018-08-06 20:55:43', '2018-08-06 20:55:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_type`
--

CREATE TABLE `room_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `alphabet` char(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `room_type`
--

INSERT INTO `room_type` (`id`, `alphabet`, `created_at`, `updated_at`) VALUES
(1, 'A', NULL, NULL),
(2, 'B', NULL, NULL),
(3, 'C', NULL, NULL),
(4, 'D', NULL, NULL),
(5, 'E', NULL, NULL),
(6, 'F', NULL, NULL),
(7, 'G', NULL, NULL),
(8, 'H', NULL, NULL),
(9, 'I', NULL, NULL),
(10, 'J', NULL, NULL),
(11, 'K', NULL, NULL),
(12, 'L', NULL, NULL),
(13, 'M', NULL, NULL),
(14, 'N', NULL, NULL),
(15, 'O', NULL, NULL),
(16, 'P', NULL, NULL),
(17, 'Q', NULL, NULL),
(18, 'R', NULL, NULL),
(19, 'S', NULL, NULL),
(20, 'T', NULL, NULL),
(21, 'U', NULL, NULL),
(22, 'V', NULL, NULL),
(23, 'W', NULL, NULL),
(24, 'X', NULL, NULL),
(25, 'Y', NULL, NULL),
(26, 'Z', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `socials`
--

CREATE TABLE `socials` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `provider_user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `socials`
--

INSERT INTO `socials` (`id`, `user_id`, `provider_user_id`, `provider`, `created_at`, `updated_at`) VALUES
(6, 337, '105075095229798435250', 'google', '2018-07-16 02:23:26', '2018-07-16 02:23:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'laravel', '2018-07-18 02:21:58', '2018-07-18 02:21:58'),
(2, 'news', '2018-07-18 02:21:58', '2018-07-18 02:21:58'),
(3, '', '2018-07-18 02:23:05', '2018-07-18 02:23:05'),
(4, 'bacsa', '2018-07-18 02:25:41', '2018-07-18 02:25:41'),
(5, 'sssss', '2018-07-18 02:39:37', '2018-07-18 02:39:37'),
(6, 'hehe', '2018-07-18 02:43:18', '2018-07-18 02:43:18'),
(7, 'no', '2018-07-18 02:45:55', '2018-07-18 02:45:55'),
(8, 'hehehe', '2018-07-18 02:49:09', '2018-07-18 02:49:09'),
(9, 'losa', '2018-07-18 02:52:21', '2018-07-18 02:52:21'),
(10, 'keke', '2018-07-18 19:14:37', '2018-07-18 19:14:37'),
(11, 'kekes', '2018-07-18 19:14:37', '2018-07-18 19:14:37'),
(12, 'mumu', '2018-07-18 19:14:50', '2018-07-18 19:14:50'),
(13, 'xinchao', '2018-07-18 19:36:08', '2018-07-18 19:36:08'),
(14, 'kaka', '2018-07-18 20:33:00', '2018-07-18 20:33:00'),
(15, 'hello', '2018-07-20 00:54:11', '2018-07-20 00:54:11'),
(16, 'xxx', '2018-07-22 04:22:13', '2018-07-22 04:22:13'),
(17, '222', '2018-07-23 19:46:52', '2018-07-23 19:46:52'),
(18, 'he', '2018-07-28 06:43:20', '2018-07-28 06:43:20'),
(19, '333', '2018-07-29 04:36:03', '2018-07-29 04:36:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tickets`
--

CREATE TABLE `tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `vote_value_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `seat_numbers` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `vote_value_id`, `quantity`, `seat_numbers`) VALUES
(1, 1, 10, 10, NULL),
(2, 1, 10, 2, NULL),
(3, 1, 1, 2, NULL),
(5, 2, 1, 1, NULL),
(6, 2, 2, 4, NULL),
(7, 327, 1, 1, NULL),
(8, 330, 1, 4, NULL),
(9, 331, 1, 2, NULL),
(10, 3, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` bigint(10) DEFAULT NULL,
  `skype` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `birthday` date DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `group`, `job`, `phone`, `skype`, `address`, `birthday`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Maria', 'mrphong678@greenglobal.vn', '$2y$10$W8LwBa.ssDWimb8HDxawaOZ4QRUFVQGpaNgwv0Dpjfx8y5dVvW89u', 'PHP', 'DEV', 98303049522, 'phongluu', 'DuyXuyen', '2018-04-05', 'ScwOp8QDsaVpgwc3sTEC5EWlO52k0hV3JPoj9oVkuGCYyQVPFAYYsJQu8dJB', '2018-04-05 07:27:51', '2018-07-25 02:44:09'),
(2, 'daica2', 'lucky@greenglobal.vn', '$2y$10$7yqoQD7h6cviravuZkAjweQkUQXY8TYJv5iAECfuX4vaSoYFPN1Hy', 'PHP2', 'Dev2', 9830304952, 'luckybot2', 'Tra Kieu2', '1998-02-10', NULL, '2018-07-11 01:36:51', '2018-07-11 01:57:20'),
(3, 'havi23', 'havi@greenglobal.vn', '$2y$10$o2XiApzyGTMzKslETNcn7OMCpUAHWD4UbuZuVrNLSgHmLQ9QR2Y0y', 'java3', 'java3', 123777893, 'havi3', 'tamkt3', '1212-01-01', 'RiolJLyh2MBtDpWepLDgZQdAYx7IS8vbe48m8qc8aSxsYvbA6xpCzL4tCi36', '2018-07-11 02:11:32', '2018-07-11 02:12:38'),
(327, 'Phi2', 'lynhaky1a@greenglobal.vn', '$2y$10$6G7vAIXb9PhXgNzZAuGJ3uVjlJAJisBTJBkD7DhY8BdPht3qadc/6', 'PHP', 'Dev', 9383883, 'phili', 'tamky', '1330-07-25', 'zEm7S0DhLDeDDuN9sCtqaZo6QRWnTNhVTgVuK3Io4WraQCDaWqrNxDuWddl2', '2018-07-15 21:11:55', '2018-07-15 21:11:55'),
(329, 'Duc', 'hoangduck20@greenglobal.vn', '$2y$10$giZ7tkwzORLNsrcn2uYcceXB4A7D2WBKKgR3o1Ba0wgx.00Yc/rOq', 'Mobie', 'Senior', 893938, 'lysenior', 'danang', '1330-07-25', 'dhRf5UPTK8LpDm9YC24tmLfadAbiNKax9V0Z1Ed1hsuFHbPms84DZEZ9YbVh', '2018-07-15 21:11:55', '2018-07-15 21:11:55'),
(330, 'Anh', 'maianhchelsea0306@greenglobal.vn', '$2y$10$l0te35wQLExMZFiS4Cy88OJB.s/NFcrWbvvACpKvCGRWHcVOpeKd2', 'Mobie', 'Senior', 893938, 'lysenior', 'danang', '1330-07-25', 'jCU77R7pttLXMRlBVI8resrGoBmauqmme4kVL6WYP30jnJSnnDmJIPi4JSn4', '2018-07-15 21:11:56', '2018-07-15 21:11:56'),
(331, 'kiki4', 'okebaby701@greenglobal.vn', '$2y$10$8007aBB34ZHe5nHVhlf3XucUgiP7w.5cjkALVVBPHTGLHiR561dkS', 'PHP', 'Senior', 893938, 'lysenior', 'danang', '1330-07-25', 'Apolvi8K61shfOcAlaLICMM0JnHS4gywboJ48m4hycvIaQ9BNJkvnF8IOtMF', '2018-07-15 21:11:56', '2018-07-22 02:42:21'),
(337, 'Khanh Le Phuoc', 'khanhlp@greenglobal.vn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'zGC2HVZNklaUEIYoWtJpemoLjHmW4mrFprGbU5b2HuKo18Tk7ByK7LpL8Zb8', '2018-07-16 02:23:26', '2018-07-16 02:23:26'),
(338, 'Linhka', 'linhka@greenglobal.vn', '$2y$10$rIP4wEACzmUUTTG22UxiquuCsADXHUhpakADzz6PWXb1bQ8.60n4S', 'PHp', 'Dev', 98338388, 'kinh', 'Da Nang', '1998-11-11', NULL, '2018-08-12 19:52:05', '2018-08-12 19:52:05'),
(339, 'Doan Ca', 'doanca@greenglobal.vn', '$2y$10$ZqDtOgIX2t4hvb27Wqqkn.NNBcGmLk7VYpzwldRf6HkGHuZjxeYb.', 'Java', 'Dev', 182872727, 'Doanka', 'Da Nang', '1889-11-08', NULL, '2018-08-12 19:53:01', '2018-08-12 19:53:01'),
(340, 'Thuy Kieu', 'thuykieu@greenglobal.vn', '$2y$10$hBHqtxYjP3w2ml1LyxXZ0.fpy4tP5h59XHEp.aqeFBnKRUmMmB8nS', 'Font End', 'Dev', 78827288, 'End', 'Quang Nam', '1997-11-07', NULL, '2018-08-12 19:53:57', '2018-08-12 19:53:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `votes`
--

CREATE TABLE `votes` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `expiry_date` datetime NOT NULL,
  `expiry_date_ticket` datetime DEFAULT NULL,
  `winner_id` int(11) DEFAULT NULL,
  `allow_update` tinyint(4) NOT NULL DEFAULT '1',
  `analytics` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `votes`
--

INSERT INTO `votes` (`id`, `question`, `month`, `type`, `expiry_date`, `expiry_date_ticket`, `winner_id`, `allow_update`, `analytics`, `created_at`, `updated_at`) VALUES
(1, 'Film thang 8', 8, 2, '2018-08-20 06:08:00', '2018-08-20 00:00:00', NULL, 1, 0, '2018-08-26 01:21:27', '2018-08-24 00:24:42'),
(2, 'film thang 6', 6, 1, '2222-02-24 14:02:00', NULL, NULL, 1, 0, '2018-06-26 01:24:22', '2018-06-26 19:51:43'),
(3, 'fim thang 4', 4, 1, '1998-01-01 01:01:00', NULL, NULL, 1, 0, '2018-04-26 18:21:28', '2018-04-26 19:51:57'),
(4, 'Fim thang 5', 5, 1, '0001-01-01 01:01:00', NULL, NULL, 0, 0, '2018-05-26 19:32:05', '2018-05-26 19:46:01'),
(6, 'Film tháng 1', 1, 1, '2018-12-11 14:02:00', '2018-12-12 00:12:00', NULL, 1, 0, '2018-08-19 23:42:25', '2018-08-23 21:32:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vote_value`
--

CREATE TABLE `vote_value` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vote_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vote_value`
--

INSERT INTO `vote_value` (`id`, `name`, `link`, `address`, `start_time`, `image`, `vote_id`, `created_at`, `updated_at`) VALUES
(1, 'Nhiệm Vụ Bất Khả Thi: Sụp Đổ', 'https://www.cgv.vn/default/mamma-mia-yeu-lan-nua.html', 'Da nang', '2018-01-08 18:00:00', 'nm4FXHbZxWZG7d0Uxd5OUlMQQTk5wF4kzyPmxkor.jpeg', 1, '2018-07-25 02:24:29', '2018-08-14 00:01:17'),
(2, 'Mamma Mia! Yêu Lần Nữa', 'http://green1.vn/vote_value/index2', 'Da nang CGV', '2018-05-08 20:00:00', 'FOWMkE24CS5vluInfQxdbQIOG2Uw6zLsPBAAGt7g.jpeg', 1, '2018-07-26 01:50:52', '2018-07-30 21:25:47'),
(7, 'Hoat hinh mirana', 'http://green1.vn/votes', 'Da nang', '2019-11-01 00:22:00', '69mnMcUbyGxpAyP82RJwsQ8zWCcMwZn5W4gs0V9w.jpeg', 3, '2018-07-26 18:40:37', '2018-07-30 21:20:41'),
(8, 'Biet doi anh hung', 'http://green1.vn/votes', '', NULL, 'UbWvXTP3CsjmpnzXi6gwd3ZcuVscupdSmoRLrYoR.jpeg', 4, '2018-07-26 19:47:52', '2018-07-26 19:47:52'),
(9, 'Quái Thú Rừng Sâu', 'http://green1.vn/votes', 'Hung Vuong', '2018-09-08 19:00:00', 'UGQ0M0dNwMfpiZlnyMpLza4PStClV7wpjflVepvt.jpeg', 1, '2018-07-26 20:04:49', '2018-07-30 21:28:21'),
(10, 'Thám Tử Gà Mơ: Bộ Ba Khó Đỡ', 'http://green1.vn/votes', 'Tran Phu', '2018-10-08 19:00:00', 'fP0yd1bpWEpbGuuJCx7PSiX23i1BEVJdslrZr1vp.jpeg', 1, '2018-07-26 21:33:02', '2018-07-30 21:28:44'),
(12, 'Biệt đội nhí', 'http://green1.vn/votes', '', NULL, 'dTLhjUpzYxhsR4HIuglWjS2PuEczK5sfEQjynkDw.jpeg', 4, '2018-07-29 21:48:23', '2018-07-30 00:03:54'),
(14, 'Quảng tường', 'https://www.youtube.com/watch?v=lGbzyKWkiio&index=10&list=RD5WN19l18Eo8', 'Quảng trường thời đại', '2019-01-01 01:01:00', 'i5i05p2iEfpl8yxH9lBFdHFMYvc2QhL33HrqWa2s.jpeg', 3, '2018-07-30 20:30:41', '2018-07-30 20:30:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vote_value_user`
--

CREATE TABLE `vote_value_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `vote_value_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vote_value_user`
--

INSERT INTO `vote_value_user` (`id`, `vote_value_id`, `user_id`) VALUES
(8, 1, 329),
(9, 2, 329),
(11, 1, 327),
(12, 2, 327),
(13, 9, 327),
(14, 10, 327),
(20, 9, 331),
(21, 10, 331),
(22, 3, 331),
(35, 1, 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `booking_seat`
--
ALTER TABLE `booking_seat`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cinemas`
--
ALTER TABLE `cinemas`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `dashboard_repositories`
--
ALTER TABLE `dashboard_repositories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Chỉ mục cho bảng `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `post_repositories`
--
ALTER TABLE `post_repositories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `repository_interfaces`
--
ALTER TABLE `repository_interfaces`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Chỉ mục cho bảng `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `room_settings`
--
ALTER TABLE `room_settings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_type_alphabet_unique` (`alphabet`);

--
-- Chỉ mục cho bảng `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vote_value`
--
ALTER TABLE `vote_value`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vote_value_user`
--
ALTER TABLE `vote_value_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `booking_seat`
--
ALTER TABLE `booking_seat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `cinemas`
--
ALTER TABLE `cinemas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `dashboard_repositories`
--
ALTER TABLE `dashboard_repositories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `post_repositories`
--
ALTER TABLE `post_repositories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT cho bảng `repository_interfaces`
--
ALTER TABLE `repository_interfaces`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `room_settings`
--
ALTER TABLE `room_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `room_type`
--
ALTER TABLE `room_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `socials`
--
ALTER TABLE `socials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=341;

--
-- AUTO_INCREMENT cho bảng `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `vote_value`
--
ALTER TABLE `vote_value`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `vote_value_user`
--
ALTER TABLE `vote_value_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

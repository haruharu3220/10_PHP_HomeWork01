-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2023 年 2 月 04 日 04:48
-- サーバのバージョン： 10.4.27-MariaDB
-- PHP のバージョン: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `favorite_house`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `discussions`
--

CREATE TABLE `discussions` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `facilities`
--

INSERT INTO `facilities` (`id`, `category_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'キッチン', '2023-02-03', '2023-02-03', NULL),
(2, 'トイレ', '2023-02-03', '2023-02-03', NULL),
(3, '風呂', '2023-02-03', '2023-02-03', NULL),
(4, '洗面台', '2023-02-03', '2023-02-03', NULL),
(5, '小上がり和室', '2023-02-03', '2023-02-03', NULL),
(6, 'ファミクロ', '2023-02-03', '2023-02-03', NULL),
(7, 'パンドリー', '2023-02-03', '2023-02-03', NULL),
(8, '書斎', '2023-02-03', '2023-02-03', NULL),
(9, '子供部屋', '2023-02-03', '2023-02-03', NULL),
(10, '寝室', '2023-02-03', '2023-02-03', NULL),
(11, 'バルコニー', '2023-02-03', '2023-02-03', NULL),
(12, 'リビング階段', '2023-02-03', '2023-02-03', NULL),
(13, '吹き抜け', '2023-02-03', '2023-02-03', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `houses`
--

CREATE TABLE `houses` (
  `id` int(11) NOT NULL,
  `house_name` varchar(50) NOT NULL,
  `scheduled_completion_date` date NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `houses`
--

INSERT INTO `houses` (`id`, `house_name`, `scheduled_completion_date`, `status_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '山本', '2023-04-04', 1, '2023-01-25 19:51:41', '2023-01-25 19:51:41', NULL),
(2, '田中', '2023-05-04', 2, '2023-01-25 19:52:23', '2023-01-25 19:52:23', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `houses_categories`
--

CREATE TABLE `houses_categories` (
  `id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `scheduled_completion_date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `ideas`
--

CREATE TABLE `ideas` (
  `id` int(11) NOT NULL,
  `idea_content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `images`
--

CREATE TABLE `images` (
  `house_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `filepath` varchar(1000) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `images`
--

INSERT INTO `images` (`house_id`, `image_id`, `filename`, `filepath`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '202301261733571674740589318.jpg', '/Applications/XAMPP/xamppfiles/htdocs/10_PHP_HomeWork01/images/202301261733571674740589318.jpg', 1, '2023-01-27 01:33:57', '2023-01-27 01:33:57', NULL),
(1, 2, '202301261733201674740571067.jpg', '/Applications/XAMPP/xamppfiles/htdocs/10_PHP_HomeWork01/images/202301261733201674740571067.jpg', 1, '2023-01-27 01:33:20', '2023-01-27 01:33:20', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `images_impressions`
--

CREATE TABLE `images_impressions` (
  `id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `impression_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `impressions`
--

CREATE TABLE `impressions` (
  `id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `impression` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `members`
--

INSERT INTO `members` (`id`, `house_id`, `name`, `email`, `sex`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 1, 'admin01', 'admin01', 'male', 'Admin01', '2023-02-04 03:31:47', '2023-02-04 03:31:47', NULL),
(7, 1, 'admin02', 'admin02', 'female', 'Admin02', '2023-02-04 03:32:08', '2023-02-04 03:32:08', NULL),
(8, 1, 'admin03', 'admin03', 'male', 'Admin03', '2023-02-04 03:32:54', '2023-02-04 03:32:54', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `members_facilities`
--

CREATE TABLE `members_facilities` (
  `id` int(11) NOT NULL,
  `name_id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `members_facilities`
--

INSERT INTO `members_facilities` (`id`, `name_id`, `facility_id`, `created_at`) VALUES
(46, 1, 9, '2023-02-04 01:55:41'),
(47, 1, 10, '2023-02-04 02:01:20'),
(63, 1, 2, '2023-02-04 02:30:25'),
(70, 6, 1, '2023-02-04 04:08:03'),
(71, 6, 2, '2023-02-04 04:08:04'),
(74, 6, 3, '2023-02-04 04:08:28'),
(75, 6, 6, '2023-02-04 04:38:27'),
(76, 6, 4, '2023-02-04 04:38:29'),
(81, 6, 5, '2023-02-04 06:01:03');

-- --------------------------------------------------------

--
-- テーブルの構造 `members_ideas`
--

CREATE TABLE `members_ideas` (
  `id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `position` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `state` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `task_title` varchar(100) NOT NULL,
  `status_id` int(11) NOT NULL,
  `task_content` text NOT NULL,
  `house_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `discussions`
--
ALTER TABLE `discussions`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `houses_categories`
--
ALTER TABLE `houses_categories`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `ideas`
--
ALTER TABLE `ideas`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`house_id`,`image_id`);

--
-- テーブルのインデックス `images_impressions`
--
ALTER TABLE `images_impressions`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `members_facilities`
--
ALTER TABLE `members_facilities`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `members_ideas`
--
ALTER TABLE `members_ideas`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `discussions`
--
ALTER TABLE `discussions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- テーブルの AUTO_INCREMENT `houses`
--
ALTER TABLE `houses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `houses_categories`
--
ALTER TABLE `houses_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `ideas`
--
ALTER TABLE `ideas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `images_impressions`
--
ALTER TABLE `images_impressions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- テーブルの AUTO_INCREMENT `members_facilities`
--
ALTER TABLE `members_facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- テーブルの AUTO_INCREMENT `members_ideas`
--
ALTER TABLE `members_ideas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

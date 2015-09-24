-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015 年 9 月 24 日 19:25
-- サーバのバージョン： 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tech_news`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'ニュース'),
(2, 'コラム'),
(3, '連載');

-- --------------------------------------------------------

--
-- テーブルの構造 `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `post_title` varchar(128) NOT NULL,
  `post_detail` varchar(12800) NOT NULL,
  `post_image` varchar(128) DEFAULT NULL,
  `show_flg` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `poster_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `post`
--

INSERT INTO `post` (`post_id`, `category_id`, `post_title`, `post_detail`, `post_image`, `show_flg`, `create_date`, `update_date`, `poster_id`, `subcategory_id`) VALUES
(1, 1, 'ニュース１', 'ニュース１詳細', NULL, 1, '2015-09-23 11:15:51', '2015-09-23 11:15:51', 1, NULL),
(2, 1, 'ニュース２', 'ニュース２詳細', NULL, 1, '2015-09-23 11:17:15', '2015-09-23 11:17:15', 2, NULL),
(3, 2, 'コラム１', 'コラム１詳細', NULL, 1, '2015-09-23 11:18:00', '2015-09-23 11:18:00', 1, NULL),
(4, 2, 'コラム２', 'コラム２詳細', NULL, 1, '2015-09-25 01:26:33', '2015-09-25 01:26:33', 3, NULL),
(5, 1, 'ニュース３', 'ニュース３詳細', NULL, 1, '2015-09-25 01:27:42', '2015-09-25 01:27:42', 4, NULL),
(6, 2, 'コラム３', 'コラム３詳細', NULL, 1, '2015-09-25 01:28:55', '2015-09-25 01:28:55', 2, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `poster`
--

CREATE TABLE IF NOT EXISTS `poster` (
  `poster_id` int(11) NOT NULL,
  `poster_name` varchar(128) NOT NULL,
  `poster_image` varchar(128) DEFAULT NULL,
  `poster_detail` varchar(1280) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `poster`
--

INSERT INTO `poster` (`poster_id`, `poster_name`, `poster_image`, `poster_detail`) VALUES
(1, 'ともみ', NULL, NULL),
(2, 'やすなり', NULL, NULL),
(3, 'あすな', NULL, NULL),
(4, 'かんた', NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `post_tag`
--

CREATE TABLE IF NOT EXISTS `post_tag` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `post_tag`
--

INSERT INTO `post_tag` (`post_id`, `tag_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 3);

-- --------------------------------------------------------

--
-- テーブルの構造 `pv`
--

CREATE TABLE IF NOT EXISTS `pv` (
  `post_id` int(11) NOT NULL,
  `pv_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `pv`
--

INSERT INTO `pv` (`post_id`, `pv_date`) VALUES
(3, '2015-09-24 03:12:42'),
(2, '2015-09-24 03:12:49'),
(1, '2015-09-24 03:12:50'),
(2, '2015-09-24 03:12:52'),
(3, '2015-09-24 03:12:53'),
(1, '2015-09-24 03:32:24'),
(1, '2015-09-24 03:32:30'),
(1, '2015-09-24 03:32:30'),
(1, '2015-09-24 03:32:31'),
(2, '2015-09-24 03:49:32'),
(2, '2015-09-24 03:49:39'),
(2, '2015-09-24 03:49:41'),
(2, '2015-09-24 03:49:44'),
(2, '2015-09-24 03:49:46'),
(2, '2015-09-24 03:50:51'),
(2, '2015-09-24 03:51:16'),
(3, '2015-09-24 03:57:57'),
(1, '2015-09-24 03:58:01'),
(1, '2015-09-24 03:58:24'),
(1, '2015-09-24 04:00:11'),
(3, '2015-09-24 04:03:46'),
(3, '2015-09-24 10:58:37'),
(0, '2015-09-24 14:39:49'),
(0, '2015-09-24 14:40:36'),
(0, '2015-09-24 14:40:40'),
(3, '2015-09-24 14:42:17'),
(2, '2015-09-24 14:42:41'),
(2, '2015-09-24 14:42:47'),
(3, '2015-09-24 14:55:57'),
(2, '2015-09-24 14:56:21'),
(3, '2015-09-24 14:56:25'),
(1, '2015-09-24 14:56:30'),
(1, '2015-09-24 14:56:34'),
(3, '2015-09-24 14:59:39'),
(2, '2015-09-24 14:59:41'),
(1, '2015-09-24 14:59:42'),
(2, '2015-09-24 14:59:43'),
(1, '2015-09-24 14:59:44'),
(3, '2015-09-24 14:59:46'),
(1, '2015-09-24 14:59:48'),
(1, '2015-09-24 14:59:49'),
(1, '2015-09-24 14:59:51'),
(3, '2015-09-24 14:59:54'),
(3, '2015-09-24 14:59:55'),
(3, '2015-09-24 14:59:58'),
(3, '2015-09-24 15:00:00'),
(1, '2015-09-24 15:36:33'),
(3, '2015-09-25 00:03:45'),
(3, '2015-09-25 00:08:45'),
(3, '2015-09-25 00:09:43'),
(3, '2015-09-25 00:10:24'),
(3, '2015-09-25 00:12:58'),
(3, '2015-09-25 00:15:26'),
(3, '2015-09-25 00:22:58'),
(3, '2015-09-25 00:23:46'),
(3, '2015-09-25 00:25:26'),
(1, '2015-09-25 00:26:00'),
(3, '2015-09-25 00:32:21'),
(1, '2015-09-25 00:32:24'),
(1, '2015-09-25 00:33:54'),
(3, '2015-09-25 00:48:46'),
(3, '2015-09-25 00:49:35'),
(3, '2015-09-25 00:53:54'),
(2, '2015-09-25 00:55:49'),
(3, '2015-09-25 00:55:53'),
(1, '2015-09-25 00:55:59'),
(2, '2015-09-25 00:56:00'),
(3, '2015-09-25 00:56:02'),
(2, '2015-09-25 00:56:04'),
(1, '2015-09-25 00:56:14'),
(3, '2015-09-25 01:08:30'),
(2, '2015-09-25 01:15:58'),
(2, '2015-09-25 01:16:24'),
(6, '2015-09-25 01:32:27'),
(6, '2015-09-25 01:32:49'),
(6, '2015-09-25 01:39:10'),
(1, '2015-09-25 01:39:18'),
(1, '2015-09-25 01:41:26'),
(1, '2015-09-25 01:41:37'),
(1, '2015-09-25 01:41:51'),
(1, '2015-09-25 01:41:58'),
(1, '2015-09-25 01:43:14'),
(1, '2015-09-25 01:43:28'),
(1, '2015-09-25 01:44:01'),
(1, '2015-09-25 01:44:13'),
(1, '2015-09-25 01:44:53'),
(1, '2015-09-25 01:45:26'),
(1, '2015-09-25 01:45:36'),
(1, '2015-09-25 01:46:01'),
(1, '2015-09-25 01:46:11'),
(1, '2015-09-25 01:47:19'),
(1, '2015-09-25 01:47:39'),
(1, '2015-09-25 01:50:57'),
(1, '2015-09-25 01:51:49'),
(1, '2015-09-25 01:52:06'),
(1, '2015-09-25 01:52:53'),
(1, '2015-09-25 01:54:20'),
(1, '2015-09-25 01:54:44'),
(1, '2015-09-25 01:55:20'),
(1, '2015-09-25 01:56:03'),
(1, '2015-09-25 01:57:11'),
(1, '2015-09-25 01:57:46'),
(2, '2015-09-25 01:59:06'),
(5, '2015-09-25 01:59:21'),
(4, '2015-09-25 01:59:36'),
(1, '2015-09-25 02:00:12'),
(4, '2015-09-25 02:00:15'),
(4, '2015-09-25 02:00:21'),
(4, '2015-09-25 02:00:22'),
(4, '2015-09-25 02:00:24'),
(4, '2015-09-25 02:00:27'),
(4, '2015-09-25 02:00:30'),
(4, '2015-09-25 02:00:32'),
(4, '2015-09-25 02:00:35'),
(4, '2015-09-25 02:00:37'),
(4, '2015-09-25 02:00:39'),
(4, '2015-09-25 02:00:41'),
(4, '2015-09-25 02:00:43'),
(4, '2015-09-25 02:00:44'),
(4, '2015-09-25 02:00:46'),
(6, '2015-09-25 02:02:59'),
(2, '2015-09-25 02:03:03'),
(2, '2015-09-25 02:03:34'),
(2, '2015-09-25 02:03:42'),
(2, '2015-09-25 02:04:06'),
(2, '2015-09-25 02:04:15'),
(2, '2015-09-25 02:05:05'),
(2, '2015-09-25 02:05:21'),
(2, '2015-09-25 02:05:42'),
(2, '2015-09-25 02:07:09'),
(2, '2015-09-25 02:08:11'),
(2, '2015-09-25 02:08:53'),
(2, '2015-09-25 02:09:24'),
(2, '2015-09-25 02:09:38'),
(2, '2015-09-25 02:09:50'),
(2, '2015-09-25 02:10:20'),
(2, '2015-09-25 02:11:02'),
(2, '2015-09-25 02:11:38'),
(2, '2015-09-25 02:12:15'),
(2, '2015-09-25 02:12:32'),
(2, '2015-09-25 02:12:46'),
(2, '2015-09-25 02:13:19'),
(6, '2015-09-25 02:13:50'),
(2, '2015-09-25 02:13:54'),
(1, '2015-09-25 02:13:59'),
(3, '2015-09-25 02:14:07'),
(1, '2015-09-25 02:14:25'),
(1, '2015-09-25 02:15:56'),
(1, '2015-09-25 02:16:11'),
(6, '2015-09-25 02:18:31'),
(6, '2015-09-25 02:19:43'),
(4, '2015-09-25 02:20:20'),
(3, '2015-09-25 02:20:22'),
(5, '2015-09-25 02:22:13');

-- --------------------------------------------------------

--
-- テーブルの構造 `subcategory`
--

CREATE TABLE IF NOT EXISTS `subcategory` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_name` varchar(128) NOT NULL,
  `subcategory_image` varchar(128) NOT NULL,
  `subcategory_detail` varchar(1280) NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `tag`
--

INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES
(1, 'HTML5'),
(2, 'CSS3'),
(3, 'JavaScript'),
(4, 'PHP');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `poster`
--
ALTER TABLE `poster`
  ADD PRIMARY KEY (`poster_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`subcategory_id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tag_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `poster`
--
ALTER TABLE `poster`
  MODIFY `poster_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

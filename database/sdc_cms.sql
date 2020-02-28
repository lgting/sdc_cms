-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2020-02-28 01:43:21
-- 服务器版本： 5.7.24
-- PHP 版本： 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `sdc_cms`
--

-- --------------------------------------------------------

--
-- 表的结构 `sdc_articles`
--

CREATE TABLE `sdc_articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `column_id` int(10) UNSIGNED NOT NULL COMMENT '所属栏目',
  `model_id` int(10) UNSIGNED NOT NULL COMMENT '所属模型',
  `title` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '标题',
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '关键字',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT '简介',
  `content` longtext COLLATE utf8mb4_unicode_ci COMMENT '内容',
  `author` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '作者',
  `source` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '来源',
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '缩略图',
  `attributes` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '属性',
  `clicks` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '点击量',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `sdc_articles`
--

INSERT INTO `sdc_articles` (`id`, `column_id`, `model_id`, `title`, `keywords`, `description`, `content`, `author`, `source`, `thumb`, `attributes`, `clicks`, `created_at`, `updated_at`) VALUES
(5, 1, 14, '测试', NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, '2020-02-13 07:19:45', '2020-02-13 07:19:45'),
(6, 9, 15, '左耳', NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, '2020-02-13 07:29:09', '2020-02-13 07:29:09'),
(7, 9, 15, '悲伤逆流成河', '悲伤', '悲伤逆流成河的简介', '<p>呵呵呵</p>', '郑兴', '网络', 'articles/20200213/gLJgyAg5aF.jpeg', '0|2|3', 0, '2020-02-13 08:06:14', '2020-02-13 08:28:15'),
(8, 1, 14, 'QQ', NULL, NULL, NULL, NULL, NULL, NULL, '0|1', 0, '2020-02-13 08:35:37', '2020-02-13 10:18:01'),
(9, 9, 15, '只有云知道', NULL, NULL, NULL, NULL, NULL, NULL, '0', 0, '2020-02-16 07:38:58', '2020-02-16 07:38:58');

-- --------------------------------------------------------

--
-- 表的结构 `sdc_columns`
--

CREATE TABLE `sdc_columns` (
  `id` int(10) UNSIGNED NOT NULL,
  `model_id` smallint(5) UNSIGNED DEFAULT NULL COMMENT '模型',
  `parent_id` int(10) UNSIGNED DEFAULT NULL COMMENT '上级栏目',
  `name` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '栏目名称',
  `status` tinyint(3) UNSIGNED NOT NULL COMMENT '栏目状态',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '栏目图片',
  `attributes` tinyint(3) UNSIGNED DEFAULT NULL COMMENT '栏目属性',
  `channel_template` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '频道模板',
  `list_template` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '列表模板',
  `content_template` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '内容模板',
  `redirect_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '跳转链接',
  `seo_title` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SEO标题',
  `seo_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SEO关键字',
  `seo_description` text COLLATE utf8mb4_unicode_ci COMMENT 'SEO简介',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '栏目内容',
  `sortable` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `sdc_columns`
--

INSERT INTO `sdc_columns` (`id`, `model_id`, `parent_id`, `name`, `status`, `image`, `attributes`, `channel_template`, `list_template`, `content_template`, `redirect_url`, `seo_title`, `seo_keywords`, `seo_description`, `content`, `sortable`, `created_at`, `updated_at`) VALUES
(1, 14, 0, '国内新闻', 0, NULL, 0, 'channel.blade.php', 'list.blade.php', 'content.blade.php', 'http://baidu.com', '1', '2', '3', '<p>hellp</p>', 0, '2020-01-19 03:51:10', '2020-02-09 13:36:52'),
(7, 0, 1, '甘肃新闻', 0, NULL, 0, 'channel.blade.php', 'list.blade.php', 'content.blade.php', NULL, NULL, NULL, NULL, NULL, 0, '2020-02-02 03:19:18', '2020-02-02 03:19:18'),
(8, 0, 1, '青海新闻', 0, 'columns/20200205/jgPBi9kxfp.jpeg', 0, 'channel.blade.php', NULL, 'content.blade.php', NULL, NULL, NULL, NULL, '<p>{! $item-&gt;content !}</p>', 0, '2020-02-02 14:02:29', '2020-02-05 04:30:24'),
(9, 15, 8, '西宁市新闻', 0, NULL, 0, 'channel.blade.php', 'list.blade.php', 'content.blade.php', NULL, NULL, NULL, NULL, NULL, 0, '2020-02-05 04:45:46', '2020-02-13 07:28:08'),
(10, 0, 8, '海东市新闻', 0, 'columns/20200205/sl0Hxclknb.png', 0, 'channel.blade.php', 'list.blade.php', 'content.blade.php', 'http://', NULL, NULL, NULL, NULL, 0, '2020-02-05 09:43:46', '2020-02-05 09:44:57'),
(11, 14, 0, '下载站', 0, NULL, 0, 'channel.blade.php', 'list.blade.php', 'content.blade.php', 'http://', NULL, NULL, NULL, NULL, 0, '2020-02-26 06:05:22', '2020-02-26 06:05:22'),
(12, 14, 11, '娱乐软件', 0, NULL, 0, 'channel.blade.php', 'list.blade.php', 'content.blade.php', 'http://', NULL, NULL, NULL, NULL, 0, '2020-02-26 06:05:41', '2020-02-26 06:05:41');

-- --------------------------------------------------------

--
-- 表的结构 `sdc_configs`
--

CREATE TABLE `sdc_configs` (
  `id` int(10) UNSIGNED NOT NULL,
  `zh_name` varchar(65) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '中文名称',
  `en_name` varchar(65) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '英文名称',
  `value` text COLLATE utf8mb4_unicode_ci COMMENT '默认值',
  `values` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '可选值',
  `data_type` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '数据类型',
  `config_type` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '配置类型',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `sdc_configs`
--

INSERT INTO `sdc_configs` (`id`, `zh_name`, `en_name`, `value`, `values`, `data_type`, `config_type`, `created_at`, `updated_at`) VALUES
(4, '网站名称', 'web_name', '闪电橙工作室', NULL, 0, 0, '2020-01-15 07:52:46', '2020-01-17 06:39:58'),
(5, '联系电话', 'contact', '15500785170', NULL, 0, 1, '2020-01-15 08:05:30', '2020-01-17 06:39:59'),
(6, '网站Logo', 'web_logp', 'configs/20200117/6CX5uuCevl.jpeg', NULL, 5, 0, '2020-01-15 23:41:43', '2020-01-17 06:39:59'),
(7, '网站备案', 'web_filing', '沙雕', NULL, 4, 0, '2020-01-15 23:43:53', '2020-01-17 06:39:59'),
(8, '网站开关', 'web_switch', '0', '开启|关闭', 1, 0, '2020-01-15 23:45:22', '2020-01-17 06:39:59'),
(9, '复选框测试', 'checkbox_test', '1|2', '橙子|橘子|李子', 2, 2, '2020-01-15 23:47:24', '2020-01-17 06:39:59'),
(10, 'QQ', 'qq', 'admin', NULL, 0, 1, '2020-01-15 23:48:22', '2020-01-17 06:39:59'),
(11, '网站主题', 'web_theme', '3', 'default|blue|orange|yello', 3, 0, '2020-01-15 23:50:00', '2020-01-17 06:39:59'),
(12, '微信二维码', 'wechat_qr', 'configs/20200117/0OY76nRrxG.jpeg', NULL, 5, 0, '2020-01-17 06:32:22', '2020-01-17 06:39:59'),
(13, 'seo说明', 'seo_info', NULL, NULL, 0, 0, '2020-02-14 06:13:59', '2020-02-14 06:13:59');

-- --------------------------------------------------------

--
-- 表的结构 `sdc_downloads`
--

CREATE TABLE `sdc_downloads` (
  `id` int(10) UNSIGNED NOT NULL,
  `article_id` int(10) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '下载外链',
  `speed_url` tinyint(3) UNSIGNED DEFAULT NULL COMMENT '高速下载',
  `download_function` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '下载方式',
  `download_agreement` tinyint(3) UNSIGNED DEFAULT NULL COMMENT '下载协议',
  `download_alert` text COLLATE utf8mb4_unicode_ci COMMENT '下载提示',
  `download_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '下载logo',
  `download_number` int(11) DEFAULT NULL COMMENT '种子数量',
  `file_size` decimal(8,2) DEFAULT NULL COMMENT '文件大小'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `sdc_downloads`
--

INSERT INTO `sdc_downloads` (`id`, `article_id`, `url`, `speed_url`, `download_function`, `download_agreement`, `download_alert`, `download_logo`, `download_number`, `file_size`) VALUES
(1, 5, 'http://', 1, '0|1', 0, '下载提示', 'articles/20200213/x7sbhJtrWu.jpeg', 10, '0.30'),
(2, 8, 'http://baidu.com', 1, '0|1|2', 2, '下载提示', NULL, 10, '12.00');

-- --------------------------------------------------------

--
-- 表的结构 `sdc_fields`
--

CREATE TABLE `sdc_fields` (
  `id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED DEFAULT NULL COMMENT '所属模型',
  `zh_name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '字段名',
  `en_name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '字段标识',
  `type` tinyint(3) UNSIGNED DEFAULT NULL COMMENT '字段类型',
  `values` text COLLATE utf8mb4_unicode_ci COMMENT '可选值',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `sdc_fields`
--

INSERT INTO `sdc_fields` (`id`, `model_id`, `zh_name`, `en_name`, `type`, `values`, `created_at`, `updated_at`) VALUES
(5, 15, '电影链接', 'film_link', 0, NULL, '2020-02-10 06:35:33', '2020-02-10 09:37:20'),
(6, 15, '电影封面', 'cover', 0, NULL, '2020-02-10 08:50:43', '2020-02-10 08:50:43'),
(7, 14, '下载外链', 'url', 0, 'http://', '2020-02-13 02:39:40', '2020-02-13 02:56:24'),
(8, 14, '高速下载', 'speed_url', 1, '开启|关闭', '2020-02-13 03:10:34', '2020-02-13 03:58:36'),
(9, 14, '下载方式', 'download_function', 2, '本地下载|迅雷下载|下载器下载', '2020-02-13 03:13:34', '2020-02-13 04:01:56'),
(11, 14, '下载协议', 'download_agreement', 7, 'ftp|http|种子', '2020-02-13 04:09:27', '2020-02-13 04:10:57'),
(12, 14, '下载提示', 'download_alert', 3, '下载提示', '2020-02-13 04:14:45', '2020-02-13 04:14:45'),
(13, 14, '下载logo', 'download_logo', 4, NULL, '2020-02-13 04:16:06', '2020-02-13 04:16:06'),
(14, 14, '种子数量', 'download_number', 5, '10', '2020-02-13 05:53:55', '2020-02-13 05:53:55'),
(15, 14, '文件大小', 'file_size', 6, '0.3', '2020-02-13 06:11:24', '2020-02-13 06:11:40'),
(16, 15, '电影剧情', 'movie_information', 8, NULL, '2020-02-16 07:35:33', '2020-02-16 07:37:36');

-- --------------------------------------------------------

--
-- 表的结构 `sdc_films`
--

CREATE TABLE `sdc_films` (
  `id` int(10) UNSIGNED NOT NULL,
  `article_id` int(10) UNSIGNED NOT NULL COMMENT '文章id',
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '电影封面',
  `film_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '电影链接',
  `movie_information` longtext COLLATE utf8mb4_unicode_ci COMMENT '电影剧情'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `sdc_films`
--

INSERT INTO `sdc_films` (`id`, `article_id`, `cover`, `film_link`, `movie_information`) VALUES
(1, 6, '哈哈', '哈哈', '<p>haha</p>'),
(2, 7, NULL, 'https://baidu.com', NULL),
(3, 9, NULL, NULL, '<p>我好难过啊</p>');

-- --------------------------------------------------------

--
-- 表的结构 `sdc_menus`
--

CREATE TABLE `sdc_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL COMMENT '父级',
  `sortable` int(10) UNSIGNED DEFAULT NULL COMMENT '排序',
  `title` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '名称',
  `icon` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '图标',
  `uri` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '路径',
  `permission` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '权限',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `sdc_menus`
--

INSERT INTO `sdc_menus` (`id`, `parent_id`, `sortable`, `title`, `icon`, `uri`, `permission`, `created_at`, `updated_at`) VALUES
(12, 0, 0, '网站配置', '&#xe6ae;', '/', '超级管理员', '2020-02-26 06:00:03', '2020-02-27 11:16:47'),
(13, 0, 0, '栏目管理', '&#xe699;', '/', NULL, '2020-02-26 06:00:30', '2020-02-26 06:33:58'),
(15, 0, 0, '模型管理', '&#xe6ce;', '/', NULL, '2020-02-26 06:00:54', '2020-02-26 06:56:50'),
(16, 12, 0, '配置列表', '&#xe6a7;', 'configs', NULL, '2020-02-26 06:01:53', '2020-02-26 06:31:40'),
(17, 12, 0, '配置管理', '&#xe6a7;', 'configs/edit', NULL, '2020-02-26 06:32:37', '2020-02-26 06:32:49'),
(18, 13, 0, '栏目列表', '&#xe6a7;', 'columns', NULL, '2020-02-26 06:33:23', '2020-02-26 06:33:23'),
(19, 15, 0, '模型列表', '&#xe6a7', 'models', NULL, '2020-02-26 06:34:43', '2020-02-27 07:40:23'),
(20, 15, 0, '字段列表', '&#xe6a7', 'fields', NULL, '2020-02-26 06:35:29', '2020-02-26 06:35:29'),
(21, 0, 0, '系统管理', '&#xe726;', '/', NULL, '2020-02-26 06:36:18', '2020-02-26 06:36:18'),
(22, 21, 0, '用户管理', '&#xe6a7;', 'users', NULL, '2020-02-26 06:37:37', '2020-02-26 06:37:37'),
(23, 21, 0, '角色管理', '&#xe6a7;', 'roles', NULL, '2020-02-26 06:38:05', '2020-02-26 06:38:05'),
(24, 21, 0, '权限管理', '&#xe6a7;', 'permissions', NULL, '2020-02-26 06:38:35', '2020-02-26 06:38:35'),
(25, 12, 0, '菜单管理', '&#xe6a7;', 'menus', NULL, '2020-02-26 06:39:21', '2020-02-26 06:56:28');

-- --------------------------------------------------------

--
-- 表的结构 `sdc_migrations`
--

CREATE TABLE `sdc_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `sdc_migrations`
--

INSERT INTO `sdc_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_01_14_181503_create_configs_table', 2),
(5, '2020_01_18_152056_create_columns_table', 3),
(6, '2020_01_19_113826_add_field_model_id_to_columns_table', 4),
(7, '2020_02_05_173607_add_field_redirect_url_to_columns_table', 5),
(8, '2020_02_06_160233_create_models_table', 6),
(9, '2020_02_10_104011_create_fields_table', 7),
(10, '2020_02_10_142059_rename_filed_table_to_models_table', 8),
(11, '2020_02_11_172105_create_articles_table', 9),
(12, '2020_02_18_112128_change_fields_to_users_table', 10),
(13, '2020_02_18_130747_add_field_remeber_token_to_users_table', 11),
(14, '2020_02_19_114039_create_permission_tables', 12),
(15, '2020_02_23_143044_add_fields_to_slug_to_permissions_table', 13),
(17, '2020_02_25_153804_create_menus_table', 14),
(18, '2020_02_26_105406_create_role_menu_table', 15);

-- --------------------------------------------------------

--
-- 表的结构 `sdc_models`
--

CREATE TABLE `sdc_models` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '模型名称',
  `table_name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '附加表名',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `sdc_models`
--

INSERT INTO `sdc_models` (`id`, `name`, `table_name`, `status`, `created_at`, `updated_at`) VALUES
(14, '下载模型', 'downloads', 1, '2020-02-09 13:08:07', '2020-02-09 13:18:15'),
(15, '电影模型', 'films', 1, '2020-02-10 06:34:44', '2020-02-10 06:34:44');

-- --------------------------------------------------------

--
-- 表的结构 `sdc_model_has_permissions`
--

CREATE TABLE `sdc_model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `sdc_model_has_permissions`
--

INSERT INTO `sdc_model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(4, 'App\\Models\\User', 1),
(5, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 7),
(4, 'App\\Models\\User', 7),
(5, 'App\\Models\\User', 7);

-- --------------------------------------------------------

--
-- 表的结构 `sdc_model_has_roles`
--

CREATE TABLE `sdc_model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `sdc_model_has_roles`
--

INSERT INTO `sdc_model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(13, 'App\\Models\\User', 1),
(12, 'App\\Models\\User', 7);

-- --------------------------------------------------------

--
-- 表的结构 `sdc_password_resets`
--

CREATE TABLE `sdc_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `sdc_permissions`
--

CREATE TABLE `sdc_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '标识',
  `http_methods` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '请求方法',
  `http_paths` text COLLATE utf8mb4_unicode_ci COMMENT '请求路径',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `sdc_permissions`
--

INSERT INTO `sdc_permissions` (`id`, `name`, `guard_name`, `slug`, `http_methods`, `http_paths`, `created_at`, `updated_at`) VALUES
(2, '栏目管理', 'web', NULL, 'GET|POST', '/columns*', '2020-02-21 05:55:21', '2020-02-23 07:09:18'),
(3, '文档管理', 'web', NULL, NULL, NULL, '2020-02-21 05:56:51', '2020-02-21 05:56:51'),
(4, '网站配置', 'web', NULL, 'GET|POST|PATCH|DELETE', '/\n/configs*', '2020-02-23 07:03:34', '2020-02-24 04:12:58'),
(5, '超级管理员', 'web', NULL, 'GET|POST|PATCH|DELETE', '*', '2020-02-23 07:10:27', '2020-02-23 07:10:27');

-- --------------------------------------------------------

--
-- 表的结构 `sdc_roles`
--

CREATE TABLE `sdc_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `sdc_roles`
--

INSERT INTO `sdc_roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, '管理员', 'web', '2020-02-20 03:54:33', '2020-02-20 03:54:33'),
(3, '栏目管理员', 'web', '2020-02-20 04:10:33', '2020-02-20 04:10:33'),
(12, '写作员', 'web', '2020-02-23 11:44:10', '2020-02-23 11:44:10'),
(13, '超级管理员', 'web', '2020-02-27 12:36:55', '2020-02-27 12:36:55');

-- --------------------------------------------------------

--
-- 表的结构 `sdc_role_has_permissions`
--

CREATE TABLE `sdc_role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `sdc_role_has_permissions`
--

INSERT INTO `sdc_role_has_permissions` (`permission_id`, `role_id`) VALUES
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(3, 3),
(5, 3),
(2, 12),
(3, 12),
(4, 12),
(5, 13);

-- --------------------------------------------------------

--
-- 表的结构 `sdc_role_menu`
--

CREATE TABLE `sdc_role_menu` (
  `menu_id` int(10) UNSIGNED NOT NULL COMMENT '菜单id',
  `role_id` int(10) UNSIGNED NOT NULL COMMENT '角色id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `sdc_role_menu`
--

INSERT INTO `sdc_role_menu` (`menu_id`, `role_id`, `created_at`, `updated_at`) VALUES
(12, 12, NULL, NULL),
(12, 13, NULL, NULL),
(13, 13, NULL, NULL),
(15, 13, NULL, NULL),
(21, 13, NULL, NULL),
(16, 13, NULL, NULL),
(16, 12, NULL, NULL),
(17, 13, NULL, NULL),
(25, 13, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `sdc_users`
--

CREATE TABLE `sdc_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '昵称',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `sdc_users`
--

INSERT INTO `sdc_users` (`id`, `name`, `nickname`, `password`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'admin', '飞翔的狗子', '$2y$10$b5b4PorLNiDbuKjn0UHh9e.F4gPxWT0hMIX3RPdbCrksRcgwaQwiq', NULL, '2020-02-18 06:53:04', 'OYeI3cBKUdEokyPKfB4J42GvQLRN6CGjNl4hwAVoLCDRG2im0TxnobhLylB5'),
(3, 'manager', '管理员', '$2y$10$WICdOQ16NgISjdA/uMfKl.Rnq/BOoG9bWBHmC57NooGrNUFFHh1uC', '2020-02-20 02:24:10', '2020-02-20 03:13:05', NULL),
(7, 'jack', 'jack', '$2y$10$bGFjilHhNbwEq2FCKsaF7usAczi1cWdBxCeNVWV29YmrNcvX22iGG', '2020-02-23 08:48:25', '2020-02-23 08:48:25', NULL);

--
-- 转储表的索引
--

--
-- 表的索引 `sdc_articles`
--
ALTER TABLE `sdc_articles`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sdc_columns`
--
ALTER TABLE `sdc_columns`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sdc_configs`
--
ALTER TABLE `sdc_configs`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sdc_downloads`
--
ALTER TABLE `sdc_downloads`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sdc_fields`
--
ALTER TABLE `sdc_fields`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sdc_films`
--
ALTER TABLE `sdc_films`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sdc_menus`
--
ALTER TABLE `sdc_menus`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sdc_migrations`
--
ALTER TABLE `sdc_migrations`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sdc_models`
--
ALTER TABLE `sdc_models`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sdc_model_has_permissions`
--
ALTER TABLE `sdc_model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- 表的索引 `sdc_model_has_roles`
--
ALTER TABLE `sdc_model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- 表的索引 `sdc_password_resets`
--
ALTER TABLE `sdc_password_resets`
  ADD KEY `sdc_password_resets_email_index` (`email`);

--
-- 表的索引 `sdc_permissions`
--
ALTER TABLE `sdc_permissions`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sdc_roles`
--
ALTER TABLE `sdc_roles`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `sdc_role_has_permissions`
--
ALTER TABLE `sdc_role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `sdc_role_has_permissions_role_id_foreign` (`role_id`);

--
-- 表的索引 `sdc_users`
--
ALTER TABLE `sdc_users`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `sdc_articles`
--
ALTER TABLE `sdc_articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用表AUTO_INCREMENT `sdc_columns`
--
ALTER TABLE `sdc_columns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用表AUTO_INCREMENT `sdc_configs`
--
ALTER TABLE `sdc_configs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用表AUTO_INCREMENT `sdc_downloads`
--
ALTER TABLE `sdc_downloads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `sdc_fields`
--
ALTER TABLE `sdc_fields`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- 使用表AUTO_INCREMENT `sdc_films`
--
ALTER TABLE `sdc_films`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `sdc_menus`
--
ALTER TABLE `sdc_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- 使用表AUTO_INCREMENT `sdc_migrations`
--
ALTER TABLE `sdc_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 使用表AUTO_INCREMENT `sdc_models`
--
ALTER TABLE `sdc_models`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用表AUTO_INCREMENT `sdc_permissions`
--
ALTER TABLE `sdc_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `sdc_roles`
--
ALTER TABLE `sdc_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用表AUTO_INCREMENT `sdc_users`
--
ALTER TABLE `sdc_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 限制导出的表
--

--
-- 限制表 `sdc_model_has_permissions`
--
ALTER TABLE `sdc_model_has_permissions`
  ADD CONSTRAINT `sdc_model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `sdc_permissions` (`id`) ON DELETE CASCADE;

--
-- 限制表 `sdc_model_has_roles`
--
ALTER TABLE `sdc_model_has_roles`
  ADD CONSTRAINT `sdc_model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `sdc_roles` (`id`) ON DELETE CASCADE;

--
-- 限制表 `sdc_role_has_permissions`
--
ALTER TABLE `sdc_role_has_permissions`
  ADD CONSTRAINT `sdc_role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `sdc_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sdc_role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `sdc_roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

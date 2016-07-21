-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2016 at 02:54 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multi_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name_category` varchar(200) DEFAULT NULL,
  `meta_seo` text,
  `parent_id` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name_category`, `meta_seo`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Quần Áo', NULL, 0, '2016-06-13 22:45:44', '2016-06-13 22:45:44'),
(2, 'Điện Thoại', NULL, 0, '2016-06-13 22:45:58', '2016-06-13 22:45:58'),
(3, 'Máy Tính', NULL, 0, '2016-06-13 22:46:21', '2016-06-13 22:46:21'),
(4, 'Đồ Nữ', NULL, 1, '2016-06-13 22:46:39', '2016-06-13 22:46:39'),
(5, 'Đồ Nam', NULL, 1, '2016-06-13 22:46:53', '2016-06-13 22:46:53'),
(6, 'SamSung', NULL, 2, '2016-06-13 22:47:13', '2016-06-13 22:47:13'),
(7, 'iPhone', NULL, 2, '2016-06-13 22:47:28', '2016-06-13 22:47:28'),
(8, 'Nokia', NULL, 2, '2016-06-13 22:47:36', '2016-06-13 22:47:36'),
(9, 'Dell', NULL, 3, '2016-06-13 22:47:57', '2016-06-13 22:47:57'),
(10, 'Asus', NULL, 3, '2016-06-13 22:48:09', '2016-06-13 22:48:09'),
(11, 'Quần Jean', NULL, 4, '2016-06-13 22:48:27', '2016-06-13 22:48:27'),
(12, 'Váy', NULL, 4, '2016-06-13 22:48:46', '2016-06-13 22:48:46');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `color` varchar(30) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color`, `created_at`, `updated_at`) VALUES
(1, 'Đen', '2016-06-13 22:50:07', '2016-06-13 22:50:07'),
(2, 'Trắng', '2016-06-13 22:50:16', '2016-06-13 22:50:16'),
(3, 'Đỏ', '2016-06-13 22:50:23', '2016-06-13 22:50:23'),
(4, 'Xanh', '2016-06-13 22:50:28', '2016-06-13 22:50:28'),
(5, 'Đỏ - Đen', '2016-06-13 22:50:37', '2016-06-13 22:50:37');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `detail` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `address_name` varchar(200) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `note` text,
  `phuong_thuc` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `colors` varchar(100) DEFAULT NULL,
  `sizes` varchar(100) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `parameters`
--

CREATE TABLE `parameters` (
  `id` int(11) NOT NULL,
  `name_parameter` varchar(50) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parameters`
--

INSERT INTO `parameters` (`id`, `name_parameter`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Chất liệu', 1, '2016-06-13 22:49:28', '2016-06-13 23:17:14'),
(2, 'Thông số - Điện Thoại', 2, '2016-06-13 22:49:42', '2016-06-13 22:49:42'),
(3, 'Thông số - Máy tính', 3, '2016-06-13 22:49:54', '2016-06-13 22:49:54');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `price_searchs`
--

CREATE TABLE `price_searchs` (
  `id` int(11) NOT NULL,
  `search_id` int(11) DEFAULT NULL,
  `price_from` int(11) DEFAULT NULL,
  `price_to` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `price_searchs`
--

INSERT INTO `price_searchs` (`id`, `search_id`, `price_from`, `price_to`, `created_at`, `updated_at`) VALUES
(4, 1, 100000, 200000, '2016-06-13 22:53:24', '2016-06-13 22:53:24'),
(5, 2, 1000000, 2000000, '2016-06-13 22:57:21', '2016-06-13 22:57:21'),
(6, 2, 2000000, 4000000, '2016-06-13 22:57:21', '2016-06-13 22:57:21'),
(7, 2, 4000000, 8000000, '2016-06-13 22:57:21', '2016-06-13 22:57:21'),
(8, 3, 8000000, 12000000, '2016-06-13 23:04:16', '2016-06-13 23:04:16'),
(9, 3, 12000000, 16000000, '2016-06-13 23:04:16', '2016-06-13 23:04:16');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name_product` varchar(100) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `images` text,
  `price_real` int(11) DEFAULT NULL,
  `price_buy` int(11) DEFAULT NULL,
  `preview` text,
  `title_seo` varchar(70) DEFAULT NULL,
  `meta_keyword` varchar(160) DEFAULT NULL,
  `meta_description` varchar(160) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name_product`, `value`, `images`, `price_real`, `price_buy`, `preview`, `title_seo`, `meta_keyword`, `meta_description`, `user_id`, `category_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Jean F1', 50, '["1465834594-2f14d3a86d3777919adf2ba64e171889.jpg","1465834594-download.jpg","1465834594-images.jpg"]', 1000000, 2000000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', NULL, NULL, NULL, NULL, 11, 1, '2016-06-13 23:16:34', '2016-06-13 23:16:34'),
(2, 'Quần Jean F2', 10, '["1465834709-images (1).jpg","1465834709-images.jpg","1465834709-quan-jeans-nu-diesel-division-1336372731.jpg"]', 1000000, 3000000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', NULL, NULL, NULL, NULL, 11, 1, '2016-06-13 23:18:29', '2016-06-13 23:18:29'),
(3, 'Váy xòe', 20, '["1465834777-0b0st193.jpg","1465834777-chan-vay-xoe-xep-ly-ca-tinh-co-tui-that-cc8-1m4G3-chan-vay-xep-lytui-that-1m4G3-1cee6b_simg_d0daf0_800x1200_max.jpg","1465834778-chan-vay-xoe-xep-ly-ca-tinh-co-tui-that-cc8-1m4G3-chan-vay-xep-lytui-that-1m4G3-339d65_simg_d0daf0_800x1200_max.jpg"]', 200000, 500000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', NULL, NULL, NULL, NULL, 12, 1, '2016-06-13 23:19:38', '2016-06-13 23:19:38'),
(4, 'Quần', 20, '["1465834837-download (1).jpg","1465834837-quan-kaki-nam-dep-mon-do-quyen-luc-danh-cho-phai-manh-3-641x1024.jpg","1465834837-street-style-khien-ban-gai-khong-the-roi-mat-tai-tuan-le-thoi-trang-nam-2015.jpg"]', 300000, 500000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', NULL, NULL, NULL, NULL, 5, 1, '2016-06-13 23:20:37', '2016-06-13 23:20:37'),
(5, 'Áo', 20, '["1465834883-download (1).jpg","1465834883-quan-kaki-nam-dep-mon-do-quyen-luc-danh-cho-phai-manh-3-641x1024.jpg","1465834883-street-style-khien-ban-gai-khong-the-roi-mat-tai-tuan-le-thoi-trang-nam-2015.jpg"]', 300000, 600000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', NULL, NULL, NULL, NULL, 5, 1, '2016-06-13 23:21:23', '2016-06-13 23:21:23'),
(6, 'Lumia 1', 18, '["1465834944-201506031033317233_lumia_520_3_6(1).jpg","1465834945-images (1).jpg","1465834945-images.jpg"]', 3000000, 5000000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', NULL, NULL, NULL, NULL, 8, 1, '2016-06-13 23:22:25', '2016-06-13 23:28:45'),
(7, 'Lumia 2', 20, '["1465834996-201506031033317233_lumia_520_3_6(1).jpg","1465834996-images (1).jpg","1465834997-images.jpg"]', 5000000, 8000000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', NULL, NULL, NULL, NULL, 8, 1, '2016-06-13 23:23:17', '2016-06-13 23:28:58'),
(8, 'iPhone SE', 10, '["1465835049-iphone-colores.jpg","1465835049-iphone-se-store.jpg"]', 8000000, 11000000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', NULL, NULL, NULL, NULL, 7, 1, '2016-06-13 23:24:09', '2016-06-13 23:29:08'),
(9, 'iPhone 6s', 20, '["1465835090-iphone-6s-colors.jpg","1465835091-og.jpg"]', 10000000, 17000000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', NULL, NULL, NULL, NULL, 7, 1, '2016-06-13 23:24:51', '2016-06-13 23:29:16'),
(10, 'Samsung Galaxy 7', 10, '["1465835141-2015-08-09_201500.png","1465835141-devices.png","1465835142-FDS_382880.png"]', 12000000, 19000000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', NULL, NULL, NULL, NULL, 6, 1, '2016-06-13 23:25:42', '2016-06-13 23:29:25'),
(11, 'Samsung Galaxy 7s', 10, '["1465835187-noble-zero2.png","1465835187-samsung_galaxy_edgeplus-624x351.jpg","1465835187-samsung-galaxy-a8-gold.jpg"]', 12000000, 16000000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', NULL, NULL, NULL, NULL, 6, 1, '2016-06-13 23:26:27', '2016-06-13 23:29:39'),
(12, 'Dell 1', 10, '["1465835240-2634_2634_4482.jpg","1465835240-best_2131705757-1-8C9259853-xps15-3.blocks-desktop-medium.jpeg","1465835240-dell.jpg"]', 8000000, 12000000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', NULL, NULL, NULL, NULL, 9, 1, '2016-06-13 23:27:20', '2016-06-13 23:30:04'),
(13, 'Dell 2', 10, '["1465835276-dell-xps-13-cyber-monday-ultrabook.jpg","1465835277-en-INTL-L-Dell-XPS-15-i5-8gb-256gb-QF9-00100-RM2-mnco.jpg","1465835277-laptop-dell-inspiron-7537-e_1_2.jpg"]', 14000000, 18000000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', NULL, NULL, NULL, NULL, 9, 1, '2016-06-13 23:27:57', '2016-06-13 23:29:50');

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

CREATE TABLE `product_colors` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_colors`
--

INSERT INTO `product_colors` (`id`, `product_id`, `color_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2016-06-13 23:16:34', '2016-06-13 23:16:34'),
(2, 1, 4, '2016-06-13 23:16:34', '2016-06-13 23:16:34'),
(3, 2, 1, '2016-06-13 23:18:29', '2016-06-13 23:18:29'),
(4, 2, 4, '2016-06-13 23:18:29', '2016-06-13 23:18:29'),
(5, 2, 1, '2016-06-13 23:18:29', '2016-06-13 23:18:29'),
(6, 3, 1, '2016-06-13 23:19:38', '2016-06-13 23:19:38'),
(7, 3, 2, '2016-06-13 23:19:38', '2016-06-13 23:19:38'),
(8, 3, 3, '2016-06-13 23:19:38', '2016-06-13 23:19:38'),
(9, 3, 1, '2016-06-13 23:19:38', '2016-06-13 23:19:38'),
(10, 4, 1, '2016-06-13 23:20:37', '2016-06-13 23:20:37'),
(11, 4, 4, '2016-06-13 23:20:37', '2016-06-13 23:20:37'),
(12, 5, 1, '2016-06-13 23:21:23', '2016-06-13 23:21:23'),
(13, 5, 5, '2016-06-13 23:21:23', '2016-06-13 23:21:23'),
(14, 6, 1, '2016-06-13 23:22:25', '2016-06-13 23:22:25'),
(15, 6, 4, '2016-06-13 23:22:25', '2016-06-13 23:22:25'),
(16, 6, 3, '2016-06-13 23:22:25', '2016-06-13 23:22:25'),
(17, 7, 1, '2016-06-13 23:23:17', '2016-06-13 23:23:17'),
(18, 7, 3, '2016-06-13 23:23:17', '2016-06-13 23:23:17'),
(19, 8, 1, '2016-06-13 23:24:09', '2016-06-13 23:24:09'),
(20, 8, 2, '2016-06-13 23:24:09', '2016-06-13 23:24:09'),
(21, 8, 3, '2016-06-13 23:24:09', '2016-06-13 23:24:09'),
(22, 9, 1, '2016-06-13 23:24:51', '2016-06-13 23:24:51'),
(23, 9, 2, '2016-06-13 23:24:51', '2016-06-13 23:24:51'),
(24, 10, 1, '2016-06-13 23:25:42', '2016-06-13 23:25:42'),
(25, 10, 2, '2016-06-13 23:25:42', '2016-06-13 23:25:42'),
(26, 11, 1, '2016-06-13 23:26:27', '2016-06-13 23:26:27'),
(27, 11, 2, '2016-06-13 23:26:27', '2016-06-13 23:26:27'),
(28, 12, 1, '2016-06-13 23:27:20', '2016-06-13 23:27:20'),
(29, 13, 1, '2016-06-13 23:27:57', '2016-06-13 23:27:57');

-- --------------------------------------------------------

--
-- Table structure for table `product_parameters`
--

CREATE TABLE `product_parameters` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `parameter_id` int(11) NOT NULL,
  `value` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_parameters`
--

INSERT INTO `product_parameters` (`id`, `product_id`, `parameter_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '', '2016-06-13 23:16:34', '2016-06-13 23:16:34'),
(2, 2, 1, 'Catton (100%)', '2016-06-13 23:18:29', '2016-06-13 23:18:29'),
(3, 3, 1, 'Nilon', '2016-06-13 23:19:38', '2016-06-13 23:19:38'),
(4, 4, 1, 'Cat-ton (100%)', '2016-06-13 23:20:37', '2016-06-13 23:20:37'),
(5, 5, 1, 'Polime', '2016-06-13 23:21:23', '2016-06-13 23:21:23'),
(6, 6, 2, '', '2016-06-13 23:22:25', '2016-06-13 23:28:45'),
(7, 7, 2, '', '2016-06-13 23:23:17', '2016-06-13 23:28:58'),
(8, 8, 2, '', '2016-06-13 23:24:09', '2016-06-13 23:29:08'),
(9, 9, 2, '', '2016-06-13 23:24:51', '2016-06-13 23:29:16'),
(10, 10, 2, '', '2016-06-13 23:25:42', '2016-06-13 23:29:25'),
(11, 11, 2, '', '2016-06-13 23:26:27', '2016-06-13 23:29:39'),
(13, 13, 3, '', '2016-06-13 23:27:57', '2016-06-13 23:29:50'),
(14, 12, 3, '', '2016-06-13 23:30:04', '2016-06-13 23:30:04');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `size_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2016-06-13 23:16:34', '2016-06-13 23:16:34'),
(2, 1, 2, '2016-06-13 23:16:34', '2016-06-13 23:16:34'),
(3, 2, 1, '2016-06-13 23:18:29', '2016-06-13 23:18:29'),
(4, 2, 2, '2016-06-13 23:18:29', '2016-06-13 23:18:29'),
(5, 3, 1, '2016-06-13 23:19:38', '2016-06-13 23:19:38'),
(6, 3, 2, '2016-06-13 23:19:38', '2016-06-13 23:19:38'),
(7, 4, 1, '2016-06-13 23:20:37', '2016-06-13 23:20:37'),
(8, 4, 2, '2016-06-13 23:20:37', '2016-06-13 23:20:37'),
(9, 5, 1, '2016-06-13 23:21:23', '2016-06-13 23:21:23'),
(10, 5, 2, '2016-06-13 23:21:23', '2016-06-13 23:21:23'),
(11, 6, 3, '2016-06-13 23:22:25', '2016-06-13 23:22:25'),
(14, 7, 3, '2016-06-13 23:23:17', '2016-06-13 23:23:17'),
(15, 8, 3, '2016-06-13 23:24:09', '2016-06-13 23:24:09'),
(17, 9, 3, '2016-06-13 23:24:51', '2016-06-13 23:24:51'),
(19, 10, 3, '2016-06-13 23:25:42', '2016-06-13 23:25:42'),
(21, 11, 3, '2016-06-13 23:26:27', '2016-06-13 23:26:27'),
(25, 13, 5, '2016-06-13 23:27:57', '2016-06-13 23:27:57'),
(27, 12, 5, '2016-06-13 23:30:04', '2016-06-13 23:30:04'),
(28, 12, 6, '2016-06-13 23:30:04', '2016-06-13 23:30:04');

-- --------------------------------------------------------

--
-- Table structure for table `product_updateds`
--

CREATE TABLE `product_updateds` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_updateds`
--

INSERT INTO `product_updateds` (`id`, `product_id`, `value`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 50, NULL, '2016-06-13 23:16:34', '2016-06-13 23:16:34'),
(2, 2, 10, NULL, '2016-06-13 23:18:29', '2016-06-13 23:18:29'),
(3, 3, 20, NULL, '2016-06-13 23:19:38', '2016-06-13 23:19:38'),
(4, 4, 20, NULL, '2016-06-13 23:20:37', '2016-06-13 23:20:37'),
(5, 5, 20, NULL, '2016-06-13 23:21:23', '2016-06-13 23:21:23'),
(6, 6, 18, NULL, '2016-06-13 23:22:25', '2016-06-13 23:22:25'),
(7, 7, 20, NULL, '2016-06-13 23:23:17', '2016-06-13 23:23:17'),
(8, 8, 10, NULL, '2016-06-13 23:24:09', '2016-06-13 23:24:09'),
(9, 9, 20, NULL, '2016-06-13 23:24:51', '2016-06-13 23:24:51'),
(10, 10, 10, NULL, '2016-06-13 23:25:42', '2016-06-13 23:25:42'),
(11, 11, 10, NULL, '2016-06-13 23:26:27', '2016-06-13 23:26:27'),
(12, 12, 10, NULL, '2016-06-13 23:27:20', '2016-06-13 23:27:20'),
(13, 13, 10, NULL, '2016-06-13 23:27:57', '2016-06-13 23:27:57');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `searchs`
--

CREATE TABLE `searchs` (
  `id` int(11) NOT NULL,
  `name_search` varchar(100) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `searchs`
--

INSERT INTO `searchs` (`id`, `name_search`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Tìm kiếm - Quần Áo', 1, '2016-06-13 22:53:15', '2016-06-13 22:53:24'),
(2, 'Tìm kiếm - Điện thoại', 2, '2016-06-13 22:57:21', '2016-06-13 22:57:21'),
(3, 'Tìm kiếm - Máy Tính', 3, '2016-06-13 23:04:16', '2016-06-13 23:04:16');

-- --------------------------------------------------------

--
-- Table structure for table `search_colors`
--

CREATE TABLE `search_colors` (
  `id` int(11) NOT NULL,
  `search_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `search_colors`
--

INSERT INTO `search_colors` (`id`, `search_id`, `color_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2016-06-13 22:53:15', '2016-06-13 22:53:15'),
(2, 1, 2, '2016-06-13 22:53:15', '2016-06-13 22:53:15'),
(3, 1, 3, '2016-06-13 22:53:15', '2016-06-13 22:53:15'),
(4, 1, 4, '2016-06-13 22:53:15', '2016-06-13 22:53:15'),
(5, 1, 5, '2016-06-13 22:53:15', '2016-06-13 22:53:15'),
(6, 2, 1, '2016-06-13 22:57:21', '2016-06-13 22:57:21'),
(7, 2, 2, '2016-06-13 22:57:21', '2016-06-13 22:57:21'),
(8, 2, 4, '2016-06-13 22:57:21', '2016-06-13 22:57:21'),
(9, 3, 1, '2016-06-13 23:04:16', '2016-06-13 23:04:16'),
(10, 3, 3, '2016-06-13 23:04:16', '2016-06-13 23:04:16');

-- --------------------------------------------------------

--
-- Table structure for table `search_sizes`
--

CREATE TABLE `search_sizes` (
  `id` int(11) NOT NULL,
  `search_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `search_sizes`
--

INSERT INTO `search_sizes` (`id`, `search_id`, `size_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2016-06-13 22:53:15', '2016-06-13 22:53:15'),
(2, 1, 2, '2016-06-13 22:53:15', '2016-06-13 22:53:15'),
(3, 2, 3, '2016-06-13 22:57:21', '2016-06-13 22:57:21'),
(4, 3, 5, '2016-06-13 23:04:16', '2016-06-13 23:04:16'),
(5, 3, 6, '2016-06-13 23:04:16', '2016-06-13 23:04:16');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `size` varchar(5) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'M', 1, '2016-06-13 22:50:56', '2016-06-13 22:50:56'),
(2, 'S', 1, '2016-06-13 22:51:01', '2016-06-13 22:51:01'),
(3, '4''', 2, '2016-06-13 22:51:25', '2016-06-13 22:51:25'),
(4, '5''', 2, '2016-06-13 22:51:33', '2016-06-13 22:51:33'),
(5, '15''', 3, '2016-06-13 22:51:42', '2016-06-13 22:51:42'),
(6, '16''', 3, '2016-06-13 22:51:52', '2016-06-13 22:51:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `cmnd` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phonenumber` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `birthday`, `cmnd`, `image`, `phonenumber`, `address_name`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Trọng Hiếu', 'hieunt', '$2y$10$VbqM2UT7YFL2gbyOLyXxt.ITkh2MKKJktFTaHVVCI/13sWD.3Uy2W', 'chienmadondoc@gmail.com', '1970-01-01', '123456', '1468170721-13383519_902654479879879_1013923554_o.jpg', '', NULL, 1, NULL, '2016-06-08 10:30:00', '2016-07-10 17:12:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parameters`
--
ALTER TABLE `parameters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_slug_unique` (`slug`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_user_permission_id_index` (`permission_id`),
  ADD KEY `permission_user_user_id_index` (`user_id`);

--
-- Indexes for table `price_searchs`
--
ALTER TABLE `price_searchs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `products` ADD FULLTEXT KEY `name_product` (`name_product`);
ALTER TABLE `products` ADD FULLTEXT KEY `preview` (`preview`);

--
-- Indexes for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_parameters`
--
ALTER TABLE `product_parameters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_updateds`
--
ALTER TABLE `product_updateds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_index` (`role_id`),
  ADD KEY `role_user_user_id_index` (`user_id`);

--
-- Indexes for table `searchs`
--
ALTER TABLE `searchs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `search_colors`
--
ALTER TABLE `search_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `search_sizes`
--
ALTER TABLE `search_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `parameters`
--
ALTER TABLE `parameters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permission_user`
--
ALTER TABLE `permission_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `price_searchs`
--
ALTER TABLE `price_searchs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `product_parameters`
--
ALTER TABLE `product_parameters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `product_updateds`
--
ALTER TABLE `product_updateds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `searchs`
--
ALTER TABLE `searchs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `search_colors`
--
ALTER TABLE `search_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `search_sizes`
--
ALTER TABLE `search_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

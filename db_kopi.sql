-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2021 at 05:20 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kopi`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Minuman', 'asas', '2021-05-29 17:44:32', '2021-05-29 17:44:32'),
(2, 'Makanan', 'Makanan', '2021-06-04 19:54:23', '2021-06-04 19:54:23');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `name`, `stock`, `category`, `additional`, `created_at`, `updated_at`) VALUES
(1, 'Kopi', 2, 'Minuman', 'Pcs', '2021-06-06 22:44:08', '2021-09-13 14:39:42'),
(2, 'Ayam', 1, 'Makanan', 'Kg', '2021-07-21 01:54:59', '2021-07-24 01:55:05'),
(3, 'Telur', 1, 'Makanan', 'Kg', '2021-07-21 01:55:20', '2021-07-24 01:54:39'),
(4, 'Kulit Ayam', 500, 'Makanan', 'g', '2021-07-21 01:55:50', '2021-07-24 01:54:20'),
(5, 'Kentang', 1, 'Makanan', 'Kg', '2021-07-21 01:56:30', '2021-07-24 01:53:13'),
(6, 'Beras', 2, 'Makanan', 'Kg', '2021-07-21 01:57:42', '2021-07-24 01:52:50'),
(7, 'Bawang Putih', 500, 'Makanan', 'g', '2021-07-21 01:59:06', '2021-07-24 01:52:17'),
(8, 'Bawang Merah', 250, 'Makanan', 'g', '2021-07-21 01:59:49', '2021-07-24 01:51:44'),
(9, 'Kencur', 200, 'Makanan', 'g', '2021-07-21 02:00:21', '2021-07-24 01:49:49'),
(10, 'Penyedap Rasa (100 g)', 3, 'Makanan', 'Pcs', '2021-07-21 02:01:01', '2021-07-24 01:49:17'),
(11, 'Sosis', 4, 'Makanan', 'Pack', '2021-07-21 02:01:32', '2021-07-24 01:48:42'),
(12, 'Minyak Sayur 1L', 3, 'Makanan', 'Pcs', '2021-07-21 02:35:43', '2021-07-24 01:47:58'),
(13, 'Saus Tiram', 2, 'Makanan', 'Botol', '2021-07-21 02:36:33', '2021-07-24 01:47:38'),
(14, 'Mentega 250 g', 4, 'Makanan', 'Pcs', '2021-07-21 02:37:22', '2021-07-24 01:47:15'),
(15, 'Kremer', 5, 'Minuman', 'Pcs', '2021-07-21 02:38:17', '2021-07-24 01:46:52'),
(16, 'Susu cair', 5, 'Minuman', 'Pcs', '2021-07-21 02:40:42', '2021-07-24 01:44:57'),
(17, 'Susu Kental', 3, 'Minuman', 'Kaleng', '2021-07-21 02:41:32', '2021-07-24 01:44:24'),
(18, 'Alpukat', 1, 'Minuman', 'Kg', '2021-07-21 02:41:54', '2021-07-24 01:44:03'),
(19, 'Strawberry', 250, 'Makanan', 'g', '2021-07-21 02:42:23', '2021-07-28 17:49:43'),
(20, 'Pisang', 2, 'Makanan', 'Sisir', '2021-07-21 02:44:41', '2021-07-28 17:22:36'),
(21, 'Jeruk', 2, 'Makanan', 'Kg', '2021-07-21 02:45:48', '2021-07-28 17:22:16'),
(22, 'Coklat Bubuk 250 g', -2, 'Minuman', 'Pack', '2021-07-21 02:47:30', '2021-09-13 14:39:42'),
(23, 'Gula Aren Bubuk 500 g', 2, 'Minuman', 'Pack', '2021-07-21 02:48:30', '2021-07-29 02:47:35');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_05_29_015105_create_categories_table', 1),
(5, '2021_05_29_015204_create_products_table', 1),
(6, '2021_05_29_015350_create_orders_table', 1),
(7, '2021_05_29_015441_create_order_details_table', 1),
(8, '2021_05_29_020633_add_relationships_to_products_table', 2),
(9, '2021_05_29_020913_add_relationships_to_orders_table', 3),
(10, '2021_05_29_021410_add_relationships_to_order_details_table', 3),
(11, '2021_05_29_094516_add_field_photo_to_products_table', 4),
(12, '2021_05_30_025136_add_status_to_users_table', 5),
(13, '2021_05_30_041657_add_role_to_users_table', 6),
(14, '2021_05_30_113329_create_permission_tables', 7),
(15, '2021_06_01_122318_add_paid_to_orders_table', 8),
(16, '2021_06_07_050922_create_materials_table', 9),
(17, '2021_06_10_075937_create_reports_table', 10),
(19, '2021_07_17_115905_add_date_to_report_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  `catatan` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `invoice`, `customer`, `table`, `user_id`, `total`, `paid`, `catatan`, `created_at`, `updated_at`) VALUES
(2, 'INV-1', 'k', 'T01', 4, 12000, 0, NULL, '2021-06-01 00:25:44', '2021-06-01 00:25:44'),
(3, 'INV-2', 'q', '', 4, 12000, 0, NULL, '2021-06-01 00:32:14', '2021-06-01 00:32:14'),
(4, 'INV-3', 'rizky', '', 4, 36000, 0, NULL, '2021-06-01 00:38:44', '2021-06-01 00:38:44'),
(5, 'INV-4', 'ra', '', 4, 12000, 1000, NULL, '2021-06-01 05:42:26', '2021-06-01 05:42:26'),
(6, 'INV-5', 'M Rizky Al Kusaeri', '', 4, 36000, 40000, NULL, '2021-06-01 21:13:00', '2021-06-01 21:13:00'),
(7, 'INV-6', 'aan', '', 4, 24000, 24000, NULL, '2021-06-01 21:14:19', '2021-06-01 21:14:19'),
(8, 'INV-7', 'Rofi', '', 5, 42000, 42000, NULL, '2021-06-04 20:01:58', '2021-06-04 20:01:58'),
(9, 'INV-8', 'aan', '', 5, 81000, 90000, NULL, '2021-06-04 23:37:06', '2021-06-04 23:37:06'),
(10, 'INV-9', 'al', '', 5, 180000, 180000, NULL, '2021-07-13 02:17:23', '2021-07-13 02:17:23'),
(11, 'INV-10', 'asas', '', 5, 15000, 15000, NULL, '2021-07-17 04:08:48', '2021-07-17 04:08:48'),
(12, 'INV-11', 'Rofi', '', 5, 15000, 15000, NULL, '2021-07-20 21:42:47', '2021-07-20 21:42:47'),
(13, 'INV-12', 'Hilman', '', 8, 52000, 55000, NULL, '2021-07-21 00:25:59', '2021-07-21 00:25:59'),
(14, 'INV-13', 'Yopi', '', 8, 15000, 20000, NULL, '2021-07-21 00:28:25', '2021-07-21 00:28:25'),
(15, 'INV-14', 'Gilang', '', 8, 26000, 30000, NULL, '2021-07-21 00:31:08', '2021-07-21 00:31:08'),
(16, 'INV-15', 'Yulia', '', 8, 52000, 60000, NULL, '2021-07-21 00:32:47', '2021-07-21 00:32:47'),
(17, 'INV-16', 'Cikoy', '', 8, 18000, 20000, NULL, '2021-07-21 00:38:14', '2021-07-21 00:38:14'),
(18, 'INV-17', 'Nayla', '', 8, 52000, 60000, NULL, '2021-07-21 00:40:38', '2021-07-21 00:40:38'),
(19, 'INV-18', 'Ayu', '', 8, 26000, 30000, NULL, '2021-07-21 01:03:57', '2021-07-21 01:03:57'),
(20, 'INV-19', 'Abdul', '', 8, 26000, 30000, NULL, '2021-07-21 01:09:02', '2021-07-21 01:09:02'),
(21, 'INV-20', 'Saepul', '', 8, 20000, 20000, NULL, '2021-07-21 03:40:17', '2021-07-21 03:40:17'),
(22, 'INV-21', 'Ibam', '', 8, 8000, 10000, NULL, '2021-07-25 05:58:03', '2021-07-25 05:58:03'),
(23, 'INV-22', 'Opi', '', 8, 14000, 15000, NULL, '2021-07-25 13:02:17', '2021-07-25 13:02:17'),
(24, 'INV-23', 'rikbul', '', 8, 46000, 50000, NULL, '2021-07-26 09:57:30', '2021-07-26 09:57:30'),
(25, 'INV-24', 'Rans', '', 8, 34000, 35000, NULL, '2021-07-27 21:01:47', '2021-07-27 21:01:47'),
(26, 'INV-25', 'Rully', '', 8, 14000, 15000, NULL, '2021-07-28 14:06:19', '2021-07-28 14:06:19'),
(27, 'INV-26', 'Hilman', '', 8, 48000, 50000, NULL, '2021-07-29 01:29:36', '2021-07-29 01:29:36'),
(28, 'INV-27', 'Rofi', '', 8, 85000, 100000, NULL, '2021-07-29 02:40:44', '2021-07-29 02:40:44'),
(29, 'INV-28', 'piw', '', 8, 14000, 15000, 'Dingin', '2021-07-31 02:58:23', '2021-07-31 02:58:23'),
(30, 'INV-29', 'Bambang', '', 4, 28000, 50000, 'Hot Water', '2021-08-05 15:57:28', '2021-08-05 15:57:28'),
(31, 'INV-30', 'Iqbal Yusuf Fadillah', '', 8, 0, 77777, 'oker', '2021-08-06 14:21:36', '2021-08-06 14:21:36'),
(33, 'INV-31', 'Padil', 'T03', 5, 72000, 100000, NULL, '2021-08-13 08:06:26', '2021-08-13 08:06:26'),
(34, 'INV-32', 'Ropi Naks Garut', 'T03', 5, 96000, 100000, NULL, '2021-08-13 09:27:59', '2021-08-13 09:27:59'),
(36, 'INV-33', 'Riki Buldan Al Hariri', 'dadah', 8, 14000, 20000, NULL, '2021-09-13 02:47:47', '2021-09-13 02:47:47'),
(46, 'INV-34', 'riki buldan', 'riki buldan', 8, 28000, 59000, NULL, '2021-09-13 07:47:48', '2021-09-13 07:47:48'),
(47, 'INV-35', 'riki buldan', 'riki buldan', 8, 14000, 30000, 'gaul', '2021-09-13 07:50:00', '2021-09-13 07:50:00'),
(48, 'INV-36', 'riki buldan', 'riki buldan', 8, 14000, 400000, NULL, '2021-09-13 07:52:00', '2021-09-13 07:52:00'),
(49, 'INV-37', 'dadsadsa', 'dadsadsa', 8, 14000, 30000, NULL, '2021-09-13 07:53:39', '2021-09-13 07:53:39'),
(50, 'INV-38', 'riki buldan', 'riki buldan', 8, 14000, 30000, NULL, '2021-09-13 08:00:43', '2021-09-13 08:00:43'),
(51, 'INV-39', 'riki buldan', 'riki buldan', 8, 14000, 20000, 'test', '2021-09-13 14:04:11', '2021-09-13 14:04:11'),
(52, 'INV-40', 'riki buldan', 'riki buldan', 8, 14000, 20000, 'tes', '2021-09-13 14:05:22', '2021-09-13 14:05:22'),
(56, 'INV-41', 'riki buldan', 'riki buldan', 8, 14000, 20000, 'tes', '2021-09-13 14:38:28', '2021-09-13 14:38:28'),
(57, 'INV-42', 'riki buldan', 'riki buldan', 8, 56000, 100000000, 'test', '2021-09-13 14:39:42', '2021-09-13 14:39:42');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `qty`, `price`, `created_at`, `updated_at`) VALUES
(15, 13, 8, 1, 26000, '2021-07-21 00:25:59', '2021-07-21 00:25:59'),
(16, 13, 6, 1, 26000, '2021-07-21 00:25:59', '2021-07-21 00:25:59'),
(17, 14, 4, 1, 15000, '2021-07-21 00:28:25', '2021-07-21 00:28:25'),
(18, 15, 6, 1, 26000, '2021-07-21 00:31:08', '2021-07-21 00:31:08'),
(19, 16, 7, 2, 26000, '2021-07-21 00:32:47', '2021-07-21 00:32:47'),
(20, 17, 5, 1, 18000, '2021-07-21 00:38:14', '2021-07-21 00:38:14'),
(21, 18, 6, 2, 26000, '2021-07-21 00:40:38', '2021-07-21 00:40:38'),
(22, 19, 8, 1, 26000, '2021-07-21 01:03:57', '2021-07-21 01:03:57'),
(23, 20, 8, 1, 26000, '2021-07-21 01:09:02', '2021-07-21 01:09:02'),
(24, 21, 17, 1, 20000, '2021-07-21 03:40:17', '2021-07-21 03:40:17'),
(25, 22, 13, 1, 8000, '2021-07-25 05:58:03', '2021-07-25 05:58:03'),
(27, 24, 6, 1, 26000, '2021-07-26 09:57:30', '2021-07-26 09:57:30'),
(28, 24, 18, 1, 12000, '2021-07-26 09:57:30', '2021-07-26 09:57:30'),
(29, 24, 12, 1, 8000, '2021-07-26 09:57:30', '2021-07-26 09:57:30'),
(30, 25, 6, 1, 26000, '2021-07-27 21:01:47', '2021-07-27 21:01:47'),
(31, 25, 13, 1, 8000, '2021-07-27 21:01:47', '2021-07-27 21:01:47'),
(32, 26, 19, 1, 14000, '2021-07-28 14:06:19', '2021-07-28 14:06:19'),
(33, 27, 6, 1, 26000, '2021-07-29 01:29:36', '2021-07-29 01:29:36'),
(34, 27, 13, 1, 8000, '2021-07-29 01:29:36', '2021-07-29 01:29:36'),
(35, 27, 19, 1, 14000, '2021-07-29 01:29:36', '2021-07-29 01:29:36'),
(36, 28, 6, 2, 26000, '2021-07-29 02:40:44', '2021-07-29 02:40:44'),
(37, 28, 15, 1, 19000, '2021-07-29 02:40:44', '2021-07-29 02:40:44'),
(38, 28, 19, 1, 14000, '2021-07-29 02:40:44', '2021-07-29 02:40:44'),
(39, 29, 19, 1, 14000, '2021-07-31 02:58:24', '2021-07-31 02:58:24'),
(40, 30, 19, 2, 14000, '2021-08-05 15:57:28', '2021-08-05 15:57:28'),
(42, 33, 7, 2, 26000, '2021-08-13 08:06:26', '2021-08-13 08:06:26'),
(43, 33, 16, 1, 20000, '2021-08-13 08:06:26', '2021-08-13 08:06:26'),
(44, 34, 19, 2, 14000, '2021-08-13 09:27:59', '2021-08-13 09:27:59'),
(45, 34, 14, 4, 17000, '2021-08-13 09:27:59', '2021-08-13 09:27:59'),
(47, 36, 19, 1, 14000, '2021-09-13 02:47:47', '2021-09-13 02:47:47'),
(57, 46, 19, 2, 14000, '2021-09-13 07:47:48', '2021-09-13 07:47:48'),
(58, 47, 19, 1, 14000, '2021-09-13 07:50:00', '2021-09-13 07:50:00'),
(59, 48, 19, 1, 14000, '2021-09-13 07:52:00', '2021-09-13 07:52:00'),
(60, 49, 19, 1, 14000, '2021-09-13 07:53:39', '2021-09-13 07:53:39'),
(61, 50, 19, 1, 14000, '2021-09-13 08:00:43', '2021-09-13 08:00:43'),
(62, 51, 19, 1, 14000, '2021-09-13 14:04:11', '2021-09-13 14:04:11'),
(63, 52, 19, 1, 14000, '2021-09-13 14:05:22', '2021-09-13 14:05:22'),
(64, 56, 19, 1, 14000, '2021-09-13 14:38:28', '2021-09-13 14:38:28'),
(65, 57, 19, 4, 14000, '2021-09-13 14:39:42', '2021-09-13 14:39:42');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `description`, `price`, `status`, `category_id`, `photo`, `created_at`, `updated_at`) VALUES
(4, 'NS-001', 'Nasi Goreng', 'Nasi Goreng dengan berbagai macam rempah yang kaya', '15000', '1', 2, NULL, '2021-07-20 22:30:23', '2021-07-20 22:30:23'),
(5, 'NS-002', 'Nasi Goreng Kambing', 'Nasi goreng dengan menggunakan rempah yang kaya dan ditambhkan denga potongan daging kambing', '18000', '1', 2, NULL, '2021-07-20 22:32:05', '2021-07-20 22:32:05'),
(6, 'NS-003', 'Nasi Goreng Ala Akustik', 'Nasi denga bakso sapi, sosis, telur, kerupuk dan nugget', '26000', '0', 2, NULL, '2021-07-20 22:34:48', '2021-07-29 02:46:37'),
(7, 'WS-001', 'The Banger Cheese Omellette', 'Telur dadar gulung isi keju, disajikan dengan sosis dan kentang goreng', '26000', '1', 2, NULL, '2021-07-20 22:37:24', '2021-07-20 22:37:24'),
(8, 'WS-002', 'BBQ Bratwurst Sausage', 'Sosis sapi bratwurst panggang, saus barbekyu dengan kentang pure', '26000', '1', 2, NULL, '2021-07-20 22:39:47', '2021-07-20 22:39:47'),
(9, 'KP-001', 'Hot / Ice Cappuccino', NULL, '15000', '1', 1, NULL, '2021-07-21 02:51:00', '2021-07-21 03:23:57'),
(10, 'KP-002', 'Iced Coffee Sundae', NULL, '18000', '1', 1, NULL, '2021-07-21 03:16:17', '2021-07-21 03:16:17'),
(11, 'KP-003', 'Black Coffee', NULL, '12000', '1', 1, NULL, '2021-07-21 03:17:03', '2021-07-21 03:17:03'),
(12, 'TEA-001', 'Hot Tea the Pot', 'Seduhan teh di cangkir', '8000', '1', 1, NULL, '2021-07-21 03:19:04', '2021-07-21 03:20:48'),
(13, 'TEA-002', 'Iced Tea', NULL, '8000', '1', 1, NULL, '2021-07-21 03:21:55', '2021-07-21 03:21:55'),
(14, 'TEA-003', 'Hot / Ice Lemon Honey Tea', NULL, '17000', '1', 1, NULL, '2021-07-21 03:23:06', '2021-07-21 03:23:06'),
(15, 'TEA-004', 'Iced Lychee Tea', NULL, '19000', '1', 1, NULL, '2021-07-21 03:28:38', '2021-07-21 03:28:38'),
(16, 'MLK-001', 'Chocolate Milkshake', NULL, '20000', '1', 1, NULL, '2021-07-21 03:29:52', '2021-07-21 03:29:52'),
(17, 'MLK-002', 'Strawberry Milkshake', NULL, '20000', '1', 1, NULL, '2021-07-21 03:30:51', '2021-07-21 03:30:51'),
(18, 'TEA-005', 'Iced Thai Tea', NULL, '12000', '1', 1, NULL, '2021-07-21 03:35:12', '2021-07-21 03:35:12'),
(19, 'KP-004', 'Americano', '1/3 Esspresso\r\n2/3 Hot Water', '14000', '1', 1, NULL, '2021-07-21 03:37:09', '2021-07-21 03:37:09');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `description`, `total`, `image`, `created_at`, `updated_at`, `start_date`, `end_date`) VALUES
(4, 'laporan keuangan bulan juni : air, biaya gaji, belanja bahan baku', 300000, '', '2021-07-17 05:23:45', '2021-07-29 03:06:25', '2021-06-01 00:00:01', '2021-06-30 23:59:59'),
(8, '(laporan keuangan bulan Juli) : tgl 12 belanja bahan baku, biaya Air, biaya listrik, biaya internet, biaya gaji pegawai', 750000, '', '2021-07-29 01:32:21', '2021-07-29 03:01:33', '2021-07-01 00:00:01', '2021-07-31 23:59:59'),
(10, 'qwewqe', 2900999, 'data/laporan/4ba4329c90d345b1f65433d959f8e339.jpg', '2021-08-15 02:02:11', '2021-08-15 02:02:11', '2021-08-12 00:00:01', '2021-08-24 23:59:59'),
(11, 'Kampretettt', 900000, 'data/laporan/25e185313310f58108faa8c46e37a997.jpg', '2021-08-15 02:03:20', '2021-08-15 02:03:20', '2021-08-04 00:00:01', '2021-08-31 23:59:59'),
(12, 'Tetsttst', 900000, 'data/laporan/9ee6cc81fb4ee23523ce2b2463c30bdb.jpg', '2021-08-15 02:33:50', '2021-08-15 02:33:50', '2021-08-12 00:00:01', '2021-08-25 23:59:59'),
(13, 'Test Baruuu', 9000000, 'data/laporan/6948da3f0c2194f6ca29feb074cf759a.jpg', '2021-08-15 02:34:51', '2021-08-15 02:34:51', '2021-08-12 00:00:01', '2021-08-27 23:59:59'),
(14, 'Upload Ulang', 900000, 'data/laporan/c4a6ce2c7f408c90e983c11bfa757890.jpg', '2021-08-15 02:35:56', '2021-08-15 02:35:56', '2021-08-19 00:00:01', '2021-08-31 23:59:59'),
(15, 'tetstttt', 172172172, 'laporan/rtajVByL2cywYgLtoBKIZN2sks1pus1Sy6gZoUkp.jpg', '2021-08-15 02:42:39', '2021-08-15 02:42:39', '2021-08-12 00:00:01', '2021-08-24 23:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `reseps`
--

CREATE TABLE `reseps` (
  `id` int(11) NOT NULL,
  `code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reseps`
--

INSERT INTO `reseps` (`id`, `code`) VALUES
(1, 'KP-004');

-- --------------------------------------------------------

--
-- Table structure for table `resep_details`
--

CREATE TABLE `resep_details` (
  `id` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `id_reseps` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resep_details`
--

INSERT INTO `resep_details` (`id`, `id_material`, `id_reseps`) VALUES
(1, 1, 1),
(2, 22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Rofi', 'admin@gmail.com', '2021-05-29 21:31:27', '$2y$10$l4raPlYImYsNPTU7tVOtJuJrkCjwvmEaR1hAWw5vug4Na6jGXybgi', 'admin', 1, NULL, '2021-05-29 21:31:27', '2021-05-30 04:07:56'),
(4, 'aan', 'rizkyalkus12@gmail.com', NULL, '$2y$10$jwQgZ6FrlEgMQntpPt29l.4B3tND3usibmho/crXmjQ.fmiPC2lLm', 'kasir', 1, NULL, '2021-05-30 05:37:35', '2021-05-30 06:01:46'),
(5, 'aku', 'aku@gmail.com', NULL, '$2y$10$0hk8ap7GHoXBXP1zvhKaUOQJ6C.6TqBTGORrTztTtcJuxLdE/puvS', 'kasir', 1, NULL, '2021-06-04 19:58:04', '2021-06-04 19:58:04'),
(6, 'barista', 'barista@gmail.com', NULL, '$2y$10$FeD6pKrNr0MDyxZ4Um9LBuUe0REUn0TH5n21Rtv.RwEc2PmsZtlRK', 'barista', 1, NULL, '2021-07-17 07:03:14', '2021-07-17 07:03:14'),
(7, 'dapur', 'dapur@gmail.com', NULL, '$2y$10$8XktyPpe4vHvM/PMZDbF8uKuuYQRZ7yRXcVSiPK2HPi96p0xhN1Wu', 'dapur', 1, NULL, '2021-07-17 07:03:37', '2021-07-17 07:03:37'),
(8, 'Aufa', 'Aufa@gmail.com', NULL, '$2y$10$kRK/4JURelItM.TvBslzIO7o2EaF7WRT30hZ3iClX71sqdB5md71y', 'kasir', 1, NULL, '2021-07-20 22:15:45', '2021-07-20 22:15:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_invoice_unique` (`invoice`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_code_unique` (`code`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reseps`
--
ALTER TABLE `reseps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resep_details`
--
ALTER TABLE `resep_details`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `reseps`
--
ALTER TABLE `reseps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `resep_details`
--
ALTER TABLE `resep_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

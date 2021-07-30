-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jul 2021 pada 18.19
-- Versi server: 10.4.16-MariaDB
-- Versi PHP: 7.4.12

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
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Minuman', 'asas', '2021-05-29 17:44:32', '2021-05-29 17:44:32'),
(2, 'Makanan', 'Makanan', '2021-06-04 19:54:23', '2021-06-04 19:54:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `materials`
--

CREATE TABLE `materials` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `additional` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `materials`
--

INSERT INTO `materials` (`id`, `name`, `stock`, `additional`, `created_at`, `updated_at`) VALUES
(1, 'Biji Kopi', 22, 'Kilogram', '2021-06-06 22:44:08', '2021-07-17 03:30:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
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
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `invoice`, `customer`, `user_id`, `total`, `paid`, `created_at`, `updated_at`) VALUES
(2, 'INV-1', 'k', 4, 12000, 0, '2021-06-01 00:25:44', '2021-06-01 00:25:44'),
(3, 'INV-2', 'q', 4, 12000, 0, '2021-06-01 00:32:14', '2021-06-01 00:32:14'),
(4, 'INV-3', 'rizky', 4, 36000, 0, '2021-06-01 00:38:44', '2021-06-01 00:38:44'),
(5, 'INV-4', 'ra', 4, 12000, 1000, '2021-06-01 05:42:26', '2021-06-01 05:42:26'),
(6, 'INV-5', 'M Rizky Al Kusaeri', 4, 36000, 40000, '2021-06-01 21:13:00', '2021-06-01 21:13:00'),
(7, 'INV-6', 'aan', 4, 24000, 24000, '2021-06-01 21:14:19', '2021-06-01 21:14:19'),
(8, 'INV-7', 'Rofi', 5, 42000, 42000, '2021-06-04 20:01:58', '2021-06-04 20:01:58'),
(9, 'INV-8', 'aan', 5, 81000, 90000, '2021-06-04 23:37:06', '2021-06-04 23:37:06'),
(10, 'INV-9', 'al', 5, 180000, 180000, '2021-07-13 02:17:23', '2021-07-13 02:17:23'),
(11, 'INV-10', 'asas', 5, 15000, 15000, '2021-07-17 04:08:48', '2021-07-17 04:08:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_details`
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
-- Dumping data untuk tabel `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `qty`, `price`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 1, 12000, '2021-06-01 00:25:44', '2021-06-01 00:25:44'),
(3, 3, 1, 1, 12000, '2021-06-01 00:32:14', '2021-06-01 00:32:14'),
(4, 4, 1, 3, 12000, '2021-06-01 00:38:44', '2021-06-01 00:38:44'),
(5, 5, 1, 1, 12000, '2021-06-01 05:42:26', '2021-06-01 05:42:26'),
(6, 6, 1, 3, 12000, '2021-06-01 21:13:00', '2021-06-01 21:13:00'),
(7, 7, 1, 2, 12000, '2021-06-01 21:14:19', '2021-06-01 21:14:19'),
(8, 8, 3, 2, 15000, '2021-06-04 20:01:58', '2021-06-04 20:01:58'),
(9, 8, 1, 1, 12000, '2021-06-04 20:01:58', '2021-06-04 20:01:58'),
(10, 9, 3, 3, 15000, '2021-06-04 23:37:06', '2021-06-04 23:37:06'),
(11, 9, 1, 3, 12000, '2021-06-04 23:37:06', '2021-06-04 23:37:06'),
(12, 10, 3, 12, 15000, '2021-07-13 02:17:23', '2021-07-13 02:17:23'),
(13, 11, 3, 1, 15000, '2021-07-17 04:08:48', '2021-07-17 04:08:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
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
-- Struktur dari tabel `products`
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
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `description`, `price`, `status`, `category_id`, `photo`, `created_at`, `updated_at`) VALUES
(1, '122', 'Es lemon', 'asas', '12000', '0', 1, 'a1622338343.jpg', '2021-05-29 18:32:23', '2021-05-29 19:48:28'),
(3, 'a1212', 'Nasi Goreng', 'Nasi Goreng', '15000', '1', 2, 'nasi-goreng1622861746.jpg', '2021-06-04 19:55:46', '2021-06-04 19:55:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reports`
--

CREATE TABLE `reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `reports`
--

INSERT INTO `reports` (`id`, `description`, `total`, `created_at`, `updated_at`, `start_date`, `end_date`) VALUES
(3, 'asasa', 3400000, '2021-07-17 05:16:28', '2021-07-17 05:16:28', '2021-07-01 00:00:01', '2021-07-31 23:59:59'),
(4, 'dfdf', 43435535, '2021-07-17 05:23:45', '2021-07-17 05:23:45', '2021-06-01 00:00:01', '2021-06-30 23:59:59'),
(5, 'zxzx', 120000, '2021-07-17 05:24:31', '2021-07-20 09:15:52', '2021-07-01 00:00:01', '2021-07-31 23:59:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Rofi', 'admin@gmail.com', '2021-05-29 21:31:27', '$2y$10$l4raPlYImYsNPTU7tVOtJuJrkCjwvmEaR1hAWw5vug4Na6jGXybgi', 'admin', 1, NULL, '2021-05-29 21:31:27', '2021-05-30 04:07:56'),
(4, 'aan', 'rizkyalkus12@gmail.com', NULL, '$2y$10$jwQgZ6FrlEgMQntpPt29l.4B3tND3usibmho/crXmjQ.fmiPC2lLm', 'kasir', 1, NULL, '2021-05-30 05:37:35', '2021-05-30 06:01:46'),
(5, 'aku', 'aku@gmail.com', NULL, '$2y$10$0hk8ap7GHoXBXP1zvhKaUOQJ6C.6TqBTGORrTztTtcJuxLdE/puvS', 'kasir', 1, NULL, '2021-06-04 19:58:04', '2021-06-04 19:58:04'),
(6, 'barista', 'barista@gmail.com', NULL, '$2y$10$FeD6pKrNr0MDyxZ4Um9LBuUe0REUn0TH5n21Rtv.RwEc2PmsZtlRK', 'barista', 1, NULL, '2021-07-17 07:03:14', '2021-07-17 07:03:14'),
(7, 'dapur', 'dapur@gmail.com', NULL, '$2y$10$8XktyPpe4vHvM/PMZDbF8uKuuYQRZ7yRXcVSiPK2HPi96p0xhN1Wu', 'dapur', 1, NULL, '2021-07-17 07:03:37', '2021-07-17 07:03:37');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_invoice_unique` (`invoice`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_code_unique` (`code`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for digirent
CREATE DATABASE IF NOT EXISTS `digirent` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `digirent`;

-- Dumping structure for table digirent.bookings
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `total_price` bigint unsigned NOT NULL,
  `status` enum('pending','confirmed','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `snap_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookings_user_id_foreign` (`user_id`),
  KEY `bookings_product_id_foreign` (`product_id`),
  CONSTRAINT `bookings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table digirent.bookings: ~0 rows (approximately)

-- Dumping structure for table digirent.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table digirent.cache: ~0 rows (approximately)

-- Dumping structure for table digirent.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table digirent.cache_locks: ~0 rows (approximately)

-- Dumping structure for table digirent.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table digirent.categories: ~2 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Handphone', 'handphone', '2025-12-15 07:42:37', '2025-12-15 07:42:37'),
	(2, 'Laptop', 'laptop', '2025-12-15 07:42:37', '2025-12-15 07:42:37');

-- Dumping structure for table digirent.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table digirent.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table digirent.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table digirent.jobs: ~0 rows (approximately)

-- Dumping structure for table digirent.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table digirent.job_batches: ~0 rows (approximately)

-- Dumping structure for table digirent.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table digirent.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_09_30_143541_create_categories_table', 1),
	(5, '2025_09_30_143548_create_products_table', 1),
	(6, '2025_09_30_143555_create_rentals_table', 1),
	(7, '2025_10_02_171542_create_bookings_table', 1),
	(8, '2025_10_02_202248_change_dates_to_datetime_in_bookings_table', 1),
	(9, '2025_10_04_201814_add_role_to_users_table', 1),
	(10, '2025_10_16_173854_add_specifications_to_products_table', 1),
	(11, '2025_10_22_070924_create_news_items_table', 1),
	(12, '2025_11_16_140132_add_snap_token_to_bookings_table', 1),
	(13, '2025_11_16_152658_add_phone_and_address_to_users_table', 1);

-- Dumping structure for table digirent.news_items
CREATE TABLE IF NOT EXISTS `news_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table digirent.news_items: ~0 rows (approximately)

-- Dumping structure for table digirent.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table digirent.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table digirent.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `specifications` json DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_per_day` int NOT NULL,
  `stock` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table digirent.products: ~20 rows (approximately)
INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `description`, `specifications`, `image`, `price_per_day`, `stock`, `created_at`, `updated_at`) VALUES
	(1, 1, 'iPhone XR', 'iphone-xr', 'Smartphone andal dengan layar Liquid Retina HD dan performa A12 Bionic.', '{"Chip": "A12 Bionic", "Layar": "6.1\\" Liquid Retina HD", "Kamera": "12MP Wide", "Face ID": "Ya", "Penyimpanan": "64GB"}', 'products/iphone-xr.jpg', 75000, 10, '2025-12-15 07:42:37', '2025-12-15 07:42:37'),
	(2, 1, 'iPhone 11', 'iphone-11', 'Dilengkapi sistem kamera ganda (Ultra Wide) dan Chip A13 Bionic yang powerful.', '{"Chip": "A13 Bionic", "Layar": "6.1\\" Liquid Retina HD", "Video": "4K 60fps", "Kamera": "Dual 12MP (Wide, Ultra Wide)", "Penyimpanan": "128GB"}', 'products/iphone-11.jpg', 85000, 8, '2025-12-15 07:42:37', '2025-12-15 07:42:37'),
	(3, 1, 'iPhone 13', 'iphone-13', 'Layar Super Retina XDR yang cerah dengan Chip A15 Bionic super cepat dan mode Sinematik.', '{"Chip": "A15 Bionic", "Fitur": "Mode Sinematik", "Layar": "6.1\\" Super Retina XDR", "Kamera": "Dual 12MP Pro System", "Penyimpanan": "128GB"}', 'products/iphone-13.jpg', 100000, 7, '2025-12-15 07:42:37', '2025-12-15 07:42:37'),
	(4, 1, 'iPhone 14 Pro', 'iphone-14-pro', 'Memperkenalkan Dynamic Island, kamera utama 48MP, dan Chip A16 Bionic.', '{"Chip": "A16 Bionic", "Layar": "6.1\\" Super Retina XDR", "Fitur Layar": "Dynamic Island", "Penyimpanan": "256GB", "Kamera Utama": "48MP ProRAW"}', 'products/iphone-14-pro.jpg', 135000, 5, '2025-12-15 07:42:37', '2025-12-15 07:42:37'),
	(5, 1, 'iPhone 15 Pro Max', 'iphone-15-pro-max', 'Ditempa dari titanium, dengan Chip A17 Pro pengubah game, dan tombol Tindakan.', '{"Chip": "A17 Pro", "Layar": "6.7\\" Super Retina XDR", "Material": "Titanium", "Zoom Optik": "5x Telefoto", "Penyimpanan": "256GB", "Kamera Utama": "48MP"}', 'products/iphone-15-pro-max.jpg', 180000, 4, '2025-12-15 07:42:37', '2025-12-15 07:42:37'),
	(6, 1, 'Samsung Galaxy S23 Ultra', 'samsung-galaxy-s23-ultra', 'Kamera 200MP revolusioner, S Pen terintegrasi, dan performa gaming terbaik.', '{"Chip": "Snapdragon 8 Gen 2 for Galaxy", "Layar": "6.8\\" Dynamic AMOLED 2X", "Stylus": "S Pen Built-in", "Penyimpanan": "256GB", "Kamera Utama": "200MP"}', 'products/samsung-s23-ultra.jpeg', 165000, 5, '2025-12-15 07:42:37', '2025-12-15 07:42:37'),
	(7, 1, 'Samsung Galaxy S24 Ultra', 'samsung-galaxy-s24-ultra', 'Era baru AI seluler dengan Galaxy AI, S Pen, dan frame titanium yang kokoh.', '{"Chip": "Snapdragon 8 Gen 3 for Galaxy", "Layar": "6.8\\" Dynamic AMOLED 2X", "Fitur AI": "Galaxy AI", "Material": "Titanium", "Penyimpanan": "256GB", "Kamera Utama": "200MP"}', 'products/samsung-s24-ultra.jpeg', 190000, 4, '2025-12-15 07:42:37', '2025-12-15 07:42:37'),
	(8, 1, 'Samsung Galaxy S25 Ultra', 'samsung-galaxy-s25-ultra', 'Kekuatan masa depan dengan chip terbaru dan peningkatan kamera signifikan.', '{"Chip": "Snapdragon 8 Gen 4", "Layar": "6.9\\" Dynamic AMOLED 2X", "Baterai": "5.500 mAh", "Penyimpanan": "512GB", "Kamera Utama": "200MP ISOCELL Sensor"}', 'products/samsung-s25-ultra.jpeg', 220000, 3, '2025-12-15 07:42:37', '2025-12-15 07:42:37'),
	(9, 1, 'Samsung Galaxy Z Flip 6', 'samsung-galaxy-z-flip-6', 'Ponsel lipat ringkas dengan layar cover lebih besar dan performa andal.', '{"Chip": "Snapdragon 8 Gen 3", "Ketahanan": "IPX8 Water Resistant", "Layar Cover": "3.4\\" Super AMOLED", "Layar Utama": "6.7\\" Foldable Dynamic AMOLED", "Penyimpanan": "256GB"}', 'products/Samsung-Galaxy-z-flip-6.jpg', 170000, 5, '2025-12-15 07:42:37', '2025-12-15 07:42:37'),
	(10, 1, 'Samsung Galaxy Z Flip 7', 'samsung-galaxy-z-flip-7', 'Desain lebih tipis, engsel tanpa celah, dan ditenagai chipset tercanggih.', '{"Chip": "Snapdragon 8 Gen 4", "Engsel": "Ironflex Hinge", "Kamera": "50MP Wide", "Layar Utama": "6.7\\" Foldable Dynamic AMOLED", "Penyimpanan": "512GB"}', 'products/Samsung-Galaxy-z-flip-7.jpg', 200000, 3, '2025-12-15 07:42:37', '2025-12-15 07:42:37'),
	(11, 1, 'Google Pixel 8 Pro', 'google-pixel-8-pro', 'Kamera pintar dengan fitur AI canggih dari Google Tensor G3.', '{"Chip": "Google Tensor G3", "Layar": "6.7\\" Super Actua display", "Keamanan": "Titan M2 Chip", "Penyimpanan": "256GB", "Fitur Kamera": "Best Take, Magic Editor"}', 'products/google-pixel-8pro.jpeg', 150000, 4, '2025-12-15 07:42:37', '2025-12-15 07:42:37'),
	(12, 1, 'Xiaomi 14T Pro', 'xiaomi-14t-pro', 'Performa flagship dengan kamera hasil kolaborasi bersama Leica.', '{"Chip": "Snapdragon 8 Gen 4", "Layar": "6.7\\" CrystalRes AMOLED", "Kamera": "Leica optical lens", "Charging": "120W HyperCharge", "Penyimpanan": "512GB"}', 'products/xiaomi-14t-pro.jpeg', 140000, 6, '2025-12-15 07:42:37', '2025-12-15 07:42:37'),
	(13, 1, 'Vivo X100 Pro', 'vivo-x100-pro', 'Kemampuan fotografi profesional dengan lensa ZEISS APO Super-Telephoto.', '{"Chip": "Dimensity 9300", "Layar": "6.78\\" LTPO AMOLED", "Kamera": "ZEISS APO Super-Telephoto", "Sensor": "1-inch Sony IMX989", "Penyimpanan": "512GB"}', 'products/vivo-x100-pro.jpg', 135000, 5, '2025-12-15 07:42:37', '2025-12-15 07:42:37'),
	(14, 1, 'Asus ROG Phone 9 Pro', 'asus-rog-phone-9-pro', 'Smartphone gaming terbaik dengan sistem pendingin dan performa ekstrem.', '{"Chip": "Snapdragon 8 Gen 4", "Layar": "6.78\\" AMOLED 165Hz", "Baterai": "6.000 mAh", "Penyimpanan": "512GB", "Fitur Gaming": "AirTrigger buttons"}', 'products/asus-rog-phone-9-pro.jpeg', 180000, 3, '2025-12-15 07:42:37', '2025-12-15 07:42:37'),
	(15, 1, 'Oppo Find X8', 'oppo-find-x8', 'Desain premium dengan kemampuan kamera flagship dari Hasselblad.', '{"Chip": "Snapdragon 8 Gen 4", "Layar": "6.7\\" AMOLED QHD+", "Desain": "Ceramic Body", "Kamera": "Hasselblad Camera for Mobile", "Penyimpanan": "256GB"}', 'products/Oppo-Find-X8.jpg', 145000, 4, '2025-12-15 07:42:37', '2025-12-15 07:42:37'),
	(16, 2, 'MacBook Pro 2017', 'macbook-pro-2017', 'Laptop andal untuk produktivitas sehari-hari dengan layar Retina yang tajam.', '{"Port": "2x Thunderbolt 3", "Layar": "13.3\\" Retina Display", "Memori": "8GB RAM", "Prosesor": "Intel Core i5", "Penyimpanan": "256GB SSD"}', 'products/macbook-pro2017.jpeg', 150000, 7, '2025-12-15 07:42:37', '2025-12-15 07:42:37'),
	(17, 2, 'MacBook Air M1', 'macbook-air-m1', 'Tipis, ringan, dan super cepat berkat kekuatan chip Apple M1.', '{"Chip": "Apple M1 (8-core CPU, 7-core GPU)", "Layar": "13.3\\" Retina Display", "Memori": "8GB unified memory", "Baterai": "Hingga 18 jam", "Penyimpanan": "256GB SSD"}', 'products/macbook-air-m1.jpeg', 220000, 6, '2025-12-15 07:42:37', '2025-12-15 07:42:37'),
	(18, 2, 'MacBook Pro M2', 'macbook-pro-m2', 'Performa level pro untuk para profesional kreatif dengan chip Apple M2.', '{"Chip": "Apple M2 (8-core CPU, 10-core GPU)", "Fitur": "Touch Bar & Touch ID", "Layar": "13.3\\" Liquid Retina", "Memori": "8GB unified memory", "Penyimpanan": "256GB SSD"}', 'products/macbook-pro-m2.jpeg', 260000, 4, '2025-12-15 07:42:37', '2025-12-15 07:42:37'),
	(19, 2, 'Acer Nitro V15', 'acer-nitro-v15', 'Laptop gaming dengan refresh rate tinggi dan kartu grafis NVIDIA RTX.', '{"Layar": "15.6\\" FHD 144Hz IPS", "Grafis": "NVIDIA GeForce RTX 4050", "Memori": "16GB DDR5 RAM", "Prosesor": "Intel Core i5", "Penyimpanan": "512GB NVMe SSD"}', 'products/Acer-Nitro-V15.jpeg', 180000, 8, '2025-12-15 07:42:37', '2025-12-15 07:42:37'),
	(20, 2, 'Asus ROG Zephyrus G14', 'asus-rog-zephyrus-g14', 'Kombinasi sempurna antara portabilitas dan performa gaming kelas atas.', '{"Fitur": "AniMe Matrix Display", "Layar": "14\\" QHD 120Hz", "Grafis": "NVIDIA GeForce RTX 3060", "Memori": "16GB DDR4 RAM", "Prosesor": "AMD Ryzen 9"}', 'products/asus-rog-zephyrus.jpeg', 300000, 3, '2025-12-15 07:42:37', '2025-12-15 07:42:37');

-- Dumping structure for table digirent.rentals
CREATE TABLE IF NOT EXISTS `rentals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_price` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rentals_user_id_foreign` (`user_id`),
  KEY `rentals_product_id_foreign` (`product_id`),
  CONSTRAINT `rentals_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rentals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table digirent.rentals: ~0 rows (approximately)

-- Dumping structure for table digirent.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table digirent.sessions: ~1 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('FTh8kriLVlhBxR2aEPmDghdTxhzaiIjFgwN9IuFs', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRERNZWVLT0tVZUNudlVhRk9CcXkxZzdTZ0pkMlBNMzRiM1kzYXRGSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hdXRoL2dvb2dsZS9yZWRpcmVjdCI7czo1OiJyb3V0ZSI7czoyMDoiYXV0aC5nb29nbGUucmVkaXJlY3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjU6InN0YXRlIjtzOjQwOiI5S21WVlM2bGJnYnBWS0VTN3FBbTlRNEYyTTZVS0ZjWmxUczJmSnpwIjt9', 1765811719);

-- Dumping structure for table digirent.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table digirent.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin DigiRent', 'arvan12aa@gmail.com', NULL, NULL, 'admin', NULL, '$2y$12$awQDrL.zYdNn1h1R.mvzeODdHHBh/Y3b7Y46DrD8QRgw7cFdOwqHy', NULL, '2025-12-15 07:42:37', '2025-12-15 07:42:37');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

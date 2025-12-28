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


-- Dumping database structure for digirent_db
CREATE DATABASE IF NOT EXISTS `digirent_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `digirent_db`;

-- Dumping structure for table digirent_db.bookings
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table digirent_db.bookings: ~12 rows (approximately)
INSERT INTO `bookings` (`id`, `user_id`, `product_id`, `start_date`, `end_date`, `total_price`, `status`, `snap_token`, `created_at`, `updated_at`) VALUES
	(1, 2, 17, '2025-11-21 12:00:00', '2025-11-24 12:00:00', 660000, 'confirmed', NULL, '2025-11-14 14:12:29', '2025-11-14 14:13:54'),
	(2, 3, 18, '2025-11-17 12:00:00', '2025-11-18 12:00:00', 260000, 'confirmed', NULL, '2025-11-16 02:57:15', '2025-11-16 02:58:16'),
	(3, 3, 19, '2025-11-17 12:00:00', '2025-11-19 12:00:00', 360000, 'confirmed', NULL, '2025-11-16 03:06:45', '2025-11-16 03:07:32'),
	(4, 3, 18, '2025-11-17 12:00:00', '2025-11-18 12:00:00', 260000, 'confirmed', NULL, '2025-11-16 04:32:38', '2025-11-16 04:38:28'),
	(5, 3, 1, '2025-11-21 12:00:00', '2025-11-22 12:00:00', 75000, 'confirmed', NULL, '2025-11-16 06:11:29', '2025-12-22 06:38:33'),
	(6, 3, 1, '2025-11-21 12:00:00', '2025-11-22 12:00:00', 75000, 'confirmed', NULL, '2025-11-16 06:18:36', '2025-12-22 06:46:31'),
	(7, 3, 20, '2025-11-21 12:00:00', '2025-11-25 12:00:00', 1200000, 'confirmed', NULL, '2025-11-16 07:00:14', '2025-12-22 06:38:52'),
	(8, 3, 20, '2025-11-18 12:00:00', '2025-11-19 12:00:00', 300000, 'confirmed', '7c40da54-c29a-4262-abc9-260d60cdd1c0', '2025-11-16 07:02:58', '2025-12-22 06:38:41'),
	(9, 3, 18, '2025-11-17 12:00:00', '2025-11-18 12:00:00', 260000, 'confirmed', 'cbb31de2-eacc-408c-8fff-8c9eafab022f', '2025-11-16 07:06:04', '2025-11-16 07:06:58'),
	(10, 3, 17, '2025-11-18 12:00:00', '2025-11-20 12:00:00', 440000, 'confirmed', '52423da2-c0a4-4948-8a56-9f63a6dd8334', '2025-11-16 07:55:30', '2025-11-16 07:56:25'),
	(11, 3, 17, '2025-11-19 12:00:00', '2025-11-20 12:00:00', 220000, 'confirmed', '8f2d9915-27cd-42f3-8af5-5bdcd3c47def', '2025-11-17 02:06:38', '2025-12-22 06:26:42'),
	(12, 4, 18, '2025-12-17 12:00:00', '2025-12-23 12:00:00', 1560000, 'confirmed', '91019ad4-fec2-463d-9a5a-3c799822851a', '2025-12-16 08:38:53', '2025-12-16 08:40:11');

-- Dumping structure for table digirent_db.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table digirent_db.cache: ~0 rows (approximately)

-- Dumping structure for table digirent_db.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table digirent_db.cache_locks: ~0 rows (approximately)

-- Dumping structure for table digirent_db.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table digirent_db.categories: ~2 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Handphone', 'handphone', '2025-11-14 13:55:30', '2025-11-14 13:55:30'),
	(2, 'Laptop', 'laptop', '2025-11-14 13:55:30', '2025-11-14 13:55:30');

-- Dumping structure for table digirent_db.failed_jobs
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

-- Dumping data for table digirent_db.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table digirent_db.jobs
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

-- Dumping data for table digirent_db.jobs: ~0 rows (approximately)

-- Dumping structure for table digirent_db.job_batches
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

-- Dumping data for table digirent_db.job_batches: ~0 rows (approximately)

-- Dumping structure for table digirent_db.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table digirent_db.migrations: ~13 rows (approximately)
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
	(12, '2025_11_16_140132_add_snap_token_to_bookings_table', 2),
	(13, '2025_11_16_152658_add_phone_and_address_to_users_table', 3),
	(14, '2025_12_16_151009_add_google_id_to_users_table', 4);

-- Dumping structure for table digirent_db.news_items
CREATE TABLE IF NOT EXISTS `news_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table digirent_db.news_items: ~4 rows (approximately)
INSERT INTO `news_items` (`id`, `title`, `description`, `image_path`, `link_url`, `created_at`, `updated_at`) VALUES
	(1, 'Apple Tambahkan Fitur Penyaring Pesan di iOS 26', 'Pembaruan iOS 26 hadirkan solusi untuk filter pesan asing dan spam. Fitur ini membantu pengguna menyaring secara otomatis, memisahkan, hingga mendeteksi pesan spam.', 'news_images/9EDtoZkpk2SSL3ekxsQZVcC4jioWbce4RCeK1qAo.jpg', 'https://www.liputan6.com/tekno/read/6208607/apple-tambahkan-fitur-penyaring-pesan-di-ios-26-begini-cara-mengaktifkannya', '2025-11-16 02:44:13', '2025-11-16 02:44:13'),
	(2, 'Lenovo Yoga 9i 2-in-1 Aura Edition, Laptop AI Serbabisa untuk Hiburan dan Produktivitas Tanpa Batas', 'Lenovo Yoga 9i 2-in-1 Aura Edition menghadirkan kinerja AI bertenaga Intel® Core? Ultra 7 258V yang mampu menyesuaikan performa, daya, dan suhu secara cerdas', 'news_images/3ch7ubcJTUMeIu3oAMgsNgPb7ptq8eRMI0HPLHcD.jpg', 'https://tekno.kompas.com/read/2025/11/14/13084297/lenovo-yoga-9i-2-in-1-aura-edition-laptop-ai-serbabisa-untuk-hiburan-dan', '2025-11-16 02:48:25', '2025-11-16 02:48:25'),
	(3, 'Kunci Oppo Jadi HP Kelas Dunia: Ajukan 115.000 Paten dan 94 Persen Original', 'Overseas CPO OPPO mengungkap strategi inovasi perusahaan yang didorong oleh paten. Lebih dari 115.000 aplikasi paten telah diajukan.', 'news_images/IGXshuLv15pMsej4vB92jn282P4FIdBYAdANMbSQ.jpg', 'https://www.liputan6.com/tekno/read/6211517/kunci-oppo-jadi-hp-kelas-dunia-ajukan-115000-paten-dan-94-persen-original', '2025-11-16 03:14:55', '2025-11-16 03:14:55'),
	(4, 'Harga HP Samsung S25 Edge Terbaru November 2025, Turun Banyak Terimbas Rilisnya Galaxy S26 Ultra', 'Samsung Galaxy S25 Edge mengusung bodi ultra tipis yang telah dipamerkan di Korea lewat Instagram @samsungkorea, Jumat (14/11/2025). Berikut harga HP Samsung S25 Edge sekarang yang kena imbas rilisnya Samsung S26.', 'news_images/fowLhAfrLlMznVSofLFsCgLj0GVvnpQlcrxRBJ1d.webp', 'https://bangka.tribunnews.com/techno/1669163/harga-hp-samsung-s25-edge-terbaru-november-2025-turun-banyak-terimbas-rilisnya-galaxy-s26ultra', '2025-11-16 03:18:00', '2025-11-16 03:18:44');

-- Dumping structure for table digirent_db.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table digirent_db.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table digirent_db.products
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

-- Dumping data for table digirent_db.products: ~20 rows (approximately)
INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `description`, `specifications`, `image`, `price_per_day`, `stock`, `created_at`, `updated_at`) VALUES
	(1, 1, 'iPhone XR', 'iphone-xr', 'Smartphone andal dengan layar Liquid Retina HD dan performa A12 Bionic.', '{"Chip": "A12 Bionic", "Layar": "6.1\\" Liquid Retina HD", "Kamera": "12MP Wide", "Face ID": "Ya", "Penyimpanan": "64GB"}', 'products/sqevkmD1NruV3VM9MvYKkfCEh4ZergjQwxLnFefl.jpg', 75000, 10, '2025-11-14 13:55:30', '2025-11-16 04:04:07'),
	(2, 1, 'iPhone 11', 'iphone-11', 'Dilengkapi sistem kamera ganda (Ultra Wide) dan Chip A13 Bionic yang powerful.', '{"Chip": "A13 Bionic", "Layar": "6.1\\" Liquid Retina HD", "Video": "4K 60fps", "Kamera": "Dual 12MP (Wide, Ultra Wide)", "Penyimpanan": "128GB"}', 'products/U4QICfseTn83SOcGmXM3rvl0mWncjspooc7HMEso.jpg', 85000, 8, '2025-11-14 13:55:30', '2025-11-16 04:06:54'),
	(3, 1, 'iPhone 13', 'iphone-13', 'Layar Super Retina XDR yang cerah dengan Chip A15 Bionic super cepat dan mode Sinematik.', '{"Chip": "A15 Bionic", "Fitur": "Mode Sinematik", "Layar": "6.1\\" Super Retina XDR", "Kamera": "Dual 12MP Pro System", "Penyimpanan": "128GB"}', 'products/AD41XmwCggrxLFvzV13eybpSH4uTtOILtn1UctZX.jpg', 100000, 7, '2025-11-14 13:55:30', '2025-11-16 04:08:40'),
	(4, 1, 'iPhone 14 Pro', 'iphone-14-pro', 'Memperkenalkan Dynamic Island, kamera utama 48MP, dan Chip A16 Bionic.', '{"Chip": "A16 Bionic", "Layar": "6.1\\" Super Retina XDR", "Fitur Layar": "Dynamic Island", "Penyimpanan": "256GB", "Kamera Utama": "48MP ProRAW"}', 'products/gY5NDu9g5cyntsW809F9NMc2FIDHeWSMj9rRuSQk.jpg', 135000, 5, '2025-11-14 13:55:30', '2025-11-16 04:12:08'),
	(5, 1, 'iPhone 15 Pro Max', 'iphone-15-pro-max', 'Ditempa dari titanium, dengan Chip A17 Pro pengubah game, dan tombol Tindakan.', '{"Chip": "A17 Pro", "Layar": "6.7\\" Super Retina XDR", "Material": "Titanium", "Zoom Optik": "5x Telefoto", "Penyimpanan": "256GB", "Kamera Utama": "48MP"}', 'products/6FaAQ8KjXK2z3O4ga7sJfqYEBctE93MqbvKVZHSi.jpg', 180000, 4, '2025-11-14 13:55:30', '2025-11-16 04:12:23'),
	(6, 1, 'Samsung Galaxy S23 Ultra', 'samsung-galaxy-s23-ultra', 'Kamera 200MP revolusioner, S Pen terintegrasi, dan performa gaming terbaik.', '{"Chip": "Snapdragon 8 Gen 2 for Galaxy", "Layar": "6.8\\" Dynamic AMOLED 2X", "Stylus": "S Pen Built-in", "Penyimpanan": "256GB", "Kamera Utama": "200MP"}', 'products/A8TbFOCopSlaTHM9Woo4MiRllYDNLe2gNNBDmbuq.webp', 165000, 5, '2025-11-14 13:55:30', '2025-11-16 04:14:41'),
	(7, 1, 'Samsung Galaxy S24 Ultra', 'samsung-galaxy-s24-ultra', 'Era baru AI seluler dengan Galaxy AI, S Pen, dan frame titanium yang kokoh.', '{"Chip": "Snapdragon 8 Gen 3 for Galaxy", "Layar": "6.8\\" Dynamic AMOLED 2X", "Fitur AI": "Galaxy AI", "Material": "Titanium", "Penyimpanan": "256GB", "Kamera Utama": "200MP"}', 'products/YX6ORlH5KiD6WdkndDjWHAiCOAxkywVo1GTXxw66.jpg', 190000, 4, '2025-11-14 13:55:30', '2025-11-16 04:16:48'),
	(8, 1, 'Samsung Galaxy S25 Ultra', 'samsung-galaxy-s25-ultra', 'Kekuatan masa depan dengan chip terbaru dan peningkatan kamera signifikan.', '{"Chip": "Snapdragon 8 Gen 4", "Layar": "6.9\\" Dynamic AMOLED 2X", "Baterai": "5.500 mAh", "Penyimpanan": "512GB", "Kamera Utama": "200MP ISOCELL Sensor"}', 'products/sGJjngJv6MgDAcBYo0EV9p7qmIhHeYHsfubTnzCR.jpg', 220000, 3, '2025-11-14 13:55:30', '2025-11-16 04:16:30'),
	(9, 1, 'Samsung Galaxy Z Flip 6', 'samsung-galaxy-z-flip-6', 'Ponsel lipat ringkas dengan layar cover lebih besar dan performa andal.', '{"Chip": "Snapdragon 8 Gen 3", "Ketahanan": "IPX8 Water Resistant", "Layar Cover": "3.4\\" Super AMOLED", "Layar Utama": "6.7\\" Foldable Dynamic AMOLED", "Penyimpanan": "256GB"}', 'products/KjS3IARkQYqyCfW3lKpHiAzdJxKMN6Mo7YuMejnb.jpg', 170000, 5, '2025-11-14 13:55:30', '2025-11-16 04:19:10'),
	(10, 1, 'Samsung Galaxy Z Flip 7', 'samsung-galaxy-z-flip-7', 'Desain lebih tipis, engsel tanpa celah, dan ditenagai chipset tercanggih.', '{"Chip": "Snapdragon 8 Gen 4", "Engsel": "Ironflex Hinge", "Kamera": "50MP Wide", "Layar Utama": "6.7\\" Foldable Dynamic AMOLED", "Penyimpanan": "512GB"}', 'products/ybbG4d9xVfeyn9supaXaKK4CuE9t2eqyaWpABn69.jpg', 200000, 3, '2025-11-14 13:55:30', '2025-11-16 04:18:51'),
	(11, 1, 'Google Pixel 8 Pro', 'google-pixel-8-pro', 'Kamera pintar dengan fitur AI canggih dari Google Tensor G3.', '{"Chip": "Google Tensor G3", "Layar": "6.7\\" Super Actua display", "Keamanan": "Titan M2 Chip", "Penyimpanan": "256GB", "Fitur Kamera": "Best Take, Magic Editor"}', 'products/2yGVn4BfyQKFVTPOjZh1eYV698qqFbMqh4ATWHgy.jpg', 150000, 4, '2025-11-14 13:55:30', '2025-11-16 04:29:23'),
	(12, 1, 'Xiaomi 14T Pro', 'xiaomi-14t-pro', 'Performa flagship dengan kamera hasil kolaborasi bersama Leica.', '{"Chip": "Snapdragon 8 Gen 4", "Layar": "6.7\\" CrystalRes AMOLED", "Kamera": "Leica optical lens", "Charging": "120W HyperCharge", "Penyimpanan": "512GB"}', 'products/PUrJ50mSm4cbMApyjFMmSJc2lJjtHcluBkpD0HYE.jpg', 140000, 6, '2025-11-14 13:55:30', '2025-11-16 04:29:38'),
	(13, 1, 'Vivo X100 Pro', 'vivo-x100-pro', 'Kemampuan fotografi profesional dengan lensa ZEISS APO Super-Telephoto.', '{"Chip": "Dimensity 9300", "Layar": "6.78\\" LTPO AMOLED", "Kamera": "ZEISS APO Super-Telephoto", "Sensor": "1-inch Sony IMX989", "Penyimpanan": "512GB"}', 'products/s6Bjghixq4BIMi23K6suJlbGVfpZ8xcbK92GsmEZ.webp', 135000, 5, '2025-11-14 13:55:30', '2025-11-16 04:29:00'),
	(14, 1, 'Asus ROG Phone 9 Pro', 'asus-rog-phone-9-pro', 'Smartphone gaming terbaik dengan sistem pendingin dan performa ekstrem.', '{"Chip": "Snapdragon 8 Gen 4", "Layar": "6.78\\" AMOLED 165Hz", "Baterai": "6.000 mAh", "Penyimpanan": "512GB", "Fitur Gaming": "AirTrigger buttons"}', 'products/Fryp8ntLAPZBZHaXkonupy7svNMzKCfhSLwC7F7C.jpg', 180000, 3, '2025-11-14 13:55:30', '2025-11-16 04:28:46'),
	(15, 1, 'Oppo Find X8', 'oppo-find-x8', 'Desain premium dengan kemampuan kamera flagship dari Hasselblad.', '{"Chip": "Snapdragon 8 Gen 4", "Layar": "6.7\\" AMOLED QHD+", "Desain": "Ceramic Body", "Kamera": "Hasselblad Camera for Mobile", "Penyimpanan": "256GB"}', 'products/awdQdtV81xE9ZYCVazIVnzZboNSZ6noLWlhl6ceJ.jpg', 145000, 4, '2025-11-14 13:55:30', '2025-11-16 04:28:34'),
	(16, 2, 'MacBook Pro 2017', 'macbook-pro-2017', 'Laptop andal untuk produktivitas sehari-hari dengan layar Retina yang tajam.', '{"Port": "2x Thunderbolt 3", "Layar": "13.3\\" Retina Display", "Memori": "8GB RAM", "Prosesor": "Intel Core i5", "Penyimpanan": "256GB SSD"}', 'products/I414HvqNLtQlLsFlUEZnpfYTG3ovFrY0AIgi04FQ.jpg', 150000, 7, '2025-11-14 13:55:31', '2025-11-16 03:56:37'),
	(17, 2, 'MacBook Air M1', 'macbook-air-m1', 'Tipis, ringan, dan super cepat berkat kekuatan chip Apple M1.', '{"Chip": "Apple M1 (8-core CPU, 7-core GPU)", "Layar": "13.3\\" Retina Display", "Memori": "8GB unified memory", "Baterai": "Hingga 18 jam", "Penyimpanan": "256GB SSD"}', 'products/HtmeDP0Mv7t7XiuVkTjU4pVOIPfhwf4UOkUAHitK.jpg', 220000, 6, '2025-11-14 13:55:31', '2025-11-16 03:58:17'),
	(18, 2, 'MacBook Pro M2', 'macbook-pro-m2', 'Performa level pro untuk para profesional kreatif dengan chip Apple M2.', '{"Chip": "Apple M2 (8-core CPU, 10-core GPU)", "Fitur": "Touch Bar & Touch ID", "Layar": "13.3\\" Liquid Retina", "Memori": "8GB unified memory", "Penyimpanan": "256GB SSD"}', 'products/So5t5bjVyfAJjkCwYssXHS1iPcf6Ad2qXvjwOOtW.webp', 260000, 4, '2025-11-14 13:55:31', '2025-11-16 04:01:23'),
	(19, 2, 'Acer Nitro V15', 'acer-nitro-v15', 'Laptop gaming dengan refresh rate tinggi dan kartu grafis NVIDIA RTX.', '{"Layar": "15.6\\" FHD 144Hz IPS", "Grafis": "NVIDIA GeForce RTX 4050", "Memori": "16GB DDR5 RAM", "Prosesor": "Intel Core i5", "Penyimpanan": "512GB NVMe SSD"}', 'products/GHoYPHlWFWuQBwwWQ0LwjAWaOW1SfOwaLvL8dpY0.jpg', 180000, 8, '2025-11-14 13:55:31', '2025-11-16 04:01:40'),
	(20, 2, 'Asus ROG Zephyrus G14', 'asus-rog-zephyrus-g14', 'Kombinasi sempurna antara portabilitas dan performa gaming kelas atas.', '{"Fitur": "AniMe Matrix Display", "Layar": "14\\" QHD 120Hz", "Grafis": "NVIDIA GeForce RTX 3060", "Memori": "16GB DDR4 RAM", "Prosesor": "AMD Ryzen 9"}', 'products/qZWw6S8OZA0TpbbpTzAnjUMW2NTGnkNyJ7GJ2ggw.jpg', 300000, 3, '2025-11-14 13:55:31', '2025-11-16 04:01:55');

-- Dumping structure for table digirent_db.rentals
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

-- Dumping data for table digirent_db.rentals: ~0 rows (approximately)

-- Dumping structure for table digirent_db.sessions
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

-- Dumping data for table digirent_db.sessions: ~3 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('4x7qmvq3RIV1eL2syGZpVP16Cu5ebEhvbK44hXNW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMllYMXJWeVNaQ1ZDTkZDam5HbFVleEVQcWpzZkU4YVRMMTNLOWd2RiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1766751465),
	('89ipD3uIGvJ62fyxdYQbj3nb3w0SbMiKLDEyq1Cg', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTHIyYlVrMFcxS2diRDJzZXBGSDRhWDNBY3hCbDE4SHliSTNjbHUyZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6ImFkbWluLmRhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1766411192),
	('HcnqEuRFTLm4DAghX35xnNGwI4BtpY2lZM46YCWG', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUHdKdVkyTFpsRXlCTERlUXdBampnTk1hSm44dGE3SW0yVUNCZzdXaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1766821433),
	('oXbxi7VLdc3Ds9ASmfKZmDrpf5KHQDT6V37xP9KP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid0U5Wk1oY3RJZm5TWWdaUGUybk1Eem1FTDJieXJXRnNPeUFrYWh6dCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1766751466);

-- Dumping structure for table digirent_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table digirent_db.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `google_id`, `phone`, `address`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin MYcell', 'arvan12aa@gmail.com', '100822349760959781128', '085175394607', NULL, 'admin', NULL, '$2y$12$aApnkXD.KcLMpwkMy6WQ4.kDY27P/MukbhrqZmO5BDl.vJUKIaMf.', NULL, '2025-11-14 13:55:30', '2025-12-16 08:36:22'),
	(2, 'Arvan M', 'wahyuningsih7203@gmail.com', NULL, NULL, NULL, 'user', NULL, '$2y$12$vzCZ3wHCf9LvJ/Hp9W5X..uDqm7gekS4lOfpIX4XHhAz8E8kSSkvq', NULL, '2025-11-14 14:12:02', '2025-11-14 14:12:02'),
	(3, 'Arvan Murbiyanto', '2311102074@ittelkom-pwt.ac.id', NULL, '088221498209', 'jl.tk pertiwi kemandungan', 'user', NULL, '$2y$12$WwmsqqtgF.1fneO37pLm8.1ZoQOxJtRscP1ociVBXfjcdLEvzRvhO', NULL, '2025-11-16 02:55:39', '2025-11-16 08:32:00'),
	(4, 'Ihsan Nafis Hidayat', 'ihsannafishidayat@gmail.com', '107483649985970358174', NULL, NULL, 'user', NULL, '$2y$12$2641oDU1fKzW7TcxKOBsj.fC4hqjKMzX20G4jIiGFKKC7P6AAQzIC', NULL, '2025-12-16 08:38:27', '2025-12-16 08:38:27');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

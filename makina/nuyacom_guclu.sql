-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 15 Eki 2025, 09:38:05
-- Sunucu sürümü: 10.5.26-MariaDB
-- PHP Sürümü: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `nuyacom_guclu`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `role` enum('admin','moderator') DEFAULT 'admin',
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `admins`
--

INSERT INTO `admins` (`id`, `username`, `password_hash`, `email`, `full_name`, `role`, `last_login`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'admin', '$2y$10$USY.bJL7h3JlZY/I9IIa3efAbJL0AgaqLMV61cSugXOywBQjyrB.K', 'admin@gucluotomotiv.com', 'Admin Kullanıcı', 'admin', '2025-10-15 09:20:29', '2025-10-06 18:05:46', '2025-10-15 06:20:29', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `backup_logs`
--

CREATE TABLE `backup_logs` (
  `id` int(11) NOT NULL,
  `backup_file` varchar(255) NOT NULL,
  `backup_size` bigint(20) DEFAULT NULL,
  `backup_type` enum('manual','automatic') DEFAULT 'automatic',
  `status` enum('success','failed') DEFAULT 'success',
  `error_message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `slug`, `description`, `created_at`) VALUES
(1, 'Araç İncelemeleri', 'arac-incelemeleri', 'Detaylı araç incelemeleri ve testleri', '2025-10-08 06:32:28'),
(2, 'Bakım Tavsiyeleri', 'bakim-tavsiyeleri', 'Araç bakım ve onarım önerileri', '2025-10-08 06:32:28'),
(3, 'Haberler', 'haberler', 'Otomotiv sektöründen son haberler', '2025-10-08 06:32:28'),
(4, 'Alım Satım Rehberi', 'alim-satim-rehberi', 'İkinci el araç alım satım ipuçları', '2025-10-08 06:32:28');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `excerpt` text DEFAULT NULL,
  `featured_image` varchar(500) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT 0,
  `status` enum('draft','published') DEFAULT 'draft',
  `published_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text NOT NULL,
  `status` enum('new','read','replied') DEFAULT 'new',
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `daily_stats`
--

CREATE TABLE `daily_stats` (
  `id` int(11) NOT NULL,
  `stat_date` date NOT NULL,
  `total_views` int(11) DEFAULT 0,
  `total_offers` int(11) DEFAULT 0,
  `total_vehicles_added` int(11) DEFAULT 0,
  `total_vehicles_sold` int(11) DEFAULT 0,
  `unique_visitors` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `daily_stats`
--

INSERT INTO `daily_stats` (`id`, `stat_date`, `total_views`, `total_offers`, `total_vehicles_added`, `total_vehicles_sold`, `unique_visitors`, `created_at`) VALUES
(1, '2025-10-13', 0, 1, 1, 0, 0, '2025-10-13 08:51:07');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `display_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `features`
--

INSERT INTO `features` (`id`, `icon`, `title`, `description`, `display_order`, `is_active`, `created_at`) VALUES
(1, '✓', '2000+ Mutlu Müşteri', '20 yıldır binlerce müşterimize güvenilir hizmet sunuyoruz', 1, 1, '2025-10-14 20:17:28'),
(2, '🔍', 'Ekspertiz Garantisi', 'Tüm araçlarımız detaylı ekspertiz kontrolünden geçer', 2, 1, '2025-10-14 20:17:28'),
(3, '🤝', 'Takas İmkanı', 'Aracınızı değerinde değerlendirip takas yapabilirsiniz', 3, 1, '2025-10-14 20:17:28'),
(4, '📋', 'Tüm İşlemler', 'Ruhsat, noter, sigorta işlemlerinizi biz hallederiz', 4, 1, '2025-10-14 20:17:28');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hero_banner`
--

CREATE TABLE `hero_banner` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` text DEFAULT NULL,
  `background_image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `hero_banner`
--

INSERT INTO `hero_banner` (`id`, `title`, `subtitle`, `background_image`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Hayalinizdeki Araca Güvenle Ulaşın', 'Güçlü Otomotiv olarak, 20 yıllık tecrübemizle size en kaliteli ikinci el araçları sunuyoruz.', NULL, 1, '2025-10-14 20:18:41', '2025-10-14 20:18:41');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `offer_type` enum('buy','sell','exchange') NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `vehicle_info` text DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('new','contacted','completed','cancelled') DEFAULT 'new',
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `offers`
--

INSERT INTO `offers` (`id`, `vehicle_id`, `offer_type`, `customer_name`, `customer_phone`, `customer_email`, `vehicle_info`, `message`, `status`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, NULL, 'sell', 'Bahaeddin KILIÇ', '05454321110', 'cankira@hotmail.com.tr', 'Hyundai', 'Satmak istiyorum', 'new', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-13 08:51:07', '2025-10-13 08:51:07');

--
-- Tetikleyiciler `offers`
--
DELIMITER $$
CREATE TRIGGER `after_offer_insert` AFTER INSERT ON `offers` FOR EACH ROW BEGIN
    INSERT INTO daily_stats (stat_date, total_offers)
    VALUES (CURDATE(), 1)
    ON DUPLICATE KEY UPDATE total_offers = total_offers + 1;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `security_logs`
--

CREATE TABLE `security_logs` (
  `id` int(11) NOT NULL,
  `log_type` enum('login_success','login_failed','logout','data_change','suspicious') NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `security_logs`
--

INSERT INTO `security_logs` (`id`, `log_type`, `username`, `ip_address`, `user_agent`, `details`, `created_at`) VALUES
(1, 'login_failed', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'Invalid credentials', '2025-10-06 18:22:30'),
(2, 'login_failed', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'Invalid credentials', '2025-10-06 18:23:06'),
(3, 'login_failed', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'Invalid credentials', '2025-10-06 18:23:10'),
(4, 'login_failed', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'Invalid credentials', '2025-10-06 18:23:56'),
(5, 'login_failed', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'Invalid credentials', '2025-10-06 18:24:06'),
(6, 'login_failed', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'Rate limit exceeded', '2025-10-06 18:24:39'),
(7, 'login_success', 'admin', '37.154.74.169', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', 'Admin login successful', '2025-10-06 18:25:50'),
(8, 'login_failed', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'Rate limit exceeded', '2025-10-06 18:27:22'),
(9, 'login_success', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'Admin login successful', '2025-10-06 19:39:51'),
(10, 'login_success', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'Admin login successful', '2025-10-06 19:51:43'),
(11, 'login_success', 'admin', '37.154.74.169', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', 'Admin login successful', '2025-10-06 21:27:08'),
(12, 'login_success', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'Admin login successful', '2025-10-07 15:20:51'),
(13, 'login_failed', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Invalid credentials', '2025-10-08 06:21:31'),
(14, 'login_success', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Admin login successful', '2025-10-08 06:21:36'),
(15, 'login_failed', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Invalid credentials', '2025-10-08 19:49:15'),
(16, 'login_success', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Admin login successful', '2025-10-08 19:49:19'),
(17, 'data_change', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Vehicle deleted: 1', '2025-10-08 19:50:27'),
(18, '', 'Bahaeddin KILIÇ', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Offer ID: 1, Type: sell', '2025-10-13 08:51:07'),
(19, 'login_success', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Admin login successful', '2025-10-13 20:08:48'),
(20, 'data_change', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Vehicle added: 4', '2025-10-13 20:14:11'),
(21, 'data_change', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Image added to vehicle: 4', '2025-10-13 20:14:38'),
(22, 'data_change', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Image added to vehicle: 4', '2025-10-13 20:14:47'),
(23, 'data_change', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Image added to vehicle: 4', '2025-10-13 20:14:55'),
(24, 'data_change', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Image added to vehicle: 4', '2025-10-13 20:15:04'),
(25, 'data_change', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Vehicle updated: 4', '2025-10-13 20:15:11'),
(26, 'login_failed', 'admin', '94.235.232.63', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Invalid credentials', '2025-10-14 08:50:53'),
(27, 'login_success', 'admin', '94.235.232.63', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Admin login successful', '2025-10-14 08:51:04'),
(28, 'data_change', 'admin', '94.235.232.63', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Mobile Safari/537.36', 'Settings updated', '2025-10-14 08:52:42'),
(29, 'login_success', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Admin login successful', '2025-10-14 12:00:23'),
(30, 'login_success', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Admin login successful', '2025-10-14 20:14:56'),
(31, 'data_change', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Banner settings updated', '2025-10-14 20:21:00'),
(32, 'data_change', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Banner settings updated', '2025-10-14 20:21:19'),
(33, 'data_change', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Banner settings updated', '2025-10-14 20:22:49'),
(34, 'data_change', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Banner settings updated', '2025-10-14 20:23:10'),
(35, 'data_change', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Banner settings updated', '2025-10-14 20:27:13'),
(36, 'data_change', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Banner settings updated', '2025-10-14 20:30:17'),
(37, 'login_success', 'admin', '188.132.164.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'Admin login successful', '2025-10-15 06:20:29');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `display_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `services`
--

INSERT INTO `services` (`id`, `icon`, `title`, `description`, `display_order`, `is_active`, `created_at`) VALUES
(1, '🚗', 'Araç Alım-Satım', 'Geniş araç yelpazemizden size en uygun aracı bulun.', 1, 1, '2025-10-14 20:17:28'),
(2, '🔄', 'Takas', 'Mevcut aracınızı en iyi fiyattan değerlendiriyoruz.', 2, 1, '2025-10-14 20:17:28'),
(3, '🔧', 'Bakım & Onarım', 'Aracınızın tüm bakım ve onarım işlemleri için yanınızda.', 3, 1, '2025-10-14 20:17:28'),
(4, '📋', 'Ekspertiz Hizmeti', 'Profesyonel ekibimizle detaylı araç kontrolü yapıyoruz.', 4, 1, '2025-10-14 20:17:28'),
(13, '💰', 'Kredi Desteği', 'Uygun faiz oranlarında araç kredisi imkanı.', 4, 1, '2025-10-15 06:17:44'),
(14, '📋', 'İşlem Kolaylığı', 'Tüm işlemlerinizi biz hallederiz.', 5, 1, '2025-10-15 06:17:44'),
(15, '💼', 'Danışmanlık', '20 yıllık tecrübemizle rehberlik ederiz.', 6, 1, '2025-10-15 06:17:44'),
(22, '🚗', 'deneme', 'deneme', 8, 1, '2025-10-15 06:20:45');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `setting_type` varchar(50) DEFAULT 'text',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `settings`
--

INSERT INTO `settings` (`id`, `setting_key`, `setting_value`, `setting_type`, `updated_at`) VALUES
(1, 'site_title', 'Güçlü Otomotiv', 'text', '2025-10-06 18:05:46'),
(2, 'site_phone', '0328 123 45 67', 'text', '2025-10-06 18:05:46'),
(3, 'site_mobile', '0532 123 45 67', 'text', '2025-10-06 18:05:46'),
(4, 'site_email', 'info@gucluotomotiv.com', 'text', '2025-10-06 18:05:46'),
(5, 'site_address', 'Atatürk Cad. No: 123, Merkez / Osmaniye', 'text', '2025-10-06 18:05:46'),
(6, 'whatsapp_number', '905321234567', 'text', '2025-10-06 18:05:46'),
(7, 'sahibinden_profile', 'https://gucluotomotivosmaniye.sahibinden.com/', 'text', '2025-10-06 18:05:46'),
(8, 'facebook_url', 'https://gucluotomotivosmaniye.sahibinden.com/', 'text', '2025-10-14 08:52:42'),
(9, 'instagram_url', 'https://gucluotomotivosmaniye.sahibinden.com/', 'text', '2025-10-14 08:52:42'),
(10, 'youtube_url', 'https://gucluotomotivosmaniye.sahibinden.com/', 'text', '2025-10-14 08:52:42'),
(11, 'slider_autoplay', '1', 'boolean', '2025-10-06 18:05:46'),
(12, 'slider_speed', '5000', 'number', '2025-10-06 18:05:46'),
(13, 'admin_email', 'admin@gucluotomotiv.com', 'text', '2025-10-08 06:32:28'),
(14, 'smtp_host', 'smtp.gmail.com', 'text', '2025-10-08 06:32:28'),
(15, 'smtp_port', '587', 'number', '2025-10-08 06:32:28'),
(16, 'smtp_username', '', 'text', '2025-10-08 06:32:28'),
(17, 'smtp_password', '', 'password', '2025-10-08 06:32:28'),
(18, 'enable_email_notifications', '1', 'boolean', '2025-10-08 06:32:28'),
(19, 'hero_slider_enabled', '0', 'boolean', '2025-10-14 08:52:42'),
(20, 'site_logo_text', 'Güçlü Otomotivva', 'text', '2025-10-14 20:30:17'),
(21, 'banner_title', 'Güvenle Alın, Huzurla Sürün', 'text', '2025-10-14 20:23:10'),
(22, 'banner_subtitle', '20 Yıllık Tecrübe ile İkinci El Araç Alım Satım', 'text', '2025-10-14 20:21:00'),
(23, 'banner_button_text', 'Araçları İncele', 'text', '2025-10-14 20:21:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `site_logo`
--

CREATE TABLE `site_logo` (
  `id` int(11) NOT NULL,
  `logo_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `site_logo`
--

INSERT INTO `site_logo` (`id`, `logo_path`, `uploaded_at`) VALUES
(2, 'assets/images/logo.png', '2025-10-14 20:18:41');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_location` varchar(255) DEFAULT NULL,
  `customer_title` varchar(255) DEFAULT NULL,
  `rating` int(11) DEFAULT 5,
  `comment` text NOT NULL,
  `display_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `testimonials`
--

INSERT INTO `testimonials` (`id`, `customer_name`, `customer_location`, `customer_title`, `rating`, `comment`, `display_order`, `is_active`, `created_at`) VALUES
(1, 'Ahmet Yılmaz', NULL, 'BMW 3.20i Sahibi', 5, 'Güçlü Otomotiv ile çalışmak harika bir deneyimdi. Profesyonel yaklaşımları ve dürüstlükleri takdire şayan.', 1, 1, '2025-10-14 20:19:58'),
(2, 'Ayşe Demir', NULL, 'Mercedes C180 Sahibi', 5, 'Hayalimdeki arabayı bulmaları ve tüm süreçte yanımda olmaları için çok teşekkür ederim.', 2, 1, '2025-10-14 20:19:58'),
(3, 'Mehmet Kaya', NULL, 'Audi A4 Sahibi', 5, '20 yıllık tecrübeleri her şeyden belli. Güven ve kalite bir arada. Herkese tavsiye ederim.', 3, 1, '2025-10-14 20:19:58'),
(4, 'deneme', NULL, NULL, 5, 'deneme', 4, 1, '2025-10-15 06:33:52');

-- --------------------------------------------------------

--
-- Görünüm yapısı durumu `testimonial_stats`
-- (Asıl görünüm için aşağıya bakın)
--
CREATE TABLE `testimonial_stats` (
);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` varchar(50) NOT NULL,
  `year` varchar(10) NOT NULL,
  `km` varchar(50) NOT NULL,
  `fuel` enum('Dizel','Benzin','Benzin/LPG','Hybrid','Elektrik') NOT NULL,
  `transmission` enum('Manuel','Otomatik','Yarı Otomatik') DEFAULT 'Manuel',
  `color` varchar(50) DEFAULT NULL,
  `body_type` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(500) NOT NULL,
  `sahibinden_link` varchar(500) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `is_sold` tinyint(1) DEFAULT 0,
  `is_customer_vehicle` tinyint(1) DEFAULT 0,
  `customer_name` varchar(100) DEFAULT NULL,
  `customer_phone` varchar(20) DEFAULT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `views` int(11) DEFAULT 0,
  `status` enum('active','pending','sold') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `vehicles`
--

INSERT INTO `vehicles` (`id`, `title`, `price`, `year`, `km`, `fuel`, `transmission`, `color`, `body_type`, `description`, `image`, `sahibinden_link`, `is_featured`, `is_sold`, `is_customer_vehicle`, `customer_name`, `customer_phone`, `customer_email`, `views`, `status`, `created_at`, `updated_at`) VALUES
(2, 'VOLKSWAGEN CADDY 2.0 TDI LIFE', '1.695.000 TL', '2025', '10.000 km', 'Dizel', 'Otomatik', NULL, NULL, NULL, 'https://i0.shbdn.com/photos/80/99/17/1273809917nnm.jpg', 'https://www.sahibinden.com/ilan/vasita-minivan-panelvan-volkswagen-boyasiz-degisensiz-hasarkayitsiz.arac-faturalidir-ilk-sahibi-1273809917/detay', 1, 0, 0, NULL, NULL, NULL, 2, 'active', '2025-10-06 18:05:46', '2025-10-13 08:49:59'),
(3, 'MERCEDES CLS 350 CDI 4MATIC', '1.649.000 TL', '2021', '38.000 km', 'Benzin', 'Otomatik', NULL, NULL, NULL, 'https://i0.shbdn.com/photos/38/23/58/1249382358fc6.jpg', 'https://www.sahibinden.com/ilan/vasita-otomobil-mercedes-benz-arac-masrafsiz-en-dolusu-amg-1249382358/detay', 1, 0, 0, NULL, NULL, NULL, 0, 'active', '2025-10-06 18:05:46', '2025-10-06 18:05:46'),
(4, 'Citroen Berlingo 1.5 BlueHDI Feel Bold', '1.140.000', '2023', '50.000', 'Dizel', 'Otomatik', 'Gri', 'Minivan', 'CİTROEN BERLİNGO 1.5 BLUEHDI FEEL BOLD 130 HP DİZEL OTOMATİK .\r\n HATASIZ BOYASIZ .\r\nTRAMER KAYITSIZ .\r\nKM 50 BİN ORJİNAL .\r\nGÜNCEL EKSPERTİZ RESİMLERDE.\r\nMOTOR YÜRÜYEN ALT TAKIM MASRAFSIZDIR.İÇ VE DIŞ KOZMETİKLERİ FİRMAMIZ TARAFINDAN YAPILMIŞTIR', 'https://i0.shbdn.com/photos/13/20/93/12761320932gz.jpg', 'https://www.sahibinden.com/ilan/vasita-minivan-panelvan-citroen-2023-model-hatasiz-boyasiz-tramer-kayitsiz-50-binde-1276132093/detay', 1, 0, 0, NULL, NULL, NULL, 8, 'active', '2025-10-13 20:14:11', '2025-10-13 20:43:33');

--
-- Tetikleyiciler `vehicles`
--
DELIMITER $$
CREATE TRIGGER `after_vehicle_insert` AFTER INSERT ON `vehicles` FOR EACH ROW BEGIN
    INSERT INTO daily_stats (stat_date, total_vehicles_added)
    VALUES (CURDATE(), 1)
    ON DUPLICATE KEY UPDATE total_vehicles_added = total_vehicles_added + 1;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `vehicle_images`
--

CREATE TABLE `vehicle_images` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `image_url` varchar(500) NOT NULL,
  `display_order` int(11) DEFAULT 0,
  `is_primary` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `vehicle_images`
--

INSERT INTO `vehicle_images` (`id`, `vehicle_id`, `image_url`, `display_order`, `is_primary`, `created_at`) VALUES
(1, 4, 'https://i0.shbdn.com/photos/13/20/93/12761320932gz.jpg', 0, 1, '2025-10-13 20:14:38'),
(2, 4, 'https://i0.shbdn.com/photos/13/20/93/x5_1276132093pex.jpg', 1, 0, '2025-10-13 20:14:47'),
(3, 4, 'https://i0.shbdn.com/photos/13/20/93/x5_12761320930n4.jpg', 2, 0, '2025-10-13 20:14:55'),
(4, 4, 'https://i0.shbdn.com/photos/13/20/93/x5_1276132093xge.jpg', 3, 0, '2025-10-13 20:15:04');

-- --------------------------------------------------------

--
-- Görünüm yapısı durumu `vehicle_stats`
-- (Asıl görünüm için aşağıya bakın)
--
CREATE TABLE `vehicle_stats` (
`total_vehicles` bigint(21)
,`active_vehicles` bigint(21)
,`pending_vehicles` bigint(21)
,`featured_vehicles` bigint(21)
,`customer_vehicles` bigint(21)
,`total_views` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Görünüm yapısı `testimonial_stats`
--
DROP TABLE IF EXISTS `testimonial_stats`;

CREATE ALGORITHM=UNDEFINED DEFINER=`nuyacom`@`localhost` SQL SECURITY DEFINER VIEW `testimonial_stats`  AS SELECT count(0) AS `total_testimonials`, avg(`testimonials`.`rating`) AS `avg_rating`, count(case when `testimonials`.`status` = 'pending' then 1 end) AS `pending_count`, count(case when `testimonials`.`status` = 'approved' then 1 end) AS `approved_count` FROM `testimonials` ;

-- --------------------------------------------------------

--
-- Görünüm yapısı `vehicle_stats`
--
DROP TABLE IF EXISTS `vehicle_stats`;

CREATE ALGORITHM=UNDEFINED DEFINER=`nuyacom`@`localhost` SQL SECURITY DEFINER VIEW `vehicle_stats`  AS SELECT count(0) AS `total_vehicles`, count(case when `vehicles`.`status` = 'active' then 1 end) AS `active_vehicles`, count(case when `vehicles`.`status` = 'pending' then 1 end) AS `pending_vehicles`, count(case when `vehicles`.`is_featured` = 1 then 1 end) AS `featured_vehicles`, count(case when `vehicles`.`is_customer_vehicle` = 1 then 1 end) AS `customer_vehicles`, sum(`vehicles`.`views`) AS `total_views` FROM `vehicles` ;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `idx_username` (`username`);

--
-- Tablo için indeksler `backup_logs`
--
ALTER TABLE `backup_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_date` (`created_at`);

--
-- Tablo için indeksler `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Tablo için indeksler `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_slug` (`slug`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_published` (`published_at`),
  ADD KEY `author_id` (`author_id`);
ALTER TABLE `blog_posts` ADD FULLTEXT KEY `ft_title_content` (`title`,`content`);

--
-- Tablo için indeksler `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_created` (`created_at`);

--
-- Tablo için indeksler `daily_stats`
--
ALTER TABLE `daily_stats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stat_date` (`stat_date`),
  ADD KEY `idx_date` (`stat_date`);

--
-- Tablo için indeksler `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hero_banner`
--
ALTER TABLE `hero_banner`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_created` (`created_at`);

--
-- Tablo için indeksler `security_logs`
--
ALTER TABLE `security_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_type` (`log_type`),
  ADD KEY `idx_created` (`created_at`);

--
-- Tablo için indeksler `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- Tablo için indeksler `site_logo`
--
ALTER TABLE `site_logo`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_featured` (`is_featured`),
  ADD KEY `idx_created` (`created_at`),
  ADD KEY `idx_customer_vehicle` (`is_customer_vehicle`),
  ADD KEY `idx_views` (`views`);

--
-- Tablo için indeksler `vehicle_images`
--
ALTER TABLE `vehicle_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_vehicle` (`vehicle_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `backup_logs`
--
ALTER TABLE `backup_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `daily_stats`
--
ALTER TABLE `daily_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `hero_banner`
--
ALTER TABLE `hero_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `security_logs`
--
ALTER TABLE `security_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Tablo için AUTO_INCREMENT değeri `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Tablo için AUTO_INCREMENT değeri `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Tablo için AUTO_INCREMENT değeri `site_logo`
--
ALTER TABLE `site_logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `vehicle_images`
--
ALTER TABLE `vehicle_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD CONSTRAINT `blog_posts_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Tablo kısıtlamaları `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE SET NULL;

--
-- Tablo kısıtlamaları `vehicle_images`
--
ALTER TABLE `vehicle_images`
  ADD CONSTRAINT `vehicle_images_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

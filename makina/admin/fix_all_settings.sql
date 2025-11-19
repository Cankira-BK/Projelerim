-- Tüm eksik ayarları ekle
-- Bu SQL'i phpMyAdmin'de çalıştırın

-- 1. Banner button URL ayarını ekle
INSERT INTO `settings` (`setting_key`, `setting_value`, `setting_type`) 
VALUES ('banner_button_url', '#araclar', 'text')
ON DUPLICATE KEY UPDATE setting_key = setting_key;

-- 2. Testimonials tablosuna customer_location sütunu ekle (eğer yoksa)
ALTER TABLE `testimonials` 
ADD COLUMN IF NOT EXISTS `customer_location` VARCHAR(255) DEFAULT NULL AFTER `customer_name`;

-- 3. Site logo text ayarının olup olmadığını kontrol et
INSERT INTO `settings` (`setting_key`, `setting_value`, `setting_type`) 
VALUES ('site_logo_text', 'Güçlü Otomotiv', 'text')
ON DUPLICATE KEY UPDATE setting_key = setting_key;

-- Tüm ayarları göster
SELECT * FROM settings WHERE setting_key LIKE 'banner%' OR setting_key = 'site_logo_text';

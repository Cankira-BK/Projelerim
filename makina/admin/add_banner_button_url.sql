-- Banner button URL ayarını ekle
-- Bu SQL'i phpMyAdmin'de çalıştırın

INSERT INTO `settings` (`setting_key`, `setting_value`, `setting_type`) 
VALUES ('banner_button_url', '#araclar', 'text')
ON DUPLICATE KEY UPDATE setting_value = setting_value;

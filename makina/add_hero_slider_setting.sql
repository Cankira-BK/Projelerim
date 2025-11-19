-- Hero Slider ayarını ekle
INSERT INTO settings (setting_key, setting_value, setting_type) 
VALUES ('hero_slider_enabled', '1', 'boolean')
ON DUPLICATE KEY UPDATE setting_value = setting_value;

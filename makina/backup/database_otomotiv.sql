-- Güçlü Otomotiv Veritabanı
-- phpMyAdmin'den çalıştırın

CREATE DATABASE IF NOT EXISTS nuyacom_guclu CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE nuyacom_guclu;

-- Admin kullanıcıları tablosu
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    full_name VARCHAR(100),
    role ENUM('admin', 'moderator') DEFAULT 'admin',
    last_login DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    is_active TINYINT(1) DEFAULT 1,
    INDEX idx_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Araçlar tablosu
CREATE TABLE IF NOT EXISTS vehicles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    price VARCHAR(50) NOT NULL,
    year VARCHAR(10) NOT NULL,
    km VARCHAR(50) NOT NULL,
    fuel ENUM('Dizel', 'Benzin', 'Benzin/LPG', 'Hybrid', 'Elektrik') NOT NULL,
    transmission ENUM('Manuel', 'Otomatik', 'Yarı Otomatik') DEFAULT 'Manuel',
    color VARCHAR(50),
    body_type VARCHAR(50),
    description TEXT,
    image VARCHAR(500) NOT NULL,
    sahibinden_link VARCHAR(500),
    is_featured TINYINT(1) DEFAULT 0,
    is_sold TINYINT(1) DEFAULT 0,
    views INT DEFAULT 0,
    status ENUM('active', 'pending', 'sold') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_featured (is_featured),
    INDEX idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Araç resimleri tablosu (çoklu resim için)
CREATE TABLE IF NOT EXISTS vehicle_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_id INT NOT NULL,
    image_url VARCHAR(500) NOT NULL,
    display_order INT DEFAULT 0,
    is_primary TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(id) ON DELETE CASCADE,
    INDEX idx_vehicle (vehicle_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Teklif/Talep tablosu
CREATE TABLE IF NOT EXISTS offers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_id INT,
    offer_type ENUM('buy', 'sell', 'exchange') NOT NULL,
    customer_name VARCHAR(100) NOT NULL,
    customer_phone VARCHAR(20) NOT NULL,
    customer_email VARCHAR(100),
    vehicle_info TEXT,
    message TEXT,
    status ENUM('new', 'contacted', 'completed', 'cancelled') DEFAULT 'new',
    ip_address VARCHAR(45),
    user_agent VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(id) ON DELETE SET NULL,
    INDEX idx_status (status),
    INDEX idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- İletişim mesajları tablosu
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(20) NOT NULL,
    subject VARCHAR(200),
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied') DEFAULT 'new',
    ip_address VARCHAR(45),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Güvenlik logları tablosu
CREATE TABLE IF NOT EXISTS security_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    log_type ENUM('login_success', 'login_failed', 'logout', 'data_change', 'suspicious') NOT NULL,
    username VARCHAR(50),
    ip_address VARCHAR(45),
    user_agent VARCHAR(255),
    details TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_type (log_type),
    INDEX idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Site ayarları tablosu
CREATE TABLE IF NOT EXISTS settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    setting_type VARCHAR(50) DEFAULT 'text',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Varsayılan admin kullanıcısı ekle (şifre: Admin123!@#)
INSERT INTO admins (username, password_hash, email, full_name, role) VALUES 
('admin', '$2y$10$YourHashedPasswordHere', 'admin@gucluotomotiv.com', 'Admin Kullanıcı', 'admin');

-- Varsayılan ayarlar
INSERT INTO settings (setting_key, setting_value, setting_type) VALUES
('site_title', 'Güçlü Otomotiv', 'text'),
('site_phone', '0328 123 45 67', 'text'),
('site_mobile', '0532 123 45 67', 'text'),
('site_email', 'info@gucluotomotiv.com', 'text'),
('site_address', 'Atatürk Cad. No: 123, Merkez / Osmaniye', 'text'),
('whatsapp_number', '905321234567', 'text'),
('sahibinden_profile', 'https://gucluotomotivosmaniye.sahibinden.com/', 'text'),
('facebook_url', '#', 'text'),
('instagram_url', '#', 'text'),
('youtube_url', '#', 'text'),
('slider_autoplay', '1', 'boolean'),
('slider_speed', '5000', 'number');

-- Örnek araçlar (mevcut verilerinizden)
INSERT INTO vehicles (title, price, year, km, fuel, transmission, image, sahibinden_link, is_featured, status) VALUES
('FORD TOURNEO COURIER 1.5. ECOBLUE DELUXE', '1.142.000 TL', '2024', '18.500 km', 'Dizel', 'Manuel', 
 'https://i0.shbdn.com/photos/71/55/18/x16_1263715518mme.jpg',
 'https://www.sahibinden.com/ilan/vasita-minivan-panelvan-ford-ford-tourneo-curier-1.5-ecoblue-deluxe-1263715518/detay',
 1, 'active'),

('VOLKSWAGEN CADDY 2.0 TDI LIFE', '1.695.000 TL', '2025', '10.000 km', 'Dizel', 'Otomatik',
 'https://i0.shbdn.com/photos/80/99/17/1273809917nnm.jpg',
 'https://www.sahibinden.com/ilan/vasita-minivan-panelvan-volkswagen-boyasiz-degisensiz-hasarkayitsiz.arac-faturalidir-ilk-sahibi-1273809917/detay',
 1, 'active'),

('MERCEDES CLS 350 CDI 4MATIC', '1.649.000 TL', '2021', '38.000 km', 'Benzin', 'Otomatik',
 'https://i0.shbdn.com/photos/38/23/58/1249382358fc6.jpg',
 'https://www.sahibinden.com/ilan/vasita-otomobil-mercedes-benz-arac-masrafsiz-en-dolusu-amg-1249382358/detay',
 1, 'active');
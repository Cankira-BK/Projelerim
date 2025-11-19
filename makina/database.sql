-- Güçlü Makina Veritabanı
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

-- Ürünler/Parçalar tablosu
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL COMMENT 'CNC Torna, Freze, Yedek Parça, vs.',
    specifications TEXT COMMENT 'Teknik özellikler, ölçüler',
    material VARCHAR(100) COMMENT 'Malzeme tipi',
    description TEXT,
    image VARCHAR(500) NOT NULL,
    is_featured TINYINT(1) DEFAULT 0,
    views INT DEFAULT 0,
    status ENUM('active', 'pending', 'discontinued') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_featured (is_featured),
    INDEX idx_category (category),
    INDEX idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Ürün resimleri tablosu
CREATE TABLE IF NOT EXISTS product_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    image_url VARCHAR(500) NOT NULL,
    display_order INT DEFAULT 0,
    is_primary TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    INDEX idx_product (product_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Teklif/Talep tablosu
CREATE TABLE IF NOT EXISTS offers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    offer_type ENUM('production', 'repair', 'service') NOT NULL,
    customer_name VARCHAR(100) NOT NULL,
    customer_phone VARCHAR(20) NOT NULL,
    customer_email VARCHAR(100),
    project_info TEXT,
    message TEXT,
    status ENUM('new', 'contacted', 'completed', 'cancelled') DEFAULT 'new',
    ip_address VARCHAR(45),
    user_agent VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE SET NULL,
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

-- Özellikler tablosu
CREATE TABLE IF NOT EXISTS features (
    id INT AUTO_INCREMENT PRIMARY KEY,
    icon VARCHAR(50) NOT NULL,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    display_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_order (display_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Hizmetler tablosu
CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    icon VARCHAR(50) NOT NULL,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    display_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_order (display_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Müşteri yorumları tablosu
CREATE TABLE IF NOT EXISTS testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    customer_title VARCHAR(100) COMMENT 'Ünvan/Şirket',
    comment TEXT NOT NULL,
    display_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_order (display_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Site ayarları tablosu
CREATE TABLE IF NOT EXISTS settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    setting_type VARCHAR(50) DEFAULT 'text',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Varsayılan admin (şifre: Admin123!@#)
INSERT INTO admins (username, password_hash, email, full_name, role) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@guclumakina.com', 'Admin', 'admin');

-- Varsayılan ayarlar
INSERT INTO settings (setting_key, setting_value, setting_type) VALUES
('site_title', 'Güçlü Makina', 'text'),
('site_logo_text', 'GÜÇLÜ MAKİNA', 'text'),
('site_phone', '0328 123 45 67', 'text'),
('site_mobile', '0532 123 45 67', 'text'),
('site_email', 'info@guclumakina.com', 'text'),
('site_address', 'Organize Sanayi Bölgesi, 5. Cadde No: 42, Osmaniye', 'text'),
('whatsapp_number', '905321234567', 'text'),
('facebook_url', '#', 'text'),
('instagram_url', '#', 'text'),
('youtube_url', '#', 'text'),
('hero_slider_enabled', '0', 'boolean'),
('slider_speed', '5000', 'number'),
('banner_title', 'Hassas İşçilik, Güvenilir Çözümler', 'text'),
('banner_subtitle', '20 Yıllık Deneyim ile Torna, CNC İşleme ve Makina Bakım Hizmetleri', 'text'),
('banner_button_text', 'Hizmetlerimizi Keşfedin', 'text'),
('banner_button_url', '#hizmetler', 'text');

-- Varsayılan özellikler
INSERT INTO features (icon, title, description, display_order, is_active) VALUES
('⚙️', 'İleri Teknoloji', 'Son model CNC torna ve freze makineleri ile hassas üretim', 1, 1),
('🔧', 'Deneyimli Ekip', '20 yıllık tecrübeli ustalar ve teknik ekip', 2, 1),
('⚡', 'Hızlı Teslimat', 'Acil işleriniz için aynı gün teslimat imkanı', 3, 1),
('✓', 'Kalite Garantisi', 'Ölçü ve dayanıklılık garantili üretim', 4, 1);

-- Varsayılan hizmetler
INSERT INTO services (icon, title, description, display_order, is_active) VALUES
('⚙️', 'CNC Torna İşleme', 'Hassas ölçülerde torna, yüzey tornalama ve diş açma işlemleri', 1, 1),
('🔧', 'CNC Freze', 'Karmaşık geometrilerde frezeleme ve delme operasyonları', 2, 1),
('🛠️', 'Makina Bakım-Onarım', 'Tüm sanayi makinelerinin periyodik bakım ve arıza onarımı', 3, 1),
('📐', 'Yedek Parça İmalatı', 'Teknik resme göre özel yedek parça üretimi', 4, 1),
('⚡', 'Kaynak İşleri', 'TIG, MIG/MAG ve elektrod kaynağı ile onarım ve imalat', 5, 1),
('🔩', 'Montaj Hizmeti', 'Makina ve ekipman montaj, revizyon ve iyileştirme çalışmaları', 6, 1);

-- Varsayılan müşteri yorumları
INSERT INTO testimonials (customer_name, customer_title, comment, display_order, is_active) VALUES
('Ahmet Demir', 'Üretim Müdürü - ABC Tekstil', 'Acil bir parça ihtiyacımız olduğunda aynı gün içinde üretip teslim ettiler. Kaliteli işçilik ve güvenilir hizmet.', 1, 1),
('Fatma Yıldız', 'İşletme Sahibi - Yıldız Gıda', '20 yıldır makina bakımlarımızı yaptırıyoruz. Profesyonel ekip ve uygun fiyatlar.', 2, 1),
('Mehmet Kaya', 'Teknik Şef - DEF Otomotiv', 'CNC torna işlemlerinde hassasiyet ve zamanında teslimat konusunda çok memnunuz.', 3, 1);

-- Örnek ürünler
INSERT INTO products (title, category, specifications, material, description, image, is_featured, status) VALUES
('Mil Tornalama Hizmeti', 'CNC Torna', 'Ø10-300mm, Uzunluk: 1500mm', 'Çelik, Paslanmaz, Bronz', 'Hassas ölçülerde mil tornalama ve yüzey işleme hizmeti', 
 'https://images.unsplash.com/photo-1565688534245-05d6b5be184a?w=800', 1, 'active'),

('Flanş İmalatı', 'CNC Freze', 'Ø50-500mm, Delik işleme', 'Çelik, Alüminyum', 'Özel ölçülerde flanş ve bağlantı elemanı imalatı', 
 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800', 1, 'active'),

('Dişli İmalatı', 'Yedek Parça', 'Modül 1-10, Diş sayısı: 10-200', 'Çelik, Bronz', 'Teknik resme göre dişli ve transmisyon elemanı üretimi', 
 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=800', 1, 'active'),

('Rulman Yatağı Tamiratı', 'Bakım-Onarım', 'Tüm boyutlar', 'Çelik', 'Aşınmış rulman yuvalarının tamiri ve yeniden tornalama', 
 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800', 0, 'active'),

('Şaft İmalatı', 'CNC Torna', 'Ø20-250mm, Uzunluk: 2000mm', 'Çelik 42CrMo4', 'Endüstriyel makineler için özel şaft üretimi', 
 'https://images.unsplash.com/photo-1565688534245-05d6b5be184a?w=800', 0, 'active'),

('Baskı Plakası', 'CNC Freze', '500x500x50mm', 'Alüminyum 7075', 'Özel ölçülerde baskı ve montaj plakaları', 
 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=800', 0, 'active');

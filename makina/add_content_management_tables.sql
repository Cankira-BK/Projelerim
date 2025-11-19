-- Site içerik yönetimi için yeni tablolar

-- Hizmetler tablosu
CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    icon VARCHAR(50) NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT NOT NULL,
    display_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_order (display_order),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Müşteri yorumları tablosu
CREATE TABLE IF NOT EXISTS testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    customer_location VARCHAR(100),
    comment TEXT NOT NULL,
    rating INT DEFAULT 5,
    display_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_order (display_order),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Özellikler/Avantajlar tablosu (Neden Güçlü Otomotiv)
CREATE TABLE IF NOT EXISTS features (
    id INT AUTO_INCREMENT PRIMARY KEY,
    icon VARCHAR(50) NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT NOT NULL,
    display_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_order (display_order),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Varsayılan hizmetler
INSERT INTO services (icon, title, description, display_order) VALUES
('🚗', 'Araç Alım-Satım', 'Geniş araç yelpazemizden size en uygun aracı bulun.', 1),
('🔄', 'Takas', 'Mevcut aracınızı en iyi fiyattan değerlendirip takas edebilirsiniz.', 2),
('🔍', 'Ekspertiz', 'Detaylı ekspertiz raporu ile güvenle alın.', 3),
('💰', 'Kredi Desteği', 'Uygun faiz oranlarında araç kredisi imkanı.', 4),
('📋', 'İşlem Kolaylığı', 'Tüm işlemlerinizi biz hallederiz.', 5),
('💼', 'Danışmanlık', '20 yıllık tecrübemizle rehberlik ederiz.', 6);

-- Varsayılan yorumlar
INSERT INTO testimonials (customer_name, customer_location, comment, display_order) VALUES
('Mehmet Yılmaz', 'İstanbul', '3 yıldır aldığım araçla hiçbir sorun yaşamadım. Herkese tavsiye ederim.', 1),
('Ayşe Kaya', 'Ankara', 'Araç alırken çok detaylı bilgi verdiler. Teşekkürler Güçlü Otomotiv.', 2),
('Can Özdemir', 'İzmir', 'İlk araç alımımdı. Güçlü Otomotiv ekibi her konuda yardımcı oldu.', 3);

-- Varsayılan özellikler
INSERT INTO features (icon, title, description, display_order) VALUES
('✓', '2000+ Mutlu Müşteri', '20 yıldır binlerce müşterimize güvenilir hizmet sunuyoruz', 1),
('🔍', 'Ekspertiz Garantisi', 'Tüm araçlarımız detaylı ekspertiz kontrolünden geçer', 2),
('🤝', 'Takas İmkanı', 'Aracınızı değerinde değerlendirip takas yapabilirsiniz', 3),
('📋', 'Tüm İşlemler', 'Ruhsat, noter, sigorta işlemlerinizi biz hallederiz', 4);

-- Ek site ayarları
INSERT INTO settings (setting_key, setting_value, setting_type) VALUES
('site_logo_text', 'Güçlü Otomotiv', 'text'),
('banner_title', 'Güvenle Alın, Huzurla Sürün', 'text'),
('banner_subtitle', '20 Yıllık Tecrübe ile İkinci El Araç Alım Satım', 'text'),
('banner_button_text', 'Araçları İncele', 'text')
ON DUPLICATE KEY UPDATE setting_value = setting_value;

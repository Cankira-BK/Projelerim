<?php
session_start();
require_once 'config/database.php';
require_once 'includes/mailer.php';

$db = Database::getInstance();
$message = '';
$error = '';

// Form gönderimi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_vehicle'])) {
    // Rate limiting
    if (!checkRateLimit('customer_vehicle', 3, 3600)) {
        $error = 'Çok fazla araç ekleme denemesi. 1 saat sonra tekrar deneyin.';
    } else {
        try {
            // Veri doğrulama
            $required = ['customer_name', 'customer_phone', 'customer_email', 'title', 'price', 'year', 'km', 'fuel', 'transmission'];
            foreach ($required as $field) {
                if (empty($_POST[$field])) {
                    throw new Exception(ucfirst($field) . ' alanı zorunludur');
                }
            }
            
            // Email doğrulama
            if (!filter_var($_POST['customer_email'], FILTER_VALIDATE_EMAIL)) {
                throw new Exception('Geçerli bir email adresi girin');
            }
            
            // Telefon doğrulama
            $phone = preg_replace('/[^0-9]/', '', $_POST['customer_phone']);
            if (strlen($phone) < 10) {
                throw new Exception('Geçerli bir telefon numarası girin');
            }
            
            // Veritabanına ekle (onay bekliyor durumunda)
            $sql = "INSERT INTO vehicles (
                title, price, year, km, fuel, transmission, color, body_type, 
                description, image, status, customer_name, customer_phone, 
                customer_email, is_customer_vehicle, created_at
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', ?, ?, ?, 1, NOW())";
            
            $vehicleId = $db->insert($sql, [
                sanitize($_POST['title']),
                sanitize($_POST['price']),
                sanitize($_POST['year']),
                sanitize($_POST['km']),
                sanitize($_POST['fuel']),
                sanitize($_POST['transmission']),
                sanitize($_POST['color'] ?? ''),
                sanitize($_POST['body_type'] ?? ''),
                sanitize($_POST['description'] ?? ''),
                sanitize($_POST['image'] ?? ''),
                sanitize($_POST['customer_name']),
                sanitize($_POST['customer_phone']),
                sanitize($_POST['customer_email'])
            ]);
            
            // Admin'e email gönder
            $adminEmail = $db->fetchOne("SELECT setting_value FROM settings WHERE setting_key = 'site_email'")['setting_value'] ?? 'admin@gucluotomotiv.com';
            
            notifyNewCustomerVehicle([
                'title' => $_POST['title'],
                'price' => $_POST['price'],
                'year' => $_POST['year'],
                'km' => $_POST['km'],
                'customer_name' => $_POST['customer_name'],
                'customer_phone' => $_POST['customer_phone']
            ], $adminEmail);
            
            // Log
            logSecurity('data_change', 'customer', 'Customer vehicle submitted: ' . $vehicleId);
            
            $message = 'Aracınız başarıyla gönderildi! Onaylandıktan sonra sitemizde yayınlanacak ve size email göndereceğiz.';
            
            // Formu temizle
            $_POST = [];
            
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
}

// Site ayarları
$settings = [];
$settingsData = $db->fetchAll("SELECT setting_key, setting_value FROM settings");
foreach ($settingsData as $setting) {
    $settings[$setting['setting_key']] = $setting['setting_value'];
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Araç Ekle - <?php echo htmlspecialchars($settings['site_title'] ?? 'Güçlü Otomotiv'); ?></title>
    <link rel="stylesheet" href="assets/styles.css">
    <style>
        .form-container {
            max-width: 800px;
            margin: 2rem auto;
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #333;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            font-family: inherit;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #ffd700;
        }
        .info-box {
            background: #e7f3ff;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            border-left: 4px solid #0066cc;
        }
        .required {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">🚗 <?php echo htmlspecialchars($settings['site_title'] ?? 'GÜÇLÜ OTOMOTİV'); ?></div>
            <ul class="nav-links">
                <li><a href="index.php">Ana Sayfa</a></li>
                <li><a href="search.php">Araç Ara</a></li>
                <li><a href="customer_add_vehicle.php">Araç Ekle</a></li>
                <li><a href="index.php#iletisim">İletişim</a></li>
            </ul>
        </nav>
    </header>

    <div class="form-container">
        <h1 style="color: #16213e; margin-bottom: 1rem;">🚗 Aracınızı Ekleyin</h1>
        
        <?php if ($message): ?>
            <div class="message" style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
                ✅ <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="error" style="background: #f8d7da; color: #721c24; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
                ❌ <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <div class="info-box">
            <h3 style="margin-bottom: 0.5rem;">ℹ️ Bilgilendirme</h3>
            <ul style="margin-left: 1.5rem;">
                <li>Aracınızın bilgilerini eksiksiz doldurun</li>
                <li>Gönderdiğiniz araç admin onayından sonra yayınlanacak</li>
                <li>Onay durumu hakkında email ile bilgilendirileceksiniz</li>
                <li>Teklif geldiğinde sizi arayacağız</li>
            </ul>
        </div>

        <form method="POST" enctype="multipart/form-data">
            <h3 style="color: #16213e; margin-bottom: 1rem; border-bottom: 2px solid #ffd700; padding-bottom: 0.5rem;">
                👤 İletişim Bilgileriniz
            </h3>
            
            <div class="form-grid">
                <div class="form-group">
                    <label>Adınız Soyadınız <span class="required">*</span></label>
                    <input type="text" name="customer_name" required value="<?php echo htmlspecialchars($_POST['customer_name'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label>Telefon Numaranız <span class="required">*</span></label>
                    <input type="tel" name="customer_phone" required placeholder="05XX XXX XX XX" value="<?php echo htmlspecialchars($_POST['customer_phone'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label>Email Adresiniz <span class="required">*</span></label>
                    <input type="email" name="customer_email" required placeholder="ornek@email.com" value="<?php echo htmlspecialchars($_POST['customer_email'] ?? ''); ?>">
                </div>
            </div>

            <h3 style="color: #16213e; margin: 2rem 0 1rem; border-bottom: 2px solid #ffd700; padding-bottom: 0.5rem;">
                🚗 Araç Bilgileri
            </h3>
            
            <div class="form-grid">
                <div class="form-group" style="grid-column: 1 / -1;">
                    <label>Araç Başlığı <span class="required">*</span></label>
                    <input type="text" name="title" required placeholder="Örn: FORD FOCUS 1.6 TDCi TREND X" value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>">
                    <small style="color: #666;">Marka, model, motor hacmi ve paket bilgisini girin</small>
                </div>
                
                <div class="form-group">
                    <label>Fiyat (TL) <span class="required">*</span></label>
                    <input type="text" name="price" required placeholder="Örn: 450.000 TL" value="<?php echo htmlspecialchars($_POST['price'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label>Yıl <span class="required">*</span></label>
                    <input type="number" name="year" required min="1990" max="<?php echo date('Y') + 1; ?>" placeholder="<?php echo date('Y'); ?>" value="<?php echo htmlspecialchars($_POST['year'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label>Kilometre <span class="required">*</span></label>
                    <input type="text" name="km" required placeholder="Örn: 85.000 km" value="<?php echo htmlspecialchars($_POST['km'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label>Yakıt Tipi <span class="required">*</span></label>
                    <select name="fuel" required>
                        <option value="">Seçiniz</option>
                        <option value="Dizel" <?php echo (isset($_POST['fuel']) && $_POST['fuel'] == 'Dizel') ? 'selected' : ''; ?>>Dizel</option>
                        <option value="Benzin" <?php echo (isset($_POST['fuel']) && $_POST['fuel'] == 'Benzin') ? 'selected' : ''; ?>>Benzin</option>
                        <option value="Benzin/LPG" <?php echo (isset($_POST['fuel']) && $_POST['fuel'] == 'Benzin/LPG') ? 'selected' : ''; ?>>Benzin/LPG</option>
                        <option value="Hybrid" <?php echo (isset($_POST['fuel']) && $_POST['fuel'] == 'Hybrid') ? 'selected' : ''; ?>>Hybrid</option>
                        <option value="Elektrik" <?php echo (isset($_POST['fuel']) && $_POST['fuel'] == 'Elektrik') ? 'selected' : ''; ?>>Elektrik</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Vites Tipi <span class="required">*</span></label>
                    <select name="transmission" required>
                        <option value="">Seçiniz</option>
                        <option value="Manuel" <?php echo (isset($_POST['transmission']) && $_POST['transmission'] == 'Manuel') ? 'selected' : ''; ?>>Manuel</option>
                        <option value="Otomatik" <?php echo (isset($_POST['transmission']) && $_POST['transmission'] == 'Otomatik') ? 'selected' : ''; ?>>Otomatik</option>
                        <option value="Yarı Otomatik" <?php echo (isset($_POST['transmission']) && $_POST['transmission'] == 'Yarı Otomatik') ? 'selected' : ''; ?>>Yarı Otomatik</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Renk</label>
                    <input type="text" name="color" placeholder="Örn: Beyaz" value="<?php echo htmlspecialchars($_POST['color'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label>Kasa Tipi</label>
                    <input type="text" name="body_type" placeholder="Örn: Sedan, Hatchback, SUV" value="<?php echo htmlspecialchars($_POST['body_type'] ?? ''); ?>">
                </div>
                
                <div class="form-group" style="grid-column: 1 / -1;">
                    <label>Araç Resmi URL</label>
                    <input type="url" name="image" placeholder="https://... (Opsiyonel)" value="<?php echo htmlspecialchars($_POST['image'] ?? ''); ?>">
                    <small style="color: #666;">Sahibinden veya başka siteden resim linki ekleyebilirsiniz</small>
                </div>
                
                <div class="form-group" style="grid-column: 1 / -1;">
                    <label>Açıklama / Ek Bilgiler</label>
                    <textarea name="description" rows="5" placeholder="Aracınız hakkında detaylı bilgi verin (tramer kaydı, hasar durumu, değişen parçalar, bakım geçmişi vb.)"><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea>
                </div>
            </div>

            <div style="margin-top: 2rem; display: flex; gap: 1rem;">
                <button type="submit" name="submit_vehicle" class="btn" style="flex: 1;">📤 Aracı Gönder</button>
                <a href="index.php" class="btn" style="flex: 1; background: #6c757d; color: white; text-align: center;">❌ İptal</a>
            </div>
        </form>
    </div>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Güçlü Otomotiv. Tüm hakları saklıdır.</p>
        </div>
    </footer>
</body>
</html>
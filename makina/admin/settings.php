<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$db = Database::getInstance();
$message = '';
$error = '';

// Ayar güncelleme
if (isset($_POST['update_settings'])) {
    try {
        foreach ($_POST as $key => $value) {
            if ($key !== 'update_settings') {
                // Checkbox değerleri için özel kontrol
                if ($key === 'hero_slider_enabled') {
                    $value = isset($_POST[$key]) ? '1' : '0';
                }
                
                // Ayar varsa güncelle, yoksa ekle
                $existing = $db->fetchOne("SELECT * FROM settings WHERE setting_key = ?", [$key]);
                if ($existing) {
                    $db->execute("UPDATE settings SET setting_value = ? WHERE setting_key = ?", [sanitize($value), $key]);
                } else {
                    $db->execute("INSERT INTO settings (setting_key, setting_value) VALUES (?, ?)", [$key, sanitize($value)]);
                }
            }
        }
        
        // Checkbox kapalıysa 0 yap
        if (!isset($_POST['hero_slider_enabled'])) {
            $db->execute("UPDATE settings SET setting_value = '0' WHERE setting_key = 'hero_slider_enabled'");
        }
        
        logSecurity('data_change', $_SESSION['admin_username'], 'Settings updated');
        $message = 'Ayarlar başarıyla güncellendi!';
    } catch (Exception $e) {
        $error = 'Hata: ' . $e->getMessage();
    }
}

// Ayarları çek
$settings = [];
$result = $db->fetchAll("SELECT * FROM settings");
foreach ($result as $row) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

// Varsayılan değerler
if (!isset($settings['hero_slider_enabled'])) {
    $settings['hero_slider_enabled'] = '1';
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Ayarları - Admin Panel</title>
    <link rel="stylesheet" href="admin-style.css">
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        input:checked + .slider {
            background-color: #28a745;
        }
        input:checked + .slider:before {
            transform: translateX(26px);
        }
        .setting-card {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border-left: 4px solid #ffd700;
        }
        .setting-card h3 {
            margin: 0 0 1rem 0;
            color: #16213e;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .setting-description {
            font-size: 0.9rem;
            color: #666;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>⚙️ Site Ayarları</h1>
        <div class="header-right">
            <a href="index.php" class="btn btn-small">← Admin Panel</a>
            <a href="../index.php" class="btn btn-small" target="_blank">Siteyi Görüntüle</a>
        </div>
    </div>

    <div class="container">
        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST">
            <!-- Hero Slider Ayarları -->
            <div class="card">
                <h2>🎬 Ana Sayfa Slider Ayarları</h2>
                
                <div class="setting-card">
                    <h3>
                        <span>🎯</span> Hero Slider Durumu
                    </h3>
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <label class="switch">
                            <input type="checkbox" name="hero_slider_enabled" value="1" <?php echo (isset($settings['hero_slider_enabled']) && $settings['hero_slider_enabled'] == '1') ? 'checked' : ''; ?>>
                            <span class="slider"></span>
                        </label>
                        <span style="font-weight: bold;">
                            <?php echo (isset($settings['hero_slider_enabled']) && $settings['hero_slider_enabled'] == '1') ? '✅ Aktif' : '❌ Pasif'; ?>
                        </span>
                    </div>
                    <p class="setting-description">
                        Ana sayfa başındaki büyük slider'ı açar/kapatır. Kapalı olduğunda sadece statik bir banner gösterilir.
                    </p>
                </div>
                
                <div style="background: #e7f3ff; padding: 1rem; border-radius: 8px; margin-top: 1rem;">
                    <h4 style="margin: 0 0 0.5rem 0;">💡 Slider Nasıl Çalışır?</h4>
                    <ul style="margin: 0; padding-left: 1.5rem; line-height: 1.8;">
                        <li><strong>Aktif</strong> olduğunda: Öne çıkan araçlar (⭐ işaretli) otomatik slider'da gösterilir</li>
                        <li><strong>Pasif</strong> olduğunda: Statik bir karşılama banner'ı gösterilir</li>
                        <li>Slider'da gösterilecek araçları "Araç Yönetimi" bölümünden "Öne Çıkan" yapabilirsiniz</li>
                    </ul>
                </div>
            </div>

            <!-- Genel Ayarlar -->
            <div class="card">
                <h2>📝 Genel Ayarlar</h2>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Site Başlığı</label>
                        <input type="text" name="site_title" value="<?php echo htmlspecialchars($settings['site_title'] ?? ''); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Sabit Telefon</label>
                        <input type="text" name="site_phone" value="<?php echo htmlspecialchars($settings['site_phone'] ?? ''); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label>Cep Telefonu</label>
                        <input type="text" name="site_mobile" value="<?php echo htmlspecialchars($settings['site_mobile'] ?? ''); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label>E-posta Adresi</label>
                        <input type="email" name="site_email" value="<?php echo htmlspecialchars($settings['site_email'] ?? ''); ?>">
                    </div>
                    
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label>Adres</label>
                        <input type="text" name="site_address" value="<?php echo htmlspecialchars($settings['site_address'] ?? ''); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label>WhatsApp Numarası (905321234567 formatında)</label>
                        <input type="text" name="whatsapp_number" value="<?php echo htmlspecialchars($settings['whatsapp_number'] ?? ''); ?>" placeholder="905321234567">
                        <small style="color: #666;">Ülke kodu ile birlikte, başında sıfır olmadan yazın</small>
                    </div>
                    
                    <div class="form-group">
                        <label>Sahibinden Profil Linki</label>
                        <input type="url" name="sahibinden_profile" value="<?php echo htmlspecialchars($settings['sahibinden_profile'] ?? ''); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label>Facebook URL</label>
                        <input type="url" name="facebook_url" value="<?php echo htmlspecialchars($settings['facebook_url'] ?? ''); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label>Instagram URL</label>
                        <input type="url" name="instagram_url" value="<?php echo htmlspecialchars($settings['instagram_url'] ?? ''); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label>YouTube URL</label>
                        <input type="url" name="youtube_url" value="<?php echo htmlspecialchars($settings['youtube_url'] ?? ''); ?>">
                    </div>
                </div>
            </div>

            <div style="margin-top: 2rem; position: sticky; bottom: 20px; background: white; padding: 1rem; border-radius: 8px; box-shadow: 0 -2px 10px rgba(0,0,0,0.1);">
                <button type="submit" name="update_settings" class="btn" style="width: 100%; font-size: 1.1rem;">💾 Tüm Ayarları Kaydet</button>
            </div>
        </form>

        <div class="card">
            <h2>🔐 Güvenlik</h2>
            <p style="margin-bottom: 1rem;">Güvenlik ayarları için:</p>
            <ul style="list-style: none; padding: 0;">
                <li style="padding: 0.5rem 0;">✅ Admin şifrenizi düzenli değiştirin</li>
                <li style="padding: 0.5rem 0;">✅ SSL sertifikası kullanın (HTTPS)</li>
                <li style="padding: 0.5rem 0;">✅ Düzenli veritabanı yedeği alın</li>
            </ul>
            <div style="margin-top: 1rem;">
                <a href="change_password.php" class="btn">🔑 Şifre Değiştir</a>
                <a href="security_logs.php" class="btn btn-secondary">📋 Güvenlik Logları</a>
            </div>
        </div>

        <div class="card">
            <h2>ℹ️ Sistem Bilgileri</h2>
            <table style="margin-top: 1rem;">
                <tr>
                    <td style="font-weight: bold;">PHP Versiyonu:</td>
                    <td><?php echo phpversion(); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Veritabanı:</td>
                    <td><?php echo DB_NAME; ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Sunucu:</td>
                    <td><?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'Bilinmiyor'; ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Admin IP:</td>
                    <td><?php echo $_SERVER['REMOTE_ADDR'] ?? 'Bilinmiyor'; ?></td>
                </tr>
            </table>
        </div>
    </div>

    <script>
        // Switch durumu değiştiğinde yazıyı güncelle
        document.querySelector('input[name="hero_slider_enabled"]').addEventListener('change', function() {
            const statusText = this.parentElement.nextElementSibling;
            if (this.checked) {
                statusText.innerHTML = '✅ Aktif';
            } else {
                statusText.innerHTML = '❌ Pasif';
            }
        });
    </script>
</body>
</html>

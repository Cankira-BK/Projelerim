<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once '../config/database.php';

// Giriş kontrolü
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$db = Database::getInstance();
$message = '';
$error = '';

// Logo Yükleme
if (isset($_POST['upload_logo']) && isset($_FILES['logo'])) {
    try {
        // Klasör kontrolü
        $uploadDir = '../assets/images/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $validation = validateImageUpload($_FILES['logo']);
        if (!$validation['success']) {
            throw new Exception($validation['error']);
        }
        
        $ext = strtolower(pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION));
        $newName = 'logo.' . $ext;
        $uploadPath = $uploadDir . $newName;
        
        if (move_uploaded_file($_FILES['logo']['tmp_name'], $uploadPath)) {
            $db->execute("DELETE FROM site_logo");
            $db->insert("INSERT INTO site_logo (logo_path) VALUES (?)", ['assets/images/' . $newName]);
            logSecurity('data_change', $_SESSION['admin_username'], 'Logo updated');
            $message = 'Logo başarıyla yüklendi!';
            header('Location: content_management.php?msg=logo_uploaded');
            exit;
        } else {
            throw new Exception('Dosya yüklenemedi. Lütfen klasör izinlerini kontrol edin.');
        }
    } catch (Exception $e) {
        $error = 'Logo yükleme hatası: ' . $e->getMessage();
    }
}

// Logo Text Güncelleme
if (isset($_POST['update_logo_text'])) {
    try {
        $db->execute("UPDATE settings SET setting_value = ? WHERE setting_key = 'site_logo_text'", 
            [sanitize($_POST['site_logo_text'])]);
        
        logSecurity('data_change', $_SESSION['admin_username'], 'Logo text updated');
        header('Location: content_management.php?msg=logo_text_updated');
        exit;
    } catch (Exception $e) {
        $error = 'Logo metni güncelleme hatası: ' . $e->getMessage();
    }
}

// Banner Ayarları Güncelleme
if (isset($_POST['update_banner'])) {
    try {
        $db->execute("UPDATE settings SET setting_value = ? WHERE setting_key = 'banner_title'", 
            [sanitize($_POST['banner_title'])]);
        $db->execute("UPDATE settings SET setting_value = ? WHERE setting_key = 'banner_subtitle'", 
            [sanitize($_POST['banner_subtitle'])]);
        $db->execute("UPDATE settings SET setting_value = ? WHERE setting_key = 'banner_button_text'", 
            [sanitize($_POST['banner_button_text'])]);
        $db->execute("UPDATE settings SET setting_value = ? WHERE setting_key = 'banner_button_url'", 
            [sanitize($_POST['banner_button_url'])]);
        
        logSecurity('data_change', $_SESSION['admin_username'], 'Banner settings updated');
        header('Location: content_management.php?msg=banner_updated');
        exit;
    } catch (Exception $e) {
        $error = 'Banner güncelleme hatası: ' . $e->getMessage();
    }
}

// Hizmet Ekleme
if (isset($_POST['add_service'])) {
    try {
        $sql = "INSERT INTO services (icon, title, description, display_order) VALUES (?, ?, ?, ?)";
        $db->insert($sql, [
            sanitize($_POST['icon']),
            sanitize($_POST['title']),
            sanitize($_POST['description']),
            (int)$_POST['display_order']
        ]);
        header('Location: content_management.php?msg=service_added');
        exit;
    } catch (Exception $e) {
        $error = 'Hizmet ekleme hatası: ' . $e->getMessage();
    }
}

// Hizmet Güncelleme
if (isset($_POST['update_service'])) {
    try {
        $sql = "UPDATE services SET icon=?, title=?, description=?, display_order=?, is_active=? WHERE id=?";
        $db->execute($sql, [
            sanitize($_POST['icon']),
            sanitize($_POST['title']),
            sanitize($_POST['description']),
            (int)$_POST['display_order'],
            isset($_POST['is_active']) ? 1 : 0,
            (int)$_POST['service_id']
        ]);
        $message = 'Hizmet güncellendi!';
        header('Location: content_management.php?msg=service_updated');
        exit;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

// Hizmet Silme
if (isset($_GET['delete_service'])) {
    try {
        $db->execute("DELETE FROM services WHERE id = ?", [(int)$_GET['delete_service']]);
        header('Location: content_management.php?msg=service_deleted');
        exit;
    } catch (Exception $e) {
        $error = 'Hizmet silme hatası: ' . $e->getMessage();
    }
}

// Özellik Ekleme
if (isset($_POST['add_feature'])) {
    try {
        $sql = "INSERT INTO features (icon, title, description, display_order) VALUES (?, ?, ?, ?)";
        $db->insert($sql, [
            sanitize($_POST['icon']),
            sanitize($_POST['title']),
            sanitize($_POST['description']),
            (int)$_POST['display_order']
        ]);
        header('Location: content_management.php?msg=feature_added');
        exit;
    } catch (Exception $e) {
        $error = 'Özellik ekleme hatası: ' . $e->getMessage();
    }
}

// Özellik Güncelleme
if (isset($_POST['update_feature'])) {
    try {
        $sql = "UPDATE features SET icon=?, title=?, description=?, display_order=?, is_active=? WHERE id=?";
        $db->execute($sql, [
            sanitize($_POST['icon']),
            sanitize($_POST['title']),
            sanitize($_POST['description']),
            (int)$_POST['display_order'],
            isset($_POST['is_active']) ? 1 : 0,
            (int)$_POST['feature_id']
        ]);
        $message = 'Özellik güncellendi!';
        header('Location: content_management.php?msg=feature_updated');
        exit;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

// Özellik Silme
if (isset($_GET['delete_feature'])) {
    try {
        $db->execute("DELETE FROM features WHERE id = ?", [(int)$_GET['delete_feature']]);
        header('Location: content_management.php?msg=feature_deleted');
        exit;
    } catch (Exception $e) {
        $error = 'Özellik silme hatası: ' . $e->getMessage();
    }
}

// Yorum Ekleme
if (isset($_POST['add_testimonial'])) {
    try {
        $sql = "INSERT INTO testimonials (customer_name, comment, display_order, rating) VALUES (?, ?, ?, ?)";
        $db->insert($sql, [
            sanitize($_POST['customer_name']),
            sanitize($_POST['comment']),
            (int)$_POST['display_order'],
            5
        ]);
        header('Location: content_management.php?msg=testimonial_added');
        exit;
    } catch (Exception $e) {
        $error = 'Yorum ekleme hatası: ' . $e->getMessage();
    }
}

// Yorum Güncelleme
if (isset($_POST['update_testimonial'])) {
    try {
        $sql = "UPDATE testimonials SET customer_name=?, comment=?, display_order=?, is_active=? WHERE id=?";
        $db->execute($sql, [
            sanitize($_POST['customer_name']),
            sanitize($_POST['comment']),
            (int)$_POST['display_order'],
            isset($_POST['is_active']) ? 1 : 0,
            (int)$_POST['testimonial_id']
        ]);
        $message = 'Yorum güncellendi!';
        header('Location: content_management.php?msg=testimonial_updated');
        exit;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

// Yorum Silme
if (isset($_GET['delete_testimonial'])) {
    try {
        $db->execute("DELETE FROM testimonials WHERE id = ?", [(int)$_GET['delete_testimonial']]);
        header('Location: content_management.php?msg=testimonial_deleted');
        exit;
    } catch (Exception $e) {
        $error = 'Yorum silme hatası: ' . $e->getMessage();
    }
}

// Mesaj
if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'logo_uploaded': $message = 'Logo başarıyla yüklendi!'; break;
        case 'logo_text_updated': $message = 'Logo metni güncellendi!'; break;
        case 'banner_updated': $message = 'Banner ayarları güncellendi!'; break;
        case 'service_updated': $message = 'Hizmet güncellendi!'; break;
        case 'service_added': $message = 'Hizmet eklendi!'; break;
        case 'service_deleted': $message = 'Hizmet silindi!'; break;
        case 'feature_updated': $message = 'Özellik güncellendi!'; break;
        case 'feature_added': $message = 'Özellik eklendi!'; break;
        case 'feature_deleted': $message = 'Özellik silindi!'; break;
        case 'testimonial_updated': $message = 'Yorum güncellendi!'; break;
        case 'testimonial_added': $message = 'Yorum eklendi!'; break;
        case 'testimonial_deleted': $message = 'Yorum silindi!'; break;
    }
}

// Verileri çek
$logo = $db->fetchOne("SELECT * FROM site_logo ORDER BY id DESC LIMIT 1");
$logoText = $db->fetchOne("SELECT setting_value FROM settings WHERE setting_key = 'site_logo_text'");
$logoText = $logoText ? $logoText['setting_value'] : 'Güçlü Otomotiv';

$bannerSettings = [];
$bannerKeys = ['banner_title', 'banner_subtitle', 'banner_button_text', 'banner_button_url'];
foreach ($bannerKeys as $key) {
    $result = $db->fetchOne("SELECT setting_value FROM settings WHERE setting_key = ?", [$key]);
    $bannerSettings[$key] = $result ? $result['setting_value'] : '';
}

$services = $db->fetchAll("SELECT * FROM services ORDER BY display_order ASC");
$features = $db->fetchAll("SELECT * FROM features ORDER BY display_order ASC");
$testimonials = $db->fetchAll("SELECT * FROM testimonials ORDER BY display_order ASC");

// Düzenleme için veri
$editService = null;
$editFeature = null;
$editTestimonial = null;

if (isset($_GET['edit_service'])) {
    $editService = $db->fetchOne("SELECT * FROM services WHERE id = ?", [(int)$_GET['edit_service']]);
}
if (isset($_GET['edit_feature'])) {
    $editFeature = $db->fetchOne("SELECT * FROM features WHERE id = ?", [(int)$_GET['edit_feature']]);
}
if (isset($_GET['edit_testimonial'])) {
    $editTestimonial = $db->fetchOne("SELECT * FROM testimonials WHERE id = ?", [(int)$_GET['edit_testimonial']]);
}

// Emoji listesi
$emojis = ['🚗', '🔧', '💰', '📋', '⭐', '✓', '🔍', '🤝', '📞', '💬', '🏆', '🎯', '💼', '🔐', '📊', '🎨', '🌟', '💡', '🚀', '⚡'];
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İçerik Yönetimi - Admin Panel</title>
    <link rel="stylesheet" href="admin-style.css">
    <style>
        .emoji-picker {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 0.5rem;
            padding: 0.5rem;
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 0.5rem;
            max-width: 250px;
        }
        .emoji-picker span {
            padding: 0.5rem;
            text-align: center;
            cursor: pointer;
            font-size: 1.5rem;
            border-radius: 5px;
        }
        .emoji-picker span:hover {
            background: #f0f0f0;
        }
        .emoji-input-group {
            position: relative;
        }
        .logo-preview {
            max-width: 200px;
            margin: 1rem 0;
        }
        .content-item {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
        }
        .content-item.inactive {
            opacity: 0.6;
            background: #f5f5f5;
        }
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📝 İçerik Yönetimi</h1>
        <div class="header-right">
            <a href="index.php" class="btn btn-secondary">← Geri Dön</a>
        </div>
    </div>

    <div class="container">
        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <!-- Tab Menü -->
        <div class="tab-menu">
            <button class="tab-btn active" onclick="openTab(event, 'logo')">🎨 Logo</button>
            <button class="tab-btn" onclick="openTab(event, 'banner')">🖼️ Banner</button>
            <button class="tab-btn" onclick="openTab(event, 'services')">🔧 Hizmetler (<?php echo count($services); ?>)</button>
            <button class="tab-btn" onclick="openTab(event, 'features')">⭐ Özellikler (<?php echo count($features); ?>)</button>
            <button class="tab-btn" onclick="openTab(event, 'testimonials')">💬 Yorumlar (<?php echo count($testimonials); ?>)</button>
        </div>

        <!-- Logo Tab -->
        <div id="logo" class="tab-content active">
            <div class="card">
                <h2>Site Logosu</h2>
                <?php if ($logo): ?>
                    <img src="../<?php echo htmlspecialchars($logo['logo_path']); ?>" class="logo-preview" alt="Mevcut Logo">
                <?php endif; ?>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Yeni Logo Yükle (PNG, JPG - Max 5MB)</label>
                        <input type="file" name="logo" accept="image/*" required>
                    </div>
                    <button type="submit" name="upload_logo" class="btn">Logoyu Yükle</button>
                </form>
            </div>

            <div class="card" style="margin-top: 2rem;">
                <h2>Logo Metni</h2>
                <p style="color: #666; margin-bottom: 1rem;">Logo resmi yoksa bu metin gösterilir. Ayrıca SEO için de kullanılır.</p>
                <form method="POST">
                    <div class="form-group">
                        <label>Logo Metni</label>
                        <input type="text" name="site_logo_text" value="<?php echo htmlspecialchars($logoText); ?>" required placeholder="Örn: GÜÇLÜ OTOMOTİV">
                        <small style="color: #999; display: block; margin-top: 0.5rem;">Mevcut: <strong>🚗 <?php echo strtoupper(htmlspecialchars($logoText)); ?></strong></small>
                    </div>
                    <button type="submit" name="update_logo_text" class="btn">Logo Metnini Güncelle</button>
                </form>
            </div>
        </div>

        <!-- Banner Tab -->
        <div id="banner" class="tab-content">
            <div class="card">
                <h2>Ana Sayfa Banner</h2>
                <p style="color: #666; margin-bottom: 1.5rem;">⚠️ Banner sadece <strong>hero slider kapalı</strong> olduğunda gösterilir. (Ayarlar > Site Ayarları)</p>
                <form method="POST">
                    <div class="form-group">
                        <label>Banner Başlık</label>
                        <input type="text" name="banner_title" value="<?php echo htmlspecialchars($bannerSettings['banner_title']); ?>" required placeholder="Örn: Güvenle Alın, Huzurla Sürün">
                    </div>
                    <div class="form-group">
                        <label>Banner Alt Başlık</label>
                        <textarea name="banner_subtitle" rows="3" required placeholder="Örn: 20 Yıllık Tecrübe ile İkinci El Araç Alım Satım"><?php echo htmlspecialchars($bannerSettings['banner_subtitle']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Buton Metni</label>
                        <input type="text" name="banner_button_text" value="<?php echo htmlspecialchars($bannerSettings['banner_button_text']); ?>" required placeholder="Örn: Araçları İncele">
                    </div>
                    <div class="form-group">
                        <label>Buton URL</label>
                        <input type="text" name="banner_button_url" value="<?php echo htmlspecialchars($bannerSettings['banner_button_url']); ?>" required placeholder="Örn: #araclar veya https://...">
                        <small style="color: #999; display: block; margin-top: 0.5rem;">
                            💡 İpucu: Sayfa içi bağlantı için <strong>#araclar</strong>, <strong>#hizmetler</strong>, <strong>#iletisim</strong> gibi kullanabilirsiniz.
                        </small>
                    </div>
                    <button type="submit" name="update_banner" class="btn">Banner Güncelle</button>
                </form>
            </div>
        </div>

        <!-- Hizmetler Tab -->
        <div id="services" class="tab-content">
            <div class="card">
                <h2><?php echo $editService ? 'Hizmet Düzenle' : 'Yeni Hizmet Ekle'; ?></h2>
                <form method="POST">
                    <?php if ($editService): ?>
                        <input type="hidden" name="service_id" value="<?php echo $editService['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="form-grid">
                        <div class="form-group emoji-input-group">
                            <label>İkon (Emoji)</label>
                            <input type="text" id="service_icon" name="icon" value="<?php echo $editService ? htmlspecialchars($editService['icon']) : '🚗'; ?>" required maxlength="2" style="font-size: 2rem; text-align: center;">
                            <button type="button" onclick="toggleEmojiPicker('service_emoji_picker')" class="btn btn-small">Emoji Seç</button>
                            <div id="service_emoji_picker" class="emoji-picker" style="display: none;">
                                <?php foreach ($emojis as $emoji): ?>
                                    <span onclick="selectEmoji('service_icon', '<?php echo $emoji; ?>')"><?php echo $emoji; ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Başlık</label>
                            <input type="text" name="title" value="<?php echo $editService ? htmlspecialchars($editService['title']) : ''; ?>" required placeholder="Örn: Araç Alım-Satım">
                        </div>
                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label>Açıklama</label>
                            <textarea name="description" rows="3" required placeholder="Hizmet açıklaması..."><?php echo $editService ? htmlspecialchars($editService['description']) : ''; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Sıralama</label>
                            <input type="number" name="display_order" value="<?php echo $editService ? $editService['display_order'] : count($services) + 1; ?>" min="0">
                        </div>
                        <?php if ($editService): ?>
                        <div class="form-group">
                            <label><input type="checkbox" name="is_active" value="1" <?php echo $editService['is_active'] ? 'checked' : ''; ?>> Aktif</label>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div style="margin-top: 1rem; display: flex; gap: 1rem;">
                        <button type="submit" name="<?php echo $editService ? 'update_service' : 'add_service'; ?>" class="btn">
                            <?php echo $editService ? '✓ Güncelle' : '+ Ekle'; ?>
                        </button>
                        <?php if ($editService): ?>
                            <a href="content_management.php" class="btn btn-secondary">İptal</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>

            <div class="card">
                <h2>Hizmetler Listesi</h2>
                <?php foreach ($services as $s): ?>
                    <div class="content-item <?php echo !$s['is_active'] ? 'inactive' : ''; ?>">
                        <div class="content-header">
                            <div>
                                <span style="font-size: 1.5rem;"><?php echo $s['icon']; ?></span>
                                <strong><?php echo htmlspecialchars($s['title']); ?></strong>
                                <?php if (!$s['is_active']): ?><span class="badge" style="background: #999;">Pasif</span><?php endif; ?>
                            </div>
                            <div>
                                <a href="?edit_service=<?php echo $s['id']; ?>#services" class="btn btn-small">Düzenle</a>
                                <a href="?delete_service=<?php echo $s['id']; ?>" class="btn btn-small btn-danger" onclick="return confirm('Silmek istediğinizden emin misiniz?')">Sil</a>
                            </div>
                        </div>
                        <p style="margin: 0.5rem 0 0 0; color: #666;"><?php echo htmlspecialchars($s['description']); ?></p>
                        <small style="color: #999;">Sıra: <?php echo $s['display_order']; ?></small>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Özellikler Tab -->
        <div id="features" class="tab-content">
            <div class="card">
                <h2><?php echo $editFeature ? 'Özellik Düzenle' : 'Yeni Özellik Ekle'; ?></h2>
                <form method="POST">
                    <?php if ($editFeature): ?>
                        <input type="hidden" name="feature_id" value="<?php echo $editFeature['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="form-grid">
                        <div class="form-group emoji-input-group">
                            <label>İkon (Emoji)</label>
                            <input type="text" id="feature_icon" name="icon" value="<?php echo $editFeature ? htmlspecialchars($editFeature['icon']) : '✓'; ?>" required maxlength="2" style="font-size: 2rem; text-align: center;">
                            <button type="button" onclick="toggleEmojiPicker('feature_emoji_picker')" class="btn btn-small">Emoji Seç</button>
                            <div id="feature_emoji_picker" class="emoji-picker" style="display: none;">
                                <?php foreach ($emojis as $emoji): ?>
                                    <span onclick="selectEmoji('feature_icon', '<?php echo $emoji; ?>')"><?php echo $emoji; ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Başlık</label>
                            <input type="text" name="title" value="<?php echo $editFeature ? htmlspecialchars($editFeature['title']) : ''; ?>" required placeholder="Örn: 2000+ Mutlu Müşteri">
                        </div>
                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label>Açıklama</label>
                            <textarea name="description" rows="3" required placeholder="Özellik açıklaması..."><?php echo $editFeature ? htmlspecialchars($editFeature['description']) : ''; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Sıralama</label>
                            <input type="number" name="display_order" value="<?php echo $editFeature ? $editFeature['display_order'] : count($features) + 1; ?>" min="0">
                        </div>
                        <?php if ($editFeature): ?>
                        <div class="form-group">
                            <label><input type="checkbox" name="is_active" value="1" <?php echo $editFeature['is_active'] ? 'checked' : ''; ?>> Aktif</label>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div style="margin-top: 1rem; display: flex; gap: 1rem;">
                        <button type="submit" name="<?php echo $editFeature ? 'update_feature' : 'add_feature'; ?>" class="btn">
                            <?php echo $editFeature ? '✓ Güncelle' : '+ Ekle'; ?>
                        </button>
                        <?php if ($editFeature): ?>
                            <a href="content_management.php" class="btn btn-secondary">İptal</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>

            <div class="card">
                <h2>Özellikler Listesi</h2>
                <?php foreach ($features as $f): ?>
                    <div class="content-item <?php echo !$f['is_active'] ? 'inactive' : ''; ?>">
                        <div class="content-header">
                            <div>
                                <span style="font-size: 1.5rem;"><?php echo $f['icon']; ?></span>
                                <strong><?php echo htmlspecialchars($f['title']); ?></strong>
                                <?php if (!$f['is_active']): ?><span class="badge" style="background: #999;">Pasif</span><?php endif; ?>
                            </div>
                            <div>
                                <a href="?edit_feature=<?php echo $f['id']; ?>#features" class="btn btn-small">Düzenle</a>
                                <a href="?delete_feature=<?php echo $f['id']; ?>" class="btn btn-small btn-danger" onclick="return confirm('Silmek istediğinizden emin misiniz?')">Sil</a>
                            </div>
                        </div>
                        <p style="margin: 0.5rem 0 0 0; color: #666;"><?php echo htmlspecialchars($f['description']); ?></p>
                        <small style="color: #999;">Sıra: <?php echo $f['display_order']; ?></small>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Yorumlar Tab -->
        <div id="testimonials" class="tab-content">
            <div class="card">
                <h2><?php echo $editTestimonial ? 'Yorum Düzenle' : 'Yeni Yorum Ekle'; ?></h2>
                <form method="POST">
                    <?php if ($editTestimonial): ?>
                        <input type="hidden" name="testimonial_id" value="<?php echo $editTestimonial['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Müşteri Adı</label>
                            <input type="text" name="customer_name" value="<?php echo $editTestimonial ? htmlspecialchars($editTestimonial['customer_name']) : ''; ?>" required placeholder="Örn: Ahmet Yılmaz">
                        </div>
                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label>Yorum</label>
                            <textarea name="comment" rows="3" required placeholder="Müşterinin yorumu..."><?php echo $editTestimonial ? htmlspecialchars($editTestimonial['comment']) : ''; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Sıralama</label>
                            <input type="number" name="display_order" value="<?php echo $editTestimonial ? $editTestimonial['display_order'] : count($testimonials) + 1; ?>" min="0">
                        </div>
                        <?php if ($editTestimonial): ?>
                        <div class="form-group">
                            <label><input type="checkbox" name="is_active" value="1" <?php echo $editTestimonial['is_active'] ? 'checked' : ''; ?>> Aktif</label>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div style="margin-top: 1rem; display: flex; gap: 1rem;">
                        <button type="submit" name="<?php echo $editTestimonial ? 'update_testimonial' : 'add_testimonial'; ?>" class="btn">
                            <?php echo $editTestimonial ? '✓ Güncelle' : '+ Ekle'; ?>
                        </button>
                        <?php if ($editTestimonial): ?>
                            <a href="content_management.php" class="btn btn-secondary">İptal</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>

            <div class="card">
                <h2>Yorumlar Listesi</h2>
                <?php foreach ($testimonials as $t): ?>
                    <div class="content-item <?php echo !$t['is_active'] ? 'inactive' : ''; ?>">
                        <div class="content-header">
                            <div>
                                <strong><?php echo htmlspecialchars($t['customer_name']); ?></strong>
                                <?php if (!$t['is_active']): ?><span class="badge" style="background: #999;">Pasif</span><?php endif; ?>
                            </div>
                            <div>
                                <a href="?edit_testimonial=<?php echo $t['id']; ?>#testimonials" class="btn btn-small">Düzenle</a>
                                <a href="?delete_testimonial=<?php echo $t['id']; ?>" class="btn btn-small btn-danger" onclick="return confirm('Silmek istediğinizden emin misiniz?')">Sil</a>
                            </div>
                        </div>
                        <p style="margin: 0.5rem 0 0 0; color: #666; font-style: italic;">"<?php echo htmlspecialchars($t['comment']); ?>"</p>
                        <small style="color: #999;">Sıra: <?php echo $t['display_order']; ?></small>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].classList.remove("active");
            }
            tablinks = document.getElementsByClassName("tab-btn");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }
            document.getElementById(tabName).classList.add("active");
            if(evt && evt.currentTarget) {
                evt.currentTarget.classList.add("active");
            } else {
                // URL'den gelen düzenleme durumu için
                var buttons = document.querySelectorAll('.tab-btn');
                buttons.forEach(function(btn) {
                    if(btn.getAttribute('onclick').includes(tabName)) {
                        btn.classList.add('active');
                    }
                });
            }
        }
        
        // Sayfa yüklenince hangi tab'in açık olacağını kontrol et
        window.addEventListener('DOMContentLoaded', function() {
            <?php if ($editService): ?>
                openTab(null, 'services');
            <?php elseif ($editFeature): ?>
                openTab(null, 'features');
            <?php elseif ($editTestimonial): ?>
                openTab(null, 'testimonials');
            <?php endif; ?>
        });

        function toggleEmojiPicker(id) {
            const picker = document.getElementById(id);
            picker.style.display = picker.style.display === 'none' ? 'grid' : 'none';
        }

        function selectEmoji(inputId, emoji) {
            document.getElementById(inputId).value = emoji;
            // Tüm emoji pickerları kapat
            document.querySelectorAll('.emoji-picker').forEach(p => p.style.display = 'none');
        }
    </script>
</body>
</html>

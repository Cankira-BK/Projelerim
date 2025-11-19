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
$vehicleId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$vehicle = null;
$images = [];

// Araç bilgilerini çek
if ($vehicleId > 0) {
    $vehicle = $db->fetchOne("SELECT * FROM vehicles WHERE id = ?", [$vehicleId]);
    if (!$vehicle) {
        header('Location: index.php');
        exit;
    }
    $images = $db->fetchAll("SELECT * FROM vehicle_images WHERE vehicle_id = ? ORDER BY display_order ASC, is_primary DESC", [$vehicleId]);
}

// Araç ekleme/güncelleme
if (isset($_POST['save_vehicle'])) {
    try {
        $title = sanitize($_POST['title']);
        $price = sanitize($_POST['price']);
        $year = sanitize($_POST['year']);
        $km = sanitize($_POST['km']);
        $fuel = $_POST['fuel'];
        $transmission = $_POST['transmission'] ?? 'Manuel';
        $color = sanitize($_POST['color'] ?? '');
        $body_type = sanitize($_POST['body_type'] ?? '');
        $description = sanitize($_POST['description'] ?? '');
        $sahibinden_link = sanitize($_POST['sahibinden_link'] ?? '');
        $is_featured = isset($_POST['is_featured']) ? 1 : 0;
        
        $primaryImage = '';
        if (!empty($images)) {
            foreach ($images as $img) {
                if ($img['is_primary']) {
                    $primaryImage = $img['image_url'];
                    break;
                }
            }
            if (empty($primaryImage) && !empty($images[0]['image_url'])) {
                $primaryImage = $images[0]['image_url'];
            }
        }
        
        if ($vehicleId > 0) {
            $sql = "UPDATE vehicles SET title=?, price=?, year=?, km=?, fuel=?, transmission=?, color=?, body_type=?, description=?, sahibinden_link=?, is_featured=? WHERE id=?";
            $db->execute($sql, [$title, $price, $year, $km, $fuel, $transmission, $color, $body_type, $description, $sahibinden_link, $is_featured, $vehicleId]);
            
            if (!empty($primaryImage)) {
                $db->execute("UPDATE vehicles SET image=? WHERE id=?", [$primaryImage, $vehicleId]);
            }
            
            logSecurity('data_change', $_SESSION['admin_username'], 'Vehicle updated: ' . $vehicleId);
            header('Location: manage_vehicle.php?id=' . $vehicleId . '&msg=updated');
            exit;
        } else {
            $sql = "INSERT INTO vehicles (title, price, year, km, fuel, transmission, color, body_type, description, image, sahibinden_link, is_featured, status) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'active')";
            
            $newVehicleId = $db->insert($sql, [$title, $price, $year, $km, $fuel, $transmission, $color, $body_type, $description, $primaryImage ?: 'placeholder.jpg', $sahibinden_link, $is_featured]);
            
            logSecurity('data_change', $_SESSION['admin_username'], 'Vehicle added: ' . $newVehicleId);
            header('Location: manage_vehicle.php?id=' . $newVehicleId . '&msg=added');
            exit;
        }
    } catch (Exception $e) {
        $error = 'Hata: ' . $e->getMessage();
    }
}

// Bilgisayardan resim yükleme işlemi (admin paneline eklenen kısım)
if (isset($_POST['upload_images']) && isset($_FILES['vehicle_images'])) {
    try {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $fileCount = count($_FILES['vehicle_images']['name']);
        for ($i = 0; $i < $fileCount; $i++) {
            $file_tmp = $_FILES['vehicle_images']['tmp_name'][$i];
            $file_name = basename($_FILES['vehicle_images']['name'][$i]);
            $target_file = $target_dir . uniqid() . '_' . $file_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            $check = getimagesize($file_tmp);
            if ($check === false) continue;
            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (!in_array($imageFileType, $allowed)) continue;
            if ($_FILES['vehicle_images']['size'][$i] > 5 * 1024 * 1024) continue;
            if (!move_uploaded_file($file_tmp, $target_file)) continue;

            $imageCount = $db->fetchOne("SELECT COUNT(*) as count FROM vehicle_images WHERE vehicle_id = ?", [$vehicleId])['count'];
            $isPrimary = ($imageCount == 0) ? 1 : 0;
            $displayOrder = $imageCount;

            $sql = "INSERT INTO vehicle_images (vehicle_id, image_url, display_order, is_primary) VALUES (?, ?, ?, ?)";
            $db->insert($sql, [$vehicleId, $target_file, $displayOrder, $isPrimary]);
            if ($isPrimary) {
                $db->execute("UPDATE vehicles SET image=? WHERE id=?", [$target_file, $vehicleId]);
            }
        }
        logSecurity('data_change', $_SESSION['admin_username'], 'Multiple images uploaded to vehicle: ' . $vehicleId);
        header('Location: manage_vehicle.php?id=' . $vehicleId . '&msg=image_added');
        exit;
    } catch (Exception $e) {
        $error = 'Resim yükleme hatası: ' . $e->getMessage();
    }
}

// Resim ekleme (URL ile)
if (isset($_POST['add_image'])) {
    try {
        $imageUrl = sanitize($_POST['image_url']);
		
        if (empty($imageUrl)) {
            throw new Exception('Resim URL\'si boş olamaz');
        }
        $imageCount = $db->fetchOne("SELECT COUNT(*) as count FROM vehicle_images WHERE vehicle_id = ?", [$vehicleId])['count'];
        $isPrimary = ($imageCount == 0) ? 1 : 0;
        $displayOrder = $imageCount;
        $sql = "INSERT INTO vehicle_images (vehicle_id, image_url, display_order, is_primary) VALUES (?, ?, ?, ?)";
        $db->insert($sql, [$vehicleId, $imageUrl, $displayOrder, $isPrimary]);
        if ($isPrimary) {
            $db->execute("UPDATE vehicles SET image=? WHERE id=?", [$imageUrl, $vehicleId]);
        }
        logSecurity('data_change', $_SESSION['admin_username'], 'Image added to vehicle: ' . $vehicleId);
        header('Location: manage_vehicle.php?id=' . $vehicleId . '&msg=image_added');
        exit;
    } catch (Exception $e) {
        $error = 'Resim ekleme hatası: ' . $e->getMessage();
    }
}
// Resim silme
if (isset($_GET['delete_image'])) {
    try {
        $imageId = (int)$_GET['delete_image'];
        $image = $db->fetchOne("SELECT * FROM vehicle_images WHERE id = ? AND vehicle_id = ?", [$imageId, $vehicleId]);
        if ($image) {
            $db->execute("DELETE FROM vehicle_images WHERE id = ?", [$imageId]);
            if ($image['is_primary']) {
                $nextImage = $db->fetchOne("SELECT * FROM vehicle_images WHERE vehicle_id = ? ORDER BY display_order ASC LIMIT 1", [$vehicleId]);
                if ($nextImage) {
                    $db->execute("UPDATE vehicle_images SET is_primary = 1 WHERE id = ?", [$nextImage['id']]);
                    $db->execute("UPDATE vehicles SET image = ? WHERE id = ?", [$nextImage['image_url'], $vehicleId]);
                } else {
                    $db->execute("UPDATE vehicles SET image = ? WHERE id = ?", ['placeholder.jpg', $vehicleId]);
                }
            }
            logSecurity('data_change', $_SESSION['admin_username'], 'Image deleted from vehicle: ' . $vehicleId);
            header('Location: manage_vehicle.php?id=' . $vehicleId . '&msg=image_deleted');
            exit;
        }
    } catch (Exception $e) {
        $error = 'Resim silme hatası: ' . $e->getMessage();
    }
}

// Ana resim ayarlama
if (isset($_GET['set_primary'])) {
    try {
        $imageId = (int)$_GET['set_primary'];
        $image = $db->fetchOne("SELECT * FROM vehicle_images WHERE id = ? AND vehicle_id = ?", [$imageId, $vehicleId]);
        if ($image) {
            $db->execute("UPDATE vehicle_images SET is_primary = 0 WHERE vehicle_id = ?", [$vehicleId]);
            $db->execute("UPDATE vehicle_images SET is_primary = 1 WHERE id = ?", [$imageId]);
            $db->execute("UPDATE vehicles SET image = ? WHERE id = ?", [$image['image_url'], $vehicleId]);
            header('Location: manage_vehicle.php?id=' . $vehicleId . '&msg=primary_set');
            exit;
        }
    } catch (Exception $e) {
        $error = 'Ana resim ayarlama hatası: ' . $e->getMessage();
    }
}

// Resim sırasını değiştir
if (isset($_POST['update_order'])) {
    try {
        $orders = $_POST['image_order'] ?? [];
        foreach ($orders as $imageId => $order) {
            $db->execute("UPDATE vehicle_images SET display_order = ? WHERE id = ? AND vehicle_id = ?", [(int)$order, (int)$imageId, $vehicleId]);
        }
        header('Location: manage_vehicle.php?id=' . $vehicleId . '&msg=order_updated');
        exit;
    } catch (Exception $e) {
        $error = 'Sıralama hatası: ' . $e->getMessage();
    }
}

// Mesajları kontrol et
if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'added': $message = 'Araç başarıyla eklendi! Şimdi resim ekleyebilirsiniz.'; break;
        case 'updated': $message = 'Araç başarıyla güncellendi!'; break;
        case 'image_added': $message = 'Resim başarıyla eklendi!'; break;
        case 'image_deleted': $message = 'Resim silindi!'; break;
        case 'primary_set': $message = 'Ana resim ayarlandı!'; break;
        case 'order_updated': $message = 'Resim sıralaması güncellendi!'; break;
    }
}

if ($vehicleId > 0) {
    $images = $db->fetchAll("SELECT * FROM vehicle_images WHERE vehicle_id = ? ORDER BY display_order ASC, is_primary DESC", [$vehicleId]);
}


?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $vehicle ? 'Araç Düzenle' : 'Yeni Araç Ekle'; ?> - Admin Panel</title>
    <link rel="stylesheet" href="admin-style.css">
    <style>
        .images-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem; margin-top: 1rem; }
        .image-item { position: relative; border: 2px solid #e0e0e0; border-radius: 8px; overflow: hidden; transition: all 0.3s; }
        .image-item:hover { border-color: #ffd700; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        .image-item.primary { border-color: #28a745; border-width: 3px; }
        .image-item img { width: 100%; height: 150px; object-fit: cover; display: block; }
        .image-actions { position: absolute; top: 0; left: 0; right: 0; background: rgba(0,0,0,0.8); padding: 0.5rem; display: flex; gap: 0.5rem; justify-content: center; opacity: 0; transition: opacity 0.3s; }
        .image-item:hover .image-actions { opacity: 1; }
        .image-badge { position: absolute; top: 0.5rem; right: 0.5rem; background: #28a745; color: white; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem; font-weight: bold; z-index: 2; }
        .image-order { position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.8); padding: 0.5rem; display: flex; align-items: center; gap: 0.5rem; color: white; font-size: 0.85rem; }
        .image-order input { width: 50px; padding: 0.25rem; border-radius: 4px; border: none; }
        .upload-methods { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 1rem; }
        .upload-method { padding: 1.5rem; border: 2px dashed #e0e0e0; border-radius: 8px; text-align: center; cursor: pointer; transition: all 0.3s; }
        .upload-method:hover { border-color: #ffd700; background: #fff9e6; }
        .upload-method.active { border-color: #ffd700; background: #fff9e6; border-style: solid; }
        .upload-icon { font-size: 3rem; margin-bottom: 0.5rem; }
        .image-preview { margin-top: 1rem; display: none; text-align: center; }
        .image-preview.show { display: block; }
        .image-preview img { max-width: 100%; height: auto; max-height: 300px; border-radius: 8px; border: 2px solid #e0e0e0; }
    </style>
</head>
<body>
    <div class="header">
        <h1><?php echo $vehicle ? '✏️ Araç Düzenle' : '➕ Yeni Araç Ekle'; ?></h1>
        <div class="header-right">
            <a href="index.php" class="btn btn-small">← Araç Listesi</a>
        </div>
    </div>
    <div class="container">
    <?php if ($message): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <div class="card">
        <h2>📝 Araç Bilgileri</h2>
        <form method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Araç Başlığı *</label>
                        <input type="text" name="title" required value="<?php echo $vehicle ? htmlspecialchars($vehicle['title']) : ''; ?>" placeholder="Örn: FORD TOURNEO COURIER 1.5 ECOBLUE">
                    </div>
                    <div class="form-group">
                        <label>Fiyat *</label>
                        <input type="text" name="price" required placeholder="Örn: 1.142.000 TL" value="<?php echo $vehicle ? htmlspecialchars($vehicle['price']) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label>Yıl *</label>
                        <input type="text" name="year" required value="<?php echo $vehicle ? htmlspecialchars($vehicle['year']) : ''; ?>" placeholder="Örn: 2024">
                    </div>
                    <div class="form-group">
                        <label>Kilometre *</label>
                        <input type="text" name="km" required value="<?php echo $vehicle ? htmlspecialchars($vehicle['km']) : ''; ?>" placeholder="Örn: 18.500 km">
                    </div>
                    <div class="form-group">
                        <label>Yakıt *</label>
                        <select name="fuel" required>
                            <option value="">Seçiniz</option>
                            <option value="Dizel" <?php echo ($vehicle && $vehicle['fuel'] === 'Dizel') ? 'selected' : ''; ?>>Dizel</option>
                            <option value="Benzin" <?php echo ($vehicle && $vehicle['fuel'] === 'Benzin') ? 'selected' : ''; ?>>Benzin</option>
                            <option value="Benzin/LPG" <?php echo ($vehicle && $vehicle['fuel'] === 'Benzin/LPG') ? 'selected' : ''; ?>>Benzin/LPG</option>
                            <option value="Hybrid" <?php echo ($vehicle && $vehicle['fuel'] === 'Hybrid') ? 'selected' : ''; ?>>Hybrid</option>
                            <option value="Elektrik" <?php echo ($vehicle && $vehicle['fuel'] === 'Elektrik') ? 'selected' : ''; ?>>Elektrik</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Vites *</label>
                        <select name="transmission">
                            <option value="Manuel" <?php echo ($vehicle && $vehicle['transmission'] === 'Manuel') ? 'selected' : ''; ?>>Manuel</option>
                            <option value="Otomatik" <?php echo ($vehicle && $vehicle['transmission'] === 'Otomatik') ? 'selected' : ''; ?>>Otomatik</option>
                            <option value="Yarı Otomatik" <?php echo ($vehicle && $vehicle['transmission'] === 'Yarı Otomatik') ? 'selected' : ''; ?>>Yarı Otomatik</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Renk</label>
                        <input type="text" name="color" value="<?php echo $vehicle ? htmlspecialchars($vehicle['color']) : ''; ?>" placeholder="Örn: Beyaz">
                    </div>
                    <div class="form-group">
                        <label>Kasa Tipi</label>
                        <input type="text" name="body_type" value="<?php echo $vehicle ? htmlspecialchars($vehicle['body_type']) : ''; ?>" placeholder="Örn: Sedan, SUV">
                    </div>
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label>Sahibinden Link</label>
                        <input type="url" name="sahibinden_link" value="<?php echo $vehicle ? htmlspecialchars($vehicle['sahibinden_link']) : ''; ?>" placeholder="https://www.sahibinden.com/...">
                    </div>
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label>Açıklama</label>
                        <textarea name="description" rows="4" placeholder="Araç hakkında detaylı bilgi..."><?php echo $vehicle ? htmlspecialchars($vehicle['description']) : ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label><input type="checkbox" name="is_featured" value="1" <?php echo ($vehicle && $vehicle['is_featured']) ? 'checked' : ''; ?>> ⭐ Öne Çıkan Araç</label>
                    </div>
                </div>
                <div style="margin-top: 1.5rem;">
                    <button type="submit" name="save_vehicle" class="btn"><?php echo $vehicle ? '✓ Bilgileri Güncelle' : '+ Araç Oluştur'; ?></button>
                    <a href="index.php" class="btn btn-secondary">İptal</a>
                </div>
        </form>
    </div>

    <?php if ($vehicleId > 0): ?>
    <div class="card">
        <h2>📸 Araç Resimleri (<?php echo count($images); ?>)</h2>
        <?php if (!empty($images)): ?>
        <form method="POST">
            <div class="images-grid">
                <?php foreach ($images as $img): ?>
                    <div class="image-item <?php echo $img['is_primary'] ? 'primary' : ''; ?>">
                        <img src="<?php echo htmlspecialchars($img['image_url']); ?>" alt="Araç resmi">
                        <?php if ($img['is_primary']): ?>
                            <div class="image-badge">⭐ ANA RESİM</div>
                        <?php endif; ?>
                        <div class="image-actions">
                            <?php if (!$img['is_primary']): ?>
                                <a href="?id=<?php echo $vehicleId; ?>&set_primary=<?php echo $img['id']; ?>" class="btn btn-small btn-success" title="Ana Resim Yap">⭐</a>
                            <?php endif; ?>
                            <a href="?id=<?php echo $vehicleId; ?>&delete_image=<?php echo $img['id']; ?>" class="btn btn-small btn-danger" onclick="return confirm('Bu resmi silmek istediğinizden emin misiniz?')" title="Sil">🗑️</a>
                        </div>
                        <div class="image-order">
                            <label style="margin: 0;">Sıra:</label>
                            <input type="number" name="image_order[<?php echo $img['id']; ?>]" value="<?php echo $img['display_order']; ?>" min="0">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div style="margin-top: 1rem;">
                <button type="submit" name="update_order" class="btn btn-small">💾 Sıralamayı Kaydet</button>
            </div>
        </form>
        <?php else: ?>
            <p style="text-align: center; padding: 2rem; color: #666; background: #f8f9fa; border-radius: 8px;">📷 Henüz resim eklenmemiş.</p>
        <?php endif; ?>
    </div>

    <!-- Bilgisayardan ve URL ile resim yükleme alanı -->
    <div class="card">
        <h2>➕ Yeni Resim Ekle</h2>
        <div class="upload-methods">
            <div class="upload-method" onclick="document.getElementById('fileUploadForm').style.display='block';document.getElementById('imageForm').style.display='none';">
                <div class="upload-icon">💻</div>
                <h3>Bilgisayardan Yükle</h3>
                <p>Dosya seçerek yükle</p>
            </div>
            <div class="upload-method" onclick="document.getElementById('fileUploadForm').style.display='none';document.getElementById('imageForm').style.display='block';">
                <div class="upload-icon">🔗</div>
                <h3>Link ile Ekle</h3>
                <p>Resim URL'si ile yükle</p>
            </div>
        </div>

        <!-- Bilgisayardan yükleme formu -->
        <form method="POST" id="fileUploadForm" enctype="multipart/form-data" style="display:none; margin-top:1rem;">
            <div class="form-group">
                <label>Resim Seç *</label>
                <input type="file" name="vehicle_images[]" accept="image/*" multiple required>
            </div>
            <div style="margin-top: 1rem;">
                <button type="submit" name="upload_images" class="btn">✓ Yükle</button>
            </div>
        </form>

        <!-- URL ile yükleme formu -->
        <form method="POST" id="imageForm" style="display:block; margin-top:1rem;">
            <div class="form-group">
                <label>Resim URL'si *</label>
                <input type="url" name="image_url" id="imageUrlInput" placeholder="https://example.com/image.jpg" required>
                <button type="button" onclick="previewImage()" class="btn btn-small" style="margin-top: 0.5rem;">👁️ Önizle</button>
            </div>
            <div class="image-preview" id="imagePreview">
                <p style="font-weight: bold; margin-bottom: 0.5rem;">Önizleme:</p>
                <img id="previewImg" src="" alt="Önizleme">
            </div>
            <div style="margin-top: 1rem;">
                <button type="submit" name="add_image" class="btn">✓ Resmi Ekle</button>
            </div>
        </form>
    </div>
    <?php else: ?>
    <div class="card">
        <p style="text-align: center; padding: 2rem; background: #fff3cd; border-radius: 8px; color: #856404;">⚠️ Resim eklemek için önce aracı kaydedin.</p>
    </div>
    <?php endif; ?>
</div>

<script>
function previewImage() {
    const url = document.getElementById('imageUrlInput').value.trim();
    const preview = document.getElementById('imagePreview');
    const img = document.getElementById('previewImg');
    if (!url) {
        alert('Lütfen bir resim URL\'si girin');
        return;
    }
    img.src = url;
    img.onerror = function() {
        alert('Resim yüklenemedi. URL\'yi kontrol edin.');
        preview.classList.remove('show');
    };
    img.onload = function() {
        preview.classList.add('show');
    };
}
</script>
</body>
</html>


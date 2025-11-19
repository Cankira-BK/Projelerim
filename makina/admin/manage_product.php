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
$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product = null;
$images = [];

// Ürün bilgilerini çek
if ($productId > 0) {
    $product = $db->fetchOne("SELECT * FROM products WHERE id = ?", [$productId]);
    if (!$product) {
        header('Location: index.php');
        exit;
    }
    $images = $db->fetchAll("SELECT * FROM product_images WHERE product_id = ? ORDER BY display_order ASC, is_primary DESC", [$productId]);
}

// Ürün ekleme/güncelleme
if (isset($_POST['save_product'])) {
    try {
        $title = sanitize($_POST['title']);
        $category = sanitize($_POST['category']);
        $specifications = sanitize($_POST['specifications']);
        $material = sanitize($_POST['material'] ?? '');
        $description = sanitize($_POST['description'] ?? '');
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
        
        if ($productId > 0) {
            $sql = "UPDATE products SET title=?, category=?, specifications=?, material=?, description=?, is_featured=? WHERE id=?";
            $db->execute($sql, [$title, $category, $specifications, $material, $description, $is_featured, $productId]);
            
            if (!empty($primaryImage)) {
                $db->execute("UPDATE products SET image=? WHERE id=?", [$primaryImage, $productId]);
            }
            
            logSecurity('data_change', $_SESSION['admin_username'], 'Product updated: ' . $productId);
            header('Location: manage_product.php?id=' . $productId . '&msg=updated');
            exit;
        } else {
            $sql = "INSERT INTO products (title, category, specifications, material, description, image, is_featured, status) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, 'active')";
            
            $newProductId = $db->insert($sql, [$title, $category, $specifications, $material, $description, $primaryImage ?: 'https://via.placeholder.com/400x300', $is_featured]);
            
            logSecurity('data_change', $_SESSION['admin_username'], 'Product added: ' . $newProductId);
            header('Location: manage_product.php?id=' . $newProductId . '&msg=added');
            exit;
        }
    } catch (Exception $e) {
        $error = 'Hata: ' . $e->getMessage();
    }
}

// Bilgisayardan resim yükleme
if (isset($_POST['upload_images']) && isset($_FILES['product_images'])) {
    try {
        $target_dir = "../uploads/products/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $fileCount = count($_FILES['product_images']['name']);
        for ($i = 0; $i < $fileCount; $i++) {
            $file_tmp = $_FILES['product_images']['tmp_name'][$i];
            $file_name = basename($_FILES['product_images']['name'][$i]);
            $target_file = $target_dir . uniqid() . '_' . $file_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            $check = getimagesize($file_tmp);
            if ($check === false) continue;
            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (!in_array($imageFileType, $allowed)) continue;
            if ($_FILES['product_images']['size'][$i] > 5 * 1024 * 1024) continue;
            if (!move_uploaded_file($file_tmp, $target_file)) continue;

            $imageCount = $db->fetchOne("SELECT COUNT(*) as count FROM product_images WHERE product_id = ?", [$productId])['count'];
            $isPrimary = ($imageCount == 0) ? 1 : 0;
            $displayOrder = $imageCount;

            $sql = "INSERT INTO product_images (product_id, image_url, display_order, is_primary) VALUES (?, ?, ?, ?)";
            $db->insert($sql, [$productId, $target_file, $displayOrder, $isPrimary]);
            if ($isPrimary) {
                $db->execute("UPDATE products SET image=? WHERE id=?", [$target_file, $productId]);
            }
        }
        logSecurity('data_change', $_SESSION['admin_username'], 'Multiple images uploaded to product: ' . $productId);
        header('Location: manage_product.php?id=' . $productId . '&msg=image_added');
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
        $imageCount = $db->fetchOne("SELECT COUNT(*) as count FROM product_images WHERE product_id = ?", [$productId])['count'];
        $isPrimary = ($imageCount == 0) ? 1 : 0;
        $displayOrder = $imageCount;
        $sql = "INSERT INTO product_images (product_id, image_url, display_order, is_primary) VALUES (?, ?, ?, ?)";
        $db->insert($sql, [$productId, $imageUrl, $displayOrder, $isPrimary]);
        if ($isPrimary) {
            $db->execute("UPDATE products SET image=? WHERE id=?", [$imageUrl, $productId]);
        }
        logSecurity('data_change', $_SESSION['admin_username'], 'Image added to product: ' . $productId);
        header('Location: manage_product.php?id=' . $productId . '&msg=image_added');
        exit;
    } catch (Exception $e) {
        $error = 'Resim ekleme hatası: ' . $e->getMessage();
    }
}

// Resim silme
if (isset($_GET['delete_image'])) {
    try {
        $imageId = (int)$_GET['delete_image'];
        $image = $db->fetchOne("SELECT * FROM product_images WHERE id = ? AND product_id = ?", [$imageId, $productId]);
        if ($image) {
            $db->execute("DELETE FROM product_images WHERE id = ?", [$imageId]);
            if ($image['is_primary']) {
                $nextImage = $db->fetchOne("SELECT * FROM product_images WHERE product_id = ? ORDER BY display_order ASC LIMIT 1", [$productId]);
                if ($nextImage) {
                    $db->execute("UPDATE product_images SET is_primary = 1 WHERE id = ?", [$nextImage['id']]);
                    $db->execute("UPDATE products SET image = ? WHERE id = ?", [$nextImage['image_url'], $productId]);
                } else {
                    $db->execute("UPDATE products SET image = ? WHERE id = ?", ['https://via.placeholder.com/400x300', $productId]);
                }
            }
            logSecurity('data_change', $_SESSION['admin_username'], 'Image deleted from product: ' . $productId);
            header('Location: manage_product.php?id=' . $productId . '&msg=image_deleted');
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
        $image = $db->fetchOne("SELECT * FROM product_images WHERE id = ? AND product_id = ?", [$imageId, $productId]);
        if ($image) {
            $db->execute("UPDATE product_images SET is_primary = 0 WHERE product_id = ?", [$productId]);
            $db->execute("UPDATE product_images SET is_primary = 1 WHERE id = ?", [$imageId]);
            $db->execute("UPDATE products SET image = ? WHERE id = ?", [$image['image_url'], $productId]);
            header('Location: manage_product.php?id=' . $productId . '&msg=primary_set');
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
            $db->execute("UPDATE product_images SET display_order = ? WHERE id = ? AND product_id = ?", [(int)$order, (int)$imageId, $productId]);
        }
        header('Location: manage_product.php?id=' . $productId . '&msg=order_updated');
        exit;
    } catch (Exception $e) {
        $error = 'Sıralama hatası: ' . $e->getMessage();
    }
}

// Mesajları kontrol et
if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'added': $message = 'Ürün başarıyla eklendi! Şimdi resim ekleyebilirsiniz.'; break;
        case 'updated': $message = 'Ürün başarıyla güncellendi!'; break;
        case 'image_added': $message = 'Resim başarıyla eklendi!'; break;
        case 'image_deleted': $message = 'Resim silindi!'; break;
        case 'primary_set': $message = 'Ana resim ayarlandı!'; break;
        case 'order_updated': $message = 'Resim sıralaması güncellendi!'; break;
    }
}

if ($productId > 0) {
    $images = $db->fetchAll("SELECT * FROM product_images WHERE product_id = ? ORDER BY display_order ASC, is_primary DESC", [$productId]);
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product ? 'Ürün Düzenle' : 'Yeni Ürün Ekle'; ?> - Admin Panel</title>
    <link rel="stylesheet" href="admin-style.css">
    <style>
        .images-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem; margin-top: 1rem; }
        .image-item { position: relative; border: 2px solid #e0e0e0; border-radius: 8px; overflow: hidden; transition: all 0.3s; }
        .image-item:hover { border-color: #ff6b35; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        .image-item.primary { border-color: #28a745; border-width: 3px; }
        .image-item img { width: 100%; height: 150px; object-fit: cover; display: block; }
        .image-actions { position: absolute; top: 0; left: 0; right: 0; background: rgba(0,0,0,0.8); padding: 0.5rem; display: flex; gap: 0.5rem; justify-content: center; opacity: 0; transition: opacity 0.3s; }
        .image-item:hover .image-actions { opacity: 1; }
        .image-badge { position: absolute; top: 0.5rem; right: 0.5rem; background: #28a745; color: white; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem; font-weight: bold; z-index: 2; }
        .image-order { position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.8); padding: 0.5rem; display: flex; align-items: center; gap: 0.5rem; color: white; font-size: 0.85rem; }
        .image-order input { width: 50px; padding: 0.25rem; border-radius: 4px; border: none; }
        .upload-methods { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 1rem; }
        .upload-method { padding: 1.5rem; border: 2px dashed #e0e0e0; border-radius: 8px; text-align: center; cursor: pointer; transition: all 0.3s; }
        .upload-method:hover { border-color: #ff6b35; background: #fff5f0; }
        .upload-method.active { border-color: #ff6b35; background: #fff5f0; border-style: solid; }
        .upload-icon { font-size: 3rem; margin-bottom: 0.5rem; }
        .image-preview { margin-top: 1rem; display: none; text-align: center; }
        .image-preview.show { display: block; }
        .image-preview img { max-width: 100%; height: auto; max-height: 300px; border-radius: 8px; border: 2px solid #e0e0e0; }
        .category-suggestions { display: flex; gap: 0.5rem; flex-wrap: wrap; margin-top: 0.5rem; }
        .category-tag { padding: 0.25rem 0.75rem; background: #e9ecef; border: 1px solid #dee2e6; border-radius: 15px; font-size: 0.85rem; cursor: pointer; transition: all 0.3s; }
        .category-tag:hover { background: #ff6b35; color: white; border-color: #ff6b35; }
    </style>
</head>
<body>
    <div class="header">
        <h1><?php echo $product ? '✏️ Ürün Düzenle' : '➕ Yeni Ürün Ekle'; ?></h1>
        <div class="header-right">
            <a href="index.php" class="btn btn-small">← Ürün Listesi</a>
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
        <h2>📝 Ürün/Parça Bilgileri</h2>
        <form method="POST">
                <div class="form-grid">
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label>Ürün/Parça Başlığı *</label>
                        <input type="text" name="title" required value="<?php echo $product ? htmlspecialchars($product['title']) : ''; ?>" placeholder="Örn: Hassas Mil Tornalama Hizmeti">
                    </div>
                    <div class="form-group">
                        <label>Kategori *</label>
                        <input type="text" name="category" id="categoryInput" required value="<?php echo $product ? htmlspecialchars($product['category']) : ''; ?>" placeholder="Örn: CNC Torna">
                        <div class="category-suggestions">
                            <span class="category-tag" onclick="setCategory('CNC Torna')">CNC Torna</span>
                            <span class="category-tag" onclick="setCategory('CNC Freze')">CNC Freze</span>
                            <span class="category-tag" onclick="setCategory('Yedek Parça İmalatı')">Yedek Parça</span>
                            <span class="category-tag" onclick="setCategory('Bakım-Onarım')">Bakım-Onarım</span>
                            <span class="category-tag" onclick="setCategory('Kaynak İşleri')">Kaynak</span>
                            <span class="category-tag" onclick="setCategory('Montaj Hizmeti')">Montaj</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Malzeme</label>
                        <input type="text" name="material" value="<?php echo $product ? htmlspecialchars($product['material']) : ''; ?>" placeholder="Örn: Çelik, Paslanmaz, Alüminyum">
                    </div>
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label>Teknik Özellikler / Ölçüler *</label>
                        <input type="text" name="specifications" required value="<?php echo $product ? htmlspecialchars($product['specifications']) : ''; ?>" placeholder="Örn: Ø10-300mm, Uzunluk: 1500mm">
                        <small style="display:block;margin-top:0.25rem;color:#666;">💡 Ölçüler, kapasiteler, teknik detaylar</small>
                    </div>
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label>Detaylı Açıklama</label>
                        <textarea name="description" rows="5" placeholder="Ürün/hizmet hakkında detaylı bilgi..."><?php echo $product ? htmlspecialchars($product['description']) : ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label><input type="checkbox" name="is_featured" value="1" <?php echo ($product && $product['is_featured']) ? 'checked' : ''; ?>> ⭐ Öne Çıkan Ürün</label>
                    </div>
                </div>
                <div style="margin-top: 1.5rem;">
                    <button type="submit" name="save_product" class="btn"><?php echo $product ? '✓ Bilgileri Güncelle' : '+ Ürün Oluştur'; ?></button>
                    <a href="index.php" class="btn btn-secondary">İptal</a>
                </div>
        </form>
    </div>

    <?php if ($productId > 0): ?>
    <div class="card">
        <h2>📸 Ürün Resimleri (<?php echo count($images); ?>)</h2>
        <?php if (!empty($images)): ?>
        <form method="POST">
            <div class="images-grid">
                <?php foreach ($images as $img): ?>
                    <div class="image-item <?php echo $img['is_primary'] ? 'primary' : ''; ?>">
                        <img src="<?php echo htmlspecialchars($img['image_url']); ?>" alt="Ürün resmi">
                        <?php if ($img['is_primary']): ?>
                            <div class="image-badge">⭐ ANA RESİM</div>
                        <?php endif; ?>
                        <div class="image-actions">
                            <?php if (!$img['is_primary']): ?>
                                <a href="?id=<?php echo $productId; ?>&set_primary=<?php echo $img['id']; ?>" class="btn btn-small btn-success" title="Ana Resim Yap">⭐</a>
                            <?php endif; ?>
                            <a href="?id=<?php echo $productId; ?>&delete_image=<?php echo $img['id']; ?>" class="btn btn-small btn-danger" onclick="return confirm('Bu resmi silmek istediğinizden emin misiniz?')" title="Sil">🗑️</a>
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

    <div class="card">
        <h2>➕ Yeni Resim Ekle</h2>
        <div class="upload-methods">
            <div class="upload-method" onclick="toggleUploadMethod('file')">
                <div class="upload-icon">💻</div>
                <h3>Bilgisayardan Yükle</h3>
                <p>Dosya seçerek yükle</p>
            </div>
            <div class="upload-method" onclick="toggleUploadMethod('url')">
                <div class="upload-icon">🔗</div>
                <h3>Link ile Ekle</h3>
                <p>Resim URL'si ile yükle</p>
            </div>
        </div>

        <form method="POST" id="fileUploadForm" enctype="multipart/form-data" style="display:none; margin-top:1rem;">
            <div class="form-group">
                <label>Resim Seç * (Çoklu seçim yapabilirsiniz)</label>
                <input type="file" name="product_images[]" accept="image/*" multiple required>
                <small style="display:block;margin-top:0.25rem;color:#666;">💡 Max 5MB, JPG/PNG/GIF/WEBP</small>
            </div>
            <div style="margin-top: 1rem;">
                <button type="submit" name="upload_images" class="btn">✓ Yükle</button>
                <button type="button" onclick="toggleUploadMethod('none')" class="btn btn-secondary">İptal</button>
            </div>
        </form>

        <form method="POST" id="imageForm" style="display:none; margin-top:1rem;">
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
                <button type="button" onclick="toggleUploadMethod('none')" class="btn btn-secondary">İptal</button>
            </div>
        </form>
    </div>
    <?php else: ?>
    <div class="card">
        <p style="text-align: center; padding: 2rem; background: #fff3cd; border-radius: 8px; color: #856404;">⚠️ Resim eklemek için önce ürünü kaydedin.</p>
    </div>
    <?php endif; ?>
</div>

<script>
function setCategory(category) {
    document.getElementById('categoryInput').value = category;
}

function toggleUploadMethod(method) {
    const fileForm = document.getElementById('fileUploadForm');
    const urlForm = document.getElementById('imageForm');
    
    if (method === 'file') {
        fileForm.style.display = 'block';
        urlForm.style.display = 'none';
    } else if (method === 'url') {
        fileForm.style.display = 'none';
        urlForm.style.display = 'block';
    } else {
        fileForm.style.display = 'none';
        urlForm.style.display = 'none';
    }
}

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

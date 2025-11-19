<?php
session_start();
require_once '../config/database.php';

header('Content-Type: application/json');

// Admin kontrolü
if (!isset($_SESSION['admin_logged_in'])) {
    http_response_code(403);
    echo json_encode(['success' => false, 'error' => 'Yetkisiz erişim']);
    exit;
}

if (!isset($_FILES['image'])) {
    echo json_encode(['success' => false, 'error' => 'Dosya seçilmedi']);
    exit;
}

$file = $_FILES['image'];

// Dosya doğrulama
$validation = validateImageUpload($file, 10485760); // 10MB
if (!$validation['success']) {
    echo json_encode($validation);
    exit;
}

// Yükleme dizini
$uploadDir = '../uploads/vehicles/';
$thumbDir = '../uploads/vehicles/thumbs/';

// Dizinler yoksa oluştur
if (!file_exists($uploadDir)) mkdir($uploadDir, 0755, true);
if (!file_exists($thumbDir)) mkdir($thumbDir, 0755, true);

// Benzersiz dosya adı
$extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
$newName = 'vehicle_' . uniqid() . '_' . time() . '.' . $extension;
$uploadPath = $uploadDir . $newName;
$thumbPath = $thumbDir . $newName;

try {
    // Dosyayı yükle
    if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
        throw new Exception('Dosya yükleme başarısız');
    }
    
    // Thumbnail oluştur
    createThumbnail($uploadPath, $thumbPath, 400, 300);
    
    // Watermark ekle (opsiyonel)
    $watermarkPath = '../assets/watermark.png';
    if (file_exists($watermarkPath)) {
        addWatermark($uploadPath, $watermarkPath);
    }
    
    // Log kaydet
    logSecurity('data_change', $_SESSION['admin_username'], 'Image uploaded: ' . $newName);
    
    echo json_encode([
        'success' => true,
        'url' => '/uploads/vehicles/' . $newName,
        'thumb' => '/uploads/vehicles/thumbs/' . $newName,
        'filename' => $newName
    ]);
    
} catch (Exception $e) {
    // Hata durumunda dosyayı sil
    if (file_exists($uploadPath)) unlink($uploadPath);
    if (file_exists($thumbPath)) unlink($thumbPath);
    
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}

// Thumbnail oluşturma fonksiyonu
function createThumbnail($source, $dest, $maxWidth, $maxHeight) {
    list($width, $height, $type) = getimagesize($source);
    
    // Aspect ratio koru
    $ratio = $width / $height;
    if ($maxWidth / $maxHeight > $ratio) {
        $newWidth = $maxHeight * $ratio;
        $newHeight = $maxHeight;
    } else {
        $newWidth = $maxWidth;
        $newHeight = $maxWidth / $ratio;
    }
    
    // Kaynak resmi yükle
    switch ($type) {
        case IMAGETYPE_JPEG:
            $img = imagecreatefromjpeg($source);
            break;
        case IMAGETYPE_PNG:
            $img = imagecreatefrompng($source);
            break;
        case IMAGETYPE_WEBP:
            $img = imagecreatefromwebp($source);
            break;
        default:
            throw new Exception('Desteklenmeyen resim formatı');
    }
    
    // Yeni resim oluştur
    $newImg = imagecreatetruecolor($newWidth, $newHeight);
    
    // PNG için transparanlık
    if ($type == IMAGETYPE_PNG) {
        imagealphablending($newImg, false);
        imagesavealpha($newImg, true);
    }
    
    // Yeniden boyutlandır
    imagecopyresampled($newImg, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    
    // Kaydet
    switch ($type) {
        case IMAGETYPE_JPEG:
            imagejpeg($newImg, $dest, 85);
            break;
        case IMAGETYPE_PNG:
            imagepng($newImg, $dest, 8);
            break;
        case IMAGETYPE_WEBP:
            imagewebp($newImg, $dest, 85);
            break;
    }
    
    imagedestroy($img);
    imagedestroy($newImg);
}

// Watermark ekleme fonksiyonu
function addWatermark($imagePath, $watermarkPath) {
    list($imgWidth, $imgHeight, $imgType) = getimagesize($imagePath);
    
    // Ana resmi yükle
    switch ($imgType) {
        case IMAGETYPE_JPEG:
            $img = imagecreatefromjpeg($imagePath);
            break;
        case IMAGETYPE_PNG:
            $img = imagecreatefrompng($imagePath);
            break;
        case IMAGETYPE_WEBP:
            $img = imagecreatefromwebp($imagePath);
            break;
        default:
            return;
    }
    
    // Watermark'ı yükle
    $watermark = imagecreatefrompng($watermarkPath);
    $wmWidth = imagesx($watermark);
    $wmHeight = imagesy($watermark);
    
    // Watermark boyutunu ayarla (ana resmin %20'si)
    $newWmWidth = $imgWidth * 0.2;
    $newWmHeight = ($wmHeight / $wmWidth) * $newWmWidth;
    
    // Yeniden boyutlandır
    $resizedWm = imagecreatetruecolor($newWmWidth, $newWmHeight);
    imagealphablending($resizedWm, false);
    imagesavealpha($resizedWm, true);
    imagecopyresampled($resizedWm, $watermark, 0, 0, 0, 0, $newWmWidth, $newWmHeight, $wmWidth, $wmHeight);
    
    // Sağ alt köşeye yerleştir
    $x = $imgWidth - $newWmWidth - 10;
    $y = $imgHeight - $newWmHeight - 10;
    
    imagecopy($img, $resizedWm, $x, $y, 0, 0, $newWmWidth, $newWmHeight);
    
    // Kaydet
    switch ($imgType) {
        case IMAGETYPE_JPEG:
            imagejpeg($img, $imagePath, 90);
            break;
        case IMAGETYPE_PNG:
            imagepng($img, $imagePath, 8);
            break;
        case IMAGETYPE_WEBP:
            imagewebp($img, $imagePath, 90);
            break;
    }
    
    imagedestroy($img);
    imagedestroy($watermark);
    imagedestroy($resizedWm);
}
?>
<?php
session_start();
require_once '../config/database.php';

header('Content-Type: application/json');

// Giriş kontrolü
if (!isset($_SESSION['admin_logged_in'])) {
    echo json_encode(['success' => false, 'error' => 'Oturum bulunamadı']);
    exit;
}

// Dosya kontrolü
if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['success' => false, 'error' => 'Dosya yükleme hatası']);
    exit;
}

$file = $_FILES['image'];

// Güvenlik kontrolleri
$validation = validateImageUpload($file);
if (!$validation['success']) {
    echo json_encode($validation);
    exit;
}

// Dosya bilgileri
$extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
$fileName = 'vehicle_' . time() . '_' . uniqid() . '.' . $extension;

// Yükleme klasörü
$uploadDir = '../uploads/vehicles/';
$uploadPath = $uploadDir . $fileName;

// Klasör yoksa oluştur
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Dosyayı taşı
if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
    echo json_encode(['success' => false, 'error' => 'Dosya kaydedilemedi']);
    exit;
}

// Resmi küçült/optimize et (opsiyonel)
try {
    optimizeImage($uploadPath, $extension);
} catch (Exception $e) {
    // Optimize edilemezse devam et
    error_log("Image optimization failed: " . $e->getMessage());
}

// URL oluştur
$imageUrl = '/uploads/vehicles/' . $fileName;

// Başarılı yanıt
echo json_encode([
    'success' => true,
    'url' => $imageUrl,
    'filename' => $fileName
]);

// Güvenlik logu
logSecurity('data_change', $_SESSION['admin_username'], 'Vehicle image uploaded: ' . $fileName);

// Resim optimize fonksiyonu
function optimizeImage($filePath, $extension) {
    $maxWidth = 1200;
    $maxHeight = 900;
    $quality = 85;
    
    // Resim tipine göre yükle
    switch ($extension) {
        case 'jpg':
        case 'jpeg':
            $image = imagecreatefromjpeg($filePath);
            break;
        case 'png':
            $image = imagecreatefrompng($filePath);
            break;
        case 'webp':
            $image = imagecreatefromwebp($filePath);
            break;
        default:
            return;
    }
    
    if (!$image) return;
    
    // Boyutları al
    $width = imagesx($image);
    $height = imagesy($image);
    
    // Boyut kontrolü
    if ($width <= $maxWidth && $height <= $maxHeight) {
        imagedestroy($image);
        return;
    }
    
    // Yeni boyutları hesapla
    $ratio = min($maxWidth / $width, $maxHeight / $height);
    $newWidth = round($width * $ratio);
    $newHeight = round($height * $ratio);
    
    // Yeni resim oluştur
    $newImage = imagecreatetruecolor($newWidth, $newHeight);
    
    // PNG şeffaflığını koru
    if ($extension === 'png') {
        imagealphablending($newImage, false);
        imagesavealpha($newImage, true);
        $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
        imagefilledrectangle($newImage, 0, 0, $newWidth, $newHeight, $transparent);
    }
    
    // Resize
    imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    
    // Kaydet
    switch ($extension) {
        case 'jpg':
        case 'jpeg':
            imagejpeg($newImage, $filePath, $quality);
            break;
        case 'png':
            imagepng($newImage, $filePath, 8);
            break;
        case 'webp':
            imagewebp($newImage, $filePath, $quality);
            break;
    }
    
    // Bellekten temizle
    imagedestroy($image);
    imagedestroy($newImage);
}
?>

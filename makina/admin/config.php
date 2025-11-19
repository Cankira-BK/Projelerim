<?php
// Güvenlik Ayarları

// ÖNEMLİ: Bu değerleri mutlaka değiştirin!
define('ADMIN_USERNAME', 'admin');
// Şifreyi hashleme: password_hash('yeni_sifreniz', PASSWORD_DEFAULT) ile oluşturun
define('ADMIN_PASSWORD_HASH', '$2y$10$.jRaKPgA95k0XGBfGL6f/uq0IhmwkN6iKHcfVv8YXQBiCp2jMdUcy'); // "admin123"

// JSON dosya yolu
define('VEHICLES_JSON', __DIR__ . '/vehicles.json');

// Oturum ayarları
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1); // HTTPS kullanıyorsanız

// CSRF koruması için token oluştur
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// CSRF token kontrolü
function validateCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Şifre doğrulama
function verifyPassword($password) {
    return password_verify($password, ADMIN_PASSWORD_HASH);
}

// Güvenli giriş kontrolü
function checkLogin() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: login.php');
        exit;
    }
    
    // Oturum zaman aşımı kontrolü (30 dakika)
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
        session_destroy();
        header('Location: login.php?timeout=1');
        exit;
    }
    
    $_SESSION['last_activity'] = time();
}

// XSS koruması
function sanitize($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

// Araçları oku
function getVehicles() {
    if (!file_exists(VEHICLES_JSON)) {
        file_put_contents(VEHICLES_JSON, '[]');
        return [];
    }
    
    $json = file_get_contents(VEHICLES_JSON);
    return json_decode($json, true) ?: [];
}

// Araçları kaydet
function saveVehicles($vehicles) {
    $result = file_put_contents(
        VEHICLES_JSON, 
        json_encode($vehicles, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );
    
    if ($result === false) {
        throw new Exception('Araçlar kaydedilemedi. Dosya izinlerini kontrol edin.');
    }
    
    return true;
}

// Veri doğrulama
function validateVehicleData($data) {
    $errors = [];
    
    if (empty($data['title'])) {
        $errors[] = 'Araç başlığı boş olamaz';
    }
    
    if (empty($data['price'])) {
        $errors[] = 'Fiyat boş olamaz';
    }
    
    if (empty($data['year']) || !is_numeric($data['year'])) {
        $errors[] = 'Geçerli bir yıl giriniz';
    }
    
    if (empty($data['km'])) {
        $errors[] = 'Kilometre boş olamaz';
    }
    
    if (empty($data['fuel'])) {
        $errors[] = 'Yakıt tipi seçiniz';
    }
    
    if (empty($data['image']) || !filter_var($data['image'], FILTER_VALIDATE_URL)) {
        $errors[] = 'Geçerli bir resim URL\'si giriniz';
    }
    
    if (empty($data['link']) || !filter_var($data['link'], FILTER_VALIDATE_URL)) {
        $errors[] = 'Geçerli bir link giriniz';
    }
    
    return $errors;
}
?>
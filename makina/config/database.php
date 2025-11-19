<?php
// Veritabanı Yapılandırması

// XAMPP/localhost için
define('DB_HOST', 'localhost');
define('DB_NAME', 'nuyacom_makina');
define('DB_USER', 'nuyacom_makina');
define('DB_PASS', 'SNooP.,456');
define('DB_CHARSET', 'utf8mb4');

// Canlı sunucu için (değiştirin)
// define('DB_HOST', 'localhost');
// define('DB_NAME', 'sizin_veritabani_adi');
// define('DB_USER', 'sizin_kullanici_adi');
// define('DB_PASS', 'sizin_sifreniz');
// define('DB_CHARSET', 'utf8mb4');

// PDO bağlantısı
class Database {
    private static $instance = null;
    private $connection;
    
    private function __construct() {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . DB_CHARSET
        ];
        
        try {
            $this->connection = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            die("Veritabanı bağlantısı başarısız. Lütfen sistem yöneticisi ile iletişime geçin.");
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->connection;
    }
    
    // SQL Injection korumalı sorgu
    public function query($sql, $params = []) {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            error_log("Query failed: " . $e->getMessage());
            throw $e;
        }
    }
    
    // Tek satır getir
    public function fetchOne($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch();
    }
    
    // Çoklu satır getir
    public function fetchAll($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll();
    }
    
    // Insert ve son ID'yi döndür
    public function insert($sql, $params = []) {
        $this->query($sql, $params);
        return $this->connection->lastInsertId();
    }
    
    // Update/Delete ve etkilenen satır sayısı
    public function execute($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }
    
    // Transaction başlat
    public function beginTransaction() {
        return $this->connection->beginTransaction();
    }
    
    // Transaction commit
    public function commit() {
        return $this->connection->commit();
    }
    
    // Transaction rollback
    public function rollBack() {
        return $this->connection->rollBack();
    }
}

// Güvenlik fonksiyonları
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

function sanitizeArray($data) {
    return array_map('sanitize', $data);
}

// Güvenlik logu kaydet
function logSecurity($type, $username, $details = '') {
    try {
        $db = Database::getInstance();
        $sql = "INSERT INTO security_logs (log_type, username, ip_address, user_agent, details) 
                VALUES (?, ?, ?, ?, ?)";
        $db->query($sql, [
            $type,
            $username,
            $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
            $details
        ]);
    } catch (Exception $e) {
        error_log("Security log failed: " . $e->getMessage());
    }
}

// CSRF Token oluştur
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// CSRF Token doğrula
function validateCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// XSS koruması
function cleanOutput($data) {
    if (is_array($data)) {
        return array_map('cleanOutput', $data);
    }
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

// Rate limiting kontrol
function checkRateLimit($action, $limit = 5, $period = 300) {
    $key = $action . '_' . $_SERVER['REMOTE_ADDR'];
    
    if (!isset($_SESSION['rate_limit'][$key])) {
        $_SESSION['rate_limit'][$key] = [
            'count' => 1,
            'start_time' => time()
        ];
        return true;
    }
    
    $elapsed = time() - $_SESSION['rate_limit'][$key]['start_time'];
    
    if ($elapsed > $period) {
        $_SESSION['rate_limit'][$key] = [
            'count' => 1,
            'start_time' => time()
        ];
        return true;
    }
    
    if ($_SESSION['rate_limit'][$key]['count'] >= $limit) {
        return false;
    }
    
    $_SESSION['rate_limit'][$key]['count']++;
    return true;
}

// Dosya upload güvenliği
function validateImageUpload($file, $maxSize = 5242880) { // 5MB
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
    
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'error' => 'Dosya yükleme hatası'];
    }
    
    if ($file['size'] > $maxSize) {
        return ['success' => false, 'error' => 'Dosya boyutu çok büyük (max 5MB)'];
    }
    
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    if (!in_array($mimeType, $allowedTypes)) {
        return ['success' => false, 'error' => 'Geçersiz dosya tipi'];
    }
    
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, $allowedExtensions)) {
        return ['success' => false, 'error' => 'Geçersiz dosya uzantısı'];
    }
    
    return ['success' => true];
}
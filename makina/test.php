<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Test Sayfası</h1>";
echo "<p>PHP Çalışıyor: ✅</p>";

// Veritabanı testi
try {
    require_once 'config/database.php';
    echo "<p>config/database.php yüklendi: ✅</p>";
    
    $db = Database::getInstance();
    echo "<p>Database sınıfı çalıştı: ✅</p>";
    
    $conn = $db->getConnection();
    echo "<p>Bağlantı kuruldu: ✅</p>";
    
    $result = $db->fetchAll("SELECT * FROM vehicles LIMIT 1");
    echo "<p>Sorgu çalıştı: ✅</p>";
    echo "<p>Araç sayısı: " . count($result) . "</p>";
    
} catch (Exception $e) {
    echo "<p style='color:red'>HATA: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<p>Server: " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
echo "<p>PHP: " . phpversion() . "</p>";
?>
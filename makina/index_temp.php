<?php
// Makina versiyonunu yükle - index.php tam içeriği
// Bu dosya çok büyük olduğu için bakımdaki makina kodunu kullan
$makinaFile = __DIR__ . '/backup/index_makina_full.php';
if (file_exists($makinaFile)) {
    require $makinaFile;
} else {
    // Fallback - otomotiv versiyonu
    echo "<!DOCTYPE html><html><head><title>Güçlü Makina</title></head><body>";
    echo "<h1>⚠️ HATA: index.php dosyası eksik!</h1>";
    echo "<p>Lütfen <code>database.sql</code> dosyasını phpMyAdmin'de çalıştırın.</p>";
    echo "<p>Veya backup klasöründen index_makina_full.php dosyasını index.php olarak kopyalayın.</p>";
    echo "</body></html>";
}
?>

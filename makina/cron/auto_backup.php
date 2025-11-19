<?php
/**
 * Otomatik Yedekleme Sistemi
 * 
 * cPanel > Cron Jobs'a ekleyin:
 * 0 3 * * * /usr/bin/php /home/username/public_html/cron/auto_backup.php
 * (Her gün saat 03:00'te çalışır)
 */

require_once __DIR__ . '/../config/database.php';

$db = Database::getInstance();

// Yedekleme dizini
$backupDir = __DIR__ . '/../backups/';
if (!file_exists($backupDir)) {
    mkdir($backupDir, 0755, true);
}

$date = date('Y-m-d_H-i-s');
$filename = "backup_$date.sql";
$zipFilename = "backup_$date.zip";
$backupPath = $backupDir . $filename;
$zipPath = $backupDir . $zipFilename;

try {
    // 1. Veritabanı yedeği
    $command = sprintf(
        'mysqldump --user=%s --password=%s --host=%s %s > %s 2>&1',
        DB_USER,
        DB_PASS,
        DB_HOST,
        DB_NAME,
        $backupPath
    );
    
    exec($command, $output, $returnCode);
    
    if ($returnCode !== 0) {
        throw new Exception('Database backup failed: ' . implode("\n", $output));
    }
    
    // 2. Dosya boyutunu al
    $backupSize = filesize($backupPath);
    
    if ($backupSize < 1000) { // 1KB'dan küçükse hata
        throw new Exception('Backup file too small, probably failed');
    }
    
    // 3. ZIP'le
    $zip = new ZipArchive();
    if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
        $zip->addFile($backupPath, $filename);
        
        // Önemli dosyaları da ekle
        $filesToBackup = [
            '../config/database.php' => 'config/database.php',
            '../.htaccess' => '.htaccess',
        ];
        
        foreach ($filesToBackup as $file => $zipPath) {
            if (file_exists(__DIR__ . '/' . $file)) {
                $zip->addFile(__DIR__ . '/' . $file, $zipPath);
            }
        }
        
        $zip->close();
        
        // SQL dosyasını sil, sadece ZIP'i tut
        unlink($backupPath);
        
        $finalSize = filesize($zipPath);
    } else {
        throw new Exception('Failed to create ZIP file');
    }
    
    // 4. Veritabanına kaydet
    $db->execute(
        "INSERT INTO backup_logs (backup_file, backup_size, backup_type, status) VALUES (?, ?, 'automatic', 'success')",
        [$zipFilename, $finalSize]
    );
    
    // 5. Eski yedekleri temizle (30 günden eski)
    $files = glob($backupDir . 'backup_*.zip');
    $now = time();
    $deleteCount = 0;
    
    foreach ($files as $file) {
        if (is_file($file)) {
            if ($now - filemtime($file) >= 60 * 60 * 24 * 30) { // 30 gün
                unlink($file);
                $deleteCount++;
            }
        }
    }
    
    // 6. Başarı mesajı
    $message = "Backup completed successfully!\n";
    $message .= "File: $zipFilename\n";
    $message .= "Size: " . number_format($finalSize / 1024 / 1024, 2) . " MB\n";
    $message .= "Old backups deleted: $deleteCount\n";
    
    echo $message;
    error_log($message);
    
    // 7. (Opsiyonel) Email bildirimi gönder
    /*
    $adminEmail = $db->fetchOne("SELECT setting_value FROM settings WHERE setting_key = 'admin_email'")['setting_value'] ?? null;
    if ($adminEmail) {
        mail($adminEmail, 'Yedekleme Başarılı', $message);
    }
    */
    
} catch (Exception $e) {
    // Hata durumu
    $errorMessage = $e->getMessage();
    
    // Veritabanına kaydet
    try {
        $db->execute(
            "INSERT INTO backup_logs (backup_file, backup_type, status, error_message) VALUES (?, 'automatic', 'failed', ?)",
            [$filename, $errorMessage]
        );
    } catch (Exception $dbError) {
        error_log("Failed to log backup error: " . $dbError->getMessage());
    }
    
    // Hata logu
    error_log("Backup failed: " . $errorMessage);
    echo "Backup failed: " . $errorMessage . "\n";
    
    // (Opsiyonel) Hata emaili gönder
    /*
    $adminEmail = $db->fetchOne("SELECT setting_value FROM settings WHERE setting_key = 'admin_email'")['setting_value'] ?? null;
    if ($adminEmail) {
        mail($adminEmail, 'Yedekleme HATASI!', "Yedekleme başarısız oldu:\n\n" . $errorMessage);
    }
    */
}

// Manuel çalıştırma için rapor
if (php_sapi_name() === 'cli') {
    echo "\n=== Backup Report ===\n";
    echo "Date: " . date('Y-m-d H:i:s') . "\n";
    echo "Status: " . (isset($finalSize) ? 'SUCCESS' : 'FAILED') . "\n";
    if (isset($finalSize)) {
        echo "File: $zipFilename\n";
        echo "Size: " . number_format($finalSize / 1024 / 1024, 2) . " MB\n";
    }
    echo "====================\n";
}
?>
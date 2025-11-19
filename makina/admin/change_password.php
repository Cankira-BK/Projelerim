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

if (isset($_POST['change_password'])) {
    $currentPassword = $_POST['current_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    
    // Doğrulama
    if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
        $error = 'Tüm alanları doldurun!';
    } elseif ($newPassword !== $confirmPassword) {
        $error = 'Yeni şifreler eşleşmiyor!';
    } elseif (strlen($newPassword) < 8) {
        $error = 'Yeni şifre en az 8 karakter olmalı!';
    } else {
        // Mevcut şifreyi kontrol et
        $admin = $db->fetchOne(
            "SELECT * FROM admins WHERE username = ?",
            [$_SESSION['admin_username']]
        );
        
        if ($admin && password_verify($currentPassword, $admin['password_hash'])) {
            // Yeni şifreyi hashle ve güncelle
            $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $db->execute(
                "UPDATE admins SET password_hash = ? WHERE username = ?",
                [$newHash, $_SESSION['admin_username']]
            );
            
            logSecurity('data_change', $_SESSION['admin_username'], 'Password changed');
            $message = 'Şifreniz başarıyla değiştirildi!';
        } else {
            $error = 'Mevcut şifre hatalı!';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şifre Değiştir - Admin Panel</title>
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
    <div class="header">
        <h1>🔑 Şifre Değiştir</h1>
        <div class="header-right">
            <a href="settings.php" class="btn btn-small">← Ayarlara Dön</a>
        </div>
    </div>

    <div class="container">
        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <div class="card" style="max-width: 600px; margin: 0 auto;">
            <h2>Şifre Değiştirme</h2>
            <form method="POST">
                <div class="form-group">
                    <label>Mevcut Şifre *</label>
                    <input type="password" name="current_password" required autocomplete="current-password">
                </div>
                
                <div class="form-group">
                    <label>Yeni Şifre *</label>
                    <input type="password" name="new_password" required autocomplete="new-password" minlength="8">
                    <small style="color: #666;">En az 8 karakter olmalı</small>
                </div>
                
                <div class="form-group">
                    <label>Yeni Şifre (Tekrar) *</label>
                    <input type="password" name="confirm_password" required autocomplete="new-password" minlength="8">
                </div>
                
                <button type="submit" name="change_password" class="btn">🔒 Şifreyi Değiştir</button>
            </form>

            <div style="margin-top: 2rem; padding: 1rem; background: #e7f3ff; border-radius: 8px;">
                <h4 style="margin-bottom: 0.5rem;">💡 Güçlü Şifre Önerileri:</h4>
                <ul style="margin: 0; padding-left: 1.5rem;">
                    <li>En az 8 karakter kullanın</li>
                    <li>Büyük ve küçük harf karışımı</li>
                    <li>Sayılar ve özel karakterler ekleyin</li>
                    <li>Kolay tahmin edilebilir şifreler kullanmayın</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
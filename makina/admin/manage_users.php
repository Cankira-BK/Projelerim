<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Sadece admin rolü kullanıcı yönetebilir
$currentUser = $_SESSION['admin_username'];
$currentUserData = null;
try {
    $db = Database::getInstance();
    $currentUserData = $db->fetchOne("SELECT * FROM admins WHERE username = ?", [$currentUser]);
    if (!$currentUserData || $currentUserData['role'] !== 'admin') {
        die('Bu sayfaya erişim yetkiniz yok!');
    }
} catch (Exception $e) {
    die("Hata: " . $e->getMessage());
}

$message = '';
$error = '';

// Kullanıcı Ekleme
if (isset($_POST['add_user'])) {
    try {
        $username = sanitize($_POST['username']);
        $password = $_POST['password'];
        $email = sanitize($_POST['email']);
        $fullName = sanitize($_POST['full_name']);
        $role = $_POST['role'];
        
        // Kullanıcı adı kontrolü
        $exists = $db->fetchOne("SELECT id FROM admins WHERE username = ?", [$username]);
        if ($exists) {
            throw new Exception('Bu kullanıcı adı zaten kullanılıyor!');
        }
        
        // Şifre hash
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO admins (username, password_hash, email, full_name, role, is_active) VALUES (?, ?, ?, ?, ?, 1)";
        $db->insert($sql, [$username, $passwordHash, $email, $fullName, $role]);
        
        logSecurity('data_change', $_SESSION['admin_username'], 'New user added: ' . $username);
        header('Location: manage_users.php?msg=user_added');
        exit;
    } catch (Exception $e) {
        $error = 'Kullanıcı ekleme hatası: ' . $e->getMessage();
    }
}

// Kullanıcı Güncelleme
if (isset($_POST['update_user'])) {
    try {
        $userId = (int)$_POST['user_id'];
        $username = sanitize($_POST['username']);
        $email = sanitize($_POST['email']);
        $fullName = sanitize($_POST['full_name']);
        $role = $_POST['role'];
        $isActive = isset($_POST['is_active']) ? 1 : 0;
        
        // Kendi rolünü düşüremez
        if ($userId == $currentUserData['id'] && $role !== 'admin') {
            throw new Exception('Kendi admin rolünüzü değiştiremezsiniz!');
        }
        
        $sql = "UPDATE admins SET username=?, email=?, full_name=?, role=?, is_active=?, updated_at=NOW() WHERE id=?";
        $db->execute($sql, [$username, $email, $fullName, $role, $isActive, $userId]);
        
        // Şifre değiştirilecekse
        if (!empty($_POST['new_password'])) {
            $passwordHash = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
            $db->execute("UPDATE admins SET password_hash=? WHERE id=?", [$passwordHash, $userId]);
        }
        
        logSecurity('data_change', $_SESSION['admin_username'], 'User updated: ' . $username);
        header('Location: manage_users.php?msg=user_updated');
        exit;
    } catch (Exception $e) {
        $error = 'Kullanıcı güncelleme hatası: ' . $e->getMessage();
    }
}

// Kullanıcı Silme
if (isset($_GET['delete'])) {
    try {
        $userId = (int)$_GET['delete'];
        
        // Kendini silemez
        if ($userId == $currentUserData['id']) {
            throw new Exception('Kendi hesabınızı silemezsiniz!');
        }
        
        // Kullanıcı bilgisini al
        $user = $db->fetchOne("SELECT username FROM admins WHERE id = ?", [$userId]);
        
        $db->execute("DELETE FROM admins WHERE id = ?", [$userId]);
        
        logSecurity('data_change', $_SESSION['admin_username'], 'User deleted: ' . $user['username']);
        header('Location: manage_users.php?msg=user_deleted');
        exit;
    } catch (Exception $e) {
        $error = 'Kullanıcı silme hatası: ' . $e->getMessage();
    }
}

// Aktif/Pasif Değiştirme
if (isset($_GET['toggle_status'])) {
    try {
        $userId = (int)$_GET['toggle_status'];
        
        if ($userId == $currentUserData['id']) {
            throw new Exception('Kendi hesabınızı pasif yapamazsınız!');
        }
        
        $db->execute("UPDATE admins SET is_active = NOT is_active WHERE id = ?", [$userId]);
        header('Location: manage_users.php?msg=status_changed');
        exit;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

// Mesajlar
if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'user_added': $message = 'Kullanıcı başarıyla eklendi!'; break;
        case 'user_updated': $message = 'Kullanıcı güncellendi!'; break;
        case 'user_deleted': $message = 'Kullanıcı silindi!'; break;
        case 'status_changed': $message = 'Kullanıcı durumu değiştirildi!'; break;
    }
}

// Tüm kullanıcıları getir
$users = $db->fetchAll("SELECT * FROM admins ORDER BY created_at DESC");

// Düzenlenecek kullanıcı
$editUser = null;
if (isset($_GET['edit'])) {
    $editUser = $db->fetchOne("SELECT * FROM admins WHERE id = ?", [(int)$_GET['edit']]);
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Yönetimi - Admin Panel</title>
    <link rel="stylesheet" href="admin-style.css">
    <style>
        .user-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .user-card.inactive {
            opacity: 0.6;
            background: #f5f5f5;
        }
        .user-info {
            flex: 1;
        }
        .user-info h3 {
            margin: 0 0 0.5rem 0;
            color: #2c3e50;
        }
        .user-meta {
            display: flex;
            gap: 1rem;
            font-size: 0.9rem;
            color: #666;
            flex-wrap: wrap;
        }
        .user-actions {
            display: flex;
            gap: 0.5rem;
        }
        .role-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.85rem;
            font-weight: bold;
        }
        .role-admin {
            background: #667eea;
            color: white;
        }
        .role-moderator {
            background: #ffc107;
            color: #000;
        }
        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.85rem;
            font-weight: bold;
        }
        .status-active {
            background: #28a745;
            color: white;
        }
        .status-inactive {
            background: #dc3545;
            color: white;
        }
        .password-strength {
            height: 5px;
            background: #e0e0e0;
            border-radius: 3px;
            margin-top: 0.5rem;
            overflow: hidden;
        }
        .password-strength-bar {
            height: 100%;
            transition: all 0.3s;
        }
        .strength-weak { background: #dc3545; width: 33%; }
        .strength-medium { background: #ffc107; width: 66%; }
        .strength-strong { background: #28a745; width: 100%; }
    </style>
</head>
<body>
    <div class="header">
        <h1>👥 Kullanıcı Yönetimi</h1>
        <div class="header-right">
            <a href="index.php" class="btn btn-small">← Geri Dön</a>
        </div>
    </div>

    <div class="container">
        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <!-- Kullanıcı Ekleme/Düzenleme Formu -->
        <div class="card">
            <h2><?php echo $editUser ? '✏️ Kullanıcı Düzenle' : '➕ Yeni Kullanıcı Ekle'; ?></h2>
            <form method="POST">
                <?php if ($editUser): ?>
                    <input type="hidden" name="user_id" value="<?php echo $editUser['id']; ?>">
                <?php endif; ?>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label>Kullanıcı Adı *</label>
                        <input type="text" name="username" value="<?php echo $editUser ? htmlspecialchars($editUser['username']) : ''; ?>" required minlength="3" maxlength="50" placeholder="admin, moderator, vb.">
                    </div>
                    
                    <div class="form-group">
                        <label>E-posta</label>
                        <input type="email" name="email" value="<?php echo $editUser ? htmlspecialchars($editUser['email']) : ''; ?>" placeholder="ornek@firma.com">
                    </div>
                    
                    <div class="form-group">
                        <label>Tam Ad</label>
                        <input type="text" name="full_name" value="<?php echo $editUser ? htmlspecialchars($editUser['full_name']) : ''; ?>" placeholder="Ahmet Yılmaz">
                    </div>
                    
                    <div class="form-group">
                        <label>Rol *</label>
                        <select name="role" required <?php echo ($editUser && $editUser['id'] == $currentUserData['id']) ? 'disabled' : ''; ?>>
                            <option value="admin" <?php echo ($editUser && $editUser['role'] == 'admin') ? 'selected' : ''; ?>>Admin (Tam Yetki)</option>
                            <option value="moderator" <?php echo ($editUser && $editUser['role'] == 'moderator') ? 'selected' : ''; ?>>Moderator (Sınırlı Yetki)</option>
                        </select>
                        <?php if ($editUser && $editUser['id'] == $currentUserData['id']): ?>
                            <small style="color: #999;">Kendi rolünüzü değiştiremezsiniz</small>
                        <?php endif; ?>
                    </div>
                    
                    <?php if (!$editUser): ?>
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label>Şifre *</label>
                        <input type="password" name="password" id="password" required minlength="6" placeholder="En az 6 karakter" oninput="checkPasswordStrength(this.value)">
                        <div class="password-strength">
                            <div id="strength-bar" class="password-strength-bar"></div>
                        </div>
                        <small id="strength-text" style="color: #999; display: block; margin-top: 0.25rem;"></small>
                    </div>
                    <?php else: ?>
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label>Yeni Şifre (Boş bırakılırsa değişmez)</label>
                        <input type="password" name="new_password" id="new_password" minlength="6" placeholder="Şifre değiştirmek için doldurun" oninput="checkPasswordStrength(this.value)">
                        <div class="password-strength">
                            <div id="strength-bar" class="password-strength-bar"></div>
                        </div>
                        <small id="strength-text" style="color: #999; display: block; margin-top: 0.25rem;"></small>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($editUser): ?>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="is_active" value="1" <?php echo $editUser['is_active'] ? 'checked' : ''; ?> <?php echo ($editUser['id'] == $currentUserData['id']) ? 'disabled' : ''; ?>>
                            Aktif
                        </label>
                        <?php if ($editUser['id'] == $currentUserData['id']): ?>
                            <small style="color: #999; display: block;">Kendi hesabınızı pasif yapamazsınız</small>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
                
                <div style="margin-top: 1.5rem; display: flex; gap: 1rem;">
                    <button type="submit" name="<?php echo $editUser ? 'update_user' : 'add_user'; ?>" class="btn">
                        <?php echo $editUser ? '✓ Güncelle' : '+ Kullanıcı Ekle'; ?>
                    </button>
                    <?php if ($editUser): ?>
                        <a href="manage_users.php" class="btn btn-secondary">İptal</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <!-- Kullanıcı Listesi -->
        <div class="card">
            <h2>📋 Kullanıcı Listesi (<?php echo count($users); ?>)</h2>
            
            <?php foreach ($users as $user): ?>
                <div class="user-card <?php echo !$user['is_active'] ? 'inactive' : ''; ?>">
                    <div class="user-info">
                        <h3>
                            <?php echo htmlspecialchars($user['full_name'] ?: $user['username']); ?>
                            <?php if ($user['id'] == $currentUserData['id']): ?>
                                <span class="badge" style="background: #17a2b8; color: white;">Siz</span>
                            <?php endif; ?>
                        </h3>
                        <div class="user-meta">
                            <span>👤 <?php echo htmlspecialchars($user['username']); ?></span>
                            <?php if ($user['email']): ?>
                                <span>✉️ <?php echo htmlspecialchars($user['email']); ?></span>
                            <?php endif; ?>
                            <span class="role-badge role-<?php echo $user['role']; ?>">
                                <?php echo $user['role'] == 'admin' ? '👑 Admin' : '🛡️ Moderator'; ?>
                            </span>
                            <span class="status-badge status-<?php echo $user['is_active'] ? 'active' : 'inactive'; ?>">
                                <?php echo $user['is_active'] ? '✓ Aktif' : '✗ Pasif'; ?>
                            </span>
                            <?php if ($user['last_login']): ?>
                                <span>🕐 Son giriş: <?php echo date('d.m.Y H:i', strtotime($user['last_login'])); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="user-actions">
                        <a href="?edit=<?php echo $user['id']; ?>" class="btn btn-small">✏️ Düzenle</a>
                        <?php if ($user['id'] != $currentUserData['id']): ?>
                            <a href="?toggle_status=<?php echo $user['id']; ?>" class="btn btn-small" style="background: <?php echo $user['is_active'] ? '#ffc107' : '#28a745'; ?>;" onclick="return confirm('Kullanıcı durumunu değiştirmek istediğinizden emin misiniz?')">
                                <?php echo $user['is_active'] ? '⏸️ Pasif Yap' : '▶️ Aktif Yap'; ?>
                            </a>
                            <a href="?delete=<?php echo $user['id']; ?>" class="btn btn-small btn-danger" onclick="return confirm('Bu kullanıcıyı silmek istediğinizden emin misiniz?')">
                                🗑️ Sil
                            </a>
                        <?php else: ?>
                            <span class="btn btn-small" style="background: #ccc; cursor: not-allowed;" title="Kendinizi silemezsiniz">🔒 Korumalı</span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        function checkPasswordStrength(password) {
            const bar = document.getElementById('strength-bar');
            const text = document.getElementById('strength-text');
            
            if (!password) {
                bar.className = 'password-strength-bar';
                text.textContent = '';
                return;
            }
            
            let strength = 0;
            if (password.length >= 6) strength++;
            if (password.length >= 10) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/\d/.test(password)) strength++;
            if (/[^a-zA-Z\d]/.test(password)) strength++;
            
            if (strength <= 2) {
                bar.className = 'password-strength-bar strength-weak';
                text.textContent = '⚠️ Zayıf şifre';
                text.style.color = '#dc3545';
            } else if (strength <= 3) {
                bar.className = 'password-strength-bar strength-medium';
                text.textContent = '⚡ Orta seviye şifre';
                text.style.color = '#ffc107';
            } else {
                bar.className = 'password-strength-bar strength-strong';
                text.textContent = '✓ Güçlü şifre';
                text.style.color = '#28a745';
            }
        }
    </script>
</body>
</html>
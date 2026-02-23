<?php
session_name('NUYA2ADMIN');
session_start();
define('ADMIN_DIR', __DIR__);
define('SITE_ROOT', dirname(__DIR__));
define('PANEL_URL', '/admin/');
define('PANEL_TITLE', 'NUYA2 Admin Panel');
define('PANEL_TIMEOUT', 1800);
define('PANEL_MAX_ATTEMPTS', 5);
define('PANEL_LOCKOUT', 900);
define('PANEL_DATA_DIR', __DIR__ . '/data');
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/store.php';
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/layout.php';

session_boot(); require_login();
$success = $error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();
    $cur  = $_POST['current_password'] ?? '';
    $new  = $_POST['new_password']     ?? '';
    $con  = $_POST['confirm_password'] ?? '';
    $user = Store::userFind($_SESSION['admin_user']);
    if (!password_verify($cur, $user['password'])) { $error = 'Mevcut şifre hatalı.'; }
    elseif (strlen($new) < 8) { $error = 'Yeni şifre en az 8 karakter olmalı.'; }
    elseif ($new !== $con)    { $error = 'Şifreler eşleşmiyor.'; }
    else {
        Store::userUpdatePass($_SESSION['admin_user'], password_hash($new, PASSWORD_BCRYPT, ['cost'=>12]));
        $success = 'Şifre güncellendi.';
    }
}
layout_head('Şifre Değiştir'); layout_nav();
layout_page_title('🔑', 'Şifre Değiştir', 'Hesap güvenliğini güncelle');
?>
<?php if ($success): ?><div class="alert alert-ok">✓ <?= $success ?></div><?php endif; ?>
<?php if ($error):   ?><div class="alert alert-err">⚠ <?= htmlspecialchars($error) ?></div><?php endif; ?>
<div class="card" style="max-width:400px">
  <div class="card-title">🔒 Şifre Güncelle</div>
  <form method="post">
    <?= csrf_field() ?>
    <div class="fg"><label>Mevcut Şifre</label><input type="password" name="current_password" required></div>
    <div class="divider"></div>
    <div class="fg"><label>Yeni Şifre (min 8 karakter)</label><input type="password" name="new_password" required></div>
    <div class="fg"><label>Yeni Şifre (tekrar)</label><input type="password" name="confirm_password" required></div>
    <button class="btn btn-primary">🔄 Güncelle</button>
  </form>
</div>
<?php layout_foot(); ?>

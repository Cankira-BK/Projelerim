<?php
define('ADMIN_DIR', __DIR__);
define('SITE_ROOT', dirname(__DIR__));
$scriptPath = $_SERVER['SCRIPT_NAME'] ?? '/admin/index.php';
define('PANEL_URL', rtrim(dirname($scriptPath), '/') . '/');
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/store.php';
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/layout.php';

session_boot();
if (is_logged_in()) { header('Location: ' . PANEL_URL . 'dashboard.php'); exit; }

$error = ''; $locked = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();
    $u = trim($_POST['username'] ?? '');
    $p = $_POST['password'] ?? '';
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    if (is_locked($ip)) {
        $locked = true; $error = 'Çok fazla hatalı giriş. 15 dakika bekleyin.';
    } elseif (!$u || !$p) {
        $error = 'Kullanıcı adı ve şifre boş bırakılamaz.';
    } elseif (!attempt_login($u, $p)) {
        $error = is_locked($ip) ? 'Hesap 15 dakika kilitlendi.' : 'Kullanıcı adı veya şifre hatalı.';
    } else {
        header('Location: ' . PANEL_URL . 'dashboard.php'); exit;
    }
}

layout_head('Giriş');
?>
<div class="login-wrap">
  <div class="login-box">
    <div class="login-logo">
      <div class="login-logo-name">NUYA2</div>
      <div class="login-logo-sub">Yönetim Paneli</div>
    </div>
    <div class="login-hr"><span>Giriş</span></div>
    <?php if ($error): ?>
      <div class="alert alert-err">⚠ <?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post" autocomplete="off">
      <?= csrf_field() ?>
      <div class="fg">
        <label>Kullanıcı Adı</label>
        <input type="text" name="username" required autofocus value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
      </div>
      <div class="fg">
        <label>Şifre</label>
        <input type="password" name="password" required>
      </div>
      <button class="btn btn-primary" style="width:100%;justify-content:center;margin-top:.3rem" <?= $locked?'disabled':'' ?>>
        Giriş Yap
      </button>
    </form>
  </div>
</div>
<?php layout_foot(); ?>

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

require_once __DIR__ . '/includes/store.php';
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/layout.php';

// Zaten giriş yaptıysa dashboard'a git
if (!empty($_SESSION['admin_id'])) {
    header('Location: /admin/dashboard.php'); exit;
}

$error = ''; $locked = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();
    $u  = trim($_POST['username'] ?? '');
    $p  = $_POST['password'] ?? '';
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';

    if (Store::attemptsCount($ip) >= PANEL_MAX_ATTEMPTS) {
        $locked = true; $error = 'Çok fazla hatalı giriş. 15 dakika bekleyin.';
    } elseif (!$u || !$p) {
        $error = 'Kullanıcı adı ve şifre boş bırakılamaz.';
    } elseif (!attempt_login($u, $p)) {
        $error = Store::attemptsCount($ip) >= PANEL_MAX_ATTEMPTS
            ? 'Hesap 15 dakika kilitlendi.'
            : 'Kullanıcı adı veya şifre hatalı.';
    } else {
        header('Location: /admin/dashboard.php'); exit;
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
        <input type="text" name="username" required autofocus
               value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
      </div>
      <div class="fg">
        <label>Şifre</label>
        <input type="password" name="password" required>
      </div>
      <button class="btn btn-primary"
              style="width:100%;justify-content:center;margin-top:.3rem"
              <?= $locked ? 'disabled' : '' ?>>
        Giriş Yap
      </button>
    </form>
  </div>
</div>
<?php layout_foot(); ?>
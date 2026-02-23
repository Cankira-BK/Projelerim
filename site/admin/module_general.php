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
    $title = trim($_POST['site_title'] ?? '');
    if (!$title) { $error = 'Site başlığı boş olamaz.'; }
    else {
        setting_set('site_title', $title);
        setting_set('maintenance_mode', isset($_POST['maintenance_mode']) ? '1' : '0');
        $success = 'Ayarlar kaydedildi.';
    }
}
layout_head('Genel Ayarlar'); layout_nav();
layout_page_title('⚙', 'Genel Ayarlar', 'Site geneli konfigürasyon');
?>
<?php if ($success): ?><div class="alert alert-ok">✓ <?= $success ?></div><?php endif; ?>
<?php if ($error):   ?><div class="alert alert-err">⚠ <?= htmlspecialchars($error) ?></div><?php endif; ?>
<div class="card" style="max-width:500px">
  <div class="card-title">🌐 Site Ayarları</div>
  <form method="post">
    <?= csrf_field() ?>
    <div class="fg">
      <label>Site Başlığı</label>
      <input type="text" name="site_title" value="<?= htmlspecialchars(setting_get('site_title','NUYA2')) ?>">
    </div>
    <div class="divider"></div>
    <div class="fg">
      <label style="display:flex;align-items:center;gap:.4rem;cursor:pointer;text-transform:none;letter-spacing:0;font-size:.88rem">
        <input type="checkbox" name="maintenance_mode" value="1" <?= setting_get('maintenance_mode')==='1'?'checked':'' ?>>
        Bakım Modu
        <?php if(setting_get('maintenance_mode')==='1'): ?>
        <span style="font-size:.65rem;background:rgba(192,57,43,.2);color:#f08080;padding:.1rem .4rem;border-radius:3px;border:1px solid rgba(192,57,43,.3)">AKTİF</span>
        <?php endif; ?>
      </label>
    </div>
    <button class="btn btn-primary">💾 Kaydet</button>
  </form>
</div>
<?php layout_foot(); ?>

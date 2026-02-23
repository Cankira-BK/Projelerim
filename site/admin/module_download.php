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
    $fields = ['client_download_url','client_download_url_2','client_download_url_3','client_download_url_4'];
    foreach ($fields as $k) {
        $v = trim($_POST[$k] ?? '');
        if ($v !== '' && !filter_var($v, FILTER_VALIDATE_URL)) { $error = "Geçersiz URL: ".htmlspecialchars($v); break; }
    }
    if (!$error) { foreach ($fields as $k) setting_set($k, trim($_POST[$k] ?? '')); $success = 'İndirme linkleri güncellendi.'; }
}

$mirrors = [
    ['key'=>'client_download_url',  'label'=>'Mirror 1', 'hint'=>'Mega.nz'],
    ['key'=>'client_download_url_2','label'=>'Mirror 2', 'hint'=>'Google Drive'],
    ['key'=>'client_download_url_3','label'=>'Mirror 3', 'hint'=>'Dosya.co'],
    ['key'=>'client_download_url_4','label'=>'Mirror 4', 'hint'=>'Yedek'],
];

layout_head('İndirme Linkleri'); layout_nav();
layout_page_title('⬇', 'İndirme Linkleri', 'Client mirror URL\'lerini yönet');
?>
<?php if ($success): ?><div class="alert alert-ok">✓ <?= $success ?></div><?php endif; ?>
<?php if ($error):   ?><div class="alert alert-err">⚠ <?= $error ?></div><?php endif; ?>
<div class="card">
  <div class="card-title">🔗 Mirror Linkleri</div>
  <p style="color:var(--t3);font-size:.82rem;margin-bottom:1.2rem">Boş bırakılan mirror gösterilmez. Kaydet → sitede anında yansır.</p>
  <form method="post">
    <?= csrf_field() ?>
    <?php foreach ($mirrors as $m): ?>
    <div class="fg">
      <label><?= $m['label'] ?> <span style="color:var(--t3);font-weight:400;text-transform:none;letter-spacing:0">— <?= $m['hint'] ?></span></label>
      <input type="url" name="<?= $m['key'] ?>" value="<?= htmlspecialchars(setting_get($m['key'])) ?>" placeholder="https://...">
    </div>
    <?php endforeach; ?>
    <button class="btn btn-primary" style="margin-top:.4rem">💾 Kaydet</button>
  </form>
</div>
<div class="card">
  <div class="card-title">👁 Aktif Linkler</div>
  <?php $has=false; foreach($mirrors as $i=>$m): $url=setting_get($m['key']); if(!$url) continue; $has=true; ?>
  <div style="margin-bottom:.8rem">
    <div style="font-size:.7rem;color:var(--t3);letter-spacing:.08em;text-transform:uppercase;margin-bottom:3px"><?= $m['hint'] ?></div>
    <div style="background:var(--bg1);border:1px solid var(--bdr);border-radius:5px;padding:.5rem .7rem;font-size:.78rem;color:var(--goldD);word-break:break-all;font-family:monospace"><?= htmlspecialchars($url) ?></div>
  </div>
  <?php endforeach; if(!$has): ?><p style="color:var(--t3);font-size:.84rem">Henüz aktif link yok.</p><?php endif; ?>
</div>
<?php layout_foot(); ?>

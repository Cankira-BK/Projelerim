<?php
function layout_head(string $title = 'Admin'): void { ?>
<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= htmlspecialchars($title) ?> · <?= PANEL_TITLE ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Rajdhani:wght@400;500;600;700&display=swap">
<link rel="stylesheet" href="<?= PANEL_URL ?>assets/css/admin.css">
</head>
<body>
<?php }

function layout_nav(): void {
    $user    = $_SESSION['admin_user'] ?? 'A';
    $initial = strtoupper(substr($user, 0, 1));
    $current = basename($_SERVER['PHP_SELF'], '.php');
    $nav = [
        ['f'=>'dashboard',       'i'=>'⚔',  'l'=>'Dashboard'],
        ['f'=>'module_download', 'i'=>'⬇',  'l'=>'İndirme Linkleri'],
        ['f'=>'module_general',  'i'=>'⚙',  'l'=>'Genel Ayarlar'],
        ['f'=>'module_password', 'i'=>'🔑', 'l'=>'Şifre Değiştir'],
    ];
    ?>
<nav class="sidebar">
  <div class="sb-brand">
    <span class="sb-title">NUYA2</span>
    <span class="sb-sub">Admin Panel</span>
  </div>
  <div class="sb-nav">
    <div class="sb-section">Yönetim</div>
    <?php foreach ($nav as $n): ?>
    <a href="<?= PANEL_URL . $n['f'] ?>.php" class="nav-link <?= $current===$n['f']?'active':'' ?>">
      <span class="nav-ic"><?= $n['i'] ?></span><?= $n['l'] ?>
    </a>
    <?php endforeach; ?>
  </div>
  <div class="sb-foot">
    <div class="sb-user">
      <div class="sb-avatar"><?= htmlspecialchars($initial) ?></div>
      <span class="sb-uname"><?= htmlspecialchars($user) ?></span>
    </div>
    <a href="<?= PANEL_URL ?>logout.php" class="btn-logout">Çıkış</a>
  </div>
</nav>
<main class="main-content">
<?php }

function layout_page_title(string $icon, string $title, string $sub = ''): void { ?>
<div class="page-hdr">
  <div class="page-hdr-icon"><?= $icon ?></div>
  <div>
    <div class="page-title"><?= htmlspecialchars($title) ?></div>
    <?php if ($sub): ?><div class="page-sub"><?= htmlspecialchars($sub) ?></div><?php endif; ?>
  </div>
</div>
<?php }

function layout_foot(): void { ?>
</main>
</body>
</html>
<?php }

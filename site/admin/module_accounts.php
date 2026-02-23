<?php
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
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/layout.php';

session_boot(); require_login();

DB::connect();
$conn = DB::get();

$success = $error = '';

// ── Ban / Unban işlemi ────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();
    $action  = $_POST['action'] ?? '';
    $login   = $conn->real_escape_string($_POST['login'] ?? '');

    if ($action === 'ban') {
        $conn->select_db(DB_ACCOUNT);
        $conn->query("UPDATE account SET status='BLOCK' WHERE login='$login'");
        $success = "$login hesabı banlandı.";
    } elseif ($action === 'unban') {
        $conn->select_db(DB_ACCOUNT);
        $conn->query("UPDATE account SET status='OK' WHERE login='$login'");
        $success = "$login hesabının banı kaldırıldı.";
    } elseif ($action === 'change_password') {
        $newPass = $conn->real_escape_string($_POST['new_password'] ?? '');
        if (strlen($newPass) < 4) {
            $error = 'Şifre en az 4 karakter olmalı.';
        } else {
            $conn->select_db(DB_ACCOUNT);
            $conn->query("UPDATE account SET password=PASSWORD('$newPass') WHERE login='$login'");
            $success = "$login şifresi değiştirildi.";
        }
    }
}

// ── Arama & Sayfalama ─────────────────────────────────────────
$search  = trim($_GET['q'] ?? '');
$page    = max(1, (int)($_GET['page'] ?? 1));
$perPage = 20;
$offset  = ($page - 1) * $perPage;

$conn->select_db(DB_ACCOUNT);

$where = '';
if ($search !== '') {
    $s     = $conn->real_escape_string($search);
    $where = "WHERE login LIKE '%$s%' OR email LIKE '%$s%' OR real_name LIKE '%$s%'";
}

$totalR = $conn->query("SELECT COUNT(*) FROM account $where");
$total  = $totalR ? (int)$totalR->fetch_row()[0] : 0;
$pages  = max(1, ceil($total / $perPage));

$accounts = [];
$r = $conn->query("SELECT id, login, real_name, email, status, coins, create_time, last_play
                   FROM account $where
                   ORDER BY id DESC
                   LIMIT $perPage OFFSET $offset");
if ($r) $accounts = $r->fetch_all(MYSQLI_ASSOC);

function jobName(int $j): string {
    return [0=>'Savaşçı♂',1=>'Sura♂',2=>'Şaman♂',3=>'Ninja♂',
            4=>'Savaşçı♀',5=>'Sura♀',6=>'Şaman♀',7=>'Ninja♀'][$j] ?? "Job$j";
}

layout_head('Hesaplar'); layout_nav();
layout_page_title('👥', 'Hesap Yönetimi', 'Tüm kullanıcı hesapları');
?>

<?php if ($success): ?><div class="alert alert-ok">✓ <?= htmlspecialchars($success) ?></div><?php endif; ?>
<?php if ($error):   ?><div class="alert alert-err">⚠ <?= htmlspecialchars($error) ?></div><?php endif; ?>

<!-- Arama -->
<div class="card" style="margin-bottom:1rem;padding:1rem 1.4rem">
  <form method="get" style="display:flex;gap:.7rem;align-items:center">
    <input type="text" name="q" value="<?= htmlspecialchars($search) ?>"
           placeholder="Login, e-posta veya isim ara..."
           style="flex:1;padding:.55rem .8rem;background:var(--bg1);border:1px solid var(--bdr);border-radius:var(--r);color:var(--t1);font-family:Rajdhani,sans-serif;font-size:.95rem">
    <button class="btn btn-primary" type="submit">🔍 Ara</button>
    <?php if ($search): ?>
    <a href="module_accounts.php" class="btn" style="background:var(--bg3);color:var(--t2);border:1px solid var(--bdr)">✕ Temizle</a>
    <?php endif; ?>
  </form>
</div>

<!-- Toplam -->
<div style="color:var(--t3);font-size:.8rem;margin-bottom:.8rem;letter-spacing:.05em">
  Toplam <strong style="color:var(--t1)"><?= number_format($total) ?></strong> hesap
  <?= $search ? '— <em>'.htmlspecialchars($search).'</em> araması' : '' ?>
  · Sayfa <?= $page ?>/<?= $pages ?>
</div>

<!-- Tablo -->
<div class="card" style="padding:0;overflow:hidden">
  <table class="dtable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Login</th>
        <th>Ad</th>
        <th>E-posta</th>
        <th>Durum</th>
        <th>Coin</th>
        <th>Kayıt</th>
        <th>Son Giriş</th>
        <th>İşlem</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($accounts as $acc): ?>
      <tr>
        <td style="color:var(--t3);font-size:.78rem"><?= $acc['id'] ?></td>
        <td>
          <a href="module_players.php?account_id=<?= $acc['id'] ?>&login=<?= urlencode($acc['login']) ?>"
             style="color:var(--goldL);font-weight:600;text-decoration:none">
            <?= htmlspecialchars($acc['login']) ?>
          </a>
        </td>
        <td style="font-size:.82rem;color:var(--t2)"><?= htmlspecialchars($acc['real_name'] ?? '') ?></td>
        <td style="font-size:.78rem;color:var(--t3)"><?= htmlspecialchars($acc['email'] ?? '') ?></td>
        <td>
          <?php if ($acc['status'] === 'OK'): ?>
            <span class="badge badge-ok">Aktif</span>
          <?php else: ?>
            <span class="badge badge-ban"><?= htmlspecialchars($acc['status']) ?></span>
          <?php endif; ?>
        </td>
        <td style="font-size:.82rem;color:var(--goldL)"><?= number_format((int)($acc['coins'] ?? 0)) ?></td>
        <td style="font-size:.73rem;color:var(--t3)"><?= $acc['create_time'] ? date('d.m.y', strtotime($acc['create_time'])) : '—' ?></td>
        <td style="font-size:.73rem;color:var(--t3)"><?= $acc['last_play'] ? date('d.m.y H:i', strtotime($acc['last_play'])) : '—' ?></td>
        <td>
          <div style="display:flex;gap:.35rem;flex-wrap:wrap">
            <!-- Oyuncuları Gör -->
            <a href="module_players.php?account_id=<?= $acc['id'] ?>&login=<?= urlencode($acc['login']) ?>"
               class="btn" style="padding:.2rem .6rem;font-size:.7rem;background:rgba(200,150,62,.12);color:var(--goldL);border:1px solid var(--goldD)">
              ⚔ Oyuncular
            </a>

            <!-- Ban / Unban -->
            <form method="post" style="display:inline" onsubmit="return confirm('Emin misin?')">
              <?= csrf_field() ?>
              <input type="hidden" name="login" value="<?= htmlspecialchars($acc['login']) ?>">
              <?php if ($acc['status'] === 'OK'): ?>
                <input type="hidden" name="action" value="ban">
                <button class="btn" style="padding:.2rem .6rem;font-size:.7rem;background:rgba(192,57,43,.12);color:#ec7063;border:1px solid var(--red)">🚫 Ban</button>
              <?php else: ?>
                <input type="hidden" name="action" value="unban">
                <button class="btn" style="padding:.2rem .6rem;font-size:.7rem;background:rgba(39,174,96,.12);color:var(--greenL);border:1px solid var(--green)">✓ Unban</button>
              <?php endif; ?>
            </form>

            <!-- Şifre Değiştir -->
            <button class="btn" onclick="showPassModal('<?= htmlspecialchars($acc['login']) ?>')"
                    style="padding:.2rem .6rem;font-size:.7rem;background:rgba(90,90,180,.12);color:#aab;border:1px solid #445">
              🔑 Şifre
            </button>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
    <?php if (!$accounts): ?>
      <tr><td colspan="9" style="text-align:center;color:var(--t3);padding:2rem">Hesap bulunamadı.</td></tr>
    <?php endif; ?>
    </tbody>
  </table>
</div>

<!-- Sayfalama -->
<?php if ($pages > 1): ?>
<div style="display:flex;gap:.5rem;margin-top:1rem;flex-wrap:wrap">
  <?php for ($i = max(1,$page-3); $i <= min($pages,$page+3); $i++): ?>
  <a href="?q=<?= urlencode($search) ?>&page=<?= $i ?>"
     class="btn" style="padding:.3rem .7rem;font-size:.8rem;
     <?= $i===$page ? 'background:var(--goldD);color:var(--goldL);border-color:var(--gold)' : 'background:var(--bg3);color:var(--t2);border:1px solid var(--bdr)' ?>">
    <?= $i ?>
  </a>
  <?php endfor; ?>
</div>
<?php endif; ?>

<!-- Şifre Değiştir Modal -->
<div id="passModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.7);z-index:999;align-items:center;justify-content:center">
  <div style="background:var(--bg2);border:1px solid var(--bdr);border-radius:12px;padding:2rem;width:360px;position:relative">
    <div style="font-family:Cinzel,serif;font-size:1rem;color:var(--gold);margin-bottom:1.2rem">🔑 Şifre Değiştir</div>
    <form method="post">
      <?= csrf_field() ?>
      <input type="hidden" name="action" value="change_password">
      <input type="hidden" name="login" id="modalLogin">
      <div class="fg">
        <label>Hesap: <span id="modalLoginShow" style="color:var(--goldL)"></span></label>
      </div>
      <div class="fg">
        <label>Yeni Şifre</label>
        <input type="text" name="new_password" required minlength="4">
      </div>
      <div style="display:flex;gap:.7rem;margin-top:1rem">
        <button class="btn btn-primary" type="submit">💾 Kaydet</button>
        <button type="button" class="btn" onclick="closePassModal()"
                style="background:var(--bg3);color:var(--t2);border:1px solid var(--bdr)">İptal</button>
      </div>
    </form>
  </div>
</div>

<script>
function showPassModal(login) {
  document.getElementById('modalLogin').value = login;
  document.getElementById('modalLoginShow').textContent = login;
  document.getElementById('passModal').style.display = 'flex';
}
function closePassModal() {
  document.getElementById('passModal').style.display = 'none';
}
</script>

<?php layout_foot(); ?>

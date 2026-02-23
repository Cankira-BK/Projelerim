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

// ── Panel giriş logunu kaydet (her başarılı girişte) ─────────
// Bu fonksiyon login sırasında çağrılır, burada sadece okuyoruz.
$adminLogs = Store::read('admin_logs');

// ── Sekme ────────────────────────────────────────────────────
$tab = $_GET['tab'] ?? 'panel_logs';

// ── IP Sorgulama ─────────────────────────────────────────────
$ipQuery    = trim($_GET['ip'] ?? '');
$ipResults  = [];
$loginQuery = trim($_GET['login_q'] ?? '');
$loginIps   = [];

if ($tab === 'ip_query') {
    if ($ipQuery !== '' && $conn) {
        // log tablosu varsa sorgula — Metin2'de log_* tabloları common DB'de olur
        // Ayrıca account tablosunda last_ip kolonu olabilir
        $ip_esc = $conn->real_escape_string($ipQuery);

        // account tablosunda last_ip var mı kontrol et
        $conn->select_db(DB_ACCOUNT);
        $r = $conn->query("SHOW COLUMNS FROM account LIKE 'last_ip'");
        $hasLastIp = $r && $r->num_rows > 0;

        if ($hasLastIp) {
            $r = $conn->query(
                "SELECT a.login, a.status, a.create_time, a.last_play, a.last_ip
                 FROM account a
                 WHERE a.last_ip = '$ip_esc'
                 ORDER BY a.last_play DESC LIMIT 50"
            );
            if ($r) $ipResults = $r->fetch_all(MYSQLI_ASSOC);
        }

        // login_log tablosu varsa (bazı kaynak kodlarında bulunur)
        $conn->select_db(DB_COMMON);
        $r2 = $conn->query("SHOW TABLES LIKE 'login_log'");
        if ($r2 && $r2->num_rows > 0) {
            $r3 = $conn->query(
                "SELECT login, ip, date FROM login_log
                 WHERE ip = '$ip_esc'
                 ORDER BY date DESC LIMIT 100"
            );
            // login_log sonuçlarını birleştir
        }
    }

    if ($loginQuery !== '' && $conn) {
        $l_esc = $conn->real_escape_string($loginQuery);
        $conn->select_db(DB_ACCOUNT);

        // last_ip kolonu varsa
        $r = $conn->query("SHOW COLUMNS FROM account LIKE 'last_ip'");
        if ($r && $r->num_rows > 0) {
            $r2 = $conn->query(
                "SELECT login, last_ip, last_play, status
                 FROM account WHERE login = '$l_esc' LIMIT 1"
            );
            if ($r2) $loginIps = $r2->fetch_all(MYSQLI_ASSOC);
        }
    }
}

// ── Oyun giriş logları (connect_log varsa) ────────────────────
$gameLogs = [];
$hasGameLog = false;
if ($tab === 'game_logs' && $conn) {
    $conn->select_db(DB_COMMON);
    $r = $conn->query("SHOW TABLES LIKE 'log'");
    if ($r && $r->num_rows > 0) {
        $hasGameLog = true;
        $filterLogin = trim($_GET['filter_login'] ?? '');
        $filterType  = trim($_GET['filter_type'] ?? '');
        $page        = max(1, (int)($_GET['page'] ?? 1));
        $offset      = ($page - 1) * 50;

        $where = '1=1';
        if ($filterLogin !== '') {
            $fl = $conn->real_escape_string($filterLogin);
            $where .= " AND login = '$fl'";
        }
        if ($filterType !== '') {
            $ft = $conn->real_escape_string($filterType);
            $where .= " AND type = '$ft'";
        }

        $r2 = $conn->query(
            "SELECT id, time, login, type, ip, how
             FROM log WHERE $where
             ORDER BY time DESC LIMIT 50 OFFSET $offset"
        );
        if ($r2) $gameLogs = $r2->fetch_all(MYSQLI_ASSOC);
    }
}

layout_head('Loglar'); layout_nav();
layout_page_title('📋', 'Giriş Logları & IP Sorgulama', 'Güvenlik ve erişim takibi');
?>

<!-- Sekmeler -->
<div style="display:flex;gap:.4rem;margin-bottom:1.5rem;border-bottom:1px solid var(--bdr);padding-bottom:.8rem">
  <?php
  $tabs = [
      'panel_logs' => ['📋', 'Panel Giriş Logları'],
      'game_logs'  => ['🎮', 'Oyun Logları'],
      'ip_query'   => ['🔍', 'IP Sorgulama'],
  ];
  foreach ($tabs as $tid => [$tic, $tlabel]):
  ?>
  <a href="?tab=<?= $tid ?>"
     class="btn" style="font-size:.82rem;padding:.4rem 1rem;
     <?= $tab===$tid ? 'background:var(--goldD);color:var(--goldL);border-color:var(--gold)' : 'background:var(--bg3);color:var(--t2);border:1px solid var(--bdr)' ?>">
    <?= $tic ?> <?= $tlabel ?>
  </a>
  <?php endforeach; ?>
</div>

<!-- ══ PANEL GİRİŞ LOGLARI ══════════════════════════════════ -->
<?php if ($tab === 'panel_logs'): ?>

<div class="card" style="padding:0;overflow:hidden">
  <div style="padding:.8rem 1.4rem;border-bottom:1px solid var(--bdr);display:flex;align-items:center;justify-content:space-between">
    <div class="card-title" style="margin:0">📋 Admin Panel Giriş Geçmişi</div>
    <span style="font-size:.75rem;color:var(--t3)"><?= count($adminLogs) ?> kayıt</span>
  </div>
  <table class="dtable">
    <thead>
      <tr><th>Tarih/Saat</th><th>Kullanıcı</th><th>IP Adresi</th><th>Sonuç</th><th>Tarayıcı</th></tr>
    </thead>
    <tbody>
    <?php
    $logsDisplay = array_reverse($adminLogs);
    foreach (array_slice($logsDisplay, 0, 100) as $log):
    ?>
      <tr>
        <td style="font-size:.78rem;color:var(--t3);white-space:nowrap"><?= htmlspecialchars($log['time'] ?? '') ?></td>
        <td><span class="tag"><?= htmlspecialchars($log['user'] ?? '?') ?></span></td>
        <td style="font-family:monospace;font-size:.82rem;color:var(--t2)"><?= htmlspecialchars($log['ip'] ?? '') ?></td>
        <td>
          <?php if (($log['result'] ?? '') === 'ok'): ?>
            <span class="badge badge-ok">✓ Başarılı</span>
          <?php else: ?>
            <span class="badge badge-ban">✕ Başarısız</span>
          <?php endif; ?>
        </td>
        <td style="font-size:.7rem;color:var(--t3);max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
          <?= htmlspecialchars(substr($log['ua'] ?? '', 0, 80)) ?>
        </td>
      </tr>
    <?php endforeach; ?>
    <?php if (!$adminLogs): ?>
      <tr><td colspan="5" style="text-align:center;color:var(--t3);padding:2rem">
        Henüz log yok. Loglar bir sonraki girişten itibaren kaydedilecek.
      </td></tr>
    <?php endif; ?>
    </tbody>
  </table>
</div>

<?php endif; ?>

<!-- ══ OYUN LOGLARI ══════════════════════════════════════════ -->
<?php if ($tab === 'game_logs'): ?>

<?php if (!$hasGameLog): ?>
<div class="alert alert-warn">
  ⚠ <code>common</code> veritabanında <code>log</code> tablosu bulunamadı.
  Bu özellik sunucu log sistemine göre değişir.
</div>
<?php else: ?>

<div class="card" style="padding:1rem 1.4rem;margin-bottom:1rem">
  <form method="get" style="display:flex;gap:.7rem;align-items:center;flex-wrap:wrap">
    <input type="hidden" name="tab" value="game_logs">
    <input type="text" name="filter_login" value="<?= htmlspecialchars($_GET['filter_login'] ?? '') ?>"
           placeholder="Login filtrele..."
           style="flex:1;min-width:150px;padding:.55rem .8rem;background:var(--bg1);border:1px solid var(--bdr);border-radius:var(--r);color:var(--t1);font-family:Rajdhani,sans-serif;font-size:.95rem">
    <input type="text" name="filter_type" value="<?= htmlspecialchars($_GET['filter_type'] ?? '') ?>"
           placeholder="Tip (LOGIN, LOGOUT...)"
           style="width:180px;padding:.55rem .8rem;background:var(--bg1);border:1px solid var(--bdr);border-radius:var(--r);color:var(--t1);font-family:Rajdhani,sans-serif;font-size:.95rem">
    <button class="btn btn-primary">🔍 Filtrele</button>
  </form>
</div>

<div class="card" style="padding:0;overflow:hidden">
  <table class="dtable">
    <thead>
      <tr><th>Zaman</th><th>Login</th><th>Tip</th><th>IP</th><th>Detay</th></tr>
    </thead>
    <tbody>
    <?php foreach ($gameLogs as $log): ?>
      <tr>
        <td style="font-size:.75rem;color:var(--t3);white-space:nowrap"><?= htmlspecialchars($log['time'] ?? '') ?></td>
        <td><span class="tag"><?= htmlspecialchars($log['login'] ?? '') ?></span></td>
        <td>
          <span class="badge" style="background:rgba(52,152,219,.15);color:#5dade2;border:1px solid rgba(52,152,219,.3)">
            <?= htmlspecialchars($log['type'] ?? '') ?>
          </span>
        </td>
        <td style="font-family:monospace;font-size:.8rem;color:var(--t2)"><?= htmlspecialchars($log['ip'] ?? '') ?></td>
        <td style="font-size:.78rem;color:var(--t3)"><?= htmlspecialchars($log['how'] ?? '') ?></td>
      </tr>
    <?php endforeach; ?>
    <?php if (!$gameLogs): ?>
      <tr><td colspan="5" style="text-align:center;color:var(--t3);padding:2rem">Kayıt bulunamadı.</td></tr>
    <?php endif; ?>
    </tbody>
  </table>
</div>
<?php endif; ?>

<?php endif; ?>

<!-- ══ IP SORGULAMA ══════════════════════════════════════════ -->
<?php if ($tab === 'ip_query'): ?>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1.2rem">

  <!-- IP → Hesaplar -->
  <div class="card">
    <div class="card-title">🌐 IP'ye Göre Hesap Ara</div>
    <form method="get" style="display:flex;gap:.6rem;margin-bottom:1rem">
      <input type="hidden" name="tab" value="ip_query">
      <input type="text" name="ip" value="<?= htmlspecialchars($ipQuery) ?>"
             placeholder="örn: 192.168.1.1"
             style="flex:1;padding:.55rem .8rem;background:var(--bg1);border:1px solid var(--bdr);border-radius:var(--r);color:var(--t1);font-family:Rajdhani,sans-serif;font-size:.9rem">
      <button class="btn btn-primary" style="font-size:.8rem;padding:.5rem .9rem">Ara</button>
    </form>

    <?php if ($ipQuery !== ''): ?>
    <?php if ($ipResults): ?>
    <table class="dtable">
      <thead><tr><th>Login</th><th>Durum</th><th>Son Giriş</th></tr></thead>
      <tbody>
      <?php foreach ($ipResults as $ir): ?>
        <tr>
          <td><span class="tag"><?= htmlspecialchars($ir['login']) ?></span></td>
          <td><span class="badge <?= $ir['status']==='OK'?'badge-ok':'badge-ban' ?>"><?= $ir['status']==='OK'?'Aktif':'Banlı' ?></span></td>
          <td style="font-size:.75rem;color:var(--t3)"><?= $ir['last_play'] ? date('d.m.y H:i', strtotime($ir['last_play'])) : '—' ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php else: ?>
    <p style="color:var(--t3);font-size:.84rem">
      Bu IP ile eşleşen hesap bulunamadı.
      <br><span style="font-size:.75rem">Not: account tablosunda <code>last_ip</code> kolonu gerekli.</span>
    </p>
    <?php endif; ?>
    <?php endif; ?>
  </div>

  <!-- Login → IP -->
  <div class="card">
    <div class="card-title">👤 Hesaba Göre IP Ara</div>
    <form method="get" style="display:flex;gap:.6rem;margin-bottom:1rem">
      <input type="hidden" name="tab" value="ip_query">
      <input type="text" name="login_q" value="<?= htmlspecialchars($loginQuery) ?>"
             placeholder="Login adı..."
             style="flex:1;padding:.55rem .8rem;background:var(--bg1);border:1px solid var(--bdr);border-radius:var(--r);color:var(--t1);font-family:Rajdhani,sans-serif;font-size:.9rem">
      <button class="btn btn-primary" style="font-size:.8rem;padding:.5rem .9rem">Ara</button>
    </form>

    <?php if ($loginQuery !== ''): ?>
    <?php if ($loginIps): ?>
    <?php foreach ($loginIps as $li): ?>
    <div style="background:var(--bg1);border:1px solid var(--bdr);border-radius:var(--r);padding:.8rem 1rem;margin-bottom:.5rem">
      <div style="display:flex;justify-content:space-between;margin-bottom:.4rem">
        <span class="tag"><?= htmlspecialchars($li['login']) ?></span>
        <span class="badge <?= $li['status']==='OK'?'badge-ok':'badge-ban' ?>"><?= $li['status']==='OK'?'Aktif':'Banlı' ?></span>
      </div>
      <div style="font-family:monospace;font-size:1rem;color:var(--goldL);margin-bottom:.3rem">
        <?= htmlspecialchars($li['last_ip'] ?? '—') ?>
      </div>
      <div style="font-size:.75rem;color:var(--t3)">Son giriş: <?= $li['last_play'] ? date('d.m.y H:i', strtotime($li['last_play'])) : '—' ?></div>
      <?php if (!empty($li['last_ip'])): ?>
      <div style="margin-top:.5rem">
        <a href="?tab=ip_query&ip=<?= urlencode($li['last_ip']) ?>"
           class="btn" style="font-size:.72rem;padding:.2rem .6rem;background:rgba(200,150,62,.1);color:var(--goldL);border:1px solid var(--goldD)">
          Bu IP'deki diğer hesapları gör →
        </a>
      </div>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>
    <?php else: ?>
    <p style="color:var(--t3);font-size:.84rem">
      Hesap bulunamadı veya <code>last_ip</code> kolonu yok.
    </p>
    <?php endif; ?>
    <?php endif; ?>
  </div>
</div>

<!-- Bilgi Kartı -->
<div class="card" style="background:rgba(200,150,62,.04);border-color:var(--goldD)">
  <div class="card-title">💡 IP Sorgulama Hakkında</div>
  <div style="font-size:.83rem;color:var(--t2);line-height:1.8">
    <p>IP sorgulama için <code>account</code> tablosunda <strong style="color:var(--goldL)">last_ip</strong> kolonu olması gerekir.</p>
    <p>Eğer bu kolon yoksa, FreeBSD sunucunuzdaki MySQL'e bağlanıp şunu çalıştırın:</p>
    <div style="background:var(--bg0);border:1px solid var(--bdr);border-radius:5px;padding:.7rem 1rem;font-family:monospace;font-size:.82rem;color:var(--goldL);margin:.5rem 0">
      ALTER TABLE account ADD COLUMN last_ip VARCHAR(16) DEFAULT '' AFTER last_play;
    </div>
    <p>Ardından sunucu kaynak kodunuzda login sırasında bu kolona IP kayıt etmeniz gerekir.</p>
  </div>
</div>

<?php endif; ?>

<?php layout_foot(); ?>

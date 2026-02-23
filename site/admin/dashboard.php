<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


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

$stats = GameStats::all();
$dbOk  = $stats['connected'];

// Grafik verileri
$jLabels = $jData = $jColors = [];
foreach ($stats['job_counts'] as $j) {
    if ($j['count'] > 0) { $jLabels[] = $j['name']; $jData[] = $j['count']; $jColors[] = $j['color']; }
}
$eLabels = ['🔴 Kırmızı', '🟡 Sarı', '🔵 Mavi'];
$eData   = array_values($stats['empire_counts']);
$eColors = ['#3498db', '#f39c12', '#e74c3c'];

function n(?int $v): string {
    return $v === null ? '<span style="color:var(--t3)">—</span>' : number_format($v, 0, ',', '.');
}
function jobName(int $j): string {
    return [0=>'Savaşçı♂',1=>'Sura♂',2=>'Şaman♂',3=>'Ninja♂',4=>'Savaşçı♀',5=>'Sura♀',6=>'Şaman♀',7=>'Ninja♀'][$j] ?? "Job$j";
}
function empName(int $e): string {
    return ['','🔴 Kırmızı','🟡 Sarı','🔵 Mavi'][$e] ?? '?';
}

layout_head('Dashboard');
layout_nav();
layout_page_title('⚔', 'Dashboard', 'Sunucu Yönetim Merkezi');
?>

<?php if (!$dbOk): ?>
<div class="alert alert-warn">
  ⚠ Oyun veritabanına bağlanılamadı — <code>user/config.php</code> SQL bağlantısı kontrol edin.
</div>
<?php endif; ?>

<!-- Stat kartları -->
<div class="stat-grid">
  <div class="scard c-green">
    <div class="scard-icon">👥</div>
    <div class="scard-val"><?= n($stats['total_accounts']) ?></div>
    <div class="scard-lbl">Toplam Hesap</div>
  </div>
  <div class="scard c-blue">
    <div class="scard-icon">✅</div>
    <div class="scard-val"><?= n($stats['active_accounts']) ?></div>
    <div class="scard-lbl">Aktif Hesap</div>
  </div>
  <div class="scard c-red">
    <div class="scard-icon">🚫</div>
    <div class="scard-val"><?= n($stats['banned_accounts']) ?></div>
    <div class="scard-lbl">Banlı Hesap</div>
  </div>
  <div class="scard c-gold">
    <div class="scard-icon">🌐</div>
    <div class="scard-val"><?= n($stats['online_players']) ?></div>
    <div class="scard-lbl">Online Oyuncu</div>
  </div>
  <div class="scard c-purple">
    <div class="scard-icon">⚔</div>
    <div class="scard-val"><?= n($stats['total_characters']) ?></div>
    <div class="scard-lbl">Toplam Karakter</div>
  </div>
  <div class="scard c-teal">
    <div class="scard-icon">🏰</div>
    <div class="scard-val"><?= n($stats['total_guilds']) ?></div>
    <div class="scard-lbl">Toplam Lonca</div>
  </div>
  <div class="scard c-cyan">
    <div class="scard-icon">📝</div>
    <div class="scard-val"><?= n($stats['today_registrations']) ?></div>
    <div class="scard-lbl">Günlük Kayıt</div>
  </div>
  <div class="scard c-indigo">
    <div class="scard-icon">🚪</div>
    <div class="scard-val"><?= n($stats['today_logins']) ?></div>
    <div class="scard-lbl">Günlük Giriş</div>
  </div>
</div>

<!-- 3 kolon: 2 grafik + son kayıtlar -->
<div class="dash3">

  <div class="card">
    <div class="card-title">⚔ Karakter Sınıfları</div>
    <?php if (array_sum($jData) > 0): ?>
    <div class="chart-wrap"><canvas id="jChart"></canvas></div>
    <div class="legend" id="jLeg"></div>
    <?php else: ?><p style="color:var(--t3);font-size:.84rem">Veri yok.</p><?php endif; ?>
  </div>

  <div class="card">
    <div class="card-title">🏴 İmparatorluk</div>
    <?php if (array_sum($eData) > 0): ?>
    <div class="chart-wrap"><canvas id="eChart"></canvas></div>
    <div class="legend" id="eLeg"></div>
    <?php else: ?><p style="color:var(--t3);font-size:.84rem">Veri yok.</p><?php endif; ?>
  </div>

  <div class="card">
    <div class="card-title">🆕 Son Kayıtlar</div>
    <?php if ($stats['recent_accounts']): ?>
    <table class="dtable">
      <thead><tr><th>Login</th><th>Durum</th><th>Tarih</th></tr></thead>
      <tbody>
      <?php foreach ($stats['recent_accounts'] as $a): ?>
        <tr>
          <td><span class="tag"><?= htmlspecialchars($a['login']) ?></span></td>
          <td><span class="badge <?= $a['status']==='OK'?'badge-ok':'badge-ban' ?>"><?= $a['status']==='OK'?'Aktif':'Banlı' ?></span></td>
          <td style="font-size:.73rem;color:var(--t3)"><?= date('d.m.y H:i', strtotime($a['create_time'])) ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php else: ?><p style="color:var(--t3);font-size:.84rem">Veri yok.</p><?php endif; ?>
  </div>

</div>

<!-- Top oyuncular -->
<div class="card">
  <div class="card-title">🏆 En Yüksek Levelli Oyuncular</div>
  <?php if ($stats['top_players']): ?>
  <table class="dtable">
    <thead><tr><th>#</th><th>Karakter</th><th>Level</th><th>Sınıf</th><th>İmparatorluk</th></tr></thead>
    <tbody>
    <?php foreach ($stats['top_players'] as $i => $p): ?>
      <tr>
        <td style="color:var(--t3);font-size:.78rem"><?= $i+1 ?></td>
        <td><span class="tag"><?= htmlspecialchars($p['name']) ?></span></td>
        <td><span class="lv"><?= $p['level'] ?></span></td>
        <td style="font-size:.82rem;color:var(--t2)"><?= jobName((int)$p['job']) ?></td>
        <td style="font-size:.82rem"><?= empName((int)($p['empire'] ?? 0)) ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  <?php else: ?><p style="color:var(--t3);font-size:.84rem">Veri yok.</p><?php endif; ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
Chart.defaults.color = '#8a9bb5';
Chart.defaults.font.family = "'Rajdhani',sans-serif";
Chart.defaults.font.size = 11;

function donut(id, labels, data, colors) {
  const el = document.getElementById(id);
  if (!el) return null;
  return new Chart(el, {
    type: 'doughnut',
    data: { labels, datasets: [{ data, backgroundColor: colors, borderWidth: 2, borderColor: '#111827' }] },
    options: {
      cutout: '65%',
      plugins: {
        legend: { display: false },
        tooltip: { callbacks: { label: c => ' '+c.label+': '+c.parsed.toLocaleString('tr-TR') } }
      },
      animation: { duration: 700 }
    }
  });
}
function legend(chart, legId) {
  const el = document.getElementById(legId);
  if (!el || !chart) return;
  chart.data.labels.forEach((lbl, i) => {
    const col = chart.data.datasets[0].backgroundColor[i];
    const val = chart.data.datasets[0].data[i];
    el.innerHTML += `<div class="legend-row"><span class="legend-dot" style="background:${col}"></span><span class="legend-name">${lbl}</span><span class="legend-val">${Number(val).toLocaleString('tr-TR')}</span></div>`;
  });
}

<?php if (array_sum($jData) > 0): ?>
const jc = donut('jChart', <?= json_encode(array_values($jLabels)) ?>, <?= json_encode(array_values($jData)) ?>, <?= json_encode(array_values($jColors)) ?>);
legend(jc, 'jLeg');
<?php endif; ?>
<?php if (array_sum($eData) > 0): ?>
const ec = donut('eChart', <?= json_encode($eLabels) ?>, <?= json_encode($eData) ?>, <?= json_encode($eColors) ?>);
legend(ec, 'eLeg');
<?php endif; ?>
</script>
<?php layout_foot(); ?>

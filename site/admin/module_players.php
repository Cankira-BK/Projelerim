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

$accountId   = (int)($_GET['account_id'] ?? 0);
$accountLogin = htmlspecialchars($_GET['login'] ?? '');
$success = $error = '';

// ── Oyuncu kaydet ─────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();
    $playerId = (int)($_POST['player_id'] ?? 0);

    if ($playerId > 0) {
        $conn->select_db(DB_PLAYER);

        // Düzenlenebilir alanlar — sadece güvenli olanlar
        $fields = [];

        $level = isset($_POST['level']) ? max(1, min(99, (int)$_POST['level'])) : null;
        if ($level !== null) $fields[] = "level = $level";

        $exp = isset($_POST['exp']) ? max(0, (int)$_POST['exp']) : null;
        if ($exp !== null) $fields[] = "exp = $exp";

        $hp = isset($_POST['hp']) ? max(0, (int)$_POST['hp']) : null;
        if ($hp !== null) $fields[] = "hp = $hp";

        $mp = isset($_POST['mp']) ? max(0, (int)$_POST['mp']) : null;
        if ($mp !== null) $fields[] = "mp = $mp";

        $stamina = isset($_POST['stamina']) ? max(0, (int)$_POST['stamina']) : null;
        if ($stamina !== null) $fields[] = "stamina = $stamina";

        $gold = isset($_POST['gold']) ? max(0, (int)$_POST['gold']) : null;
        if ($gold !== null) $fields[] = "gold = $gold";

        $playtime = isset($_POST['playtime']) ? max(0, (int)$_POST['playtime']) : null;
        if ($playtime !== null) $fields[] = "playtime = $playtime";

        $st = isset($_POST['st']) ? max(0, min(255, (int)$_POST['st'])) : null;
        if ($st !== null) $fields[] = "st = $st";

        $ht = isset($_POST['ht']) ? max(0, min(255, (int)$_POST['ht'])) : null;
        if ($ht !== null) $fields[] = "ht = $ht";

        $dx = isset($_POST['dx']) ? max(0, min(255, (int)$_POST['dx'])) : null;
        if ($dx !== null) $fields[] = "dx = $dx";

        $iq = isset($_POST['iq']) ? max(0, min(255, (int)$_POST['iq'])) : null;
        if ($iq !== null) $fields[] = "iq = $iq";

        $skillPoint = isset($_POST['skill_point']) ? max(0, (int)$_POST['skill_point']) : null;
        if ($skillPoint !== null) $fields[] = "skill_point = $skillPoint";

        $subSkillPoint = isset($_POST['sub_skill_point']) ? max(0, (int)$_POST['sub_skill_point']) : null;
        if ($subSkillPoint !== null) $fields[] = "sub_skill_point = $subSkillPoint";

        if (!empty($fields)) {
            $sql = "UPDATE player SET " . implode(', ', $fields) . " WHERE id = $playerId";
            $conn->query($sql);
            if ($conn->affected_rows >= 0) {
                $success = "Oyuncu #$playerId güncellendi.";
            } else {
                $error = "Güncelleme başarısız: " . $conn->error;
            }
        }
    }
}

// ── Hesap oyuncuları ──────────────────────────────────────────
$players = [];
if ($accountId > 0) {
    $conn->select_db(DB_PLAYER);
    $r = $conn->query(
        "SELECT p.id, p.name, p.level, p.exp, p.job, p.hp, p.mp, p.stamina,
                p.gold, p.playtime, p.st, p.ht, p.dx, p.iq,
                p.skill_point, p.sub_skill_point,
                pi.empire
         FROM player p
         LEFT JOIN player_index pi ON pi.id = p.account_id
         WHERE p.account_id = $accountId
         ORDER BY p.level DESC"
    );
    if ($r) $players = $r->fetch_all(MYSQLI_ASSOC);
}

// Düzenlenecek oyuncu seçili mi?
$editId     = (int)($_GET['edit'] ?? 0);
$editPlayer = null;
foreach ($players as $p) {
    if ((int)$p['id'] === $editId) { $editPlayer = $p; break; }
}

function jobName(int $j): string {
    return [0=>'Savaşçı♂',1=>'Sura♂',2=>'Şaman♂',3=>'Ninja♂',
            4=>'Savaşçı♀',5=>'Sura♀',6=>'Şaman♀',7=>'Ninja♀'][$j] ?? "Job$j";
}
function empName(int $e): string {
    return ['','🔵 Mavi','🟡 Sarı','🔴 Kırmızı'][$e] ?? '?';
}
function fmtTime(int $seconds): string {
    $h = floor($seconds / 3600);
    $m = floor(($seconds % 3600) / 60);
    return "{$h}s {$m}d";
}

layout_head('Oyuncular'); layout_nav();
layout_page_title('⚔', 'Oyuncu Yönetimi',
    $accountLogin ? "Hesap: $accountLogin" : 'Oyuncu listesi');
?>

<!-- Geri butonu -->
<div style="margin-bottom:1.2rem">
  <a href="module_accounts.php" class="btn"
     style="background:var(--bg3);color:var(--t2);border:1px solid var(--bdr);padding:.35rem .9rem;font-size:.82rem">
    ← Hesaplara Dön
  </a>
</div>

<?php if ($success): ?><div class="alert alert-ok">✓ <?= htmlspecialchars($success) ?></div><?php endif; ?>
<?php if ($error):   ?><div class="alert alert-err">⚠ <?= htmlspecialchars($error) ?></div><?php endif; ?>

<!-- Oyuncu Listesi -->
<div class="card" style="padding:0;overflow:hidden;margin-bottom:1.5rem">
  <div style="padding:1rem 1.4rem;border-bottom:1px solid var(--bdr)">
    <div class="card-title" style="margin-bottom:0">⚔ Karakterler (<?= count($players) ?>)</div>
  </div>
  <table class="dtable">
    <thead>
      <tr>
        <th>ID</th><th>Karakter</th><th>Level</th><th>Job</th><th>İmparatorluk</th>
        <th>Altın</th><th>HP</th><th>MP</th><th>Oynama Süresi</th><th>İşlem</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($players as $p): ?>
      <tr style="<?= $editId===$p['id'] ? 'background:rgba(200,150,62,.06)' : '' ?>">
        <td style="color:var(--t3);font-size:.78rem"><?= $p['id'] ?></td>
        <td><span class="tag"><?= htmlspecialchars($p['name']) ?></span></td>
        <td><span class="lv"><?= $p['level'] ?></span></td>
        <td style="font-size:.82rem;color:var(--t2)"><?= jobName((int)$p['job']) ?></td>
        <td style="font-size:.82rem"><?= empName((int)($p['empire'] ?? 0)) ?></td>
        <td style="font-size:.82rem;color:var(--goldL)"><?= number_format((int)($p['gold'] ?? 0)) ?></td>
        <td style="font-size:.78rem;color:var(--t2)"><?= number_format((int)($p['hp'] ?? 0)) ?></td>
        <td style="font-size:.78rem;color:var(--t2)"><?= number_format((int)($p['mp'] ?? 0)) ?></td>
        <td style="font-size:.78rem;color:var(--t3)"><?= fmtTime((int)($p['playtime'] ?? 0)) ?></td>
        <td>
          <a href="?account_id=<?= $accountId ?>&login=<?= urlencode($accountLogin) ?>&edit=<?= $p['id'] ?>"
             class="btn" style="padding:.2rem .7rem;font-size:.72rem;
             <?= $editId===$p['id'] ? 'background:var(--goldD);color:var(--goldL);border-color:var(--gold)' : 'background:rgba(200,150,62,.1);color:var(--goldL);border:1px solid var(--goldD)' ?>">
            ✏ Düzenle
          </a>
        </td>
      </tr>
    <?php endforeach; ?>
    <?php if (!$players): ?>
      <tr><td colspan="10" style="text-align:center;color:var(--t3);padding:2rem">Bu hesaba bağlı karakter yok.</td></tr>
    <?php endif; ?>
    </tbody>
  </table>
</div>

<!-- Oyuncu Düzenleme Formu -->
<?php if ($editPlayer): ?>
<div class="card">
  <div class="card-title">✏ Düzenle — <?= htmlspecialchars($editPlayer['name']) ?></div>

  <form method="post">
    <?= csrf_field() ?>
    <input type="hidden" name="player_id" value="<?= $editPlayer['id'] ?>">

    <!-- Temel Bilgiler -->
    <div style="font-size:.72rem;color:var(--gold);letter-spacing:.12em;text-transform:uppercase;margin-bottom:.8rem;border-bottom:1px solid var(--bdr);padding-bottom:.4rem">
      Temel Bilgiler
    </div>
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.2rem">
      <div class="fg">
        <label>Level (1-99)</label>
        <input type="number" name="level" value="<?= $editPlayer['level'] ?>" min="1" max="99">
      </div>
      <div class="fg">
        <label>EXP</label>
        <input type="number" name="exp" value="<?= $editPlayer['exp'] ?>" min="0">
      </div>
      <div class="fg">
        <label>Altın</label>
        <input type="number" name="gold" value="<?= $editPlayer['gold'] ?? 0 ?>" min="0">
      </div>
      <div class="fg">
        <label>Oynama Süresi (sn)</label>
        <input type="number" name="playtime" value="<?= $editPlayer['playtime'] ?? 0 ?>" min="0">
        <div class="hint"><?= fmtTime((int)($editPlayer['playtime'] ?? 0)) ?></div>
      </div>
    </div>

    <!-- HP / MP / Stamina -->
    <div style="font-size:.72rem;color:var(--gold);letter-spacing:.12em;text-transform:uppercase;margin-bottom:.8rem;border-bottom:1px solid var(--bdr);padding-bottom:.4rem">
      Can / Mana / Stamina
    </div>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1.2rem">
      <div class="fg">
        <label>HP</label>
        <input type="number" name="hp" value="<?= $editPlayer['hp'] ?? 0 ?>" min="0">
      </div>
      <div class="fg">
        <label>MP</label>
        <input type="number" name="mp" value="<?= $editPlayer['mp'] ?? 0 ?>" min="0">
      </div>
      <div class="fg">
        <label>Stamina</label>
        <input type="number" name="stamina" value="<?= $editPlayer['stamina'] ?? 0 ?>" min="0">
      </div>
    </div>

    <!-- Statlar -->
    <div style="font-size:.72rem;color:var(--gold);letter-spacing:.12em;text-transform:uppercase;margin-bottom:.8rem;border-bottom:1px solid var(--bdr);padding-bottom:.4rem">
      Statlar (0-255)
    </div>
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.2rem">
      <div class="fg">
        <label>STR (Güç)</label>
        <input type="number" name="st" value="<?= $editPlayer['st'] ?? 0 ?>" min="0" max="255">
      </div>
      <div class="fg">
        <label>CON (Dayanıklılık)</label>
        <input type="number" name="ht" value="<?= $editPlayer['ht'] ?? 0 ?>" min="0" max="255">
      </div>
      <div class="fg">
        <label>DEX (Çeviklik)</label>
        <input type="number" name="dx" value="<?= $editPlayer['dx'] ?? 0 ?>" min="0" max="255">
      </div>
      <div class="fg">
        <label>INT (Zeka)</label>
        <input type="number" name="iq" value="<?= $editPlayer['iq'] ?? 0 ?>" min="0" max="255">
      </div>
    </div>

    <!-- Skill Puanları -->
    <div style="font-size:.72rem;color:var(--gold);letter-spacing:.12em;text-transform:uppercase;margin-bottom:.8rem;border-bottom:1px solid var(--bdr);padding-bottom:.4rem">
      Yetenek Puanları
    </div>
    <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:1rem;margin-bottom:1.5rem">
      <div class="fg">
        <label>Yetenek Puanı</label>
        <input type="number" name="skill_point" value="<?= $editPlayer['skill_point'] ?? 0 ?>" min="0">
      </div>
      <div class="fg">
        <label>Alt Yetenek Puanı</label>
        <input type="number" name="sub_skill_point" value="<?= $editPlayer['sub_skill_point'] ?? 0 ?>" min="0">
      </div>
    </div>

    <div style="display:flex;gap:.8rem;align-items:center">
      <button class="btn btn-primary">💾 Değişiklikleri Kaydet</button>
      <a href="?account_id=<?= $accountId ?>&login=<?= urlencode($accountLogin) ?>"
         class="btn" style="background:var(--bg3);color:var(--t2);border:1px solid var(--bdr)">İptal</a>
      <span style="font-size:.75rem;color:var(--t3);margin-left:.3rem">
        ⚠ Oyuncu çevrimiçiyken düzenleme yapma, yeniden bağlanana kadar değişiklikler kaybolabilir.
      </span>
    </div>
  </form>
</div>
<?php endif; ?>

<?php layout_foot(); ?>

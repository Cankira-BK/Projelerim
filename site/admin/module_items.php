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

// ── İşlemler ─────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();
    $action = $_POST['action'] ?? '';

    // Item sil
    if ($action === 'delete_item') {
        $itemId   = (int)($_POST['item_id'] ?? 0);
        $playerId = (int)($_POST['player_id'] ?? 0);
        if ($itemId > 0) {
            $conn->select_db(DB_PLAYER);
            $conn->query("DELETE FROM item WHERE id = $itemId AND owner_id = $playerId");
            $success = "Item #$itemId silindi.";
        }
    }

    // Item ekle
    if ($action === 'add_item') {
        $playerId = (int)($_POST['player_id'] ?? 0);
        $vnum     = (int)($_POST['vnum'] ?? 0);
        $count    = max(1, min(200, (int)($_POST['count'] ?? 1)));
        $window   = (int)($_POST['window'] ?? 1); // 1 = INVENTORY
        $pos      = max(0, (int)($_POST['pos'] ?? 0));

        if ($playerId > 0 && $vnum > 0) {
            $conn->select_db(DB_PLAYER);
            // Boş slot bul (pos çakışmasını önle)
            $r = $conn->query("SELECT pos FROM item WHERE owner_id=$playerId AND window=$window ORDER BY pos ASC");
            $usedPos = [];
            if ($r) while ($row = $r->fetch_row()) $usedPos[] = (int)$row[0];
            while (in_array($pos, $usedPos)) $pos++;

            $sql = "INSERT INTO item (owner_id, window, pos, vnum, count)
                    VALUES ($playerId, $window, $pos, $vnum, $count)";
            $conn->query($sql);
            if ($conn->insert_id > 0) {
                $success = "Item (vnum:$vnum, adet:$count) eklendi.";
            } else {
                $error = "Item eklenemedi: " . $conn->error;
            }
        } else {
            $error = "Geçerli oyuncu ID ve VNUM giriniz.";
        }
    }
}

// ── Oyuncu Arama ──────────────────────────────────────────────
$searchPlayer = trim($_GET['player'] ?? '');
$playerId     = (int)($_GET['player_id'] ?? 0);
$playerData   = null;
$items        = [];
$window       = (int)($_GET['window'] ?? 1);

$windowNames = [
    1  => 'Envanter',
    2  => 'Ekipman',
    3  => 'Saklama (Safebox)',
    4  => 'Alım-Satım',
    5  => 'Seviye Ödülü',
    6  => 'Kuşak',
    9  => 'Lonca Deposu',
];

if ($playerId > 0) {
    $conn->select_db(DB_PLAYER);
    $r = $conn->query("SELECT id, name, level, job FROM player WHERE id = $playerId LIMIT 1");
    if ($r) $playerData = $r->fetch_assoc();

    // Itemleri çek
    $conn->select_db(DB_PLAYER);
    $windowFilter = $window > 0 ? "AND window = $window" : '';
    $r = $conn->query(
        "SELECT id, owner_id, window, pos, vnum, count,
                socket0, socket1, socket2,
                attrtype0, attrvalue0,
                attrtype1, attrvalue1,
                attrtype2, attrvalue2
         FROM item
         WHERE owner_id = $playerId $windowFilter
         ORDER BY window ASC, pos ASC
         LIMIT 500"
    );
    if ($r) $items = $r->fetch_all(MYSQLI_ASSOC);
}

// Oyuncu arama sonuçları
$searchResults = [];
if ($searchPlayer !== '' && !$playerId) {
    $s = $conn->real_escape_string($searchPlayer);
    $conn->select_db(DB_PLAYER);
    $r = $conn->query("SELECT id, name, level, job FROM player WHERE name LIKE '%$s%' LIMIT 20");
    if ($r) $searchResults = $r->fetch_all(MYSQLI_ASSOC);
}

function jobName(int $j): string {
    return [0=>'Savaşçı♂',1=>'Sura♂',2=>'Şaman♂',3=>'Ninja♂',
            4=>'Savaşçı♀',5=>'Sura♀',6=>'Şaman♀',7=>'Ninja♀'][$j] ?? "Job$j";
}

layout_head('Item Yönetimi'); layout_nav();
layout_page_title('🎒', 'Item Yönetimi', 'Oyuncu envanteri görüntüle ve düzenle');
?>

<?php if ($success): ?><div class="alert alert-ok">✓ <?= htmlspecialchars($success) ?></div><?php endif; ?>
<?php if ($error):   ?><div class="alert alert-err">⚠ <?= htmlspecialchars($error) ?></div><?php endif; ?>

<!-- Oyuncu Arama -->
<div class="card" style="padding:1rem 1.4rem;margin-bottom:1rem">
  <form method="get" style="display:flex;gap:.7rem;align-items:center">
    <input type="text" name="player" value="<?= htmlspecialchars($searchPlayer) ?>"
           placeholder="Karakter adı ara..."
           style="flex:1;padding:.55rem .8rem;background:var(--bg1);border:1px solid var(--bdr);border-radius:var(--r);color:var(--t1);font-family:Rajdhani,sans-serif;font-size:.95rem">
    <button class="btn btn-primary" type="submit">🔍 Ara</button>
    <?php if ($playerId): ?>
    <a href="module_items.php" class="btn" style="background:var(--bg3);color:var(--t2);border:1px solid var(--bdr)">✕ Temizle</a>
    <?php endif; ?>
  </form>

  <?php if ($searchResults): ?>
  <div style="margin-top:.8rem;border-top:1px solid var(--bdr);padding-top:.8rem">
    <div style="font-size:.72rem;color:var(--t3);letter-spacing:.1em;text-transform:uppercase;margin-bottom:.5rem">Sonuçlar</div>
    <div style="display:flex;flex-wrap:wrap;gap:.5rem">
      <?php foreach ($searchResults as $sr): ?>
      <a href="?player_id=<?= $sr['id'] ?>" class="btn"
         style="background:rgba(200,150,62,.1);color:var(--goldL);border:1px solid var(--goldD);font-size:.8rem;padding:.3rem .7rem">
        <?= htmlspecialchars($sr['name']) ?> <span style="opacity:.6">Lv.<?= $sr['level'] ?></span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endif; ?>
</div>

<?php if ($playerData): ?>

<!-- Oyuncu Bilgisi + Pencere Seçimi -->
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;flex-wrap:wrap;gap:.8rem">
  <div style="display:flex;align-items:center;gap:.8rem">
    <div style="background:var(--bg2);border:1px solid var(--bdr);border-radius:8px;padding:.6rem 1.1rem">
      <span class="tag"><?= htmlspecialchars($playerData['name']) ?></span>
      <span class="lv" style="margin-left:.5rem"><?= $playerData['level'] ?></span>
      <span style="color:var(--t3);font-size:.8rem;margin-left:.5rem"><?= jobName((int)$playerData['job']) ?></span>
    </div>
    <span style="color:var(--t3);font-size:.8rem"><?= count($items) ?> item</span>
  </div>

  <!-- Pencere filtresi -->
  <div style="display:flex;gap:.4rem;flex-wrap:wrap">
    <a href="?player_id=<?= $playerId ?>&window=0"
       class="btn" style="font-size:.75rem;padding:.28rem .65rem;<?= $window===0?'background:var(--goldD);color:var(--goldL);border-color:var(--gold)':'background:var(--bg3);color:var(--t2);border:1px solid var(--bdr)' ?>">
      Tümü
    </a>
    <?php foreach ($windowNames as $wid => $wname): ?>
    <a href="?player_id=<?= $playerId ?>&window=<?= $wid ?>"
       class="btn" style="font-size:.75rem;padding:.28rem .65rem;<?= $window===$wid?'background:var(--goldD);color:var(--goldL);border-color:var(--gold)':'background:var(--bg3);color:var(--t2);border:1px solid var(--bdr)' ?>">
      <?= $wname ?>
    </a>
    <?php endforeach; ?>
  </div>
</div>

<!-- Item Tablosu -->
<div class="card" style="padding:0;overflow:hidden;margin-bottom:1.5rem">
  <table class="dtable">
    <thead>
      <tr>
        <th>ID</th>
        <th>VNUM</th>
        <th>Pencere</th>
        <th>Pos</th>
        <th>Adet</th>
        <th>Socket 0/1/2</th>
        <th>Attr 0/1/2</th>
        <th>İşlem</th>
      </tr>
    </thead>
    <tbody>
    <?php if ($items): ?>
      <?php foreach ($items as $item): ?>
      <tr>
        <td style="color:var(--t3);font-size:.75rem"><?= $item['id'] ?></td>
        <td>
          <span style="font-family:monospace;font-size:.85rem;color:var(--goldL);font-weight:700"><?= $item['vnum'] ?></span>
        </td>
        <td style="font-size:.78rem;color:var(--t2)"><?= $windowNames[$item['window']] ?? 'Win'.$item['window'] ?></td>
        <td style="font-size:.78rem;color:var(--t3)"><?= $item['pos'] ?></td>
        <td>
          <span style="background:rgba(200,150,62,.12);color:var(--goldL);padding:.1rem .45rem;border-radius:3px;font-size:.8rem;font-weight:700">
            <?= $item['count'] ?>
          </span>
        </td>
        <td style="font-size:.75rem;color:var(--t3);font-family:monospace">
          <?= $item['socket0'] ?> / <?= $item['socket1'] ?> / <?= $item['socket2'] ?>
        </td>
        <td style="font-size:.72rem;color:var(--t3)">
          <?php
          $attrs = [];
          for ($i = 0; $i < 3; $i++) {
              $t = $item["attrtype$i"] ?? 0;
              $v = $item["attrvalue$i"] ?? 0;
              if ($t > 0) $attrs[] = "[$t:$v]";
          }
          echo $attrs ? implode(' ', $attrs) : '—';
          ?>
        </td>
        <td>
          <form method="post" onsubmit="return confirm('Item silinsin mi?')" style="display:inline">
            <?= csrf_field() ?>
            <input type="hidden" name="action" value="delete_item">
            <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
            <input type="hidden" name="player_id" value="<?= $playerId ?>">
            <input type="hidden" name="player_id_get" value="<?= $playerId ?>">
            <button class="btn" style="padding:.2rem .6rem;font-size:.7rem;background:rgba(192,57,43,.12);color:#ec7063;border:1px solid var(--red)"
                    formaction="?player_id=<?= $playerId ?>&window=<?= $window ?>">
              🗑 Sil
            </button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr><td colspan="8" style="text-align:center;color:var(--t3);padding:2rem">Bu pencerede item yok.</td></tr>
    <?php endif; ?>
    </tbody>
  </table>
</div>

<!-- Item Ekle -->
<div class="card" style="max-width:560px">
  <div class="card-title">➕ Item Ekle</div>
  <p style="color:var(--t3);font-size:.8rem;margin-bottom:1rem">
    VNUM: item_proto tablosundaki item numarası. Oyuncu <strong>çevrimdışı</strong> olmalı.
  </p>
  <form method="post" action="?player_id=<?= $playerId ?>&window=<?= $window ?>">
    <?= csrf_field() ?>
    <input type="hidden" name="action" value="add_item">
    <input type="hidden" name="player_id" value="<?= $playerId ?>">
    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:.8rem">
      <div class="fg">
        <label>VNUM</label>
        <input type="number" name="vnum" min="1" required placeholder="örn: 27001">
      </div>
      <div class="fg">
        <label>Adet</label>
        <input type="number" name="count" min="1" max="200" value="1">
      </div>
      <div class="fg">
        <label>Pencere</label>
        <select name="window" style="width:100%;padding:.6rem .8rem;background:var(--bg1);border:1px solid var(--bdr);border-radius:var(--r);color:var(--t1);font-family:Rajdhani,sans-serif">
          <?php foreach ($windowNames as $wid => $wname): ?>
          <option value="<?= $wid ?>" <?= $wid===1?'selected':'' ?>><?= $wname ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <button class="btn btn-primary" style="margin-top:.4rem">➕ Ekle</button>
  </form>
</div>

<?php elseif (!$searchResults): ?>
<div class="card" style="text-align:center;padding:3rem;color:var(--t3)">
  <div style="font-size:2.5rem;margin-bottom:.8rem">🎒</div>
  <div>Yukarıdan bir karakter arayın.</div>
</div>
<?php endif; ?>

<?php layout_foot(); ?>

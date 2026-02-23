<?php
ini_set('display_errors', 1); error_reporting(E_ALL);
define('ADMIN_DIR', __DIR__);
define('SITE_ROOT', dirname(__DIR__));
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/store.php';
require_once __DIR__ . '/includes/db.php';
?><!DOCTYPE html>
<html lang="tr"><head><meta charset="UTF-8"><title>Kurulum</title>
<style>
body{font-family:monospace;background:#07090e;color:#e8dcc8;padding:2rem;max-width:620px;margin:0 auto}
h1{color:#c8963e;margin-bottom:1.5rem}h2{color:#8ab;margin:1.2rem 0 .6rem;border-bottom:1px solid #1e2d45;padding-bottom:.3rem}
.box{background:#111827;border:1px solid #1e2d45;border-radius:8px;padding:1rem;margin:.4rem 0}
.ok{color:#3fb950}.err{color:#f85149}.warn{color:#e8b86d}
.final{background:#1a4a2e;border:1px solid #27ae60;border-radius:8px;padding:1.2rem;margin-top:1.5rem}
.cred{background:#07090e;padding:.5rem .8rem;border-radius:5px;margin:.35rem 0;font-size:1rem}
a{color:#c8963e}
</style></head><body>
<h1>⚙ Kurulum</h1>

<h2>Sistem Kontrolü</h2><div class="box">
<?php
$checks = [
    'PHP '.PHP_VERSION           => PHP_VERSION_ID >= 70400,
    'json_encode'                => function_exists('json_encode'),
    'password_hash'              => function_exists('password_hash'),
    'session_start'              => function_exists('session_start'),
    'data/ yazma izni'           => is_writable(PANEL_DATA_DIR) || is_writable(__DIR__),
    'user/config.php mevcut'     => file_exists(SITE_ROOT.'/user/config.php'),
    'mysqli extension'           => extension_loaded('mysqli'),
];
$allOk = true;
foreach($checks as $k=>$v){
    echo "<div class='".($v?'ok':'err')."'>".($v?'✅':'❌')." $k</div>";
    if(!$v) $allOk=false;
}
?>
</div>

<h2>Veritabanı Bağlantısı</h2><div class="box">
<?php
DB::connect();
if(DB::isConnected()){
    echo "<div class='ok'>✅ Oyun DB bağlantısı başarılı!</div>";
    // Hızlı test
    $cnt = DB::scalar(DB_ACCOUNT, "SELECT COUNT(*) FROM account");
    if($cnt !== null) echo "<div class='ok'>✅ Account tablosu: $cnt kayıt</div>";
    else echo "<div class='warn'>⚠ Account tablosu sorgulanamadı (tablo adını kontrol et)</div>";
} else {
    echo "<div class='err'>❌ DB bağlanamadı. user/config.php'yi kontrol edin.</div>";
}
?>
</div>

<h2>Admin Kullanıcısı</h2><div class="box">
<?php
if(!$allOk){ echo "<div class='err'>Sistem kontrolleri geçilmeden devam edilemez.</div>"; }
else {
    $existing = Store::userFind('admin');
    if(!$existing){
        Store::userCreate('admin', password_hash('Admin1234!', PASSWORD_BCRYPT, ['cost'=>12]));
        echo "<div class='ok'>✅ admin kullanıcısı oluşturuldu.</div>";
    } else {
        echo "<div class='warn'>⚠ admin zaten var, atlandı.</div>";
    }
    // Varsayılan ayarlar
    $defaults=[
        'client_download_url'  =>'https://mega.nz/file/SlxlRSJK#s5L6kceQZTl72SphEugpDoLpw7tRdwqvb5x6qf5wvFk',
        'client_download_url_2'=>'https://drive.google.com/file/d/1kppORAWxBI9ot9adIp6wdnWTttrpb7iv/view?usp=sharing',
        'client_download_url_3'=>'https://dosya.co/no7fk281i4n0/Nuya2_-_1-99_Oldschool.zip.html',
        'client_download_url_4'=>'',
        'site_title'=>'NUYA2','maintenance_mode'=>'0',
    ];
    foreach($defaults as $k=>$v) if(Store::get($k)==='') Store::set($k,$v);
    echo "<div class='ok'>✅ Varsayılan ayarlar yüklendi.</div>";
}
?>
</div>

<?php if($allOk): ?>
<div class="final">
  <strong>🎉 Kurulum tamamlandı!</strong><br><br>
  <div class="cred">👤 Kullanıcı: <strong>admin</strong></div>
  <div class="cred">🔑 Şifre: <strong>Admin1234!</strong></div>
  <br>
  <span class="warn">⚠ Giriş yapınca şifreni değiştir!</span><br>
  <span class="err">🗑 Bu dosyayı sil: install.php</span><br><br>
  <a href="login.php">→ Admin Panele Git</a>
</div>
<?php endif; ?>
</body></html>

<?php
// config.php

// DB bağlantı bilgileri
define('SQL_HOST', 'SERVER_IP');
define('SQL_USER', 'root');
define('SQL_PASS', 'SEVER_ŞİFRE');

// İstersen buraya DB adlarını da ekleyebilirsin (opsiyonel)
define('SQL_DB_ACCOUNT', 'account');
define('SQL_DB_PLAYER',  'player');
define('SQL_DB_COMMON',  'common');
define('SQL_DB_LOG',     'log');

// Bağlantı
$sqlServ = mysqli_connect(SQL_HOST, SQL_USER, SQL_PASS);

if (!$sqlServ) {
    // Üretimde ekrana detay basma; logla
    // error_log("MySQL connect error: " . mysqli_connect_error());
    die("Veritabanı bağlantı hatası.");
}

// Charset (Metin2 DB'lerinde genelde latin5/latin1 görülebiliyor.
// DB'n utf8 ise utf8 kullan. Emin değilsen latin5 daha güvenli olabilir.)
mysqli_set_charset($sqlServ, "utf8");

// İstersen SQL mode vs. burada ayarlanabilir.
// mysqli_query($sqlServ, "SET sql_mode = ''");
?>
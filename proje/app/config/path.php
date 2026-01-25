<?php
define('ADMINHASH',true);
define('OGSFILES',true);
define('HOMEPAGE',\StaticDatabase\StaticDatabase::settings('homein'));
define('ADMIN',\StaticDatabase\StaticDatabase::settings('admin'));
define('SHOP',\StaticDatabase\StaticDatabase::settings('shop'));
define('MUTUAL',\StaticDatabase\StaticDatabase::settings('mutual'));
define('CLIENT',($_SESSION['themes'] ? $_SESSION['themes'] : \StaticDatabase\StaticDatabase::settings('client')));
define('ANDROID',\StaticDatabase\StaticDatabase::settings('android'));
define('SITEKEY',\StaticDatabase\StaticDatabase::settings('sitekey'));
define('SECRETKEY',\StaticDatabase\StaticDatabase::settings('secretkey'));
define('HASH_GENERAL_KEY',\StaticDatabase\StaticDatabase::settings('generalkey'));
define('HASH_PASSWORD_KEY',\StaticDatabase\StaticDatabase::settings('passwordkey'));
define('DB_KEY',\StaticDatabase\StaticDatabase::settings('dbkey'));
define('LICENCE_KEY',\StaticDatabase\StaticDatabase::settings('licence_key'));
define('LICENCE_SECRET',\StaticDatabase\StaticDatabase::settings('licence_secret'));
define('CLIENT_URL',($_SESSION['themes'] ? $_SESSION['themes'] : \StaticDatabase\StaticDatabase::settings('client')));
define('CARETHEME',\StaticDatabase\StaticDatabase::settings('caretheme'));

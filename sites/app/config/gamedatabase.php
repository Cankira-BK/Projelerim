<?php
function inDecode($value,$key){
	$decode = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($value), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
	return $decode;
}

define('GAME_DB_TYPE',\StaticDatabase\StaticDatabase::settings('type'));
define('GAME_DB_HOST',\StaticDatabase\StaticDatabase::settings('ip'));
define('GAME_DB_NAME',\StaticDatabase\StaticDatabase::settings('db'));
define('GAME_DB_USER',\StaticDatabase\StaticDatabase::settings('user'));
define('GAME_DB_PASS',\StaticDatabase\StaticDatabase::settings('password'));
define('GAME_SSH_PASS',\StaticDatabase\StaticDatabase::settings('sshpassword'));
define('CASH',\StaticDatabase\StaticDatabase::settings('cash'));
define("MILEAGE",\StaticDatabase\StaticDatabase::settings('mileage'));
define('CACHETIME',\StaticDatabase\StaticDatabase::settings('cachetime'));

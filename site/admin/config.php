<?php
date_default_timezone_set('Europe/Istanbul');

if (!defined('PANEL_DATA_DIR'))    define('PANEL_DATA_DIR',    __DIR__ . '/data');
if (!defined('PANEL_SESSION_NAME'))define('PANEL_SESSION_NAME','NUYA2ADMIN');
if (!defined('PANEL_TIMEOUT'))     define('PANEL_TIMEOUT',     1800);
if (!defined('PANEL_MAX_ATTEMPTS'))define('PANEL_MAX_ATTEMPTS',5);
if (!defined('PANEL_LOCKOUT'))     define('PANEL_LOCKOUT',     900);
if (!defined('PANEL_TITLE'))       define('PANEL_TITLE',       'NUYA2 Admin Panel');
if (!defined('SITE_ROOT'))         define('SITE_ROOT',         dirname(__DIR__));
if (!defined('DB_ACCOUNT'))        define('DB_ACCOUNT','account');
if (!defined('DB_PLAYER'))         define('DB_PLAYER', 'player');
if (!defined('DB_COMMON'))         define('DB_COMMON', 'common');

if (!is_dir(PANEL_DATA_DIR)) mkdir(PANEL_DATA_DIR, 0750, true);
$htFile = PANEL_DATA_DIR . '/.htaccess';
if (!file_exists($htFile)) file_put_contents($htFile, "Order Deny,Allow\nDeny from all\n");
<?php
/**
 * bootstrap.php — Her admin sayfasının başında include edilir.
 */
define('ADMIN_DIR', __DIR__);
define('SITE_ROOT', dirname(__DIR__));

// PANEL_URL: /admin/ yolunu otomatik hesapla
$scriptPath = $_SERVER['SCRIPT_NAME'] ?? '/admin/index.php';
define('PANEL_URL', rtrim(dirname($scriptPath), '/') . '/');

require_once ADMIN_DIR . '/config.php';
require_once ADMIN_DIR . '/includes/store.php';
require_once ADMIN_DIR . '/includes/auth.php';
require_once ADMIN_DIR . '/includes/db.php';
require_once ADMIN_DIR . '/includes/layout.php';

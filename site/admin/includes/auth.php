<?php
require_once __DIR__ . '/store.php';

function session_boot(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_name(PANEL_SESSION_NAME);
        session_set_cookie_params(['lifetime'=>0,'path'=>'/','httponly'=>true,'samesite'=>'Lax']);
        session_start();
    }
}

function csrf_token(): string {
    session_boot();
    if (empty($_SESSION['csrf_token']))
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    return $_SESSION['csrf_token'];
}

function csrf_field(): string {
    return '<input type="hidden" name="csrf_token" value="'.htmlspecialchars(csrf_token()).'">';
}

function csrf_verify(): void {
    if (!hash_equals(csrf_token(), $_POST['csrf_token'] ?? '')) {
        http_response_code(403); die('CSRF hatası.');
    }
}

function is_logged_in(): bool {
    session_boot();
    if (empty($_SESSION['admin_id'])) return false;
    if ((time() - ($_SESSION['last_active'] ?? 0)) > PANEL_TIMEOUT) {
        session_unset(); session_destroy(); return false;
    }
    $_SESSION['last_active'] = time();
    return true;
}

function require_login(): void {
    if (!is_logged_in()) { header('Location: /admin/login.php'); exit; }
}

function is_locked(string $ip): bool {
    return Store::attemptsCount($ip) >= PANEL_MAX_ATTEMPTS;
}

function write_log(string $user, string $ip, string $result): void {
    $logs   = Store::read('admin_logs');
    $logs[] = [
        'time'   => date('d.m.Y H:i:s'),
        'user'   => $user,
        'ip'     => $ip,
        'result' => $result,
        'ua'     => substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 200),
    ];
    // Son 500 logu tut
    if (count($logs) > 500) $logs = array_slice($logs, -500);
    Store::write('admin_logs', $logs);
}

function attempt_login(string $username, string $password): bool {
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    if (is_locked($ip)) {
        write_log($username, $ip, 'locked');
        return false;
    }
    $user = Store::userFind($username);
    if ($user && password_verify($password, $user['password'])) {
        Store::attemptsClear($ip);
        session_boot();
        session_regenerate_id(true);
        $_SESSION['admin_id']    = $user['id'];
        $_SESSION['admin_user']  = $user['username'];
        $_SESSION['last_active'] = time();
        write_log($username, $ip, 'ok');
        return true;
    }
    Store::attemptsAdd($ip);
    write_log($username, $ip, 'fail');
    return false;
}

function do_logout(): void {
    session_boot(); session_unset(); session_destroy();
    header('Location: /admin/login.php'); exit;
}

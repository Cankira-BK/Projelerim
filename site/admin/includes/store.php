<?php
/**
 * Store — Panel verisi için JSON tabanlı depolama.
 * (Admin kullanıcı, ayarlar, brute-force kayıtları)
 */
class Store {
    private static array $cache = [];

    private static function path(string $name): string {
        return PANEL_DATA_DIR . '/' . preg_replace('/[^a-z0-9_]/', '', $name) . '.json';
    }

    public static function read(string $name): array {
        if (isset(self::$cache[$name])) return self::$cache[$name];
        $f = self::path($name);
        if (!file_exists($f)) return [];
        $d = json_decode(file_get_contents($f), true);
        self::$cache[$name] = is_array($d) ? $d : [];
        return self::$cache[$name];
    }

    public static function write(string $name, array $data): void {
        self::$cache[$name] = $data;
        file_put_contents(self::path($name),
            json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
    }

    // ── Settings ────────────────────────────────────────────────
    public static function get(string $key, string $default = ''): string {
        $s = self::read('settings');
        return isset($s[$key]) ? (string)$s[$key]['value'] : $default;
    }

    public static function set(string $key, string $value): void {
        $s = self::read('settings');
        $s[$key] = ['value' => $value, 'updated_at' => date('Y-m-d H:i:s')];
        self::write('settings', $s);
    }

    // ── Users ────────────────────────────────────────────────────
    public static function userFind(string $username): ?array {
        foreach (self::read('users') as $u)
            if ($u['username'] === $username) return $u;
        return null;
    }

    public static function userCreate(string $username, string $hash): void {
        $users   = self::read('users');
        $users[] = ['id' => count($users)+1, 'username' => $username,
                    'password' => $hash, 'created_at' => date('Y-m-d H:i:s')];
        self::write('users', $users);
    }

    public static function userUpdatePass(string $username, string $hash): void {
        $users = self::read('users');
        foreach ($users as &$u)
            if ($u['username'] === $username) { $u['password'] = $hash; break; }
        self::write('users', $users);
    }

    // ── Login attempts (brute-force) ─────────────────────────────
    public static function attemptsCount(string $ip): int {
        $cutoff = time() - PANEL_LOCKOUT;
        $all    = self::read('login_attempts');
        return count(array_filter($all[$ip] ?? [], fn($t) => $t > $cutoff));
    }

    public static function attemptsAdd(string $ip): void {
        $cutoff = time() - PANEL_LOCKOUT;
        $all    = self::read('login_attempts');
        $all[$ip] = array_values(array_filter($all[$ip] ?? [], fn($t) => $t > $cutoff));
        $all[$ip][] = time();
        self::write('login_attempts', $all);
    }

    public static function attemptsClear(string $ip): void {
        $all = self::read('login_attempts');
        unset($all[$ip]);
        self::write('login_attempts', $all);
    }
}

function setting_get(string $key, string $default = ''): string { return Store::get($key, $default); }
function setting_set(string $key, string $value): void           { Store::set($key, $value); }

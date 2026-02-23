<?php
class DB {
    private static ?mysqli $conn = null;

    public static function connect(): bool {
        global $sqlServ;
        if ($sqlServ instanceof mysqli && $sqlServ->ping()) {
            self::$conn = $sqlServ;
            return true;
        }
        $configFile = SITE_ROOT . '/user/config.php';
        if (file_exists($configFile)) {
            require_once $configFile;
            if ($sqlServ instanceof mysqli && !$sqlServ->connect_errno) {
                self::$conn = $sqlServ;
                return true;
            }
        }
        return false;
    }

    public static function get(): ?mysqli {
        if (!self::$conn) self::connect();
        return self::$conn;
    }

    public static function isConnected(): bool {
        $c = self::get();
        return $c !== null && $c->ping();
    }

    public static function scalar(string $db, string $sql): ?int {
        $conn = self::get();
        if (!$conn) return null;
        $conn->select_db($db);
        $r = $conn->query($sql);
        if (!$r) return null;
        $row = $r->fetch_row();
        return $row ? (int)$row[0] : null;
    }

    public static function rows(string $db, string $sql): array {
        $conn = self::get();
        if (!$conn) return [];
        $conn->select_db($db);
        $r = $conn->query($sql);
        return ($r instanceof mysqli_result) ? $r->fetch_all(MYSQLI_ASSOC) : [];
    }
}

class GameStats {

    public static function totalAccounts(): ?int {
        return DB::scalar(DB_ACCOUNT, "SELECT COUNT(*) FROM account");
    }

    public static function activeAccounts(): ?int {
        return DB::scalar(DB_ACCOUNT, "SELECT COUNT(*) FROM account WHERE status = 'OK'");
    }

    public static function bannedAccounts(): ?int {
        return DB::scalar(DB_ACCOUNT, "SELECT COUNT(*) FROM account WHERE status != 'OK'");
    }

    public static function todayRegistrations(): ?int {
        return DB::scalar(DB_ACCOUNT,
            "SELECT COUNT(*) FROM account WHERE DATE(create_time) = CURDATE()");
    }

    public static function todayLogins(): ?int {
        return DB::scalar(DB_ACCOUNT,
            "SELECT COUNT(DISTINCT login) FROM account WHERE DATE(last_play) = CURDATE()");
    }

    public static function totalCharacters(): ?int {
        return DB::scalar(DB_PLAYER, "SELECT COUNT(*) FROM player");
    }

    public static function totalGuilds(): ?int {
        return DB::scalar(DB_PLAYER, "SELECT COUNT(*) FROM guild");
    }

    public static function onlinePlayers(): ?int {
        return DB::scalar(DB_ACCOUNT,
            "SELECT COUNT(*) FROM account WHERE last_play >= DATE_SUB(NOW(), INTERVAL 10 MINUTE)");
    }

    public static function empireCounts(): array {
        // empire kolonu player_index tablosunda (rankings.php ile aynı yapı)
        $rows = DB::rows(DB_PLAYER,
            "SELECT empire, COUNT(*) as cnt FROM player_index
             GROUP BY empire ORDER BY empire");
        $result = [1 => 0, 2 => 0, 3 => 0];
        foreach ($rows as $r) {
            $e = (int)$r['empire'];
            if (isset($result[$e])) $result[$e] = (int)$r['cnt'];
        }
        return $result;
    }

    public static function jobCounts(): array {
        $rows = DB::rows(DB_PLAYER,
            "SELECT job, COUNT(*) as cnt FROM player
             WHERE level > 0
             GROUP BY job ORDER BY job");
        $jobs = [
            0 => ['name' => 'Savaşçı♂', 'count' => 0, 'color' => '#e74c3c'],
            1 => ['name' => 'Sura♂',    'count' => 0, 'color' => '#8e44ad'],
            2 => ['name' => 'Şaman♂',   'count' => 0, 'color' => '#27ae60'],
            3 => ['name' => 'Ninja♂',   'count' => 0, 'color' => '#f39c12'],
            4 => ['name' => 'Savaşçı♀', 'count' => 0, 'color' => '#c0392b'],
            5 => ['name' => 'Sura♀',    'count' => 0, 'color' => '#9b59b6'],
            6 => ['name' => 'Şaman♀',   'count' => 0, 'color' => '#2ecc71'],
            7 => ['name' => 'Ninja♀',   'count' => 0, 'color' => '#e67e22'],
        ];
        foreach ($rows as $r) {
            $j = (int)$r['job'];
            if (isset($jobs[$j])) $jobs[$j]['count'] = (int)$r['cnt'];
        }
        return $jobs;
    }

    public static function recentAccounts(int $limit = 5): array {
        return DB::rows(DB_ACCOUNT,
            "SELECT login, create_time, status FROM account
             ORDER BY create_time DESC LIMIT $limit");
    }

    public static function topPlayers(int $limit = 5): array {
        // rankings.php ile aynı sorgu yapısı
        return DB::rows(DB_PLAYER,
            "SELECT p.name, p.level, p.job, pi.empire
             FROM player p
             LEFT JOIN player_index pi ON pi.id = p.account_id
             WHERE p.level > 0
             ORDER BY p.level DESC, p.exp DESC
             LIMIT $limit");
    }

    public static function all(): array {
        DB::connect();
        return [
            'connected'           => DB::isConnected(),
            'total_accounts'      => self::totalAccounts(),
            'active_accounts'     => self::activeAccounts(),
            'banned_accounts'     => self::bannedAccounts(),
            'today_registrations' => self::todayRegistrations(),
            'today_logins'        => self::todayLogins(),
            'total_characters'    => self::totalCharacters(),
            'total_guilds'        => self::totalGuilds(),
            'online_players'      => self::onlinePlayers(),
            'empire_counts'       => self::empireCounts(),
            'job_counts'          => self::jobCounts(),
            'recent_accounts'     => self::recentAccounts(),
            'top_players'         => self::topPlayers(),
        ];
    }
}

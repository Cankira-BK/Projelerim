<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$db = Database::getInstance();

// Sayfa numarası
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 50;
$offset = ($page - 1) * $perPage;

// Toplam kayıt sayısı
$totalLogs = $db->fetchOne("SELECT COUNT(*) as count FROM security_logs")['count'] ?? 0;
$totalPages = ceil($totalLogs / $perPage);

// Logları çek
$logs = $db->fetchAll(
    "SELECT * FROM security_logs ORDER BY created_at DESC LIMIT ? OFFSET ?",
    [$perPage, $offset]
);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Güvenlik Logları - Admin Panel</title>
    <link rel="stylesheet" href="admin-style.css">
    <style>
        .log-success { color: #28a745; }
        .log-failed { color: #dc3545; }
        .log-warning { color: #ffc107; }
        .pagination { display: flex; gap: 0.5rem; justify-content: center; margin-top: 2rem; }
        .pagination a { padding: 0.5rem 1rem; background: white; border: 1px solid #ddd; border-radius: 5px; text-decoration: none; color: #333; }
        .pagination a.active { background: #ffd700; color: #000; font-weight: bold; }
        .pagination a:hover { background: #f8f9fa; }
    </style>
</head>
<body>
    <div class="header">
        <h1>📋 Güvenlik Logları</h1>
        <div class="header-right">
            <a href="settings.php" class="btn btn-small">← Ayarlara Dön</a>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <h2>Son İşlemler (Toplam: <?php echo number_format($totalLogs); ?>)</h2>
            
            <?php if (empty($logs)): ?>
                <p style="text-align: center; padding: 2rem; color: #666;">Henüz log kaydı yok.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Tarih/Saat</th>
                                <th>İşlem Türü</th>
                                <th>Kullanıcı</th>
                                <th>IP Adresi</th>
                                <th>Detaylar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($logs as $log): ?>
                                <tr>
                                    <td><?php echo date('d.m.Y H:i:s', strtotime($log['created_at'])); ?></td>
                                    <td>
                                        <?php 
                                        $class = 'log-success';
                                        if (strpos($log['log_type'], 'failed') !== false) $class = 'log-failed';
                                        if (strpos($log['log_type'], 'suspicious') !== false) $class = 'log-warning';
                                        ?>
                                        <span class="<?php echo $class; ?>">
                                            <?php echo htmlspecialchars(str_replace('_', ' ', ucfirst($log['log_type']))); ?>
                                        </span>
                                    </td>
                                    <td><?php echo htmlspecialchars($log['username'] ?? '-'); ?></td>
                                    <td><?php echo htmlspecialchars($log['ip_address']); ?></td>
                                    <td><?php echo htmlspecialchars($log['details'] ?? '-'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Sayfalama -->
                <?php if ($totalPages > 1): ?>
                    <div class="pagination">
                        <?php if ($page > 1): ?>
                            <a href="?page=<?php echo $page - 1; ?>">« Önceki</a>
                        <?php endif; ?>

                        <?php for ($i = max(1, $page - 2); $i <= min($totalPages, $page + 2); $i++): ?>
                            <a href="?page=<?php echo $i; ?>" class="<?php echo $i == $page ? 'active' : ''; ?>">
                                <?php echo $i; ?>
                            </a>
                        <?php endfor; ?>

                        <?php if ($page < $totalPages): ?>
                            <a href="?page=<?php echo $page + 1; ?>">Sonraki »</a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<?php
session_start();
require_once '../config/database.php';
require_once '../includes/mailer.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$db = Database::getInstance();
$message = '';
$error = '';

// Araç onaylama
if (isset($_GET['approve'])) {
    try {
        $vehicleId = (int)$_GET['approve'];
        
        // Aracı aktif et
        $db->execute("UPDATE vehicles SET status = 'active' WHERE id = ?", [$vehicleId]);
        
        // Müşteri bilgilerini al
        $vehicle = $db->fetchOne("SELECT * FROM vehicles WHERE id = ?", [$vehicleId]);
        
        // Müşteriye email gönder
        if (!empty($vehicle['customer_email'])) {
            notifyVehicleApproved([
                'name' => $vehicle['customer_name'],
                'email' => $vehicle['customer_email']
            ], [
                'title' => $vehicle['title'],
                'price' => $vehicle['price']
            ]);
        }
        
        logSecurity('data_change', $_SESSION['admin_username'], 'Vehicle approved: ' . $vehicleId);
        $message = 'Araç onaylandı ve yayınlandı!';
        
    } catch (Exception $e) {
        $error = 'Hata: ' . $e->getMessage();
    }
}

// Araç reddetme
if (isset($_GET['reject'])) {
    try {
        $vehicleId = (int)$_GET['reject'];
        $db->execute("DELETE FROM vehicles WHERE id = ?", [$vehicleId]);
        
        logSecurity('data_change', $_SESSION['admin_username'], 'Vehicle rejected: ' . $vehicleId);
        $message = 'Araç reddedildi ve silindi.';
        
    } catch (Exception $e) {
        $error = 'Hata: ' . $e->getMessage();
    }
}

// Onay bekleyen araçlar
$pendingVehicles = $db->fetchAll(
    "SELECT * FROM vehicles WHERE status = 'pending' AND is_customer_vehicle = 1 ORDER BY created_at DESC"
);

// Onaylanmış müşteri araçları
$approvedVehicles = $db->fetchAll(
    "SELECT * FROM vehicles WHERE status = 'active' AND is_customer_vehicle = 1 ORDER BY created_at DESC LIMIT 20"
);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Müşteri Araçları - Admin Panel</title>
    <link rel="stylesheet" href="admin-style.css">
    <style>
        .vehicle-preview {
            display: flex;
            gap: 1rem;
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .vehicle-preview img {
            width: 150px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }
        .vehicle-preview-info {
            flex: 1;
        }
        .vehicle-preview-actions {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .customer-info {
            background: #e7f3ff;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>👥 Müşteri Araçları</h1>
        <div class="header-right">
            <a href="index.php" class="btn btn-small">← Admin Panel</a>
        </div>
    </div>

    <div class="container">
        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <!-- Onay Bekleyenler -->
        <div class="card">
            <h2>⏳ Onay Bekleyen Araçlar (<?php echo count($pendingVehicles); ?>)</h2>
            
            <?php if (empty($pendingVehicles)): ?>
                <p style="text-align: center; padding: 2rem; color: #666;">Onay bekleyen araç yok.</p>
            <?php else: ?>
                <?php foreach ($pendingVehicles as $v): ?>
                    <div class="vehicle-preview">
                        <?php if (!empty($v['image'])): ?>
                            <img src="<?php echo htmlspecialchars($v['image']); ?>" alt="">
                        <?php else: ?>
                            <div style="width: 150px; height: 100px; background: #e0e0e0; border-radius: 5px; display: flex; align-items: center; justify-content: center; color: #999;">
                                📷 Resim Yok
                            </div>
                        <?php endif; ?>
        </div>

        <!-- Onaylanmış Araçlar -->
        <div class="card">
            <h2>✅ Onaylanmış Müşteri Araçları (<?php echo count($approvedVehicles); ?>)</h2>
            
            <?php if (empty($approvedVehicles)): ?>
                <p style="text-align: center; padding: 2rem; color: #666;">Henüz onaylanmış müşteri aracı yok.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Resim</th>
                                <th>Araç</th>
                                <th>Müşteri</th>
                                <th>Tarih</th>
                                <th>Görüntülenme</th>
                                <th>İşlem</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($approvedVehicles as $v): ?>
                                <tr>
                                    <td>
                                        <?php if (!empty($v['image'])): ?>
                                            <img src="<?php echo htmlspecialchars($v['image']); ?>" style="width: 60px; height: 45px; object-fit: cover; border-radius: 5px;">
                                        <?php else: ?>
                                            <div style="width: 60px; height: 45px; background: #e0e0e0; border-radius: 5px;"></div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <strong><?php echo htmlspecialchars($v['title']); ?></strong><br>
                                        <span style="color: #ffd700; font-weight: bold;"><?php echo htmlspecialchars($v['price']); ?></span>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($v['customer_name']); ?><br>
                                        <small><?php echo htmlspecialchars($v['customer_phone']); ?></small>
                                    </td>
                                    <td><?php echo date('d.m.Y', strtotime($v['created_at'])); ?></td>
                                    <td><?php echo number_format($v['views']); ?></td>
                                    <td>
                                        <a href="../index.php" target="_blank" class="btn btn-small">Görüntüle</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
                        
                        <div class="vehicle-preview-info">
                            <h3 style="margin-bottom: 0.5rem;"><?php echo htmlspecialchars($v['title']); ?></h3>
                            <p style="font-size: 1.2rem; color: #ffd700; font-weight: bold; margin: 0.5rem 0;">
                                <?php echo htmlspecialchars($v['price']); ?>
                            </p>
                            <p style="color: #666; margin: 0.5rem 0;">
                                📅 <?php echo htmlspecialchars($v['year']); ?> • 
                                🛣️ <?php echo htmlspecialchars($v['km']); ?> • 
                                ⛽ <?php echo htmlspecialchars($v['fuel']); ?> • 
                                ⚙️ <?php echo htmlspecialchars($v['transmission']); ?>
                            </p>
                            
                            <?php if (!empty($v['description'])): ?>
                                <p style="margin: 0.5rem 0; padding: 0.5rem; background: white; border-radius: 5px; font-size: 0.9rem;">
                                    <?php echo nl2br(htmlspecialchars(substr($v['description'], 0, 200))); ?>
                                    <?php if (strlen($v['description']) > 200): ?>...<?php endif; ?>
                                </p>
                            <?php endif; ?>
                            
                            <div class="customer-info">
                                <strong>👤 Müşteri:</strong> <?php echo htmlspecialchars($v['customer_name']); ?> • 
                                <strong>📞</strong> <a href="tel:<?php echo htmlspecialchars($v['customer_phone']); ?>"><?php echo htmlspecialchars($v['customer_phone']); ?></a> • 
                                <strong>✉️</strong> <a href="mailto:<?php echo htmlspecialchars($v['customer_email']); ?>"><?php echo htmlspecialchars($v['customer_email']); ?></a>
                            </div>
                            
                            <p style="font-size: 0.85rem; color: #999; margin-top: 0.5rem;">
                                Eklenme Tarihi: <?php echo date('d.m.Y H:i', strtotime($v['created_at'])); ?>
                            </p>
                        </div>
                        
                        <div class="vehicle-preview-actions">
                            <a href="?approve=<?php echo $v['id']; ?>" class="btn btn-success btn-small" onclick="return confirm('Bu aracı onaylamak istediğinizden emin misiniz?')">
                                ✓ Onayla ve Yayınla
                            </a>
                            <a href="?edit=<?php echo $v['id']; ?>" class="btn btn-small">
                                ✏️ Düzenle
                            </a>
                            <a href="?reject=<?php echo $v['id']; ?>" class="btn btn-danger btn-small" onclick="return confirm('Bu aracı reddetmek istediğinizden emin misiniz?')">
                                ✗ Reddet
                            </a>
                            <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $v['customer_phone']); ?>" target="_blank" class="btn btn-small" style="background: #25D366; color: white;">
                                💬 Müşteri
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
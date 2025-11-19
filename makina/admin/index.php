<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$db = Database::getInstance();
$message = '';
$error = '';

// Ürün silme
if (isset($_GET['delete'])) {
    try {
        $productId = (int)$_GET['delete'];
        $db->execute("DELETE FROM product_images WHERE product_id = ?", [$productId]);
        $db->execute("DELETE FROM products WHERE id = ?", [$productId]);
        logSecurity('data_change', $_SESSION['admin_username'], 'Product deleted: ' . $productId);
        header('Location: index.php?msg=deleted');
        exit;
    } catch (Exception $e) {
        $error = 'Silme hatası: ' . $e->getMessage();
    }
}

// Mesaj
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'deleted') $message = 'Ürün ve resimleri silindi!';
    if ($_GET['msg'] == 'updated') $message = 'Ürün güncellendi!';
}

// İstatistikler
$stats = [
    'total_products' => $db->fetchOne("SELECT COUNT(*) as count FROM products WHERE status='active'")['count'] ?? 0,
    'featured_products' => $db->fetchOne("SELECT COUNT(*) as count FROM products WHERE is_featured=1 AND status='active'")['count'] ?? 0,
    'total_offers' => $db->fetchOne("SELECT COUNT(*) as count FROM offers")['count'] ?? 0,
    'new_offers' => $db->fetchOne("SELECT COUNT(*) as count FROM offers WHERE status='new'")['count'] ?? 0,
    'total_views' => $db->fetchOne("SELECT SUM(views) as total FROM products")['total'] ?? 0,
    'total_images' => $db->fetchOne("SELECT COUNT(*) as count FROM product_images")['count'] ?? 0
];

// Ürünleri çek + resim sayıları
$products = $db->fetchAll("
    SELECT p.*, 
           (SELECT COUNT(*) FROM product_images WHERE product_id = p.id) as image_count
    FROM products p 
    ORDER BY p.created_at DESC
");

// Son teklifleri çek
$recentOffers = $db->fetchAll("SELECT o.*, p.title as product_title FROM offers o LEFT JOIN products p ON o.product_id = p.id ORDER BY o.created_at DESC LIMIT 5");

// Çıkış
if (isset($_GET['logout'])) {
    logSecurity('logout', $_SESSION['admin_username'], 'Admin logout');
    session_destroy();
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Güçlü Makina</title>
    <link rel="stylesheet" href="admin-style.css">
    <style>
        .quick-add-card {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            color: white;
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .quick-add-card h2 {
            margin: 0 0 1rem 0;
            font-size: 1.8rem;
        }
        .quick-add-card p {
            margin: 0 0 1.5rem 0;
            opacity: 0.9;
        }
        .quick-add-card .btn {
            background: white;
            color: #ff6b35;
            font-size: 1.1rem;
            padding: 1rem 2rem;
            font-weight: bold;
        }
        .quick-add-card .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 20px rgba(255,255,255,0.3);
        }
        .image-count-badge {
            display: inline-block;
            background: #28a745;
            color: white;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 0.75rem;
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>⚙️ Güçlü Makina - Admin Panel</h1>
        <div class="header-right">
            <span>Hoş geldin, <?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
            <a href="../index.php" class="btn btn-small" target="_blank">Siteyi Görüntüle</a>
            <a href="?logout=1" class="btn btn-small btn-danger">Çıkış</a>
        </div>
    </div>

    <div class="container">
        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <!-- Hızlı Ürün Ekleme -->
        <div class="quick-add-card">
            <h2>➕ Yeni Ürün/Parça Ekle</h2>
            <p>Çoklu resim yükleme özelliği ile ürün portföyünüzü güncelleyin</p>
            <a href="manage_product.php" class="btn">Ürün Ekle</a>
        </div>

        <!-- İstatistikler -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Toplam Ürün</h3>
                <div class="number"><?php echo $stats['total_products']; ?></div>
            </div>
            <div class="stat-card">
                <h3>Öne Çıkan</h3>
                <div class="number"><?php echo $stats['featured_products']; ?></div>
            </div>
            <div class="stat-card">
                <h3>Toplam Resim</h3>
                <div class="number"><?php echo $stats['total_images']; ?></div>
            </div>
            <div class="stat-card">
                <h3>Yeni Teklif</h3>
                <div class="number" style="color: #dc3545;"><?php echo $stats['new_offers']; ?></div>
            </div>
            <div class="stat-card">
                <h3>Görüntülenme</h3>
                <div class="number"><?php echo number_format($stats['total_views']); ?></div>
            </div>
        </div>

        <!-- Tab Menü -->
        <div class="tab-menu">
            <button class="tab-btn active" onclick="openTab(event, 'products')">⚙️ Ürünler & Parçalar</button>
            <button class="tab-btn" onclick="openTab(event, 'offers')">📝 Teklifler (<?php echo $stats['new_offers']; ?>)</button>
            <button class="tab-btn" onclick="openTab(event, 'settings')">⚙️ Ayarlar</button>
        </div>

        <!-- Ürünler Tab -->
        <div id="products" class="tab-content active">
            <div class="card">
                <h2>Ürün/Parça Listesi (<?php echo count($products); ?>)</h2>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Resim</th>
                                <th>Başlık</th>
                                <th>Kategori</th>
                                <th>Özellikler</th>
                                <th>Görüntülenme</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $p): ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo htmlspecialchars($p['image']); ?>" style="width: 60px; height: 45px; object-fit: cover; border-radius: 5px;" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 60 45%22%3E%3Crect fill=%22%23e0e0e0%22 width=%2260%22 height=%2245%22/%3E%3C/svg%3E'">
                                        <?php if ($p['image_count'] > 0): ?>
                                            <span class="image-count-badge">📷 <?php echo $p['image_count']; ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($p['title']); ?>
                                        <?php if ($p['is_featured']): ?><span class="badge">⭐</span><?php endif; ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($p['category']); ?></td>
                                    <td><?php echo htmlspecialchars(substr($p['specifications'], 0, 30)); ?><?php if(strlen($p['specifications']) > 30): ?>...<?php endif; ?></td>
                                    <td><?php echo number_format($p['views']); ?></td>
                                    <td>
                                        <a href="manage_product.php?id=<?php echo $p['id']; ?>" class="btn btn-small">✏️ Düzenle</a>
                                        <a href="?delete=<?php echo $p['id']; ?>" class="btn btn-small btn-danger" onclick="return confirm('Bu ürünü ve tüm resimlerini silmek istediğinizden emin misiniz?')">🗑️ Sil</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Teklifler Tab -->
        <div id="offers" class="tab-content">
            <div class="card">
                <h2>Gelen Teklif Talepleri</h2>
                <?php if (empty($recentOffers)): ?>
                    <p style="text-align: center; padding: 2rem; color: #666;">Henüz teklif talebi yok.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Tarih</th>
                                    <th>Hizmet Türü</th>
                                    <th>Müşteri</th>
                                    <th>Telefon</th>
                                    <th>Ürün</th>
                                    <th>İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentOffers as $o): ?>
                                    <tr>
                                        <td><?php echo date('d.m.Y H:i', strtotime($o['created_at'])); ?></td>
                                        <td><?php $types = ['production' => '⚙️ İmalat', 'repair' => '🔧 Bakım', 'service' => '🛠️ Hizmet']; echo $types[$o['offer_type']] ?? ''; ?></td>
                                        <td><?php echo htmlspecialchars($o['customer_name']); ?></td>
                                        <td><a href="tel:<?php echo htmlspecialchars($o['customer_phone']); ?>"><?php echo htmlspecialchars($o['customer_phone']); ?></a></td>
                                        <td><?php echo htmlspecialchars($o['product_title'] ?? 'Genel'); ?></td>
                                        <td><a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $o['customer_phone']); ?>" target="_blank" class="btn btn-small btn-success">💬 WhatsApp</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Ayarlar Tab -->
        <div id="settings" class="tab-content">
            <div class="card">
                <h2>⚙️ Yönetim Paneli</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin-top: 1.5rem;">
                    <a href="content_management.php" class="btn" style="padding: 2rem; text-align: center; display: block;">
                        <div style="font-size: 3rem; margin-bottom: 0.5rem;">📝</div>
                        <strong>İçerik Yönetimi</strong>
                        <p style="font-size: 0.9rem; margin: 0.5rem 0 0 0; opacity: 0.8;">Logo, banner, hizmetler ve referanslar</p>
                    </a>
                    <a href="settings.php" class="btn btn-secondary" style="padding: 2rem; text-align: center; display: block;">
                        <div style="font-size: 3rem; margin-bottom: 0.5rem;">⚙️</div>
                        <strong>Site Ayarları</strong>
                        <p style="font-size: 0.9rem; margin: 0.5rem 0 0 0; opacity: 0.8;">Genel ayarlar ve iletişim bilgileri</p>
                    </a>
                    <a href="security_logs.php" class="btn btn-secondary" style="padding: 2rem; text-align: center; display: block;">
                        <div style="font-size: 3rem; margin-bottom: 0.5rem;">🔒</div>
                        <strong>Güvenlik Logları</strong>
                        <p style="font-size: 0.9rem; margin: 0.5rem 0 0 0; opacity: 0.8;">Sistem güvenlik kayıtları</p>
                    </a>
                    <a href="statistics.php" class="btn btn-secondary" style="padding: 2rem; text-align: center; display: block;">
                        <div style="font-size: 3rem; margin-bottom: 0.5rem;">📊</div>
                        <strong>İstatistikler</strong>
                        <p style="font-size: 0.9rem; margin: 0.5rem 0 0 0; opacity: 0.8;">Detaylı site istatistikleri</p>
                    </a>
                    <a href="change_password.php" class="btn btn-secondary" style="padding: 2rem; text-align: center; display: block;">
                        <div style="font-size: 3rem; margin-bottom: 0.5rem;">🔑</div>
                        <strong>Şifre Değiştir</strong>
                        <p style="font-size: 0.9rem; margin: 0.5rem 0 0 0; opacity: 0.8;">Admin şifresini güncelle</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].classList.remove("active");
            }
            tablinks = document.getElementsByClassName("tab-btn");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }
            document.getElementById(tabName).classList.add("active");
            evt.currentTarget.classList.add("active");
        }
    </script>
</body>
</html>

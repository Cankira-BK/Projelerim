<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$db = Database::getInstance();

// Tarih filtresi
$dateFilter = isset($_GET['period']) ? $_GET['period'] : '30';
$dateCondition = "DATE_SUB(NOW(), INTERVAL {$dateFilter} DAY)";

// Genel İstatistikler
$stats = [
    'total_products' => $db->fetchOne("SELECT COUNT(*) as count FROM products")['count'] ?? 0,
    'active_products' => $db->fetchOne("SELECT COUNT(*) as count FROM products WHERE status='active'")['count'] ?? 0,
    'featured_products' => $db->fetchOne("SELECT COUNT(*) as count FROM products WHERE is_featured=1 AND status='active'")['count'] ?? 0,
    'total_images' => $db->fetchOne("SELECT COUNT(*) as count FROM product_images")['count'] ?? 0,
    'total_views' => $db->fetchOne("SELECT SUM(views) as total FROM products")['total'] ?? 0,
    'total_offers' => $db->fetchOne("SELECT COUNT(*) as count FROM offers")['count'] ?? 0,
    'new_offers' => $db->fetchOne("SELECT COUNT(*) as count FROM offers WHERE status='new'")['count'] ?? 0,
    'offers_this_period' => $db->fetchOne("SELECT COUNT(*) as count FROM offers WHERE created_at >= {$dateCondition}")['count'] ?? 0,
];

// Kategori bazlı ürün dağılımı
$categoryStats = $db->fetchAll("
    SELECT category, COUNT(*) as count, SUM(views) as total_views
    FROM products 
    WHERE status='active'
    GROUP BY category 
    ORDER BY count DESC
");

// En çok görüntülenen ürünler
$topViewed = $db->fetchAll("
    SELECT id, title, category, views, 
           (SELECT COUNT(*) FROM product_images WHERE product_id = products.id) as image_count
    FROM products 
    WHERE status='active'
    ORDER BY views DESC 
    LIMIT 10
");

// Teklif türü dağılımı
$offerTypeStats = $db->fetchAll("
    SELECT offer_type, COUNT(*) as count
    FROM offers 
    WHERE created_at >= {$dateCondition}
    GROUP BY offer_type
");

// Günlük teklif trendi (son 7 gün)
$dailyOffers = $db->fetchAll("
    SELECT DATE(created_at) as date, COUNT(*) as count
    FROM offers 
    WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
    GROUP BY DATE(created_at)
    ORDER BY date ASC
");

// Son teklifler
$recentOffers = $db->fetchAll("
    SELECT o.*, p.title as product_title, p.category
    FROM offers o 
    LEFT JOIN products p ON o.product_id = p.id 
    ORDER BY o.created_at DESC 
    LIMIT 10
");

// Aylık istatistikler
$monthlyStats = $db->fetchAll("
    SELECT 
        DATE_FORMAT(created_at, '%Y-%m') as month,
        COUNT(*) as offer_count
    FROM offers
    WHERE created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
    GROUP BY DATE_FORMAT(created_at, '%Y-%m')
    ORDER BY month ASC
");

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İstatistikler - Güçlü Makina</title>
    <link rel="stylesheet" href="admin-style.css">
    <style>
        .period-selector {
            background: white;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            display: flex;
            gap: 1rem;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .period-btn {
            padding: 0.5rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            background: white;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            color: #333;
        }
        .period-btn:hover {
            border-color: #ff6b35;
            background: #fff5f0;
        }
        .period-btn.active {
            border-color: #ff6b35;
            background: #ff6b35;
            color: white;
        }
        .chart-card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        .chart-card h3 {
            margin-bottom: 1.5rem;
            color: #2c3e50;
            border-bottom: 2px solid #ff6b35;
            padding-bottom: 0.5rem;
        }
        .bar-chart {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .bar-item {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .bar-label {
            min-width: 150px;
            font-weight: 500;
        }
        .bar-container {
            flex: 1;
            background: #e0e0e0;
            border-radius: 5px;
            height: 30px;
            position: relative;
            overflow: hidden;
        }
        .bar-fill {
            background: linear-gradient(90deg, #ff6b35, #f7931e);
            height: 100%;
            transition: width 0.5s ease;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-right: 0.5rem;
            color: white;
            font-weight: bold;
            font-size: 0.85rem;
        }
        .stats-grid-large {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .stat-card-large {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            text-align: center;
        }
        .stat-card-large:nth-child(2) {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        .stat-card-large:nth-child(3) {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        .stat-card-large:nth-child(4) {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }
        .stat-card-large h4 {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 0.5rem;
        }
        .stat-card-large .number {
            font-size: 3rem;
            font-weight: bold;
            margin: 0.5rem 0;
        }
        .stat-card-large .label {
            font-size: 0.85rem;
            opacity: 0.8;
        }
        .table-compact {
            font-size: 0.9rem;
        }
        .table-compact th {
            background: #f8f9fa;
            font-weight: 600;
        }
        .trend-indicator {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 5px;
            font-size: 0.75rem;
            font-weight: bold;
        }
        .trend-up {
            background: #d4edda;
            color: #155724;
        }
        .trend-down {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📊 Detaylı İstatistikler</h1>
        <div class="header-right">
            <a href="index.php" class="btn btn-small">← Admin Panel</a>
        </div>
    </div>

    <div class="container">
        <!-- Dönem Seçici -->
        <div class="period-selector">
            <strong>Dönem:</strong>
            <a href="?period=7" class="period-btn <?php echo $dateFilter == '7' ? 'active' : ''; ?>">Son 7 Gün</a>
            <a href="?period=30" class="period-btn <?php echo $dateFilter == '30' ? 'active' : ''; ?>">Son 30 Gün</a>
            <a href="?period=90" class="period-btn <?php echo $dateFilter == '90' ? 'active' : ''; ?>">Son 3 Ay</a>
            <a href="?period=365" class="period-btn <?php echo $dateFilter == '365' ? 'active' : ''; ?>">Son 1 Yıl</a>
        </div>

        <!-- Ana İstatistikler -->
        <div class="stats-grid-large">
            <div class="stat-card-large">
                <h4>TOPLAM ÜRÜN</h4>
                <div class="number"><?php echo $stats['active_products']; ?></div>
                <div class="label">Aktif / <?php echo $stats['total_products']; ?> Toplam</div>
            </div>
            <div class="stat-card-large">
                <h4>TOPLAM GÖRÜNTÜLEME</h4>
                <div class="number"><?php echo number_format($stats['total_views']); ?></div>
                <div class="label">Tüm ürünler</div>
            </div>
            <div class="stat-card-large">
                <h4>TEKLİF TALEPLERİ</h4>
                <div class="number"><?php echo $stats['offers_this_period']; ?></div>
                <div class="label">Son <?php echo $dateFilter; ?> günde</div>
            </div>
            <div class="stat-card-large">
                <h4>YENİ TALEPLER</h4>
                <div class="number"><?php echo $stats['new_offers']; ?></div>
                <div class="label">Bekleyen talepler</div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
            <!-- Kategori Dağılımı -->
            <div class="chart-card">
                <h3>⚙️ Kategori Bazlı Ürün Dağılımı</h3>
                <div class="bar-chart">
                    <?php 
                    $maxCount = !empty($categoryStats) ? max(array_column($categoryStats, 'count')) : 1;
                    foreach ($categoryStats as $cat): 
                        $percentage = ($cat['count'] / $maxCount) * 100;
                    ?>
                        <div class="bar-item">
                            <div class="bar-label"><?php echo htmlspecialchars($cat['category']); ?></div>
                            <div class="bar-container">
                                <div class="bar-fill" style="width: <?php echo $percentage; ?>%;">
                                    <?php echo $cat['count']; ?> ürün
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php if (empty($categoryStats)): ?>
                        <p style="text-align:center;color:#666;padding:2rem;">Henüz kategori verisi yok</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Teklif Türü Dağılımı -->
            <div class="chart-card">
                <h3>📝 Teklif Türü Dağılımı</h3>
                <div class="bar-chart">
                    <?php 
                    $offerTypeNames = [
                        'production' => '⚙️ Parça İmalatı',
                        'repair' => '🔧 Bakım-Onarım',
                        'service' => '🛠️ Teknik Hizmet'
                    ];
                    $maxOffers = !empty($offerTypeStats) ? max(array_column($offerTypeStats, 'count')) : 1;
                    foreach ($offerTypeStats as $offer): 
                        $percentage = ($offer['count'] / $maxOffers) * 100;
                    ?>
                        <div class="bar-item">
                            <div class="bar-label"><?php echo $offerTypeNames[$offer['offer_type']] ?? $offer['offer_type']; ?></div>
                            <div class="bar-container">
                                <div class="bar-fill" style="width: <?php echo $percentage; ?>%;">
                                    <?php echo $offer['count']; ?> teklif
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php if (empty($offerTypeStats)): ?>
                        <p style="text-align:center;color:#666;padding:2rem;">Bu dönemde teklif yok</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- En Çok Görüntülenen Ürünler -->
        <div class="chart-card">
            <h3>🔥 En Çok Görüntülenen Ürünler</h3>
            <div class="table-responsive">
                <table class="table-compact">
                    <thead>
                        <tr>
                            <th>Sıra</th>
                            <th>Ürün</th>
                            <th>Kategori</th>
                            <th>Resim</th>
                            <th>Görüntüleme</th>
                            <th>İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $rank = 1; foreach ($topViewed as $product): ?>
                            <tr>
                                <td><strong><?php echo $rank++; ?></strong></td>
                                <td><?php echo htmlspecialchars($product['title']); ?></td>
                                <td><span style="background:#e9ecef;padding:0.25rem 0.5rem;border-radius:5px;font-size:0.85rem;"><?php echo htmlspecialchars($product['category']); ?></span></td>
                                <td><?php echo $product['image_count']; ?> 📷</td>
                                <td><strong><?php echo number_format($product['views']); ?></strong></td>
                                <td><a href="manage_product.php?id=<?php echo $product['id']; ?>" class="btn btn-small">Düzenle</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Son Teklif Talepleri -->
        <div class="chart-card">
            <h3>📩 Son Teklif Talepleri</h3>
            <div class="table-responsive">
                <table class="table-compact">
                    <thead>
                        <tr>
                            <th>Tarih</th>
                            <th>Tür</th>
                            <th>Müşteri</th>
                            <th>Telefon</th>
                            <th>Ürün/Kategori</th>
                            <th>Durum</th>
                            <th>İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentOffers as $offer): 
                            $statusColors = [
                                'new' => '#ffc107',
                                'contacted' => '#17a2b8',
                                'completed' => '#28a745',
                                'cancelled' => '#dc3545'
                            ];
                            $statusNames = [
                                'new' => 'Yeni',
                                'contacted' => 'Görüşüldü',
                                'completed' => 'Tamamlandı',
                                'cancelled' => 'İptal'
                            ];
                        ?>
                            <tr>
                                <td><?php echo date('d.m.Y H:i', strtotime($offer['created_at'])); ?></td>
                                <td><?php echo $offerTypeNames[$offer['offer_type']] ?? ''; ?></td>
                                <td><?php echo htmlspecialchars($offer['customer_name']); ?></td>
                                <td><a href="tel:<?php echo htmlspecialchars($offer['customer_phone']); ?>"><?php echo htmlspecialchars($offer['customer_phone']); ?></a></td>
                                <td>
                                    <?php if ($offer['product_title']): ?>
                                        <?php echo htmlspecialchars(substr($offer['product_title'], 0, 30)); ?>...
                                    <?php else: ?>
                                        <span style="color:#999;">Genel Talep</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span style="background:<?php echo $statusColors[$offer['status']]; ?>;color:white;padding:0.25rem 0.5rem;border-radius:5px;font-size:0.75rem;font-weight:bold;">
                                        <?php echo $statusNames[$offer['status']]; ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $offer['customer_phone']); ?>" target="_blank" class="btn btn-small btn-success">💬</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Özet Bilgiler -->
        <div class="chart-card">
            <h3>📈 Özet Rapor</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                <div style="background:#f8f9fa;padding:1.5rem;border-radius:10px;border-left:4px solid #ff6b35;">
                    <h4 style="color:#666;font-size:0.9rem;margin-bottom:0.5rem;">Ortalama Görüntüleme</h4>
                    <div style="font-size:2rem;font-weight:bold;color:#2c3e50;">
                        <?php echo $stats['active_products'] > 0 ? number_format($stats['total_views'] / $stats['active_products'], 1) : 0; ?>
                    </div>
                    <small style="color:#999;">Ürün başına</small>
                </div>
                <div style="background:#f8f9fa;padding:1.5rem;border-radius:10px;border-left:4px solid #28a745;">
                    <h4 style="color:#666;font-size:0.9rem;margin-bottom:0.5rem;">Öne Çıkan Ürünler</h4>
                    <div style="font-size:2rem;font-weight:bold;color:#2c3e50;">
                        <?php echo $stats['featured_products']; ?>
                    </div>
                    <small style="color:#999;">Aktif öne çıkan</small>
                </div>
                <div style="background:#f8f9fa;padding:1.5rem;border-radius:10px;border-left:4px solid #17a2b8;">
                    <h4 style="color:#666;font-size:0.9rem;margin-bottom:0.5rem;">Toplam Resim</h4>
                    <div style="font-size:2rem;font-weight:bold;color:#2c3e50;">
                        <?php echo $stats['total_images']; ?>
                    </div>
                    <small style="color:#999;">Galeri resimleri</small>
                </div>
                <div style="background:#f8f9fa;padding:1.5rem;border-radius:10px;border-left:4px solid #dc3545;">
                    <h4 style="color:#666;font-size:0.9rem;margin-bottom:0.5rem;">Dönüşüm Oranı</h4>
                    <div style="font-size:2rem;font-weight:bold;color:#2c3e50;">
                        <?php echo $stats['total_views'] > 0 ? number_format(($stats['offers_this_period'] / $stats['total_views']) * 100, 2) : 0; ?>%
                    </div>
                    <small style="color:#999;">Görüntüleme/Teklif</small>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
session_start();
require_once 'config/database.php';

$db = Database::getInstance();

// Kategori filtresi
$category = $_GET['category'] ?? '';

// Blog yazılarını çek
$sql = "SELECT bp.*, a.full_name as author_name 
        FROM blog_posts bp 
        LEFT JOIN admins a ON bp.author_id = a.id 
        WHERE bp.status = 'published'";

if (!empty($category)) {
    $sql .= " AND bp.category = ?";
    $params = [$category];
} else {
    $params = [];
}

$sql .= " ORDER BY bp.published_at DESC LIMIT 20";
$posts = $db->fetchAll($sql, $params);

// Kategorileri çek
$categories = $db->fetchAll("SELECT * FROM blog_categories ORDER BY name");

// Site ayarları
$settings = [];
$settingsData = $db->fetchAll("SELECT setting_key, setting_value FROM settings");
foreach ($settingsData as $setting) {
    $settings[$setting['setting_key']] = $setting['setting_value'];
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - <?php echo htmlspecialchars($settings['site_title'] ?? 'Güçlü Otomotiv'); ?></title>
    <link rel="stylesheet" href="assets/styles.css">
    <style>
        .blog-container { max-width: 1200px; margin: 2rem auto; padding: 0 2rem; }
        .blog-header { text-align: center; margin-bottom: 3rem; }
        .blog-categories { display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap; margin-bottom: 2rem; }
        .category-btn { padding: 0.6rem 1.2rem; background: white; border: 2px solid #e0e0e0; border-radius: 20px; text-decoration: none; color: #333; transition: all 0.3s; }
        .category-btn:hover, .category-btn.active { background: #ffd700; border-color: #ffd700; color: #1a1a2e; font-weight: bold; }
        .blog-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 2rem; }
        .blog-card { background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); transition: transform 0.3s; }
        .blog-card:hover { transform: translateY(-5px); }
        .blog-card-image { width: 100%; height: 200px; object-fit: cover; background: #e0e0e0; }
        .blog-card-content { padding: 1.5rem; }
        .blog-card-category { display: inline-block; padding: 0.3rem 0.8rem; background: #ffd700; color: #1a1a2e; border-radius: 15px; font-size: 0.85rem; font-weight: bold; margin-bottom: 0.5rem; }
        .blog-card h3 { color: #16213e; margin: 0.5rem 0; }
        .blog-card-excerpt { color: #666; margin: 1rem 0; line-height: 1.6; }
        .blog-card-meta { display: flex; justify-content: space-between; align-items: center; padding-top: 1rem; border-top: 1px solid #e0e0e0; font-size: 0.9rem; color: #999; }
        .blog-card-link { color: #ffd700; font-weight: bold; text-decoration: none; }
        .blog-card-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">🚗 <?php echo htmlspecialchars($settings['site_title'] ?? 'GÜÇLÜ OTOMOTİV'); ?></div>
            <ul class="nav-links">
                <li><a href="index.php">Ana Sayfa</a></li>
                <li><a href="search.php">Araç Ara</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="customer_add_vehicle.php">Araç Ekle</a></li>
                <li><a href="index.php#iletisim">İletişim</a></li>
            </ul>
        </nav>
    </header>

    <div class="blog-container">
        <div class="blog-header">
            <h1 style="color: #16213e; font-size: 2.5rem; margin-bottom: 1rem;">📝 Otomotiv Blogu</h1>
            <p style="color: #666; font-size: 1.1rem;">Araç alım-satım, bakım ve otomotiv dünyasından haberler</p>
        </div>

        <div class="blog-categories">
            <a href="blog.php" class="category-btn <?php echo empty($category) ? 'active' : ''; ?>">Tümü</a>
            <?php foreach ($categories as $cat): ?>
                <a href="?category=<?php echo urlencode($cat['slug']); ?>" 
                   class="category-btn <?php echo $category == $cat['slug'] ? 'active' : ''; ?>">
                    <?php echo htmlspecialchars($cat['name']); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <?php if (empty($posts)): ?>
            <div style="text-align: center; padding: 4rem; background: white; border-radius: 10px;">
                <p style="font-size: 3rem; margin-bottom: 1rem;">📝</p>
                <h3 style="color: #666;">Henüz blog yazısı yok</h3>
                <p style="color: #999; margin-top: 1rem;">Yakında ilginç içerikler paylaşacağız!</p>
            </div>
        <?php else: ?>
            <div class="blog-grid">
                <?php foreach ($posts as $post): ?>
                    <article class="blog-card">
                        <?php if (!empty($post['featured_image'])): ?>
                            <img src="<?php echo htmlspecialchars($post['featured_image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="blog-card-image">
                        <?php else: ?>
                            <div class="blog-card-image" style="display: flex; align-items: center; justify-content: center; font-size: 3rem;">📝</div>
                        <?php endif; ?>
                        
                        <div class="blog-card-content">
                            <?php if (!empty($post['category'])): ?>
                                <span class="blog-card-category"><?php echo htmlspecialchars($post['category']); ?></span>
                            <?php endif; ?>
                            
                            <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                            
                            <?php if (!empty($post['excerpt'])): ?>
                                <p class="blog-card-excerpt"><?php echo htmlspecialchars($post['excerpt']); ?></p>
                            <?php endif; ?>
                            
                            <div class="blog-card-meta">
                                <span>
                                    <?php echo date('d.m.Y', strtotime($post['published_at'])); ?> • 
                                    <?php echo number_format($post['views']); ?> görüntülenme
                                </span>
                                <a href="blog_post.php?slug=<?php echo urlencode($post['slug']); ?>" class="blog-card-link">
                                    Devamını Oku →
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Güçlü Otomotiv. Tüm hakları saklıdır.</p>
        </div>
    </footer>
</body>
</html>
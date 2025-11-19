<?php
session_start();
require_once 'config/database.php';

$db = Database::getInstance();

// Slug ile blog yazısını çek
$slug = $_GET['slug'] ?? '';

if (empty($slug)) {
    header('Location: blog.php');
    exit;
}

$post = $db->fetchOne(
    "SELECT bp.*, a.full_name as author_name, a.email as author_email
     FROM blog_posts bp 
     LEFT JOIN admins a ON bp.author_id = a.id 
     WHERE bp.slug = ? AND bp.status = 'published'",
    [$slug]
);

if (!$post) {
    header('Location: blog.php');
    exit;
}

// Görüntülenme sayısını artır
$db->execute("UPDATE blog_posts SET views = views + 1 WHERE id = ?", [$post['id']]);

// İlgili yazılar (aynı kategoriden)
$relatedPosts = $db->fetchAll(
    "SELECT * FROM blog_posts 
     WHERE category = ? AND id != ? AND status = 'published' 
     ORDER BY published_at DESC LIMIT 3",
    [$post['category'], $post['id']]
);

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
    <title><?php echo htmlspecialchars($post['title']); ?> - <?php echo htmlspecialchars($settings['site_title'] ?? 'Güçlü Otomotiv'); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($post['excerpt'] ?? substr(strip_tags($post['content']), 0, 160)); ?>">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo htmlspecialchars($post['title']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($post['excerpt'] ?? ''); ?>">
    <?php if (!empty($post['featured_image'])): ?>
    <meta property="og:image" content="<?php echo htmlspecialchars($post['featured_image']); ?>">
    <?php endif; ?>
    
    <link rel="stylesheet" href="assets/styles.css">
    <style>
        .blog-post-container { max-width: 900px; margin: 2rem auto; padding: 0 2rem; }
        .blog-post-header { margin-bottom: 2rem; }
        .blog-post-title { font-size: 2.5rem; color: #16213e; margin-bottom: 1rem; line-height: 1.2; }
        .blog-post-meta { display: flex; gap: 2rem; color: #666; margin-bottom: 2rem; flex-wrap: wrap; align-items: center; }
        .blog-post-category { display: inline-block; padding: 0.5rem 1rem; background: #ffd700; color: #1a1a2e; border-radius: 20px; font-weight: bold; }
        .blog-post-image { width: 100%; max-height: 500px; object-fit: cover; border-radius: 15px; margin-bottom: 2rem; }
        .blog-post-content { background: white; padding: 3rem; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); line-height: 1.8; font-size: 1.1rem; }
        .blog-post-content h2 { color: #16213e; margin: 2rem 0 1rem; font-size: 1.8rem; }
        .blog-post-content h3 { color: #16213e; margin: 1.5rem 0 0.75rem; font-size: 1.4rem; }
        .blog-post-content p { margin-bottom: 1.5rem; }
        .blog-post-content ul, .blog-post-content ol { margin: 1rem 0 1.5rem 2rem; }
        .blog-post-content li { margin-bottom: 0.5rem; }
        .blog-post-content blockquote { border-left: 4px solid #ffd700; padding-left: 1.5rem; margin: 2rem 0; font-style: italic; color: #666; }
        .blog-post-content img { max-width: 100%; height: auto; border-radius: 10px; margin: 1.5rem 0; }
        .blog-post-footer { margin-top: 3rem; padding-top: 2rem; border-top: 2px solid #e0e0e0; }
        .blog-share { display: flex; gap: 1rem; align-items: center; }
        .blog-share-btn { padding: 0.8rem 1.5rem; border-radius: 25px; text-decoration: none; color: white; font-weight: bold; display: inline-flex; align-items: center; gap: 0.5rem; transition: transform 0.3s; }
        .blog-share-btn:hover { transform: translateY(-2px); }
        .related-posts { margin-top: 4rem; }
        .related-posts-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-top: 2rem; }
        .related-post-card { background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); transition: transform 0.3s; }
        .related-post-card:hover { transform: translateY(-5px); }
        .related-post-image { width: 100%; height: 150px; object-fit: cover; background: #e0e0e0; }
        .related-post-content { padding: 1.5rem; }
        .author-box { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2rem; border-radius: 15px; margin-top: 3rem; display: flex; gap: 2rem; align-items: center; }
        .author-avatar { width: 80px; height: 80px; border-radius: 50%; background: white; color: #667eea; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: bold; }
        @media (max-width: 768px) {
            .blog-post-title { font-size: 1.8rem; }
            .blog-post-content { padding: 1.5rem; }
            .author-box { flex-direction: column; text-align: center; }
        }
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

    <div class="blog-post-container">
        <div class="blog-post-header">
            <span class="blog-post-category"><?php echo htmlspecialchars($post['category']); ?></span>
            <h1 class="blog-post-title"><?php echo htmlspecialchars($post['title']); ?></h1>
            <div class="blog-post-meta">
                <span>👤 <?php echo htmlspecialchars($post['author_name'] ?? 'Admin'); ?></span>
                <span>📅 <?php echo date('d.m.Y', strtotime($post['published_at'])); ?></span>
                <span>👁️ <?php echo number_format($post['views']); ?> görüntülenme</span>
                <?php if (!empty($post['tags'])): ?>
                    <span>🏷️ <?php echo htmlspecialchars($post['tags']); ?></span>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!empty($post['featured_image'])): ?>
            <img src="<?php echo htmlspecialchars($post['featured_image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="blog-post-image">
        <?php endif; ?>

        <article class="blog-post-content">
            <?php echo $post['content']; ?>
        </article>

        <div class="blog-post-footer">
            <h3 style="margin-bottom: 1rem;">📤 Paylaş:</h3>
            <div class="blog-share">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="blog-share-btn" style="background: #3b5998;">
                    📘 Facebook
                </a>
                <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode($post['title']); ?>&url=<?php echo urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="blog-share-btn" style="background: #1da1f2;">
                    🐦 Twitter
                </a>
                <a href="https://wa.me/?text=<?php echo urlencode($post['title'] . ' - https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="blog-share-btn" style="background: #25D366;">
                    💬 WhatsApp
                </a>
            </div>
        </div>

        <?php if (!empty($post['author_name'])): ?>
        <div class="author-box">
            <div class="author-avatar">
                <?php echo strtoupper(substr($post['author_name'], 0, 1)); ?>
            </div>
            <div>
                <h3 style="margin-bottom: 0.5rem;">Yazar: <?php echo htmlspecialchars($post['author_name']); ?></h3>
                <p style="opacity: 0.9; margin: 0;">Güçlü Otomotiv ekibinden bir üye. Otomotiv sektöründe uzman.</p>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($relatedPosts)): ?>
        <div class="related-posts">
            <h2 style="color: #16213e; margin-bottom: 1rem;">📚 İlgili Yazılar</h2>
            <div class="related-posts-grid">
                <?php foreach ($relatedPosts as $related): ?>
                    <article class="related-post-card">
                        <?php if (!empty($related['featured_image'])): ?>
                            <img src="<?php echo htmlspecialchars($related['featured_image']); ?>" alt="<?php echo htmlspecialchars($related['title']); ?>" class="related-post-image">
                        <?php else: ?>
                            <div class="related-post-image" style="display: flex; align-items: center; justify-content: center; font-size: 2rem;">📝</div>
                        <?php endif; ?>
                        <div class="related-post-content">
                            <h3 style="font-size: 1.1rem; margin-bottom: 0.5rem;">
                                <a href="blog_post.php?slug=<?php echo urlencode($related['slug']); ?>" style="color: #16213e; text-decoration: none;">
                                    <?php echo htmlspecialchars($related['title']); ?>
                                </a>
                            </h3>
                            <p style="font-size: 0.9rem; color: #666;">
                                <?php echo date('d.m.Y', strtotime($related['published_at'])); ?>
                            </p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <div style="text-align: center; margin-top: 3rem;">
            <a href="blog.php" class="btn">← Blog'a Dön</a>
            <a href="index.php" class="btn" style="background: #6c757d; color: white;">🏠 Ana Sayfa</a>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Güçlü Otomotiv. Tüm hakları saklıdır.</p>
        </div>
    </footer>
</body>
</html>
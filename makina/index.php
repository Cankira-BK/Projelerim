<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
ob_start();

try {
    require_once __DIR__ . '/config/database.php';
    $db = Database::getInstance();
} catch (Exception $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}

$settings = [];
try {
    $settingsData = $db->fetchAll("SELECT setting_key, setting_value FROM settings");
    foreach ($settingsData as $setting) {
        $settings[$setting['setting_key']] = $setting['setting_value'];
    }
} catch (Exception $e) {
    $settings = [
        'site_title' => 'Güçlü Makina', 
        'site_phone' => '0328 123 45 67', 
        'site_mobile' => '0532 123 45 67',
        'site_email' => 'info@guclumakina.com', 
        'site_address' => 'Organize Sanayi Bölgesi, 5. Cadde No: 42, Osmaniye',
        'whatsapp_number' => '905321234567',
        'facebook_url' => '#', 
        'instagram_url' => '#', 
        'youtube_url' => '#'
    ];
}

$featuredProducts = [];
try {
    $featuredProducts = $db->fetchAll("SELECT * FROM products WHERE is_featured = 1 AND status = 'active' ORDER BY created_at DESC LIMIT 5");
} catch (Exception $e) {
    error_log("Featured products error: " . $e->getMessage());
}

$features = [];
$services = [];
$testimonials = [];
try {
    $features = $db->fetchAll("SELECT * FROM features WHERE is_active = 1 ORDER BY display_order ASC");
    $services = $db->fetchAll("SELECT * FROM services WHERE is_active = 1 ORDER BY display_order ASC");
    $testimonials = $db->fetchAll("SELECT * FROM testimonials WHERE is_active = 1 ORDER BY display_order ASC");
} catch (Exception $e) {
    error_log("Content load error: " . $e->getMessage());
}

$latestProducts = [];
try {
    $latestProducts = $db->fetchAll("SELECT * FROM products WHERE status = 'active' ORDER BY created_at DESC LIMIT 6");
    foreach ($latestProducts as &$product) {
        $product['images'] = $db->fetchAll("SELECT * FROM product_images WHERE product_id = ? ORDER BY is_primary DESC, display_order ASC", [$product['id']]);
    }
} catch (Exception $e) {
    error_log("Latest products error: " . $e->getMessage());
}

if (isset($_GET['view_product']) && is_numeric($_GET['view_product'])) {
    try { 
        $db->execute("UPDATE products SET views = views + 1 WHERE id = ?", [(int)$_GET['view_product']]); 
    } catch (Exception $e) { 
        error_log("View increment error: " . $e->getMessage()); 
    }
    http_response_code(200); 
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($settings['site_title']); ?> - Torna, Makina Bakım ve Yedek Parça İmalatı</title>
    <meta name="description" content="Profesyonel torna hizmeti, CNC işleme, makina bakım-onarım ve endüstriyel yedek parça imalatı. 20 yıllık deneyim.">
    <meta name="theme-color" content="#2c3e50">
    
    <!-- Preconnect -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/styles.css">
    
    <style>
        .hero-slider{width:100%;height:600px;position:relative}.swiper{width:100%;height:100%}.swiper-slide{background-size:cover;background-position:center;position:relative}.swiper-slide::before{content:'';position:absolute;top:0;left:0;right:0;bottom:0;background:linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.6));z-index:1}.slide-content{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;color:white;z-index:10;width:90%;max-width:800px}.slide-content h2{font-size:2.5rem;margin-bottom:1rem;text-shadow:2px 2px 4px rgba(0,0,0,0.5)}.slide-content .price{font-size:2rem;color:#ff6b35;font-weight:bold;margin:1rem 0}.slide-content .details{font-size:1.2rem;margin:1rem 0}.slide-content .btn-group{display:flex;gap:1rem;justify-content:center;margin-top:2rem;flex-wrap:wrap}.swiper-button-next,.swiper-button-prev{color:#ff6b35}.swiper-pagination-bullet-active{background:#ff6b35}
        .product-image-slider{position:relative;width:100%;height:200px;overflow:hidden}.product-swiper{width:100%;height:100%}.product-swiper .swiper-slide{height:200px}.product-swiper .swiper-slide img{width:100%;height:100%;object-fit:cover}.product-swiper .swiper-button-next,.product-swiper .swiper-button-prev{width:30px;height:30px;background:rgba(0,0,0,0.6);border-radius:50%;color:white}.product-swiper .swiper-button-next:after,.product-swiper .swiper-button-prev:after{font-size:14px}.product-swiper .swiper-pagination{bottom:5px}.product-swiper .swiper-pagination-bullet{width:8px;height:8px;background:white;opacity:0.7}.product-swiper .swiper-pagination-bullet-active{background:#ff6b35;opacity:1}.image-count-badge{position:absolute;top:10px;left:10px;background:rgba(0,0,0,0.7);color:white;padding:5px 10px;border-radius:5px;font-size:0.85rem;z-index:10;display:flex;align-items:center;gap:5px}
        .modal{display:none;position:fixed;z-index:10000;left:0;top:0;width:100%;height:100%;background:rgba(0,0,0,0.8);overflow-y:auto}.modal-content{background:white;margin:2rem auto;padding:2rem;border-radius:15px;max-width:600px;width:90%;position:relative}.modal-close{position:absolute;right:1rem;top:1rem;font-size:2rem;cursor:pointer;color:#666;line-height:1}.modal-close:hover{color:#000}.offer-type-selector{display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:1rem;margin:2rem 0}.offer-type-card{padding:1.5rem;border:2px solid #e0e0e0;border-radius:10px;text-align:center;cursor:pointer;transition:all 0.3s}.offer-type-card:hover,.offer-type-card.active{border-color:#ff6b35;background:#fff5f0}.offer-type-card .icon{font-size:3rem;margin-bottom:0.5rem}.form-group{margin-bottom:1rem}.form-group label{display:block;margin-bottom:0.5rem;font-weight:500;color:#333}.form-group input,.form-group textarea{width:100%;padding:0.8rem;border:2px solid #e0e0e0;border-radius:8px;font-family:inherit}.form-group input:focus,.form-group textarea:focus{outline:none;border-color:#ff6b35}
        @media (max-width:768px){.hero-slider{height:400px}.slide-content h2{font-size:1.5rem}.slide-content .price{font-size:1.5rem}.nav-links{display:none}}
    </style>
</head>
<body>
<header>
        <nav>
            <div class="logo">⚙️ <?php echo strtoupper(htmlspecialchars($settings['site_logo_text'] ?? $settings['site_title'])); ?></div>
            <ul class="nav-links">
                <li><a href="#anasayfa">Ana Sayfa</a></li>
                <li><a href="#urunler">Ürünler & Parçalar</a></li>
                <li><a href="#hizmetler">Hizmetler</a></li>
                <li><a href="#referanslar">Referanslar</a></li>
                <li><a href="#iletisim">İletişim</a></li>
                <li><a href="#" onclick="openOfferModal();return false;" style="background:#ff6b35;color:#fff;padding:0.5rem 1rem;border-radius:5px;font-weight:bold">📝 Teklif Al</a></li>
            </ul>
        </nav>
    </header>

    <?php if(isset($settings['hero_slider_enabled']) && $settings['hero_slider_enabled'] == '1' && !empty($featuredProducts)): ?>
    <section class="hero-slider" id="anasayfa">
        <div class="swiper heroSwiper">
            <div class="swiper-wrapper">
                <?php foreach($featuredProducts as $product): ?>
                    <div class="swiper-slide" style="background-image:url('<?php echo htmlspecialchars($product['image']); ?>')">
                        <div class="slide-content">
                            <h2><?php echo htmlspecialchars($product['title']); ?></h2>
                            <div class="details">
                                <span>⚙️ <?php echo htmlspecialchars($product['category']); ?></span> • 
                                <span>📏 <?php echo htmlspecialchars($product['specifications']); ?></span>
                            </div>
                            <div class="btn-group">
                                <a href="#" onclick="openOfferModal(<?php echo $product['id']; ?>,'<?php echo addslashes($product['title']); ?>');return false;" class="btn">Fiyat Teklifi Al</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <?php else: ?>
    <section class="hero-slider" id="anasayfa" style="height:500px">
        <div style="width:100%;height:100%;background:linear-gradient(135deg,#2c3e50 0%,#34495e 100%);display:flex;align-items:center;justify-content:center">
            <div class="slide-content">
                <h2 style="font-size:2.8rem;margin-bottom:1rem"><?php echo htmlspecialchars($settings['banner_title'] ?? 'Hassas İşçilik, Güvenilir Çözümler'); ?></h2>
                <p style="font-size:1.4rem;margin:1rem 0"><?php echo htmlspecialchars($settings['banner_subtitle'] ?? '20 Yıllık Deneyim ile Torna, CNC İşleme ve Makina Bakım Hizmetleri'); ?></p>
                <a href="<?php echo htmlspecialchars($settings['banner_button_url'] ?? '#hizmetler'); ?>" class="btn"><?php echo htmlspecialchars($settings['banner_button_text'] ?? 'Hizmetlerimizi Keşfedin'); ?></a>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section class="trust-badges">
        <div class="container">
            <h2 class="section-title">Neden Güçlü Makina?</h2>
            <div class="badges-grid">
                <?php if(!empty($features)): foreach($features as $feature): ?>
                    <div class="badge-card fade-in">
                        <div class="badge-icon"><?php echo htmlspecialchars($feature['icon']); ?></div>
                        <h3><?php echo htmlspecialchars($feature['title']); ?></h3>
                        <p><?php echo htmlspecialchars($feature['description']); ?></p>
                    </div>
                <?php endforeach; else: ?>
                    <div class="badge-card fade-in"><div class="badge-icon">⚙️</div><h3>İleri Teknoloji</h3><p>Son model CNC torna ve freze makineleri ile hassas üretim</p></div>
                    <div class="badge-card fade-in"><div class="badge-icon">🔧</div><h3>Deneyimli Ekip</h3><p>20 yıllık tecrübeli ustalar ve teknik ekip</p></div>
                    <div class="badge-card fade-in"><div class="badge-icon">⚡</div><h3>Hızlı Teslimat</h3><p>Acil işleriniz için aynı gün teslimat imkanı</p></div>
                    <div class="badge-card fade-in"><div class="badge-icon">✓</div><h3>Kalite Garantisi</h3><p>Ölçü ve dayanıklılık garantili üretim</p></div>
                <?php endif; ?>
            </div>
        </div>
    </section>
	<section class="section" id="urunler">
        <div class="container">
            <h2 class="section-title">Ürün ve Hizmet Portföyümüz</h2>
            <div class="vehicles-grid">
                <?php if(!empty($latestProducts)): foreach($latestProducts as $product): ?>
                    <div class="vehicle-card fade-in" onclick="trackView(<?php echo $product['id']; ?>)">
                        <div class="product-image-slider">
                            <?php if(!empty($product['images']) && count($product['images'])>0): ?>
                                <?php if(count($product['images'])>1): ?>
                                    <div class="image-count-badge">📷 <?php echo count($product['images']); ?> Resim</div>
                                <?php endif; ?>
                                <div class="swiper product-swiper product-swiper-<?php echo $product['id']; ?>">
                                    <div class="swiper-wrapper">
                                        <?php foreach($product['images'] as $img): ?>
                                            <div class="swiper-slide">
                                                <img src="<?php echo htmlspecialchars($img['image_url']); ?>" alt="<?php echo htmlspecialchars($product['title']); ?>" loading="lazy" decoding="async">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php if(count($product['images'])>1): ?>
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                        <div class="swiper-pagination"></div>
                                    <?php endif; ?>
                                </div>
                            <?php else: ?>
                                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['title']); ?>" style="width:100%;height:200px;object-fit:cover" loading="lazy" decoding="async">
                            <?php endif; ?>
                            <?php if($product['is_featured']): ?>
                                <span style="position:absolute;top:10px;right:10px;background:#ff6b35;color:#fff;padding:5px 10px;border-radius:5px;font-weight:bold;z-index:10">⭐ Öne Çıkan</span>
                            <?php endif; ?>
                        </div>
                        <div class="vehicle-info">
                            <h3><?php echo htmlspecialchars($product['title']); ?></h3>
                            <div class="vehicle-details">
                                <span>⚙️ <?php echo htmlspecialchars($product['category']); ?></span>
                                <span>📏 <?php echo htmlspecialchars($product['specifications']); ?></span>
                            </div>
                            <div style="display:flex;gap:0.5rem;margin-top:1rem">
                                <a href="#" onclick="event.stopPropagation();openOfferModal(<?php echo $product['id']; ?>,'<?php echo addslashes($product['title']); ?>');return false;" class="btn" style="flex:1;text-align:center;background:#ff6b35;font-size:0.9rem;color:white">💬 Fiyat Teklifi Al</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; else: ?>
                    <p style="text-align:center;grid-column:1/-1;color:#666">Ürün portföyümüz yakında güncellenecek...</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="section services" id="hizmetler">
        <div class="container">
            <h2 class="section-title">Hizmetlerimiz</h2>
            <div class="services-grid">
                <?php if(!empty($services)): foreach($services as $service): ?>
                    <div class="service-card fade-in">
                        <h3><?php echo htmlspecialchars($service['icon']); ?> <?php echo htmlspecialchars($service['title']); ?></h3>
                        <p><?php echo htmlspecialchars($service['description']); ?></p>
                    </div>
                <?php endforeach; else: ?>
                    <div class="service-card fade-in"><h3>⚙️ CNC Torna İşleme</h3><p>Hassas ölçülerde torna, yüzey tornalama ve diş açma işlemleri</p></div>
                    <div class="service-card fade-in"><h3>🔧 CNC Freze</h3><p>Karmaşık geometrilerde frezeleme ve delme operasyonları</p></div>
                    <div class="service-card fade-in"><h3>🛠️ Makina Bakım-Onarım</h3><p>Tüm sanayi makinelerinin periyodik bakım ve arıza onarımı</p></div>
                    <div class="service-card fade-in"><h3>📐 Yedek Parça İmalatı</h3><p>Teknik resme göre özel yedek parça üretimi</p></div>
                    <div class="service-card fade-in"><h3>⚡ Kaynak İşleri</h3><p>TIG, MIG/MAG ve elektrod kaynağı ile onarım ve imalat</p></div>
                    <div class="service-card fade-in"><h3>🔩 Montaj Hizmeti</h3><p>Makina ve ekipman montaj, revizyon ve iyileştirme çalışmaları</p></div>
                <?php endif; ?>
            </div>
        </div>
    </section>
	<section class="section testimonials" id="referanslar">
        <div class="container">
            <h2 class="section-title" style="color:white">Müşteri Referansları</h2>
            <?php if(!empty($testimonials)): foreach($testimonials as $testimonial): ?>
                <div class="testimonial-card fade-in">
                    <p>"<?php echo htmlspecialchars($testimonial['comment']); ?>"</p>
                    <div class="testimonial-author">- <?php echo htmlspecialchars($testimonial['customer_name']); ?><?php if(!empty($testimonial['customer_title'])): ?>, <?php echo htmlspecialchars($testimonial['customer_title']); ?><?php endif; ?></div>
                </div>
            <?php endforeach; else: ?>
                <div class="testimonial-card fade-in"><p>"Acil bir parça ihtiyacımız olduğunda aynı gün içinde üretip teslim ettiler. Kaliteli işçilik ve güvenilir hizmet."</p><div class="testimonial-author">- Ahmet Demir, Üretim Müdürü - ABC Tekstil</div></div>
                <div class="testimonial-card fade-in"><p>"20 yıldır makina bakımlarımızı yaptırıyoruz. Profesyonel ekip ve uygun fiyatlar."</p><div class="testimonial-author">- Fatma Yıldız, İşletme Sahibi - Yıldız Gıda</div></div>
                <div class="testimonial-card fade-in"><p>"CNC torna işlemlerinde hassasiyet ve zamanında teslimat konusunda çok memnunuz."</p><div class="testimonial-author">- Mehmet Kaya, Teknik Şef - DEF Otomotiv</div></div>
            <?php endif; ?>
        </div>
    </section>

    <section class="section contact" id="iletisim">
        <div class="container">
            <h2 class="section-title">İletişim</h2>
            <div class="contact-grid">
                <div class="contact-info fade-in">
                    <h3>Bize Ulaşın</h3>
                    <div class="contact-item"><span>📍</span><span><?php echo htmlspecialchars($settings['site_address']); ?></span></div>
                    <div class="contact-item"><span>📞</span><span><?php echo htmlspecialchars($settings['site_phone']); ?></span></div>
                    <div class="contact-item"><span>📱</span><span><?php echo htmlspecialchars($settings['site_mobile']); ?></span></div>
                    <div class="contact-item"><span>✉️</span><span><?php echo htmlspecialchars($settings['site_email']); ?></span></div>
                    <div style="margin-top:2rem"><a href="https://wa.me/<?php echo htmlspecialchars($settings['whatsapp_number']); ?>" class="whatsapp-btn" target="_blank" rel="noopener">💬 WhatsApp ile İletişime Geç</a></div>
                </div>
                <div class="contact-info fade-in">
                    <h3>Çalışma Saatlerimiz</h3>
                    <div class="contact-item"><span>🕐</span><span>Pazartesi - Cumartesi: 08:00 - 18:00</span></div>
                    <div class="contact-item"><span>🕐</span><span>Pazar: Kapalı (Acil durumlarda arayınız)</span></div>
                    <div style="margin-top:2rem">
                        <h3>Sosyal Medya</h3>
                        <div style="display:flex;gap:1rem;margin-top:1rem">
                            <a href="<?php echo htmlspecialchars($settings['facebook_url']); ?>" style="color:#2c3e50;font-size:2rem" aria-label="Facebook" rel="noopener" target="_blank">📘</a>
                            <a href="<?php echo htmlspecialchars($settings['instagram_url']); ?>" style="color:#2c3e50;font-size:2rem" aria-label="Instagram" rel="noopener" target="_blank">📸</a>
                            <a href="<?php echo htmlspecialchars($settings['youtube_url']); ?>" style="color:#2c3e50;font-size:2rem" aria-label="YouTube" rel="noopener" target="_blank">🎥</a>
                        </div>
                    </div>
                </div>
                <div class="contact-info fade-in">
                    <h3>Acil Durum Hattı</h3>
                    <p>7/24 arıza onarım ve acil parça üretimi için bizimle iletişime geçebilirsiniz.</p>
                    <div class="contact-item" style="margin-top:1rem"><span>🚨</span><span style="color:#ff6b35;font-weight:bold"><?php echo htmlspecialchars($settings['site_mobile']); ?></span></div>
                </div>
            </div>
        </div>
    </section>

    <div id="offerModal" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeOfferModal()">&times;</span>
            <h2 style="color:#2c3e50">Teklif Talebi / İş Emri</h2>
            <div class="offer-type-selector">
                <div class="offer-type-card" onclick="selectOfferType('production')"><div class="icon">⚙️</div><h3>Parça İmalatı</h3></div>
                <div class="offer-type-card" onclick="selectOfferType('repair')"><div class="icon">🔧</div><h3>Bakım-Onarım</h3></div>
                <div class="offer-type-card" onclick="selectOfferType('service')"><div class="icon">🛠️</div><h3>Teknik Hizmet</h3></div>
            </div>
            <form id="offerForm">
                <input type="hidden" id="offerType" name="offer_type">
                <input type="hidden" id="productId" name="product_id">
                <div class="form-group"><label>Firma/Adınız *</label><input type="text" name="customer_name" required></div>
                <div class="form-group"><label>Telefon *</label><input type="tel" name="customer_phone" required placeholder="05XX XXX XX XX"></div>
                <div class="form-group"><label>E-posta</label><input type="email" name="customer_email"></div>
                <div class="form-group" id="projectInfoGroup" style="display:none"><label>İş Detayları / Teknik Özellikler</label><textarea name="project_info" rows="3" placeholder="Ölçüler, malzeme, adet bilgisi..."></textarea></div>
                <div class="form-group"><label>Ek Notlar</label><textarea name="message" rows="4"></textarea></div>
                <button type="submit" class="btn" style="width:100%;background:#ff6b35">WhatsApp'tan Teklif Al 💬</button>
            </form>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Güçlü Makina. Tüm hakları saklıdır.</p>
            <p>Hassas İşçilik - Kaliteli Üretim - Güvenilir Hizmet</p>
        </div>
    </footer>
	<script>
let selectedOfferType=null,currentProductTitle=null;

function openOfferModal(productId,title){
    const modal=document.getElementById('offerModal');
    modal.style.display='block';
    selectedOfferType=null;
    currentProductTitle=title||'';
    document.getElementById('offerType').value='';
    document.getElementById('productId').value=productId||'';
    document.querySelectorAll('.offer-type-card').forEach(el=>el.classList.remove('active'));
    document.getElementById('projectInfoGroup').style.display='none';
}

function closeOfferModal(){
    document.getElementById('offerModal').style.display='none';
}

function selectOfferType(type){
    selectedOfferType=type;
    document.getElementById('offerType').value=type;
    document.querySelectorAll('.offer-type-card').forEach(el=>el.classList.remove('active'));
    document.querySelector(`.offer-type-card[onclick="selectOfferType('${type}')"]`).classList.add('active');
    document.getElementById('projectInfoGroup').style.display='block';
}

document.getElementById('offerForm').addEventListener('submit',function(e){
    e.preventDefault();
    if(!selectedOfferType){alert('Lütfen bir hizmet türü seçin');return}
    const formData=new FormData(this);
    const name=formData.get('customer_name'),phone=formData.get('customer_phone'),message=formData.get('message')||'',projectInfo=formData.get('project_info')||'';
    let whatsappText='Merhaba, Güçlü Makina!\n\n';
    if(selectedOfferType==='production'){whatsappText+='⚙️ *Parça İmalatı Talebi*\n\n';if(currentProductTitle)whatsappText+='İlgili Ürün: '+currentProductTitle+'\n'}
    else if(selectedOfferType==='repair'){whatsappText+='🔧 *Bakım-Onarım Talebi*\n\n'}
    else if(selectedOfferType==='service'){whatsappText+='🛠️ *Teknik Hizmet Talebi*\n\n'}
    if(projectInfo)whatsappText+='İş Detayları: '+projectInfo+'\n';
    whatsappText+='\nFirma/Ad: '+name+'\nTelefon: '+phone+'\n';if(message)whatsappText+='\nEk Notlar: '+message;
    const whatsappNumber='<?php echo htmlspecialchars($settings['whatsapp_number']); ?>';
    const whatsappUrl='https://wa.me/'+whatsappNumber+'?text='+encodeURIComponent(whatsappText);
    fetch('api/save_offer.php',{method:'POST',body:formData}).finally(()=>{window.open(whatsappUrl,'_blank');closeOfferModal()});
});

window.onclick=function(event){
    if(event.target==document.getElementById('offerModal'))closeOfferModal();
}
</script>
</body>
</html>

</body>
</html>
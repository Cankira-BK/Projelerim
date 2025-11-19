<?php
// Hata raporlama (geliştirme aşamasında)
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Veritabanı bağlantısı
try {
    require_once __DIR__ . '/config/database.php';
    $db = Database::getInstance();
} catch (Exception $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}

// Site ayarlarını çek
$settings = [];
try {
    $settingsData = $db->fetchAll("SELECT setting_key, setting_value FROM settings");
    foreach ($settingsData as $setting) {
        $settings[$setting['setting_key']] = $setting['setting_value'];
    }
} catch (Exception $e) {
    // Hata durumunda varsayılan değerler
    $settings = [
        'site_title' => 'Güçlü Otomotiv',
        'site_phone' => '0328 123 45 67',
        'site_mobile' => '0532 123 45 67',
        'site_email' => 'info@gucluotomotiv.com',
        'site_address' => 'Atatürk Cad. No: 123, Merkez / Osmaniye',
        'whatsapp_number' => '905321234567',
        'sahibinden_profile' => 'https://gucluotomotivosmaniye.sahibinden.com/',
        'facebook_url' => '#',
        'instagram_url' => '#',
        'youtube_url' => '#'
    ];
}

// Öne çıkan araçları çek (slider için)
$featuredVehicles = [];
try {
    $featuredVehicles = $db->fetchAll(
        "SELECT * FROM vehicles WHERE is_featured = 1 AND status = 'active' ORDER BY created_at DESC LIMIT 5"
    );
} catch (Exception $e) {
    error_log("Featured vehicles error: " . $e->getMessage());
}

// Son 6 aracı çek
$latestVehicles = [];
try {
    $latestVehicles = $db->fetchAll(
        "SELECT * FROM vehicles WHERE status = 'active' ORDER BY created_at DESC LIMIT 6"
    );
} catch (Exception $e) {
    error_log("Latest vehicles error: " . $e->getMessage());
}

// Görüntülenme sayısı artır (AJAX)
if (isset($_GET['view_vehicle']) && is_numeric($_GET['view_vehicle'])) {
    try {
        $db->execute("UPDATE vehicles SET views = views + 1 WHERE id = ?", [(int)$_GET['view_vehicle']]);
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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($settings['site_title']); ?> - Güvenilir İkinci El Araç Alım Satım</title>
    <meta name="description" content="20 yıllık tecrübe ile güvenilir ikinci el araç alım satım. Takas, ekspertiz ve kredi imkanları.">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    <!-- Ana CSS -->
    <link rel="stylesheet" href="assets/styles.css" />
    
    <style>
        .hero-slider { width: 100%; height: 600px; position: relative; }
        .swiper { width: 100%; height: 100%; }
        .swiper-slide { background-size: cover; background-position: center; position: relative; }
        .swiper-slide::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)); z-index: 1; }
        .slide-content { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: white; z-index: 10; width: 90%; max-width: 800px; }
        .slide-content h2 { font-size: 2.5rem; margin-bottom: 1rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); }
        .slide-content .price { font-size: 2rem; color: #ffd700; font-weight: bold; margin: 1rem 0; }
        .slide-content .details { font-size: 1.2rem; margin: 1rem 0; }
        .slide-content .btn-group { display: flex; gap: 1rem; justify-content: center; margin-top: 2rem; flex-wrap: wrap; }
        .swiper-button-next, .swiper-button-prev { color: #ffd700; }
        .swiper-pagination-bullet-active { background: #ffd700; }
        
        .modal { display: none; position: fixed; z-index: 10000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); overflow-y: auto; }
        .modal-content { background: white; margin: 2rem auto; padding: 2rem; border-radius: 15px; max-width: 600px; width: 90%; position: relative; }
        .modal-close { position: absolute; right: 1rem; top: 1rem; font-size: 2rem; cursor: pointer; color: #666; line-height: 1; }
        .modal-close:hover { color: #000; }
        .offer-type-selector { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem; margin: 2rem 0; }
        .offer-type-card { padding: 1.5rem; border: 2px solid #e0e0e0; border-radius: 10px; text-align: center; cursor: pointer; transition: all 0.3s; }
        .offer-type-card:hover, .offer-type-card.active { border-color: #ffd700; background: #fff9e6; }
        .offer-type-card .icon { font-size: 3rem; margin-bottom: 0.5rem; }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; font-weight: 500; color: #333; }
        .form-group input, .form-group textarea { width: 100%; padding: 0.8rem; border: 2px solid #e0e0e0; border-radius: 8px; font-family: inherit; }
        .form-group input:focus, .form-group textarea:focus { outline: none; border-color: #ffd700; }
        
        @media (max-width: 768px) {
            .hero-slider { height: 400px; }
            .slide-content h2 { font-size: 1.5rem; }
            .slide-content .price { font-size: 1.5rem; }
            .nav-links { display: none; }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">🚗 <?php echo strtoupper(htmlspecialchars($settings['site_title'])); ?></div>
            <ul class="nav-links">
                <li><a href="#anasayfa">Ana Sayfa</a></li>
                <li><a href="#araclar">Araçlar</a></li>
                <li><a href="#hizmetler">Hizmetler</a></li>
                <li><a href="#yorumlar">Yorumlar</a></li>
                <li><a href="#iletisim">İletişim</a></li>
                <li><a href="#" onclick="openOfferModal(); return false;" style="background: #ffd700; color: #1a1a2e; padding: 0.5rem 1rem; border-radius: 5px; font-weight: bold;">📝 Teklif Ver</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Slider -->
    <section class="hero-slider" id="anasayfa">
        <div class="swiper heroSwiper">
            <div class="swiper-wrapper">
                <?php if (!empty($featuredVehicles)): ?>
                    <?php foreach ($featuredVehicles as $vehicle): ?>
                        <div class="swiper-slide" style="background-image: url('<?php echo htmlspecialchars($vehicle['image']); ?>');">
                            <div class="slide-content">
                                <h2><?php echo htmlspecialchars($vehicle['title']); ?></h2>
                                <div class="price"><?php echo htmlspecialchars($vehicle['price']); ?></div>
                                <div class="details">
                                    <span>📅 <?php echo htmlspecialchars($vehicle['year']); ?></span> • 
                                    <span>🛣️ <?php echo htmlspecialchars($vehicle['km']); ?></span> • 
                                    <span>⛽ <?php echo htmlspecialchars($vehicle['fuel']); ?></span>
                                </div>
                                <div class="btn-group">
                                    <?php if (!empty($vehicle['sahibinden_link'])): ?>
                                    <a href="<?php echo htmlspecialchars($vehicle['sahibinden_link']); ?>" target="_blank" class="btn">Detaylı İncele</a>
                                    <?php endif; ?>
                                    <a href="#" onclick="openOfferModal(<?php echo $vehicle['id']; ?>, '<?php echo addslashes($vehicle['title']); ?>'); return false;" class="btn">Teklif Ver</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="swiper-slide" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);">
                        <div class="slide-content">
                            <h2>Güvenle Alın, Huzurla Sürün</h2>
                            <p style="font-size: 1.3rem; margin: 1rem 0;">20 Yıllık Tecrübe ile İkinci El Araç Alım Satım</p>
                            <a href="#araclar" class="btn">Araçları İncele</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <section class="trust-badges">
        <div class="container">
            <h2 class="section-title">Neden Güçlü Otomotiv?</h2>
            <div class="badges-grid">
                <div class="badge-card">
                    <div class="badge-icon">✓</div>
                    <h3>2000+ Mutlu Müşteri</h3>
                    <p>20 yıldır binlerce müşterimize güvenilir hizmet sunuyoruz</p>
                </div>
                <div class="badge-card">
                    <div class="badge-icon">🔍</div>
                    <h3>Ekspertiz Garantisi</h3>
                    <p>Tüm araçlarımız detaylı ekspertiz kontrolünden geçer</p>
                </div>
                <div class="badge-card">
                    <div class="badge-icon">🤝</div>
                    <h3>Takas İmkanı</h3>
                    <p>Aracınızı değerinde değerlendirip takas yapabilirsiniz</p>
                </div>
                <div class="badge-card">
                    <div class="badge-icon">📋</div>
                    <h3>Tüm İşlemler</h3>
                    <p>Ruhsat, noter, sigorta işlemlerinizi biz hallederiz</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="araclar">
        <div class="container">
            <h2 class="section-title">Vitrinimizden Seçmeler</h2>
            <div class="vehicles-grid">
                <?php if (!empty($latestVehicles)): ?>
                    <?php foreach ($latestVehicles as $vehicle): ?>
                        <div class="vehicle-card" onclick="trackView(<?php echo $vehicle['id']; ?>)">
                            <div class="vehicle-image">
                                <img src="<?php echo htmlspecialchars($vehicle['image']); ?>" 
                                     alt="<?php echo htmlspecialchars($vehicle['title']); ?>"
                                     onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 400 300%22%3E%3Crect fill=%22%23e0e0e0%22 width=%22400%22 height=%22300%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 font-size=%2224%22 fill=%22%23999%22 text-anchor=%22middle%22 dominant-baseline=%22middle%22%3EResim Yüklenemedi%3C/text%3E%3C/svg%3E'">
                                <?php if ($vehicle['is_featured']): ?>
                                    <span style="position: absolute; top: 10px; right: 10px; background: #ffd700; color: #000; padding: 5px 10px; border-radius: 5px; font-weight: bold;">⭐ Öne Çıkan</span>
                                <?php endif; ?>
                            </div>
                            <div class="vehicle-info">
                                <h3><?php echo htmlspecialchars($vehicle['title']); ?></h3>
                                <div class="vehicle-price"><?php echo htmlspecialchars($vehicle['price']); ?></div>
                                <div class="vehicle-details">
                                    <span><?php echo htmlspecialchars($vehicle['year']); ?></span>
                                    <span><?php echo htmlspecialchars($vehicle['km']); ?></span>
                                    <span><?php echo htmlspecialchars($vehicle['fuel']); ?></span>
                                </div>
                                <div style="display: flex; gap: 0.5rem; margin-top: 1rem;">
                                    <?php if (!empty($vehicle['sahibinden_link'])): ?>
                                    <a href="<?php echo htmlspecialchars($vehicle['sahibinden_link']); ?>" target="_blank" class="btn" style="flex: 1; text-align: center; font-size: 0.9rem;">Detaylar</a>
                                    <?php endif; ?>
                                    <a href="#" onclick="openOfferModal(<?php echo $vehicle['id']; ?>, '<?php echo addslashes($vehicle['title']); ?>'); return false;" class="btn" style="flex: 1; text-align: center; background: #25D366; font-size: 0.9rem; color: white;">💬 Teklif</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="text-align: center; grid-column: 1 / -1; color: #666;">Yakında yeni araçlar eklenecek...</p>
                <?php endif; ?>
            </div>
            <div style="text-align: center; margin-top: 3rem;">
                <a href="<?php echo htmlspecialchars($settings['sahibinden_profile']); ?>" target="_blank" class="btn">Tüm Araçları Görüntüle</a>
            </div>
        </div>
    </section>

    <section class="section services" id="hizmetler">
        <div class="container">
            <h2 class="section-title">Hizmetlerimiz</h2>
            <div class="services-grid">
                <div class="service-card"><h3>🚗 Araç Alım-Satım</h3><p>Geniş araç yelpazemizden size en uygun aracı bulun.</p></div>
                <div class="service-card"><h3>🔄 Takas</h3><p>Mevcut aracınızı en iyi fiyattan değerlendirip takas edebilirsiniz.</p></div>
                <div class="service-card"><h3>🔍 Ekspertiz</h3><p>Detaylı ekspertiz raporu ile güvenle alın.</p></div>
                <div class="service-card"><h3>💰 Kredi Desteği</h3><p>Uygun faiz oranlarında araç kredisi imkanı.</p></div>
                <div class="service-card"><h3>📋 İşlem Kolaylığı</h3><p>Tüm işlemlerinizi biz hallederiz.</p></div>
                <div class="service-card"><h3>💼 Danışmanlık</h3><p>20 yıllık tecrübemizle rehberlik ederiz.</p></div>
            </div>
        </div>
    </section>

    <section class="section testimonials" id="yorumlar">
        <div class="container">
            <h2 class="section-title" style="color: white;">Müşterilerimiz Ne Diyor?</h2>
            <div class="testimonial-card"><p>"3 yıldır aldığım araçla hiçbir sorun yaşamadım. Herkese tavsiye ederim."</p><div class="testimonial-author">- Mehmet Yılmaz, İstanbul</div></div>
            <div class="testimonial-card"><p>"Araç alırken çok detaylı bilgi verdiler. Teşekkürler Güçlü Otomotiv."</p><div class="testimonial-author">- Ayşe Kaya, Ankara</div></div>
            <div class="testimonial-card"><p>"İlk araç alımımdı. Güçlü Otomotiv ekibi her konuda yardımcı oldu."</p><div class="testimonial-author">- Can Özdemir, İzmir</div></div>
        </div>
    </section>

    <section class="section contact" id="iletisim">
        <div class="container">
            <h2 class="section-title">İletişim</h2>
            <div class="contact-grid">
                <div class="contact-info">
                    <h3>Bize Ulaşın</h3>
                    <div class="contact-item"><span>📍</span><span><?php echo htmlspecialchars($settings['site_address']); ?></span></div>
                    <div class="contact-item"><span>📞</span><span><?php echo htmlspecialchars($settings['site_phone']); ?></span></div>
                    <div class="contact-item"><span>📱</span><span><?php echo htmlspecialchars($settings['site_mobile']); ?></span></div>
                    <div class="contact-item"><span>✉️</span><span><?php echo htmlspecialchars($settings['site_email']); ?></span></div>
                    <div style="margin-top: 2rem;">
                        <a href="https://wa.me/<?php echo htmlspecialchars($settings['whatsapp_number']); ?>" class="whatsapp-btn" target="_blank">💬 WhatsApp ile İletişime Geç</a>
                    </div>
                </div>
                <div class="contact-info">
                    <h3>Çalışma Saatlerimiz</h3>
                    <div class="contact-item"><span>🕐</span><span>Pazartesi - Cumartesi: 09:00 - 19:00</span></div>
                    <div class="contact-item"><span>🕐</span><span>Pazar: 10:00 - 17:00</span></div>
                    <div style="margin-top: 2rem;">
                        <h3>Bizi Takip Edin</h3>
                        <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                            <a href="<?php echo htmlspecialchars($settings['facebook_url']); ?>" style="color: #16213e; font-size: 2rem;">📘</a>
                            <a href="<?php echo htmlspecialchars($settings['instagram_url']); ?>" style="color: #16213e; font-size: 2rem;">📸</a>
                            <a href="<?php echo htmlspecialchars($settings['youtube_url']); ?>" style="color: #16213e; font-size: 2rem;">🎥</a>
                        </div>
                    </div>
                </div>
                <div class="contact-info">
                    <h3>Sahibinden Profilimiz</h3>
                    <p>Tüm araçlarımız ve detaylı bilgileri için Sahibinden.com profilimizi ziyaret edebilirsiniz.</p>
                    <a href="<?php echo htmlspecialchars($settings['sahibinden_profile']); ?>" target="_blank" class="btn" style="margin-top: 1rem; display: inline-block;">Sahibinden Profilini Görüntüle</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Teklif Modal -->
    <div id="offerModal" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeOfferModal()">&times;</span>
            <h2 style="color: #16213e;">Teklif Ver / Araç Sat / Takas</h2>
            <div class="offer-type-selector">
                <div class="offer-type-card" onclick="selectOfferType('buy')"><div class="icon">🛒</div><h3>Araç Almak</h3></div>
                <div class="offer-type-card" onclick="selectOfferType('sell')"><div class="icon">💰</div><h3>Araç Satmak</h3></div>
                <div class="offer-type-card" onclick="selectOfferType('exchange')"><div class="icon">🔄</div><h3>Takas</h3></div>
            </div>
            <form id="offerForm">
                <input type="hidden" id="offerType" name="offer_type">
                <input type="hidden" id="vehicleId" name="vehicle_id">
                <div class="form-group"><label>Adınız Soyadınız *</label><input type="text" name="customer_name" required></div>
                <div class="form-group"><label>Telefon *</label><input type="tel" name="customer_phone" required placeholder="05XX XXX XX XX"></div>
                <div class="form-group"><label>E-posta</label><input type="email" name="customer_email"></div>
                <div class="form-group" id="vehicleInfoGroup" style="display: none;"><label>Araç Bilgileriniz</label><textarea name="vehicle_info" rows="3"></textarea></div>
                <div class="form-group"><label>Mesajınız</label><textarea name="message" rows="4"></textarea></div>
                <button type="submit" class="btn" style="width: 100%;">WhatsApp'tan Gönder 💬</button>
            </form>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Güçlü Otomotiv. Tüm hakları saklıdır.</p>
            <p>Güvenilir ikinci el araç alım satım platformunuz</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.heroSwiper', { loop: true, autoplay: { delay: 5000, disableOnInteraction: false }, pagination: { el: '.swiper-pagination', clickable: true }, navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' }, effect: 'fade', fadeEffect: { crossFade: true } });
        
        function trackView(vehicleId) { fetch('?view_vehicle=' + vehicleId); }
        
        let selectedOfferType = '', currentVehicleId = null, currentVehicleTitle = '';
        function openOfferModal(vehicleId = null, vehicleTitle = '') { currentVehicleId = vehicleId; currentVehicleTitle = vehicleTitle; document.getElementById('offerModal').style.display = 'block'; document.body.style.overflow = 'hidden'; }
        function closeOfferModal() { document.getElementById('offerModal').style.display = 'none'; document.body.style.overflow = 'auto'; document.getElementById('offerForm').reset(); selectedOfferType = ''; document.querySelectorAll('.offer-type-card').forEach(card => card.classList.remove('active')); }
        function selectOfferType(type) { selectedOfferType = type; document.getElementById('offerType').value = type; document.querySelectorAll('.offer-type-card').forEach(card => card.classList.remove('active')); event.target.closest('.offer-type-card').classList.add('active'); document.getElementById('vehicleInfoGroup').style.display = (type === 'sell' || type === 'exchange') ? 'block' : 'none'; }
        
        document.getElementById('offerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            if (!selectedOfferType) { alert('Lütfen bir teklif türü seçin'); return; }
            const formData = new FormData(this);
            const name = formData.get('customer_name'), phone = formData.get('customer_phone'), message = formData.get('message') || '', vehicleInfo = formData.get('vehicle_info') || '';
            let whatsappText = `Merhaba, Güçlü Otomotiv!\n\n`;
            if (selectedOfferType === 'buy') { whatsappText += `🛒 *Araç Almak İstiyorum*\n\n`; if (currentVehicleTitle) whatsappText += `İlgilendiğim Araç: ${currentVehicleTitle}\n`; }
            else if (selectedOfferType === 'sell') { whatsappText += `💰 *Araç Satmak İstiyorum*\n\n`; if (vehicleInfo) whatsappText += `Araç Bilgilerim: ${vehicleInfo}\n`; }
            else if (selectedOfferType === 'exchange') { whatsappText += `🔄 *Takas Yapmak İstiyorum*\n\n`; if (currentVehicleTitle) whatsappText += `İlgilendiğim Araç: ${currentVehicleTitle}\n`; if (vehicleInfo) whatsappText += `Benim Aracım: ${vehicleInfo}\n`; }
            whatsappText += `\nAdım: ${name}\nTelefon: ${phone}\n`; if (message) whatsappText += `\nMesajım: ${message}`;
            const whatsappNumber = '<?php echo htmlspecialchars($settings['whatsapp_number']); ?>';
            const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(whatsappText)}`;
            fetch('api/save_offer.php', { method: 'POST', body: formData }).finally(() => { window.open(whatsappUrl, '_blank'); closeOfferModal(); });
        });
        
        window.onclick = function(event) { if (event.target == document.getElementById('offerModal')) closeOfferModal(); }
    </script>
</body>
</html>
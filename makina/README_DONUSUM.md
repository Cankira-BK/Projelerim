# Güçlü Makina - Web Sitesi Dönüşüm Rehberi

## 🔄 TAMAMLANAN GÜNCELLEMELER

Web siteniz **otomotiv sektöründen** → **makina imalatı/torna sektörüne** başarıyla dönüştürülmüştür.

---

## 📋 Güncellenmiş Dosyalar

### ✅ Ana Sayfa ve Frontend
- ✅ **index.php** - Makina teması, ürünler, hizmetler
- ✅ **assets/styles.css** - Yeni renk paleti (#ff6b35)
- ✅ **search.php** - Ürün/parça arama ve filtreleme

### ✅ Admin Panel
- ✅ **admin/index.php** - Ürün yönetimi, teklifler
- ✅ **admin/customer_vehicles.php** - Makina sektörüne uyarlandı

### ✅ Veritabanı
- ✅ **database.sql** - Products tablosu, yeni alanlar

### 📂 Yedek Dosyalar
```
backup/
├── index_otomotiv.php      (eski ana sayfa)
├── styles_otomotiv.css     (eski CSS)
└── database_otomotiv.sql   (eski veritabanı)
```

---

## 🎯 ÖNEMLİ DEĞİŞİKLİKLER

### 1. Veritabanı Değişiklikleri

#### Eski Tablo: `vehicles`
```sql
- title, price, year, km, fuel, transmission
- image, sahibinden_link
- is_featured, views, status
```

#### Yeni Tablo: `products`
```sql
- title, category, specifications, material
- description, image
- is_featured, views, status
```

#### Teklif Türleri
- Eski: `buy`, `sell`, `exchange`
- Yeni: `production`, `repair`, `service`

### 2. Görsel Değişiklikler
| Öğe | Eski (Otomotiv) | Yeni (Makina) |
|-----|-----------------|----------------|
| Ana Renk | #ffd700 (Altın) | #ff6b35 (Turuncu) |
| Arka Plan | #1a1a2e | #2c3e50 |
| Logo | 🚗 | ⚙️ |
| Tema | Otomotiv | Endüstriyel |

### 3. İçerik Değişiklikleri
| Bölüm | Eski | Yeni |
|-------|------|------|
| Menü | Araçlar | Ürünler & Parçalar |
| Hizmetler | Alım-Satım, Takas | CNC Torna, Freze, Bakım |
| Referanslar | Müşteri Yorumları | Sektörel Referanslar |
| Teklif | Araç Al/Sat | İmalat/Bakım/Hizmet |

---

## 🚀 KURULUM ADIMLARI

### Adım 1: Veritabanı Kurulumu

#### A) Yeni Başlangıç (Önerilen)
1. phpMyAdmin'i açın
2. `database.sql` dosyasını içe aktarın
3. Yeni tablolar otomatik oluşturulacak
4. Örnek veriler eklenecek

#### B) Mevcut Verilerle Geçiş
```sql
-- 1. YEDEKLEYİN!
CREATE TABLE vehicles_backup LIKE vehicles;
INSERT INTO vehicles_backup SELECT * FROM vehicles;

-- 2. Yeni tabloları oluşturun (database.sql'den)

-- 3. Verileri taşıyın (manuel düzenleme gerekebilir)
INSERT INTO products (title, category, specifications, image, is_featured, status, created_at)
SELECT 
    title,
    'Genel' as category,
    CONCAT(year, ' Model - ', km, ' - ', fuel) as specifications,
    image,
    is_featured,
    status,
    created_at
FROM vehicles;

-- 4. Teklifleri taşıyın
INSERT INTO offers (product_id, offer_type, customer_name, customer_phone, customer_email, message, status, created_at)
SELECT 
    vehicle_id as product_id,
    CASE offer_type
        WHEN 'buy' THEN 'production'
        WHEN 'sell' THEN 'service'
        ELSE 'repair'
    END as offer_type,
    customer_name,
    customer_phone,
    customer_email,
    message,
    status,
    created_at
FROM offers_backup;
```

### Adım 2: Site Ayarları
Admin panel → Ayarlar:
```
Site Başlığı: Güçlü Makina
Logo: GÜÇLÜ MAKİNA
Telefon: 0328 123 45 67
Mobil: 0532 123 45 67
E-posta: info@guclumakina.com
Adres: Organize Sanayi Bölgesi, 5. Cadde No: 42, Osmaniye
WhatsApp: 905321234567
```

### Adım 3: Test
- [ ] Ana sayfa yükleniyor mu?
- [ ] Ürünler görünüyor mu?
- [ ] Arama çalışıyor mu?
- [ ] Teklif formu çalışıyor mu?
- [ ] WhatsApp entegrasyonu çalışıyor mu?
- [ ] Admin panel erişimi var mı?

---

## 📝 ÖRNEKLERİ KULLANMA

### Örnek 1: Yeni Ürün Ekle
```sql
INSERT INTO products (title, category, specifications, material, description, image, is_featured) 
VALUES (
    'Hassas Mil Tornalama',
    'CNC Torna',
    'Ø10-300mm, Uzunluk: 2000mm',
    'Çelik, Paslanmaz',
    'Hassas toleranslarda mil tornalama hizmeti',
    'https://example.com/image.jpg',
    1
);
```

### Örnek 2: Kategori Listesi
```
- CNC Torna
- CNC Freze
- Yedek Parça İmalatı
- Bakım-Onarım
- Kaynak İşleri
- Montaj Hizmeti
```

### Örnek 3: Hizmet Ekle
```sql
INSERT INTO services (icon, title, description, display_order) 
VALUES (
    '⚙️',
    'CNC Torna İşleme',
    'Hassas ölçülerde torna, yüzey tornalama ve diş açma işlemleri',
    1
);
```

---

## 🎨 ÖZELLEŞTİRME

### Renkleri Değiştirme
`assets/styles.css` dosyasında:
```css
/* Ana renk (turuncu) */
#ff6b35 → İstediğiniz renk

/* Arka plan renkleri */
#2c3e50 → Koyu gri/mavi
#34495e → Orta ton

/* Hover efektleri */
box-shadow: 0 5px 15px rgba(255,107,53,.4);
```

### Logo Değiştirme
`index.php` ve `admin/index.php`:
```html
<!-- Emoji yerine -->
<div class="logo">⚙️ GÜÇLÜ MAKİNA</div>

<!-- Logo resmi kullanın -->
<div class="logo">
    <img src="assets/images/logo.png" alt="Güçlü Makina">
</div>
```

### Banner Metni
Admin Panel → Ayarlar veya doğrudan veritabanından:
```sql
UPDATE settings SET setting_value = 'Yeni Başlık' 
WHERE setting_key = 'banner_title';
```

---

## 🔧 YÖNETİM

### Admin Panel Erişim
```
URL: /admin/
Kullanıcı: admin
Şifre: Admin123!@# (MUTLAKA DEĞİŞTİRİN!)
```

### Şifre Değiştirme
```php
// generate_password.php oluşturun:
<?php
echo password_hash('YeniSifreniz123', PASSWORD_DEFAULT);
?>

// Çıkan hash'i admins tablosuna kaydedin
UPDATE admins SET password_hash = '$2y$10$...' WHERE username = 'admin';
```

### Yeni Admin Ekle
```sql
INSERT INTO admins (username, password_hash, email, full_name, role) 
VALUES (
    'yeni_admin',
    '$2y$10$...',  -- password_hash() ile oluşturun
    'admin@firma.com',
    'Admin İsim',
    'admin'
);
```

---

## 📊 İSTATİSTİKLER

Admin panelde görebilirsiniz:
- Toplam ürün sayısı
- Öne çıkan ürünler
- Toplam görüntüleme
- Yeni teklifler
- Toplam resim sayısı

---

## 🔍 SORUN GİDERME

### Beyaz Sayfa
```php
// config/database.php kontrol edin
define('DB_HOST', 'localhost');
define('DB_NAME', 'nuyacom_guclu');
define('DB_USER', 'root');
define('DB_PASS', '');
```

### Ürünler Görünmüyor
```sql
-- Tabloyu kontrol edin
SHOW TABLES LIKE 'products';

-- Veri var mı?
SELECT * FROM products WHERE status = 'active';

-- Örnek veri ekleyin
INSERT INTO products VALUES (...);
```

### Resimler Yüklenmiyor
- `uploads/products/` klasörü var mı?
- Yazma izni var mı? (chmod 777)
- Resim yolu doğru mu?

### Admin Panele Girilemiyof
```sql
-- Admin var mı?
SELECT * FROM admins;

-- Şifreyi sıfırlayın
UPDATE admins 
SET password_hash = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
WHERE username = 'admin';
-- Şifre: password
```

### WhatsApp Çalışmıyor
Settings tablosunda `whatsapp_number` değerini kontrol edin:
```sql
UPDATE settings 
SET setting_value = '905321234567' 
WHERE setting_key = 'whatsapp_number';
```

---

## 📱 MOBİL UYUMLULUK

Site tamamen responsive:
- Tablet: Grid otomatik ayarlanır
- Mobil: Menü hamburger menüye dönüşür
- Kartlar: Tek sütun olur

---

## 🔐 GÜVENLİK

### Yapılanlar:
- ✅ SQL injection koruması (prepared statements)
- ✅ XSS koruması (htmlspecialchars)
- ✅ Admin oturum kontrolü
- ✅ Güvenlik logları
- ✅ .htaccess dosyaları

### Yapılmalılar:
- [ ] Admin şifresini değiştirin
- [ ] SSL sertifikası kurun (HTTPS)
- [ ] Veritabanı şifresini güçlü yapın
- [ ] Düzenli yedek alın

---

## 🆘 DESTEK

### Veritabanı Yedekleme
```sql
-- phpMyAdmin'den Export
-- Veya komut satırı:
mysqldump -u kullanici -p nuyacom_guclu > yedek.sql
```

### Geri Yükleme
```sql
mysql -u kullanici -p nuyacom_guclu < yedek.sql
```

### Eski Versiyona Dönüş
```bash
# Dosyaları değiştir
cp backup/index_otomotiv.php index.php
cp backup/styles_otomotiv.css assets/styles.css

# Veritabanını geri yükle
mysql -u kullanici -p nuyacom_guclu < backup/database_otomotiv.sql
```

---

## ✅ KONTROL LİSTESİ

Web sitesi canlıya alınmadan önce:

### Zorunlu
- [ ] Veritabanı kuruldu
- [ ] Admin şifresi değiştirildi
- [ ] İletişim bilgileri güncellendi
- [ ] WhatsApp numarası doğru
- [ ] Test edildi (tüm sayfalar)

### Önerilen
- [ ] Logo eklendi
- [ ] Gerçek ürün resimleri yüklendi
- [ ] Hizmetler güncellendi
- [ ] Referanslar eklendi
- [ ] SSL sertifikası kuruldu
- [ ] Google Analytics eklendi
- [ ] Sitemap oluşturuldu

### Opsiyonel
- [ ] Blog içerikleri eklendi
- [ ] SEO meta etiketleri güncellendi
- [ ] Favicon eklendi
- [ ] Email bildirimleri test edildi
- [ ] Yedekleme sistemi kuruldu

---

## 📧 İLETİŞİM BİLGİLERİ

Siteyi özelleştirirken sorun yaşarsanız:
- README dosyasını kontrol edin
- Veritabanı loglarına bakın
- Error log dosyalarını inceleyin
- Admin panel → Güvenlik Logları

---

**Önemli:** Bu dönüşüm temel yapıyı değiştirmiştir. Diğer modülleri (blog, müşteri araç ekleme vb.) de güncellemek isterseniz benzer mantıkla yapılabilir.

**Son Güncelleme:** <?php echo date('d.m.Y H:i'); ?>

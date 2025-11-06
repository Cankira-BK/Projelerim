# İlan Fiyat Sorgulama Web Uygulaması

Bu proje, daha önce bir Google Chrome eklentisi olarak tasarlanmış olan sahibee.com ilan fiyatı görüntüleme aracının, harici bir API kullanılmadan bir web uygulamasına dönüştürülmüş halidir.

## Projenin Amacı

Uygulamanın temel amacı, kullanıcının bir metin kutusuna girdiği sahibee.com ilan numarasını kullanarak, ilanın **güncel** fiyatını getirmek ve ekranda göstermektir.

### Önemli Not: Fiyat Geçmişi ve Güncel Fiyat

Projenin başlangıcında hedeflenen "fiyat geçmişi" özelliğinin, yapılan teknik analizler sonucunda mevcut imkanlarla **mümkün olmadığı** anlaşılmıştır. Bunun temel nedenleri şunlardır:

1.  **Veri Kaynağı:** `sahibee.com` web sitesi, bir ilanın sadece güncel fiyatını göstermektedir. İlanın geçmişteki fiyat değişiklikleri (fiyat tarihçesi) sayfa içeriğinde mevcut değildir.
2.  **Harici API Kısıtlaması:** Orijinal Chrome eklentisi, bu geçmiş verilerini zamanla kendisi toplayıp bir veritabanında saklayan `gecmisi.com.tr` gibi harici bir API'den almaktaydı. Proje hedefi gereği harici API kullanımı kapsam dışı bırakılmıştır.
3.  **Gelişmiş Bot Koruması:** `sahibee.com`, web scraping (veri kazıma) girişimlerini engellemek için Cloudflare gibi çok katmanlı ve gelişmiş bot koruma sistemleri kullanmaktadır. Yaptığımız denemelerde, `puppeteer-extra-plugin-stealth` gibi en gelişmiş otomasyon araçları bile bu korumayı güvenilir bir şekilde aşamamıştır.

Bu nedenlerle, projenin kapsamı, **bir ilanın sadece güncel fiyatını getirmek** olarak güncellenmiştir. Backend servisi şu anda bu korumayı aşamasa da, gelecekte daha gelişmiş proxy veya CAPTCHA çözme servisleriyle entegre edilebilecek sağlam bir temel üzerine kurulmuştur.

## Proje Yapısı

Proje iki ana bölümden oluşmaktadır:

-   **/frontend (Ana Dizin):** Kullanıcı arayüzünü oluşturan statik HTML, CSS ve JavaScript dosyalarını içerir.
    -   `index.html`: Ana sayfa yapısı.
    -   `style.css`: Arayüz stilleri.
    -   `script.js`: Backend ile iletişimi sağlayan istemci taraflı mantık.
-   **/backend:** Veri kazıma işlemini gerçekleştiren Node.js tabanlı sunucu.
    -   `server.js`: Express ile yazılmış API sunucusu.
    -   `package.json`: Gerekli Node.js bağımlılıkları.

## Kurulum ve Çalıştırma

Uygulamayı yerel makinenizde çalıştırmak için aşağıdaki adımları izleyin:

### Gereksinimler

-   [Node.js](https://nodejs.org/) (v16 veya üstü)
-   [Python 3](https://www.python.org/downloads/) (Frontend'i sunmak için)

### Adım 1: Backend Sunucusunu Başlatma

1.  Terminali açın ve `backend` dizinine gidin:
    ```bash
    cd backend
    ```
2.  Gerekli Node.js paketlerini kurun:
    ```bash
    npm install
    ```
3.  Backend sunucusunu başlatın:
    ```bash
    node server.js
    ```
    Sunucu varsayılan olarak `http://localhost:3000` adresinde çalışmaya başlayacaktır.

### Adım 2: Frontend Arayüzünü Başlatma

1.  Yeni bir terminal açın ve projenin **ana dizininde** olduğunuzdan emin olun.
2.  Python'un dahili HTTP sunucusunu kullanarak frontend dosyalarını sunun:
    ```bash
    python3 -m http.server 8080
    ```
    Frontend sunucusu `http://localhost:8080` adresinde çalışmaya başlayacaktır.

### Adım 3: Uygulamayı Kullanma

1.  Web tarayıcınızı açın ve `http://localhost:8080` adresine gidin.
2.  Metin kutusuna geçerli bir sahibee.com ilan numarası girin ve "Sorgula" butonuna tıklayın.
3.  Sonuç, metin kutusunun altında görünecektir.

## Kullanılan Teknolojiler

-   **Backend:** Node.js, Express, Puppeteer, Puppeteer-Extra, Cheerio
-   **Frontend:** HTML, CSS, JavaScript (Fetch API)
-   **Test:** Python (http.server), cURL

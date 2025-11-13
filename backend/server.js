const express = require('express');
// Normal puppeteer yerine puppeteer-extra'yı kullanıyoruz.
const puppeteer = require('puppeteer-extra');
const StealthPlugin = require('puppeteer-extra-plugin-stealth');
const cheerio = require('cheerio');
const cors = require('cors');

// Stealth eklentisini puppeteer'a ekliyoruz.
puppeteer.use(StealthPlugin());

const app = express();
const PORT = 3000;

app.use(cors());

app.get('/get-price', async (req, res) => {
    const { ilanNo } = req.query;

    if (!ilanNo) {
        return res.status(400).json({ error: 'İlan numarası gerekli.' });
    }

    const url = `https://www.sahibinden.com/ilan/-/-/${ilanNo}/detay`;

    let browser = null;
    try {
        // Puppeteer'ı (stealth moduyla) başlatıyoruz.
        browser = await puppeteer.launch({
            headless: true,
            args: ['--no-sandbox', '--disable-setuid-sandbox']
        });
        const page = await browser.newPage();

        // Stealth eklentisi User-Agent gibi şeyleri de kendisi daha doğal bir şekilde yönetir.
        // Ama biz yine de bir tane belirtelim.
        await page.setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');

        // Sayfaya git. Stealth eklentisi "Just a moment..." sayfasını geçmeye çalışacak.
        // Bu işlem biraz daha uzun sürebilir, bu yüzden timeout süresini artıralım.
        await page.goto(url, { waitUntil: 'networkidle2', timeout: 60000 }); // 60 saniye timeout

        const content = await page.content();
        const pageTitle = await page.title();
        const $ = cheerio.load(content);

        let priceText = '';
        // Seçicileri güncel sahibinden.com yapısına göre yeniden düzenleyelim.
        // En güvenilir seçici, fiyatın bulunduğu `<h3>` elementidir.
        const priceElement = $('div.classifiedDetail > div.classifiedInfo > h3');

        if (priceElement.length > 0) {
            priceText = priceElement.text().trim();
        } else {
            // Alternatif olarak, bazen farklı bir yapıda olabilir.
            const alternativePriceElement = $('#favoriteClassifiedPrice');
            if (alternativePriceElement.length > 0) {
                priceText = alternativePriceElement.attr('value').trim();
            }
        }

        if (!priceText || pageTitle.includes("İlan yayında değil")) {
            return res.status(404).json({
                error: 'Fiyat bilgisi bulunamadı veya ilan yayında değil.',
                pageTitle: pageTitle
            });
        }

        // Fiyat metninden para birimini ve noktaları temizle
        const price = priceText.replace(/\./g, '').replace(/TL|USD|EUR|GBP/g, '').trim();

        res.json({ ilanNo, price: parseInt(price, 10), pageTitle: pageTitle });

    } catch (error) {
        console.error('Puppeteer/Scraping hatası:', error.message);
        res.status(500).json({ error: 'Veri çekilirken bir hata oluştu. Muhtemelen bot kontrolü aşılamadı veya ilan bulunamadı.' });
    } finally {
        if (browser) {
            await browser.close();
        }
    }
});

app.listen(PORT, () => {
    console.log(`Sunucu http://localhost:${PORT} adresinde çalışıyor.`);
});

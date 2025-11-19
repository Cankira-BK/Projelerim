document.addEventListener('DOMContentLoaded', () => {
    const ilanNoInput = document.getElementById('ilanNoInput');
    const sorgulaBtn = document.getElementById('sorgulaBtn');
    const sonucDiv = document.getElementById('sonuc');

    sorgulaBtn.addEventListener('click', async () => {
        const ilanNo = ilanNoInput.value.trim();

        if (!ilanNo) {
            alert('Lütfen bir ilan numarası girin.');
            return;
        }

        // Butonu devre dışı bırak ve yükleniyor animasyonu göster
        sorgulaBtn.disabled = true;
        sonucDiv.innerHTML = '<div class="loader"></div>';
        sonucDiv.className = 'sonuc-area'; // Reset classes

        try {
            // Backend servisine istek gönder.
            // Bu adresin, backend sunucunuzun çalıştığı adrese eşit olduğundan emin olun.
            const response = await fetch(`http://localhost:3000/get-price?ilanNo=${ilanNo}`);
            const data = await response.json();

            if (response.ok) {
                // Fiyatı "1.234.567 TL" formatında göster
                const formattedPrice = new Intl.NumberFormat('tr-TR').format(data.price);
                sonucDiv.innerHTML = `<strong>İlan Numarası:</strong> ${data.ilanNo}<br><strong>Güncel Fiyat:</strong> ${formattedPrice} TL`;
                sonucDiv.classList.add('success');
            } else {
                // Sunucudan gelen hata mesajını göster
                let errorMessage = `<strong>Hata:</strong> ${data.error}`;
                // Eğer sayfa başlığı varsa, hata mesajına ekle (debugging için)
                if (data.pageTitle) {
                    errorMessage += `<br><small>Sayfa Başlığı: "${data.pageTitle}"</small>`;
                }
                sonucDiv.innerHTML = errorMessage;
                sonucDiv.classList.add('error');
            }
        } catch (error) {
            // Ağ hatası veya sunucuya ulaşılamama durumu
            console.error('Fetch hatası:', error);
            sonucDiv.innerHTML = '<strong>Hata:</strong> Sunucuya bağlanılamadı. Backend servisinin çalıştığından emin olun.';
            sonucDiv.classList.add('error');
        } finally {
            // İşlem bittiğinde butonu tekrar aktif et
            sorgulaBtn.disabled = false;
        }
    });
});

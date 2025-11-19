flex: 1; text-align: center; background: #ff6b35; font-size: 0.9rem; color: white;">💬 Fiyat Teklifi Al</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div style="text-align: center; margin-top: 3rem;">
                    <p style="color: #666; margin-bottom: 1rem;">
                        Toplam <?php echo count($products); ?> ürün/parça gösteriliyor
                    </p>
                    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                        <a href="index.php" class="btn" style="background: #6c757d; color: white;">← Ana Sayfaya Dön</a>
                        <a href="index.php#iletisim" class="btn" style="background: #28a745; color: white;">📞 İletişime Geç</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Güçlü Makina. Tüm hakları saklıdır.</p>
            <p>Hassas İşçilik - Kaliteli Üretim - Güvenilir Hizmet</p>
        </div>
    </footer>

    <script>
        // Görüntülenme sayacı
        document.addEventListener('DOMContentLoaded', function() {
            const productCards = document.querySelectorAll('.vehicle-card');
            
            productCards.forEach(function(card) {
                const productId = card.getAttribute('data-product-id');
                
                // Sadece resim ve başlık kısmına tıklanınca sayaç artsın
                const imageArea = card.querySelector('.vehicle-image, h3');
                if (imageArea && productId) {
                    imageArea.style.cursor = 'pointer';
                    imageArea.addEventListener('click', function(e) {
                        // Buton tıklamalarını engelle
                        if (!e.target.closest('a, button')) {
                            fetch('search.php?view_product=' + productId);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>

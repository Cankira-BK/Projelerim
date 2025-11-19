        function selectMethod(method) {
            document.querySelectorAll('.upload-method').forEach(el => el.classList.remove('active'));
            event.target.closest('.upload-method').classList.add('active');
            
            document.getElementById('imageType').value = method;
            
            if (method === 'url') {
                document.getElementById('urlMethod').style.display = 'block';
                document.getElementById('computerMethod').style.display = 'none';
                document.getElementById('submitBtn').style.display = 'inline-block';
            } else {
                document.getElementById('urlMethod').style.display = 'none';
                document.getElementById('computerMethod').style.display = 'block';
                document.getElementById('submitBtn').style.display = 'inline-block';
            }
            
            document.getElementById('imagePreview').classList.remove('show');
        }
        
        function previewImage() {
            const url = document.getElementById('imageUrlInput').value.trim();
            if (!url) {
                alert('Lütfen bir resim URL\'si girin');
                return;
            }
            const preview = document.getElementById('imagePreview');
            const img = document.getElementById('previewImg');
            img.src = url;
            img.onerror = function() {
                alert('Resim yüklenemedi. URL\'yi kontrol edin.');
                preview.classList.remove('show');
            };
            img.onload = function() {
                preview.classList.add('show');
            };
        }
        
        async function handleFileSelect(event) {
            const file = event.target.files[0];
            if (!file) return;
            
            // Dosya tipini kontrol et
            if (!file.type.startsWith('image/')) {
                alert('Lütfen geçerli bir resim dosyası seçin');
                return;
            }
            
            // Dosya boyutunu kontrol et (5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('Dosya boyutu çok büyük. Maksimum 5MB olmalı.');
                return;
            }
            
            // Önizleme göster
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('imagePreview');
                const img = document.getElementById('previewImg');
                img.src = e.target.result;
                preview.classList.add('show');
            };
            reader.readAsDataURL(file);
            
            // Dosyayı yükle
            const formData = new FormData();
            formData.append('image', file);
            
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.textContent = '⏳ Yükleniyor...';
            
            try {
                const response = await fetch('upload_vehicle_image.php', {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    document.getElementById('uploadedImageUrl').value = result.url;
                    alert('✓ Resim yüklendi! Şimdi "Resmi Ekle" butonuna tıklayın.');
                    submitBtn.textContent = '✓ Resmi Ekle';
                } else {
                    alert('Hata: ' + result.error);
                    submitBtn.textContent = '✓ Resmi Ekle';
                }
            } catch (error) {
                alert('Yükleme hatası: ' + error.message);
                submitBtn.textContent = '✓ Resmi Ekle';
            } finally {
                submitBtn.disabled = false;
            }
        }
    </script>

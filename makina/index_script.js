ehicleId = null, currentVehicleTitle = '';
        function openOfferModal(vehicleId = null, vehicleTitle = '') { 
            currentVehicleId = vehicleId; 
            currentVehicleTitle = vehicleTitle; 
            document.getElementById('offerModal').style.display = 'block'; 
            document.body.style.overflow = 'hidden'; 
        }
        function closeOfferModal() { 
            document.getElementById('offerModal').style.display = 'none'; 
            document.body.style.overflow = 'auto'; 
            document.getElementById('offerForm').reset(); 
            selectedOfferType = ''; 
            document.querySelectorAll('.offer-type-card').forEach(card => card.classList.remove('active')); 
        }
        function selectOfferType(type) { 
            selectedOfferType = type; 
            document.getElementById('offerType').value = type; 
            document.querySelectorAll('.offer-type-card').forEach(card => card.classList.remove('active')); 
            event.target.closest('.offer-type-card').classList.add('active'); 
            document.getElementById('vehicleInfoGroup').style.display = (type === 'sell' || type === 'exchange') ? 'block' : 'none'; 
        }
        
        document.getElementById('offerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            if (!selectedOfferType) { alert('Lütfen bir teklif türü seçin'); return; }
            const formData = new FormData(this);
            const name = formData.get('customer_name'), phone = formData.get('customer_phone'), message = formData.get('message') || '', vehicleInfo = formData.get('vehicle_info') || '';
            let whatsappText = `Merhaba, Güçlü Otomotiv!\n\n`;
            if (selectedOfferType === 'buy') { 
                whatsappText += `🛒 *Araç Almak İstiyorum*\n\n`; 
                if (currentVehicleTitle) whatsappText += `İlgilendiğim Araç: ${currentVehicleTitle}\n`; 
            }
            else if (selectedOfferType === 'sell') { 
                whatsappText += `💰 *Araç Satmak İstiyorum*\n\n`; 
                if (vehicleInfo) whatsappText += `Araç Bilgilerim: ${vehicleInfo}\n`; 
            }
            else if (selectedOfferType === 'exchange') { 
                whatsappText += `🔄 *Takas Yapmak İstiyorum*\n\n`; 
                if (currentVehicleTitle) whatsappText += `İlgilendiğim Araç: ${currentVehicleTitle}\n`; 
                if (vehicleInfo) whatsappText += `Benim Aracım: ${vehicleInfo}\n`; 
            }
            whatsappText += `\nAdım: ${name}\nTelefon: ${phone}\n`; 
            if (message) whatsappText += `\nMesajım: ${message}`;
            const whatsappNumber = '<?php echo htmlspecialchars($settings['whatsapp_number']); ?>';
            const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(whatsappText)}`;
            fetch('api/save_offer.php', { method: 'POST', body: formData }).finally(() => { 
                window.open(whatsappUrl, '_blank'); 
                closeOfferModal(); 
            });
        });
        
        window.onclick = function(event) { 
            if (event.target == document.getElementById('offerModal')) closeOfferModal(); 
        }
    </script>
</body>
</html>
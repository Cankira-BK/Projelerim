selectedOfferType==='service'){whatsappText+='🛠️ *Teknik Hizmet Talebi*\n\n'}
            if(projectInfo)whatsappText+='İş Detayları: '+projectInfo+'\n';
            whatsappText+='\nFirma/Ad: '+name+'\nTelefon: '+phone+'\n';if(message)whatsappText+='\nEk Notlar: '+message;
            const whatsappNumber='<?php echo htmlspecialchars($settings['whatsapp_number']); ?>';
            const whatsappUrl='https://wa.me/'+whatsappNumber+'?text='+encodeURIComponent(whatsappText);
            fetch('api/save_offer.php',{method:'POST',body:formData}).finally(()=>{window.open(whatsappUrl,'_blank');closeOfferModal()});
        });
        
        window.onclick=function(event){if(event.target==document.getElementById('offerModal'))closeOfferModal()}
    </script>
</body>
</html>
<?php
// Email gönderme fonksiyonu
function sendEmail($to, $subject, $body, $altBody = '') {
    // PHP mail() fonksiyonu ile basit email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Güçlü Otomotiv <info@gucluotomotiv.com>" . "\r\n";
    
    $success = mail($to, $subject, $body, $headers);
    
    return ['success' => $success];
}

// Yeni teklif bildirimi
function notifyNewOffer($offer, $adminEmail) {
    $types = [
        'buy' => 'Araç Almak İstiyor',
        'sell' => 'Araç Satmak İstiyor',
        'exchange' => 'Takas Yapmak İstiyor'
    ];
    
    $subject = "🚗 Yeni Teklif - " . $offer['customer_name'];
    
    $body = "
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; background: #f8f9fa; }
            .card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
            .header { background: linear-gradient(135deg, #1a1a2e, #16213e); color: white; padding: 20px; border-radius: 10px 10px 0 0; text-align: center; }
            .info-row { padding: 10px 0; border-bottom: 1px solid #e0e0e0; }
            .info-label { font-weight: bold; color: #16213e; }
            .btn { display: inline-block; padding: 12px 24px; background: #ffd700; color: #1a1a2e; text-decoration: none; border-radius: 5px; font-weight: bold; margin-top: 20px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='card'>
                <div class='header'>
                    <h1>🚗 Yeni Teklif Geldi!</h1>
                </div>
                <div style='padding: 20px;'>
                    <div class='info-row'>
                        <span class='info-label'>Tür:</span> " . ($types[$offer['offer_type']] ?? '') . "
                    </div>
                    <div class='info-row'>
                        <span class='info-label'>Müşteri:</span> " . htmlspecialchars($offer['customer_name']) . "
                    </div>
                    <div class='info-row'>
                        <span class='info-label'>Telefon:</span> <a href='tel:" . htmlspecialchars($offer['customer_phone']) . "'>" . htmlspecialchars($offer['customer_phone']) . "</a>
                    </div>
                    " . ($offer['customer_email'] ? "<div class='info-row'><span class='info-label'>Email:</span> " . htmlspecialchars($offer['customer_email']) . "</div>" : "") . "
                    " . ($offer['vehicle_info'] ? "<div class='info-row'><span class='info-label'>Araç Bilgisi:</span> " . nl2br(htmlspecialchars($offer['vehicle_info'])) . "</div>" : "") . "
                    " . ($offer['message'] ? "<div class='info-row'><span class='info-label'>Mesaj:</span> " . nl2br(htmlspecialchars($offer['message'])) . "</div>" : "") . "
                    
                    <div style='text-align: center;'>
                        <a href='https://wa.me/" . preg_replace('/[^0-9]/', '', $offer['customer_phone']) . "' class='btn'>💬 WhatsApp ile İletişime Geç</a>
                    </div>
                </div>
            </div>
            <div style='text-align: center; padding: 20px; color: #666; font-size: 12px;'>
                <p>Bu email otomatik olarak Güçlü Otomotiv sistemi tarafından gönderilmiştir.</p>
            </div>
        </div>
    </body>
    </html>
    ";
    
    return sendEmail($adminEmail, $subject, $body);
}

// Yeni araç onayı bildirimi (müşteriye)
function notifyVehicleApproved($customer, $vehicle) {
    $subject = "✅ Aracınız Onaylandı - Güçlü Otomotiv";
    
    $body = "
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; background: #f8f9fa; }
            .card { background: white; padding: 20px; border-radius: 10px; }
            .header { background: #28a745; color: white; padding: 20px; border-radius: 10px 10px 0 0; text-align: center; }
            .btn { display: inline-block; padding: 12px 24px; background: #ffd700; color: #1a1a2e; text-decoration: none; border-radius: 5px; font-weight: bold; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='card'>
                <div class='header'>
                    <h1>✅ Aracınız Yayında!</h1>
                </div>
                <div style='padding: 20px;'>
                    <p>Merhaba <strong>" . htmlspecialchars($customer['name']) . "</strong>,</p>
                    <p>Eklediğiniz araç başarıyla onaylandı ve sitemizde yayınlandı:</p>
                    <h3 style='color: #16213e;'>" . htmlspecialchars($vehicle['title']) . "</h3>
                    <p style='font-size: 18px; color: #ffd700; font-weight: bold;'>" . htmlspecialchars($vehicle['price']) . "</p>
                    <p>Aracınız için teklif geldiğinde sizi bilgilendireceğiz.</p>
                    <div style='text-align: center; margin-top: 20px;'>
                        <a href='https://a.nuya2.com/guclu/cl/' class='btn'>🚗 Sitede Görüntüle</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
    ";
    
    return sendEmail($customer['email'], $subject, $body);
}

// Yeni müşteri aracı eklendi (admin'e)
function notifyNewCustomerVehicle($vehicle, $adminEmail) {
    $subject = "🚗 Yeni Araç Ekleme Talebi";
    
    $body = "
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
            .header { background: #ff9800; color: white; padding: 20px; border-radius: 10px 10px 0 0; text-align: center; }
            .btn { display: inline-block; padding: 12px 24px; background: #ffd700; color: #1a1a2e; text-decoration: none; border-radius: 5px; font-weight: bold; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='card'>
                <div class='header'>
                    <h1>🚗 Yeni Araç Ekleme Talebi</h1>
                </div>
                <div style='padding: 20px;'>
                    <p>Bir müşteri araç eklemek istiyor:</p>
                    <h3>" . htmlspecialchars($vehicle['title']) . "</h3>
                    <p><strong>Fiyat:</strong> " . htmlspecialchars($vehicle['price']) . "</p>
                    <p><strong>Yıl:</strong> " . htmlspecialchars($vehicle['year']) . " | <strong>KM:</strong> " . htmlspecialchars($vehicle['km']) . "</p>
                    <p><strong>Müşteri:</strong> " . htmlspecialchars($vehicle['customer_name']) . "</p>
                    <p><strong>Telefon:</strong> " . htmlspecialchars($vehicle['customer_phone']) . "</p>
                    <div style='text-align: center; margin-top: 20px;'>
                        <a href='https://a.nuya2.com/guclu/cl/admin/customer_vehicles.php' class='btn'>🔍 Onay Bekleyen Araçlar</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
    ";
    
    return sendEmail($adminEmail, $subject, $body);
}
?>
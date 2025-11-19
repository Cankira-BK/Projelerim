<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

require_once '../config/database.php';

$response = ['success' => false, 'message' => ''];

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method');
    }

    $db = Database::getInstance();
    
    // Gerekli alanları kontrol et
    $required = ['offer_type', 'customer_name', 'customer_phone'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            throw new Exception('Gerekli alanlar eksik: ' . $field);
        }
    }

    // Verileri temizle
    $productId = isset($_POST['product_id']) && is_numeric($_POST['product_id']) ? (int)$_POST['product_id'] : null;
    $offerType = sanitize($_POST['offer_type']); // production, repair, service
    $customerName = sanitize($_POST['customer_name']);
    $customerPhone = sanitize($_POST['customer_phone']);
    $customerEmail = sanitize($_POST['customer_email'] ?? '');
    $projectInfo = sanitize($_POST['project_info'] ?? ''); // İş detayları
    $message = sanitize($_POST['message'] ?? '');
    
    // IP ve User Agent
    $ipAddress = $_SERVER['REMOTE_ADDR'] ?? '';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';

    // Teklif türünü kontrol et
    $validTypes = ['production', 'repair', 'service'];
    if (!in_array($offerType, $validTypes)) {
        throw new Exception('Geçersiz teklif türü');
    }

    // Veritabanına kaydet
    $sql = "INSERT INTO offers (product_id, offer_type, customer_name, customer_phone, customer_email, project_info, message, ip_address, user_agent, status, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'new', NOW())";
    
    $offerId = $db->insert($sql, [
        $productId,
        $offerType,
        $customerName,
        $customerPhone,
        $customerEmail,
        $projectInfo,
        $message,
        $ipAddress,
        $userAgent
    ]);

    if ($offerId) {
        $response['success'] = true;
        $response['message'] = 'Talebiniz başarıyla kaydedildi. En kısa sürede size dönüş yapacağız.';
        $response['offer_id'] = $offerId;
        
        // Email bildirimi (opsiyonel)
        try {
            if (file_exists('../includes/mailer.php')) {
                require_once '../includes/mailer.php';
                
                $offerTypeNames = [
                    'production' => 'Parça İmalatı',
                    'repair' => 'Bakım-Onarım',
                    'service' => 'Teknik Hizmet'
                ];
                
                $emailBody = "
                    <h2>Yeni Teklif Talebi</h2>
                    <p><strong>Teklif Türü:</strong> {$offerTypeNames[$offerType]}</p>
                    <p><strong>Müşteri:</strong> {$customerName}</p>
                    <p><strong>Telefon:</strong> {$customerPhone}</p>
                    <p><strong>E-posta:</strong> {$customerEmail}</p>
                    <p><strong>İş Detayları:</strong> {$projectInfo}</p>
                    <p><strong>Mesaj:</strong> {$message}</p>
                    <p><strong>Tarih:</strong> " . date('d.m.Y H:i') . "</p>
                ";
                
                // Admin'e bildirim gönder (mailer.php'de yapılandırılmışsa)
                // sendNotificationEmail('Yeni Teklif Talebi', $emailBody);
            }
        } catch (Exception $e) {
            // Email hatası loglanır ama kullanıcıya başarılı dönülür
            error_log("Email notification error: " . $e->getMessage());
        }
        
    } else {
        throw new Exception('Kayıt yapılamadı');
    }

} catch (Exception $e) {
    $response['message'] = 'Hata: ' . $e->getMessage();
    error_log("Offer save error: " . $e->getMessage());
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);

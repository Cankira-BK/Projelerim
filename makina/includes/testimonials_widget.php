<?php
// Onaylanmış yorumları çek
function getApprovedTestimonials($limit = 3) {
    global $db;
    return $db->fetchAll(
        "SELECT * FROM testimonials WHERE status = 'approved' ORDER BY RAND() LIMIT ?",
        [$limit]
    );
}

// Yorum formu işleme
function submitTestimonial($data) {
    global $db;
    
    $sql = "INSERT INTO testimonials (customer_name, customer_city, rating, comment, vehicle_id, status) 
            VALUES (?, ?, ?, ?, ?, 'pending')";
    
    $testimonialId = $db->insert($sql, [
        sanitize($data['customer_name']),
        sanitize($data['customer_city'] ?? ''),
        (int)($data['rating'] ?? 5),
        sanitize($data['comment']),
        !empty($data['vehicle_id']) ? (int)$data['vehicle_id'] : null
    ]);
    
    // Log
    logSecurity('data_change', 'customer', 'Testimonial submitted: ' . $testimonialId);
    
    return $testimonialId;
}

// Yıldız gösterimi
function renderStars($rating) {
    $stars = '';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rating) {
            $stars .= '⭐';
        } else {
            $stars .= '☆';
        }
    }
    return $stars;
}
?>
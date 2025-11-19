<?php
// YENİ ŞİFRENİZİ BURAYA YAZIN
$yeni_sifre = "admin123";

echo password_hash($yeni_sifre, PASSWORD_DEFAULT);
?>
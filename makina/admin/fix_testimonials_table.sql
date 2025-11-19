-- Testimonials tablosuna customer_location ve customer_title sütunlarını ekle
-- Bu dosyayı phpMyAdmin'de SQL sekmesinden çalıştırın

ALTER TABLE `testimonials` 
ADD COLUMN `customer_location` VARCHAR(255) DEFAULT NULL AFTER `customer_name`;

-- Not: customer_title sütunu zaten mevcut, sadece customer_location eklendi

-- database.sql
-- Run this script in your MySQL environment to initialize the database tables.

CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `role` VARCHAR(20) DEFAULT 'admin',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `inquiries` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL,
    `phone` VARCHAR(20) DEFAULT NULL,
    `service_required` VARCHAR(100) NOT NULL,
    `budget` VARCHAR(50) DEFAULT NULL,
    `message` TEXT NOT NULL,
    `status` ENUM('new', 'contacted', 'closed') DEFAULT 'new',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `services` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `slug` VARCHAR(100) NOT NULL UNIQUE,
    `title` VARCHAR(150) NOT NULL,
    `short_desc` TEXT NOT NULL,
    `full_desc` LONGTEXT,
    `icon_class` VARCHAR(50) DEFAULT 'bi-gear',
    `sort_order` INT DEFAULT 0
);

CREATE TABLE IF NOT EXISTS `projects` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(150) NOT NULL,
    `category` ENUM('Web', 'Mobile', 'POS', 'Enterprise') NOT NULL,
    `client_name` VARCHAR(100) DEFAULT NULL,
    `image_url` VARCHAR(255) DEFAULT NULL,
    `description` TEXT,
    `live_url` VARCHAR(255) DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert a default admin user (Password is 'admin123')
INSERT INTO `users` (`username`, `password`, `role`) VALUES ('admin', '$2y$10$h2IsxUPEsVY7S1SpxT8HJ.nIqFPjIxvgARY4lTFeq2Vk3Nqu6vTb.', 'admin') ON DUPLICATE KEY UPDATE `password`='$2y$10$h2IsxUPEsVY7S1SpxT8HJ.nIqFPjIxvgARY4lTFeq2Vk3Nqu6vTb.';

-- Insert default services
INSERT INTO `services` (`slug`, `title`, `short_desc`, `icon_class`) VALUES 
('custom-web', 'Custom Web Development', 'Modern, responsive, and secure web applications.', 'bi-laptop'),
('mobile-app', 'Mobile App Development', 'Native and cross-platform apps for iOS and Android.', 'bi-phone'),
('pos-erp', 'POS & ERP Systems', 'Scalable systems for retail and enterprise inventory.', 'bi-calculator'),
('it-support', '24/7 Digital Support', 'Continuous maintenance and infrastructure support.', 'bi-headset')
ON DUPLICATE KEY UPDATE `slug`=`slug`;

CREATE TABLE IF NOT EXISTS `settings` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `setting_key` VARCHAR(100) NOT NULL UNIQUE,
    `setting_value` TEXT NOT NULL
);

-- Insert default settings
INSERT INTO `settings` (`setting_key`, `setting_value`) VALUES 
('site_name', 'AZLAL (Pvt) Ltd.'),
('contact_email', 'info@azlal.net'),
('contact_phone', '+94 123 456 789'),
('contact_address', 'Colombo, Sri Lanka'),
('footer_text', 'Your trusted partner in modern digital solutions. We deliver high-performance Web, Mobile, and Enterprise software.'),
('logo_path', 'assets/images/logo.png')
ON DUPLICATE KEY UPDATE `setting_key`=`setting_key`;

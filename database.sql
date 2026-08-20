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
INSERT INTO `users` (`username`, `password`, `role`) VALUES ('admin', '$2y$10$wN3tVqV1u1bY1O3Q6r/Npe9M9r4b3YmOqR0m6G8d.hYwH.B2nN78y', 'admin') ON DUPLICATE KEY UPDATE `username`=`username`;

-- Insert default services
INSERT INTO `services` (`slug`, `title`, `short_desc`, `icon_class`) VALUES 
('custom-web', 'Custom Web Development', 'Modern, responsive, and secure web applications.', 'bi-laptop'),
('mobile-app', 'Mobile App Development', 'Native and cross-platform apps for iOS and Android.', 'bi-phone'),
('pos-erp', 'POS & ERP Systems', 'Scalable systems for retail and enterprise inventory.', 'bi-calculator'),
('it-support', '24/7 Digital Support', 'Continuous maintenance and infrastructure support.', 'bi-headset')
ON DUPLICATE KEY UPDATE `slug`=`slug`;

<?php
require_once 'config/db.php';

try {
    // Create users table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `users` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `username` VARCHAR(50) NOT NULL UNIQUE,
        `password` VARCHAR(255) NOT NULL,
        `role` VARCHAR(20) DEFAULT 'admin',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Create inquiries table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `inquiries` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(100) NOT NULL,
        `email` VARCHAR(150) NOT NULL,
        `phone` VARCHAR(20) DEFAULT NULL,
        `service_required` VARCHAR(100) NOT NULL,
        `budget` VARCHAR(50) DEFAULT NULL,
        `message` TEXT NOT NULL,
        `status` ENUM('new', 'contacted', 'closed') DEFAULT 'new',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Create services table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `services` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `slug` VARCHAR(100) NOT NULL UNIQUE,
        `title` VARCHAR(150) NOT NULL,
        `short_desc` TEXT NOT NULL,
        `full_desc` LONGTEXT,
        `icon_class` VARCHAR(50) DEFAULT 'bi-gear',
        `sort_order` INT DEFAULT 0
    )");
    
    // Create projects table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `projects` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(150) NOT NULL,
        `category` ENUM('Web', 'Mobile', 'POS', 'Enterprise') NOT NULL,
        `client_name` VARCHAR(100) DEFAULT NULL,
        `image_url` VARCHAR(255) DEFAULT NULL,
        `description` TEXT,
        `live_url` VARCHAR(255) DEFAULT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // Ensure admin user exists and reset password to admin123
    $passwordHash = password_hash('admin123', PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = 'admin'");
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $updateStmt = $pdo->prepare("UPDATE users SET password = ? WHERE username = 'admin'");
        $updateStmt->execute([$passwordHash]);
        echo "Admin user password updated to 'admin123'.\n";
    } else {
        $insertStmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES ('admin', ?, 'admin')");
        $insertStmt->execute([$passwordHash]);
        echo "Admin user created with password 'admin123'.\n";
    }
    
    echo "Database setup completed successfully.\n";

} catch (PDOException $e) {
    echo "Error setting up database: " . $e->getMessage() . "\n";
}

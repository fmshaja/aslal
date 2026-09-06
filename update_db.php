<?php
require 'config/db.php';
$sql = "
CREATE TABLE IF NOT EXISTS `settings` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `setting_key` VARCHAR(100) NOT NULL UNIQUE,
    `setting_value` TEXT NOT NULL
);
INSERT INTO `settings` (`setting_key`, `setting_value`) VALUES 
('site_name', 'AZLAL (Pvt) Ltd.'),
('contact_email', 'info@azlal.net'),
('contact_phone', '+94 123 456 789'),
('contact_address', 'Colombo, Sri Lanka'),
('footer_text', 'Your trusted partner in modern digital solutions. We deliver high-performance Web, Mobile, and Enterprise software.'),
('logo_path', 'assets/images/logo.png')
ON DUPLICATE KEY UPDATE `setting_key`=`setting_key`;
";
try {
    $pdo->exec($sql);
    echo "DB Updated";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

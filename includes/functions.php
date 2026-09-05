<?php
// includes/functions.php

session_start();

function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

function redirect($url) {
    header("Location: $url");
    exit();
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        redirect('login.php');
    }
}

function generateCSRFToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verifyCSRFToken($token) {
    if (isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token)) {
        return true;
    }
    return false;
}

function getSettings() {
    global $pdo;
    static $settings = null;
    if ($settings === null) {
        try {
            $stmt = $pdo->query("SELECT setting_key, setting_value FROM settings");
            $settings = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
        } catch (\PDOException $e) {
            $settings = []; // Fallback if table doesn't exist yet
        }
    }
    return $settings;
}

// Define dynamic constants
$global_settings = getSettings();
if (!defined('SITE_NAME')) define('SITE_NAME', $global_settings['site_name'] ?? 'AZLAL (Pvt) Ltd.');
if (!defined('CONTACT_EMAIL')) define('CONTACT_EMAIL', $global_settings['contact_email'] ?? 'info@azlal.net');
if (!defined('CONTACT_PHONE')) define('CONTACT_PHONE', $global_settings['contact_phone'] ?? '');
if (!defined('CONTACT_ADDRESS')) define('CONTACT_ADDRESS', $global_settings['contact_address'] ?? '');
if (!defined('FOOTER_TEXT')) define('FOOTER_TEXT', $global_settings['footer_text'] ?? '');
if (!defined('LOGO_PATH')) define('LOGO_PATH', $global_settings['logo_path'] ?? 'assets/images/logo.png');

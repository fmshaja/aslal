<?php
// config/db.php

// Check if running on localhost (or via CLI for testing)
$is_local = in_array($_SERVER['HTTP_HOST'] ?? '', ['localhost', '127.0.0.1']) || php_sapi_name() === 'cli';

if ($is_local) {
    // Local environment credentials
    $host = 'localhost';
    $dbname = 'azlal_db';
    $username = 'root';
    $password = '';
} else {
    // Production web hosting credentials
    $host = 'localhost';
    $dbname = 'jjelectr_azlal';
    $username = 'jjelectr_azlal';
    $password = '[4}J3lO8qU=uq&CR';
}

$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (\PDOException $e) {
    // In a production environment, avoid showing the exact error message to users
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
}

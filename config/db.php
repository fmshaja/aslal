<?php
// config/db.php

$host = 'localhost';
$dbname = 'jjelectr_azlal';
$username = 'jjelectr_azlal';
$password = '[4}J3lO8qU=uq&CR';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (\PDOException $e) {
    // In a production environment, avoid showing the exact error message to users
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

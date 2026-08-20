<?php
// config/database.php
$host = 'localhost'; // Usually localhost
$db_name = 'azlal_db'; // Change to your database name
$username = 'root'; // Change to your DB username
$password = ''; // Change to your DB password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // In production, log the error rather than displaying it
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>

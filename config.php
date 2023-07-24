<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'diary_db');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

// Establish database connection using PDO
try {
    $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<?php
$host = 'localhost';  // Database host
$dbname = 'online_job';  // Database name
$username = 'root';  // Your database username (default for XAMPP is 'root')
$password = '';  // Your database password (default for XAMPP is empty)

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>
<?php
// Database connection settings
$host = 'localhost'; // Database host (e.g., localhost for local development)
$dbname = 'online_job'; // Name of the database
$username = 'root'; // Database username (default for XAMPP is 'root')
$password = ''; // Database password (default for XAMPP is empty)

// Set up a PDO instance for connecting to the MySQL database
try {
    // Create a new PDO instance and set error mode to exceptions
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception to handle any errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Optionally, you can set the character encoding
    $pdo->exec("SET NAMES 'utf8'");
    
    // You can add a success message or log here if needed
    // echo "Connected to the database successfully!";
} catch (PDOException $e) {
    // If there is an error connecting to the database, it will throw an exception
    // You can log the error or display a generic message
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>
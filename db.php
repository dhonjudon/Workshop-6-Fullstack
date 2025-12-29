<?php
/**
 * Database Connection File
 * Uses PDO for secure database operations
 */

// Database configuration
$host = 'localhost';
$dbname = 'school_db';
$username = 'root';  // Default XAMPP MySQL username
$password = '';      // Default XAMPP MySQL password (empty)

try {
    // Create PDO connection with error mode set to exception
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Set default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Success message (optional - can be commented out for production)
    // echo "Database connection successful!";

} catch (PDOException $e) {
    // Display error message
    die("Connection failed: " . $e->getMessage());
}
?>
<?php
/**
 * Database Setup Script
 * Run this file once to create the database and table
 * Access: http://localhost/wsp6/setup.php
 */

$host = 'localhost';
$username = 'root';
$password = '';

try {
    // Connect to MySQL server without database
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h2>Setting up database...</h2>";

    // Create database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS school_db");
    echo "<p>✓ Database 'school_db' created successfully!</p>";

    // Use the database
    $pdo->exec("USE school_db");

    // Create students table
    $sql = "CREATE TABLE IF NOT EXISTS students (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        course VARCHAR(100) NOT NULL
    )";
    $pdo->exec($sql);
    echo "<p>✓ Table 'students' created successfully!</p>";

    // Check if table is empty
    $stmt = $pdo->query("SELECT COUNT(*) FROM students");
    $count = $stmt->fetchColumn();

    if ($count == 0) {
        // Insert sample data
        $sql = "INSERT INTO students (name, email, course) VALUES
            ('John Doe', 'john.doe@email.com', 'Computer Science'),
            ('Jane Smith', 'jane.smith@email.com', 'Information Technology'),
            ('Michael Johnson', 'michael.j@email.com', 'Software Engineering'),
            ('Emily Brown', 'emily.brown@email.com', 'Data Science'),
            ('David Wilson', 'david.wilson@email.com', 'Cybersecurity')";
        $pdo->exec($sql);
        echo "<p>✓ 5 sample student records inserted successfully!</p>";
    } else {
        echo "<p>ℹ Table already contains $count student(s). Skipping sample data insertion.</p>";
    }

    echo "<h3 style='color: green;'>✓ Setup completed successfully!</h3>";
    echo "<p><a href='index.php' style='display: inline-block; padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 5px;'>Go to Student List</a></p>";
    echo "<p style='color: #666; margin-top: 20px;'><small>You can delete this setup.php file after successful setup.</small></p>";

} catch (PDOException $e) {
    echo "<h3 style='color: red;'>✗ Error:</h3>";
    echo "<p style='color: red;'>" . $e->getMessage() . "</p>";
    echo "<p>Make sure XAMPP MySQL is running!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }

        h2 {
            color: #333;
        }

        p {
            line-height: 1.6;
        }
    </style>
</head>

<body>
</body>

</html>
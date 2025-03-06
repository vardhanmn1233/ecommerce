<?php
$host = "localhost";      // XAMPP default host
$dbname = "ecommerce"; // Change to your database name
$user = "root";           // XAMPP default MySQL user
$password = "";           // Default is empty

try {
    // Create PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    
    // Set error mode to Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Uncomment this line for debugging
    // echo "Database connected successfully!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
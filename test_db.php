<?php
$servername = "localhost";  // Server name (default: localhost)
$username = "root";         // MySQL username (default: root)
$password = "";             // MySQL password (default: empty)
$dbname = "ecommerce";   // Database name (change if needed)

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Database connected successfully!";
?>

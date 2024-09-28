
<?php

// Include the database connection
include '../php/db.php';

// Include the database connection
include '../php/db.php';  // This file should contain the $conn variable initialization

// Database connection initialization
$host = 'localhost';    // Database host (usually 'localhost')
$db = 'glowcosmetics'; // Database name (change to your actual database name)
$user = 'root';         // Database username (change as per your database setup)
$pass = '';             // Database password (leave empty if no password is set)

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit(); // Exit the script if connection fails
}

// Fetch products from the database
$sql = "SELECT * FROM products LIMIT 6"; // Fetch top 6 products (you can adjust as needed)
$stmt = $conn->prepare($sql);  // Prepare the SQL statement
$stmt->execute();  // Execute the statement
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Fetch the results
?>

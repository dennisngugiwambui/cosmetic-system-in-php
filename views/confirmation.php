
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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glow Cosmetics - Order Confirmation</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 600px;
            margin: 0 auto;
            padding: 2rem;
        }

        .confirmation-box {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
        }

        h1 {
            color: #ff69b4;
            margin-bottom: 1rem;
        }

        .order-number {
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .order-details {
            margin-top: 2rem;
            text-align: left;
        }

        .order-details h2 {
            color: #ff69b4;
            margin-bottom: 1rem;
        }

        .order-items {
            list-style-type: none;
        }

        .order-items li {
            margin-bottom: 0.5rem;
        }

        .order-total {
            font-weight: bold;
            margin-top: 1rem;
        }

        .back-to-shop {
            display: inline-block;
            margin-top: 2rem;
            background-color: #ff69b4;
            color: #fff;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-to-shop:hover {
            background-color: #ff1493;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="confirmation-box">
        <h1>Thank You for Your Order!</h1>
        <p class="order-number">Order Number: #12345</p>
        <p>Your order has been successfully placed and will be processed shortly.</p>

        <a href="index.php" class="back-to-shop">Continue Shopping</a>
    </div>
</div>
</body>
</html>
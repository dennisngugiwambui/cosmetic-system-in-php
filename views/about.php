
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
    <title>Glow Cosmetics - Radiant Lipstick</title>
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .product-container {
            display: flex;
            flex-wrap: wrap;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .product-image {
            flex: 1;
            min-width: 300px;
            background-color: #f9f9f9;
            padding: 2rem;
        }

        .product-image img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .product-details {
            flex: 1;
            min-width: 300px;
            padding: 2rem;
        }

        h1 {
            color: #ff69b4;
            margin-bottom: 1rem;
        }

        .price {
            font-size: 1.5rem;
            color: #ff69b4;
            margin-bottom: 1rem;
        }

        .description {
            margin-bottom: 1.5rem;
        }

        .features {
            margin-bottom: 1.5rem;
        }

        .features h3 {
            color: #ff69b4;
            margin-bottom: 0.5rem;
        }

        .features ul {
            list-style-type: none;
        }

        .features li:before {
            content: "✓";
            color: #ff69b4;
            margin-right: 0.5rem;
        }

        .add-to-cart {
            background-color: #ff69b4;
            color: #fff;
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-to-cart:hover {
            background-color: #ff1493;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="product-container">
        <div class="product-image">
            <img src="https://via.placeholder.com/400x400" alt="Radiant Lipstick">
        </div>
        <div class="product-details">
            <h1>Radiant Lipstick</h1>
            <p class="price">$19.99</p>
            <div class="description">
                <p>Our Radiant Lipstick is a luxurious, long-lasting formula that provides vibrant color and hydration. Infused with nourishing oils and vitamins, this lipstick glides on smoothly for a flawless finish that lasts all day.</p>
            </div>
            <div class="features">
                <h3>Features:</h3>
                <ul>
                    <li>Long-lasting color</li>
                    <li>Hydrating formula</li>
                    <li>Enriched with vitamins E and C</li>
                    <li>Cruelty-free and vegan</li>
                    <li>Available in 12 stunning shades</li>
                </ul>
            </div>
            <button class="add-to-cart">Add to Cart</button>
        </div>
    </div>
</div>
</body>
</html>

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
    <title>Glow Cosmetics - Checkout</title>
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
            background-color: #fff1f8;
        }

        .container {
            width: 90%;
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }

        h1 {
            color: #ff69b4;
            text-align: center;
            margin-bottom: 2rem;
        }

        .checkout-form {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
        }

        input, select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
        }

        .form-row .form-group {
            width: 48%;
        }

        .order-summary {
            background-color: #fff7fa;
            padding: 1rem;
            border-radius: 5px;
            margin-top: 2rem;
        }

        .order-summary h2 {
            color: #ff69b4;
            margin-bottom: 1rem;
        }

        .order-total {
            font-weight: bold;
            margin-top: 1rem;
        }

        .place-order-btn {
            display: block;
            width: 100%;
            background-color: #ff69b4;
            color: #fff;
            text-align: center;
            padding: 1rem;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 2rem;
        }

        .place-order-btn:hover {
            background-color: #ff1493;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Checkout</h1>
    <form class="checkout-form">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" required>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" required>
            </div>
            <div class="form-group">
                <label for="zip">ZIP Code</label>
                <input type="text" id="zip" name="zip" required>
            </div>
        </div>
        <div class="form-group">
            <label for="card-number">Card Number</label>
            <input type="text" id="card-number" name="card-number" required>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="expiry">Expiry Date</label>
                <input type="text" id="expiry" name="expiry" placeholder="MM/YY" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" required>
            </div>
        </div>
        <div class="order-summary">
            <h2>Order Summary</h2>
            <p>Glow Foundation x1: $29.99</p>
            <p>Radiant Lipstick x2: $39.98</p>
            <p class="order-total">Total: $69.97</p>
        </div>
        <button type="submit" class="place-order-btn">Place Order</button>
    </form>
</div>
</body>
</html>
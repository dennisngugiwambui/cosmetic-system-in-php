<?php
session_start();
include "db.php";

global $conn;

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit();
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Get product details from the products table based on the selected product ID
$product_id = $_POST['product_id'];
$sql_product = "SELECT name, price FROM products WHERE id = :product_id";
$stmt_product = $conn->prepare($sql_product);
$stmt_product->bindParam(':product_id', $product_id, PDO::PARAM_INT);
$stmt_product->execute();
$product = $stmt_product->fetch(PDO::FETCH_ASSOC);

if ($product) {
    $product_name = $product['name'];
    $price = $product['price'];
    $quantity = 1; // Default quantity for Buy Now

    // Check if the product already exists in the cart for this user
    $sql_check = "SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt_check->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt_check->execute();

    if ($stmt_check->rowCount() > 0) {
        // If the product already exists in the cart, increase the quantity
        $sql_update = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = :user_id AND product_id = :product_id";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt_update->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt_update->execute();
    } else {
        // Insert the new product into the cart
        $sql_insert = "INSERT INTO cart (user_id, product_id, product_name, price, quantity) 
                       VALUES (:user_id, :product_id, :product_name, :price, :quantity)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt_insert->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt_insert->bindParam(':product_name', $product_name, PDO::PARAM_STR);
        $stmt_insert->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt_insert->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt_insert->execute();
    }

    // Redirect to the cart page after adding the product
    header("Location: ../views/cart.php");
    exit();
} else {
    echo "Product not found!";
}
?>

<?php
session_start();
include '../php/db.php';
global $conn;

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit();
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Fetch cart items for the user
$sql = "SELECT cart.product_id, cart.quantity, products.price 
        FROM cart 
        JOIN products ON cart.product_id = products.id 
        WHERE cart.user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if cart is not empty
if (count($cart_items) > 0) {
    $total_cost = 0;
    $conn->beginTransaction(); // Start the transaction

    try {
        // Loop through cart items and insert them into the orders table
        foreach ($cart_items as $item) {
            $product_id = $item['product_id'];
            $quantity = $item['quantity'];
            $price = $item['price'];
            $total_item_cost = $price * $quantity;
            $total_cost += $total_item_cost;

            // Insert order details into orders table
            $sql_insert_order = "INSERT INTO orders (user_id, product_id, order_date, quantity, total_cost, status) 
                                 VALUES (:user_id, :product_id, NOW(), :quantity, :total_cost, 'Completed')";
            $stmt_insert_order = $conn->prepare($sql_insert_order);
            $stmt_insert_order->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt_insert_order->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt_insert_order->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt_insert_order->bindParam(':total_cost', $total_item_cost, PDO::PARAM_STR);
            $stmt_insert_order->execute();
        }

        // After inserting into the orders table, remove products from the cart
        $sql_delete_cart = "DELETE FROM cart WHERE user_id = :user_id";
        $stmt_delete_cart = $conn->prepare($sql_delete_cart);
        $stmt_delete_cart->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt_delete_cart->execute();

        // Commit the transaction
        $conn->commit();

        // Redirect to the confirmation page
        header("Location: ../views/confirmation.php");
        exit();
    } catch (Exception $e) {
        // Rollback the transaction if something went wrong
        $conn->rollBack();
        echo "Checkout failed: " . $e->getMessage();
    }
} else {
    // If cart is empty, redirect back to the cart page
    header("Location: ../views/cart.php");
    exit();
}
?>

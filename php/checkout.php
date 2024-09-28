<?php
session_start();
include 'db.php';

if (isset($_POST['checkout'])) {
    $user_id = $_SESSION['user_id'];
    $cart_items = $_SESSION['cart'];

    $conn->beginTransaction();

    try {
        $sql = "INSERT INTO orders (user_id) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_id]);
        $order_id = $conn->lastInsertId();

        foreach ($cart_items as $item) {
            $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$order_id, $item['id'], $item['quantity'], $item['price']]);
        }

        $conn->commit();
        unset($_SESSION['cart']);  // Empty the cart after order

        header('Location: success.php');
    } catch (Exception $e) {
        $conn->rollBack();
        echo "Failed to complete order: " . $e->getMessage();
    }
}
?>

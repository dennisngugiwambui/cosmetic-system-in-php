<?php
// Include the database connection
include '../php/db.php';
global $conn;

// Check if product ID is passed in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Fetch the product details from the database
    $sql = "SELECT * FROM products WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
    $stmt->execute();

    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // Return the product data as JSON
    echo json_encode($product);
} else {
    // Return an error if no product ID is passed
    echo json_encode(['error' => 'Product ID not provided']);
}
?>

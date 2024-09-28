<?php
// Include database connection
include '../php/db.php';
global $conn;

// Check if product ID is passed in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Prepare and execute delete query
    $sql = "DELETE FROM products WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirect back to the product page (e.g., admin.php) with a success message
        header("Location: ../views/admin.php?panel=products&message=Product+deleted+successfully");
        exit();
    } else {
        // Redirect to the product page with an error message
        header("Location: ../views/admin.php?panel=products&error=Failed+to+delete+product");
        exit();
    }
} else {
    // If no product ID is passed, redirect to product page
    header("Location: ../views/admin.php?panel=products&error=No+product+selected");
    exit();
}
?>

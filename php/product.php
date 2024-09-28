<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../views/login.php");
    exit();
}

// Include the database connection
include '../php/db.php';
global $conn;

// Initialize error and success messages
$product_error = '';
$product_success = '';

// Process form data when submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $created_at = date('Y-m-d H:i:s');

    // Check if an image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];

        // Create a unique file name to avoid collisions (e.g., appending a timestamp)
        $unique_image_name = time() . '_' . basename($image);

        // Ensure the product_images directory exists
        $target_dir = "../product_images/"; // Directory to save images
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Set the target file path
        $target_file = $target_dir . $unique_image_name;

        // Upload the image file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Insert the new product into the database
            $sql = "INSERT INTO products (name, description, price, stock, image, created_at) 
                    VALUES (:name, :description, :price, :stock, :image, :created_at)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $product_name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':price', $price, PDO::PARAM_STR);
            $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
            $stmt->bindParam(':image', $unique_image_name, PDO::PARAM_STR); // Save just the image name
            $stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);

            if ($stmt->execute()) {
                // Redirect to products page with a success message
                header("Location: ../views/admin.php?panel=products&message=Product+added+successfully");
                exit();
            } else {
                // If the product insertion fails
                $product_error = "Failed to add product. Please try again.";
            }
        } else {
            $product_error = "Error uploading the product image.";
        }
    } else {
        $product_error = "No image selected or there was an error uploading the file.";
    }

    // If there was an error, redirect with the error message
    if (!empty($product_error)) {
        header("Location: ../views/admin.php?panel=products&error=" . urlencode($product_error));
        exit();
    }
}
?>

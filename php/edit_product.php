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

// Check if a product ID is passed via GET
if (!isset($_GET['id'])) {
    header("Location: admin.php?panel=products&error=No+product+selected");
    exit();
}

$product_id = $_GET['id'];

// Fetch the product details from the database
$sql = "SELECT * FROM products WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// If the product doesn't exist, redirect to the products page
if (!$product) {
    header("Location: admin.php?panel=products&error=Product+not+found");
    exit();
}

// Initialize error and success messages
$product_error = '';
$product_success = '';

// Process form data when submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Check if a new image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];

        // Create a unique file name to avoid collisions
        $unique_image_name = time() . '_' . basename($image);

        // Ensure the product_images directory exists
        $target_dir = "../product_images/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Set the target file path
        $target_file = $target_dir . $unique_image_name;

        // Upload the image file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = $unique_image_name;
        } else {
            $product_error = "Error uploading the product image.";
        }
    } else {
        // If no new image is uploaded, keep the old image
        $image_path = $product['image'];
    }

    // Update the product details in the database
    $sql = "UPDATE products SET name = :name, description = :description, price = :price, stock = :stock, image = :image WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $product_name, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':price', $price, PDO::PARAM_STR);
    $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
    $stmt->bindParam(':image', $image_path, PDO::PARAM_STR);
    $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirect to products page with success message
        header("Location: admin.php?panel=products&message=Product+updated+successfully");
        exit();
    } else {
        $product_error = "Failed to update product. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product | Glow Cosmetics</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .modal {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .modal-header h2 {
            margin: 0;
        }
        .modal-close {
            cursor: pointer;
            font-size: 24px;
            color: #333;
        }
        .modal form .form-group {
            margin-bottom: 15px;
        }
        .modal form .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .modal form .form-group input,
        .modal form .form-group textarea {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        .modal-footer button {
            padding: 10px 15px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .modal-footer button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<div class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Edit Product</h2>
            <span class="modal-close" onclick="window.location.href='admin.php?panel=products'">&times;</span>
        </div>

        <!-- Show error or success messages -->
        <?php if (!empty($product_error)): ?>
            <p style="color: red;"><?php echo $product_error; ?></p>
        <?php endif; ?>

        <form action="edit_product.php?id=<?php echo $product_id; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" rows="4" required><?php echo htmlspecialchars($product['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" name="price" step="0.01" value="<?php echo $product['price']; ?>" required>
            </div>
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" name="stock" value="<?php echo $product['stock']; ?>" required>
            </div>
            <div class="form-group">
                <label for="image">Product Image:</label>
                <input type="file" name="image" accept="image/*">
                <!-- Show current image -->
                <p>Current Image: <img src="../product_images/<?php echo $product['image']; ?>" alt="Product Image" width="100"></p>
            </div>
            <div class="modal-footer">
                <button type="submit" name="update_product">Update Product</button>
                <button type="button" onclick="window.location.href='admin.php?panel=products'">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

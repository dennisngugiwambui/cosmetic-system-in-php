<?php

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

/// Include the database connection
include '../php/db.php';
include "../php/product.php";
global $conn;

// Initialize error and success messages
$product_error = '';
$product_success = '';

// Fetch total products
try {
    $sql_products = "SELECT COUNT(*) as total_products FROM products";
    $stmt_products = $conn->prepare($sql_products);
    $stmt_products->execute();
    $total_products = $stmt_products->fetch(PDO::FETCH_ASSOC)['total_products'];
} catch (Exception $e) {
    $total_products = 0;
}

// Fetch total customers (usertype = 'customer')
try {
    $sql_customers = "SELECT COUNT(*) as total_customers FROM users WHERE usertype = 'customer'";
    $stmt_customers = $conn->prepare($sql_customers);
    $stmt_customers->execute();
    $total_customers = $stmt_customers->fetch(PDO::FETCH_ASSOC)['total_customers'];
} catch (Exception $e) {
    $total_customers = 0;
}

// Fetch total orders
try {
    $sql_orders = "SELECT COUNT(*) as total_orders FROM orders";
    $stmt_orders = $conn->prepare($sql_orders);
    $stmt_orders->execute();
    $total_orders = $stmt_orders->fetch(PDO::FETCH_ASSOC)['total_orders'];
} catch (Exception $e) {
    $total_orders = 0;
}

// Fetch total sales (sum of total_cost from orders)
try {
    $sql_sales = "SELECT SUM(total_cost) as total_sales FROM orders";
    $stmt_sales = $conn->prepare($sql_sales);
    $stmt_sales->execute();
    $total_sales = $stmt_sales->fetch(PDO::FETCH_ASSOC)['total_sales'];
    if ($total_sales === null) {
        $total_sales = 0;  // In case no sales have been made yet
    }
} catch (Exception $e) {
    $total_sales = 0;
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
    $created_at = date('Y-m-d H:i:s');

    // Check if an image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];

        // Create a unique file name to avoid collisions (e.g., appending a timestamp)
        $unique_image_name = time() . '_' . basename($image);

        // Ensure the product_images directory exists
        $target_dir = "../product_images/"; // Make sure this directory exists in your project
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Set the target file path
        $target_file = $target_dir . $unique_image_name;

        // Upload the image file
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $product_error = "Error uploading the product image.";
        } else {
            // Insert the new product into the database, saving only the unique image name
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
                // Product insertion successful
                $product_success = "Product added successfully!";
            } else {
                // Product insertion failed
                $product_error = "Failed to add product. Please try again.";
            }
        }
    } else {
        $product_error = "No image selected or there was an error uploading the file.";
    }

    // Check if there is a success or error message in the URL
    if (isset($_GET['message'])) {
        echo "<p style='color: green; font-size: 18px; text-align: center;'>" . htmlspecialchars($_GET['message']) . "</p>";
    }

    if (isset($_GET['error'])) {
        echo "<p style='color: red; font-size: 18px; text-align: center;'>" . htmlspecialchars($_GET['error']) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Glow Cosmetics</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>

        /* Style for the Action Buttons in Product Table */
        .btn {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 4px;
            color: white;
            text-decoration: none;
            margin-right: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-edit {
            background-color: #3498db; /* Blue for Edit */
        }

        .btn-delete {
            background-color: #e74c3c; /* Red for Delete */
        }

        .btn-edit:hover {
            background-color: #2980b9; /* Darker blue on hover */
        }

        .btn-delete:hover {
            background-color: #c0392b; /* Darker red on hover */
        }

        .btn i {
            margin-right: 5px; /* Add some space between the icon and text */
        }

        .add-product-btn {
            display: inline-flex;
            align-items: center;
            background-color: #3498db; /* Blue background */
            color: white; /* White text */
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .add-product-btn i {
            margin-right: 10px; /* Space between the icon and text */
            font-size: 18px;
        }

        .add-product-btn:hover {
            background-color: #2980b9; /* Darker blue on hover */
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2); /* More shadow on hover */
        }

        .add-product-btn:focus {
            outline: none; /* Remove outline on focus */
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.4); /* Add focus ring */
        }

        /* Styles for Sidebar and Layout */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            background-color: #f4f4f4;
        }

        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            height: 100vh;
            position: fixed;
        }

        .logo {
            padding: 20px;
            text-align: center;
            background-color: #34495e;
        }

        .sidebar-menu {
            list-style-type: none;
            padding: 0;
        }

        .sidebar-menu li {
            padding: 15px 20px;
        }

        .sidebar-menu li a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .sidebar-menu li a:hover, .sidebar-menu li a.active {
            background-color: #34495e;
        }

        .sidebar-menu li i {
            margin-right: 10px;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
            background-color: white;
        }

        /* Header Styles */
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-header h1 {
            color: #2c3e50;
        }

        .header-icons a {
            color: #2c3e50;
            margin-left: 15px;
        }

        .header-icons i {
            font-size: 24px;
        }

        /* Dashboard Widgets */
        .dashboard-widgets {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .widget {
            display: flex;
            align-items: center;
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .widget i {
            font-size: 36px;
            margin-right: 15px;
            color: #3498db;
        }

        .widget h3 {
            margin: 0;
            font-size: 24px;
        }

        .widget p {
            color: #7f8c8d;
        }

        /* Table Styles */
        .content-table {
            margin-top: 40px;
        }

        .content-table h2 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead {
            background-color: #34495e;
            color: white;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tbody tr:hover {
            background-color: #ecf0f1;
        }

        /* Modal styles for Adding Products */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
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
<div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <h2>Glow Cosmetics</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="#" class="active" onclick="showPanel('dashboard')"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="#" onclick="showPanel('products')"><i class="fas fa-box"></i> Products</a></li>
            <li><a href="#" onclick="showPanel('customers')"><i class="fas fa-users"></i> Customers</a></li>
            <li><a href="#" onclick="showPanel('orders')"><i class="fas fa-shopping-cart"></i> Orders</a></li>
            <li><a href="../php/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li> <!-- Updated logout link -->
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <header class="admin-header">
            <h1>Welcome, Admin</h1>
            <div class="header-icons">
                <a href="#"><i class="fas fa-bell"></i></a>
                <a href="#"><i class="fas fa-user-circle"></i></a>
            </div>
        </header>

        <!-- Dashboard Section -->
        <section class="dashboard-widgets content-panel" id="dashboard">
            <div class="widget">
                <i class="fas fa-box"></i>
                <div>
                    <h3><?php echo $total_products; ?></h3>
                    <p>Total Products</p>
                </div>
            </div>
            <div class="widget">
                <i class="fas fa-users"></i>
                <div>
                    <h3><?php echo $total_customers; ?></h3>
                    <p>Total Customers</p>
                </div>
            </div>
            <div class="widget">
                <i class="fas fa-shopping-cart"></i>
                <div>
                    <h3><?php echo $total_orders; ?></h3>
                    <p>Total Orders</p>
                </div>
            </div>
            <div class="widget">
                <i class="fas fa-dollar-sign"></i>
                <div>
                    <h3>$12,345</h3>
                    <p>Total Sales</p>
                </div>
            </div>
        </section>

        <!-- Products Section -->
        <section class="content-table content-panel" id="products" style="display: none;">
            <h2>Products</h2>
            <!-- Add Fancy Button for Adding Products -->
            <button class="add-product-btn" onclick="document.getElementById('addProductModal').style.display='flex'">
                <i class="fas fa-plus"></i> Add New Product
            </button>


            <!-- Modal for adding a new product -->
            <div id="addProductModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Add New Product</h2>
                        <span class="modal-close" onclick="document.getElementById('addProductModal').style.display='none'">&times;</span>
                    </div>
                    <form action="../php/product.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="productName">Product Name:</label>
                            <input type="text" name="product_name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" name="price" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock:</label>
                            <input type="number" name="stock" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Product Image:</label>
                            <input type="file" name="image" accept="image/*" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="add_product">Add Product</button>
                            <button type="button" onclick="document.getElementById('addProductModal').style.display='none'">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

            <table>
                <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // Fetch products from the database
                try {
                    $sql = "SELECT * FROM products";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($products as $product) {
                        echo "<tr>";
                        echo "<td>#P{$product['id']}</td>";
                        echo "<td>{$product['name']}</td>";
                        echo "<td>\${$product['price']}</td>";
                        echo "<td>{$product['stock']}</td>";
                        echo "<td>" . ($product['stock'] > 0 ? 'Active' : 'Out of Stock') . "</td>";
                        echo "<td>{$product['created_at']}</td>";
                        echo "<td>
                        
                            <button class='btn btn-edit' onclick='openEditModal({$product['id']})'>
                                <i class='fas fa-edit'></i> Edit
                            </button>
    
                            <!-- Delete Button -->
                            <a href='../php/delete_product.php?id={$product['id']}' class='btn btn-delete' onclick='return confirm(\"Are you sure you want to delete this product?\");'>
                                <i class='fas fa-trash'></i>
                            </a>
                          </td>";
                        echo "</tr>";
                        echo "</tr>";
                    }
                } catch (Exception $e) {
                    echo "<tr><td colspan='6'>Error fetching products: " . $e->getMessage() . "</td></tr>";
                }
                ?>
                </tbody>
            </table>
            <!-- Modal for Editing a Product -->
            <div id="editProductModal" class="modal" style="display: none;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Edit Product</h2>
                        <span class="modal-close" onclick="closeEditModal()">&times;</span>
                    </div>

                    <form id="editProductForm" method="POST" enctype="multipart/form-data" action="../php/edit_product.php">
                        <input type="hidden" name="product_id" id="editProductId"> <!-- Hidden input for product ID -->

                        <div class="form-group">
                            <label for="editProductName">Product Name:</label>
                            <input type="text" name="product_name" id="editProductName" required>
                        </div>
                        <div class="form-group">
                            <label for="editDescription">Description:</label>
                            <textarea name="description" id="editDescription" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editPrice">Price:</label>
                            <input type="number" name="price" step="0.01" id="editPrice" required>
                        </div>
                        <div class="form-group">
                            <label for="editStock">Stock:</label>
                            <input type="number" name="stock" id="editStock" required>
                        </div>
                        <div class="form-group">
                            <label for="editImage">Product Image:</label>
                            <input type="file" name="image" id="editImage" accept="image/*">
                            <p>Current Image: <img id="currentProductImage" src="" alt="Product Image" width="100"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="update_product">Update Product</button>
                            <button type="button" onclick="closeEditModal()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Customers Section -->
        <section class="content-table content-panel" id="customers" style="display: none;">
            <h2>Customers</h2>
            <table>
                <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // Fetch customers from the database
                try {
                    $sql = "SELECT * FROM users WHERE usertype = 'customer'";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($customers as $customer) {
                        echo "<tr>";
                        echo "<td>#C{$customer['id']}</td>";
                        echo "<td>{$customer['name']}</td>";
                        echo "<td>{$customer['email']}</td>";
                        echo "<td>Active</td>";
                        echo "</tr>";
                    }
                } catch (Exception $e) {
                    echo "<tr><td colspan='4'>Error fetching customers: " . $e->getMessage() . "</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </section>

        <!-- Orders Section -->
        <section class="content-table content-panel" id="orders" style="display: none;">
            <h2>Recent Orders</h2>
            <table>
                <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // Fetch orders from the database
                try {
                    $sql = "SELECT orders.id as order_id, users.name as customer_name, orders.order_date, orders.status, orders.total_cost 
                            FROM orders
                            JOIN users ON orders.user_id = users.id";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($orders as $order) {
                        echo "<tr>";
                        echo "<td>#{$order['order_id']}</td>";
                        echo "<td>{$order['customer_name']}</td>";
                        echo "<td>{$order['order_date']}</td>";
                        echo "<td>{$order['status']}</td>";
                        echo "<td>\${$order['total_cost']}</td>";
                        echo "</tr>";
                    }
                } catch (Exception $e) {
                    echo "<tr><td colspan='5'>Error fetching orders: " . $e->getMessage() . "</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </section>

    </main>
</div>

<script>
    // JavaScript to switch between panels
    function showPanel(panelId) {
        const panels = document.querySelectorAll('.content-panel');
        panels.forEach(panel => {
            panel.style.display = 'none';
        });
        document.getElementById(panelId).style.display = 'block';

        // Remove active class from sidebar links
        const links = document.querySelectorAll('.sidebar-menu li a');
        links.forEach(link => {
            link.classList.remove('active');
        });

        // Add active class to the clicked link
        const activeLink = document.querySelector(`a[onclick="showPanel('${panelId}')"]`);
        activeLink.classList.add('active');
    }

    // Initialize the dashboard to show the dashboard panel by default
    document.addEventListener('DOMContentLoaded', () => {
        showPanel('dashboard');
    });

    // Script to close the modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('addProductModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    function openEditModal(productId) {
        // Make an AJAX call to get the product details for the given product ID
        fetch(`../php/get_product.php?id=${productId}`)
            .then(response => response.json())
            .then(data => {
                // Populate the form fields with product data
                document.getElementById('editProductId').value = data.id;
                document.getElementById('editProductName').value = data.name;
                document.getElementById('editDescription').value = data.description;
                document.getElementById('editPrice').value = data.price;
                document.getElementById('editStock').value = data.stock;
                document.getElementById('currentProductImage').src = `../product_images/${data.image}`;

                // Display the modal
                document.getElementById('editProductModal').style.display = 'flex';
            })
            .catch(error => {
                console.error('Error fetching product data:', error);
            });
    }

    function closeEditModal() {
        document.getElementById('editProductModal').style.display = 'none';
    }

    // Close the modal if user clicks outside of it
    window.onclick = function(event) {
        const modal = document.getElementById('editProductModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

</script>

</body>
</html>

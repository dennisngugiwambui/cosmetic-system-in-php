

<?php

// Include the database connection
include '../php/db.php';

// Database connection initialization
$host = 'localhost';    // Database host (usually 'localhost')
$db = 'glowcosmetics'; // Database name
$user = 'root';         // Database username
$pass = '';             // Database password

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit(); // Exit the script if connection fails
}

// Fetch products from the database
$sql = "SELECT * FROM products LIMIT 6"; // Fetch top 6 products
$stmt = $conn->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch Top 6 products for Top Sales
$sql_top_sales = "SELECT * FROM products ORDER BY stock DESC LIMIT 6";
$stmt_top_sales = $conn->prepare($sql_top_sales);
$stmt_top_sales->execute();
$top_sales_products = $stmt_top_sales->fetchAll(PDO::FETCH_ASSOC);

// Fetch Top 6 products for New Arrivals (Most recent products)
$sql_new_arrivals = "SELECT * FROM products ORDER BY created_at DESC LIMIT 6";
$stmt_new_arrivals = $conn->prepare($sql_new_arrivals);
$stmt_new_arrivals->execute();
$new_arrival_products = $stmt_new_arrivals->fetchAll(PDO::FETCH_ASSOC);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>



<body>

<nav class="navbar">
    <div class="navbar-container">
        <input type="checkbox" name="" id="checkbox">
        <div class="hamburger-lines">
            <span class="line line1"></span>
            <span class="line line2"></span>
            <span class="line line3"></span>
        </div>
        <ul class="menu-items">
            <li><a href="#home">Home</a></li>
            <li><a href="#sellers">Shop</a></li>
            <li><a href="contact.php">Contact</a></li>




        </ul>


        <ul class="menu-items">


            <li><a href="cart.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                    </svg></a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        </ul>



        <div class="logo">
            <!-- <img src="https://i.postimg.cc/TP6JjSTt/logo.webp" alt=""> -->
        </div>
    </div>
</nav>
<section id="home" >
    <div class="home_page ">
        <div class="home_img ">
            <img src="https://images.pexels.com/photos/755992/pexels-photo-755992.jpeg?auto=compress&cs=tinysrgb&w=600" alt="img ">
        </div>
        <div class="home_txt ">
            <p class="collectio ">SUMMER COLLECTION</p>
            <h2>FALL - WINTER<br>Collection 2023</h2>
            <div class="home_label ">
                <p>A specialist label creating luxury essentials. Ethically crafted<br>with an unwavering commitment to exceptional quality.</p>
            </div>
            <button><a href="#sellers">SHOP NOW</a><i class='bx bx-right-arrow-alt'></i></button>
            <div class="home_social_icons">
                <a href="#"><i class='bx bxl-facebook'></i></a>
                <a href="#"><i class='bx bxl-twitter'></i></a>
                <a href="#"><i class='bx bxl-pinterest'></i></a>
                <a href="#"><i class='bx bxl-instagram'></i></a>
            </div>
        </div>
    </div>
</section>


<section id="sellers">
    <div class="seller container">
        <h2>Top Sales</h2>
        <div class="best-seller">
            <!-- Loop through products and display them -->
            <?php foreach ($products as $product): ?>
                <div class="best-p1">
                    <img src="../product_images/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image">
                    <div class="best-p1-txt">
                        <div class="name-of-p">
                            <p><?php echo htmlspecialchars($product['name']); ?></p>
                        </div>
                        <div class="rating">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                        </div>
                        <div class="price">
                            &dollar;<?php echo htmlspecialchars($product['price']); ?>
                        </div>

                        <!-- Buy Now Button for each product -->
                        <div class="buy-now">
                            <form action="../php/add_to_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>">
                                <input type="hidden" name="price" value="<?php echo htmlspecialchars($product['price']); ?>">
                                <button type="submit">Buy Now</button>
                            </form>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="seller container">

        <!-- New Arrivals Section -->
        <section id="new-arrivals">
            <div class="seller container">
                <h2>New Arrivals</h2>
                <div class="best-seller">
                    <!-- Loop through New Arrivals products -->
                    <?php foreach ($new_arrival_products as $product): ?>
                        <div class="best-p1">
                            <img src="../product_images/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image">
                            <div class="best-p1-txt">
                                <div class="name-of-p">
                                    <p><?php echo htmlspecialchars($product['name']); ?></p>
                                </div>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bx-star'></i>
                                    <i class='bx bx-star'></i>
                                </div>
                                <div class="price">
                                    &dollar;<?php echo htmlspecialchars($product['price']); ?>
                                </div>

                                <!-- Buy Now Button for each product -->
                                <div class="buy-now">
                                    <form action="../php/add_to_cart.php" method="POST">
                                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>">
                                        <input type="hidden" name="price" value="<?php echo htmlspecialchars($product['price']); ?>">
                                        <button type="submit">Buy Now</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>


            </div>
        </div>
    </div>
    <div class="seller container">
        <h2>Hot Sales</h2>
        <div class="best-seller">
            <?php foreach ($top_sales_products as $product): ?>
                <div class="best-p1">
                    <img src="../product_images/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image">
                    <div class="best-p1-txt">
                        <div class="name-of-p">
                            <p><?php echo htmlspecialchars($product['name']); ?></p>
                        </div>
                        <div class="rating">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                        </div>
                        <div class="price">
                            &dollar;<?php echo htmlspecialchars($product['price']); ?>
                        </div>
                        <!-- Buy Now Button for each product -->
                        <div class="buy-now">
                            <form action="../php/add_to_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>">
                                <input type="hidden" name="price" value="<?php echo htmlspecialchars($product['price']); ?>">
                                <button type="submit">Buy Now</button>
                            </form>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

















<footer>
    <div class="footer-container container">

        <div class="content_2">
            <h4>SHOPPING</h4>
            <a href="#sellers">Trending Perfumes</a>
            <a href="#sellers">Accessories</a>
            <a href="#sellers">Sale</a>
        </div>
        <div class="content_3">
            <h4>SHOPPING</h4>
            <a href="./contact.html">Contact Us</a>
            <a href="https://payment-method-sb.netlify.app/" target="_blank">Payment Method</a>
            <a href="https://delivery-status-sb.netlify.app/" target="_blank">Delivery</a>
            <a href="https://codepen.io/sandeshbodake/full/Jexxrv" target="_blank">Return and Exchange</a>
        </div>
        <div class="content_4">
            <h4>NEWLETTER</h4>
            <p>Be the first to know about new<br>arrivals, look books, sales & promos!</p>


        </div>
    </div>

</footer>
</body>
</html>

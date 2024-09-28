
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
            <div class="best-p1">
                <img src="https://i.postimg.cc/8CmBZH5N/shoes.webp" alt="img">
                <div class="best-p1-txt">
                    <div class="name-of-p">
                        <p>PS England Shoes</p>
                    </div>
                    <div class="rating">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bx-star'></i>
                        <i class='bx bx-star'></i>
                    </div>
                    <div class="price">
                        &dollar;37.24
                        <div class="colors">
                            <i class='bx bxs-circle red'></i>
                            <i class='bx bxs-circle blue'></i>
                            <i class='bx bxs-circle white'></i>
                        </div>
                    </div>
                    <div class="buy-now">
                        <button><a href="https://codepen.io/sanketbodke/full/mdprZOq">Buy  Now</a></button>
                    </div>
                    <!-- <div class="add-cart">
                        <button>Add To Cart</button>
                    </div> -->
                </div>
            </div>
            <div class="best-p1">
                <img src="https://i.postimg.cc/76X9ZV8m/Screenshot_from_2022-06-03_18-45-12.png" alt="img">
                <div class="best-p1-txt">
                    <div class="name-of-p">
                        <p>PS England Jacket</p>
                    </div>
                    <div class="rating">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bx-star'></i>
                        <i class='bx bx-star'></i>
                        <i class='bx bx-star'></i>
                    </div>
                    <div class="price">
                        &dollar;17.24
                        <div class="colors">
                            <i class='bx bxs-circle green'></i>
                            <i class='bx bxs-circle grey'></i>
                            <i class='bx bxs-circle brown'></i>
                        </div>
                    </div>
                    <div class="buy-now">
                        <button><a href="https://codepen.io/sanketbodke/full/mdprZOq">Buy  Now</a></button>
                    </div>
                </div>
            </div>
            <div class="best-p1">
                <img src="https://i.postimg.cc/j2FhzSjf/bs2.png" alt="img">
                <div class="best-p1-txt">
                    <div class="name-of-p">
                        <p>PS England Shirt</p>
                    </div>
                    <div class="rating">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bx-star'></i>
                    </div>
                    <div class="price">
                        &dollar;27.24
                        <div class="colors">
                            <i class='bx bxs-circle brown'></i>
                            <i class='bx bxs-circle green'></i>
                            <i class='bx bxs-circle blue'></i>
                        </div>
                    </div>
                    <div class="buy-now">
                        <button><a href="https://codepen.io/sanketbodke/full/mdprZOq">Buy  Now</a></button>
                    </div>
                </div>
            </div>
            <div class="best-p1">
                <img src="https://i.postimg.cc/QtjSDzPF/bs3.png" alt="img">
                <div class="best-p1-txt">
                    <div class="name-of-p">
                        <p>PS England Shoes</p>
                    </div>
                    <div class="rating">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                    </div>
                    <div class="price">
                        &dollar;43.67
                        <div class="colors">
                            <i class='bx bxs-circle red'></i>
                            <i class='bx bxs-circle grey'></i>
                            <i class='bx bxs-circle blue'></i>
                        </div>
                    </div>
                    <div class="buy-now">
                        <button><a href="https://codepen.io/sanketbodke/full/mdprZOq">Buy  Now</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="seller container">
        <h2>New Arrivals</h2>
        <div class="best-seller">
            <div class="best-p1">
                <img src="https://i.postimg.cc/fbnB2yfj/na1.png" alt="img">
                <div class="best-p1-txt">
                    <div class="name-of-p">
                        <p>PS England T-Shirt</p>
                    </div>
                    <div class="rating">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                    </div>
                    <div class="price">
                        &dollar;10.23
                        <div class="colors">
                            <i class='bx bxs-circle blank'></i>
                            <i class='bx bxs-circle blue'></i>
                            <i class='bx bxs-circle brown'></i>
                        </div>
                    </div>
                    <div class="buy-now">
                        <button><a href="https://codepen.io/sanketbodke/full/mdprZOq">Buy  Now</a></button>
                    </div>
                </div>
            </div>
            <div class="best-p1">
                <img src="https://i.postimg.cc/zD02zJq8/na2.png" alt="img">
                <div class="best-p1-txt">
                    <div class="name-of-p">
                        <p>PS England Bag</p>
                    </div>
                    <div class="rating">
                        <i class='bx bxs-star'></i>
                        <i class='bx bx-star'></i>
                        <i class='bx bx-star'></i>
                        <i class='bx bx-star'></i>
                        <i class='bx bx-star'></i>
                    </div>
                    <div class="price">
                        &dollar;09.28
                        <div class="colors">
                            <i class='bx bxs-circle brown'></i>
                            <i class='bx bxs-circle red'></i>
                            <i class='bx bxs-circle green'></i>
                        </div>
                    </div>
                    <div class="buy-now">
                        <button><a href="https://codepen.io/sanketbodke/full/mdprZOq">Buy  Now</a></button>
                    </div>
                </div>
            </div>
            <div class="best-p1">
                <img src="https://i.postimg.cc/Dfj5VBcz/sunglasses1.jpg" alt="img">
                <div class="best-p1-txt">
                    <div class="name-of-p">
                        <p>PS England Sunglass</p>
                    </div>
                    <div class="rating">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                    </div>
                    <div class="price">
                        &dollar;06.24
                        <div class="colors">
                            <i class='bx bxs-circle grey'></i>
                            <i class='bx bxs-circle blank'></i>
                            <i class='bx bxs-circle blank'></i>
                        </div>
                    </div>
                    <div class="buy-now">
                        <button><a href="https://codepen.io/sanketbodke/full/mdprZOq">Buy  Now</a></button>
                    </div>
                </div>
            </div>
            <div class="best-p1">
                <img src="https://i.postimg.cc/FszW12Kc/na4.png" alt="img">
                <div class="best-p1-txt">
                    <div class="name-of-p">
                        <p>PS England Shoes</p>
                    </div>
                    <div class="rating">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                    </div>
                    <div class="price">
                        &dollar;43.67
                        <div class="colors">
                            <i class='bx bxs-circle grey'></i>
                            <i class='bx bxs-circle red'></i>
                            <i class='bx bxs-circle blue'></i>
                        </div>
                    </div>
                    <div class="buy-now">
                        <button><a href="https://codepen.io/sanketbodke/full/mdprZOq">Buy  Now</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="seller container">
        <h2>Hot Sales</h2>
        <div class="best-seller">
            <div class="best-p1">
                <img src="https://i.postimg.cc/jS7pSQLf/na4.png" alt="img">
                <div class="best-p1-txt">
                    <div class="name-of-p">
                        <p>PS England Shoes</p>
                    </div>
                    <div class="rating">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                    </div>
                    <div class="price">
                        &dollar;37.24
                        <div class="colors">
                            <i class='bx bxs-circle grey'></i>
                            <i class='bx bxs-circle black'></i>
                            <i class='bx bxs-circle blue'></i>
                        </div>
                    </div>
                    <div class="buy-now">
                        <button><a href="https://codepen.io/sanketbodke/full/mdprZOq">Buy  Now</a></button>
                    </div>
                </div>
            </div>
            <div class="best-p1">
                <img src="https://i.postimg.cc/fbnB2yfj/na1.png" alt="img">
                <div class="best-p1-txt">
                    <div class="name-of-p">
                        <p>PS England T-Shirt</p>
                    </div>
                    <div class="rating">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                    </div>
                    <div class="price">
                        &dollar;10.23
                        <div class="colors">
                            <i class='bx bxs-circle blank'></i>
                            <i class='bx bxs-circle blue'></i>
                            <i class='bx bxs-circle brown'></i>
                        </div>
                    </div>
                    <div class="buy-now">
                        <button><a href="https://codepen.io/sanketbodke/full/mdprZOq">Buy  Now</a></button>
                    </div>
                </div>
            </div>
            <div class="best-p1">
                <img src="https://i.postimg.cc/RhVP7YQk/hs1.png" alt="img">
                <div class="best-p1-txt">
                    <div class="name-of-p">
                        <p>PS England T-Shirt</p>
                    </div>
                    <div class="rating">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                    </div>
                    <div class="price">
                        &dollar;15.24
                        <div class="colors">
                            <i class='bx bxs-circle blank'></i>
                            <i class='bx bxs-circle red'></i>
                            <i class='bx bxs-circle blue'></i>
                        </div>
                    </div>
                    <div class="buy-now">
                        <button><a href="https://codepen.io/sanketbodke/full/mdprZOq">Buy  Now</a></button>
                    </div>
                </div>
            </div>
            <div class="best-p1">
                <img src="https://i.postimg.cc/zD02zJq8/na2.png" alt="img">
                <div class="best-p1-txt">
                    <div class="name-of-p">
                        <p>PS England Bag</p>
                    </div>
                    <div class="rating">
                        <i class='bx bxs-star'></i>
                        <i class='bx bx-star'></i>
                        <i class='bx bx-star'></i>
                        <i class='bx bx-star'></i>
                        <i class='bx bx-star'></i>
                    </div>
                    <div class="price">
                        &dollar;09.28
                        <div class="colors">
                            <i class='bx bxs-circle blank'></i>
                            <i class='bx bxs-circle grey'></i>
                            <i class='bx bxs-circle brown'></i>
                        </div>
                    </div>
                    <div class="buy-now">
                        <button><a href="https://codepen.io/sanketbodke/full/mdprZOq">Buy  Now</a></button>
                    </div>
                </div>
            </div>
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

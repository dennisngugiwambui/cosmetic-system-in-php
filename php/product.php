<?php
include 'db.php';

$sql = "SELECT * FROM products";
$stmt = $conn->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($products as $product) {
    echo "<div class='product'>";
    echo "<h3>{$product['name']}</h3>";
    echo "<p>{$product['description']}</p>";
    echo "<p>Price: {$product['price']}</p>";
    echo "<button class='add-to-cart' data-id='{$product['id']}'>Add to Cart</button>";
    echo "</div>";
}
?>

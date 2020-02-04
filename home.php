<?php
include 'function.php';
include 'pdo.php';
include 'config.php';
$description= 'le culte de la biere';


$products=productsindex($BDD);

foreach ($products as $product) {
    ?>
    <a href="product.php?id=<?php echo $product['id']; ?>"><h2><?php echo $product['name']; ?></h2></a>
    <p><?php echo $product['description']; ?></p>

    <p><?php echo $product['price']; ?></p>
    <?php
} ?>

<?php
include 'function.php';
include 'pdo.php';
include 'config.php';
$description= 'le culte de la biere';
?>


<main>
    <div class="container">

<?php $products=productsindex($BDD);

        foreach ($products as $product) {
            ?><div class="card text-center  shadow p-3 mb-5 bg-li" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title "><?php echo $product['name']; ?></h5>
                    <p class="card-text"><?php echo $product['description']; ?></p>
                    <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-secondary"><?php echo $product['price']; ?></a>
                </div>
            </div>
            <?php
        } ?>

    </div>
</main>



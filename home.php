<?php

//j inclus toutesles pages dont j'ai besoin

include 'function.php';
include 'pdo.php';
include 'config.php';

//variable description pour meta description
$description = 'le culte de la biere';
?>

<!-- main home-->
<main>
    <div class="container">
        <div class="col-12 text-center">

            <!-- titre -->
            <h2>Les derniers produits</h2>
        </div>

        <!-- affichage des derniers produits -->
        <?php $products = productsindex($BDD);

        foreach ($products as $product) {
            ?>

                <div class="card text-center shadow p-3 mb-5 " style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title "><?php echo $product['name']; ?></h5>
                        <p class="card-text"><?php echo $product['description']; ?></p>
                        <a href="index.php?page=products&id=<?php echo $product['id']; ?>"
                           class="btn btn-secondary"><?php echo $product['price']; ?></a>
                    </div>
                </div>

            <?php
        } ?>

    </div>
</main>



<?php

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
<div class="row col-12 ">
        <!-- affichage des derniers produits -->
        <?php $products = productsindex($BDD);
        foreach ($products as $product) {
            echo '       
                <div class="card col-3 text-center shadow p-3 mb-5 " style="width: 16.5rem;">
                    <img src="/photos/' . $product['photo_link'] . '.jpeg" class="card-img-top" alt="' . $product['photo_link'] . '">
                    <div class="card-body">
                        <h5 class="card-title "><a href="index.php?page=products&id=' . $product['id'] . '">' . $product['name'] . '</a> </h5>
                        <p class="card-text">' . $product['description'] . '</p>
                        <a href="index.php?page=products&id=' . $product['id'] . '"
                           class="btn btn-secondary">' . $product['price'] . ' €</a>
                    </div>
                </div>';


        } ?>
</div>
    </div>
</main>



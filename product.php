<?php

//j inclus toutesles pages dont j'ai besoin
include 'function.php';
include 'pdo.php';
include 'config.php';

//je verifie si $_GET['id'] existe
if (isset($_GET['id'])) {
    if (!empty($_GET['id'])) {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    }


    //sinon j'afficher par defaut le dernier produit rentre
} else {
    header('Location: /index.php?page=home', TRUE, 302);
    exit();
}

$view_product = view_product($BDD, $id);

$tva=calcul_tva($view_product['price']);


?>

<!-- main product -->
<main style="min-height: calc(100vh - 136px - 65px">
    <div class="container">
        <div class="col-12 text-center">
            <!-- titre -->
            <h2><?= $view_product['name'] ?></h2>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="card-img-top shadow col-md-6 text-center">
                    <img src="/photos/<?=$view_product['photo_link']?>.jpeg" alt="<?= $view_product['photo_link']?>" class="m-2" height="300em"
                         id="phototitre">
                </div>

                <div class="card-body shadow col-6 text-center h5">
                    <?= $view_product['description'] ?>
                    <div class="row align-items-center"
                    <div class="col-md-6 text-center h4">
                        <div class="col-6 mt-5">
                            Prix : <?= $view_product['price'] ?> €<br>
                            dont TVA <?=$tva?> €
                        </div>
                        <div class="col-6 mt-5">
                            <a href=".."
                               class="btn btn-secondary">Ajouter au panier</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
</main>

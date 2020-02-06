<?php
session_start();
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
    require 'home.php';
}

$view_product = view_product($BDD, $id);

$tva = calcul_tva($view_product['price']);


?>

<!-- main product -->
<main style="min-height: calc(100vh - 136px - 65px)">
    <div class="container">
        <div class="col-12 text-center">
            <br>
            <!-- titre -->
            <h2><strong><?= $view_product['name'] . ' - ' . $view_product['volume'] . ' cl ' ?></strong></h2>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center">
                    <img src="/photos/<?= $view_product['photo_link'] ?>.jpeg" alt="<?= $view_product['photo_link'] ?>"
                         class="m-2" height="300em"
                         id="phototitre">
                </div>

                <div class="col-6 text-center h5">
                    <i><?= $view_product['description'] ?></i>
                    <div class="row align-items-center"
                    <div class="col-md-6 text-center h4">
                        <div class="col-6">
                            <br><strong><?= $view_product['price'] ?> €</strong><br><small>
                                dont tva <?= $tva ?> €</small>
                        </div>
                        <div class="col-6">
                            <br><a href=".."
                                   class="btn btn-secondary">Ajouter au panier</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
</main>


<?php


if (!empty($_POST['qte'])) {
    $quantite = $_POST['qte'];
}

//je verifie si $_GET['id'] existe
if (isset($_GET['id'])) {
    if (!empty($_GET['id'])) {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    }

} else {
    require 'home.php';
}

if(!empty($_POST['qte']) and (!empty($_GET['id'])))
{
    addtocart($id, $quantite);
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
                <div class="col-md-3 text-center">
                    <img src="/photos/<?= $view_product['photo_link'] ?>.jpeg" alt="<?= $view_product['photo_link'] ?>"
                         class="m-2" height="300em"
                         id="phototitre">
                </div>

                <div class="col-9 text-center h5">
                    <i><?= $view_product['description'] ?></i>
                    <div class="row align-items-center"
                    <div class="col-md-3 text-center h4">
                        <div class="col-3">
                            <br><strong><?= $view_product['price'] ?> €</strong><br><small>
                                dont tva <?= $tva ?> €</small>
                        </div>
                        <div class="col-3">
                            <div>
                                <form action="" method="post">
                                    <input type="number" id="qte" name="qte"
                                           min="0" max="100">

                                    <div class="col-3">
                                        <br><input type="submit" value="Envoyer">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    </div>
</main>


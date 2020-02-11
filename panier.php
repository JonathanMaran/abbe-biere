<?php
//init variables
$totalorder = null;
$message = null;

if (isset($_POST['modifier'])) {
    $qtyenter = filter_input(INPUT_POST, 'qte', FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY);
    editCart($BDD, $qtyenter);
}

if (isset($_POST['supprimer'])) {
    $deleteid = filter_input(INPUT_POST, 'supprimer', FILTER_VALIDATE_INT, array("options" => array(
        "default" => 0,
        "min_range" => 0
    )));
    deleteCart($deleteid);
}


// si panier vide
if (!isset($_SESSION['panier'])) {
    echo '
    <main style="min-height: calc(100vh - 265px)">
    <div class="container">
    PIANO
    </div>
    </main>';
} else { ?>

    <main style="min-height: calc(100vh - 265px)">
        <div class="container">
            <form class="form-inline" method="post" action="index.php?page=panier">

                <?php
                foreach ($_SESSION['panier'] as $idproductCart => $qty) {
                    $view_product_cart = view_product($BDD, $idproductCart);
                    $totalpriceproduct = $view_product_cart['price'] * $qty;
                    $totalorder += $totalpriceproduct;
                    ?>


                    <div class="row">
                        <div class="col-md-12 text-center p-3 mb-5 justify-content-center" style="width: 16.5rem;">
                            <a href="index.php?page=products&id=<?= $view_product_cart['id'] ?>"><img
                                        src="/photos/<?= $view_product_cart['photo_link'] ?>.jpeg" class=""
                                        alt="<?= $view_product_cart['photo_link'] ?>"></a>
                            <div class="">
                                <h5 class="">
                                    <a href="index.php?page=products&id=<?= $view_product_cart['id'] ?>"><?= $view_product_cart['name'] ?></a>
                                </h5>
                                <p class=""><?= $view_product_cart['description'] ?></p>
                            </div>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="qte">Quantité</label>
                            <input type="number" min="0" class="form-control" id="qte" name="qte[<?= $idproductCart ?>]"
                                   value="<?= $_SESSION['panier'][$idproductCart] ?>">
                            <button type="submit" name="supprimer" value="<?= $idproductCart ?>" class="close btn"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div>
                            prix unitaire : <?= $view_product_cart['price'] ?> € </br>
                            prix total : <?= $totalpriceproduct ?>
                        </div>
                        <div class="col-12">
                            Stock Restant : <?= $view_product_cart['stock'] ?>
                            <?= $message ?>
                        </div>
                    </div>
                <?php }
                ?>
                <?php
                /*if (count($_SESSION['panier']) == 0) {
                    echo 'Panier vide';
                }

                */?>

                <div class="col-12">
                    <button type="submit" name="modifier" class="btn btn-secondary mb-2">Modifier</button>
                </div>
                <div>Total Commande : <?= $totalorder ?> €</div>
            </form>
        </div>
    </main>
    <?php
}

debug($_POST);
debug($_SESSION); ?>

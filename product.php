<?php
//j inclus toutesles pages dont j'ai besoin

$errorquantity = null;


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



debug($_POST);
debug($_SESSION);


if (!empty($_POST)) {
    if (!empty($_POST['quantity'])) {
        $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
    } else {
        $errorquantity = 'Veuillez rentrer une quantité';
    }
    addtoCart($BDD, $id, $quantity);
}

$view_product = view_product($BDD, $id);

$tva = calcul_tva($view_product['price']);


?>

<!-- main product -->
<main style="min-height: calc(100vh - 136px - 65px">
    <div class="container">
        <div class="col-12 text-center">
            <!-- titre -->
            <h2><?= $view_product['name'] ?></h2>
        </div>
        <form method="post">
            <div class="row align-items-center">
                <div class="col-md-4 text-center">
                    <img src="/photos/<?= $view_product['photo_link'] ?>.jpeg"
                         alt="<?= $view_product['photo_link'] ?>" class="m-2" height="300em"
                         id="phototitre">
                </div>
                <div class="col-md-8 text-center h5">
                    <p><?= $view_product['description'] ?></p>
                    <div class="row align-items-center">
                        <div class="col-md-4 mt-5">
                            Prix : <?= $view_product['price'] ?> €<br>
                            dont TVA <?= $tva ?> €
                        </div>
                        <div class="col-md-4 mt-5">
                            <input type="number" name="quantity" placeholder="Quantité"
                                   min="0" max="100">
                            <?= $errorquantity ?>
                        </div>
                        <div class="col-md-4 mt-5">
                            <button type="submit" class="btn btn-dark">Ajouter au Panier</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>

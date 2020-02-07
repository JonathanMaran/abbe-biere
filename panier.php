<?php
if (!empty($_POST['qte'])) {

}
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

                <?php foreach ($_SESSION['panier'] as $idproductCart => $qty) {
                    $view_product_cart = view_product($BDD, $idproductCart);
                    ?>


                    <div class="row">
                        <div class="text-center shadow p-3 mb-5 " style="width: 16.5rem;">
                            <a href="index.php?page=products&id=<?= $view_product_cart['id'] ?>"><img
                                        src="/photos/<?= $view_product_cart['photo_link'] ?>.jpeg" class=""
                                        alt="<?= $view_product_cart['photo_link'] ?>"></a>
                            <div class="">
                                <h5 class=""><a
                                            href="index.php?page=products&id=<?= $view_product_cart['id'] ?>"><?= $view_product_cart['name'] ?></a>
                                </h5>
                                <p class=""><?= $view_product_cart['description'] ?></p>
                            </div>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="qte">Quantité</label>
                            <input type="number" min="0" class="form-control" id="qte" name="qte[<?= $idproductCart ?>]"
                                   placeholder="Quantité" value="<?= $_SESSION['panier'][$idproductCart] ?>">
                        </div>
                        <div>prix unitaire : <?= $view_product_cart['price'] ?> € </br>
                            prix total : <?= $view_product_cart['price'] * $_SESSION['panier'][$idproductCart] ?>
                        </div>
                    </div>
                <?php } ?>

                <div>
                    <button type="submit" class="btn btn-secondary mb-2">Modifier</button>
                </div>
            </form>
        </div>
    </main>
    <?php
}

debug($_POST);
debug($_SESSION); ?>

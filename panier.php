<?php


$totalprice = 0;
?>
<main style="min-height: calc(100vh - 144px - 56px - 64px)">
    <div class="container">

        <?php if (empty($_SESSION['cart'])) {
            echo '
            <div class="col-12 text-center">
                <p>Votre panier est vide</p>
            </div> 
            <div class="col-12 text-center">
                <button type="button" class="btn btn-outline-secondary pull-right"><a
                                                href="index.php?page=home"
                                                style="color:black"> Retour acceuil </a>
                 </button>
            </div>
            ';


        } else {
        ?>
        <form class="form" method="post">
            <div class="col-12 text-center"><?= $message ?></div><?php
            foreach ($_SESSION['cart'] as $id => $qte) {
                $product = view_product($BDD, $id);
                $totalpriceproduct = $qte * $product['price'];
                $totalprice += $qte * $product['price'];
                if ($qte > 0) {

                    ?>


                    <div class="col-12 text-center">
                    <div class="card mb-3" style="max-width: 1000px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="/photos/<?= $product['photo_link'] ?>.jpeg" class="card-img"
                                     alt="<?= $product['photo_link'] ?>">
                            </div>
                            <div class="col-md-4">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $product['name'] ?></h5>
                                </div>
                            </div>
                            <div class="col-md-4">

                                <label for="qte">Quantité</label>
                                <input type="number" id="qte" min="0" name="articles[<?= $id ?>]" required minlength="4"
                                       maxlength="8" size="10" value="<?= $qte ?>">
                                <div class="form-check mb-2 mr-sm-2">
                                    <button type="submit" name="delete" value="<?= $id ?>" class="btn btn-secondary mb-2">Supprimer</button>
                                </div>
                                <div>
                                    <h7>prix unitaire : <?= $product['price'] ?> €</h7>
                                </div>
                                <div>
                                    <h7>prix total produit : <?= $totalpriceproduct ?> €</h7>
                                </div>

                            </div>
                        </div>
                    </div>
                    </div><?php }
            } ?>
            <div class="col-12 text-center">
                <div>
                    <p>Prix total du panier : <?= $totalprice ?> €</p>
                </div>


                <button type="submit" class="btn btn-secondary mb-2">valider les modifications</button>

                <button type="submit" name="validate" value="yes" class="btn btn-secondary mb-2">valider la commande</button>

            </div>
            <?php } ?>
        </form>
    </div>
</main>



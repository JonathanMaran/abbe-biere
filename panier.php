<?php

if (!empty($_POST)) {
    if (!empty($_POST['articles'])) {
//        $qte = filter_input(INPUT_POST, 'qte', FILTER_VALIDATE_INT);
//        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        foreach ($_POST['articles'] as $id => $qte) {

            modifycart($id, $qte);
        }
    }
}

$totalprice = 0;
?>
<main>
    <div class="container">

        <?php if (empty($_SESSION)) {
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
        <form class="form" method="post" action="index.php?page=panier"><?php
            foreach ($_SESSION['panier'] as $id => $qte) {
                $product = view_product($BDD, $id);
                $totalpriceproduct = $qte * $product['price'];
                $totalprice += $qte * $product['price'];

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
                                <input class="form-check-input" type="checkbox" id="delete" name="delete">
                                <label class="form-check-label" for="delete">
                                    Supprimer
                                </label>
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
                </div><?php ;
            } ?>
            <div class="col-12 text-center">
                <div>
                    <p>Prix total du panier : <?= $totalprice ?> €</p>
                </div>


                <button type="submit" class="btn btn-secondary mb-2">valider les modifications</button>

                <button type="submit" class="btn btn-secondary mb-2">valider la commande</button>

            </div>
            <?php } ?>
        </form>
    </div>
</main>



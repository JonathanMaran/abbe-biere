<?php


$totalprice = 0;

// fonction pour Modifier la quantité de produits dans mon panier
if (isset($_POST['modification'])) {
    modifycart($_POST['qte']);
}

//Fonction pour supprimer un produit de mon panier
if (isset($_POST['delete'])) {
    deleteproduct($_POST['delete']);
}

/*debug($_SESSION);
debug($_POST);*/

if (isset($_SESSION['panier'])) {

    foreach ($_SESSION['panier'] as $id => $quantite) {

        /*echo $id, $quantite;*/
        $infoproducts = infosproducts($BDD, $id);
        $totalprice = $totalprice + ($infoproducts['price'] * $quantite);
        echo '
                <div class="container mt-5 mb-5">
                    <div class="row">
                        <div class="col-3">
                            <form class="form-inline" method="post" action="">
                                <img src="/photos/' . $infoproducts['photo_link'] . '.jpeg" alt="' . $infoproducts['photo_link'] . '"
                                     class="m-2" height="100em" id="phototitre">
                        </div>
                        <div class="col-3">
                            <p>Produit : <strong>' . $infoproducts['name'] . '</strong></p>
                            <p>Prix unitaire : <strong>' . $infoproducts['price'] . ' euros</strong></p>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="qte" class="sr-only">Quantité</label>
                                <input type="number" min="0" class="form-control" id="qte" value="' . $quantite . '"
                                       name="qte[' . $id . ']"
                                       placeholder="Quantité">
                            </div>
                        </div>
                        <div class="col-3">
                            <p>Prix total: <strong>' . $infoproducts['price'] * $quantite . ' euros</strong></p>
                            <button type="submit" name="delete[' . $id . ']" class="btn btn-secondary mb-2 bg-warning" value="yes">
                                <small>Supprimer</small></button>
                        </div>
                    </div>
                </div>
                 ';

    }


    if (empty($_SESSION['panier'])) {
        echo 'LE PANIER EST VIDE';
    } else {
        echo '
                <div class="container mb-5">
                    <div class="row">
                        <div class="col-6 text-center">
                            <button type="submit" name="modification" class="btn btn-secondary mb-2">Modifier la quantité</button>
                        </div>
                        <div class="col-6 text-center">
                            <button type="submit" name="validation" class="btn btn-secondary mb-2">Valider le panier</button>
                            <p><strong>PRIX TOTAL: ' . $totalprice . ' </strong></p>
                        </div>
                    </div>
                </div>
';
    }


} else {
    echo '<main>PAS DE PANIER ACTUELLEMENT</main></div>';

}


/*debug($_POST);
debug($_SESSION);*/


?>
</form>


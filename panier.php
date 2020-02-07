<?php

/*debug($_SESSION['panier']);*/
$totalprice = null;

if (isset($_POST['modification'])) {
    modifycart($_POST['qte']);
}

if (isset($_SESSION['panier'])) {
    foreach ($_SESSION['panier'] as $id => $quantite) {
        /*echo $id, $quantite;*/
        $infoproducts = infosproducts($BDD, $id);
        $totalprice = $totalprice + ($infoproducts['price'] * $quantite);
        echo '<form class="form-inline" method="post" action="">
                 <img src="/photos/' . $infoproducts['photo_link'] . '.jpeg" alt="' . $infoproducts['photo_link'] . '"
                                         class="m-2" height="100em"
                                         id="phototitre">
                    <p>Produit : <strong>' . $infoproducts['name'] . '</strong></p>
                    <p>Prix unitaire : <strong>' . $infoproducts['price'] . ' euros</strong></p>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="qte" class="sr-only">Quantité</label>
                        <input type="number" min="0" class="form-control" id="qte" value="' . $quantite . '" name="qte[' . $id . ']"
                               placeholder="Quantité">
                    </div>
                    <p>Prix total: <strong>' . $infoproducts['price'] * $quantite . ' euros</strong></p>
                
                    
';

    }
} else {
    echo '<main style="min-height: calc(100vh - 215px - 65px)">PAS DE PANIER ACTUELLEMENT</main>';

}
echo '<button type="submit" name="modification" class="btn btn-secondary mb-2">Modifier la quantité</button>';
echo '<p align="center"><strong>PRIX TOTAL: ' . $totalprice . ' </strong> </p>';

/*debug($_POST);
debug($_SESSION);*/


?>
</form>

<?php
$message='';

if (isset($_POST['id'])){
    $id = $_POST['id'];
    $message=addtoCart( $BDD,$id, 1);
}


?>

<!-- main home-->
<main>
    <div class="container">
        <div class="col-12 text-center">

            <!-- titre -->
            <h2>Les derniers produits</h2>
        </div>
        <div class="col-12 text-center"><?=$message?></div>
        <div class="row col-12 ">
            <!-- affichage des derniers produits -->
            <?php $products = productsindex($BDD);
            foreach ($products as $product) {
                echo '       
                <div class="card col-12 col-sm-6 col-md-4 col-lg-3 text-center shadow p-3 mb-5 " style="width: 16.5rem;">
                    <a href="index.php?page=products&id=' . $product['id'] . '"><img src="/photos/' . $product['photo_link'] . '.jpeg" class="card-img-top" alt="' . $product['photo_link'] . '"></a>
                    <div class="card-body">
                        <h5 class="card-title "><a href="index.php?page=products&id=' . $product['id'] . '">' . $product['name'] . '</a> </h5>
                        <p class="card-text">' . $product['description'] . '</p>
                            <form method="post">
                                <input name="id" type="hidden" value="' . $product['id'] . '">
                                <p>'.$product['weight'].'ml</p>
                                <p>' . $product['price'] . ' €</p>
                                <button type="submit" class="btn btn-dark">Ajout Rapide</button>
                                <p>stock restant: '.$product['stock'].'</p>
                            </form>
                    
                    </div>
                </div>';


            } ?>
        </div>
    </div>
</main>



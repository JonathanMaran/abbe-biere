<?php
include 'pdo.php';
include 'function.php';
include 'header.php';

$products = derniersproduits($bdd);

foreach ($products as $ligne) {
    echo '<div class="container">
             <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <div class="card-body">
                     <h5 class="card-title">' . $ligne['name'] . ' </h5>
                     <p class="card-text">' . $ligne['description'] . ' </p>
                     <p class="card-text">' . $ligne['price'] . ' euros pour ' . $ligne['volume'] . 'cl </p>
                     <a href="#" class="btn btn-primary">En savoir plus</a>
                    </div>
             </div>
           </div>';
}

?>


<?php
include 'footer.php';
?>





<?php
include 'function.php';
include 'pdo.php';
include 'config.php';
//je verifie si le tableau categorie existe et je filtre l'entrée
if (isset($_GET['categorie'])){
    if(!empty($_GET['categorie'])){
        $categorie=filter_input(INPUT_GET,'categorie',FILTER_SANITIZE_STRING);
    }
} else{
    $categorie='blonde';
}

//je recupere la categorie a afiicher
$categories=categorieview($BDD,$categorie);
debug($categories);
?>
<main>
    <div class="container">
        <div class="col-12 text-center">

            <!-- titre -->
            <h2>Les derniers produits</h2>
        </div>
<div class="row col-12 ">
        <!-- affichage des derniers produits -->
        <?php
        foreach ($categories as $categorie) {
            echo '       
                <div class="card col-3 text-center shadow p-3 mb-5 " style="width: 16.5rem;">
                    <img src="/photos/' . $categorie['photo_link'] . '.jpeg" class="card-img-top" alt="' . $categorie['photo_link'] . '">
                    <div class="card-body">
                        <h5 class="card-title "><a href="index.php?page=products&id=' . $categorie['id'] . '">' . $categorie['name'] . '</a> </h5>
                        <p class="card-text">' . $categorie['description'] . '</p>
                        <a href="index.php?page=products&id=' . $categorie['id'] . '"
                           class="btn btn-secondary">' . $categorie['price'] . ' €</a>
                    </div>
                </div>';


        } ?>
</div>
    </div>
</main>

<?php

//logique page categorie

//je verifie si le tableau cat existe et je filtre l'entrée
if (empty($_GET['cat'])) {
    $categorie = 'Blondes';
} elseif (isset($_GET['cat'])) {
    $categorie = filter_input(INPUT_GET, 'cat', FILTER_SANITIZE_STRING);
}
 include 'header.php';

if ($categorie == 'Blondes' || $categorie == 'Blanches' || $categorie == 'Brunes' || $categorie == 'Ambrées' || $categorie == 'Rosées' || $categorie == 'Rubis') {
//je recupere la categorie a afiicher
    $categorieview = categorieview($BDD, $categorie); ?>
    <main>
        <div class="container">
            <div class="col-12 text-center">

                <!-- titre -->
                <h2>Nos <?= $categorie ?></h2>
            </div>
            <div class="col-12 text-center"><?=$message?></div>
            <div class="row col-12 ">
                <!-- affichage des derniers produits -->
                <?php
                foreach ($categorieview as $categorie) {
                    echo '<div class="card col-12 col-sm-6 col-md-4 col-lg-3 text-center shadow p-3 mb-5 " style="width: 16.5rem;">
                    <a href="index.php?page=products&id=' . $categorie['id'] . '"><img src="/photos/' . $categorie['photo_link'] . '.jpeg" class="card-img-top" alt="' . $categorie['photo_link'] . '"></a>
                    <div class="card-body">
                        <h5 class="card-title "><a href="index.php?page=products&id=' . $categorie['id'] . '">' . $categorie['name'] . '</a> </h5>
                        <p class="card-text">' . $categorie['description'] . '</p>
                            <form method="post">
                                <input name="id" type="hidden" value="' . $categorie['id'] . '">
                                <p>'.$categorie['weight'].'ml</p>
                                <p>' . $categorie['price'] . ' €</p>
                                <button type="submit" class="btn btn-dark">Ajout Rapide</button>
                                <p>stock restante '.$categorie['stock'].'</p>
                            </form>
                    
                    </div>
                </div>';


                } ?>
            </div>
        </div>
    </main>

    <?php
} else {
    $categorieview = 'Cette categorie nexiste pas'; ?>
    <main style="min-height: calc(100vh - 144px - 56px - 64px)">
        <div class="container">

            <div class="row col-12 ">
                <div class="col-12 text-center">
                    <?= $categorieview ?>
                </div>
                <div class="col-12 text-center">
                    <button type="button" class="btn btn-outline-secondary pull-right"><a
                                href="index.php?page=home"
                                style="color:black"> Retour acceuil </a>
                    </button>
                </div>
            </div>
        </div>

    </main>
    <?php
}
include 'footer.php';




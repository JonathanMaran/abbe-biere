<?php

//je verifie si le tableau categorie existe et je filtre l'entrée
if (isset($_GET['categorie'])){
    if(!empty($_GET['categorie'])){
        $categorie=filter_input(INPUT_GET,'categorie',FILTER_SANITIZE_STRING);
    }
} else{
    $categorie='blonde';
}

//je recupere la categorie a afiicher
$categories_view=categorieview($BDD,$categorie);


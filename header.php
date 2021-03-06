<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css.css">
    <title><?= $include_page ?></title>
    <meta name="description" content="<?= $include_description ?>">
</head>

<body>
<header>
    <div class="row bg-dark">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark sticky-top bg-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav navbar-left">
                        <li class="nav-item <?php if ($include_page == "home.php") {
                            ?>active<?php
                        } ?>">
                            <a class="nav-link" href="index.php?page=home">Accueil<span
                                        class="sr-only ">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Catégorie
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="index.php?page=categorie&cat=blonde">Blonde</a>
                                <a class="dropdown-item" href="index.php?page=categorie&cat==blanche">Blanche</a>
                                <a class="dropdown-item" href="index.php?page=categorie&cat==brune">Brune</a>
                                <a class="dropdown-item" href="index.php?page=categorie&cat==ambree">Ambrée</a>
                                <a class="dropdown-item" href="index.php?page=categorie&cat==rosee">Rosée</a>
                                <a class="dropdown-item" href="index.php?page=categorie&cat==rubis">Rubis</a>
                            </div>
                        </li>
                        <ul class=" navbar-nav ">
                            <li>
                                <div class="col-2 text-center ">
                                    <button type="button" class="btn btn-outline-warning pull-right"><a
                                                href="index.php?page=panier"
                                                style="color: #EAA90B"> Panier </a>
                                    </button>
                                </div>
                            </li>
                        </ul>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="row bg-warning">
        <div class="container ">
            <div class="align-items-center bg-warning">
                <div class="row ">

                    <div class="col-lg-12 text-center h1 ">
                        <br>
                        L'abbé bière
                    </div>
                    <div class="col-lg-12 text-center">
                        <p>Le culte de la bière<br></p>

                    </div>

                </div>
            </div>
        </div>
    </div>

</header>


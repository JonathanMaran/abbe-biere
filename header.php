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
    <title><?php echo $include_page ?></title>
<meta name="description" content="<?php echo $include_description ?>">
</head>

<body>
<header>
    <div class="container">
            <div class="align-items-center bg-warning">
                <div class="col-lg-12 text-center h1 ">
                   L'abbé bière
                </div>

                <div class="col-lg-12 text-center">
                    Le culte de la bière
                </div>
            </div>
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item <?php if ($include_page == "home") {
                        ?>active<?php
                    } ?>">
                        <a class="nav-link" href="index.php?page=home">Accueil<span class="sr-only ">(current)</span> </a>
                    </li>
                    <li class="nav-item <?php if ($include_page == "products") {
                        ?>active<?php
                    } ?>">
                        <a class="nav-link" href="index.php?page=products">Produits<span class="sr-only ">(current)</span>
                        </a>

                    </li>

                </ul>
            </div>
        </nav>
    </div>
</header>


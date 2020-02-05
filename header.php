<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title><?php
        if (isset($valeurpage)){
            echo $valeurpage;
        }
        else {
            echo 'Mon site';
        }
        ?></title>


<meta name="description" content="<?php
if (isset($description)){
    echo $description;
}
else{
    echo 'Bonjour, bienvenue sur le site de L\'Abbe Bière.';
}
?>" />

</head>

<body class="bg-dark">

<header class="bg-warning">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 text-center h1">
                L'Abbe Bière
            </div>
            <div class="col-lg-12 text-center h4">
                Le culte de la bière
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">

                <?php
                foreach ($tableau as $ligne) {
                    echo '<li class="nav-item active">
                        <a class="nav-link" href="index.php?page=' . $ligne['url'] . '">' . $ligne['titre'] . '<span class="sr-only ">(current)</span> </a>
                    </li>';
                }
                ?>
            </ul>
        </div>
    </nav>
</header>
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
        if (isset($title)){
            echo $title;
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
        echo 'Bonjour, bienvenue sur le site de Maxime Silva, futur Développeur Web.';
    }
    ?>" />

</head>

<body class="bg-dark">

<header class="bg-warning">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 text-center h1">
                Maxime Silva
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

<footer class="bg-warning">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row mt-2">
                    <p class="col-4 text-center"><a href="mailto:contact@le-campus-numerique.fr"
                                                    class="text-dark"><img src="contenu/mail.png" width="30" height="30" title="mail"
                                                                           alt="mail"><br>
                            contact@le-campus-numerique.fr</a>
                    </p>
                    <p class="col-4 text-center"><img src="contenu/adresse.png" alt="lieu" width="30" height="30" /><br>
                        33 Grande Rue,26000 valence</p>
                    <p class="col-4 text-center"><img src="contenu/tel.png" alt="tel" width="30" height="30"><br>
                        04 75 78 61 33</p>
                </div>
            </div>
        </div>
    </div>

</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>

</html>
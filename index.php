<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require 'config.php';
require 'pdo.php';
require 'function.php';

/* ------- routeur -------- */
$route = [
    '' => 'Accueil',
    'products' => 'Produits',
];
$description = 'le culte de la biere';
$valeurpage = '';


if (isset($_GET['page'])) {
    $page = $_GET['page'];

    if (isset($route[$page])) {
        $valeurpage = $route[$page];
    } else {
        $valeurpage = '404';
    }
} else {
    $valeurpage = 'Accueil';
}

$tableau = [
    [
        'titre' => 'Accueil',
        'url' => '',
    ],
    [
        'titre' => 'Produits',
        'url' => 'products',
    ],
];
//j'inclus le layout
require 'header.php';
require 'home.php';
require 'footer.php';

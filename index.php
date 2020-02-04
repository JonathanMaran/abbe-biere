<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require 'config.php';
require 'pdo.php';
require 'function.php';

//je verifie si le tableau $_GET['page'] existe et je filtre
if (!isset($_GET['page'])) {
    $page = 'acceuil';
} elseif (isset($_GET['page'])) {
    $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
}

//je cree un tableau avec chaque route
$road = [
    'home' => 'home',
    'products' => 'Produits',
];


//je redirige vers la page
$include_page = null;

if (isset($road[$page])) {
    $include_page = $road[$page];
} else {
    $include_page = '404';
}

//j'inclus la page
require $include_page . '.php';

//j'inclus le layout
require 'layout.php';
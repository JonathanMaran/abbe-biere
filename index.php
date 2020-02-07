<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'function.php';
include 'pdo.php';
include 'config.php';

//je verifie si le tableau $_GET['page'] existe et je filtre
if (!isset($_GET['page'])) {
    $page = 'home';
} elseif (!empty($_GET['page'])) {
    $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
}

//je cree un tableau avec chaque route
$root = [
    'home' => 'home',
    'products' => 'product',
];
$rootdescription = [
    'home' => 'Bienvenue sur le site de l\' Abbé Bière',
    'products' => 'ceci est la page de nos Produits',
    '404' => 'cette page n\'existe pas'
];

//je redirige vers la page
$include_page = null;
$include_description = null;

if (isset($root[$page])) {
    $include_page = $root[$page];
    $include_description = $rootdescription[$page];
} else {
    $include_page = '404';
    $include_description = $rootdescription['404'];
}


include 'header.php';
include $include_page . '.php';
include 'footer.php';

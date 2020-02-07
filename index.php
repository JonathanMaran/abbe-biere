<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

include 'sessions.php';
//j inclus toutesles pages dont j'ai besoin
include 'function.php';
include 'pdo.php';
include 'config.php';


//je verifie si le tableau $_GET['page'] existe et je filtre
if(!isset($_GET['page'])){
    $page='home';
} elseif(!empty($_GET['page'])){
    $page=filter_input(INPUT_GET,'page',FILTER_SANITIZE_STRING);
}

//je cree un tableau avec chaque route
$root=[
    'home'=> 'home.php',
    'products' => 'product.php',
    'panier'=>'panier.php'
];

$description=[
    'home' => 'Bienvenue dans le monde incroyable de la bière ! Vous trouverez forcémment votre bonheure !',
    'products' => 'Découvrez toute notre gamme de bières',
    'panier'=> 'Voici votre panier',
];


//je redirige vers la page
$include_page=null;

if (isset($root[$page])){
    $include_page=$root[$page];
    $include_description=$description[$page];
} else {
    $include_page='404';
}


include 'header.php';
include $include_page;
include 'footer.php';
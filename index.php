<?php
session_start();



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//je verifie si le tableau $_GET['page'] existe et je filtre
if(isset($_GET['page'])){
    $page=filter_input(INPUT_GET,'page',FILTER_SANITIZE_STRING);
} elseif(empty($_GET['page'])){
    $page='home';
} else{
    $page='home';
}

// tableau avec chaque route
$root=[
    'home'=> 'home',
    'categorie'=> 'categorie',
    'products' => 'product',
    'panier'=>'panier'
];

// tableau avec chaque description
$description=[
    'home'=> 'ceci est notre super site de ventre de biere',
    'categorie'=> 'vous trouverez ici toutes nos bieres rangées par categorie',
    'products'=>'le produit dans tout ces états',
    'panier'=>'votre panier avec toutes vos bieres selectionées',
];




//je redirige vers la page
$include_page=null;

if (isset($root[$page])){
    $include_page=$root[$page];
    $include_description=$description[$page];
} else {
    $include_page='404';
    $include_description='cette page n existe pas';
}



include 'header.php';
include $include_page.'.php';
include 'footer.php';
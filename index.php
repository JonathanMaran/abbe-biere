<?php

//je verifie si le tableau $_GET['page'] existe et je filtre
if(!isset($_GET['page'])){
    $page='home';
} elseif(!empty($_GET['page'])){
    $page=filter_input(INPUT_GET,'page',FILTER_SANITIZE_STRING);
}

//je cree un tableau avec chaque route
$root=[
    'home'=> 'home.php',
    'products' => 'Produits',
];


//je redirige vers la page
$include_page=null;

if (isset($root[$page])){
    $include_page=$root[$page];
} else {
    $include_page='404';
}

include 'header.php';
include $root[$page];
include 'footer.php';
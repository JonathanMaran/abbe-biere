<?php
include 'pdo.php';
include 'function.php';

//je verifie si le tableau $_GET['page'] existe et je filtre
if(!isset($_GET['page'])){
    $page='acceuil';
} elseif(isset($_GET['page'])){
    $page=filter_input(INPUT_GET,'page',FILTER_SANITIZE_STRING);
}

//je cree un tableau avec chaque route
$road=[
    'home'=> 'home',
    '404'=>'404'
];


//je redirige vers la page
$include_page=null;

if (isset($road[$page])){
    $include_page=$road[$page];
} else {
    $include_page=$road['404'];
}

//j'inclus la page
include $include_page.'.php';

//j'inclus le layout
include 'layout.php';
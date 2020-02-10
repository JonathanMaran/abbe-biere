<?php
session_start();

include 'function.php';
include 'pdo.php';
include 'config.php';

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
    'panier'=>'panier',
    'login'=>'login'
];

// tableau avec chaque description
$description=[
    'home'=> 'ceci est notre super site de ventre de biere',
    'categorie'=> 'vous trouverez ici toutes nos bieres rangées par categorie',
    'products'=>'le produit dans tout ces états',
    'panier'=>'votre panier avec toutes vos bieres selectionées',
    'login'=>'pour vous inscrire c\'est par ici'
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


//logique page home
$message='';

if (isset($_POST['id'])){
    $id =filter_input(INPUT_POST,'id',FILTER_VALIDATE_INT);
    $message=addtoCart( $BDD,$id, 1);
}



//logique page product

//je verifie si $_GET['id'] existe
if (!empty($_GET)) {
    if (!empty($_GET['id'])) {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    } else {
        $id = find_last_id($BDD);
    }



    //sinon j'afficher par defaut le dernier produit rentre
} else {
    $id = find_last_id($BDD);
}

$view_product = view_product($BDD, $id);

$tva = calcul_tva($view_product['price']);

if (!empty($_POST)) {
    if (!empty($_POST['qte'])) {
        $qte = filter_input(INPUT_POST, 'qte', FILTER_VALIDATE_INT);
        if ($qte < 0) {
            $qte = 0;
        }
        $message=addtocart($BDD,$id,$qte);
    }
}

//logique page categorie

//je verifie si le tableau cat existe et je filtre l'entrée
if (empty($_GET['cat'])) {
    $categorie = 'Blondes';
} elseif (isset($_GET['cat'])) {
    $categorie = filter_input(INPUT_GET, 'cat', FILTER_SANITIZE_STRING);
}

//logique page panier

if (!empty($_POST)) {
    if (!empty($_POST['articles'])) {
//        $qte = filter_input(INPUT_POST, 'qte', FILTER_VALIDATE_INT);
//        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        foreach ($_POST['articles'] as $id => $qte) {

            $message = modifycart($BDD, $id, $qte);
        }
    }
    if (!empty($_POST['delete'])) {
        foreach ($_POST['delete'] as $id => $on) {
            $message = modifycart($BDD, $id, 0);
        }
    }
    if (!empty($_POST['validate'])){
        $validate=filter_input(INPUT_POST,'validate',FILTER_SANITIZE_STRING);
        if ($validate=='yes'){

            if (!empty($_SESSION['idcustomer']))
            {
                //valider la commande

            } else{
                //il faut vous connecter
            }

        }
    }
}

//logique page login
//new customer
if (!empty($_POST['first_name'])){
    $post_information=array(
        'first_name'=> FILTER_SANITIZE_STRING,
        'last_name'=> FILTER_SANITIZE_STRING,
        'email'=>FILTER_VALIDATE_EMAIL,
        'password1'=>FILTER_SANITIZE_STRING,
        'password2'=>FILTER_SANITIZE_STRING
    );
    $customer_information=filter_input_array(INPUT_POST,$post_information);
    if ($customer_information['password1']==$customer_information['password2']){
        addnewcustomer($BDD,$customer_information['fist_name'],$customer_information['last_name'],$customer_information['email'],$customer_information['password1']);
    }


    //old customer
} else{
    $post_information=array(
        'email'=>FILTER_VALIDATE_EMAIL,
        'password'=>FILTER_SANITIZE_STRING
    );
    $customer_information=filter_input_array(INPUT_POST,$post_information);
    findcustomer($BDD,$customer_information['email'],$customer_information['password']);
}



include 'header.php';
include $include_page.'.php';
include 'footer.php';
<?php
function debug($var)
{
    highlight_string("<?php\n" . var_export($var, true) . ";\n?>");
}

//fonction pour afficher les 10 derniers articles
function productsindex(PDO $BDD)
{
    $queryhome = $BDD->query('
SELECT *
FROM products
ORDER BY id DESC 
LIMIT 10 ');
    $donnes = $queryhome->fetchAll();
    return $donnes;
}

//fonction pour recuperer le dernier id
function find_last_id(PDO $BDD)
{
    $query_last_id = $BDD->query('
    SELECT id
    FROM products
    ORDER BY id DESC 
    LIMIT 1');
    $donnees = $query_last_id->fetch();
    return $donnees;
}

//produit a afficher
function view_product(PDO $bdd, int $id)
{
    $query_view_product = $bdd->prepare('
    SELECT * 
    FROM products
    WHERE id= :id');
    $query_view_product->execute(array(
        'id' => $id
    ));
    $answer = $query_view_product->fetch();
    return $answer;
}

//calcul tva
function calcul_tva(float $price)
{
    $tva = $price * 0.2;
    $tva = round($tva, 2); //arrondie a 0.01
    return $tva;
}

function createCart()
{
    if (!isset($_SESSION['cart'])) {

        $_SESSION['cart'] = array();

    }

}

function addtoCart(PDO $BDD, int $id, int $quantity)
{
    createCart();
    if (!isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] = $quantity;
    } else {
        $_SESSION['cart'][$id] += $quantity;
    }
}
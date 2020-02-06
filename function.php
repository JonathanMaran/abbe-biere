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
    FROM produts
    ORDER BY id DESC 
    LIMIT 1');
    return $query_last_id;
}

//produit a afficher
function view_product(PDO $bdd, int $id)
{
    $query_view_product = $bdd->query('
    SELECT * 
    FROM products
    WHERE id= ' . $id);
    $answer = $query_view_product->fetch();
    return $answer;
}

//calcul tva
function calcul_tva(float $price)
{
    $tva = $price /1.2;
    $tva = $price - $tva;
    $tva = round($tva, 2);
    return $tva;
}

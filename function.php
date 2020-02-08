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
    $query_last_id = $BDD->prepare('
    SELECT id
    FROM products
    ORDER BY id DESC 
    LIMIT 1');
    $query_last_id->execute();
    $answer = $query_last_id->fetch();
    return $answer['id'];
}

//produit a afficher
function view_product(PDO $bdd, int $id)
{
    $query_view_product = $bdd->prepare('
    SELECT * 
    FROM products
    WHERE id= :id');
    $query_view_product->bindParam(':id', $id, PDO::PARAM_INT);
    $query_view_product->execute();
    $answer = $query_view_product->fetch();
    return $answer;
}

//calcul tva
function calcul_tva(float $price): float
{
    $tva = $price * 0.2;
    round($tva, 2);
    return $tva;
}

//categories a afficher
function categorieview(PDO $BDD, string $categorie)
{
    $querycategorieview = $BDD->prepare('
    SELECT products.*
FROM products
INNER JOIN categories ON categories.id = products.category_id
WHERE categories.name = :categorie');
    $querycategorieview->bindparam(':categorie', $categorie, PDO::PARAM_STR);
    $querycategorieview->execute();
    $answer = $querycategorieview->fetchAll();
    return $answer;
}


function createcart()
{
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
    }
}

function addtocart(PDO $bdd,int $idProduit, int $qteProduit)
{
    createcart();
    verifystock($bdd, $idProduit, $qteProduit);
    if (isset($_SESSION['panier'][$idProduit])) {
        $_SESSION['panier'][$idProduit] += $qteProduit;
    } else {
        $_SESSION['panier'][$idProduit] = $qteProduit;
    }
}

function modifycart(PDO $bdd,int $idProduit, int $qteProduit)
{
    if(verifystock($bdd,$idProduit,$qteProduit)== true){
        $_SESSION['panier'][$idProduit] = $qteProduit;
    }

}

function getstock(PDO $bdd,int $idProduit):int
{
    $querygetstock = $bdd -> prepare('
    SELECT products.stock
    FROM products
    WHERE id = :id
    ');
    $querygetstock->bindparam(':id',$idProduit,PDO::PARAM_INT);
    $querygetstock->execute();
    $arraystock= $querygetstock -> fetch();
    return $arraystock['stock'];

}

function verifystock(PDO $bdd,int $idproduct,int $quantity):bool
{

    $stockproducts=getstock($bdd,$idproduct);
    debug($stockproducts);
    debug($quantity);
    if ( $stockproducts<$quantity){
        return false;
    } else {
        return true;
    }

}

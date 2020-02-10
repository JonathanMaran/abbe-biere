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


// fonction calcul TVA
function calcul_tva(float $price, $vat)
{
    $tva = $price * ($vat/100);
    round($tva, 2);
    return $tva;
}

//categories a afficher
function categorieview(PDO $BDD, string $categorie)
{
    $querycategorieview = $BDD->prepare('SELECT *
    FROM products
    INNER JOIN categories ON categories.id=category_id
    WHERE categories.name= :categorie');
    $querycategorieview->bindparam(':categorie', $categorie, PDO::PARAM_STR);
    $querycategorieview->execute();
    $querycategorieview->fetchAll();
    return $querycategorieview;
}


function createcart()
{
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
    }
}

function addtocart(int $idProduit, int $qteProduit)
{
    createcart();
    if (isset($_SESSION['panier'][$idProduit])) {
        $_SESSION['panier'][$idProduit] += $qteProduit;
    } else {
        $_SESSION['panier'][$idProduit] = $qteProduit;
    }
}

function infosproducts(PDO $bdd, int $id)
{
    $query_view_product = $bdd->prepare('SELECT *  FROM products WHERE id=:id');
    $query_view_product->bindParam(':id', $id, PDO::PARAM_INT);
    $query_view_product->execute();

    return $query_view_product->fetch();
}

function modifycart(array $quantites)
{
    foreach ($quantites as $id => $quantite) {
        if ($quantite <= 0) {
            unset($_SESSION['panier'][$id]);
        } else {
            $_SESSION['panier'][$id] = (int)$quantite;
        }
    }
}

function deleteproduct(array $quantites)
{
    foreach ($quantites as $id => $quantite) {
        unset($_SESSION['panier'][$id]);
    }
}
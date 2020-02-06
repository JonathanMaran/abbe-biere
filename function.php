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
    $query_last_id ->execute();
    $answer=$query_last_id->fetch();
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
function calcul_tva(float $price):float
{
    $tva = $price * 0.2;
    round($tva, 2);
    return $tva;
}

//categories a afficher
function categorieview(PDO $BDD, string $categorie)
{
    $querycategorieview = $BDD->prepare('
    SELECT *
    FROM products
    INNER JOIN categories ON categories.id=category_id
    WHERE categories.name= :categorie');
    $querycategorieview->bindparam(':categorie', $categorie, PDO::PARAM_STR);
    $querycategorieview->execute();
    $querycategorieview->fetchAll();
    return $querycategorieview;
}


function ajouterArticle(string $idProduit,int $qteProduit)
{
    //Si le panier existe
    if (isset ($_SESSION['panier'])){
        //Si le produit existe déjà on ajoute seulement la quantité
        $positionProduit = array_search($idProduit,  $_SESSION['panier']['idProduit']);

        if ($positionProduit !== false)
        {
            $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit ;
        }
        else
        {
            //Sinon on ajoute le produit
            array_push( $_SESSION['panier']['idProduit'],$idProduit);
            array_push( $_SESSION['panier']['qteProduit'],$qteProduit);
        }
    }
    else
        echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}


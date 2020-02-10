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
function calcul_tva(float $price,float $tva): float
{
    $tva = $price * $tva;
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
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
}

function addtocart(PDO $bdd, int $idProduit, int $qteProduit)
{
    createcart();
    if (verifystock($bdd, $idProduit, $qteProduit) == true) {
        if (isset($_SESSION['cart'][$idProduit])) {
            $_SESSION['cart'][$idProduit] += $qteProduit;
        } else {
            $_SESSION['cart'][$idProduit] = $qteProduit;
        }
        $message='votre choix à bien été ajouté au panier';
    } else{
        $message='le stock n\'est pas suffisant';
    }
    return $message;
}

function modifycart(PDO $bdd, int $idProduit, int $qteProduit)
{
    if (verifystock($bdd, $idProduit, $qteProduit) == true) {
        if ($qteProduit==0){
            unset($_SESSION['cart'][$idProduit]);
        } else {
            $_SESSION['cart'][$idProduit] = $qteProduit;
            return $message = 'le stock à été mis à jour';
        }

    } else {
        return $message = 'la modification à echoué, le stock n\'est pas suffisant';
    }

}

function getstock(PDO $bdd, int $idProduit): int
{
    $querygetstock = $bdd->prepare('
    SELECT products.stock
    FROM products
    WHERE id = :id
    ');
    $querygetstock->bindparam(':id', $idProduit, PDO::PARAM_INT);
    $querygetstock->execute();
    $arraystock = $querygetstock->fetch();
    return $arraystock['stock'];

}

function verifystock(PDO $bdd, int $idproduct, int $quantity): bool
{

    $stockproducts = getstock($bdd, $idproduct);
    if ($stockproducts < $quantity) {
        return false;
    } else {
        return true;
    }

}

function addnewcustomer(PDO $bdd,string $fristname,string $lastname,string $email,string $password)
{
    $queryadd=$bdd->prepare('
    INSERT INTO `customers` (`id`, `firstname`, `lastname`, `email`, `password`) 
    VALUES (NULL, :firstname, :lastname, :email, :password);');
    $queryadd->bindParam(':firstname',$fristname,PDO::PARAM_STR);
    $queryadd->bindParam(':lastname',$lastname,PDO::PARAM_STR);
    $queryadd->bindParam(':email',$email,PDO::PARAM_STR);
    $queryadd->bindParam(':password',$password,PDO::PARAM_STR);
    $queryadd->execute();
    findcustomer($bdd,$email,$password);
    return $id;
}


function findcustomer(PDO $bdd, $email, $password)
{
    $queryfind= $bdd ->prepare('
    SELECT id
    FROM customers
    WHERE email= :email AND password = :password');
    $queryfind->bindParam(':email',$email,PDO::PARAM_STR);
    $queryfind->bindParam(':password',$password,PDO::PARAM_STR);
    $queryfind->execute();
    $array_id=$queryfind->fetch();
    createidcustomer($array_id['id']);
}

function createidcustomer($id){
    if (!isset($_SESSION['idcustomer'])) {
        $_SESSION['idcustomer'] = $id;
    }
}

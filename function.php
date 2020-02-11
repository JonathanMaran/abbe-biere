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
function calcul_tva(float $price, float $tva): float
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
        $message = 'votre choix à bien été ajouté au panier';
    } else {
        $message = 'le stock n\'est pas suffisant';
    }
    return $message;
}

function modifycart(PDO $bdd, int $idProduit, int $qteProduit)
{
    if (verifystock($bdd, $idProduit, $qteProduit) == true) {
        if ($qteProduit == 0) {
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

function addnewcustomer(PDO $bdd, string $fristname, string $lastname, string $email, string $password)
{
    $queryadd = $bdd->prepare('
    INSERT INTO `customers` (`id`, `firstname`, `lastname`, `email`, `password`) 
    VALUES (NULL, :firstname, :lastname, :email, :password);');
    $queryadd->bindParam(':firstname', $fristname, PDO::PARAM_STR);
    $queryadd->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $queryadd->bindParam(':email', $email, PDO::PARAM_STR);
    $queryadd->bindParam(':password', $password, PDO::PARAM_STR);
    $queryadd->execute();
    findcustomer($bdd, $email, $password);
}


function findcustomer(PDO $bdd, string $email, string $password)
{
    $queryfind = $bdd->prepare('
    SELECT id
    FROM customers
    WHERE email= :email AND password = :password');
    $queryfind->bindParam(':email', $email, PDO::PARAM_STR);
    $queryfind->bindParam(':password', $password, PDO::PARAM_STR);
    $queryfind->execute();
    $array_id = $queryfind->fetch();
    createidcustomer($array_id['id']);
}

function createidcustomer($id)
{
    if (!isset($_SESSION['idcustomer'])) {
        $_SESSION['idcustomer'] = $id;
    }
    return $id;
}

function ordervalidate(PDO $bdd, $idcustomer,array $cart)
{
    foreach ($cart as $id => $qty) {
        verifystock($bdd, $id, $qty);
    }
    $queryorder = $bdd->prepare('
    INSERT INTO `orders` (`created_at`, `delivered_at`, `customer_id`)
    VALUES (date(now()), date(now()), :idcustomer);');
    $queryorder->bindParam(':idcustomer', $idcustomer, PDO::PARAM_INT);
    $queryorder->execute();
    $idorder=$bdd->lastInsertId();
    addorderline($bdd, $cart,$idorder);
}


function addorderline(PDO $bdd,array $cart,int $idorder)
{
    foreach ($cart as $id => $qty) {
        $product = selectproduct($bdd, $id);
        modifystock($bdd,$product);
        createorderline($bdd,$id,$idorder,$qty,$product['price'],$product['vat']);
    }
}


function selectproduct(PDO $bdd, int $id)
{
    $queryselect = $bdd->prepare('
    SELECT *
    FROM products
    WHERE id = :id');
    $queryselect->bindParam(':id', $id, PDO::PARAM_INT);
    $queryselect->execute();
    $answer = $queryselect->fetch();
    return $answer;
}

function modifystock(PDO $bdd, array $product)
{
    $querymodify = $bdd->prepare('
    UPDATE `products` SET
    `id` = :id,
    `name` = :name,
    `description` = :description,
    `price` = :price,
    `volume` = :volume,
    `vat` = :vat,
    `stock` = :stock,
    `weight` = :weight,
    `category_id` = :category_id,
    `photo_link` = :photo_link,
    WHERE `id` = :id ;
    ');
    $querymodify->bindParam(':name', $product['name'], PDO::PARAM_STR);
    $querymodify->bindParam(':description', $product['description'], PDO::PARAM_STR);
    $querymodify->bindParam(':price', $product['price'], PDO::PARAM_STR);
    $querymodify->bindParam(':volume', $product['volume'], PDO::PARAM_STR);
    $querymodify->bindParam(':vat', $product['vat'], PDO::PARAM_STR);
    $querymodify->bindParam('stock', $product['stock'], PDO::PARAM_INT);
    $querymodify->bindParam('weight', $product['weight'], PDO::PARAM_STR);
    $querymodify->bindParam(':category_id', $product['category_id'], PDO::PARAM_INT);
    $querymodify->bindParam(':photo_link', $product['photo_link'], PDO::PARAM_STR);
    $querymodify->bindParam(':id', $product['id'], PDO::PARAM_INT);
    $querymodify->execute();
}

function createorderline(PDO $bdd,int $productid,int $orderid,int $quantity,float $price,float $vat)
{
    $querycreateorderline=$bdd->prepare('
    INSERT INTO `orderline` (`product_id`, `order_id`, `quantity`, `price`, `vat`)
    VALUES (:productid, :orderid, :quantity, :price, :vat);');
    $querycreateorderline->bindParam(':productid',$productid,PDO::PARAM_INT);
    $querycreateorderline->bindParam(':orderid',$orderid,PDO::PARAM_INT);
    $querycreateorderline->bindParam(':quantity',$quantity,PDO::PARAM_INT);
    $querycreateorderline->bindParam(':price',$price,PDO::PARAM_STR);
    $querycreateorderline->bindParam(':vat',$vat,PDO::PARAM_STR);
    $querycreateorderline->execute();
}

function deletecart()
{
    unset($_SESSION['cart']);
}
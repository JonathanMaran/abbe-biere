<?php
function debug($var)
{
    highlight_string("<?php\n" . var_export($var, true) . ";\n?>");
}

//fonction pour afficher les 10 derniers articles
function productsindex(PDO $connectionBDD)
{
    $querryhome = $connectionBDD->query('
SELECT *
FROM products
ORDER BY id DESC 
LIMIT 10 ');
    $donnes = $querryhome->fetchAll();
    return $donnes;
}

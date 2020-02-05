<?php
function debug($var)
{
    highlight_string("<?php\n" . var_export($var, true) . ";\n?>");
}

function derniersproduits(PDO $bdd)
{
    $query = $bdd->query('SELECT products.*
FROM products
ORDER BY products.name ASC LIMIT 10');

    $reponse = $query->fetchAll();

    return $reponse;
}

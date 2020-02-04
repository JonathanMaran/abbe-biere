<?php

include 'config.php';

try {
    $bdd = new PDO('mysql:host=localhost:3308;dbname=abbe-biere;charset=utf8', $user, $password);

} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

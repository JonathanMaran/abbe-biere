<?php
include 'config.php';

//test connection
try {
    //connection BDD
    $bdd = new PDO('mysql:host=localhost;dbname=abbe-biere;charset=utf8', $user, $password);
} catch (Exception $e) {
    die ('Erreur: ' . $e->getMessage());
}
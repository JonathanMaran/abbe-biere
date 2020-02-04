<?php
include 'config.php';

//test connection
try {
    //connection BDD
    $BDD = new PDO('mysql:host=localhost;dbname=abbebiere;charset=utf8', $user, $password);
} catch (Exception $e) {
    die ('Erreur: ' . $e->getMessage());
}
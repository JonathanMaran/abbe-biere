<?php
session_start();

$_SESSION['prenom'];
$_SESSION['nom'];
$_SESSION['age'];

$creationpanier = creationPanier();

debug();
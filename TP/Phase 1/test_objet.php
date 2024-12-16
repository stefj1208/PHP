<?php
require 'Maison.php';

$maison = new Maison();
$maison->nom = "Maison de campagne";
$maison->longueur = 10;
$maison->largeur = 8;
$maison->nbEtages = 2; // Exemple : maison avec 2 étages

$maison->surface();
?>

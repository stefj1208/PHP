<?php
require 'Animal.php'; // Inclusion de la classe Animal

// Création de la première instance de la classe Animal
$animal1 = new Animal();
$animal1->setId(1);               // Définition de l'ID de l'animal
$animal1->setLibelle("Lion");     // Définition du libellé de l'animal
$animal1->setPredateur(true);     // Définition de l'attribut prédateur

// Création de la deuxième instance de la classe Animal
$animal2 = new Animal();
$animal2->setId(2);               // Définition de l'ID de l'animal
$animal2->setLibelle("Antilope"); // Définition du libellé de l'animal
$animal2->setPredateur(false);    // Définition de l'attribut prédateur

// Affichage des informations du premier animal
echo "<p>Animal 1 : {$animal1->getLibelle()}, Prédateur : " . ($animal1->isPredateur() ? "Oui" : "Non") . "</p>";

// Affichage des informations du deuxième animal
echo "<p>Animal 2 : {$animal2->getLibelle()}, Prédateur : " . ($animal2->isPredateur() ? "Oui" : "Non") . "</p>";
?>

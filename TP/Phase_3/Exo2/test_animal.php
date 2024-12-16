<?php
require 'Animal2.php';

// Création des objets avec le constructeur
$animal1 = new Animal(1, "Lion", true);
$animal2 = new Animal(2, "Antilope", false);

echo "<p>Animal 1 : {$animal1->getLibelle()}, Prédateur : " . ($animal1->isPredateur() ? "Oui" : "Non") . "</p>";
echo "<p>Animal 2 : {$animal2->getLibelle()}, Prédateur : " . ($animal2->isPredateur() ? "Oui" : "Non") . "</p>";
?>

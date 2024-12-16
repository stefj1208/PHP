<?php
require 'Salle2.php';

// Création des objets avec le constructeur
$salle1 = new Salle(1, "Salle de réunion", 20, true);
$salle2 = new Salle(2, "Salle informatique", 15, false);

echo "<p>Salle 1 : {$salle1->getLibelle()}, Capacité : {$salle1->getCapacite()}, Occupée : " . ($salle1->isOccupe() ? "Oui" : "Non") . "</p>";
echo "<p>Salle 2 : {$salle2->getLibelle()}, Capacité : {$salle2->getCapacite()}, Occupée : " . ($salle2->isOccupe() ? "Oui" : "Non") . "</p>";
?>

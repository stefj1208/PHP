<?php
require 'Salle.php';

$salle1 = new Salle();
$salle1->setId(1);
$salle1->setLibelle("Salle de réunion");
$salle1->setCapacite(20);
$salle1->setOccupe(true);

$salle2 = new Salle();
$salle2->setId(2);
$salle2->setLibelle("Salle informatique");
$salle2->setCapacite(15);
$salle2->setOccupe(false);

echo "<p>Salle 1 : {$salle1->getLibelle()}, Capacité : {$salle1->getCapacite()}, Occupée : " . ($salle1->isOccupe() ? "Oui" : "Non") . "</p>";
echo "<p>Salle 2 : {$salle2->getLibelle()}, Capacité : {$salle2->getCapacite()}, Occupée : " . ($salle2->isOccupe() ? "Oui" : "Non") . "</p>";
?>

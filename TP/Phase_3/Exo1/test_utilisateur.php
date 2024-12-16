<?php
require 'Utilisateur2.php';

// Création des objets avec le constructeur
$user1 = new Utilisateur(1, "Dupont", "Jean");
$user2 = new Utilisateur(2, "Martin", "Claire");

echo "<p>Utilisateur 1 : {$user1->getPrenom()} {$user1->getNom()}</p>";
echo "<p>Utilisateur 2 : {$user2->getPrenom()} {$user2->getNom()}</p>";
?>

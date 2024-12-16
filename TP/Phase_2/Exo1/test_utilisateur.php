<?php
require 'Utilisateur.php';

// Création des utilisateurs avec les arguments nécessaires pour le constructeur
$user1 = new Utilisateur(1, "Dupont", "Jean");
$user2 = new Utilisateur(2, "Martin", "Claire");

// Affichage des informations des utilisateurs
echo "<p>Utilisateur 1 : {$user1->getPrenom()} {$user1->getNom()}</p>";
echo "<p>Utilisateur 2 : {$user2->getPrenom()} {$user2->getNom()}</p>";
?>

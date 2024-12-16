<?php
require_once 'Cd.php';
require_once 'Livre.php';
require_once 'Dvd.php';

// Création d'instances de la classe Cd
$cd1 = new Cd("Auteur 1", "Album 1", "Ref001", "60 minutes", 12);
$cd2 = new Cd("Auteur 2", "Album 2", "Ref002", "45 minutes", 10);

// Création d'instances de la classe Livre
$livre1 = new Livre("Auteur 3", "Livre 1", "Ref003", 200);
$livre2 = new Livre("Auteur 4", "Livre 2", "Ref004", 350);

// Création d'instances de la classe Dvd
$dvd1 = new Dvd("Auteur 5", "Film 1", "Ref005", "120 minutes", "Making-of inclus");
$dvd2 = new Dvd("Auteur 6", "Film 2", "Ref006", "90 minutes", "Scènes coupées");

echo "<h3>CDs :</h3>";
echo "<p>{$cd1->getTitre()} de {$cd1->getAuteur()} ({$cd1->getDuree()}, {$cd1->getNbPlages()} plages)</p>";
echo "<p>{$cd2->getTitre()} de {$cd2->getAuteur()} ({$cd2->getDuree()}, {$cd2->getNbPlages()} plages)</p>";

echo "<h3>Livres :</h3>";
echo "<p>{$livre1->getTitre()} de {$livre1->getAuteur()} ({$livre1->getNbPages()} pages)</p>";
echo "<p>{$livre2->getTitre()} de {$livre2->getAuteur()} ({$livre2->getNbPages()} pages)</p>";

echo "<h3>DVDs :</h3>";
echo "<p>{$dvd1->getTitre()} de {$dvd1->getAuteur()} ({$dvd1->getDuree()}, {$dvd1->getBonus()})</p>";
echo "<p>{$dvd2->getTitre()} de {$dvd2->getAuteur()} ({$dvd2->getDuree()}, {$dvd2->getBonus()})</p>";
?>

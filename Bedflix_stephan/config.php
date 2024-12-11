<?php
$host = 'localhost'; // Serveur local
$dbname = 'bedflix'; // Nom de la base de données
$username = 'root'; // Nom d'utilisateur par défaut pour XAMPP
$password = ''; // Mot de passe vide par défaut pour XAMPP

try {
    // Crée une nouvelle connexion PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Définit le mode d'erreur pour PDO en mode Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie à la base de données.";
} catch (PDOException $e) {
    // Affiche un message d'erreur si la connexion échoue
    die("Erreur : " . $e->getMessage());
}
?>

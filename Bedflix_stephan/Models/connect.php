<?php
// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Initialise une nouvelle session PHP si aucune session n'est active.
}

try {
    // Connect to the database
    $db = new PDO( // Crée une nouvelle connexion PDO à la base de données.
        'mysql:host=localhost;dbname=bedflix', // Définit l'hôte (localhost) et le nom de la base de données ('bedflix').
        'root', // Identifiant de connexion à la base de données (par défaut pour XAMPP est 'root').
        '', // Mot de passe de connexion à la base de données (par défaut pour XAMPP est vide).
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION) // Configure PDO pour lever une exception en cas d'erreur SQL.
    );
} catch (PDOException $e) { // Capture les exceptions générées par PDO en cas de problème de connexion.
    // Handle connection errors
    die('Erreur : ' . $e->getMessage()); // Arrête l'exécution du script et affiche un message d'erreur en cas d'échec.
}
?>


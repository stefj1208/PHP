<?php
// Démarre la session proprement
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inclut la connexion à la base de données
include 'Models/connect.php';

// Liste des routes et leurs fichiers associés
$routing = array(
    "home" => "views/home.php",           // Page d'accueil
    "series" => "views/series.php",       // Séries
    "movies" => "views/movies.php",       // Films
    "profile" => "views/profile.php",     // Profil utilisateur
    "connexion" => "views/connexion.php", // Connexion
    "inscription" => "views/Inscription.php", // Inscription
    "logout" => "views/logout.php",       // Déconnexion
);

// Récupère le paramètre "page" dans l'URL
$page = $_GET['page'] ?? 'home'; // Par défaut, la page d'accueil

// Vérifie si la page existe dans les routes, sinon affiche erreur 404
if (!empty($routing[$page]) && file_exists($routing[$page])) {
    $pagePath = $routing[$page];
} else {
    $pagePath = "views/errors/error_404.php"; // Page d'erreur
}

// Inclut l'en-tête
include 'views/header.php';

// Inclut la page demandée
include($pagePath);
?>

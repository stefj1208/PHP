<?php
session_start(); // Démarre la session pour accéder aux variables de session.
include 'config.php'; // Inclut le fichier de connexion à la base de données.

// Vérifie si le formulaire a été soumis et si la session 'email' est définie
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['email'], $_POST['password'])) {
    $email = $_SESSION['email']; // Récupère l'email depuis la session
    $password = $_POST['password']; // Récupère le mot de passe soumis dans le formulaire

    try {
        // Prépare une requête SQL pour récupérer l'utilisateur correspondant à l'email
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]); // Exécute la requête avec l'email comme paramètre
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // Récupère les données de l'utilisateur sous forme de tableau associatif

        // Vérifie si l'utilisateur existe et si le mot de passe saisi correspond au hash stocké
        if ($user && password_verify($password, $user['mot_de_passe'])) {
            // Connexion réussie : stocke les informations de l'utilisateur en session
            $_SESSION['user_id'] = $user['id']; // Enregistre l'ID de l'utilisateur dans la session
            $_SESSION['user_name'] = $user['pseudo']; // Enregistre le pseudo de l'utilisateur (si disponible)
            
            // Redirige vers la page d'accueil
            header("Location: home.php");
            exit();
        } else {
            // Si les identifiants sont incorrects, affiche un message d'erreur
            echo "<p style='color: red;'>Email ou mot de passe incorrect.</p>";
        }
    } catch (PDOException $e) {
        // Gestion des erreurs de connexion à la base de données
        echo "<p style='color: red;'>Erreur : " . $e->getMessage() . "</p>";
    }
} else {
    // Redirige vers la page de connexion si les données sont manquantes
    header("Location: connexion.php");
    exit();
}
?>

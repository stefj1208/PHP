<?php
session_start(); // Démarre la session pour afficher les messages d'erreur ou de succès

// Inclut la connexion à la base de données et le modèle utilisateur
include '../models/connect.php';
include '../models/User.php';

// Initialiser une variable pour gérer les erreurs
$error = null;

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['form_email']); // Sécurise l'email
    $password = htmlspecialchars($_POST['form_password']); // Sécurise le mot de passe
    $pseudo = htmlspecialchars($_POST['form_pseudo']); // Sécurise le pseudo

    $userModel = new User($db); // Instancie le modèle User avec la connexion PDO

    // Vérifie si l'email existe déjà
    if (!$userModel->emailExists($email)) {
        // Hache le mot de passe
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        
        // Insère les données
        if ($userModel->registerUser($email, $hashed_password, $pseudo, 2)) {
            // Redirige avec un message de succès
            header('Location: ../views/login.php?success=1');
            exit();
        } else {
            $error = "Inscription échouée. Veuillez réessayer.";
        }
    } else {
        $error = "Cette adresse email est déjà utilisée.";
    }
}

// Inclut la vue d'inscription
include '../views/register.php';
?>

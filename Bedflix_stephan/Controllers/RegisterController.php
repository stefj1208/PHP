<?php 
session_start(); // Démarre la session pour afficher les messages d'erreur ou de succès

// Inclut la connexion à la base de données et le modèle utilisateur
include '../Models/connect.php';
include '../Models/User.php';

// Initialiser une variable pour gérer les erreurs
$error = null;

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['form_email']); // Sécurise l'email
    $password = $_POST['form_password']; // Mot de passe (ne pas hacher ici)
    $pseudo = htmlspecialchars($_POST['form_pseudo']); // Sécurise le pseudo

    $userModel = new User($db); // Instancie le modèle User avec la connexion PDO

    // Vérifie si l'email existe déjà
    if (!$userModel->emailExists($email)) {
        // Insère les données (le hachage est géré dans User::registerUser)
        if ($userModel->registerUser($email, $password, $pseudo, 2)) {
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
include '../views/Inscription.php';
?>

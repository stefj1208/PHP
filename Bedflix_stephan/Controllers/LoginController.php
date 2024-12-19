<?php
session_start(); // Démarre la session
require_once 'config.php'; // Inclut la connexion à la base de données
require_once 'model/User.php'; // Inclut la classe User

// Vérifie si le formulaire a été soumis avec les champs requis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Initialisation de la classe User
        $userModel = new User($pdo);

        // Récupère l'utilisateur par email
        $userData = $userModel->getUserByEmail($email);

        // Vérifie si l'utilisateur existe et si le mot de passe est correct
        if ($userData && $userModel->verifyPassword($password, $userData['mot_de_passe_utilisateur'])) {
            // Stocke les informations utilisateur dans la session
            $_SESSION['user_id'] = $userData['id_utilisateur'];
            $_SESSION['user_name'] = $userData['pseudo_utilisateur'];
            $_SESSION['user_email'] = $userData['email_utilisateur'];

            // Redirige vers la page d'accueil
            header("Location: home.php");
            exit();
        } else {
            echo "<p style='color: red;'>Email ou mot de passe incorrect.</p>";
        }
    } catch (PDOException $e) {
        // Gestion des erreurs de base de données
        echo "<p style='color: red;'>Erreur : " . $e->getMessage() . "</p>";
    }
} else {
    // Redirige vers la page de connexion si les champs sont vides
    header("Location: connexion.php");
    exit();
}
?>

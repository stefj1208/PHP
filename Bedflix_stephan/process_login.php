<?php
session_start();
include 'config.php'; // Connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['email'], $_POST['password'])) {
    $email = $_SESSION['email'];
    $password = $_POST['password'];

    try {
        // Vérifie les informations de connexion
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            // Connexion réussie
            $_SESSION['user_id'] = $user['id'];
            header("Location: home.php"); // Redirige vers la page d'accueil
            exit();
        } else {
            echo "<p>Email ou mot de passe incorrect.</p>";
        }
    } catch (PDOException $e) {
        echo "<p>Erreur : " . $e->getMessage() . "</p>";
    }
} else {
    // Redirige si les données sont manquantes
    header("Location: connexion.php");
    exit();
}
?>

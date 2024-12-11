<?php
// Inclure la connexion à la base de données
include '../includes/connect.php'; // Inclut le fichier de connexion à la base de données pour accéder à l'objet PDO $db.

// Vérifier si l'email est en session
session_start(); // Démarre une session PHP pour accéder aux données de session.
if (!isset($_SESSION['email'])) { // Vérifie si l'email est enregistré en session.
    header('Location: connexion.php'); // Si l'email n'est pas en session, redirige vers l'étape 1 de la connexion.
    exit(); // Arrête l'exécution du script après la redirection.
}

// Initialiser une variable pour gérer les erreurs
$error = null; // Variable pour stocker un message d'erreur en cas de problème avec le mot de passe.

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Vérifie si la requête HTTP utilisée est POST (le formulaire a été soumis).
    $email = $_SESSION['email']; // Récupère l'email de l'utilisateur stocké en session.
    $password = $_POST['password']; // Récupère le mot de passe soumis dans le formulaire.

    // Vérifier le mot de passe
    $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE email_utilisateur = :email"); 
    // Prépare une requête SQL pour sélectionner un utilisateur correspondant à l'email en session.
    
    $stmt->bindParam(':email', $email); // Lie la variable $email au paramètre nommé :email dans la requête.
    $stmt->execute(); // Exécute la requête préparée.
    $user = $stmt->fetch(PDO::FETCH_ASSOC); // Récupère les données de l'utilisateur en tant que tableau associatif.

    if ($user && $password === $user['mot_de_passe_utilisateur']) { 
        // Vérifie que l'utilisateur existe et que le mot de passe soumis correspond à celui dans la base de données.
        
        // Créer une session utilisateur
        $_SESSION['user_id'] = $user['id_utilisateur']; // Stocke l'ID de l'utilisateur dans la session.
        $_SESSION['user_name'] = $user['pseudo_utilisateur']; // Stocke le pseudonyme de l'utilisateur dans la session.
        $_SESSION['user_role'] = $user['id_role']; // Stocke le rôle de l'utilisateur dans la session.

        // Rediriger vers la page d'accueil
        header('Location: home.php'); // Redirige l'utilisateur vers la page d'accueil.
        exit(); // Arrête l'exécution du script après la redirection.
    } else {
        $error = "Mot de passe incorrect."; // Définit un message d'erreur si le mot de passe est incorrect.
    }
}
?>

<!DOCTYPE html>
<html lang="fr"> <!-- Déclare le document HTML et la langue (français). -->
<head>
    <meta charset="UTF-8"> <!-- Définit l'encodage des caractères en UTF-8. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configure le viewport pour un affichage responsive sur mobile. -->
    <title>Connexion - Étape 2</title> <!-- Définit le titre de la page. -->
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Lien vers le fichier CSS pour styliser la page. -->
</head>
<body>
    <div class="login-form"> <!-- Conteneur principal du formulaire de connexion. -->
        <h1>Connexion - Étape 2</h1> <!-- Titre de la page. -->

        <!-- Affiche un message d'erreur si $error contient une valeur -->
        <?php if ($error): ?>
            <p style="color: red;"><?= $error ?></p> <!-- Affiche le message d'erreur en rouge si le mot de passe est incorrect. -->
        <?php endif; ?>

        <!-- Formulaire pour saisir le mot de passe -->
        <form method="POST" action=""> <!-- Définit un formulaire avec la méthode POST et aucune action (action par défaut : la page actuelle). -->
            <label for="password">Mot de passe :</label> <!-- Étiquette pour le champ de saisie du mot de passe. -->
            <input type="password" name="password" id="password" required> <!-- Champ de saisie pour le mot de passe, obligatoire grâce à "required". -->
            <button type="submit">Se connecter</button> <!-- Bouton pour soumettre le formulaire. -->
        </form>
    </div>
</body>
</html>

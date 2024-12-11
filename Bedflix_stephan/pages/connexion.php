<?php
// Inclure la connexion à la base de données
include '../includes/connect.php'; // Inclut le fichier de connexion à la base de données, permettant d'accéder à l'objet PDO $db.

// Initialiser une variable pour gérer les erreurs
$error = null; // Définit une variable pour stocker un message d'erreur en cas de problème avec l'email.

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Vérifie si la méthode de requête HTTP utilisée est POST.
    $email = htmlspecialchars($_POST['email']); // Récupère l'email envoyé depuis le formulaire tout en sécurisant les caractères spéciaux pour éviter les failles XSS.

    // Vérifier si l'email existe dans la base
    $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE email_utilisateur = :email"); 
    // Prépare une requête SQL pour sélectionner un utilisateur correspondant à l'email fourni.

    $stmt->bindParam(':email', $email); // Lie la variable $email au paramètre nommé :email dans la requête.
    $stmt->execute(); // Exécute la requête préparée.

    if ($stmt->rowCount() === 1) { // Vérifie si une ligne est retournée (l'email existe dans la base de données).
        // Stocker l'email en session et rediriger vers l'écran 2
        session_start(); // Démarre une session pour enregistrer l'email de l'utilisateur.
        $_SESSION['email'] = $email; // Stocke l'email de l'utilisateur dans la session.
        header('Location: connexion_step2.php'); // Redirige l'utilisateur vers la page "connexion_step2.php".
        exit(); // Arrête l'exécution du script après la redirection.
    } else {
        $error = "Email non trouvé."; // Définit un message d'erreur si aucun utilisateur correspondant n'est trouvé.
    }
}
?>

<!DOCTYPE html>
<html lang="fr"> <!-- Déclare le document comme HTML et spécifie que la langue est le français. -->
<head>
    <meta charset="UTF-8"> <!-- Définit l'encodage des caractères en UTF-8, prenant en charge les caractères spéciaux. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configure le viewport pour un affichage adaptatif sur mobile. -->
    <title>Connexion - Étape 1</title> <!-- Définit le titre de la page affiché dans l'onglet du navigateur. -->
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Lien vers le fichier CSS pour styliser la page. -->
</head>
<body>
    <div class="login-form"> <!-- Conteneur pour le formulaire de connexion. -->
        <h1>Connexion - Étape 1</h1> <!-- Titre de la page. -->

        <!-- Affiche un message d'erreur si $error contient une valeur -->
        <?php if ($error): ?>
            <p style="color: red;"><?= $error ?></p> <!-- Affiche le message d'erreur en rouge si l'email n'est pas trouvé. -->
        <?php endif; ?>

        <!-- Formulaire de saisie de l'email -->
        <form method="POST" action=""> <!-- Définit un formulaire avec la méthode POST et aucune action spécifique (action par défaut : la page actuelle). -->
            <label for="email">Email :</label> <!-- Étiquette pour le champ de saisie de l'email. -->
            <input type="email" name="email" id="email" required> <!-- Champ de saisie pour l'email, obligatoire grâce à "required". -->
            <button type="submit">Suivant</button> <!-- Bouton pour soumettre le formulaire. -->
        </form>
    </div>
</body>
</html>

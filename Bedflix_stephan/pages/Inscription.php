<?php
// On inclut notre connecteur à la base de données
include('../includes/connect.php');

// Initialiser une variable pour gérer les erreurs
$error = null;

// On entre dans la boucle seulement lors de l’envoi du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire et les nettoyer
    $email = htmlspecialchars($_POST['form_email']);
    $password = htmlspecialchars($_POST['form_password']);
    $pseudo = htmlspecialchars($_POST['form_pseudo']);

    // Vérifier si l'adresse email existe déjà en base de données
    $select = $db->prepare("SELECT email_utilisateur FROM utilisateurs WHERE email_utilisateur = :email;");
    $select->bindParam(":email", $email);
    $select->execute();

    if (empty($select->fetch(PDO::FETCH_COLUMN))) {
        // Si l'email n'existe pas encore, on insère les données
        $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Hacher le mot de passe pour plus de sécurité
        $insert = $db->prepare("
            INSERT INTO utilisateurs (email_utilisateur, mot_de_passe_utilisateur, pseudo_utilisateur, id_role)
            VALUES (:email, :password, :pseudo, :role_id);
        ");
        $role_id = 2; // Par exemple, un rôle utilisateur par défaut (non administrateur)
        $insert->bindParam(":email", $email);
        $insert->bindParam(":password", $hashed_password);
        $insert->bindParam(":pseudo", $pseudo);
        $insert->bindParam(":role_id", $role_id);

        if ($insert->execute()) {
            // Si aucune erreur ne se produit, afficher un message de succès et proposer la connexion
            die('<p style="color: green;">Inscription réussie.</p><a href="connexion.php">Se connecter.</a>');
        } else {
            // Si une erreur survient, afficher un message d'échec
            $error = "Inscription échouée. Veuillez réessayer.";
        }
    } else {
        // Si l'email existe déjà, afficher un message d'erreur
        $error = "Cette adresse email est déjà utilisée.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="signup-form">
        <h1>Inscription</h1>

        <!-- Affiche un message d'erreur s'il y en a -->
        <?php if ($error): ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <!-- Formulaire d'inscription -->
        <form method="POST" action="">
            <label for="form_pseudo">Pseudo :</label>
            <input type="text" name="form_pseudo" id="form_pseudo" required>

            <label for="form_email">Adresse Email :</label>
            <input type="email" name="form_email" id="form_email" required>

            <label for="form_password">Mot de passe :</label>
            <input type="password" name="form_password" id="form_password" required>

            <button type="submit">S'inscrire</button>
        </form>

        <p>Déjà inscrit ? <a href="connexion.php">Connectez-vous ici</a>.</p>
    </div>
</body>
</html>

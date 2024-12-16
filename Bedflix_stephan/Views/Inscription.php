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
        <?php if (isset($error) && $error): ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="form_pseudo">Pseudo :</label>
            <input type="text" name="form_pseudo" id="form_pseudo" required>

            <label for="form_email">Adresse Email :</label>
            <input type="email" name="form_email" id="form_email" required>

            <label for="form_password">Mot de passe :</label>
            <input type="password" name="form_password" id="form_password" required>

            <button type="submit">S'inscrire</button>
        </form>

        <p>Déjà inscrit ? <a href="login.php">Connectez-vous ici</a>.</p>
    </div>
</body>
</html>

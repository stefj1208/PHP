<?php
// Start the session only if it's not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect to login if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?page=connexion');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css"> <!-- Path to your CSS file -->
    <title>Bedflix</title>
</head>
<body>
<nav class="navbar">
    <div class="navbar-container">
        <!-- Logo -->
        <a href="index.php?page=home" class="navbar-logo">BEDFLIX</a>
        
        <!-- Links -->
        <ul class="navbar-links">
            <li><a href="index.php?page=home">Accueil</a></li>
            <li><a href="index.php?page=series">Séries</a></li>
            <li><a href="index.php?page=movies">Films</a></li>
            <li><a href="index.php?page=profile">Profil</a></li>
        </ul>

        <!-- User options -->
        <div class="navbar-user">
            <span class="navbar-username">
                <?= htmlspecialchars($_SESSION['user_name'] ?? 'Utilisateur') ?>
            </span>
            <a href="index.php?page=logout" class="logout-link">Déconnexion</a>
        </div>
    </div>
</nav>
</body>
</html>

<?php
// Start the session only if it's not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect to login if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../pages/connexion.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Path to your CSS file -->
    <title>Bedflix</title>
</head>
<body>
<nav class="navbar">
    <div class="navbar-container">
        <!-- Logo -->
        <a href="home.php" class="navbar-logo">BEDFLIX</a>
        
        <!-- Links -->
        <ul class="navbar-links">
            <li><a href="home.php">Accueil</a></li>
            <li><a href="series.php">Séries</a></li>
            <li><a href="movies.php">Films</a></li>
            <li><a href="profile.php">Profil</a></li>
        </ul>

        <!-- User options -->
        <div class="navbar-user">
            <span class="navbar-username"><?= htmlspecialchars($_SESSION['user_name']) ?></span>
            <a href="../pages/logout.php" class="logout-link">Déconnexion</a>
        </div>
    </div>
</nav>
</body>
</html>

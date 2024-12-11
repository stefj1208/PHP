<?php 
// Include database connection
include '../includes/connect.php'; // Inclut le fichier de connexion à la base de données pour accéder à l'objet PDO `$db`.

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) { // Vérifie si l'utilisateur est connecté en vérifiant si `user_id` est présent dans la session.
    header('Location: connexion.php'); // Si l'utilisateur n'est pas connecté, il est redirigé vers la page de connexion.
    exit(); // Arrête l'exécution du script après la redirection.
}

// Get user ID from session
$user_id = $_SESSION['user_id']; // Récupère l'ID de l'utilisateur actuellement connecté depuis la session.

// Retrieve a featured film or series
$stmt = $db->query("
    SELECT * 
    FROM (
        SELECT titre_film AS titre, description_film AS description, affiche_film AS affiche
        FROM films
        UNION
        SELECT titre_serie AS titre, description_serie AS description, affiche_serie AS affiche
        FROM series
    ) AS combined
    ORDER BY RAND()
    LIMIT 1;
");
// Cette requête SQL combine aléatoirement un film ou une série pour les afficher en vedette.
// `UNION` fusionne les résultats des films et des séries en une seule table temporaire.
// `ORDER BY RAND()` sélectionne une entrée aléatoire.
// `LIMIT 1` limite le résultat à une seule entrée.

$featured = $stmt->fetch(PDO::FETCH_ASSOC); // Récupère la ligne retournée par la requête comme un tableau associatif.

// Retrieve trending films and series
$trending = $db->query("
    SELECT titre_film AS titre, affiche_film AS affiche
    FROM films
    UNION
    SELECT titre_serie AS titre, affiche_serie AS affiche
    FROM series
    LIMIT 10;
")->fetchAll(PDO::FETCH_ASSOC);
// Cette requête récupère une liste des 10 films et séries les plus populaires pour la section "En ce moment".
// `UNION` fusionne les résultats des films et séries pour un affichage unifié.
// `LIMIT 10` limite les résultats aux 10 premières entrées.

// Retrieve personalized recommendations for the logged-in user
$stmt = $db->prepare("
    SELECT f.titre_film AS titre, f.affiche_film AS affiche
    FROM films f
    JOIN utilisateurs_films uf ON f.id_film = uf.id_film
    WHERE uf.id_utilisateur = :user_id
    UNION
    SELECT s.titre_serie AS titre, s.affiche_serie AS affiche
    FROM series s
    JOIN utilisateurs_series us ON s.id_serie = us.id_serie
    WHERE us.id_utilisateur = :user_id;
");
// Cette requête récupère des recommandations personnalisées pour l'utilisateur connecté.
// Les films et séries sont sélectionnés sur la base des éléments consultés par l'utilisateur (via les tables `utilisateurs_films` et `utilisateurs_series`).
// Les résultats sont fusionnés avec `UNION`.

$stmt->bindParam(':user_id', $user_id); // Lie la variable `$user_id` au paramètre nommé `:user_id` dans la requête.
$stmt->execute(); // Exécute la requête préparée.
$personalized = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupère tous les résultats sous forme d'un tableau associatif.
?>

<!DOCTYPE html>
<html lang="fr"> <!-- Déclare le document HTML avec le langage français. -->
<head>
    <meta charset="UTF-8"> <!-- Définit l'encodage des caractères en UTF-8. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configure le viewport pour un affichage responsive sur mobile. -->
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Lien vers le fichier CSS pour styliser la page. -->
    <title>Accueil - Bedflix</title> <!-- Définit le titre de la page affiché dans l'onglet du navigateur. -->
</head>
<body>
<?php include '../includes/header.php'; ?> <!-- Inclut l'en-tête (header) commun à toutes les pages. -->

<div class="home-container"> <!-- Conteneur principal de la page d'accueil -->

    <!-- Featured Film or Series -->
    <div class="featured">
        <h2>En vedette</h2> <!-- Titre de la section "En vedette". -->
        <img src="../assets/images/<?= htmlspecialchars($featured['affiche']) ?>" alt="<?= htmlspecialchars($featured['titre']) ?>" class="featured-img">
        <!-- Affiche une image du film ou de la série en vedette. Les données sont protégées contre les failles XSS avec `htmlspecialchars`. -->
        <h3><?= htmlspecialchars($featured['titre']) ?></h3> <!-- Affiche le titre en vedette. -->
        <p><?= htmlspecialchars($featured['description']) ?></p> <!-- Affiche la description en vedette. -->
    </div>

    <!-- Trending Section -->
    <div class="carousel">
        <h2>En ce moment</h2> <!-- Titre de la section des contenus en tendance. -->
        <div class="carousel-items"> <!-- Conteneur pour les éléments du carrousel. -->
            <?php foreach ($trending as $item): ?> <!-- Parcourt les éléments récupérés dans la requête "trending". -->
                <div class="carousel-item">
                    <img src="../assets/images/<?= htmlspecialchars($item['affiche']) ?>" alt="<?= htmlspecialchars($item['titre']) ?>" class="carousel-img">
                    <!-- Affiche l'image de l'élément avec son titre comme texte alternatif. -->
                    <p><?= htmlspecialchars($item['titre']) ?></p> <!-- Affiche le titre de l'élément. -->
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Personalized Recommendations -->
    <div class="carousel">
        <h2>Recommandés pour vous</h2> <!-- Titre de la section des recommandations personnalisées. -->
        <div class="carousel-items"> <!-- Conteneur pour les éléments du carrousel. -->
            <?php foreach ($personalized as $item): ?> <!-- Parcourt les éléments récupérés dans la requête "personalized". -->
                <div class="carousel-item">
                    <img src="../assets/images/<?= htmlspecialchars($item['affiche']) ?>" alt="<?= htmlspecialchars($item['titre']) ?>" class="carousel-img">
                    <!-- Affiche l'image de l'élément avec son titre comme texte alternatif. -->
                    <p><?= htmlspecialchars($item['titre']) ?></p> <!-- Affiche le titre de l'élément. -->
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</body>
</html>

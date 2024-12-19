<?php
// Inclusion des fichiers nécessaires
require_once 'config.php'; // Configuration de la base de données
require_once 'header.php'; // En-tête de la page
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Séries</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/app.js" defer></script>
    <style>
        img {
            max-width: 300px; /* Ajuste la largeur maximale de l'image */
            height: auto; /* Maintient les proportions */
            display: block;
            margin: 0 auto; /* Centre l'image */
        }
        .card {
            text-align: center;
        }
    </style>
</head>
<body>

<!-- Section Filtre des genres -->
<section class="filter">
    <h2>Filtrer par Catégorie</h2>
    <form method="GET" action="">
        <select name="genre" onchange="this.form.submit()">
            <option value="">-- Choisir un genre --</option>
            <option value="thriller">Thriller</option>
            <option value="action">Action</option>
            <option value="ados">Ados</option>
            <option value="anime">Anime</option>
            <option value="drame">Drame</option>
            <option value="enfant">Enfant</option>
            <option value="policier">Policier</option>
            <option value="horreur">Horreur</option>
            <option value="sci-fi">Science-Fiction</option>
            <option value="téléréalité">Téléréalité</option>
        </select>
    </form>
</section>

<?php
// Connexion à la base de données
require_once 'config.php';

// Récupération du genre sélectionné
$genre = isset($_GET['genre']) ? $_GET['genre'] : '';
$series = [];
$tendance = [];

try {
    // Récupération des données des séries depuis la base
    if ($genre) {
        $stmt = $pdo->prepare("SELECT * FROM series WHERE genre = ?");
        $stmt->execute([$genre]);
    } else {
        $stmt = $pdo->prepare("SELECT * FROM series");
        $stmt->execute();
    }
    $series = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Sélection de la série tendance
    $stmt_tendance = $pdo->prepare("SELECT * FROM series ORDER BY popularite DESC LIMIT 1");
    $stmt_tendance->execute();
    $tendance = $stmt_tendance->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}

// Fonction pour vérifier le chemin de l'image
function getImagePath($path) {
    return file_exists($path) ? $path : 'assets/images/default.jpg';
}
?>

<!-- Section Série Tendance -->
<section class="serie-tendance">
    <h2>Série Tendance</h2>
    <?php if (!empty($tendance)): ?>
        <div class="card">
            <img src="<?php echo getImagePath('assets/images/' . $tendance['affiche_serie']); ?>" alt="<?php echo isset($tendance['titre_serie']) ? htmlspecialchars($tendance['titre_serie']) : 'Titre inconnu'; ?>">
            <h3><?php echo isset($tendance['titre_serie']) ? htmlspecialchars($tendance['titre_serie']) : 'Titre inconnu'; ?></h3>
            <p><?php echo isset($tendance['description_serie']) ? htmlspecialchars($tendance['description_serie']) : 'Description non disponible.'; ?></p>
        </div>
    <?php else: ?>
        <p>Aucune série tendance disponible.</p>
    <?php endif; ?>
</section>

<!-- Section Carrousels par Genre -->
<?php 
$categories = ['thriller', 'action', 'ados', 'anime', 'drame', 'enfant', 'policier', 'horreur', 'sci-fi', 'téléréalité'];
foreach ($categories as $cat):
    try {
        $stmt = $pdo->prepare("SELECT * FROM series WHERE genre = ? LIMIT 10");
        $stmt->execute([$cat]);
        $series_genre = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
        continue;
    }
?>
<section class="carrousel">
    <h2><?php echo ucfirst($cat); ?></h2>
    <div class="carrousel-container">
        <?php foreach ($series_genre as $serie): ?>
            <div class="card">
                <img src="<?php echo getImagePath('assets/images/' . $serie['affiche_serie']); ?>" alt="<?php echo isset($serie['titre_serie']) ? htmlspecialchars($serie['titre_serie']) : 'Titre inconnu'; ?>">
                <h3><?php echo isset($serie['titre_serie']) ? htmlspecialchars($serie['titre_serie']) : 'Titre inconnu'; ?></h3>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endforeach; ?>

<?php require_once 'footer.php'; ?>
</body>
</html>

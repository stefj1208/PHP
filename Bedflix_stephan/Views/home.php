<?php
// Inclut la connexion à la base de données
include __DIR__ . '/../Models/connect.php';

// Démarre la session uniquement si aucune session n'est active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit();
}

// Section vedette (statique)
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
$featured = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <title>Accueil - Bedflix</title>
</head>
<body>
<?php include_once 'header.php'; ?>

<div class="home-container">
    <!-- Hero Section -->
    <div class="featured">
        <img src="../assets/images/<?= htmlspecialchars($featured['affiche']) ?>" alt="En Vedette" class="featured-img">
        <div class="featured-overlay">
            <h1 class="featured-title"><?= htmlspecialchars($featured['titre']) ?></h1>
            <p class="featured-description"><?= htmlspecialchars($featured['description']) ?></p>
            <div class="featured-buttons">
                <button class="btn play">▶ Regarder</button>
                <button class="btn info">ℹ️ Plus d'infos</button>
            </div>
        </div>
    </div>

    <!-- Section En ce moment -->
    <div class="carousel">
        <h2>Films du moment</h2>
        <div id="trending-section" class="carousel-items">
            <!-- Dynamique via AJAX -->
        </div>
    </div>

    <!-- Section Recommandés -->
    <div class="carousel">
        <h2>Recommandés pour vous</h2>
        <div id="recommended-section" class="carousel-items">
            <!-- Dynamique via AJAX -->
        </div>
    </div>

    <!-- Section Les plus populaires -->
    <div class="carousel">
        <h2>🌟 Les plus populaires</h2>
        <div id="popular-section" class="carousel-items">
            <!-- Dynamique via AJAX -->
        </div>
    </div>

    <!-- Section Nouveautés -->
    <div class="carousel">
        <h2>🆕 Nouveautés</h2>
        <div id="new-releases-section" class="carousel-items">
            <!-- Dynamique via AJAX -->
        </div>
    </div>
</div>

<script>
    // Fonction pour charger dynamiquement les sections via AJAX
    async function loadSection(sectionName, containerId) {
        const formData = new FormData();
        formData.append('section', sectionName);

        const response = await fetch('../Controllers/MovieController.php', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();
        const container = document.getElementById(containerId);
        container.innerHTML = ''; // Vide le contenu précédent

        if (data.error) {
            container.innerHTML = `<p>Erreur : ${data.error}</p>`;
            return;
        }

        // Ajouter les films dynamiquement
        data.forEach(item => {
            const div = document.createElement('div');
            div.className = 'carousel-item';
            div.innerHTML = `
                <img src="../assets/images/${item.affiche}" alt="${item.titre}">
                <p>${item.titre}</p>
            `;
            container.appendChild(div);
        });
    }

    // Charger les sections dynamiquement au chargement de la page
    window.onload = function() {
        loadSection('trending', 'trending-section');
        loadSection('recommended', 'recommended-section');
        loadSection('popular', 'popular-section');
        loadSection('new-releases', 'new-releases-section');
    };

    // Défilement horizontal des carrousels
    document.querySelectorAll('.carousel-items').forEach(carousel => {
        carousel.addEventListener('wheel', (e) => {
            e.preventDefault();
            carousel.scrollLeft += e.deltaY > 0 ? 100 : -100;
        });
    });
</script>
</body>
</html>

<?php
// Inclure le fichier de connexion à la base de données
require_once 'Models/connect.php';

// Démarrer la session et vérifier l'authentification
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 3) { // id_role = 3 pour Admin
    header('Location: Views/connexion.php'); // Rediriger si l'utilisateur n'est pas authentifié ou n'est pas Admin
    exit();
}

// Vérification de la connexion
if (!isset($db)) {
    die("Erreur de connexion à la base de données.");
}

// Variables pour stocker les données du formulaire
$titre_film = "";
$genre = "";
$description_film = "";
$duree_film = 0;
$popularite = 0;
$id_film = 0;
$update = false;

// -------------------------
// Création (ajout) de contenu
// -------------------------
if (isset($_POST['save'])) {
    $titre_film = htmlspecialchars($_POST['titre_film']);
    $genre = htmlspecialchars($_POST['genre']);
    $description_film = htmlspecialchars($_POST['description_film']);
    $duree_film = (float) $_POST['duree_film'];
    $popularite = (int) $_POST['popularite'];

    $query = $db->prepare("INSERT INTO films (titre_film, genre, description_film, duree_film, popularite) VALUES (:titre_film, :genre, :description_film, :duree_film, :popularite)");
    $query->execute([
        'titre_film' => $titre_film,
        'genre' => $genre,
        'description_film' => $description_film,
        'duree_film' => $duree_film,
        'popularite' => $popularite
    ]);
    header('location: admin.php');
}

// -------------------------
// Mise à jour (édition) de contenu
// -------------------------
if (isset($_POST['update'])) {
    $id_film = $_POST['id_film'];
    $titre_film = htmlspecialchars($_POST['titre_film']);
    $genre = htmlspecialchars($_POST['genre']);
    $description_film = htmlspecialchars($_POST['description_film']);
    $duree_film = (float) $_POST['duree_film'];
    $popularite = (int) $_POST['popularite'];

    $query = $db->prepare("UPDATE films SET titre_film = :titre_film, genre = :genre, description_film = :description_film, duree_film = :duree_film, popularite = :popularite WHERE id_film = :id_film");
    $query->execute([
        'id_film' => $id_film,
        'titre_film' => $titre_film,
        'genre' => $genre,
        'description_film' => $description_film,
        'duree_film' => $duree_film,
        'popularite' => $popularite
    ]);
    header('location: admin.php');
}

// -------------------------
// Suppression de contenu
// -------------------------
if (isset($_GET['delete'])) {
    $id_film = $_GET['delete'];
    $query = $db->prepare("DELETE FROM films WHERE id_film = :id_film");
    $query->execute(['id_film' => $id_film]);
    header('location: admin.php');
}

// -------------------------
// Récupérer les données existantes
// -------------------------
$query = $db->query("SELECT * FROM films");
$results = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Gestion des Films</title>
    <link rel="stylesheet" href="styles.css"> <!-- Ajoutez votre CSS ici -->
</head>
<body>
    <h1>Page d'administration - Gestion des Films</h1>
    <p>Bienvenue, <?php echo htmlspecialchars($_SESSION['user_name']); ?> (<a href="logout.php">Se déconnecter</a>)</p>

    <!-- Formulaire pour ajouter/éditer un film -->
    <form method="POST" action="admin.php">
        <input type="hidden" name="id_film" value="<?php echo $id_film; ?>">
        <label>Titre :</label>
        <input type="text" name="titre_film" value="<?php echo htmlspecialchars($titre_film); ?>" placeholder="Titre du film" required>
        
        <label>Genre :</label>
        <input type="text" name="genre" value="<?php echo htmlspecialchars($genre); ?>" placeholder="Genre du film" required>
        
        <label>Description :</label>
        <textarea name="description_film" placeholder="Description du film" required><?php echo htmlspecialchars($description_film); ?></textarea>
        
        <label>Durée (minutes) :</label>
        <input type="number" step="0.01" name="duree_film" value="<?php echo htmlspecialchars($duree_film); ?>" placeholder="Durée du film" required>
        
        <label>Popularité :</label>
        <input type="number" name="popularite" value="<?php echo htmlspecialchars($popularite); ?>" placeholder="Popularité" required>
        
        <?php if ($update == true): ?>
            <button type="submit" name="update">Mettre à jour</button>
        <?php else: ?>
            <button type="submit" name="save">Ajouter</button>
        <?php endif; ?>
    </form>

    <!-- Affichage des données dans un tableau -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Genre</th>
                <th>Description</th>
                <th>Durée</th>
                <th>Popularité</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $row) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id_film']); ?></td>
                    <td><?php echo htmlspecialchars($row['titre_film']); ?></td>
                    <td><?php echo htmlspecialchars($row['genre']); ?></td>
                    <td><?php echo htmlspecialchars($row['description_film']); ?></td>
                    <td><?php echo htmlspecialchars($row['duree_film']); ?></td>
                    <td><?php echo htmlspecialchars($row['popularite']); ?></td>
                    <td>
                        <a href="admin.php?edit=<?php echo $row['id_film']; ?>">Éditer</a>
                        <a href="admin.php?delete=<?php echo $row['id_film']; ?>" onclick="return confirm('Supprimer cet élément ?');">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>

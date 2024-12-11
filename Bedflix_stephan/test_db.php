<?php
// Inclure le fichier de configuration pour la connexion PDO
include 'config.php';

// Test de la connexion et récupération des données
try {
    // Récupère toutes les données de la table 'films'
    $stmt = $pdo->query("SELECT * FROM films");

    echo "<h1>Liste des Films</h1>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Description</th>
            <th>Date de Sortie</th>
        </tr>";

    // Boucle pour afficher chaque film dans une ligne du tableau
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['titre']}</td>
                <td>{$row['description']}</td>
                <td>{$row['date_sortie']}</td>
            </tr>";
    }
    echo "</table>";
} catch (PDOException $e) {
    // Affiche un message d'erreur si la requête échoue
    echo "<h1>Erreur : Impossible de récupérer les données.</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?>

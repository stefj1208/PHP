<?php
require_once __DIR__ . '/../Models/connect.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['section'])) {
    $section = $_POST['section'];
    $user_id = $_SESSION['user_id'] ?? 0;

    try {
        switch ($section) {
            case 'trending':
                $query = "
                    SELECT titre_film AS titre, affiche_film AS affiche
                    FROM films
                    UNION
                    SELECT titre_serie AS titre, affiche_serie AS affiche
                    FROM series
                    LIMIT 10;
                ";
                break;

            case 'recommended':
                $query = "
                    SELECT f.titre_film AS titre, f.affiche_film AS affiche
                    FROM films f
                    JOIN utilisateurs_films uf ON f.id_film = uf.id_film
                    WHERE uf.id_utilisateur = :user_id
                    UNION
                    SELECT s.titre_serie AS titre, s.affiche_serie AS affiche
                    FROM series s
                    JOIN utilisateurs_series us ON s.id_serie = us.id_serie
                    WHERE us.id_utilisateur = :user_id
                    LIMIT 10;
                ";
                break;

            case 'popular':
                $query = "
                    SELECT titre_film AS titre, affiche_film AS affiche
                    FROM films
                    LIMIT 10;
                ";
                break;

            case 'new-releases':
                $query = "
                    SELECT titre_film AS titre, affiche_film AS affiche
                    FROM films
                    LIMIT 10;
                ";
                break;

            default:
                echo json_encode(['error' => 'Section non reconnue']);
                exit;
        }

        $stmt = $db->prepare($query);

        if ($section === 'recommended') {
            $stmt->bindParam(':user_id', $user_id);
        }

        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($data);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Erreur SQL : ' . $e->getMessage()]);
    }
    exit;
}

echo json_encode(['error' => 'Aucune section spécifiée']);
exit;
?>

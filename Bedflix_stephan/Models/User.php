<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db; // Connexion à la base de données
    }

    // Vérifie si l'email existe déjà en base
    public function emailExists($email) {
        $stmt = $this->db->prepare("SELECT email_utilisateur FROM utilisateurs WHERE email_utilisateur = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_COLUMN) ? true : false;
    }

    // Enregistre un nouvel utilisateur
    public function registerUser($email, $password, $pseudo, $role_id) {
        $stmt = $this->db->prepare("
            INSERT INTO utilisateurs (email_utilisateur, mot_de_passe_utilisateur, pseudo_utilisateur, id_role)
            VALUES (:email, :password, :pseudo, :role_id)
        ");
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":pseudo", $pseudo);
        $stmt->bindParam(":role_id", $role_id);
        return $stmt->execute();
    }
}
?>

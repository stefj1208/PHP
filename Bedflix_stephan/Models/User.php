<?php
class User {
    private $db; // Connexion à la base de données
    private $id;
    private $email;
    private $pseudo;
    private $role_id;
    private $password;

    // Constructeur avec la connexion DB et possibilité d'initialiser les propriétés utilisateur
    public function __construct($db, $id = null) {
        $this->db = $db;

        // Si un ID est fourni, initialise les propriétés
        if ($id) {
            $this->loadUserById($id);
        }
    }

    // Charge les données utilisateur depuis la base par ID
    private function loadUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            $this->id = $userData['id_utilisateur'];
            $this->email = $userData['email_utilisateur'];
            $this->pseudo = $userData['pseudo_utilisateur'];
            $this->role_id = $userData['id_role'];
            $this->password = $userData['mot_de_passe_utilisateur'];
        }
    }

    // Vérifie si un email existe déjà
    public function emailExists($email) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM utilisateurs WHERE email_utilisateur = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Enregistre un nouvel utilisateur dans la base de données
    public function registerUser($email, $password, $pseudo, $role_id) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Hachage sécurisé du mot de passe
        $stmt = $this->db->prepare("
            INSERT INTO utilisateurs (email_utilisateur, mot_de_passe_utilisateur, pseudo_utilisateur, id_role)
            VALUES (:email, :password, :pseudo, :role_id)
        ");
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $hashedPassword);
        $stmt->bindParam(":pseudo", $pseudo);
        $stmt->bindParam(":role_id", $role_id);

        return $stmt->execute(); // Retourne true si l'insertion réussit
    }

    // Récupère un utilisateur par son email
    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM utilisateurs WHERE email_utilisateur = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne les données utilisateur
    }

    // Vérifie le mot de passe saisi
    public function verifyPassword($inputPassword, $hashedPassword) {
        return password_verify($inputPassword, $hashedPassword);
    }

    // Getters pour accéder aux propriétés privées
    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPseudo() {
        return $this->pseudo;
    }

    public function getRoleId() {
        return $this->role_id;
    }
}
?>

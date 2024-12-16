<?php
// Déclaration de la classe Utilisateur
class Utilisateur {
    // Déclaration des attributs privés de la classe
    private $id;     // Identifiant unique de l'utilisateur
    private $nom;    // Nom de l'utilisateur
    private $prenom; // Prénom de l'utilisateur

    // Méthode pour accéder à l'attribut 'id' (accesseur/getter)
    public function getId() {
        return $this->id; // Retourne la valeur de l'attribut 'id'
    }

    // Méthode pour modifier la valeur de l'attribut 'id' (mutateur/setter)
    public function setId($id) {
        $this->id = $id; // Définit une nouvelle valeur pour l'attribut 'id'
    }

    // Méthode pour accéder à l'attribut 'nom' (accesseur/getter)
    public function getNom() {
        return $this->nom; // Retourne la valeur de l'attribut 'nom'
    }

    // Méthode pour modifier la valeur de l'attribut 'nom' (mutateur/setter)
    public function setNom($nom) {
        $this->nom = $nom; // Définit une nouvelle valeur pour l'attribut 'nom'
    }

    // Méthode pour accéder à l'attribut 'prenom' (accesseur/getter)
    public function getPrenom() {
        return $this->prenom; // Retourne la valeur de l'attribut 'prenom'
    }

    // Méthode pour modifier la valeur de l'attribut 'prenom' (mutateur/setter)
    public function setPrenom($prenom) {
        $this->prenom = $prenom; // Définit une nouvelle valeur pour l'attribut 'prenom'
    }
}
?>

<?php
class Utilisateur {
    private $id;
    private $nom;
    private $prenom;

    // Constructeur pour initialiser les attributs
    public function __construct($id, $nom, $prenom) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    // Accesseur et mutateur pour id
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    // Accesseur et mutateur pour nom
    public function getNom() {
        return $this->nom;
    }
    public function setNom($nom) {
        $this->nom = $nom;
    }

    // Accesseur et mutateur pour prenom
    public function getPrenom() {
        return $this->prenom;
    }
    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }
}
?>

<?php
class Animal {
    private $id;
    private $libelle;
    private $predateur;

    // Constructeur pour initialiser les attributs
    public function __construct($id, $libelle, $predateur) {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->predateur = $predateur;
    }

    // Accesseur et mutateur pour id
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    // Accesseur et mutateur pour libelle
    public function getLibelle() {
        return $this->libelle;
    }
    public function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    // Accesseur et mutateur pour predateur
    public function isPredateur() {
        return $this->predateur;
    }
    public function setPredateur($predateur) {
        $this->predateur = $predateur;
    }
}
?>

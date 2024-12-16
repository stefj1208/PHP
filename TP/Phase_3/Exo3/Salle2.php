<?php
class Salle {
    private $id;
    private $libelle;
    private $capacite;
    private $occupe;

    // Constructeur pour initialiser les attributs
    public function __construct($id, $libelle, $capacite, $occupe) {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->capacite = $capacite;
        $this->occupe = $occupe;
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

    // Accesseur et mutateur pour capacite
    public function getCapacite() {
        return $this->capacite;
    }
    public function setCapacite($capacite) {
        $this->capacite = $capacite;
    }

    // Accesseur et mutateur pour occupe
    public function isOccupe() {
        return $this->occupe;
    }
    public function setOccupe($occupe) {
        $this->occupe = $occupe;
    }
}
?>

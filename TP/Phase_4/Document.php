<?php
class Document {
    // Attributs communs à tous les documents
    private $auteur;
    private $titre;
    private $reference;

    // Constructeur pour initialiser les attributs
    public function __construct($auteur, $titre, $reference) {
        $this->auteur = $auteur;
        $this->titre = $titre;
        $this->reference = $reference;
    }

    // Accesseurs (getters) pour les attributs
    public function getAuteur() {
        return $this->auteur;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getReference() {
        return $this->reference;
    }

    // Mutateurs (setters) pour les attributs
    public function setAuteur($auteur) {
        $this->auteur = $auteur;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function setReference($reference) {
        $this->reference = $reference;
    }
}
?>

<?php
class Animal {
    private $id;         // Identifiant de l'animal
    private $libelle;    // Libellé ou nom de l'animal
    private $predateur;  // Indique si l'animal est un prédateur

    // Accesseur pour l'attribut 'id'
    public function getId() {
        return $this->id;
    }

    // Mutateur pour l'attribut 'id'
    public function setId($id) {
        $this->id = $id;
    }

    // Accesseur pour l'attribut 'libelle'
    public function getLibelle() {
        return $this->libelle;
    }

    // Mutateur pour l'attribut 'libelle'
    public function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    // Accesseur pour l'attribut 'predateur'
    public function isPredateur() {
        return $this->predateur;
    }

    // Mutateur pour l'attribut 'predateur'
    public function setPredateur($predateur) {
        $this->predateur = $predateur;
    }
}
?>

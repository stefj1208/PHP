<?php
require_once 'Document.php';

class Dvd extends Document {
    private $duree;
    private $bonus;

    public function __construct($auteur, $titre, $reference, $duree, $bonus) {
        // Appel du constructeur parent
        parent::__construct($auteur, $titre, $reference);
        $this->duree = $duree;
        $this->bonus = $bonus;
    }

    // Accesseurs
    public function getDuree() {
        return $this->duree;
    }


    public function getBonus() {
        return $this->bonus;
    }

    // Mutateurs
    public function setDuree($duree) {
        $this->duree = $duree;
    }

    public function setBonus($bonus) {
        $this->bonus = $bonus;
    }
}
?>

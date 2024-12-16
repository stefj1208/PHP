<?php
require_once 'Document.php';

class Cd extends Document {
    private $duree;
    private $nbPlages;

    public function __construct($auteur, $titre, $reference, $duree, $nbPlages) {
        // Appel du constructeur parent
        parent::__construct($auteur, $titre, $reference);
        $this->duree = $duree;
        $this->nbPlages = $nbPlages;
    }

    // Accesseurs
    public function getDuree() {
        return $this->duree;
    }

    public function getNbPlages() {
        return $this->nbPlages;
    }

    // Mutateurs
    public function setDuree($duree) {
        $this->duree = $duree;
    }

    public function setNbPlages($nbPlages) {
        $this->nbPlages = $nbPlages;
    }
}
?>

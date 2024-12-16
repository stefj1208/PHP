<?php
require_once 'Document.php';

class Livre extends Document {
    private $nbPages;

    public function __construct($auteur, $titre, $reference, $nbPages) {
        // Appel du constructeur parent
        parent::__construct($auteur, $titre, $reference);
        $this->nbPages = $nbPages;
    }

    // Accesseurs
    public function getNbPages() {
        return $this->nbPages;
    }

    // Mutateurs
    public function setNbPages($nbPages) {
        $this->nbPages = $nbPages;
    }
}
?>

<?php
class Maison {
    public $nom;
    public $longueur;
    public $largeur;
    public $nbEtages;

    // Méthode pour calculer et afficher la surface avec nbEtages
    public function surface() {
        $superficie = $this->longueur * $this->largeur * $this->nbEtages;
        echo "<p>La surface de {$this->nom} est égale à: {$superficie} m²</p>";
    }
}
?>

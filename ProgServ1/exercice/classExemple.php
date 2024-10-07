<?php
class Point2Dim {
private $x; // <- propriété d'instance
private $y; // <- propriété d'instance
public function __construct(float $x, float $y) {
$this->x = $x;
$this->y = $y;
}
public function get_x() : float {
return $this->x;
}

}



//class unClasse extends uneAutreClasse {
//...
//public function __construct(...) {
//parent::__construct(...); // <- création d'un objet de la classe
//mère (uneAutreClasse)
//...
//}
//...
//}


//<?php
//class Voiture {
//    // Propriétés
//    public $marque;
//    public $couleur;
//
//    // Méthode constructeur
//    public function __construct($marque, $couleur) {
//        $this->marque = $marque;
//        $this->couleur = $couleur;
//    }
//
//    // Méthode
//    public function afficherDetails() {
//        echo "Marque : " . $this->marque . "<br>";
//        echo "Couleur : " . $this->couleur . "<br>";
//    }
//}
//?>


//<?php
//// Inclure le fichier contenant la définition de la classe si nécessaire
//// include 'Voiture.php';
//
//// Créer une instance de la classe Voiture
//$maVoiture = new Voiture("Toyota", "Rouge");
//
//// Appeler une méthode de l'objet
//$maVoiture->afficherDetails();
//?>


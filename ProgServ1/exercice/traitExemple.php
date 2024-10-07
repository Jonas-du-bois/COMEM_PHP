<?php
trait Compteur {
public function incremente() {
static $cmpt = 0;
$cmpt += $cmpt;
echo "$cmpt";
}
}
class Classe1 {
use Compteur;

}
class AutreClasse {
use Compteur;

}


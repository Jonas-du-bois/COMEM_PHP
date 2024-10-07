<?php

class Maillot {

    private $NOM;
    private $NUMERO;
    private $COULEUR;
    private $COULEUR_NUMERO;

    public function __construct(string $numero, $nom, string $couleur = "Rouge", string $couleur_numero = "Blanc",) {
        if ($couleur !== $couleur_numero) {
            $this->NOM = $nom;
            $this->NUMERO = $numero;
            $this->COULEUR = $couleur;
            $this->COULEUR_NUMERO = $couleur_numero;
        } else {

            echo "Vous ne pouvez pas mettre deux fois la même couleur, pour le joueur $nom.";
        }
    }

    public function getNOM() {
        return $this->NOM;
    }

    public function getNUMERO() {
        return $this->NUMERO;
    }

    public function getCOULEUR() {
        return $this->COULEUR;
    }

    public function getCOULEUR_NUMERO() {
        return $this->COULEUR_NUMERO;
    }
}

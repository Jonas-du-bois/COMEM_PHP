<?php

//phpinfo();
require_once('./config/autoload.php');

use ch\comem\DbManagerCRUD;
use ch\comem\Personne;

$db = new DbManagerCRUD();
if ($db->creeTablePersonnes()) {
    echo "Création de la table 'personnes' réussie :-) <br>";
}
$p = new Personne("Joe","Bar","joe.bar@motard.ch","079'944'63'40");
$id = $db->ajoutePersonne($p);
if ($id>0) {
    echo "Joe Bar a bien été ajouté à la base de données <br>";
}
$p->changeNom("Sephine");
if ($db->modifiePersonne($id, $p)) {
    echo "Le nom Bar a été remplacé par Sephine <br>";
}

$tabPersonnes = $db->rendPersonnes("Sephine");
if (!empty($tabPersonnes)) {
    echo "Au moins une personne a été récupérée de la base de données <br>";
    //var_dump($tabPersonnes);
}

if ($db->supprimePersonne(1)) {
    echo "La personne ayant l'id 1 a été supprimée de la base de données";
}

?>
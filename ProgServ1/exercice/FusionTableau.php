<?php
// Tableaux initiaux
$tab1 = ['2' => 'Jules', '10' => 'Max', '4' => 'Zoé', '5' => 'Alphonse'];
$tab2 = ['5' => 'Fritz', '1' => 'Louis', '8' => 'Chris', '7' => 'Auguste'];

// Initialisation du tableau fusionné
$tabFusion = [];

// Fusion des tableaux en regroupant les valeurs des clés identiques
foreach ($tab1 as $numero => $nom) {
    if (isset($tab2[$numero])) {
        // Clé présente dans les deux tableaux, regrouper les valeurs dans un tableau
        $tabFusion[$numero] = [$nom, $tab2[$numero]];
    } else {
        // Clé uniquement dans $tab1
        $tabFusion[$numero] = $nom;
    }
}

// Ajouter les valeurs de $tab2 qui ne sont pas déjà dans $tabFusion
foreach ($tab2 as $numero => $nom) {
    if (!isset($tabFusion[$numero])) {
        // Clé uniquement dans $tab2
        $tabFusion[$numero] = $nom;
    }
}

// Affichage du résultat dans un tableau HTML
echo "<h2>Tableau fusionné avec gestion des clés identiques :</h2>";
echo "<table border='1'>
        <tr>
            <th>Clé</th>
            <th>Valeur</th>
        </tr>";

foreach ($tabFusion as $key => $value) {
    echo "<tr>";
    echo "<td>" . $key . "</td>";
    echo "<td>";
    if (is_array($value)) {
        echo implode(', ', $value);
    } else {
        echo $value;
    }
    echo "</td>";
    echo "</tr>";
}

echo "</table>";
?>

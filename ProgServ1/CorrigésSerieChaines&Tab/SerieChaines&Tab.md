# Série 5

## Exercice 1 :

Soit une chaine contenant un nombre variable de prénoms séparés par des espaces.
$chaine1 = "Jules, Max, Zoé, Alphonse";
Ecrire un code qui affiche les noms de la manière suivante :
Jules (si la chaîne ne contient qu'un prénom)
Jules et Max (si la chaîne contient deux prénoms)
Jules, Max et Zoé (si la chaîne contient trois prénoms)
Jules, Max, Zoé et Alphonse (si plus de x prénoms)



## Exercice 2 :

Soit les deux tableaux suivants :
`$tab1 = ['2' => 'Jules', '10' => 'Max', '4' => 'Zoé', '5' => 'Alphonse'];`
`$tab2 = ['5' => 'Fritz', '1' => 'Louis', '8' => 'Chris', '7' => 'Auguste'];`

Ecrire un code qui fusionne deux tableaux.
Si des clés sont identiques, on associera leur valeurs dans un sous-tableau.

Exemple :
`$tabFusion` devra contenir
`['2' => 'Jules', '10' => 'Max', '4' => 'Zoé', '5' => ['Alphonse', 'Fritz'], '1' => 'Louis', '8' => 'Chris', '7' => 'Auguste']`



## Exercice 3 :

Soit deux tableaux :
`$tab1 = [1,2,3,4,5];`
`$tab2 = [5,3,1,2,4];`
Ecrire un code qui permette de déterminer si deux tableaux contiennent les mêmes valeurs



## Exercice 4 :

Idem 3 mais pour deux tableaux associatifs
`$tab1 = ['2' => 'Jules', '10' => 'Max', '4' => 'Zoé', '5' => 'Alphonse'];`
`$tab2 = ['10' => 'Max', '2' => 'Jules', '5' => 'Alphonse', '4' => 'Zoé'];`



## Exercice 5 :

Idem 4 mais ne tenir compte que des valeurs (pas les clés)
`$tab1 = ['2' => 'Jules', '10' => 'Max', '4' => 'Zoé', '5' => 'Alphonse'];`
`$tab2 = ['22' => 'Alphonse', '11' => 'Jules', '44' => 'Max', '55' => 'Zoé'];`



## Exercice 6 :

Soit deux tableaux :
`$tab1 = [1,2,3,4,5,6];`
`$tab2 = [2,8,1,4,5];`
Ecrire un code qui détermine quels éléments ne se trouvent pas dans les deux tableaux
Ex : 3,6,8



## Exercice 7 :

Soit deux tableaux :
`$tab1 = [1,2,3,4,5,6];`
`$tab2 = [2,8,1,4,5];`
Ecrire un code qui détermine quels éléments se trouvent dans les deux tableaux
Ex : 1,2,4,5



## Exercice 8 :

Soit le texte suivant :

```php
$texte = "Malgré le froid, la Fourmi se chauffait au soleil.
Tandis que la Fourmi mangeait, la Sauterelle arriva, son estomac criant famine.
S'adressant à la Fourmi, elle quémanda une ou deux graines.
« Eh bien, demanda la Fourmi, que faisiez-vous durant l'été ? »
« Je sautais de feuille en feuille, je les mordillais, je chantais », répliqua la Sauterelle.";
```

Ecrire une fonction permettant de changer toutes les occurrences du mot Fourmi par un autre nom d'animal ou un prénom.



## Exercice 9 :

Ecrire un code qui affiche le contenu d'un tableau associatif sur une ligne, comme à sa déclaration.

Exemple :

```php
$tab1 = ['2' => 'Jules', '10' => 'Max', '4' => ['Zoé','Lucie'], '5' => 'Alphonse'];
afficheTab($tab1); // Doit afficher ['2' => 'Jules', '10' => 'Max', '4' => ['Zoé','Lucie'], '5' => 'Alphonse']
```


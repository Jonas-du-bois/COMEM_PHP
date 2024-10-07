<?php
echo round(3.4),"<BR>";         // 3
echo round(3.5),"<BR>";         // 4
echo round(3.6),"<BR>";         // 4

echo round(123.9558, 3),"<BR>";  // 123.956
echo round(123.9558, 2),"<BR>";  // 123.96
echo round(123.9558, 1),"<BR>";  // 124
echo round(123.9558, 0),"<BR>";  // 124
echo round(123.9558, -1),"<BR>";  // 120
echo round(123.9558, -2),"<BR>";  // 100
echo round(123.9558, -3),"<BR>";  // 0

$precision1 = 0.05; // A 5 centimes près
$montant1 = 123.9558;
//Vive la formule magique !!!
$arrondi1 = round($montant1/$precision1)*$precision1;
echo $arrondi1,"<BR>";

$precision2 = 0.2; // A 20 centimes près
$montant2 = 123.368;
//Vive la formule magique !!!
$arrondi2 = round($montant2/$precision2)*$precision2;
echo $arrondi2,"<BR>";

$precision3 = 10; // A 10 centimes près
$montant3 = 123.368;
//Vive la formule magique !!!
$arrondi3 = round($montant3/$precision3)*$precision3;
echo $arrondi3,"<BR>";

$precision = 100; // A 100 francs près
$montant = -3560;
//Vive la formule magique !!!
$arrondi = round($montant/$precision)*$precision;
echo $arrondi," av. J.-C.","<BR>";
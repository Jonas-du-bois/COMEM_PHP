<?php

spl_autoload_register(function ($Maillot) {
    include $Maillot . '.php';
});

$maillot1 = new Maillot(9, "Shaqiri");
echo $maillot1->getNOM();
echo "<br>";
echo $maillot1->getNUMERO();
echo "<br>";
echo $maillot1->getCOULEUR();
echo "<br>";
echo $maillot1->getCOULEUR_NUMERO();
echo "<br>";
$maillot2 = new Maillot(19, "Ndoye", "Jaune", "Jaune");
echo $maillot2->getNOM();
echo "<br>";
echo $maillot2->getNUMERO();
echo "<br>";
echo $maillot2->getCOULEUR();
echo "<br>";
echo $maillot2->getCOULEUR_NUMERO();
echo "<br>";

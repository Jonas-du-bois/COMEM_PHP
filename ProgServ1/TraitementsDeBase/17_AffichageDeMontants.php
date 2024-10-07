<?php
$montant = 1234.5544123;

// Notation (par défaut)
$nbDecimales = 2;
$montant_format_par_defaut = number_format($montant,$nbDecimales);
echo $montant_format_par_defaut,"$","<BR>";

// Notation "suisse"
$separateurEntierFractionnaire = ',';
$separateurMilliers = "'";
$montant_format_ch = number_format($montant, 2, $separateurEntierFractionnaire, $separateurMilliers);
echo $montant_format_ch,"CHF","<BR>";
<?php

// echo $_POST['champTexte'],'<br><br>';
// La fonction nl2br permet de convertir les fin de lignes en passage à la ligne
$tmp = nl2br($_POST['champTexte']); // nl => pour new_line, 2 => pour to, br => pour '<br>'
echo $tmp, '<br>';

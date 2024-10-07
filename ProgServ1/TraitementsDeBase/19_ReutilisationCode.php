<?php
require_once '19_ReutilisationCodeUtils.php'; // indique que le fichier spécifié est nécessaire
require_once '19_ReutilisationCodeUtilsBis.php'; // indique que le fichier spécifié est nécessaire
afficheInfos();
afficheInfosBis();

//////////////////////////////////////////////////////////////////////
// Différences entre include, include_once, require et require_once //
//////////////////////////////////////////////////////////////////////
// La différence entre les instructions include et require va se situer 
// dans la réponse du PHP dans le cas ou le fichier ne peut pas être inclus 
// pour une quelconque raison (fichier introuvable, indisponible, etc.)
// Si l’inclusion a été tentée avec include, le PHP renverra un simple avertissement 
// et le reste du script s’exécutera quand même.
// Si la même chose se produit avec require, une erreur fatale sera retournée par PHP
// et l’exécution du script s’arrêtera immédiatement.
// L’instruction require est donc plus « stricte » que include.
// 
// La différence entre les instructions :
// - include et require
// et les variantes :
// - include_once et require_once 
// est qu’on va pouvoir inclure plusieurs fois un même fichier avec include et require 
// tandis qu’en utilisant include_once et require_once cela ne sera pas possible
// Un même fichier ne pourra être inclus qu’une seule fois dans un autre fichier.

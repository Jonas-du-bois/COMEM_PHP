<?php

//
// EXEMPLE 1
//
//Une fonction peut avoir un paramètre optionnel.
//Mais il est alors obligatoire de fournir une valeur par défaut
function fonctionAvecParamOptionnel($paramOptionnel = "Bonjour") {
    echo "Je suis le paramètre optionnel \$paramOptionnel. Ma valeur est : $paramOptionnel", "<BR>";
}

fonctionAvecParamOptionnel();
fonctionAvecParamOptionnel("Salut");
echo "<BR>";


//
// EXEMPLE 2
//
//Une fonction peut avoir des paramètres "conventionnels" et des paramètres optionnels.
//Mais il est alors obligatoire de mettre les paramètres optionnels et leurs valeurs à la fin.
function fonctionAvecParamsEtParamsOptionnels($param1, $param2, $paramOptionnel1 = "Bonjour", $paramOptionnel2 = "la classe") {
    echo "Je suis le paramètre \$param1. Ma valeur est : $param1", "<BR>";
    echo "Je suis le paramètre \$param2. Ma valeur est : $param2", "<BR>";
    echo "Je suis le paramètre \$paramOptionnel1. Ma valeur est : $paramOptionnel1", "<BR>";
    echo "Je suis le paramètre \$paramOptionnel2. Ma valeur est : $paramOptionnel2", "<BR>";
}

fonctionAvecParamsEtParamsOptionnels("Yverdon,","Le 25.03.2022");
fonctionAvecParamsEtParamsOptionnels("Yverdon,","Le 25.03.2022","Salut");
fonctionAvecParamsEtParamsOptionnels("Yverdon,","Le 25.03.2022","Salut","les étudiants");
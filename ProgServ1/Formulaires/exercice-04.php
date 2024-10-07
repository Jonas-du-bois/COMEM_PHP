<?php

if (filter_has_var(INPUT_POST, 'submit')) {
    $option = filter_input(INPUT_POST, 'option', FILTER_VALIDATE_INT);
    if ($option === 1) {       
        echo rendFormulaireNo(1);
    } elseif ($option === 2) {
        echo rendFormulaireNo(2);
    } else {
        echo "cas pas pris en charge ;-)";
    }
} elseif (filter_has_var(INPUT_POST, 'submit1')) {
    $nomClasse = filter_input(INPUT_POST, 'nomClasse', FILTER_UNSAFE_RAW);
    afficheClasse($nomClasse);
} elseif (filter_has_var(INPUT_POST, 'submit2')) {
    if (filter_has_var(INPUT_POST, 'motDePasse')) {
        $motDePasse = filter_input(INPUT_POST, 'motDePasse');
        // d'abord encoder le mot de passe avec password_hash("monsupermotdepasse", PASSWORD_DEFAULT);
        // récupérer le hash et le mettre à droite de password_verify(...;-)
        if (password_verify($motDePasse, '$2y$10$7ycpgEnblWywVLVwYzVv0O0HhDmdML9Bow8NtivGg0g1b03daO93O')) {
            echo rendFormulaireNo(3);
        } else {
            echo "mauvais mot de passe";
        }
    } else {
        echo "Aucun password n'a été entré";
    }
} elseif (filter_has_var(INPUT_POST, 'submit3')) {
    if (!$_FILES['fichier']['error']) {
        if (move_uploaded_file($_FILES['fichier']['tmp_name'], "ListeClasse.txt")) {
            echo "Le fichier a été correctement uploadé sur le serveur", '<br>';
        } else {
            echo "Problème lors du déplacement du fichier";
        }
    } else {
        echo "erreur de transfert du fichier";
    }
} else {
    echo rendFormulaireNo(0);
}

function afficheClasse($nomClasse) {
    if ($fichier = fopen("ListeClasse.txt", 'r')) { // ouverture en lecture seule
        $on = false;
        while (!feof($fichier)) {
            $ligne = fgets($fichier);
            if (strpos($ligne, ' ' . $nomClasse) !== false) {
                $on = true;
            } else {
                if (strpos($ligne, "Classe") !== false) {
                    $on = false;
                    if ($on) {
                        break;
                    }
                }
                if ($on) {
                    echo $ligne, '<br>';
                }
            }
        }
        fclose($fichier);
    }
}

function rendFormulaireNo($no) {
    $html = '';
    if ($no === 0) {
        $html .= "
        <html>
            <head>
                <meta charset='UTF-8'>
                <title>Choix d'une option</title>
            </head>
            <body>
                <form action='' method='post'>
                    <div>
                        <input type='radio' id='bouton1' name='option' value='1'>
                        <label for='bouton1'>Affichage des élèves d'une classe</label>
                    </div>
                    <div>
                        <input type='radio' id='bouton2' name='option' value='2'>
                        <label for='bouton2'>Upload d'une liste de classe</label>
                    </div> 
                    <div>
                        <input type='submit' name='submit' value='envoyer'>
                    </div>
                </form>
            </body>
        </html>";
    } elseif ($no === 1) {
        $html .= "
            <html>
                <head>
                    <meta charset='UTF-8'>
                    <title>Choix d'une classe</title>
                </head>
                <body>
                    <form action='' method='post'>
                        <div>
                            Entre le nom d'une classe :
                            <input type='text' name='nomClasse' value=''>
                        </div>
                        <div>
                            <input type='submit' name='submit1' value='envoyer'>
                        </div>
                    </form>
                </body>
            </html>";
    } elseif ($no === 2) {
        $html .= "
            <html>
                <head>
                    <meta charset='utf-8' />
                    <title>Saisie mot de passe</title>
                </head>
                <body>
                    <p>Veuillez entrer le mot de passe :</p>
                    <form action='' method='post'>
                    <p>
                        <input type='password' name='motDePasse' />
                        <input type='submit' name='submit2' value='Envoyer' />
                    </p>
                    </form>
                </body>
            </html>";
    } elseif ($no === 3) {
        $html .= "
            <html>
                <head>
                    <meta charset='utf-8' />
                    <title>Upload de fichier</title>
                </head>
                <body>
                    <p>Veuillez séléctionner le fichier à uploader :</p>
                    <form action='' method='post' enctype='multipart/form-data'>
                        <div>
                            <input type='file' name='fichier' accept='.txt,.csv'>
                        </div>
                        <div>
                            <input type='submit' name='submit3' value='envoyer'>
                        </div>
                    </form>
                </body>
            </html>";
    }
    return $html;
}
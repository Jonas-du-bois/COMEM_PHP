<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Envoi cases à cocher </title>
    </head>
    <body>
        <form action='03_Reception_Cases_A_Cocher.php' method='post'>
            <div>
                <!-- Remarquez le champ "id" pour lier la case à cocher avec le label -->
                <input type="checkbox" id="checkboxSouscription" name="souscrire" value="oui">
                <label for="checkboxSouscription">Souhaitez-vous vous abonner à la newsletter ?</label>
            </div>
            <div>
                <!-- Autre manière de lier le label à la checkbox -->
                <label><input type="checkbox" name="souscrire2" value="oui2"/>Souhaitez-vous(vraiment) vous abonner à la newsletter ?</label>
            </div>    
            <div>
                <input type="submit" name="submit" value="envoyer">
            </div>
        </form>
    </body>
</html>
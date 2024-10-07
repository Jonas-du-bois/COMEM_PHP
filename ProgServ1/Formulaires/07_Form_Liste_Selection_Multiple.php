<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Liste séléction multiple</title>
    </head>
    <body>
        <form action='07_Reception_Liste_Selection_Multiple.php' method='post'>
            <div>
                Cliquez sur un language pour le séléctionner (puis CTRL + clic pour les autres)
            </div>
            <div>
                <select name='id_languages[]' size='6' multiple> 
                    <option value='Flowgorithm'>Flowgorithm</option>
                    <option value='Java'>Java</option>
                    <option value='PHP'>PHP</option>
                    <option value='Javascript'>Javascript</option>
                    <option value='C#'>C#</option>
                    <option value='Python'>Python</option>
                </select>
            </div>
            <div>
                <input type='submit' name='submit' value='envoyer'>
            </div>
        </form>
    </body>
</html>
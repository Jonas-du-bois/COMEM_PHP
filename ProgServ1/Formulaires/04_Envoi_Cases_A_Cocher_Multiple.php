<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Envoi cases à cocher multiples</title>
    </head>
    <body>
        <form action='04_Reception_Cases_A_Cocher_Multiple.php' method='post'>
            <div>
                Language(s) maîtrisé(s) : 
            </div>
            <div>
                <input type="checkbox" id="checkboxJava" name="languages[]" value='java'>
                <label for="checkboxJava">Java</label>
            </div>
            <div>
                <input type="checkbox" id="checkboxPhp" name="languages[]" value='php' checked>
                <label for="checkboxPhp">PHP</label>
            </div>
            <div>
                <input type="checkbox" id="checkboxCsharp" name="languages[]" value='c#'>
                <label for="checkboxCsharp">C#</label>
            </div>
            <div>
                <input type="submit" name="submit" value="envoyer">
            </div>
        </form>
    </body>
</html>
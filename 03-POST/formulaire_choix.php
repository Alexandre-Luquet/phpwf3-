<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire</title>
</head>
<body>
    
    <h1>Formulaire</h1>

    <?php

    if ( !empty($_POST) ){ //* le formulaire est posté
        if( !empty($_POST['prenom']) ) {
            $f = fopen('infos.txt', 'a');
            fwrite($f,$_POST['prenom'] 
            . ' - ' . $_POST['pays'] . ' - ' . $_POST['civilite'] . "\n");
            fclose($f);
        }
            else{
                echo "Merci de renseigner votre prénom<br>";
            }
    }

    ?>

<form method="POST" action="">
    <fieldset>
        <legend>Message :</legend>
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?= $_POST['prenom'] ?? '' ?>">
        <br>
        <label for="pays">Pays</label>
        <select name="pays">
            <option value="fr" 
            <?= ( isset($_POST['pays']) && $_POST['pays'] =='fr') ? 'selected' : '' ?>>France</option>
            <option value="it" 
            <?= ( isset($_POST['pays']) && $_POST['pays'] =='it') ? 'selected' : '' ?>>Italie</option>
            <option value="pt"
            <?= ( isset($_POST['pays']) && $_POST['pays'] =='pt') ? 'selected' : '' ?>>Portugal</option>
        </select>
        <br>

        <input type="radio" name="civilite" value="m"
        <?= ( (isset($_POST['civilite']) && $_POST['civilite'] == 'm') || !isset($_POST['civilite'])) ? 'checked' : '' ?>> Homme
        <input type="radio" name="civilite" value="f"
        <?= ( isset($_POST['civilite']) && $_POST['civilite'] == 'f') ? 'checked' : '' ?>> Femme
        

        
        <input type="submit" value="Envoyer">
    </fieldset>
</form>




</body>
</html>
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

    if( !empty($_POST) ){ //* je teste que j'ai cliqué sur envoyer !notEmpty
        var_dump($_POST);
        /*  $_POST est une superglobale sous forme de tableau
            Elle utilise les "name des éléments de formulaire comme index
            et en valeur les données saisies ou sélectionnées
        */
    }


    ?>

    <form method="POST" action="">
        <fieldset>
            <legend>message :</legend>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?= $_POST['prenom'] ?? '' ?>">
            <br>
            <label for="message">message :</label>
            <textarea name="message" id="message" cols="20" rows="4"><?= $_POST['message'] ?? '' ?></textarea>
            <br>
            <input type="submit" value="Envoyer">
        </fieldset>
    </form>




</body>
</html>
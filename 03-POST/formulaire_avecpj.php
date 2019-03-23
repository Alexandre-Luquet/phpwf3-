<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire PJ php</title>
</head>
<body>
    
    <h1>Formulaire PJ php</h1>

    <?php

    if( !empty($_POST) ){ //* je teste que j'ai cliqué sur envoyer !notEmpty
        var_dump($_POST);
        /*  $_POST est une superglobale sous forme de tableau
            Elle utilise les "name des éléments de formulaire comme index
            et en valeur les données saisies ou sélectionnées
        */
        var_dump($_FILES);
        foreach( $_FILES as $index => $valeur ){
            if ( !empty($_FILES[$index]['name']) ) {
                echo "Je traite le fichier " . $_FILES[$index]['name'] . '<br>';
                $chemin = $_SERVER['DOCUMENT_ROOT'] . '/PHP/03-POST/pj/';
                echo $chemin;
                //*echo $chemin;
                move_uploaded_file($_FILES[$index]['tmp_name'],$chemin . $_FILES[$index]['name'] );
            }
        }
    }
    /*
    enctype="multipart/form-data" est nécessaire pour alimenter 
    $_FILES $_FILES est une superglobale qui récupére
    les infos des éléments de formulaire de type file
    */


    ?>

    <form method="POST" action="" enctype="multipart/form-data">
        <fieldset>
            <legend>message :</legend>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?= $_POST['prenom'] ?? '' ?>">
            <br>
            <label for="message">message :</label>
            <textarea name="message" id="message" cols="20" rows="4"><?= $_POST['message'] ?? '' ?></textarea>
            <br>
            <label for="fichier">Photo :</label>
            <input type="file" name="fichier" id="fichier">
            <br>
            <label for="cv">CV :</label>
            <input type="file" name="cv" id="cv">
            <br>
            <input type="submit" value="Envoyer">
        </fieldset>
    </form>




</body>
</html>
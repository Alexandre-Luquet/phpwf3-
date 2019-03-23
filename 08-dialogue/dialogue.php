<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dialogue</title>
</head>
<body>
<?php
    // 1. connexion
    $pdo = new PDO(
        'mysql:host=localhost;dbname=dialogue',
        'root',
        '',
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
            PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8',
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        )
    );
    // 2. insertion des messages en base
    if(!empty($_POST)){
        
        if( empty($_POST['pseudo']) || empty($_POST['message']) )
        {
            echo "Merci de remplir tous les champs !<br>";
        }
        else
        {

            foreach($_POST as $index => $valeur){
                // $_POST[$index] = htmlspecialchars($valeur);
                $_POST[$index] = strip_tags($valeur,'<p>');
            }

            /*
            $req = "INSERT INTO commentaires 
            VALUES (NULL,'$_POST[pseudo]','$_POST[message]',NOW())";
            echo $req . '<hr>';
            $pdo->query($req);*/
            $req = "INSERT INTO commentaires VALUES (NULL,:pseudo,:message,NOW())";
            $result = $pdo->prepare($req);
            $result->execute(
                array(
                    'pseudo'  => $_POST['pseudo'],
                    'message' => $_POST['message']
                ));
        }

    }
    // 3. Affichage des messages
    $result= $pdo->query("SELECT * FROM commentaires ORDER BY date_message DESC");
    while( $commentaire = $result->fetch() ){
        echo $commentaire['pseudo'] . ' a écrit le '.$commentaire['date_message'].'<br>'.$commentaire['message'].'<hr>';
    }
?>
<form method="post" action="">
    <label for="pseudo">Pseudo</label>
    <input type="text" id="pseudo" name="pseudo">
    <label for="message">Message</label>
    <textarea id="message" name="message" cols="70" rows="5"></textarea>
    <input type="submit" value="Enregistrer">
</form>
</body>
</html>
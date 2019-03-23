<?php

require_once('inc/init.php');
$title = 'Recherche';
$resultats = '';

    if(!empty(trim($_POST['critere']))){
        $result = $pdo->prepare("SELECT * FROM livre
        WHERE titre LIKE CONCAT('%',:critere,'%') 
        OR
        auteur LIKE CONCAT('%',:critere,'%')");
        $result->execute(array(
            'critere' => $_POST['critere']
        ));
        if( $result->rowCount() > 0){
                $resultats .= '<h3>Il y a ' .$result->rowCount() . ' résultat(s)</h3>';
                while( $livre = $result->fetch() ){
                $resultats .= $livre['titre'] . ' de ' . $livre
                ['auteur'] . "<hr>";
            }
}
else
{
    $resultats = '<div class="alert alert-info">Aucun livre trouvé correspondant 
    à ' .$_POST['critere'] .'</div>';
}
    }

else
{
    header('location:' . URL);
    exit();
}
require_once('inc/header.php');
    echo $resultats;
require_once('inc/footer.php');

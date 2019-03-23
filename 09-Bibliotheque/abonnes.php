<?php

require_once('inc/init.php');
$title = "Abonnés";

// Gestion d'une insertion/modification d'un abonne (replace)
if ( !empty($_POST) ){ // formulaire envoyé

    //controler que les champs sont remplis
    if( empty($_POST['prenom']))
    {
        $_SESSION['message'] = 'Merci de saisir le pseudo de l\'abonné';
        $_SESSION['type'] = 'danger';
    }
    else{
        // Assainissement
        foreach($_POST as $key => $value){
            $_POST[$key] = trim(strip_tags($value));
        }
        $result = $pdo->prepare("REPLACE INTO abonne VALUES (:id_abonne,:prenom)");
        $result->execute(array(
            'id_abonne' => $_POST['id_abonne'],
            'prenom' => $_POST['prenom']
        ));

        $_SESSION['message'] = empty($_POST['id_abonne']) ? 'Nouvelle abonne inséré' : 'Abonne mis à jour';
        $_SESSION['type'] = 'success';
        header('location:' . URL . 'abonnes.php');
        exit();
    }
}

// Suppression d'un abonne
if( isset($_GET['action']) && $_GET['action'] == 'suppr' && isset($_GET['id_abonne'])){
    
    $result = $pdo->prepare("DELETE FROM abonne WHERE id_abonne=:id_abonne");
    $result->execute(array(
            'id_abonne' => $_GET['id_abonne']
    ));
    $_SESSION['message'] = 'Abonne supprimé';
    $_SESSION['type'] = 'success';

    header('location:' . URL . 'abonnes.php');
    exit();
}

require_once('inc/header.php');

// gestion du message d'alerte qui s'efface apres affichage
if( !empty($_SESSION['message']) ){
    ?>
    <div class="alert alert-<?= $_SESSION['type'] ?>"><?= $_SESSION['message'] ?></div>
    <?php
    unset($_SESSION['message']);
}

// Cas de modification d'un abonne existant
if ( isset($_GET['action']) && $_GET['action'] == 'modifier' && isset($_GET['prenom']) ){

    $result = $pdo->prepare("SELECT * FROM abonne WHERE prenom=:prenom");
    $result->execute(array(
        'prenom' => $_GET['prenom']
    ));
    if($result->rowCount() > 0 ){
        $abonne_courant = $result->fetch();
    }

}

// affichage
$result = $pdo->query("SELECT id_abonne,prenom AS prenom FROM abonne");
if( $result->rowCount() > 0 ){
?>
<table class="table table-bordered table-striped">
    <tr>
    <?php
        // Entetes
        for($i=0; $i<$result->columnCount();$i++){
            $infos_colonne = $result->getColumnMeta($i);
            ?>
            <th> <?= ucfirst($infos_colonne['name']) ?> </th>
            <?php
        }
    ?>
        <th colspan="2">Actions</th>
    </tr>
    <?php
        // Données
        while( $abonne = $result->fetch() )
            {
                ?>
                <tr>
                <?php
                    foreach($abonne as $value){
                        ?>
                        <td><?= $value ?></td>
                        <?php
                    }
                ?>
                <td><a href="?action=modifier&prenom=<?= $abonne['prenom'] ?>">Modifier</a></td>
                <td><a class="confsup2" href="?action=suppr&id_abonne=<?= $abonne['id_abonne'] ?>">Supprimer</a></td>
                </tr>
                <?php
            }
        ?>
</table>

<?php
}
else{
    ?>
    <div class="alert alert-warning">Pas encore d'abonné enregistrer'</div>
    <?php
}




// Formulaire de saisie d'un abonné
    ?>
    <form action="" method="post">
        <input type="hidden" name="id_abonne" 
        value="<?= $_POST['id_abonne'] ?? $abonne_courant['id_abonne'] ?? 0 ?>">

        <div class="form-row">
            <div class="form-group col-6">
                <label for="prenom">Pseudo</label>
                <input type="text" id="prenom" name="prenom" class="form-control"
                value="<?= $_POST['prenom'] ?? $abonne_courant['prenom'] ?? '' ?>">
        </div>
        </div>

        <input type="submit" value="Enregistrer" class="btn btn-primary pull-right">   
    </form>

    
    <?php

require_once('inc/footer.php');
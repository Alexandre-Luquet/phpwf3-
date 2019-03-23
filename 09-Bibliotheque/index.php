<?php

require_once('inc/init.php');
$title = "Livres";

// Gestion d'une insertion/modification d'un livre (replace)
if ( !empty($_POST) ){ // formulaire envoyé

    //controler que les champs sont remplis
    if( empty($_POST['auteur']) || empty($_POST['titre']) )
    {
        $_SESSION['message'] = 'Merci de remplir tous les champs';
        $_SESSION['type'] = 'danger';
    }
    else{

        // Assainissement
        foreach($_POST as $key => $value){
            $_POST[$key] = trim(strip_tags($value));
        }
        $result = $pdo->prepare("REPLACE INTO livre VALUES (:id_livre,:auteur,:titre) ");
        $result->execute(array(
            'id_livre' => $_POST['id_livre'],
            'auteur' => $_POST['auteur'],
            'titre' => $_POST['titre']
        ));
        $_SESSION['message'] = 'Livre supprimé';

        $_SESSION['message'] = empty($_POST['id_livre']) ? 'Nouveau livre inséré' : 'Livre mis à jour';
        $_SESSION['type'] = 'success';
        header('location:' . URL);
        exit();
    }
}

// Suppression d'un livre
if( isset($_GET['action']) && $_GET['action'] == 'suppr' && isset($_GET['id_livre'])){
    
    $result = $pdo->prepare("DELETE FROM livre WHERE id_livre=:id_livre");
    $result->execute(array(
            'id_livre' => $_GET['id_livre']
    ));
    $_SESSION['message'] = 'Livre supprimé';
    $_SESSION['type'] = 'success';

    header('location:' . URL);
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

// Cas de modification d'un livre existant
if ( isset($_GET['action']) && $_GET['action'] == 'modifier' && isset($_GET['id_livre']) ){

    $result = $pdo->prepare("SELECT * FROM livre WHERE id_livre=:id_livre");
    $result->execute(array(
        'id_livre' => $_GET['id_livre']
    ));
    if($result->rowCount() > 0 ){
        $livre_courant = $result->fetch();
    }

}





// Affichage des livres
$result = $pdo->query("SELECT id_livre AS livre, auteur AS escroc, titre AS title FROM livre");
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
        while( $book = $result->fetch() )
            {
                ?>
                <tr>
                <?php
                    foreach($book as $value){
                        ?>
                        <td><?= $value ?></td>
                        <?php
                    }
                ?>
                <td><a href="?action=modifier&id_livre=<?= $book['livre'] ?>">Modifier</a></td>
                <td><a class="confsup" href="?action=suppr&id_livre=<?= $book['livre'] ?>">Supprimer</a></td>
                </tr>
                <?php
            }
        ?>
</table>

<?php
}
else{
    ?>
    <div class="alert alert-warning">Pas encore de livres enregistrés</div>
    <?php
}




// Formulaire de saisie d'un livre
    ?>
    <form action="" method="post">
        <input type="hidden" name="id_livre" 
        value="<?= $_POST['id_livre'] ?? $livre_courant['id_livre'] ?? 0 ?>">

        <div class="form-row">
            <div class="form-group col-6">
                <label for="auteur">Auteur</label>
                <input type="text" id="auteur" name="auteur" class="form-control" 
                value="<?= $_POST['auteur'] ?? $livre_courant['auteur'] ?? '' ?>">
            </div>

            <div class="form-group col-6">
                <label for="titre">Titre</label>
                <input type="text" id="titre" name="titre" class="form-control" 
                value="<?= $_POST['titre'] ?? $livre_courant['titre'] ?? '' ?>">
            </div>
        </div>
        <input type="submit" value="Enregistrer" class="btn btn-primary">   
    </form>

    
    <?php


















require_once('inc/footer.php');
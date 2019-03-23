<?php

require_once('inc/init.php');
$title = "Emprunts";


/*
A prévoir : 
        1 Voir les livres dispos

        2 Emprunter un livre dispo
        (formulaire pour associer un emprunt à un abonné)

        3 Voir les livres à rendre + Rendre un livre emprunté
*/

// Enregistrement de l'emprunt
if( !empty($_POST) ){
    $result = $pdo->prepare("INSERT INTO emprunt VALUES(NULL,:id_livre,:id_abonne,
    CURDATE(),NULL)");
    $result->execute(array(
        'id_livre' => $_POST['id_livre'],
        'id_abonne' => $_POST['id_abonne']
    ));
    header('location:' . URL . 'emprunts.php');
    exit();
}

// Gérer le rendu d'un livre
if ( isset($_GET['action']) && $_GET['action'] == 'rendre' && isset($_GET['id_emprunt']
)){

    $result = $pdo->prepare("UPDATE emprunt SET date_rendu = CURDATE() WHERE id_emprunt = :id_emprunt");
    $result->execute(array(
        'id_emprunt' => $_GET['id_emprunt']
    ));
    header('location:' . URL . 'emprunts.php');
    exit();
}


require_once('inc/header.php');

// POINT 1
$result = $pdo->query("SELECT DISTINCT l.id_livre, l.titre, l.auteur FROM livre l 
LEFT JOIN emprunt e ON e.id_livre = l.id_livre
WHERE l.id_livre NOT IN (
    SELECT id_livre FROM emprunt WHERE date_rendu IS NULL)");
if( $result->rowCount() > 0){
    ?>
    <h2 class="text-center">Livre disponibles</h2>
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
                </tr>
                <?php
            }
        ?>
</table>
    <?php
}
else
{
    ?>
    <div class="alert alert-info">Aucun livre disponible</div>
    <?php
}

// POINT2
?>
<h2 class="text-center">Enregistrer un emprunt</h2>
<form action ="" method="post">
    <div class="form-row">
        <div class="form-group col-5">
                <label for="prenom">Prénom</label>
                <select name="id_abonne" id="prenom" class="form-control">
                    <?php
                    $result = $pdo->query("SELECT * FROM abonne ORDER BY prenom");
                    while($abonne = $result->fetch() )
                    {
                        ?>
                        <option value="<?= $abonne['id_abonne'] ?>">
                        <?= $abonne['prenom'] . '('.$abonne['id_abonne'].')' ?></option>
                        <?php
                    }
                    ?>
                </select>
        </div>
        <!-- select livre -->
        <div class="form-row">
        <div class="form-group col-5">
        <label for="livre">Livre</label>
        <select name="id_livre" id="livre" class="form-control">
            <?php
            $result = $pdo->query("SELECT DISTINCT l.id_livre AS idl, l.titre AS titre, l.auteur AS auteur FROM livre l 
            LEFT JOIN emprunt e ON e.id_livre = l.id_livre
            WHERE l.id_livre NOT IN (
                SELECT id_livre FROM emprunt WHERE date_rendu IS NULL)");
                if( $result->rowCount() > 0){
                    while($livre = $result->fetch() ){
                        ?>
                        <option value="<?= $livre['idl'] ?>"><?= $livre['titre'] ?></option>
                        <?php
                    }
                }
            ?>
        </select>
    </div>
    <div class="form-group col-2 mt-4 py-2"></div>
        <input type="submit" class="btn btn-primary pull-right" value="Confirmer">
    </div>
    
</form>

<?php

// POINT 3
$result = $pdo->query("SELECT e.id_emprunt,l.titre,l.auteur,a.prenom,e.date_sortie
FROM emprunt e, livre l, abonne a
WHERE e.id_livre = l.id_livre
AND e.id_abonne = a.id_abonne
AND date_rendu IS NULL");

if( $result->rowCount() > 0){
    ?>
    <h2 class="text-center">livre emprunté</h2>
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
    </tr>
    <?php
        // Données
        while( $emprunt = $result->fetch() )
            {
                ?>
                <tr>
                <?php
                    foreach($emprunt as $information){
                        ?>
                        <td><?= $information ?></td>
                        <?php
                    }
                ?>
                <td><a href="?action=rendre&id_emprunt=<?= $emprunt['id_emprunt'] ?>">Rendre</a></td>
                </tr>
                <?php
            }
        ?>
</table>
    <?php
}
else
{
    ?>
    <div class="alert alert-info">Aucun livre disponible</div>
    <?php
}

require_once('inc/footer.php');
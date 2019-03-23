<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bilan des services</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php

// se connecter sur la base entreprise
$pdo = new PDO(
    'mysql:host=localhost;dbname=entreprise',
    'root',
    '',
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8',
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    )
);
// afficher dans un tableau HTML le nombre d'employés et le salaire moyen par service
$result = $pdo->query("SELECT service as Service, COUNT(*) as Nbre, ROUND(AVG(salaire),2) as 'Salaire moyen' FROM employes GROUP BY service ORDER BY service");

if ( $result->rowCount() > 0 ){
    ?>
    <table>
        <tr>
        <?php
            // entetes
            for($i=0; $i<$result->columnCount();$i++){
                $infos_colonne = $result->getColumnMeta($i);
                ?>
                <th><?= $infos_colonne['name'] ?></th>
                <?php
            }
        ?>
        </tr>
        <?php
            // données
            while( $ligne = $result->fetch() )
            {
                ?>
                <tr>
                <?php
                    foreach($ligne as $index => $information){
                        if ( $index == 'Service') $information = ucfirst($information);
                        if ( $index == 'Salaire moyen') $information = number_format($information,2,',',' ') . ' €';
                        ?>
                        <td><?= $information ?></td>
                        <?php
                    }  
                ?>
                </tr>
                <?php
            }
        ?>
    </table>
    <?php
}else
{
    echo "Pas de résultat";
}
?>
</body>
</html>
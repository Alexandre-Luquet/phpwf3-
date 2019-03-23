<?php

// PDO: PHP Database Object

// Connexion à la BDD
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

// var_dump($pdo);
// var_dump(get_class_methods($pdo));

$result = $pdo->query("SELECT * FROM employes");
// var_dump($result);
// var_dump(get_class_methods($result));
/*
$pdo->query() produit un objet de type PDOStatement
$result est un objet dont je peux parcourir les résultats
en avançant d'une ligne à l'autre avec la méthode fetch()
*/

while( $employe = $result->fetch() ){
    echo $employe['nom'] . '<br>';
    //var_dump($employe);
}
// le mode par défaut de fetch produit un tableau associatif ($employe)

// Méthode plutôt destinée à faire les opérations d'INSERT, UPDATE, DELETE
/*
$result = $pdo->exec("INSERT INTO employes VALUES (NULL,'test','test','m','test',CURDATE(),1000)");
echo "Nbre d'enregistrements afféctés : " . $result;
echo "<br>Dernier id généré : " . $pdo->lastInsertId();
*/

// 993 et 994
$result = $pdo->exec("DELETE FROM employes WHERE id_employes IN (993,994)");
echo "Nbre d'enregistrements afféctés : " . $result;

// fetchAll()
$result = $pdo->query("SELECT * FROM employes");
$donnees = $result->fetchAll();
var_dump($donnees);
echo "Il y a ". $result->rowCount()." lignes<br>";

$i=0;
while ( $i < $result->rowCount() ){
    foreach( $donnees[$i] as $key => $value ){
        echo $key. ' : ' .$value . "<br>";
    }
    $i++;
    echo "<hr>";
}

// autre commande SQL
$result = $pdo->query('SHOW DATABASES');
/*
$test = $result->fetch(); // => index : Database
var_dump($test);
*/
echo "<ul>";
while( $base = $result->fetch() ){
    echo "<li>".$base['Database'];
        $pdo->query("USE ".$base['Database']);
        $result2 = $pdo->query("SHOW TABLES");
        //$test = $result2->fetch();
        //var_dump($test);
        echo "<ul>";
            while($table = $result2->fetch()){
                echo '<li>'.$table['Tables_in_'.$base['Database']].'</li>';
            }
        echo "</ul>";
    echo "</li>";

}
echo "</ul>";


// Code générique d'affichage d'une table quelconque
$pdo->query("USE entreprise"); // on se place sur la base
$table = "employes"; // je choisis une table
$liste_exclues = array('salaire'); // j'exclue certaines colonnes à l'affichage

$result = $pdo->query("SELECT * FROM ".$table);
echo '<table border="1">';
// entetes
echo "<tr>";
for($i=0; $i< $result->columnCount();$i++){
    $infos_colonne = $result->getColumnMeta($i);
    //var_dump($infos_colonne);
    if ( !in_array($infos_colonne['name'],$liste_exclues) ){
        echo '<th>'.$infos_colonne['name'].'</th>';
    }
}
echo "</tr>";

// données
while($ligne = $result->fetch() ){
    echo "<tr>";
        foreach($ligne as $index => $information){
            if (!in_array($index,$liste_exclues)){
                echo '<td>'.$information.'</td>';
            }
        }
    echo "</tr>";
}
echo "</table>";

// ----------------- Requetes préparées --------------------

// bindParam()

$nom = 'Laborde';
$result = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom");
$result->bindParam(':nom',$nom,PDO::PARAM_STR);
// bindParam reçoit exclusivement une variable
$result->execute();
$ligne = $result->fetch();
echo implode(', ',$ligne) . '<hr>';

// bindValue()
//$nom = 'Thoyer';
$result = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom");
$result->bindValue(':nom','Thoyer',PDO::PARAM_STR);
// bindValue reçoit une variable ou une valeur directement
$result->execute();
$ligne = $result->fetch();
echo implode(', ',$ligne) . '<hr>';

// prepare et execute
$result = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom");
$result->execute(
    array(
        'nom' => 'Cottet' // les : sont facultatifs
    )
);
$ligne = $result->fetch();
echo implode(', ',$ligne) . '<hr>';


// FETCH_CLASS
class Employes{
    public $id_employes;
    public $prenom;
    public $nom;
    public $sexe;
    public $service;
    public $date_embauche;
    public $salaire;
}
$result = $pdo->query("SELECT * FROM employes");
$objets = $result->fetchAll(PDO::FETCH_CLASS, 'Employes');
foreach($objets as $employe){
    echo $employe->prenom . '<br>';
}







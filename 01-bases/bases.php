<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bases PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php 

// commentaire uniligne

/*
    multi
*/

echo '<h2>Ecriture et affichage</h2>' . '<hr>';

echo 'Bonjour';
print '<br>Hello';

echo '<h2>Variables : types, déclaration et affectation</h2>' . '<hr>';

$a = 12;
$b = 12.5;
$c = 'Un texte';
$d = true;

echo gettype($a);
echo '<br>';
echo gettype($b);
echo '<br>';
echo gettype($c);
echo '<br>';
echo gettype($d);
echo '<br>';

echo '<h2>La concaténation</h2>' . '<hr>';

$chaine1 = 'bonjour';
$chaine2 = ' tout le monde';
echo $chaine1 . $chaine2 . '<br>';

$fruit = 'pomme';
$fruit .= ' fraise';
echo $fruit;

echo "<h2>Guillemets et quotes</h2>" . '<hr>';
$prenom = 'Pierre';
echo "bonjour mon ami $prenom <br>";
echo 'bonjour mon ami $prenom <br>';
echo 'Bonjour mon ami ' . $prenom . '<br>';
echo 'aujourd\'hui <br>';
echo "aujourd'hui <br>";

echo "<h2>Constantes et Constantes magiques</h2>" . '<hr>';

define('CAPITALE', 'Paris');
echo CAPITALE . '<br>';
// * la constante ne peut pas etre redéfinie 
// * CAPITALE = 'lyon'; impossible

echo __FILE__ . '<br>'; // * chemin du fichier 
echo __LINE__ . '<br>'; // * ligne de code

$blue = 'Bleu';
$white = 'Blanc';
$red = 'Rouge';

echo $blue . ' ' . $white . ' ' . $red . '<br>';
echo "$blue - $white - $red <br>";

echo "<h2>Opérateur arithmétiques</h2>" . '<hr>';
$a = 10; $b = 2;
echo $a + $b . '<br>';
echo $a - $b . '<br>';
echo $a * $b . '<br>';
echo $a / $b . '<br>';
echo $a % $b . '<br>'; // * Le reste de la division

$a += $b; // * a vaut 12 $a = $a + $b
$a++; // * incrémentation $a +=1
$a--;

$a .= $b; // * point de concaténation 
echo $a . '<br>';

echo "<h2>Structures conditionelles</h2>" . '<hr>';
$a = 10; $b = 5; $c = 2;

if($a > $b) {
    echo "A est plus grand que B <br>";
}
else {
    echo "A n'est pas plus grand que B <br>";
}

$var1 = 0;
$var2 = '';
if ( empty($var1) ) echo "0, vide ou non définie <br>";
if ( isset($var2) ) echo "var2 existe et est définie par une chaine vide <br>"; 

if ( $a > $b && $b > $c ) { // * && = ET
    echo "ok pour les deux conditions <br>";
}

if ( $a == 9 || $b > $c ){ // * || = OU inclusif 
    echo "Ok pour au moins une des deux conditions <br>";
} 

if ( $a == 10 XOR $b == 5 ) { // * XOR = OU exclusif (une des 2 doit être fausse)
    echo "Je ne suis pas affiché <br>";
}

// * if / elseif / else 
if ( $a == 8){
    echo "1 - a vaut 8 <br>";
}
elseif ( $a != 10) {
    echo "2 - a est différent de 10 <br>";
}
else{
    echo "3 - tout le monde a faux <br>";
}

// * forme ternaire 
echo ( $a == 10) ? 'a est égal à 10 <br>' : ' a ne vaut pas 10';
$genre = 'm';
$civilite = ( $genre == 'm') ? 'Monsieur' : 'Madame';

// * forme contractée PHP7
$var1 = isset($mavar) ? $mavar : 'valeur par défaut';
$var1 = $mavar ?? 'valeur par défaut';

echo $a ?? $b ?? $c; // * test de l'existence de la partie gauche si il n'existe pas renvoie la prochaine valeur // #endregion
echo $ville ?? $pays ?? ' non localisé <br>';
// * test implicite : isset(), existence de la variable //

// * comparaison 
echo "<hr>";
$varA = 1;
$varB = '1';

if ( $varA == $varB ){
    echo "c'est la même chose <br>";
}

/* 
* = affectation
* == comparaison en valeur 
* === comparaison meme type + meme valeur
* != différent en valeur
* !== différent en valeur ET en type
*/
if ( $a = $b ) echo "ok <br>"; // ! une affectation renvoie true 

if ( !isset($var4) ){ // ! = NOT, NOT ISSET = non défini
    echo "var4 n'existe pas <br>";
}

// * SWITCH 
$couleur = 'jaune';

switch($couleur){

    case 'cyan' :
    case 'bleu' : echo "Vous aimez le bleu <br>";
        break;
    
    case 'rouge' : echo "Vous aimez le rouge <br>";
        break;

    case 'vert' : echo "Vous aimez le vert <br>";
        break;

        default: echo "Vous n'aimez rien <br>";
}

echo "<h2>Fonctions prédéfinies</h2>";
echo "<hr>";

echo "Date : " . date('l d/m/Y') . '<br>'; // * cf php.net, sur date()

// * timestamp 1ere methode
$timestamp1 = mktime(23,30,25,6,15,1950);
// * Heures, Minutes, Secondes, Mois, Jour, Année
echo $timestamp1 . '<br>';
echo date('l d/m/Y H:i:s',$timestamp1) . '<br>';

// * timestamp 2eme methode
$timestamp2 = strtotime('1950-06-15 23:30:25');
// * $timestamp2 = strtotime('06/15/1950 23:30:25');
echo date('l d/m/Y H:i:s',$timestamp2) . '<br>';

// * fonctions de chaine
$email1 = 'prenom@free.fr';
echo strpos($email1, '@') . '<br>';
// * renvoie la position de départ d'un caractère

$email2 = 'bonjour';
echo strpos($email2, '@') . '<br>';
// * console log var_dump( strpos($email2, '@') );

echo iconv_strlen($email1) . '<br>'; // * Longueur de chaine
$phrase = 'Salut Mathieu, ca va ?';
echo substr($phrase,6) . '<br>'; // * substr(chaine, départ)
echo substr($phrase,6,7) . '<br>'; // * substr(chaine, depart, longueur)
$email3 = 'jean.dupond@gmail.com';

echo substr($email3,0,strpos($email3, '@')) . '<br>'; // * jean.dupond

// * gmail.com
echo substr($email3,strpos($email3, '@')+1) . '<br>';

echo strtoupper('phrase en minuscules') . '<br>'; // * to upper case
echo strtolower('PHRASE EN MAJUSCULES') . '<br>'; // * to lower case

$personne = 'marie leblanc';
echo ucfirst($personne) . '<br>'; // * premiere lettre de la chaine (majuscule)
echo ucwords($personne) . '<br>'; // * premiere lettre de chaque mot (majuscule)

echo str_replace('fr', 'com', 'youtube.fr') . '<br>'; // * str_replace(ce qu'on cherche, par quoi on remplace, dans quelle chaine)

$etoiles = 4;
echo str_repeat('&#9733;',$etoiles);
echo str_repeat('&#9734;', 5 - $etoiles) . '<br>';

$code_postal = 1005;
echo str_pad($code_postal, 5, 0, STR_PAD_LEFT) . '<br>'; // * a droite par défaut
// * str_pad(chaine,longueur,caractere generique, sens de remplissage);

echo "<h2>Fonctions utilisateurs</h2>" . '<hr>';

function bonjour($qui='tout le monde'){
    return "Bonjour $qui<br>";
}
echo bonjour('Louis') . '<br>';
echo bonjour() . '<br>';



// * exercice : ecrire la fonction qui renvoie le prix soldé 


function prixSolde($prix, $solde=10){
    $result1 = $prix - ($prix * $solde / 100) . '€<br>';
    return $result1;
}

echo prixSolde(100,20); // * => 80€
echo prixSolde(350,5);
echo prixSolde(200);


/*
function meteo($saison, $temp){
    if ( $temp == 23){
        echo 'Nous sommes au ' . $saison .' ' .'il fait '. $temp .' ' .'degrés <br>';
    }
    else {
        echo 'nous sommes en ' . $saison .' ' .'il fait '. $temp .' ' .'degrés <br>';
    }
}
*/

/*
function meteo($saison, $temp){
    return ( $temp == 23) ? 'Nous sommes au ' . $saison .' ' .'il fait '. $temp .' ' .'degrés <br>' : ' nous sommes en ' . $saison .' ' .'il fait '. $temp .' ' .'degré <br>';
}
*/

/* function meteo($saison,$temp){
    if($saison == 'printemps'){
        $aux = 'au';
    }
    else{
        $aux='en';
    }
    else if($temp >1 || $temp <= -1){
        $plur = 'degrés';
    }
    else{
        $plur = 'degré';
    }
    return "Nous sommes $aux $saison et il fait $temp $plur. <br>";
}
*/


//correction
    function meteo($saison,$temp){
    $article = ( $saison == 'printemps') ? 'au' : 'en';
    $pluriel = ( $temp < -1 || $temp > 1 ) ? 's' : '';
    return 'nous sommes ' . $article . ' ' . $saison .' et il fait ' . $temp .' ' . 'degré' . $pluriel . '<br>';
}

echo meteo('printemps',23); // * Nous sommes au printemps et il fait 23 degrés
echo meteo('hiver',-1); // * nous sommes en hiver et il fait -1 degré.

// * depuis PHP7 : typage des paramètres et de la fonction
function identite(string $nom, int $age) : string {
    return $nom . ' a ' . $age . 'ans';
}

function isAdult(int $age) : bool{
    return $age >= 18;
}

echo '<pre>';
var_dump(isAdult(7));
var_dump(isAdult(19));
echo  '</pre>';

function facultatif(){
    var_dump( func_get_args() );
}

facultatif();
facultatif('france', 'italie', 'espagne');
facultatif(10,50,72);

$pays = 'France'; // * espace global 

function affichePays(){ // * espace local
    global $pays; // * on globalise la variable pays  dans la fonction 
    echo $pays;
}
affichePays();

echo "<h2>Structures itératives : boucles</h2><hr>";

// * Boucle While

$i = 0; // * initialisation

while ($i <= 5){ // * condition
    echo '$i contient la valeur : ' .$i. '<br>';
    $i++; // * incrémentation
}
echo '<br>';
for($i=0; $i <=5; $i++){
    echo $i . ' ';
}
echo '<br><br>';
for($i=10; $i <=100; $i+=10){
    echo '$i contient la valeur : ' .$i. '<br>';
}


// * methode 1
    echo '<select>';
        
        for($i=2001; $i >=1901; $i--){
            echo '<option>' .$i. '</option>';
        }
        
    echo '</select>';



    // * methode 2

    ?>
    <select>
        <?php
        for($i=2001; $i >=1901; $i--):
            ?>
            <option><?= $i ?></option>
            <?php
        endfor;
        ?>
    </select>

    <?php

    // * <?= => <?php echo
if($a==1):
    // * instruction
else:
    // * instruction
endif;

while($b==2):
    // * instruction
endwhile;


$lignes = 8;
$colonnes = 8;
?>
<table>
<?php
    // * exemple de boucles imbriquées
    for($lig=1; $lig<=$lignes;$lig++){
        // * cette boucle génére les lignes (tr)
        ?>
        <tr>
        <?php
        for($col=1; $col <= $colonnes; $col++){
        // * cette boucle génére les colonnes (td)
            ?>
            <td></td>
            <?php
        }
        ?>
        </tr>
        <?php
    }
?>
</table>

<?php

echo "<h2>Inclusion de fichiers</h2><hr>";

echo "premiere fois : ";
include('exemple.php');
echo "<br>deuxieme fois : ";
include_once('exemple.php'); // * Inclusion unique

echo "<br>troisieme fois : ";
require('exemple.php');
echo "<br>Quatrieme fois : ";
require_once('exemple.php');

echo "<h2>Tableaux de données - Array</h2><hr>";

$prenoms = array('Jean', 'Pierre', 'Paul', 'Jérémie');
var_dump($prenoms);
echo $prenoms[2];
$prenoms[] = 'John';
var_dump($prenoms);

//* index alphabétiques
$fruits = array(
    'p' => 'pomme',
    'o' => 'orange',
    'r' => 'raisin'
);
var_dump($fruits);
echo $fruits['o'];

for($i=0; $i < count($prenoms); $i++){
    echo $prenoms[$i] . '-';
}

//* boucle foreach
foreach( $fruits as $index => $valeur ){
    echo $index . '-' . $valeur . '<br>';
}

//* tableau multidimensionnel
$primeur = array(
    'fruits' => array ('pommes', 'bananes', 'kiwis'),
    'legumes' => array ('poireaux' , 'carottes' , 'choux')
);
echo $primeur['legumes'][1];
echo "<hr>";

//* parcours de tableau à 2 dimensions
foreach($primeur as $index1 => $valeur1){
    foreach($valeur1 as $index2 => $valeur2){
        echo "$index1 => $index2 => $valeur2 <br>";
    }
}

//* extract ( tableaux à index alphabétiques)
$identite = array(
    'nom' => 'Snow',
    'prenom' => 'John',
    'profession' => 'Gardien'
);
extract($identite); //* Génerer des variables à partir des index du tableau
echo $profession;

//* Implode, explode
$date1 = '2005-06-10';
$details = explode('-', $date1); //* je décompose la chaine en éléments de tableau
//* le premier paramètre est le séparateur des éléments
var_dump($details);

$jeux = array(
    'Dark Souls',
    'God of War',
    'Red Dead Redemption',
    'Anthem'
);
echo "Ma liste de jeux : " . implode(', ',$jeux) . '<br>';
//* Implode() construit une chaine de caractères à partir des éléments du tableau 
//* et en utilisant le séparateur indiqué.

//* in_arrayr()
var_dump( in_array('Anthem',$jeux));
var_dump( in_array('Apex',$jeux));

//* array_search
echo array_search('God of War',$jeux); // * renvoi l'index de l'élément recherché
echo array_search('pomme', $fruits); // * idem sur index alphabétiques

echo "<h2>Objets</h2><hr>";

//* class = plan de fabrication
class Etudiant{
    public $prenom;
    public $nom;
    public function apprendre(){
        echo "heure de cours<br>";
    }
}

$etudiant1 = new Etudiant;
var_dump($etudiant1); //* Liste les propriétés
var_dump(get_class_methods($etudiant1)); //* liste les méthodes 
$etudiant1->nom = 'durand';
$etudiant1->prenom = 'Jacques';
$etudiant1->apprendre();

//* DateTime
$date2 = new DateTime();
echo $date2->format('d/m/Y');
$date3 = new DateTime('2019-03-15');
$interval = $date3->diff($date2);
echo $interval->format('%a jours %H heures');
$date4 = new DateTime('1992-06-26');
$interval2 = $date4->diff($date2);
echo "<br>";
echo $interval2->format('%Y années %m mois %d jours');

?>
</body>
</html>


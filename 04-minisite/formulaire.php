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

/*
* 1. Concevoir un formulaire de saisie qui permettra a l'utilisateur de choisir
* choisir un fruit et un poids (en KG)

* 2. la soumission lui indiquera le coût prévisionnel de son achat

* Cerises - 5.76€ / KG
* Bananes - 1.09€ / KG
* Pommes - 1.61€ / KG
* Pêches - 3.23€ / KG

* la fonction sera par exemple :
* calcul($fruit,$poids)

*/

require_once('fonction.php');
if( !empty($_POST)){

    if(!empty($_POST['KG'])){
        echo calcul($_POST['fruits'],$_POST['KG']);
    }
    else{
        echo "merci de saisir un poids valide<br>";
    }

}

?>

<form method="POST" action="" enctype="multipart/form">
    <fieldset>
        <legend>Message :</legend>
        <label for="fruits">Fruits</label>
        <select name="fruits">
            <option value="cerise" 
            <?= ( isset($_POST['fruits']) && $_POST['fruits'] =='cerise') ? 'selected' : '' ?>>Cerise</option>
            <option value="banane" 
            <?= ( isset($_POST['fruits']) && $_POST['fruits'] =='banane') ? 'selected' : '' ?>>Banane</option>
            <option value="pomme"
            <?= ( isset($_POST['fruits']) && $_POST['fruits'] =='pomme') ? 'selected' : '' ?>>Pomme</option>
            <option value="peche"
            <?= ( isset($_POST['fruits']) && $_POST['fruits'] =='peche') ? 'selected' : '' ?>>Pêche</option>
        </select>
        <label for="poids">KG :</label>
        <input type="number" step="0.1" id="KG" name="KG" min="0" <?= $_POST['KG'] ?? 'Veuillez saisir un poids' ?>">

        <input type="submit" value="Calculer">
    </fieldset>
</form>
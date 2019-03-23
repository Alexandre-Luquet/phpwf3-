<?php

session_start();

// Connexion à la BDD

$pdo = new PDO(
    'mysql:host=localhost;dbname=bibliotheque',
    'root',
    '',
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8',
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    )
);

// URL du site
define('URL','/phpwf3/09-Bibliotheque/');
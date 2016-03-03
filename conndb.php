<?php
require_once ('config.php');

//Création de la connexion avec la base de données
$connDB = new PDO(DSN, USER, MDP);

//Setattr pour le renvoi des erreur de la class PDO
$connDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


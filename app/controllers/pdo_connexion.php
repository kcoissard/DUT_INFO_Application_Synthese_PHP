<?php

//Connexion à la base de donnée 

try
{
	$pdo = new PDO('mysql:host=iutdoua-webetu.univ-lyon1.fr;dbname=p1502716;charset=utf8','p1502716','240770');
}
catch (Exception $e)
{
	die('Erreur :'.$e->getMessage());
}
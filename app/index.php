<?php
/**
 * Example Application
 *
 * @package Example-application
 */
session_start();
require '../libs/Smarty.class.php';

/**
* Chargement des classes
**/ 
require 'Models/Myautoloader.php';
require 'connexion.php';
$myautoloader = new Myautoloader();
$myautoloader->register();
require_once 'controllers/instanced_managers.php';

$smarty = new Smarty;

//$smarty->force_compile = true;
$smarty->debugging = true;

$smarty->caching = false;//CACHE DESACTIVE

$smarty->cache_lifetime = 120;


// Les différentes Routes.
if(isset($_GET['page'])) {
	$page = htmlspecialchars($_GET['page']);
	switch ($page) {
		case 'home': 
			$page = 'accueil';
			break;
		case 'selection_championnat' :
			$page = 'selection_championnat';
			break;
		case 'ajout_match_championnat':
			$page = 'ajout_match_championnat';
			break;
		case 'generer_aleatoirement':
			$page = 'generer_aleatoirement';
			break;
		case 'matchs_championnat':
			$page = 'matchs_championnat';
			break;
		default :
			$page = 'accueil';
			break;
	}
} else {
	$page = 'accueil';
}
include ('controllers/'.$page.'_controller.php');

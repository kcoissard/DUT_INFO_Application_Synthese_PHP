<?php

/*******************************************
* Chargement automatique des classes
********************************************/

class Myautoloader
{

	/**
	* Constructeur
	* @param $data array différents attributs de l'objet
	**/
	public function __construct()
	{
	}

	/**
	* Chargement automatique des classe
	* @param $class_name string Nom des différentes classe
	**/
	static function myautoloader($class_name)
	{
		require 'Models/'.$class_name.'.php';
	}

	/**
	* Si vous devez utiliser plusieurs fonctions d'autochargement, 
	* la fonction spl_autoload_register() est faite pour cela. 
	* Elle crée une file d'attente de fonctions d'autochargement, 
	* et les exécute les unes après les autres, dans l'ordre où elles ont été définies.
	**/
	static function register()
	{
		spl_autoload_register(array
			(__CLASS__, 'myautoloader'));
	}
}
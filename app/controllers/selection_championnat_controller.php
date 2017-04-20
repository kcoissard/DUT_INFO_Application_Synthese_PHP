<?php

	$saisons = [];
	$pays = [];
	$divisions = [];
	
	foreach ($saison_manager->getAllSaisons() as $saison) {
		$saisons[] = array(
			'id' => $saison->id_saison(),
			'libelle' => $saison->libelle_saison()
		);
	}

	foreach ($pays_manager->getAllPays() as $un_pays) {
		$pays[] = array(
			'id' => $un_pays->id_pays(),
			'libelle' => $un_pays->libelle_pays()
		);
	}

	foreach ($division_manager->getAllDivisions() as $division) {
		$divisions[] = array(
			'id' => $division->id_division(),
			'libelle' => $division->libelle_division()
		);
	}


	$smarty->assign("saisons", $saisons);
	$smarty->assign("pays", $pays);
	$smarty->assign("divisions", $divisions);

	$smarty->display('selection_championnat.tpl');

?>
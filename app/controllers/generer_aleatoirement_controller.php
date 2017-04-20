<?php
	if(isset($_SESSION['saison']) && isset($_SESSION['pays']) && isset($_SESSION['division'])){

		$saison = htmlspecialchars($_SESSION['saison']);
		$pays = htmlspecialchars($_SESSION['pays']);
		$division = htmlspecialchars($_SESSION['division']);

		$champ = $championnat_manager->getChampionnat2($saison, $pays, $division);

		if(isset($_POST['generer_match_aleat'])){
			//$random->generer_calendrier($champ);
		}
		else if (isset($_POST['generer_score'])){
			$random->generer_score_aleatoire($champ);
		}

	$smarty->display('ajout_match_championnat.tpl');
	
		//unset($_SESSION['saison']);
	} else {
		echo 'rah';
	}
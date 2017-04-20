<?php 
class Random extends Manager{


	public function genererDates($object){
		$object->id_saison();
		$saison_manager = new SaisonManager($this->pdo);
		$saison = $saison_manager->getSaison($object->id_saison());
		$date_d = $saison->date_debut();
		$date_f = $saison->date_fin();
		$jour_match;
		$cpt=0;
		$resultat= array();
		
		$info['date_debut'] = mktime($date_d);

		if(get_class($object) == 'Championnat'){
			if(date("N" ,$info['date_debut'])==1 OR  date("N" ,$info['date_debut'])==5 OR
				date("N" ,$info['date_debut'])==6 OR date("N" ,$info['date_debut'])==7){
				$jour_match=$info['date_debut'];
			} else {
				
				
				$delta=5-date("N", $info['date_debut']);
				
				$jour_match = $info['date_debut'] + $delta*86400;

			}

			while($cpt<380){
				if(date("N" ,$jour_match)==5){
					array_push($resultat, $jour_match);
					$jour_match+=86400; // on avance de 60 * 60 * 24 secondes (1jour)
					$cpt++;
				}
				elseif ((date("N" ,$jour_match)==6) OR (date("N" ,$jour_match)==7)) {
					array_push($resultat, $jour_match);
					array_push($resultat, $jour_match);
					array_push($resultat, $jour_match);
					array_push($resultat, $jour_match);
					$jour_match+=86400; // on avance de 60 * 60 * 24 secondes (1jour)
					$cpt+=4;
				}
				elseif (date("N" ,$jour_match)==1) {
					array_push($resultat, $jour_match);
					$jour_match+=86400*4; // on avance de 60 * 60 * 24 * 4 secondes (4jours)
					$cpt++;
				}
				else{
					return -1;
				}
			}
		
		}
		// LIGUE DES CHAMPIONS
		elseif($type == 'ldc'){
			$etape='poules'; // pour dissocier la partie poules avec 6 semaines et phases finale 2semaines * 3 + finale
			if(date("N" ,$info['date_debut'])==2){ //on veut match mardi, après mercredi
				$jour_match=$info['date_debut'];
			}
			elseif(date("N" ,$info['date_debut'])==1){ // cas du lundi
				$jour_match=$info['date_debut']+86400;
			}
			elseif(date("N" ,$info['date_debut'])==3){ // cas du mercredi
				$jour_match=$info['date_debut']-86400;
			}
			elseif(date("N" ,$info['date_debut'])==4){ // cas du jeudi
				$jour_match=$info['date_debut']-2*86400;
			}
			elseif(date("N" ,$info['date_debut'])==5){ // cas du vendredi
				$jour_match=$info['date_debut']-3*86400;
			}
			elseif(date("N" ,$info['date_debut'])==6){ // cas du samedi
				$jour_match=$info['date_debut']-4*86400;
			}
			else{ // cas du dimanche
				$jour_match=$info['date_debut']-5*86400;
			}
			$date_debut+=86400*14;//on avance de 2semaines une fois placé sur mardi
		
			if($etape='poules'){ //la phase de poules comporte 6 semaines avec 16matchs par semaine 
				$cptSemaine=0; // on a 6 semaines pour la phase de poules
				while($cpt<96 AND $cptSemaine<6){ //16x6
					for ($cptNbMatch=0; $cptNbMatch <8 ; $cptNbMatch++) { 
						array_push($resultat, $jour_match);
					}
					$jour_match+=86400; // on avance de 60 * 60 * 24 secondes (1jour)
					$cpt+=8; //8matchs mardi

					//On est mercredi, on fait les 8autres matchs
					for ($cptNbMatch=0; $cptNbMatch <8 ; $cptNbMatch++) { 
						array_push($resultat, $jour_match);
					}
					$jour_match+=86400*6; // on avance de 60 * 60 * 24 * 6 secondes (6jours)

					$cptSemaine++;//on compte une semaine de passée
				}
				$etape='huitiemes';
				$jour_match+=86400*21; // On avance d'un mois entre les poules et les huitiemes (on a déja compté +6jours le dernier mercredi)
				$cpt=0; //on remet le compteur à Zero pour la suite
			}

			if($etape='huitiemes'){ //huitiemes de finale, 16 équipes, 8affrontements x2(A-R)
				while($cpt<16){ //16x6
					for ($cptNbMatch=0; $cptNbMatch <4 ; $cptNbMatch++) { 
						array_push($resultat, $jour_match);
					}
					$jour_match+=86400; // on avance de 60 * 60 * 24 secondes (1jour)
					$cpt+=4; //4matchs mardi

					//On est mercredi, on fait les 4autres matchs
					for ($cptNbMatch=0; $cptNbMatch <4 ; $cptNbMatch++) { 
						array_push($resultat, $jour_match);
					}
					$cpt+=4; //4matchs mercredi
					$jour_match+=86400*6; // on avance de 60 * 60 * 24 * 6 secondes (6jours)
				}//sur deux semaines : deux tours de boucle

				$etape='quarts';
				$jour_match+=86400*7; // On avance de deux semaines entre les poules et les huitiemes (on a déja compté +6jours le dernier mercredi)
				$cpt=0; //on remet le compteur à Zero pour la suite
			}

			if($etape='quarts'){ //quarts de finale, 8 équipes, 4affrontements x2(A-R)
				while($cpt<8){ 
					for ($cptNbMatch=0; $cptNbMatch <2 ; $cptNbMatch++) { 
						array_push($resultat, $jour_match);
					}
					$jour_match+=86400; // on avance de 60 * 60 * 24 secondes (1jour)
					$cpt+=2; //2matchs mardi

					//On est mercredi, on fait les 4autres matchs
					for ($cptNbMatch=0; $cptNbMatch <2 ; $cptNbMatch++) { 
						array_push($resultat, $jour_match);
					}
					$cpt+=2; //2matchs mercredi
					$jour_match+=86400*6; // on avance de 60 * 60 * 24 * 6 secondes (6jours)
				} //sur deux semaines : deux tours de boucle

				$etape='demis';
				$jour_match+=86400*7; // On avance d'une semaine entre les poules et les huitiemes (on a déja compté +6jours le dernier mercredi)
				$cpt=0; //on remet le compteur à Zero pour la suite
			}

			if($etape='demis'){ //demis de finale, 4 équipes, 2affrontements x2(A-R)
				while($cpt<4){ 
					for ($cptNbMatch=0; $cptNbMatch <1 ; $cptNbMatch++) { 
						array_push($resultat, $jour_match);
					}
					$jour_match+=86400; // on avance de 60 * 60 * 24 secondes (1jour)
					$cpt++; //1match mardi

					//On est mercredi, on fait les 4autres matchs
					for ($cptNbMatch=0; $cptNbMatch <1 ; $cptNbMatch++) { 
						array_push($resultat, $jour_match);
					}
					$cpt++; //1match mercredi
					$jour_match+=86400*6; // on avance de 60 * 60 * 24 * 6 secondes (6jours)
				} //sur deux semaines : deux tours de boucle

				$etape='finale';
				$jour_match+=86400*14; // Finale 3 semaines plus tard
				$cpt=0; //on remet le compteur à Zero pour la suite
			}

			if($etape='finale'){ //finale : un match sans retour
				array_push($resultat, $jour_match);	
			}
		}



		// LIGUE DES EUROPA
		elseif($type == 'europa'){
			$etape='poules'; // pour dissocier la partie poules avec 6 semaines et phases finale 2semaines * 3 + finale
			if(date("N" ,$info['date_debut'])==4){ //on veut match jeudi
				$jour_match=$info['date_debut'];
			}
			elseif(date("N" ,$info['date_debut'])==1){ // cas du lundi
				$jour_match=$info['date_debut']+86400*3;
			}
			elseif(date("N" ,$info['date_debut'])==4){ // cas du mardi
				$jour_match=$info['date_debut']+86400*2;
			}
			elseif(date("N" ,$info['date_debut'])==3){ // cas du mercredi
				$jour_match=$info['date_debut']+86400;
			}
			
			elseif(date("N" ,$info['date_debut'])==5){ // cas du vendredi
				$jour_match=$info['date_debut']-86400;
			}
			elseif(date("N" ,$info['date_debut'])==6){ // cas du samedi
				$jour_match=$info['date_debut']-2*86400;
			}
			else{ // cas du dimanche
				$jour_match=$info['date_debut']-3*86400;
			}
			$date_debut+=86400*21;//on avance de 3semaines une fois placé sur mardi car on aura besoin que les poules de LDC se finissent avant celles d'europa
		
			if($etape='poules'){ //la phase de poules comporte 6 semaines avec 24matchs par semaine 
				$cptSemaine=0; // on a 6 semaines pour la phase de poules
				while($cpt<144 AND $cptSemaine<6){ //16x6
					for ($cptNbMatch=0; $cptNbMatch <24 ; $cptNbMatch++) { 
						array_push($resultat, $jour_match);
					}
					$cpt+=24; //24matchs mardi

					$jour_match+=86400*7; // on avance de 60 * 60 * 24 * 7 secondes (1semaine)
					$cptSemaine++;//on compte une semaine de passée
				}
				$etape='huitiemes';
				$jour_match+=86400*21; // On avance d'un mois entre les poules et les huitiemes (on a déja compté +7jours le dernier jeudi)
				$cpt=0; //on remet le compteur à Zero pour la suite
			}

			if($etape='huitiemes'){ //huitiemes de finale, 16 équipes, 8affrontements x2(A-R)
				while($cpt<16){ //16x6
					for ($cptNbMatch=0; $cptNbMatch <8 ; $cptNbMatch++) { 
						array_push($resultat, $jour_match);
					}
					$cpt+=8; //4matchs jeudi

					$jour_match+=86400*7; // on avance de 60 * 60 * 24 * 7 secondes (1semaine)
				}//sur deux semaines : deux tours de boucle

				$etape='quarts';
				$jour_match+=86400*7; // On avance de deux semaines entre les poules et les huitiemes (on a déja compté +7jours le dernier jeudi)
				$cpt=0; //on remet le compteur à Zero pour la suite
			}

			if($etape='quarts'){ //quarts de finale, 8 équipes, 4affrontements x2(A-R)
				while($cpt<8){ 
					for ($cptNbMatch=0; $cptNbMatch <4 ; $cptNbMatch++) { 
						array_push($resultat, $jour_match);
					}
					$cpt+=4; //4matchs mardi

					$jour_match+=86400*7; // on avance de 60 * 60 * 24 * 7 secondes (1semaine)
				} //sur deux semaines : deux tours de boucle

				$etape='demis';
				$jour_match+=86400*7; // On avance de deux semaines entre les poules et les huitiemes (on a déja compté +7jours le dernier jeudi)
				$cpt=0; //on remet le compteur à Zero pour la suite
			}

			if($etape='demis'){ //demis de finale, 4 équipes, 2affrontements x2(A-R)
				while($cpt<4){ 
					for ($cptNbMatch=0; $cptNbMatch <2 ; $cptNbMatch++) { 
						array_push($resultat, $jour_match);
					}
					$cpt+=2; //2match jeudi

					$jour_match+=86400*14	; // on avance de 60 * 60 * 24 * 7 secondes (1semaine)
				} //sur deux semaines : deux tours de boucle

				$etape='finale';
				
				$cpt=0; //on remet le compteur à Zero pour la suite
			}

			if($etape='finale'){ //finale : un match sans retour

				array_push($resultat, $jour_match);	
			}
		}

		return $resultat;
	}

	public function genDateLdc(string $type){
		$date_d;
		$date_f;
		$jour_match;
		$cpt=0;
		$resultat= array();
		$req = $this->pdo->prepare('SELECT date_debut, date_fin FROM AS_Saison ORDER BY date_debut desc');
		$info=$req->execute();

		if($type == 'championnat'){
			if(date("N" ,$info['date_debut'])==1 OR  date("N" ,$info['date_debut'])==5 OR
				date("N" ,$info['date_debut'])==6 OR date("N" ,$info['date_debut'])==7){
				$jour_match=$info['date_debut'];
			}
			else{
				$jour_match=5-$info['date_debut'];
			}

			while($cpt<380){
				if(date("N" ,$jour_match==5)){
					array_push($resultat, $jour_match);
					$jour_match+=86400; // on avance de 60 * 60 * 24 secondes (1jour)
					$cpt++;
				}
				elseif (date("N" ,$jour_match==6 OR date("N" ,$jour_match==7))) {
					array_push($resultat, $jour_match);
					array_push($resultat, $jour_match);
					array_push($resultat, $jour_match);
					array_push($resultat, $jour_match);
					$jour_match+=86400; // on avance de 60 * 60 * 24 secondes (1jour)
					$cpt+=4;
				}
				elseif (date("N" ,$jour_match==1)) {
					array_push($resultat, $jour_match);
					$jour_match+=86400*4; // on avance de 60 * 60 * 24 * 4 secondes (4jours)
					$cpt++;
				}
				else{
					return -1;
				}
			}
			return $resultat;
		}
	}
		
	

	public function genTableau(){//$type) {
		$tab_ini = array();
		$tab_temp = array();
		$tab_final = array();
		
		for($i=1;$i<=20;$i++) {
			
			$tab_temp = array();
			
			for($j=1;$j<=20-$i;$j++) {
				$tab_temp[0] = $i;
				$tab_temp[1] = $i+$j;
				array_push($tab_ini, $tab_temp);
			}
			
		}
		
		echo count($tab_ini);
		// Ici, $tab_ini a bien toutes les rencontres de dispo pour l'aller.
		
		$tab_interdit = array(0);
		
		for($i=0;$i<=30;$i++) {
			
			for($j=0;$j<190;$j++) {
				
				if(!(in_array($tab_ini[$j][0],$tab_interdit) OR (in_array($tab_ini[$j][1],$tab_interdit)))) {
					// Ici, aucune des 2 équipes ne joue à ce moment là.
					array_push($tab_interdit, $tab_ini[$j][0]);
					array_push($tab_interdit, $tab_ini[$j][1]);
					
					array_push($tab_final, $tab_ini[$j]);
					$tab_ini[$j] = array(0,0);
					
				}
				
			}
			
			$tab_interdit = array(0);
			
		}
		
		return $tab_final;	
	}

	public function getArrayOfEquipes($championnat){
		$id_championnat = $championnat->id_championnat();
		$equipe_manager = new EquipeManager($this->pdo);
		$equipes = $equipe_manager->getEquipesDeDivision($championnat->id_championnat());
		return $equipes;
	}	

	public function genererRencontre($championnat){
		$equipes = $this->getArrayOfEquipes($championnat);
		$tableau = $this->genTableau();
		//var_dump($equipes);
		$rencontres = array();
		foreach($tableau as $ligne){
				$tab_temp[0] = $equipes[$ligne[0]-1];
				$tab_temp[1] = $equipes[$ligne[1]-1];
				array_push($rencontres, $tab_temp);
			}
		return $rencontres;
	}


	public function generer_calendrier($championnat){
		$arbitre_manager = new ArbitreManager($this->pdo);
		$match_championnat_manager = new MatchChampionnatManager($this->pdo);
		$rencontres = $this->genererRencontre($championnat);
		$calendrier = $this->genererDates($championnat);
		$num_arbitre = 1;
		for($i = 0; $i < sizeof($rencontres); $i++){
			$id_equipe_visiteur = $rencontres[$i][0]->id_equipe();
			$id_equipe_domicile = $rencontres[$i][1]->id_equipe();
			$date_match_championnat = date('Y/m/d', $calendrier[$i]);
			$arbitres = array();
			  for($j = $num_arbitre; $j < $num_arbitre + 5; $j++){
			  	$id_arbitre = $arbitre_manager->getArbitre($j)->id_arbitre();
			  	$arbitre = array_push($arbitres, $id_arbitre);
			  }
			  $num_arbitre = $num_arbitre + 5;
			  if($num_arbitre > 600){
			   $num_arbitre = 1;
			  }	
			$match_championnat_manager->ajoutMatch($id_equipe_domicile, $id_equipe_visiteur, $championnat->id_championnat(), $date_match_championnat, $arbitres);
		}
	}

	function ScoreRandom(){
		
			$tabProbaScore= array("0","0","0","0","0","0","0","0","0","0","1","1","1","1","1","1","1","1","2","2","2","2","2","2","3","3", "3","3","3","4","4","4","5","5","6", "7", "8","9","10");

			$score= $tabProbaScore[array_rand($tabProbaScore, 1)];
			
			return $score;

		}

	public function generer_score_aleatoire($champ){
		$match_championnat_manager = new MatchChampionnatManager($this->pdo);
		$matchs = $match_championnat_manager->getAllMatchChampionnats($champ->id_championnat());
		foreach($matchs as $match){
			$score1 = $this->ScoreRandom();
			$score2 = $this->ScoreRandom();
			$match_championnat_manager->ajoutResultat($match->id_match_championnat(), (int) $score1, (int) $score2);
		}
	}
}

?>
<?php
class MatchChampionnatManager extends Manager {

	/**
	 * Class Constructor
	 */
	public function __construct($pdo)
	{
		parent::__construct($pdo);
	}

	public function getMatchChampionnat($id_match_championnat){
		$req = $this->pdo->prepare('SELECT * FROM AS_match_championnat WHERE id_match_championnat = :id_match_championnat');
		$req->execute(array(
			'id_match_championnat' => $id_match_championnat
			));
		if($datas = $req->fetch(PDO::FETCH_ASSOC)) return new MatchChampionnat($datas);
		else throw new Exception('Match de Championnat non trouvée');
	}
	
	public function deleteMatch($id_match_championnat){
		$req = $this->pdo->prepare('DELETE FROM AS_match_championnat WHERE id_match_championnat = :id_match_championnat');
		$req->execute(array(
		'id_match_championnat' => $id_match_championnat
		));
		if (!$req) throw new Exception("Erreur lors de la suppression du match");
		else echo ('<p class="success">Le match a été supprimé</p>');	
	}

	/**
	* Récupère la liste des objets de type arbitre
	*
	* @return array of Arbitre $array_of_arbitres
	**/
	public function getAllMatchChampionnats($id_championnat){
		$array = array();
		$req = $this->pdo->prepare('SELECT * FROM AS_match_championnat WHERE id_championnat = :id_championnat order by id_match_championnat');
		$req->execute(array(
		'id_championnat' => $id_championnat
		));
		while ($data = $req->fetch()){
			$array[] = new MatchChampionnat([
				'id_match_championnat' => $data['id_match_championnat'],
				'id_equipe_visiteur' => $data['id_equipe_visiteur'],
				'id_equipe_domicile' => $data['id_equipe_domicile'],
				'id_championnat' => $data['id_championnat'],
				'date_match_championnat' => $data['date_match_championnat'],
				'buts_equipe_visiteur' => $data['buts_equipe_visiteur'],
				'buts_equipe_domicile' => $data['buts_equipe_domicile'],
				'id_arbitre1' => $data['id_arbitre1'],
				'id_arbitre2' => $data['id_arbitre2'],
				'id_arbitre3' => $data['id_arbitre3'],
				'id_arbitre4' => $data['id_arbitre4'],
				'id_remplacant' => $data['id_remplacant']
				]);
 		}
		return $array;
	}

	public function ajoutMatch($id_equipe_domicile, $id_equipe_visiteur, $id_championnat, $date_match_championnat, $arbitres){
		$req = $this->pdo->prepare('INSERT INTO AS_match_championnat 
			(id_equipe_visiteur, id_equipe_domicile, id_championnat, date_match_championnat,  
			id_arbitre1, id_arbitre2, id_arbitre3, id_arbitre4, id_remplacant) 
	 VALUES (:id_equipe_visiteur, :id_equipe_domicile, :id_championnat, :date_match_championnat, 
			:id_arbitre1, :id_arbitre2, :id_arbitre3, :id_arbitre4, :id_remplacant)');
		$req->execute(array(
				'id_equipe_visiteur' => $id_equipe_visiteur,
				'id_equipe_domicile' => $id_equipe_domicile,
				'id_championnat' => $id_championnat,
				'date_match_championnat' => $date_match_championnat,
				'id_arbitre1' => $arbitres[0],
				'id_arbitre2' => $arbitres[1],
				'id_arbitre3' => $arbitres[2],
				'id_arbitre4' => $arbitres[3],
				'id_remplacant' => $arbitres[4]
		));
		
		if (!$req) throw new Exception("Erreur lors de l'ajout du match");
		else echo ('<p class="success">Le match a été ajouté</p>');	
	} 
	
	public function ajoutResultat($id_match_championnat, $buts_equipe_visiteur, $buts_equipe_domicile){
		// On vérifie si l'entrée complète est déjà en base de données ou non
		$q = $this->pdo->prepare('SELECT COUNT(*) as nb FROM AS_match_championnat
												  WHERE id_match_championnat = :id_match_championnat');
		$q->execute(array(
			'id_match_championnat' => $id_match_championnat
			));
			
		$data = $q->fetchColumn();
		// Si elle n'est pas en base de donnée :
		if (!$data) throw new Exception("Le match demandé n'existe pas");
		else {
			$q = $this->pdo->prepare('UPDATE AS_match_championnat
										SET buts_equipe_visiteur = :buts_equipe_visiteur,
											buts_equipe_domicile = :buts_equipe_domicile
											WHERE id_match_championnat = :id_match_championnat');
			$q->execute(array(
				'buts_equipe_visiteur' => $buts_equipe_visiteur,
				'buts_equipe_domicile' => $buts_equipe_domicile,
				'id_match_championnat' => $id_match_championnat
				));
				
			if (!$q) throw new Exception("Erreur lors de l'ajout des résultats");
			else echo ('<p class="success">Les résultats du match  ont été mis à jour </p>');	
		}
	}
	
}
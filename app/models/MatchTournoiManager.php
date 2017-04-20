<?php
class MatchTournoiManager extends Manager {

	/**
	 * Class Constructor
	 */
	public function __construct($pdo)
	{
		parent::__construct($pdo);
	}

	public function getMatchTournoi($id){
		$req = $this->pdo->prepare('SELECT * FROM AS_match_tournoi WHERE id_match_tournoi = :id');
		$req->execute(array(
			'id' => $id
			));
		if($datas = $req->fetch(PDO::FETCH_ASSOC)) return new MatchTournoi($datas);
		else throw new Exception('Match de Tournoi non trouvée');
	}

	/**
	* Récupère la liste des objets de type arbitre
	*
	* @return array of Arbitre $array_of_arbitres
	**/
	public function getAllMatchTournois(){
		$array = array();
		$req = $this->pdo->prepare('SELECT * FROM AS_match_tournoi order by id_match_tournoi');
		$req->execute();
		while ($data = $req->fetch()){
			$array[] = new MatchTournoi([
				'id_match_tournoi' => $data['id_match_tournoi'],
				'id_equipe_visiteur' => $data['id_equipe_visiteur'],
				'id_equipe_domicile' => $data['id_equipe_domicile'],
				'id_groupe' => $data['id_groupe'],
				'id_tournoi' => $data['id_tournoi'],
				'buts_equipe_visiteur' => $data['buts_equipe_visiteur'],
				'buts_equipe_domicile' => $data['buts_equipe_domicile'],
				'date_match_tournoi' => $data['date_match_tournoi'],
				'id_arbitre1' => $data['id_arbitre1'],
				'id_arbitre2' => $data['id_arbitre2'],
				'id_arbitre3' => $data['id_arbitre3'],
				'id_arbitre4' => $data['id_arbitre4'],
				'id_remplacant' => $data['id_remplacant']
				]);
 		}
		return $array;
	}
}
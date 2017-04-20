<?php
class TournoiManager extends Manager {

	/**
	 * Class Constructor
	 */
	public function __construct($pdo)
	{
		parent::__construct($pdo);
	}

	/**
	* Récupère un championnat en fonction de son Id
	*
	* @param $id int
	*
	* @return Arbitre
	**/
	public function getTournoi($id){
		$req = $this->pdo->prepare('SELECT * FROM AS_tournoi WHERE id_tournoi = :id');
		$req->execute(array(
			'id' => $id
			));
		if($datas = $req->fetch(PDO::FETCH_ASSOC)) return new Tournoi($datas);
		else throw new Exception('Tournoi non trouvé');
	}

	/**
	* Récupère la liste des objets de type arbitre
	*
	* @return array of Arbitre $array_of_arbitres
	**/
	public function getAllTournois(){
		$array = array();
		$req = $this->pdo->prepare('SELECT * FROM AS_tournoi order by id_tournoi');
		$req->execute();
		while ($data = $req->fetch()){
			$array[] = new Tournoi([
				'id_tournoi' => $data['id_tournoi'],
				'id_saison' => $data['id_saison'],
				'libelle_tournoi' => $data['libelle_tournoi']
				]);
 		}
		return $array;
	}

}
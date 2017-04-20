<?php
class ArbitreManager extends Manager {

	/**
	 * Class Constructor
	 */
	public function __construct($pdo)
	{
		parent::__construct($pdo);
	}

	/**
	* Récupère un arbitre en fonction de son Id
	*
	* @param $id int
	*
	* @return Arbitre
	**/
	public function getArbitre($id){
		$req = $this->pdo->prepare('SELECT * FROM AS_arbitre WHERE id_arbitre = :id');
		$req->execute(array(
			'id' => $id
			));
		if($datas = $req->fetch(PDO::FETCH_ASSOC)) return new Arbitre($datas);
		else throw new Exception('Arbitre non trouvée');
	}

	/**
	* Récupère la liste des objets de type arbitre
	*
	* @return array of Arbitre $array_of_arbitres
	**/
	public function getAllArbitres(){
		$array = array();
		$req = $this->pdo->prepare('SELECT * FROM AS_arbitre order by nom');
		$req->execute();
		while ($data = $req->fetch()){
			$array[] = new Arbitre([
				'id_arbitre' => $data['id_arbitre'],
				'nom' => $data['nom'],
				'prenom' => $data['prenom']
				]);
		}
		return $array;
	}

}
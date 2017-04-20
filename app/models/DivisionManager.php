<?php
class DivisionManager extends Manager {

	/**
	 * Class Constructor
	 */
	public function __construct($pdo)
	{
		parent::__construct($pdo);
	}

	public function getDivision($id){
		$req = $this->pdo->prepare('SELECT * FROM AS_division WHERE id_division = :id');
		$req->execute(array(
			'id' => $id
			));

		if($datas = $req->fetch(PDO::FETCH_ASSOC)) return new Division($datas);
		else throw new Exception('Division non trouvée');
	}


	public function getAllDivisions(){
		$array = array();
		$req = $this->pdo->prepare('SELECT * FROM AS_division order by id_division');
		$req->execute();
		while ($data = $req->fetch()){
			$array[] = new Division([
				'id_division' => $data['id_division'],
				'libelle_division' => $data['libelle_division']
				]);
		}
		return $array;
	}
}
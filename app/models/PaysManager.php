<?php
class PaysManager extends Manager {

	/**
	 * Class Constructor
	 */
	public function __construct($pdo)
	{
		parent::__construct($pdo);
	}

	public function getPays($id){
		$req = $this->pdo->prepare('SELECT * FROM AS_pays WHERE id_pays = :id');
		$req->execute(array(
			'id' => $id
			));

		if($datas = $req->fetch(PDO::FETCH_ASSOC)) return new Pays($datas);
		else throw new Exception('Pays non trouvée');
	}


	public function getAllPays(){
		$array = array();
		$req = $this->pdo->prepare('SELECT * FROM AS_pays order by libelle_pays');
		$req->execute();
		while ($data = $req->fetch()){
			$array[] = new Pays([
				'id_pays' => $data['id_pays'],
				'libelle_pays' => $data['libelle_pays']
				]);
		}
		return $array;
	}


}
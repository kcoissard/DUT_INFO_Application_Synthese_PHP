<?php
class GroupeManager extends Manager {

	/**
	 * Class Constructor
	 */
	public function __construct($pdo)
	{
		parent::__construct($pdo);
	}

	public function getGroupe($id){
		$req = $this->pdo->prepare('SELECT * FROM AS_groupe WHERE id_groupe = :id');
		$req->execute(array(
			'id' => $id
			));

		if($datas = $req->fetch(PDO::FETCH_ASSOC)) return new Groupe($datas);
		else throw new Exception('Groupe non trouvée');
	}


	public function getAllGroupes(){
		$array = array();
		$req = $this->pdo->prepare('SELECT * FROM AS_groupe order by id_groupe');
		$req->execute();
		while ($data = $req->fetch()){
			$array[] = new Groupe([
				'id_groupe' => $data['id_groupe'],
				'libelle_groupe' => $data['libelle_groupe']
				]);
		}
		return $array;
	}


}
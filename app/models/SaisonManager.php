<?php
class SaisonManager extends Manager {

	/**
	 * Class Constructor
	 */
	public function __construct($pdo)
	{
		parent::__construct($pdo);
	}

	public function getSaison($id){
		$req = $this->pdo->prepare('SELECT * FROM AS_saison WHERE id_saison = :id');
		$req->execute(array(
			'id' => $id
			));

		if($datas = $req->fetch(PDO::FETCH_ASSOC)) return new Saison($datas);
		else throw new Exception('Saison non trouvée');
	}


	public function getAllSaisons(){
		$array = array();
		$req = $this->pdo->prepare('SELECT * FROM AS_saison order by id_saison');
		$req->execute();
		while ($data = $req->fetch()){
			$array[] = new Saison([
				'id_saison' => $data['id_saison'],
				'date_debut' => $data['date_debut'],
				'date_fin' => $data['date_fin'],
				'libelle_saison' => $data['libelle_saison']
				]);
		}
		return $array;
	}


}
<?php
class EquipeManager extends Manager {

	/**
	 * Class Constructor
	 */
	public function __construct($pdo)
	{
		parent::__construct($pdo);
	}

	public function getEquipe($id){
		$req = $this->pdo->prepare('SELECT * FROM AS_equipe WHERE id_equipe = :id');
		$req->execute(array(
			'id' => $id
			));
		if($datas = $req->fetch(PDO::FETCH_ASSOC)) return new Equipe($datas);
		else throw new Exception('Equipe non trouvée');
	}


	public function getAllEquipes(){
		$array = array();
		$req = $this->pdo->prepare('SELECT * FROM AS_equipe order by libelle_equipe');
		$req->execute();
		while ($data = $req->fetch()){
			$array[] = new Equipe([
				'id_equipe' => $data['id_equipe'],
				'id_championnat' => $data['id_championnat'],
				'libelle_equipe' => $data['libelle_equipe']
				]);
		}
		return $array;
	}
	
	public function ajoutEquipe($id_equipe, $id_championnat, $libelle_equipe){
		$req = $this->pdo->prepare('INSERT INTO AS_equipe 
			(id_equipe, id_championnat, libelle_equipe) VALUES (:id_equipe, :id_championnat, :libelle_equipe');
		$req->execute(array(
				'id_equipe' => $id_equipe,
				'id_championnat' => $id_championnat,
				'libelle_equipe' => $libelle_equipe
		));
		
		if (!$req) throw new Exception("Erreur lors de l'ajout de l'équipe");
		else echo "<p class=\"success\">L'équipe a été ajouté</p>";	
	}
	
	public function modificationChampionnat($id_equipe, $id_championnat){
		// On vérifie si l'entrée complète est déjà en base de données ou non
		$q = $this->_db->prepare('SELECT COUNT(*) as nb FROM AS_equipe
												  WHERE id_equipe = :id_equipe');
		$q->execute(array(
			'id_equipe' => $id_equipe,
			'id_championnat' => $id_championnat
			));
			
		$data = $q->fetchColumn();
		// Si elle n'est pas en base de donnée :
		if (!$data) throw new Exception("L'équipe demandée n'existe pas");
		else {
			$q = $this->_db->prepare('UPDATE AS_equipe
										SET id_championnat = :id_championnat');
			$q->execute(array(
				'id_championnat' => $id_championnat,
				));
				
			if (!$req) throw new Exception("Erreur lors du changement de championnat pour l'équipe");
			else echo ("<p class=\"success\">Le championnat auquel participe l'équipe a bien été modifié</p>");	
		}
	}

	public function getEquipesDeDivision($id_championnat){
		$q = $this->pdo->prepare('SELECT * FROM AS_equipe WHERE id_championnat = :id_championnat');
		$q->execute(array(
			'id_championnat' => $id_championnat
			));
		while ($data = $q->fetch()){
			$equipes[] = new Equipe([
				'id_equipe' => $data['id_equipe'],
				'id_championnat' => $data['id_championnat'],
				'libelle_equipe' => $data['libelle_equipe']
				]);
		}
		return $equipes;
	}

	public function getTotalButsMis($id_equipe, $id_championnat){
		$q = $this->pdo->prepare('SELECT SUM(`buts_equipe_visiteur`) FROM `AS_match_championnat` WHERE `id_equipe_visiteur` = :id_equipe AND `id_championnat` = :id_championnat GROUP BY `id_equipe_visiteur`');
		$q->execute(array(
			'id_championnat' => $id_championnat,
			'id_equipe_visiteur' => $id_equipe
			));
		$total_buts_mis = $q->fetch();

		$q = $this->pdo->prepare('SELECT SUM(`buts_equipe_domicile`) FROM `AS_match_championnat` WHERE `buts_equipe_domicile` = :id_equipe AND `id_championnat` = :id_championnat GROUP BY `buts_equipe_domicile`');
		$q->execute(array(
			'id_championnat' => $id_championnat,
			'buts_equipe_domicile' => $id_equipe
			));
		$total_buts_mis += $q->fetch();

		return $total_buts_mis;
	}

	public function getTotalButsPris($id_equipe, $id_championnat){

		$q = $this->pdo->prepare('SELECT SUM(`buts_equipe_domicile`) FROM `AS_match_championnat` WHERE `id_equipe_visiteur` = :id_equipe AND `id_championnat` = :id_championnat GROUP BY `id_equipe_visiteur`');

		$q->execute(array(
			'id_championnat' => $id_championnat,
			'id_equipe_visiteur' => $id_equipe
			));
		$total_buts_pris = $q->fetch();

		$q = $this->pdo->prepare('SELECT SUM(`buts_equipe_visiteur`) FROM `AS_match_championnat` WHERE `id_equipe_domicile` = :id_equipe AND `id_championnat` = :id_championnat GROUP BY `id_equipe_domicile');

		$q->execute(array(
			'id_championnat' => $id_championnat,
			'buts_equipe_domicile' => $id_equipe
			));
		$total_buts_pris += $q->fetch();

		return $total_buts_pris;

	}

	public function getNbMatchsJoues($id_equipe, $id_championnat){

		$q = $this->pdo->prepare('SELECT COUNT(*) FROM `AS_match_championnat` WHERE `id_equipe_visiteur` = :id_equipe AND `id_championnat` = :id_championnat GROUP BY `id_equipe_visiteur');

		$q->execute(array(
			'id_championnat' => $id_championnat,
			'buts_equipe_domicile' => $id_equipe
			));

		$total_match_joues = $q->fetch();


		$q = $this->pdo->prepare('SELECT COUNT(*) FROM `AS_match_championnat` WHERE `id_equipe_domicile` = 42 AND `id_championnat` = 1 GROUP BY `id_equipe_domicile');

		$q->execute(array(
			'id_championnat' => $id_championnat,
			'buts_equipe_domicile' => $id_equipe
			));

		$total_match_joues += $q->fetch();
		return $total_match_joues;

	}

	public function getNbMatchsGagnes($id_equipe, $id_championnat){
		$q = $this->pdo->prepare('SELECT COUNT(*) FROM `AS_match_championnat` WHERE `id_equipe_domicile` = :id_equipe AND `id_championnat` = :id_championnat AND buts_equipe_domicile > buts_equipe_visiteur');

		$q->execute(array(
			'id_championnat' => $id_championnat,
			'buts_equipe_domicile' => $id_equipe
			));

		$total_match_gagnes = $q->fetch();

		$q = $this->pdo->prepare('SELECT COUNT(*) FROM `AS_match_championnat` WHERE `id_equipe_visiteur` = :id_equipe AND `id_championnat` = :id_championnat AND buts_equipe_visiteur > buts_equipe_domicile');

		$q->execute(array(
			'id_championnat' => $id_championnat,
			'buts_equipe_domicile' => $id_equipe
			));

		$total_match_gagnes += $q->fetch();

		return $total_match_gagnes;
	}

	public function getNbMatchsPerdus($id_equipe, $id_championnat){
	$q = $this->pdo->prepare('SELECT COUNT(*) FROM `AS_match_championnat` WHERE `id_equipe_domicile` = :id_equipe AND `id_championnat` = :id_championnat AND buts_equipe_domicile < buts_equipe_visiteur');

		$q->execute(array(
			'id_championnat' => $id_championnat,
			'buts_equipe_domicile' => $id_equipe
			));

		$total_match_perdus = $q->fetch();

		$q = $this->pdo->prepare('SELECT COUNT(*) FROM `AS_match_championnat` WHERE `id_equipe_visiteur` = :id_equipe AND `id_championnat` = :id_championnat AND buts_equipe_visiteur < buts_equipe_domicile');

		$q->execute(array(
			'id_championnat' => $id_championnat,
			'buts_equipe_domicile' => $id_equipe
			));

		$total_match_perdus += $q->fetch();

		return $total_match_perdus;
	}

	public function getNbMatchsEgalites($id_equipe, $id_championnat){
	$q = $this->pdo->prepare('SELECT COUNT(*) FROM `AS_match_championnat` WHERE (`id_equipe_domicile` = :id_equipe OR `id_equipe_visiteur` = :id_equipe) AND `id_championnat` = :id_championnat AND buts_equipe_domicile = buts_equipe_visiteur');

		$q->execute(array(
			'id_championnat' => $id_championnat,
			'buts_equipe_domicile' => $id_equipe
			));

		$total_match_egalites = $q->fetch();

		return $total_match_egalites;
	}
}
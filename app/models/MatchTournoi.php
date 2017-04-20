<?php 
class MatchTournoi {
	private $id_match_tournoi;
	private $id_equipe_visiteur;
	private $id_equipe_domicile;
	private $id_groupe;
	private $id_tournoi;
	private $buts_equipe_visiteur;
	private $buts_equipe_domicile;
	private $date_match_tournoi;
	private $id_arbitre1;
	private $id_arbitre2;
	private $id_arbitre3;
	private $id_arbitre4;
	private $id_remplacant;
	/**
	* Constructeur
	* @param $data array différents attributs de l'objet
	**/
	public function __construct($datas = array())
	{
		$this->hydrate($datas);
	}

	/**
	* Fonction d'hydratation de l'objet User par l'appel des setters associés
	* @param $datas array différents attributs de l'objet
	**/
	public function hydrate(array $datas)
	{
		foreach ($datas as $key => $value)
		{
			$method = 'set'.ucfirst($key);
			if(method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
	}
	//**************** GETTERS ***************//
	public function id_match_tournoi()
	{
		return $this->id_match_tournoi;
	}
	public function id_equipe_visiteur()
	{
		return $this->id_equipe_visiteur;
	}
	public function id_equipe_domicile()
	{
		return $this->id_equipe_domicile;
	}
	public function id_groupe()
	{
		return $this->id_groupe;
	}
	public function id_tournoi()
	{
		return $this->id_tournoi;
	}
	public function date_match_tournoi()
	{
		return $this->date_match_tournoi;
	}
	public function buts_equipe_visiteur()
	{
		return $this->buts_equipe_visiteur;
	}
	public function buts_equipe_domicile()
	{
		return $this->buts_equipe_domicile;
	}
	public function id_arbitre1()
	{
		return $this->id_arbitre1;
	}
	public function id_arbitre2()
	{
		return $this->id_arbitre2;
	}
	public function id_arbitre3()
	{
		return $this->id_arbitre3;
	}
	public function id_arbitre4()
	{
		return $this->id_arbitre4;
	}
	public function id_remplacant()
	{
		return $this->id_remplacant;
	}
	

	//**************** SETTERS ****************// 
	public function setId_match_tournoi($id_match_tournoi)
	{
		$id_match_tournoi = (int) $id_match_tournoi;
		$this->id_match_tournoi = $id_match_tournoi;
	}
	public function setId_equipe_visiteur($id_equipe_visiteur)
	{
		$id_equipe_visiteur = (int) $id_equipe_visiteur;
		$this->id_equipe_visiteur = $id_equipe_visiteur;
	}
	public function setId_equipe_domicile($id_equipe_domicile)
	{
		$id_equipe_domicile = (int) $id_equipe_domicile;
		$this->id_equipe_domicile = $id_equipe_domicile;
	}
	public function setId_tournoi($id_groupe)
	{
		$id_groupe = (int) $id_groupe;
		$this->id_groupe = $id_groupe;
	}
	public function setId_tournoi($id_tournoi)
	{
		$id_tournoi = (int) $id_tournoi;
		$this->id_tournoi = $id_tournoi;
	}

	public function setDate_match_tournoi($date_match_tournoi)
	{
		$this->date_match_tournoi = $date_match_tournoi;
	}

	public function setButs_equipe_visiteur($buts_equipe_visiteur)
	{
		$buts_equipe_visiteur = (int) $buts_equipe_visiteur;
		$this->buts_equipe_visiteur = $buts_equipe_visiteur;
	}
	public function setButs_equipe_domicile($buts_equipe_domicile)
	{
		$buts_equipe_domicile = (int) $buts_equipe_domicile;
		$this->buts_equipe_domicile = $buts_equipe_domicile;
	}
	public function setId_arbitre1($id_arbitre1)
	{
		$id_arbitre1 = (int) $id_arbitre1;
		$this->id_arbitre1 = $id_arbitre1;
	}
	public function setId_arbitre2($id_arbitre2)
	{
		$id_arbitre2 = (int) $id_arbitre2;
		$this->id_arbitre2= $id_arbitre2;
	}
	public function setId_arbitre3($id_arbitre3)
	{
		$id_arbitre3 = (int) $id_arbitre3;
		$this->id_arbitre3 = $id_arbitre3;
	}
	public function setId_arbitre4($id_arbitre4)
	{
		$id_arbitre4 = (int) $id_arbitre4;
		$this->id_arbitre4 = $id_arbitre4;
	}
	public function setId_remplacant($id_remplacant)
	{
		$id_remplacant = (int) $id_remplacant;
		$this->id_remplacant = $id_remplacant;
	}

	
}
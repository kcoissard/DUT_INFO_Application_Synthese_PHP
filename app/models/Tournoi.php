<?php 
class Tournoi {
	private $id_tournoi;
	private $id_saison;
	private $libelle_tournoi;

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
	public function id_tournoi()
	{
		return $this->id_tournoi;
	}
	public function id_saison()
	{
		return $this->id_saison;
	}
	public function libelle_tournoi()
	{
		return $this->libelle_tournoi;
	}

	//**************** SETTERS ****************// 
	public function setId_tournoi($id_tournoi)
	{
		$id_tournoi = (int) $id_tournoi;
		$this->id_tournoi = $id_tournoi;
	}
	public function setId_saison($id_saison)
	{
		$id_saison = (int) $id_saison;
		$this->id_saison = $id_saison;
	}
	public function setLibelle_tournoi($libelle_tournoi)
	{
		if(is_string($libelle_tournoi) && strlen($libelle_tournoi) <= 100)
		{
			$this->libelle_tournoi = $libelle_tournoi;
		}
		else throw new Exception('Le libellé est trop long');
	}
}
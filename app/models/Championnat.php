<?php 
class Championnat {
	private $id_championnat;
	private $id_division;
	private $id_pays;
	private $id_saison;
	private $libelle_championnat;

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
	public function id_championnat()
	{
		return $this->id_championnat;
	}
	public function id_division()
	{
		return $this->id_division;
	}
	public function id_pays()
	{
		return $this->id_pays;
	}
	public function id_saison()
	{
		return $this->id_saison;
	}
	public function libelle_championnat()
	{
		return $this->libelle_championnat;
	}

	//**************** SETTERS ****************// 
	public function setId_championnat($id_championnat)
	{
		$id_championnat = (int) $id_championnat;
		$this->id_championnat = $id_championnat;
	}
	public function setId_division($id_division)
	{
		$id_division = (int) $id_division;
		$this->id_division = $id_division;
	}
	public function setId_pays($id_pays)
	{
		$id_pays = (int) $id_pays;
		$this->id_pays = $id_pays;
	}
	public function setId_saison($id_saison)
	{
		$id_saison = (int) $id_saison;
		$this->id_saison = $id_saison;
	}
	public function setLibelle_championnat($libelle_championnat)
	{
		if(is_string($libelle_championnat) && strlen($libelle_championnat) <= 100)
		{
			$this->libelle_championnat = $libelle_championnat;
		}
		else throw new Exception('Le libellé est trop long');
	}
}
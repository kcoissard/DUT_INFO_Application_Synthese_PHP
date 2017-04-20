<?php 
class Division {
	private $id_division;
	private $libelle_division;

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
	public function id_division()
	{
		return $this->id_division;
	}
	public function libelle_division()
	{
		return $this->libelle_division;
	}

	//**************** SETTERS ****************// 
	public function setId_division($id_division)
	{
		$id_division = (int) $id_division;
		$this->id_division = $id_division;
	}
	public function setLibelle_division($libelle_division)
	{
		if(is_string($libelle_division) && strlen($libelle_division) <= 100)
		{
			$this->libelle_division = $libelle_division;
		}
		else throw new Exception('Le libellé est trop long');
	}
}
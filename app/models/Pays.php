<?php 
class Pays {
	private $id_pays;
	private $libelle_pays;

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
	public function id_pays()
	{
		return $this->id_pays;
	}
	public function libelle_pays()
	{
		return $this->libelle_pays;
	}

	//**************** SETTERS ****************// 
	public function setId_pays($id_pays)
	{
		$id_pays = (int) $id_pays;
		$this->id_pays = $id_pays;
	}
	public function setLibelle_pays($libelle_pays)
	{
		if(is_string($libelle_pays) && strlen($libelle_pays) <= 100)
		{
			$this->libelle_pays = $libelle_pays;
		}
		else throw new Exception('le libellé est trop long');
	}
}
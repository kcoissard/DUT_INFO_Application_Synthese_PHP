<?php 
class Groupe {
	private $id_groupe;
	private $libelle_groupe;

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
	public function id_groupe()
	{
		return $this->id_groupe;
	}
	public function libelle_groupe()
	{
		return $this->libelle_groupe;
	}

	//**************** SETTERS ****************// 
	public function setId_groupe($id_groupe)
	{
		$id_groupe = (int) $id_groupe;
		$this->id_groupe = $id_groupe;
	}
	public function setLibelle_groupe($libelle_groupe)
	{
		if(is_string($libelle_groupe) && strlen($libelle_groupe) <= 100)
		{
			$this->libelle_groupe = $libelle_groupe;
		}
		else throw new Exception('Le libellé est trop long');
	}
}
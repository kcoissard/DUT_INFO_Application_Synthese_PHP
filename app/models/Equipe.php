<?php 
class Equipe {
	private $id_equipe;
	private $id_championnat;
	private $libelle_equipe;

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
	public function id_equipe()
	{
		return $this->id_equipe;
	}
	public function id_championnat()
	{
		return $this->id_championnat;
	}
	public function libelle_equipe()
	{
		return $this->libelle_equipe;
	}

	//**************** SETTERS ****************// 
	public function setId_equipe($id_equipe)
	{
		$id_equipe = (int) $id_equipe;
		$this->id_equipe = $id_equipe;
	}
	public function setId_championnat($id_championnat)
	{
		$id_championnat = (int) $id_championnat;
		$this->id_championnat = $id_championnat;
	}
	public function setLibelle_equipe($libelle_equipe)
	{
		if(is_string($libelle_equipe) && strlen($libelle_equipe) <= 100)
		{
			$this->libelle_equipe = $libelle_equipe;
		}
		else throw new Exception('Le libellé est trop long');
	}
}
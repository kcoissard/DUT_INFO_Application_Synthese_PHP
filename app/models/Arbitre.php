<?php 
class Arbitre {
	private $id_arbitre;
	private $nom;
	private $prenom;

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
			$method = 'set'.ucfirst($key); //ucfirst foncion pour mettre en maj la première lettre
			if(method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
	}
	//**************** GETTERS ***************//
	public function id_arbitre()
	{
		return $this->id_arbitre;
	}
	public function nom()
	{
		return $this->nom;
	}
public function prenom()
	{
		return $this->prenom;
	}


	//**************** SETTERS ****************// 
	public function setId_arbitre($id_arbitre)
	{
		$id_arbitre = (int) $id_arbitre;
		$this->id_arbitre = $id_arbitre;
	}
	public function setNom($nom)
	{
		if(is_string($nom) && strlen($nom) <= 100)
		{
			$this->nom = $nom;
		}
		else throw new Exception('Le nom est trop long');
	}
	public function setPrenom($prenom)
	{
		if(is_string($prenom) && strlen($prenom) <= 100)
		{
			$this->prenom = $prenom;
		}
		else throw new Exception('Le prénom est trop long');
	}
}
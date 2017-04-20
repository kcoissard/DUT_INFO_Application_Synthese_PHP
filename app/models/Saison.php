<?php
class Saison {
	private $id_saison;
    private $libelle_saison;
	private $date_debut;
	private $date_fin;
	
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


    /**
     * Gets the value of id_saison.
     *
     * @return mixed
     */
    public function id_saison()
    {
        return $this->id_saison;
    }

    /**
     * Sets the value of id_saison.
     *
     * @param mixed $id_saison the id saison
     *
     * @return self
     */
    private function setId_saison($id_saison)
    {
    	$id_saison = (int) $id_saison;
        $this->id_saison = $id_saison;
    }

    /**
     * Gets the value of date_debut.
     *
     * @return mixed
     */
    public function date_debut()
    {
        return $this->date_debut;
    }

     /**
     * Gets the value of date_fin.
     *
     * @return mixed
     */
    public function date_fin()
    {
        return $this->date_fin;
    }

    /**
     * Gets the value of libelle_saison.
     *
     * @return mixed
     */
    public function libelle_saison()
    {
        return $this->libelle_saison;
    }

    /**
     * Sets the value of date_debut.
     *
     * @param mixed $date_debut the date debut
     *
     * @return self
     */
    private function setDate_debut($date_debut)
    {
        $this->date_debut = (int) $date_debut;
    }

   

    /**
     * Sets the value of date_fin.
     *
     * @param mixed $date_fin the date fin
     *
     * @return self
     */
    private function setDate_fin($date_fin)
    {
        $this->date_fin = (int) $date_fin;
    }

    /**
     * Sets the value of libelle_saison.
     *
     * @param mixed $libelle_saison the date fin
     *
     * @return self
     */
    private function setLibelle_saison($libelle_saison)
    {
        $this->libelle_saison = $libelle_saison;
    }
}
?>
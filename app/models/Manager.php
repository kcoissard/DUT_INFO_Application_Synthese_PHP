<?php

class Manager {

	protected $pdo;
	
	/**
	 * Class Constructor
	 * @param    $pdo   
	 */
	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}
}
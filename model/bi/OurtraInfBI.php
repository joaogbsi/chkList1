<?php
require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_BI.'GenericBI.php';
require_once PATH_MODEL_DAO.'OutraInfDAO.php';

class OutraInfBI extends GenericBI{

	private $outraInfDAO;

	public function __construct($connection){
		parent::__construct($connection);
	}

	public function gravarOutraInf($outraInf){
		echo 'OutraInfBI';
		if(is_null($this->outraInfDAO)){
			$this->outraInfDAO = new OutraInfDAO($this->connection);
		}

		$this->outraInfDAO->inserirOutraInf($outraInf);
	}

	public function alterarOutraInf($outraInf, $cnpj){
		if(is_null($this->outraInfDAO)){
			$this->outraInfDAO = new OutraInfDAO($this->connection);
		}

		$this->outraInfDAO->alterarOutraInf($outraInf, $cnpj);
	}
}
?>
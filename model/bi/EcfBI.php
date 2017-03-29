<?php

require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_BI .'GenericBI.php';
require_once PATH_MODEL_DAO.'EcfDAO.php';

class EcfBI extends GenericBI{

	private $ecfDAO;

	public function __construct($connection){
		parent::__construct($connection);
	}

	public function gravarEcf($ecf){
		if(is_null($this->ecfDAO)){
			$this->ecfDAO = new EcfDAO($this->connection);
		}

		$this->ecfDAO->inserirEcf($ecf);
	}

	public function deletarPorId($id){
		if(is_null($this->ecfDAO)){
			$this->ecfDAO = new EcfDAO($this->connection);
		}

		$this->ecfDAO->deletarPorId($id);
	}

	public function buscarPorCnpj($cnpj){
		if(is_null($this->ecfDAO)){
			$this->ecfDAO = new EcfDAO($this->connection);
		}

		return $this->ecfDAO->buscarPorCnpj($cnpj);
	}

	public function buscarEcf($params, $cnpj){
		if(is_null($this->ecfDAO)){
			$this->ecfDAO = new EcfDAO($this->connection);
		}

		$criterio = ' cnpjEmp = '.$cnpj
		            .' AND qtde = '.$params['qtde']
		            .' AND marca = "'.$params['marca'].'"';

		return $this->ecfDAO->encontrarPorCriterio('*', 'tb_ecf', $criterio);
	}

} 
?>
<?php

require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_BI.'GenericBI.php';
require_once PATH_MODEL_DAO.'OperadorDAO.php';

class OperadorBI extends GenericBI{

	private $operadorDAO;

	public function __construct($connection){
		parent::__construct($connection);
	}

	public function gravarOperador($operador){
		if(is_null($this->operadorDAO)){
			$this->operadorDAO = new OperadorDAO($this->connection);
		}

		$this->operadorDAO->inserirOperador($operador);
	}


	public function deletarPorId($id){
		if(is_null($this->operadorDAO)){
			$this->operadorDAO = new OperadorDAO($this->connection);
		}

		$this->operadorDAO->deletarPorId($id);
	}

	public function buscarPorCnpj($cnpj){
		if(is_null($this->operadorDAO)){
			$this->operadorDAO = new OperadorDAO($this->connection);
		}

		$criterio = ' cnpjEmp = '. $cnpj;
		return $this->operadorDAO->encotrarPorCriterio('*', 'tb_operador', $criterio);
	}

	public function buscarOperdador($params, $cnpj){
		if(is_null($this->operadorDAO)){
			$this->operadorDAO = new OperadorDAO($this->connection);
		}

		$criterio = ' cnpjEmp = '. $cnpj
		            .' AND cpf = '. $params['cpf']
		            .' AND nome = "'.$params['nome']
		            .'" AND turno = '.$params['turno']
		            .' AND descAcr = '.$params['descAcr']
		            .' AND cancelar = '.$params['cancelar']
		            .' AND liberar = '.$params['liberar']
		            .' AND redZ = '.$params['redZ']
		            .' AND suprSang = '.$params['suprSang'];

		return $this->operadorDAO->encotrarPorCriterio('*', 'tb_operador', $criterio);
	}
}
?>
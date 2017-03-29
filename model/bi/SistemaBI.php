<?php
require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_BI.'GenericBI.php';
require_once PATH_MODEL_DAO.'SistemaDAO.php';

class SistemaBI extends GenericBI{

	private $sistemaDAO;

	public function __construct($connection){
		parent::__construct($connection);
	}

	public function gravarSistema($sistema){
		if(is_null($this->sistemaDAO)){
			$this->sistemaDAO = new SistemaDAO($this->connection);
		}

		$this->sistemaDAO->inserirSistema($sistema);
	}

	public function alterarSistema($sistema, $cnpj){
		if(is_null($this->sistemaDAO)){
			$this->sistemaDAO = new SistemaDAO($this->connection);
		}

		$this->sistemaDAO->alterarSistema($sistema, $cnpj);
	}

	public function buscarPorCnpj($cnpj){
		if(is_null($this->sistemaDAO)){
			$this->sistemaDAO = new SistemaDAO($this->connection);
		}
		$criterio = ' cnpjEmp = '.$cnpj;
		return $this->sistemaDAO->encontrarPorCriterio('*', 'tb_sistema', $criterio);
	}
}
?>
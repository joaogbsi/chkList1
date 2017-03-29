<?php
require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_BI .'GenericBI.php';
require_once PATH_MODEL_DAO.'RemotoDAO.php';

class RemotoBI extends GenericBI{

	private $remotoDAO;

	public function __construct($connection){
		parent::__construct($connection);
	}

	public function gravarRemoto($remoto){
		if(is_null($this->remotoDAO)){
			$this->remotoDAO = new RemotoDAO($this->connection);
		}

		$this->remotoDAO->inserirRemoto($remoto);
	}

	public function alterarRemoto($remoto, $cnpj){
		if(is_null($this->remotoDAO)){
			$this->remotoDAO = new RemotoDAO($this->connection);
		}

		$this->remotoDAO->alterarRemoto($remoto, $cnpj);
	}

	public function buscarPorCnpj($cnpj){
		if(is_null($this->remotoDAO)){
			$this->remotoDAO = new RemotoDAO($this->connection);
		}
		$criterio = 'cnpjEmp = '.$cnpj;
		return $this->remotoDAO->encontrarPorCriterio('*', 'tb_remoto', $criterio);
	}
}
?>

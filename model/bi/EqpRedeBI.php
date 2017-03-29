<?php

require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_BI .'GenericBI.php';
require_once PATH_MODEL_DAO.'EqpRedeDAO.php';

class EqpRedeBI extends GenericBI{

	private $eqpRedeDAO;

	public function __construct($connection){
		parent::__construct($connection);
	}

	public function gravarEqpRede($eqpRede){
		if(is_null($this->eqpRedeDAO)){
			$this->eqpRedeDAO = new EqpRedeDAO($this->connection);
		}

		$this->eqpRedeDAO->inserirEqpRede($eqpRede);
	}

	public function deletarPorId($id){
		if(is_null($this->eqpRedeDAO)){
			$this->eqpRedeDAO = new EqpRedeDAO($this->connection);
		}

		$this->eqpRedeDAO->deletarPorId($id);
	}

	public function buscarPorCnpj($cnpj){
		if(is_null($this->eqpRedeDAO)){
			$this->eqpRedeDAO = new EqpRedeDAO($this->connection);
		}
		$criterio = 'cnpjEmp ='. $cnpj;
		return $this->eqpRedeDAO->encontrarPorCriterio('*', 'tb_eqpRede', $criterio);

	}
	public function buscarEqpRede($params, $cnpj){

		if(is_null($this->eqpRedeDAO)){
			$this->eqpRedeDAO = new EqpRedeDAO($this->connection);
		}
		$criterio = 'cnpjEmp ='. $cnpj
		            .' AND qtde = '.$params['qtde']
		            .' AND marca = "'.$params['marca'].'"';

		return $this->eqpRedeDAO->encontrarPorCriterio('*', 'tb_eqpRede', $criterio);

	}


}
?>
<?php

require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_BI .'GenericBI.php';
require_once PATH_MODEL_DAO.'BalancaDAO.php';

class BalancaBI extends GenericBI{

	private $balancaDAO;

	public function __construct($connection){
		parent::__construct($connection);
	}

	public function gravarBalanca($balanca){
		if(is_null($this->balancaDAO)){
			$this->balancaDAO = new BalancaDAO($this->connection);
		}

		$this->balancaDAO->inserirBalanca($balanca);
	}

	public function deletarPorId($id){
		if(is_null($this->balancaDAO)){
			$this->balancaDAO = new BalancaDAO($this->connection);
		}

		$this->balancaDAO->deletarPorId($id);
	}

	public function buscarPorCnpj($cnpj){
		if(is_null($this->balancaDAO)){
			$this->balancaDAO = new BalancaDAO($this->connection);
		}
		/*$teste = $this->balancaDAO->buscarPorCnpj($cnpj);
		var_dump($teste);*/
		return $this->balancaDAO->buscarPorCnpj($cnpj);
	}

	public function buscarBalanca($params, $cnpj){
		if(is_null($this->balancaDAO)){
			$this->balancaDAO = new BalancaDAO($this->connection);
		}
		/*$teste = $this->balancaDAO->buscarPorCnpj($cnpj);
		var_dump($teste);*/

		$criterio = 'cnpjEmp = '.$cnpj.' AND qtde = '.$params['qtde'].' AND marca = "'.$params['marca'].'"';
		return $this->balancaDAO->encontrarPorCriterio('*', 'tb_balanca', $criterio);
	}
}
?>
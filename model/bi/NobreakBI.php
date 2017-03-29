<?php

require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_BI .'GenericBI.php';
require_once PATH_MODEL_DAO.'NobreakDAO.php';

class NobreakBI extends GenericBI{

	private $nobreakDAO;

	public function __construct($connection){
		parent::__construct($connection);
	}

	public function gravarNobreak($nobreak){
		if(is_null($this->nobreakDAO)){
			$this->nobreakDAO = new NobreakDAO($this->connection);
		}

		$this->nobreakDAO->inserirNobreak($nobreak);
	}
	
	public function deletarPorId($id){
		if(is_null($this->nobreakDAO)){
			$this->nobreakDAO = new NobreakDAO($this->connection);
		}

		$this->nobreakDAO->deletarPorId($id);
	}
	
	public function buscarPorCnpj($cnpj){
		if(is_null($this->nobreakDAO)){
			$this->nobreakDAO = new NobreakDAO($this->connection);
		}
		$criterio = 'cnpjEmp = '.$cnpj;
		return $this->nobreakDAO->encontrarPorCriterio('*', 'tb_nobreak', $criterio);
	}

	public function buscarNobreak($params, $cnpj){
		if(is_null($this->nobreakDAO)){
			$this->nobreakDAO = new NobreakDAO($this->connection);
		}
		$criterio = 'cnpjEmp = '.$cnpj
		            .' AND qtde = '.$params['qtde']
		            .' AND marca = "'.$params['marca']
		            .'" AND serv = '.$params['serv']
		            .' AND term = '.$params['term']
		            .' AND caixa = '.$params['caixa'];

		return $this->nobreakDAO->encontrarPorCriterio('*', 'tb_nobreak', $criterio);
	}

}

?>
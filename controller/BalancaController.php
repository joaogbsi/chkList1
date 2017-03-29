<?php

require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_ENTITIES.'Balanca.class.php';
require_once PATH_MODEL_BI.'BalancaBI.php';
require_once PATH_MODEL_BI.'ConnectionFactoryBI.class.php';

class BalancaController{

	private $connectionFactoryBI;

	public function gravarBalanca($params, $cnpj){

		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$balancaBI = new BalancaBI($connection);

		try{
			$balanca = new Balanca();

			$balanca = $this->montaObj($params);
			$balanca->setCnpjEmp($cnpj);
			/*$balanca->setQtde($params['qtde']);
			$balanca->setMarca($params['marca']);*/


			$balancaBI->gravarBalanca($balanca);
			$balancaBI->releaseConnection($connection);
		}catch(Exception $exc){
			$connection->rollBack();
			$this->connectionFactoryBI()->releaseConnection($connection);
			echo $exc->getTraceAsString();
		}
	}
	
	public function deletarPorId($id){

		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$balancaBI = new BalancaBI($connection);

		try{
			
			$balancaBI->deletarPorId($id);
			$balancaBI->releaseConnection($connection);
		}catch(Exception $exc){
			$connection->rollBack();
			$this->connectionFactoryBI()->releaseConnection($connection);
			echo $exc->getTraceAsString();
		}
	}


	public function buscarPorCnpj($cnpj){
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$balancaBI = new BalancaBI($connection);



		try{
			$balanca = $balancaBI->buscarPorCnpj($cnpj);
			
			if(!is_null($balanca)){
				$balancaBI->releaseConnection($connection);
				return  $balanca;
			}else{
				$balancaBI->releaseConnection($connection);
				return NULL;
			}
		}catch(Exception $exc){
			$connection->rollBack();
			$this->connectionFactoryBI->releaseConnection($connection);
			echo $exc->getTraceAsString();
		}
			

	}

	public function vetorBalanca($cnpj){

		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$balancaBI = new BalancaBI($connection);

		try{
			$balancas = $balancaBI->buscarPorCnpj($cnpj);

			$key = array();
			foreach ($balancas as $balanca) {
				array_push($key, $balanca->getId());
			}

			if(!empty($key)){
				$balancaBI->releaseConnection($connection);
				return $key;
			}else{
				$balancaBI->releaseConnection($connection);
				return NULL;
			}
			
		}catch(Exception $exc){
			$connection->rollBack();
			$this->connectionFactoryBI->releaseConnection($connection);
			echo $exc->getTraceAsString();
		}
			

	}

	public function buscarBalanca($params, $cnpj){
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$balancaBI = new BalancaBI($connection);



		try{

			$balanca = $balancaBI->buscarBalanca($params, $cnpj);
			
			if(!is_null($balanca)){
				$balancaBI->releaseConnection($connection);
				return  $balanca;
			}else{
				$balancaBI->releaseConnection($connection);
				return NULL;
			}

		}catch(Exception $exc){
			$connection->rollBack();
			$this->connectionFactoryBI->releaseConnection($connection);
			echo $exc->getTraceAsString();
		}
	}

	private function montaObj($params){

		$balanca = new Balanca();
		
		$balanca->setQtde($params['qtde']);
		$balanca->setMarca($params['marca']);

		return $balanca;
	}

}
?>
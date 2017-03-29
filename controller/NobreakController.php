<?php

require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_ENTITIES.'Nobreak.class.php';
require_once PATH_MODEL_BI.      'NobreakBI.php';
require_once PATH_MODEL_BI.      'ConnectionFactoryBI.class.php';

class NobreakController{

	private $connectionFactoryBI;

	public function gravarNobreak($params, $cnpj){
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$nobreakBI = new NobreakBI($connection);

		try{
			$nobreak = new Nobreak();

			$nobreak->setCnpjEmp($cnpj);
			$nobreak->setQtde($params['qtde']);
			$nobreak->setMarca($params['marca']);
			if($params['serv'])
				$nobreak->setServ(1);
			else
				$nobreak->setServ(0);

			if($params['term'])
				$nobreak->setTerm(1);
			else
				$nobreak->setTerm(0);
			if($params['caixa'])
				$nobreak->setCaixa(1);
			else
				$nobreak->setCaixa(0);

			var_dump($nobreak);

			$nobreakBI->gravarNobreak($nobreak);
			$nobreakBI->releaseConnection($connection);

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
		$nobreakBI = new NobreakBI($connection);

		try{
			$nobreakBI->deletarPorId($id);

			$nobreakBI->releaseConnection($connection);
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
		$nobreakBI = new NobreakBI($connection);
		try{
			if($nobreak = $nobreakBI->buscarPorCnpj($cnpj)){
				$nobreakBI->releaseConnection($connection);
				return $nobreak;	
			}else{
				$nobreakBI->releaseConnection($connection);
				return NULL;
			}
		}catch(Exception $exc){
			$nobreakBI->rollBack();
          	$this->connectionFactoryBI()->releaseConnection($connection);
          	echo $exc->getTraceAsString();
		}
		 
	}
	
	public function vetorNobreak($cnpj){
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$nobreakBI = new NobreakBI($connection);
		try{
			$nobreaks = $nobreakBI->buscarPorCnpj($cnpj);

			$key = array();

			foreach ($nobreaks as $nobreak) {
				array_push($key, $nobreak->getId());
			}

			if(!empty($key)){
				$nobreakBI->releaseConnection($connection);
				return $key;	
			}else{
				$nobreakBI->releaseConnection($connection);
				return NULL;
			}
		}catch(Exception $exc){
			$nobreakBI->rollBack();
          	$this->connectionFactoryBI()->releaseConnection($connection);
          	echo $exc->getTraceAsString();
		}
		 
	}
	
	public function buscarNobreak($params, $cnpj){
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$nobreakBI = new NobreakBI($connection);
		try{
			if($nobreak = $nobreakBI->buscarNobreak($params, $cnpj)){
				$nobreakBI->releaseConnection($connection);
				return $nobreak;	
			}else{
				$nobreakBI->releaseConnection($connection);
				return NULL;
			}
		}catch(Exception $exc){
			$nobreakBI->rollBack();
          	$this->connectionFactoryBI()->releaseConnection($connection);
          	echo $exc->getTraceAsString();
		}
		 
	}

}
?>
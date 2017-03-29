<?php

require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_ENTITIES.'Ecf.class.php';
require_once PATH_MODEL_BI.      'EcfBI.php';
require_once PATH_MODEL_BI.      'ConnectionFactoryBI.class.php';

class EcfController{

	private $connectionFactoryBI;

	public function gravarEcf($params, $cnpj){

		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$ecfBI = new EcfBI($connection);

		try{
			$ecf = new Ecf();

			$ecf->setCnpjEmp($cnpj);
			$ecf->setQtde($params['qtde']);
			$ecf->setMarca($params['marca']);

			$ecfBI->gravarEcf($ecf);

			$ecfBI->releaseConnection($connection);
		}catch(Exception $exc) {
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
		$ecfBI = new EcfBI($connection);

		try{
			if($ecf=$ecfBI->buscarPorCnpj($cnpj)){
				$ecfBI->releaseConnection($connection);
				return $ecf;
			}else{
				$ecfBI->releaseConnection($connection);
				return NULL;
			}
		}catch(Exception $exc){
			$ecfBI->rollBack();
			$this->connectionFactoryBI->releaseConnection($connection);
			echo $exc->getTraceAsString();
		}
		 
	}

	public function deletarPorId($id){
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$ecfBI = new EcfBI($connection);

		try{
			$ecfBI->deletarPorId($id);

			$ecfBI->releaseConnection($connection);
		}catch(Exception $exc){
			$ecfBI->rollBack();
			$this->connectionFactoryBI->releaseConnection($connection);
			echo $exc->getTraceAsString();
		}
	}

	public function vetorEcfs($cnpj){
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$ecfBI = new EcfBI($connection);

		try{
			$ecfs=$ecfBI->buscarPorCnpj($cnpj);

			$key = array();
			
			foreach ($ecfs as $ecf) {
				array_push($key, $ecf->getId());
			}

			if(!empty($key)){
				$ecfBI->releaseConnection($connection);
				return $key;
			}else{
				$ecfBI->releaseConnection($connection);
				return NULL;
			}
		}catch(Exception $exc){
			$ecfBI->rollBack();
			$this->connectionFactoryBI->releaseConnection($connection);
			echo $exc->getTraceAsString();
		}

		 
	}

	public function buscarEcf($params, $cnpj){
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$ecfBI = new EcfBI($connection);

		try{
			if($ecf=$ecfBI->buscarEcf($params, $cnpj)){
				$ecfBI->releaseConnection($connection);
				return $ecf;
			}else{
				$ecfBI->releaseConnection($connection);
				return NULL;
			}
		}catch(Exception $exc){
			$ecfBI->rollBack();
			$this->connectionFactoryBI->releaseConnection($connection);
			echo $exc->getTraceAsString();
		}
	}
}
?>
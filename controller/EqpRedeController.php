<?php

require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_ENTITIES.'EqpRede.class.php';
require_once PATH_MODEL_BI.      'EqpRedeBI.php';
require_once PATH_MODEL_BI.      'ConnectionFactoryBI.class.php';

class EqpRedeController{

	private $connectionFactoryBI;

	public function gravarEqpRede($params, $cnpj){

		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$eqpRedeBI = new EqpRedeBI($connection);

		try{
			$eqpRede = new EqpRede();

			$eqpRede->setCnpjEmp($cnpj);
			$eqpRede->setQtde($params['qtde']);
			$eqpRede->setMarca($params['marca']);

			$eqpRedeBI->gravarEqpRede($eqpRede);
			$eqpRedeBI->releaseConnection($connection);

		}catch(Exception $exc) {
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
		$eqpRedeBI = new EqpRedeBI($connection);

		try{
			$eqpRedeBI->deletarPorId($id);

			$eqpRedeBI->releaseConnection($connection);
		}catch(Exception $exc) {
        	$connection->rollBack();
         	$this->connectionFactoryBI()->releaseConnection($connection);
          	echo $exc->getTraceAsString();
        }
	}

	public function vetorEqpRedes($cnpj){

		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$eqpRedeBI = new EqpRedeBI($connection);

		try{
			$eqpRedes = $eqpRedeBI->buscarPorCnpj($cnpj);

			$key = array();
			
			foreach ($eqpRedes as $eqpRede) {
				array_push($key, $eqpRede->getId());
			}

			if(!empty($key)){
				$eqpRedeBI->releaseConnection($connection);
				return $key;
			}else{
				$eqpRedeBI->releaseConnection($connection);
				return NULL;
			}
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
		$eqpRedeBI = new EqpRedeBI($connection);

		try{
			if($eqpRede = $eqpRedeBI->buscarPorCnpj($cnpj)){
				$eqpRedeBI->releaseConnection($connection);
				return $eqpRede;
			}else{
				$eqpRedeBI->releaseConnection($connection);
				return NULL;
			}
		}catch(Exception $exc){
			$eqpRedeBI->rollBack();
			$this->connectionFactoryBI->releaseConnection($connection);
			$exc->getTraceAsString();
		}
		 
	}
	public function buscarEqpRede($params, $cnpj){
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$eqpRedeBI = new EqpRedeBI($connection);

		try{
			if($eqpRede = $eqpRedeBI->buscarEqpRede($params, $cnpj)){
				$eqpRedeBI->releaseConnection($connection);
				return $eqpRede;
			}else{
				$eqpRedeBI->releaseConnection($connection);
				return NULL;
			}
		}catch(Exception $exc){
			$eqpRedeBI->rollBack();
			$this->connectionFactoryBI->releaseConnection($connection);
			$exc->getTraceAsString();
		}
		 
	}

}
?>

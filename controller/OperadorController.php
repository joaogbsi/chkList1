<?php

require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_ENTITIES.'Operador.class.php';
require_once PATH_MODEL_BI.      'OperadorBI.php';
require_once PATH_MODEL_BI.      'ConnectionFactoryBI.class.php';

class OperadorController{

	private $ConnectionFactoryBI;

	public function gravarOperador($params, $cnpj){

		if(is_null($this->ConnectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI;
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$operadorBI = new OperadorBI($connection);

		try{

			$operador = new Operador();

			$operador->setCnpjEmp($cnpj);
			$operador->setCpf($params['cpf']);
			$operador->setNome($params['nome']);
			$operador->setTurno($params['turno']);
			if($params['descAcr'])
				$operador->setDescAcr(1);
			else
				$operador->setDescAcr(0);
			if($params['cancelar'])
				$operador->setCancelar(1);
			else
				$operador->setCancelar(0);
			if($params['liberar'])
				$operador->setLiberar(1);
			else
				$operador->setLiberar(0);
			if($params['redZ'])
				$operador->setRedZ(1);
			else
				$operador->setRedZ(0);
			if($params['suprSang'])
				$operador->setSuprSang(1);
			else
				$operador->setSuprSang(0);
			
			$operadorBI->gravarOperador($operador);
			$operadorBI->releaseConnection($connection);
		}catch(Exception $exc){
			$connection->rollBack();
			$this->connectionFactoryBI()->releaseConnection($connection);
			echo $exc->getTraceAsString();
		}
	}

	public function deletarPorId($id){
		if(is_null($this->ConnectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI;
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$operadorBI = new OperadorBI($connection);

		try{
			$operadorBI->deletarPorId($id);

			$operadorBI->releaseConnection($connection);
		}catch(Exception $exc){
			$connection->rollBack();
			$this->connectionFactoryBI()->releaseConnection($connection);
			echo $exc->getTraceAsString();
		}
	}

	public function buscarPorCnpj($cnpj){
		if(is_null($this->ConnectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI;
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$operadorBI = new OperadorBI($connection);

		try{
			if(!is_null($operador = $operadorBI->buscarPorCnpj($cnpj))){
				$operadorBI->releaseConnection($connection);
				return $operador;
			}else{
				$operadorBI->releaseConnection($connection);
				return NULL;
			}
		
		}catch(Exception $exc){
			$operadorBI->rollBack();
			$this->connectionFactoryBI->releaseConnection($connection);
			$exc->getTraceAsString();
		}
		 
	}

	public function buscarOperdador($params, $cnpj){
		if(is_null($this->ConnectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI;
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$operadorBI = new OperadorBI($connection);

		try{
			if(!is_null($operador = $operadorBI->buscarOperdador($params, $cnpj))){
				$operadorBI->releaseConnection($connection);
				return $operador;
			}else{

			}
		
		}catch(Exception $exc){
			$operadorBI->rollBack();
			$this->connectionFactoryBI->releaseConnection($connection);
			$exc->getTraceAsString();
		}
		 
	}

	public function vetorOperador($cnpj){
		if(is_null($this->ConnectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI;
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$operadorBI = new OperadorBI($connection);

		try{
			$operadores = $operadorBI->buscarPorCnpj($cnpj);
			var_dump($operadores);
			$key = array();

			foreach ($operadores as $operador) {
				array_push($key, $operador->getId());
			}

			if (!empty($key)){
				$operadorBI->releaseConnection($connection);
				return $key;
			}else{
				$operadorBI->releaseConnection($connection);
				return NULL;				
			}
		}catch(Exception $exc){
			$operadorBI->rollBack();
			$this->connectionFactoryBI->releaseConnection($connection);
			$exc->getTraceAsString();
		}
	}
}
?>
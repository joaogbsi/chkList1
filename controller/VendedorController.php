<?php

require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_ENTITIES.'Vendedor.class.php';
require_once PATH_MODEL_BI.      'VendedorBI.php';
require_once PATH_MODEL_BI.      'ConnectionFactoryBI.class.php';

class VendedorController{

	private $connectionFactoryBI;

	public function gravarVendedor($params, $cnpj){
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI;
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$vendedorBI = new VendedorBI($connection);

		try{
			$vendedor = new Vendedor();

			$vendedor->setCnpjEmp($cnpj);
			$vendedor->setCpf($params['cpf']);
			$vendedor->setNome($params['nome']);
			$vendedor->setCodigo($params['codigo']);
			if($params['desconto'])
				$vendedor->setDesconto(1);
			else
				$vendedor->setDesconto(0);
			if($params['comissao'])
				$vendedor->setComissao(1);
			else
				$vendedor->setComissao(0);

			var_dump($vendedor);

			$vendedorBI->gravarVendedor($vendedor);
			$vendedorBI->releaseConnection($connection);

		}catch(Exception $exc){
			$connection->rollBack();
			$this->connectionFactoryBI()->releaseConnection($connection);
			echo $exc->getTraceAsString();
		}
	}

	public function deletarPorId($id){
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI;
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$vendedorBI = new VendedorBI($connection);
		try{
			$vendedorBI->deletarPorId($id);

			$vendedorBI->releaseConnection($connection);
		}catch(Exception $exc){
			$connection->rollBack();
			$this->connectionFactoryBI()->releaseConnection($connection);
			echo $exc->getTraceAsString();
		}
	}

	public function buscarPorCnpj($cnpj){
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI;
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$vendedorBI = new VendedorBI($connection);
		try{
			if(!is_null($vendedor = $vendedorBI->buscarPorCnpj($cnpj))){
				$vendedorBI->releaseConnection($connection);
				return $vendedor;
			}else{
				$vendedorBI->releaseConnection($connection);
				return NULL;

			}
		}catch(Exception $exc){
			$vendedorBI->rollBack();
			$this->connectionFactoryBI->releaseConnection($connection);
			$exc->getTraceAsString();
		}
		 
	}
	
	public function buscarVendedor($params, $cnpj){
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI;
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$vendedorBI = new VendedorBI($connection);
		try{
			if(!is_null($vendedor = $vendedorBI->buscarVendedor($params, $cnpj))){
				$vendedorBI->releaseConnection($connection);
				return $vendedor;
			}else{
				$vendedorBI->releaseConnection($connection);
				return NULL;

			}
		}catch(Exception $exc){
			$vendedorBI->rollBack();
			$this->connectionFactoryBI->releaseConnection($connection);
			$exc->getTraceAsString();
		}
		 
	}

	public function vetorVendedor($cnpj){
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI;
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$vendedorBI = new VendedorBI($connection);
		try{
			$vendedores = $vendedorBI->buscarPorCnpj($cnpj);

			$key = array();

			foreach ($vendedores as $vendedor) {
				array_push($key, $vendedor->getId());
			}

			if(!empty($key)){
				$vendedorBI->releaseConnection($connection);
				return $key;
			}else{
				$vendedorBI->releaseConnection($connection);
				return NULL;
			}
		}catch(Exception $exc){
			$vendedorBI->rollBack();
			$this->connectionFactoryBI->releaseConnection($connection);
			$exc->getTraceAsString();
		}
	}

}

?>
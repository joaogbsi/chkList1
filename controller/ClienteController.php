<?php

require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_ENTITIES.'Cliente.class.php';
require_once PATH_MODEL_BI.      'ClienteBi.php';
require_once PATH_MODEL_BI.      'ConnectionFactoryBI.class.php';

class ClienteController{

	private $connectionFactoryBI;
  

	public function gravarCliente($params){
		
		if (is_null($this->connectionFactoryBI)) {
        	$this->connectionFactoryBI = new ConnectionFactoryBI();
        }

        $connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);

        $clienteBi = new ClienteBi($connection);
		try{
			$cliente = new Cliente();
			$cliente->setCnpj($params['cnpj']);
			$cliente->setEmpresa($params['empresa']);
			$cliente->setTelefone($params['telefone']);
			$cliente->setEmail($params['email']);
			$cliente->setRespSistema($params['respSistema']);
			$cliente->setNUsuario($params['nUsuario']);
			$cliente->setLoja($params['loja']);
			$cliente->setFilial($params['filial']);
			$cliente->setRegime($params['regime']);
			$cliente->setFiscal($params['fiscal']);
			$cliente->setNFiscal($params['nFiscal']);
			$cliente->setRamo($params['ramo']);

			$clienteBi->adicionarCliente($cliente);

			$clienteBi->releaseConnection($connection);

		}catch(Exception $exc) {
          $connection->rollBack();
          $this->connectionFactoryBI()->releaseConnection($connection);
          echo $exc->getTraceAsString();
        }
	}

	public function recebeClientes(){
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(FALSE);

		$clienteBi = new ClienteBi($connection);

		if(!is_null($clientes=$clienteBi->recebeClientes())){
			$clienteBi->releaseConnection($connection);
			return $clientes;
		}else{
			$clienteBi->releaseConnection($connection);
			return NULL;

		}
	}

	public function lerCliente($cnpj){
		echo 'teste<br />';
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(FALSE);

		$clienteBi = new ClienteBi($connection);

		if(!is_null($clientes=$clienteBi->lerCliente($cnpj))){
			$clienteBi->releaseConnection($connection);
			return $cliente;
		}else{
			$clienteBi->releaseConnection($connection);
			return NULL;

		}
	}
}
?>
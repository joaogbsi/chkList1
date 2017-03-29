<?php

require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_ENTITIES.'Computador.class.php';
require_once PATH_MODEL_BI.      'ComputadorBi.php';
require_once PATH_MODEL_BI.      'ConnectionFactoryBI.class.php';

class ComputadorController{

	private $connectionFactoryBI;

	public function gravarComputador($params, $cnpj){

		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
			
		}
		
		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$computadorBI = new ComputadorBi($connection);

		try{
			$computador = new Computador();

			$computador = $this->montaObj($params);

			$computador->setCnpjEmp($cnpj);
			

			$computadorBI->gravaComputador($computador);

			$computadorBI->releaseConnection($connection);

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
		$computadorBI = new ComputadorBi($connection);

		try{
			//$computador = new Computador();

			$computadorBI->deletarPorId($id);

			$computadorBI->releaseConnection($connection);

		}catch(Exception $exc) {
        	$connection->rollBack();
         	$this->connectionFactoryBI()->releaseConnection($connection);
          	echo $exc->getTraceAsString();
        }
	}

	public function alterarComputador($params, $cnpj){
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
			
		}
		
		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$computadorBI = new ComputadorBi($connection);

		try{
			$computador = new Computador();

			$computador = $this->montaObj($params);

			$computador->setCnpjEmp($cnpj);
			

			$computadorBI->alterarComputador($computador);

			$computadorBI->releaseConnection($connection);

		}catch(Exception $exc) {
        	$connection->rollBack();
         	$this->connectionFactoryBI()->releaseConnection($connection);
          	echo $exc->getTraceAsString();
        }
	}

	public function lerComputador($cnpj){
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
			
		}
		
		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$computadorBI = new ComputadorBi($connection);

		try{
			$computador=$computadorBI->lerComputador($cnpj);

		if(!is_null($computador)){
			$computadorBI->releaseConnection($connection);
			return $computador;
		}else{
			$computadorBI->releaseConnection($connection);
			return NULL;
		}
		}catch(Exception $exc) {
          $connection->rollBack();
          $this->connectionFactoryBI()->releaseConnection($connection);
          echo $exc->getTraceAsString();
		}
		 
	}


	public function vetorComputadores($cnpj){
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
			
		}
		
		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$computadorBI = new ComputadorBi($connection);

		try{
			$computadores=$this->lerComputador($cnpj);

			$key = array();
			foreach ($computadores as $computador) {
				array_push($key, $computador->getId());
			}

		if(!is_null($computador)){
			$computadorBI->releaseConnection($connection);
			return $key;
		}else{
			$computadorBI->releaseConnection($connection);
			return NULL;
		}
		}catch(Exception $exc) {
          $connection->rollBack();
          $this->connectionFactoryBI()->releaseConnection($connection);
          echo $exc->getTraceAsString();
		}
		 
	}

	public function buscarComputador($params, $cnpj){
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
			
		}
		
		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$computadorBI = new ComputadorBi($connection);

		try{
			$computador=$computadorBI->buscarComputador($params, $cnpj);

		if(!is_null($computador)){
			$computadorBI->releaseConnection($connection);
			return $computador;
		}else{
			$computadorBI->releaseConnection($connection);
			return NULL;
		}
		}catch(Exception $exc) {
          $connection->rollBack();
          $this->connectionFactoryBI()->releaseConnection($connection);
          echo $exc->getTraceAsString();
		}
	}

	private function montaObj($params){

		$computador = new Computador();

		$computador->setQtde($params['qtde']);
		$computador->setDescricao($params['descricao']);
		$computador->setSistOp($params['sistOp']);
		$computador->setHd($params['hd']);
		$computador->setMemoria($params['memoria']);

		if($params['serial']){
				$computador->setSerial(1);
		}else{
			$computador->setSerial(0);
		}
		if($params['serv']){
			$computador->setServ(1);
		}else{
			$computador->setServ(0);
		}
		if($params['term']){
			$computador->setTerm(1);
		}else{
			$computador->setTerm(0);
		}
		if($params['caixa']){
			$computador->setCaixa(1);
		}else{
			$computador->setCaixa(0);
		}

		return $computador;
	}
}
?>
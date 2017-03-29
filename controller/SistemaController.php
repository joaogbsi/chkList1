<?php

require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_ENTITIES.'Sistema.class.php';
require_once PATH_MODEL_BI.      'SistemaBI.php';
require_once PATH_MODEL_BI.      'ConnectionFactoryBI.class.php';

class SistemaController{

	private $connectionFactoryBI;

	public function gravarSistema($params, $cnpj){
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI;
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$sistemaBI = new SistemaBI($connection);


		try{

			$sistema = $this->montarObj($params);

			$sistema->setCnpjEmp ($cnpj);
									
			$sistemaBI->gravarSistema($sistema);
			$sistemaBI->releaseConnection($connection);

		}catch(Exception $exc){
			$connection->rollBack();
			$this->connectionFactoryBI()->releaseConnection($connection);
			echo $exc->getTraceAsString();
		}
	}

	public function alterarSistema($params, $cnpj){
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI;
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$sistemaBI = new SistemaBI($connection);


		try{

			$sistema = $this->montarObj($params);

			$sistema->setCnpjEmp ($cnpj);
									
			$sistemaBI->alterarSistema($sistema, $cnpj);
			$sistemaBI->releaseConnection($connection);

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
		$sistemaBI = new SistemaBI($connection);

		try{
			if(!is_null($sistema = $sistemaBI->buscarPorCnpj($cnpj))){
				$sistemaBI->releaseConnection($connection);
				return $sistema;
			}else{
				$sistemaBI->releaseConnection($connection);
				return NULL;
			}
		}catch(Exception $exc){
			$connection->rollBack();
			$this->connectionFactoryBI()->releaseConnection($connection);
			echo $exc->getTraceAsString();
		}
		 
	}

	private function montarObj($params){
		$sistema = new Sistema();

		if($params['intellicashFull'])
			$sistema->setIntellicashFull(1);
		else
			$sistema->setIntellicashFull(0);

		if($params['intellicashLight'])
			$sistema->setIntellicashLight(1);
		else
			$sistema->setIntellicashLight(0);

		if($params['easycash'])
			$sistema->setEasycash(1);
		else
			$sistema->setEasycash(0);

		if($params['gnfe'])
			$sistema->setGnfe(1);
		else
			$sistema->setGnfe(0);

		if($params['cotacao'])
			$sistema->setCotacao(1);
		else
			$sistema->setCotacao(0);

		if($params['intelligroup'])
			$sistema->setIntelligroup(1);
		else
			$sistema->setIntelligroup(0);

		if($params['intellistock'])
			$sistema->setIntellistock(1);
		else
			$sistema->setIntellistock(0);

		if($params['vendaAssistida'])
			$sistema->setVendaAssistida(1);
		else
			$sistema->setVendaAssistida(0);

		if($params['orcamento'])
			$sistema->setOrcamento(1);
		else
			$sistema->setOrcamento(0);

		if($params['pedido'])
			$sistema->setPedido(1);
		else
			$sistema->setPedido(0);

		if($params['produto'])
			$sistema->setProduto(1);
		else
			$sistema->setProduto(0);

		if($params['edi'])
			$sistema->setEdi(1);
		else
			$sistema->setEdi(0);

		if($params['mgMobile'])
			$sistema->setMgMobile(1);
		else
			$sistema->setMgMobile(0);

		if($params['nfDestinada'])
			$sistema->setNfDestinada(1);
		else
			$sistema->setNfDestinada(0);

		if($params['contasPgRc'])
			$sistema->setContasPgRc(1);
		else
			$sistema->setContasPgRc(0);

		if($params['sincronizador'])
			$sistema->setSincronizador(1);
		else
			$sistema->setSincronizador(0);

		if($params['entregaCega'])
			$sistema->setEntregaCega(1);
		else
			$sistema->setEntregaCega(0);
		
		if($params['cte'])
			$sistema->setCte(1);
		else
			$sistema->setCte(0);

		return $sistema;
	}
}

?>
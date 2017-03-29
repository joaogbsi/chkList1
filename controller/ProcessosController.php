<?php
require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_ENTITIES.'Processos.class.php';
require_once PATH_MODEL_BI.'ProcessosBI.php';
require_once PATH_MODEL_BI.'ConnectionFactoryBI.class.php';

class ProcessosController{

	private $connectionFactoryBI;

	public function gravarProcessos($params, $cnpj){

		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$processosBI = new ProcessosBI($connection);

		try{
			$processos = $this->montarObj($params);

			$processos->setCnpjEmp($cnpj);
			
			$processosBI->gravarProcessos($processos);
			$processosBI->releaseConnection($connection);
		}catch(Exception $exc){
			$connection->rollback();
			$this->connectionFactoryBI->releaseConnection($connection);
			echo $exc->getTraceAsString();
		}
		 
	}

	public function alterarProcessos($params, $cnpj){

		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$processosBI = new ProcessosBI($connection);

		try{
			$processos = $this->montarObj($params);

			$processos->setCnpjEmp($cnpj);
			
			$processosBI->alterarProcessos($processos, $cnpj);
			$processosBI->releaseConnection($connection);
		}catch(Exception $exc){
			$connection->rollback();
			$this->connectionFactoryBI->releaseConnection($connection);
			echo $exc->getTraceAsString();
		}
		 
	}

	public function buscarPorCnpj($cnpj){
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$processosBI = new ProcessosBI($connection);

		try{
			if(!is_null($processos= $processosBI->buscarPorCnpj($cnpj))){
				$processosBI->releaseConnection($connection);
				return $processos;

			}else{
				$processosBI->releaseConnection($connection);
				return NULL;
			}
		}catch(Exception $exc){
			$connection->rollback();
			$this->connectionFactoryBI->releaseConnection($connection);
			echo $exc->getTraceAsString();
		}
		 
	}

	private function montarObj($params){
		$processos = new Processos();

		if(!is_null($params['qtdCadastro']) || !empty($params['qtdCadastro']))
			$processos->setQtdCadastro      ($params['qtdCadastro']);
		else
			$processos->setQtdCadastro      ('');
		
		if(!is_null($params['pessoaLanc']) || !empty($params['pessoaLanc']))
			$processos->setPessoaLanc      ($params['pessoaLanc']);
		else
			$processos->setPessoaLanc      ('');
		
		if(!is_null($params['lancPreco']) || !empty($params['lancPreco']))
			$processos->setLancPreco      ($params['lancPreco']);
		else
			$processos->setLancPreco      ('');
		
		if(!is_null($params['recebeMerc']) || !empty($params['recebeMerc']))
			$processos->setRecebeMerc      ($params['recebeMerc']);
		else
			$processos->setRecebeMerc      ('');
		
		if(!is_null($params['compraVenda']) || !empty($params['compraVenda']))
			$processos->setCompraVenda      ($params['compraVenda']);
		else
			$processos->setCompraVenda      ('');
		
		if(!is_null($params['fiscalVendas']) || !empty($params['fiscalVendas']))
			$processos->setFiscalVendas      ($params['fiscalVendas']);
		else
			$processos->setFiscalVendas      ('');
		
		$processos->setFechamentoDiario      ($params['fechamentoDiario']);
		
		
		if(!is_null($params['respFechamento']) || !empty($params['respFechamento']))
			$processos->setRespFechamento      ($params['respFechamento']);
		else
			$processos->setRespFechamento      ('');
		
		if(!is_null($params['respFinanceiro']) || !empty($params['respFinanceiro']))
			$processos->setRespFinanceiro      ($params['respFinanceiro']);
		else
			$processos->setRespFinanceiro      ('');
		

		return $processos; 
	}
}
?>
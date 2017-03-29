<?php

require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_ENTITIES.'Empresa.class.php';
require_once PATH_MODEL_BI.      'EmpresaBI.php';
require_once PATH_MODEL_BI.      'ConnectionFactoryBI.class.php';

class EmpresaController{

	private $connectionFactoryBI;
  

	public function gravarEmpresa($params){
		
		if (is_null($this->connectionFactoryBI)) {
        	$this->connectionFactoryBI = new ConnectionFactoryBI();
        }

        $connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);

        $empresaBi = new EmpresaBi($connection);
		try{
			$empresa = $this->montarObj($params);

			$empresaBi->adicionarEmpresa($empresa);

			$empresaBi->releaseConnection($connection);

		}catch(Exception $exc) {
          $connection->rollBack();
          $this->connectionFactoryBI()->releaseConnection($connection);
          echo $exc->getTraceAsString();
        }
	}

	public function recebeEmpresas(){
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(FALSE);

		$empresaBi = new empresaBi($connection);

		if(!is_null($empresas=$empresaBi->recebeempresas())){
			$empresaBi->releaseConnection($connection);
			return $empresas;
		}else{
			$empresaBi->releaseConnection($connection);
			return NULL;

		}
	}

	public function buscarEmpresa($cnpj){

		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(FALSE);

		$empresaBi = new empresaBi($connection);

		$empresa=$empresaBi->buscarEmpresa($cnpj);

		if(!is_null($empresa)){
			$empresaBi->releaseConnection($connection);
			return $empresa;
		}else{
			$empresaBi->releaseConnection($connection);
			return NULL;

		}
	}

	public function alterarEmpresa($params){

		if (is_null($this->connectionFactoryBI)) {
        	$this->connectionFactoryBI = new ConnectionFactoryBI();
        }

        $connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);

        $empresaBi = new EmpresaBi($connection);
		try{
			$empresa = $this->montarObj($params);

			$empresaBi->alterarEmpresa($empresa, $params['cnpj']);

			$empresaBi->releaseConnection($connection);

		}catch(Exception $exc) {
          $connection->rollBack();
          $this->connectionFactoryBI()->releaseConnection($connection);
          echo $exc->getTraceAsString();
        }
	}

	private function montarObj($params){

		$empresa = new Empresa();

			$empresa->setCnpj($params['cnpj']);
			$empresa->setEmpresa($params['empresa']);
			$empresa->setTelefone($params['telefone']);
			$empresa->setEmail($params['email']);
			$empresa->setRespSistema($params['respSistema']);
			$empresa->setNUsuario($params['nUsuario']);
			$empresa->setLoja($params['loja']);
			$empresa->setFilial($params['filial']);
			$empresa->setRegime($params['regime']);

			if($params['nFiscal'])
				$empresa->setNFiscal(1) ;
			else
				$empresa->setNFiscal(0) ;

			$empresa->setRamo($params['ramo']);
			
			if($params['sintegra'])
				$empresa->setSintegra(1);
			else
				$empresa->setSintegra(0);
			
			if($params['spedFiscal'])
				$empresa->setSpedFiscal(1);
			else
				$empresa->setSpedFiscal(0);
			
			if($params['spedPis'])
				$empresa->setSpedPis(1);
			else
				$empresa->setSpedPis(0);

		return $empresa;
	}
}
?>
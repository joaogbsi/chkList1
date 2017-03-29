<?php
require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_ENTITIES.'Remoto.class.php';
require_once PATH_MODEL_BI.'RemotoBI.php';
require_once PATH_MODEL_BI.'ConnectionFactoryBI.class.php';

class RemotoController{

	private $connectionFactoryBI;

	public function gravarRemoto($params, $cnpj){
		echo 'remotoController';

		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$remotoBI = new RemotoBI($connection);

		try{
			
			$remoto = $this->montaObj($params);

			$remoto->setCnpjEmp($cnpj);
			//var_dump($cnpj);
			
			$remotoBI->gravarRemoto($remoto);
			$remotoBI->releaseConnection($connection);
	    }catch(Exception $exc){
	    	$connection->rollback();
	    	$this->connectionFactoryBI()->releaseConnection($connection);
			echo $exc->getTraceAsString();
	    }
		 
	}

	public function alterarRemoto($params, $cnpj){
		
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$remotoBI = new RemotoBI($connection);

		try{
			
			$remoto = $this->montaObj($params);

			$remoto->setCnpjEmp($cnpj);
			//var_dump($cnpj);
			
			$remotoBI->alterarRemoto($remoto, $cnpj);
			$remotoBI->releaseConnection($connection);
	    }catch(Exception $exc){
	    	$connection->rollback();
	    	$this->connectionFactoryBI()->releaseConnection($connection);
			echo $exc->getTraceAsString();
	    }
		 
	}

	public function buscarPorCnpj($cnpj){
		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI();
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$remotoBI = new RemotoBI($connection);

		try{
			if(!is_null($remoto=$remotoBI->buscarPorCnpj($cnpj))){
				$remotoBI->releaseConnection($connection);
				return $remoto;

			}else{
				$remotoBI->releaseConnection($connection);
				return NULL;
			}
		}catch(Exception $exc){
			$connection->rollback();
	    	$this->connectionFactoryBI()->releaseConnection($connection);
			echo $exc->getTraceAsString();
		}
		 
	}

	private function montaObj($params){
		$remoto = new Remoto();

		
		//var_dump($cnpj);
		/*if($params['recebeAcesso'])
			$remoto->setRecebeAcesso(1);
		else
			$remoto->setRecebeAcesso(0);
		if($params['interligaFilial'])
			$remoto->setInterligaFilial(1);
		else
			$remoto->setInterligaFilial(0);*/
		$remoto->setRecebeAcesso($params['recebeAcesso']);
		$remoto->setInterligaFilial($params['interligaFilial']);
		//$remoto->setRecebeAcesso($params['recebeAcesso']);
		if(strlen($params['ipFixo']) != 0)
			$remoto->setIpFixo($params['ipFixo']);

		return $remoto;

	}

}

?>
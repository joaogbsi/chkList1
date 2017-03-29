<?php
require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_ENTITIES.'OutraInf.class.php';
require_once PATH_MODEL_BI.      'OutraInfBI.php';
require_once PATH_MODEL_BI.      'ConnectionFactoryBI.class.php';

class OutraInfController{

	private $connectionFactoryBI;

	public function gravarOutraInf($params, $cnpj){
		echo 'OutraInfController <br />';

		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI;
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$outraInfBI = new OutraInfBI($connection);

		try{
			
			$outraInf = $this->montaObj($params);

			$outraInf->setCnpjEmp         ($cnpj);
			

			$outraInfBI->gravarOutraInf($outraInf);
			$outraInfBI->releaseConnection($connection);

		}catch(Exception $exc){
			$connection->rollBack();
			$this->connectionFactoryBI()->releaseConnection($connection);
			echo $exc->getTraceAsString();
		}
	}

	public function alterarOutraInf($params, $cnpj){

		if(is_null($this->connectionFactoryBI)){
			$this->connectionFactoryBI = new ConnectionFactoryBI;
		}

		$connection = $this->connectionFactoryBI->createConnectionWithTransaction(false);
		$outraInfBI = new OutraInfBI($connection);

		try{
			
			$outraInf = $this->montaObj($params);

			$outraInf->setCnpjEmp         ($cnpj);

			$outraInfBI->alterarOutraInf($outraInf, $cnpj);
			$outraInfBI->releaseConnection($connection);

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
		$outraInfBI = new OutraInfBI($connection);

		try{
			if(!is_null($outraInf = $outraInfBI->buscarPorCnpj($cnpj))){
				$outraInfBI->releaseConnection($connection);
				return $outraInf;
			}else{
				$outraInfBI->releaseConnection($connection);
				return NULL;
			}
		}catch(Exception $exc){
			$connection->rollBack();
			$this->connectionFactoryBI->releaseConnection($connection);
			$exc->getTraceAsString();
		}
		 
	}

	private function montaObj($params){

		    $outraInf = new OutraInf();

			if(is_null($params['certDigital'])){
				$outraInf->setCertDigital('');
			}else{
				$outraInf->setCertDigital     ($params['certDigital']);
			}
			//$outraInf->setCertDigital     ($params['certDigital']);
			
			if(is_null($params['tipoInternet'])){
				$outraInf->setTipoInternet('');
			}else if(strcmp($params['tipoInternet'], 'internetOutras') != 0){
				$outraInf->setTipoInternet     ($params['tipoInternet']);
				$outraInf->setQualInternet('');
			}else{				
				$outraInf->setTipoInternet     ($params['tipoInternet']);
				if(is_null($params['qualInternet'])){
					$outraInf->setQualInternet('');
				}else {
					$outraInf->setQualInternet     ($params['qualInternet']);

				}
			}
			//$outraInf->setTipoInternet     ($params['tipoInternet']);
			

			//$outraInf->setQualInternet    ($params['qualInternet']);
			
			if(is_null($params['buscaPreco'])){
				$outraInf->setBuscaPreco('');
			}else{
				$outraInf->setBuscaPreco     ($params['buscaPreco']);
			}
			//$outraInf->setBuscaPreco      ($params['buscaPreco']);

			if(is_null($params['impEtiqueta'])){
				$outraInf->setImpEtiqueta('');
			}else{
				$outraInf->setImpEtiqueta     ($params['impEtiqueta']);
			}
			//$outraInf->setImpEtiqueta     ($params['impEtiqueta']);

			if(is_null($params['marcaTef'])){
				$outraInf->setMarcaTef('');
			}else{
				$outraInf->setMarcaTef     ($params['marcaTef']);
			}
			//$outraInf->setMarcaTef        ($params['marcaTef']);

			if(is_null($params['tipoTef'])){
				$outraInf->setTipoTef('');
			}else{
				$outraInf->setTipoTef     ($params['tipoTef']);
			}
			//$outraInf->setTipoTef         ($params['tipoTef']);

			if($params['impressora'])
				$outraInf->setImpressora      (1);
			else
				$outraInf->setImpressora      (0);

			if($params['colDados'])
				$outraInf->setColDados        (1);
			else
				$outraInf->setColDados        (0);

			if(is_null($params['leitorMesaMarca'])){
				$outraInf->setLeitorMesaMarca('');
			}else{
				$outraInf->setLeitorMesaMarca     ($params['leitorMesaMarca']);
			}
			//$outraInf->setLeitorMesaMarca ($params['leitorMesaMarca']);

			if(is_null($params['leitorMesaQtd'])){
				$outraInf->setLeitorMesaQtd('');
			}else{
				$outraInf->setLeitorMesaQtd     ($params['leitorMesaQtd']);	
			}
			//$outraInf->setLeitorMesaQtd   ($params['leitorMesaQtd']);

			if($params['leitorMesaUsb'])
				$outraInf->setLeitorMesaUsb   (1);
			else
				$outraInf->setLeitorMesaUsb   (0);

			if(is_null($params['leitorMaoMarca'])){
				$outraInf->setLeitorMaoMarca('');
			}else{
				$outraInf->setLeitorMaoMarca     ($params['leitorMaoMarca']);
			}	
			//$outraInf->setLeitorMaoMarca  ($params['leitorMaoMarca']);

			if(is_null($params['leitorMaoQtd'])){
				$outraInf->setLeitorMaoQtd('');
			}else{
				$outraInf->setLeitorMaoQtd     ($params['leitorMaoQtd']);
			}
			//$outraInf->setLeitorMaoQtd    ($params['leitorMaoQtd']);

			if($params['leitorMaoUsb'])
				$outraInf->setLeitorMaoUsb    (1);
			else
				$outraInf->setLeitorMaoUsb    (0);

			if(is_null($params['palmMarca'])){
				$outraInf->setPalmMarca('');
			}else{
				$outraInf->setPalmMarca     ($params['palmMarca']);
			}
			//$outraInf->setPalmMarca       ($params['palmMarca']);


			if(is_null($params['palmQtd'])){
				$outraInf->setPalmQtd('');
			}else{
				$outraInf->setPalmQtd     ($params['palmQtd']);
			}
			//$outraInf->setPalmQtd         ($params['palmQtd']);

			if(is_null($params['palmSO'])){
				$outraInf->setPalmSO('');
			}else{
				$outraInf->setPalmSO     ($params['palmSO']);
			}
			//$outraInf->setPalmSO          ($params['palmSO']);

			if(is_null($params['nomeSistema'])){
				$outraInf->setNomeSistema('');
			}else{
				$outraInf->setNomeSistema     ($params['nomeSistema']);
			}	
			//$outraInf->setNomeSistema     ($params['nomeSistema']);

			return $outraInf;
	}
}
?>
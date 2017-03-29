<?php

require_once PATH_MODEL_ENTITIES."OutraInf.class.php";

class OutraInfDAO{

	public function __construct($connection){
		$this->connection = $connection;
	}

	public function inserirOutraInf(OutraInf $outraInf){
		try{

			$sql = "INSERT INTO tb_outrasInfo(
				cnpjEmp,
				certDigital,
				tipoInternet,
				qualInternet,
				buscaPreco,
				impEtiqueta,
				marcaTef,
				tipoTef,
				impressora,
				colDados,
				leitorMesaMarca,
				leitorMesaQtd,
				leitorMesaUsb,
				leitorMaoMarca,
				leitorMaoQtd,
				leitorMaoUsb,
				palmMarca,
				palmQtd,
				palmSO,
				nomeSistema
			) VALUES (
				:cnpjEmp,
				:certDigital,
				:tipoInternet,
				:qualInternet,
				:buscaPreco,
				:impEtiqueta,
				:marcaTef,
				:tipoTef,
				:impressora,
				:colDados,
				:leitorMesaMarca,
				:leitorMesaQtd,
				:leitorMesaUsb,
				:leitorMaoMarca,
				:leitorMaoQtd,
				:leitorMaoUsb,
				:palmMarca,
				:palmQtd,
				:palmSO,
				:nomeSistema
			)";

			$params = array(
				'cnpjEmp' =>         $outraInf->getCnpjEmp(),
				'certDigital' =>     $outraInf->getCertDigital(),
				'tipoInternet' =>    $outraInf->getTipoInternet(),
				'qualInternet' =>    $outraInf->getQualInternet(),
				'buscaPreco' =>      $outraInf->getBuscaPreco(),
				'impEtiqueta' =>     $outraInf->getImpEtiqueta(),
				'marcaTef' =>        $outraInf->getMarcaTef(),
				'tipoTef' =>         $outraInf->getTipoTef(),
				'impressora' =>      $outraInf->getImpressora(),
				'colDados' =>        $outraInf->getColDados(),
				'leitorMesaMarca' => $outraInf->getLeitorMesaMarca(),
				'leitorMesaQtd' =>   $outraInf->getLeitorMesaQtd(),
				'leitorMesaUsb' =>   $outraInf->getLeitorMesaUsb(),
				'leitorMaoMarca' =>  $outraInf->getLeitorMaoMarca(),
				'leitorMaoQtd' =>    $outraInf->getLeitorMaoQtd(),
				'leitorMaoUsb' =>    $outraInf->getLeitorMaoUsb(),
				'palmMarca'=>        $outraInf->getPalmMarca(),
				'palmQtd' =>         $outraInf->getPalmQtd(),
				'palmSO' =>          $outraInf->getPalmSO(),
				'nomeSistema' =>     $outraInf->getNomeSistema()
			);

			var_dump($params);

			$stmt = $this->connection->prepare($sql);

			if($stmt->execute($params))
				return TRUE;
			else
				return NULL;

		}catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}	

	public function alterarOutraInf(OutraInf $outraInf, $cnpj){
		try{
			$sql = "UPDATE `tb_outrasinfo` SET 
			certDigital = :certDigital,
			tipoInternet = :tipoInternet,
			qualInternet = :qualInternet,
			buscaPreco = :buscaPreco,
			impEtiqueta = :impEtiqueta,
			marcaTef = :marcaTef,
			tipoTef = :tipoTef,
			impressora = :impressora,
			colDados = :colDados,
			leitorMesaMarca = :leitorMesaMarca,
			leitorMesaQtd = :leitorMesaQtd,
			leitorMesaUsb = :leitorMesaUsb,
			leitorMaoMarca = :leitorMaoMarca,
			leitorMaoQtd = :leitorMaoQtd,
			leitorMaoUsb = :leitorMaoUsb,
			palmMarca = :palmMarca,
			palmQtd = :palmQtd,
			palmSO = :palmSO,
			nomeSistema = :nomeSistema 
			WHERE tb_outrasinfo.cnpjEmp = " .$cnpj;

			$params = array(
				':certDigital' =>     $outraInf->getCertDigital(),
				':tipoInternet' =>    $outraInf->getTipoInternet(),
				':qualInternet' =>    $outraInf->getQualInternet(),
				':buscaPreco' =>      $outraInf->getBuscaPreco(),
				':impEtiqueta' =>     $outraInf->getImpEtiqueta(),
				':marcaTef' =>        $outraInf->getMarcaTef(),
				':tipoTef' =>         $outraInf->getTipoTef(),
				':impressora' =>      $outraInf->getImpressora(),
				':colDados' =>        $outraInf->getColDados(),
				':leitorMesaMarca' => $outraInf->getLeitorMesaMarca(),
				':leitorMesaQtd' =>   $outraInf->getLeitorMesaQtd(),
				':leitorMesaUsb' =>   $outraInf->getLeitorMesaUsb(),
				':leitorMaoMarca' =>  $outraInf->getLeitorMaoMarca(),
				':leitorMaoQtd' =>    $outraInf->getLeitorMaoQtd(),
				':leitorMaoUsb' =>    $outraInf->getLeitorMaoUsb(),
				':palmMarca'=>        $outraInf->getPalmMarca(),
				':palmQtd' =>         $outraInf->getPalmQtd(),
				':palmSO' =>          $outraInf->getPalmSO(),
				':nomeSistema' =>     $outraInf->getNomeSistema()
			);

			$stmt = $this->connection->prepare($sql);

			if($stmt->execute($params))
				return TRUE;
			else
				return NULL;
		}catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}

	public function encontrarPorCriterio($argumentos, $tabela, $criterio){
		try{
			$sql = "SELECT ".$argumentos." FROM ".$tabela." WHERE ".$criterio;
			
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()){
				while($row = $stmt->fetch ( PDO::FETCH_NAMED )){
					$outrasInf= $this->rowToOutrasInfo($row);
				}
				if(!empty($outrasInf))
					return $outrasInf;
			}else
				return NULL;
		}catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}

	private function rowToOutrasInfo($row){
		if (! is_null ( $row ) && $row ['cnpjEmp'] != NULL && $row ['cnpjEmp'] != ""){
			
			$outraInf = new OutraInf();

			$outraInf->setCnpjEmp($row['cnpjEmp']);
			$outraInf->setCertDigital($row['certDigital']);
			$outraInf->setTipoInternet($row['tipoInternet']);
			$outraInf->setQualInternet($row['qualInternet']);
			$outraInf->setBuscaPreco($row['buscaPreco']);
			$outraInf->setImpEtiqueta($row['impEtiqueta']);
			$outraInf->setMarcaTef($row['marcaTef']);
			$outraInf->setTipoTef($row['tipoTef']);
			$outraInf->setImpressora($row['impressora']);
			$outraInf->setColDados($row['colDados']);
			$outraInf->setLeitorMesaMarca($row['leitorMesaMarca']);
			$outraInf->setLeitorMesaQtd($row['leitorMesaQtd']);
			$outraInf->setLeitorMesaUsb($row['leitorMesaUsb']);
			$outraInf->setLeitorMaoMarca($row['leitorMaoMarca']);
			$outraInf->setLeitorMaoQtd($row['leitorMaoQtd']);
			$outraInf->setLeitorMaoUsb($row['leitorMaoUsb']);
			$outraInf->setPalmMarca($row['palmMarca']);
			$outraInf->setPalmQtd($row['palmQtd']);
			$outraInf->setPalmSO($row['palmSO']);
			$outraInf->setNomeSistema($row['nomeSistema']);
			return $outraInf;
		}
	}
}
?>
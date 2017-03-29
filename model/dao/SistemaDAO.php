<?php

require_once PATH_MODEL_ENTITIES."Sistema.class.php";

class SistemaDAO{

	public function __construct($connection){
		$this->connection = $connection;
	}

	public function inserirSistema(Sistema $sistema){
	
		try{
			$sql="INSERT INTO tb_sistema(
				cnpjEmp,
				intellicashFull,
				intellicashLight,
				easycash,
				gnfe,
				cotacao,
				intelligroup,
				intellistock,
				vendaAssistida,
				orcamento,
				pedido,
				produto,
				edi,
				mgMobile,
				nfDestinada,
				contasPgRc,
				sincronizador,
				entregaCega,
				cte
			) VALUES(
				:cnpjEmp,
				:intellicashFull,
				:intellicashLight,
				:easycash,
				:gnfe,
				:cotacao,
				:intelligroup,
				:intellistock,
				:vendaAssistida,
				:orcamento,
				:pedido,
				:produto,
				:edi,
				:mgMobile,
				:nfDestinada,
				:contasPgRc,
				:sincronizador,
				:entregaCega,
				:cte			
			)";

			$params = array(
				':cnpjEmp'=>           $sistema->getCnpjEmp(),
				':intellicashFull'=>   $sistema->getIntellicashFull(),
				':intellicashLight'=>  $sistema->getIntellicashLight(),
				':easycash'=>          $sistema->getEasycash(),
				':gnfe'=>              $sistema->getGnfe(),
				':cotacao'=>           $sistema->getCotacao(),
				':intelligroup'=>      $sistema->getIntelligroup(),
				':intellistock'=>      $sistema->getIntellistock(),
				':vendaAssistida'=>    $sistema->getVendaAssistida(),
				':orcamento'=>         $sistema->getOrcamento(),
				':pedido'=>            $sistema->getPedido(),
				':produto'=>           $sistema->getProduto(),
				':edi'=>               $sistema->getEdi(),
				':mgMobile'=>          $sistema->getMgMobile(),
				':nfDestinada'=>       $sistema->getNfDestinada(),
				':contasPgRc'=>        $sistema->getContasPgRc(),
				':sincronizador'=>     $sistema->getSincronizador(),
				':entregaCega'=>       $sistema->getEntregaCega(),
				':cte'=>               $sistema->getCte()
			);

			$stmt = $this->connection->prepare($sql);

			if($stmt->execute($params))
				return TRUE;
			else
				return NULL;
		}catch(PDOException $exc){
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}

	public function alterarSistema(Sistema $sistema, $cnpj){
		try{
			$sql = "UPDATE tb_sistema SET
					intellicashFull = :intellicashFull,
					intellicashLight = :intellicashLight,
					easycash = :easycash,
					gnfe = :gnfe,
					cotacao = :cotacao,
					intelligroup = :intelligroup,
					intellistock = :intellistock,
					vendaAssistida = :vendaAssistida,
					orcamento = :orcamento,
					pedido = :pedido,
					produto = :produto,
					edi = :edi,
					mgMobile = :mgMobile,
					nfDestinada = :nfDestinada,
					contasPgRc = :contasPgRc,
					sincronizador = :sincronizador,
					entregaCega = :entregaCega,
					cte = :cte
			       WHERE cnpjEmp = ".$cnpj;

			$params = array(
				':intellicashFull'=>   $sistema->getIntellicashFull(),
				':intellicashLight'=>  $sistema->getIntellicashLight(),
				':easycash'=>          $sistema->getEasycash(),
				':gnfe'=>              $sistema->getGnfe(),
				':cotacao'=>           $sistema->getCotacao(),
				':intelligroup'=>      $sistema->getIntelligroup(),
				':intellistock'=>      $sistema->getIntellistock(),
				':vendaAssistida'=>    $sistema->getVendaAssistida(),
				':orcamento'=>         $sistema->getOrcamento(),
				':pedido'=>            $sistema->getPedido(),
				':produto'=>           $sistema->getProduto(),
				':edi'=>               $sistema->getEdi(),
				':mgMobile'=>          $sistema->getMgMobile(),
				':nfDestinada'=>       $sistema->getNfDestinada(),
				':contasPgRc'=>        $sistema->getContasPgRc(),
				':sincronizador'=>     $sistema->getSincronizador(),
				':entregaCega'=>       $sistema->getEntregaCega(),
				':cte'=>               $sistema->getCte()
			);

			$stmt = $this->connection->prepare($sql);

			if($stmt->execute($params))
				return TRUE;
			else
				return NULL;
		}catch(PDOException $exc){
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
		 
	}

	public function encontrarPorCriterio($argumentos, $tabelas, $criterio){
		try{
			$sql = "SELECT ".$argumentos." FROM ".$tabelas." WHERE ".$criterio;

			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()){
				while($row = $stmt->fetch ( PDO::FETCH_NAMED )){
					$sistema= $this->rowToSistema($row);
				}
				if(!empty($sistema))
					return $sistema;
			}else
				return NULL;
		}catch(PDOException $exc){
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
		 
	}

	private function rowToSistema($row){
		if (! is_null ( $row ) && $row ['cnpjEmp'] != NULL && $row ['cnpjEmp'] != ""){
			$sistema = new Sistema();

			$sistema->setCnpjEmp($row['cnpjEmp']);
			$sistema->setIntellicashFull($row['intellicashFull']);
			$sistema->setIntellicashLight($row['intellicashLight']);
			$sistema->setEasycash($row['easycash']);
			$sistema->setGnfe($row['gnfe']);
			$sistema->setCotacao($row['cotacao']);
			$sistema->setIntelligroup($row['intelligroup']);
			$sistema->setIntellistock($row['intellistock']);
			$sistema->setVendaAssistida($row['vendaAssistida']);
			$sistema->setOrcamento($row['orcamento']);
			$sistema->setPedido($row['pedido']);
			$sistema->setProduto($row['produto']);
			$sistema->setEdi($row['edi']);
			$sistema->setMgMobile($row['mgMobile']);
			$sistema->setNfDestinada($row['nfDestinada']);
			$sistema->setContasPgRc($row['contasPgRc']);
			$sistema->setSincronizador($row['sincronizador']);
			$sistema->setEntregaCega($row['entregaCega']);
			$sistema->setCte($row['cte']);

			return $sistema;
		}
	}

}

?>
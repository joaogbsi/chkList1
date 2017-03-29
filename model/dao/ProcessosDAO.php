<?php

require_once PATH_MODEL_ENTITIES.'Nobreak.class.php';

class ProcessosDAO{

	function __construct($connection){
		$this->connection = $connection;
	}

	public function inserirProcessos(Processos $processos){
		try{
			$sql = "INSERT INTO tb_processos(
				cnpjEmp,
				qtdCadastro,
				pessoaLanc,
				lancPreco,
				recebeMerc,
				compraVenda,
				fiscalVendas,
				fechamentoDiario,
				respFechamento,
				respFinanceiro
			) VALUES (
				:cnpjEmp,
				:qtdCadastro,
				:pessoaLanc,
				:lancPreco,
				:recebeMerc,
				:compraVenda,
				:fiscalVendas,
				:fechamentoDiario,
				:respFechamento,
				:respFinanceiro
			)";

			$params = array(
				':cnpjEmp' =>          $processos->getCnpjEmp(),
				':qtdCadastro' =>      $processos->getQtdCadastro(),
				':pessoaLanc' =>       $processos->getPessoaLanc(),
				':lancPreco' =>        $processos->getLancPreco(),
				':recebeMerc' =>       $processos->getRecebeMerc(),
				':compraVenda' =>      $processos->getCompraVenda(),
				':fiscalVendas' =>     $processos->getFiscalVendas(),
				':fechamentoDiario' => $processos->getFechamentoDiario(),
				':respFechamento' =>   $processos->getRespFechamento(),
				':respFinanceiro' =>   $processos->getRespFinanceiro()
			);

			$stmt = $this->connection->prepare($sql);

			if($stmt->execute($params)){
				return TRUE;
			}else
				return NULL;
		}catch(PDOException $exc){
			echo $exc->getTraceAsString();
			print_r($stmt->errorInfo());
			exit();
		}
		 
	}	

	public function alterarProcessos(Processos $processos, $cnpj){
		try{

			$sql = "UPDATE tb_processos SET 
					qtdCadastro = :qtdCadastro,
					pessoaLanc = :pessoaLanc,
					lancPreco = :lancPreco,
					recebeMerc = :recebeMerc,
					compraVenda = :compraVenda,
					fiscalVendas = :fiscalVendas,
					fechamentoDiario = :fechamentoDiario,
					respFechamento = :respFechamento,
					respFinanceiro = :respFinanceiro
			        WHERE cnpjEmp = ".$cnpj;

			$params = array(
				':qtdCadastro' =>      $processos->getQtdCadastro(),
				':pessoaLanc' =>       $processos->getPessoaLanc(),
				':lancPreco' =>        $processos->getLancPreco(),
				':recebeMerc' =>       $processos->getRecebeMerc(),
				':compraVenda' =>      $processos->getCompraVenda(),
				':fiscalVendas' =>     $processos->getFiscalVendas(),
				':fechamentoDiario' => $processos->getFechamentoDiario(),
				':respFechamento' =>   $processos->getRespFechamento(),
				':respFinanceiro' =>   $processos->getRespFinanceiro()
			);

			$stmt = $this->connection->prepare($sql);

			if($stmt->execute($params)){
				return TRUE;
			}else
				return NULL;
		}catch(PDOException $exc){
			echo $exc->getTraceAsString();
			print_r($stmt->errorInfo());
			exit();
		}
	}

	public function encontrarPorCriterio($argumentos, $tabelas, $criterio){
		try{
			$sql = "SELECT ".$argumentos." FROM ".$tabelas." WHERE ".$criterio;

			$stmt = $this->connection->prepare($sql);

			if($stmt->execute()){
				while($row = $stmt->fetch(PDO::FETCH_NAMED)){
					$processos = $this->rowToProcessos($row);					
				}
				if(!empty($processos))
					return $processos;
			}else
				return NULL;

		}catch(PDOException $exc){
			echo $exc->getTraceAsString();
			print_r($stmt->errorInfo());
			exit();
		}
		 
	}

	private function rowToProcessos($row){
		if (! is_null ( $row ) && $row ['cnpjEmp'] != NULL && $row ['cnpjEmp'] != ""){

			$processos = new Processos();

			$processos->setCnpjEmp($row['cnpjEmp']);
			$processos->setQtdCadastro($row['qtdCadastro']);
			$processos->setPessoaLanc($row['pessoaLanc']);
			$processos->setLancPreco($row['lancPreco']);
			$processos->setRecebeMerc($row['recebeMerc']);
			$processos->setCompraVenda($row['compraVenda']);
			$processos->setFiscalVendas($row['fiscalVendas']);
			$processos->setFechamentoDiario($row['fechamentoDiario']);
			$processos->setRespFechamento($row['respFechamento']);
			$processos->setRespFinanceiro($row['respFinanceiro']);

			return $processos;
		}
	}
}
?>
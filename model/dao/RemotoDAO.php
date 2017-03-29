<?php

require_once PATH_MODEL_ENTITIES."Remoto.class.php";

class RemotoDAO{

	function __construct($connection){
		$this->connection = $connection;
	}

	public function inserirRemoto(Remoto $remoto){
		echo 'remotoDAO';
		try{
			$sql = 'INSERT INTO tb_remoto(
				cnpjEmp,
				recebeAcesso,
				interligaFilial,
				ipFixo
			) VALUES(
				:cnpjEmp,
				:recebeAcesso,
				:interligaFilial,
				:ipFixo
			)';

			$params= array(
				':cnpjEmp' => $remoto->getCnpjEmp(),
				':recebeAcesso' => $remoto->getRecebeAcesso(),
				':interligaFilial' => $remoto->getInterligaFilial(),
				':ipFixo' => $remoto->getIpFixo()
			);

			$stmt = $this->connection->prepare($sql);
			if($stmt->execute($params)){
				return TRUE;
			}else
				return NULL;
		}catch(PDOException $exc){
			echo $exc->setTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
		 
	}

	public function alterarRemoto(Remoto $remoto, $cnpj){
		try{
			$sql="UPDATE tb_remoto SET
			     recebeAcesso = :recebeAcesso,
				 interligaFilial = :interligaFilial,
				 ipFixo = :ipFixo
			     WHERE cnpjEmp = ".$cnpj;

			$params= array(
				':recebeAcesso' => $remoto->getRecebeAcesso(),
				':interligaFilial' => $remoto->getInterligaFilial(),
				':ipFixo' => $remoto->getIpFixo()
			);

			/*
			echo $sql.'<br />';
			var_dump($params);
			*/
			
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute($params)){
				return TRUE;
			}else
				return NULL;
		}catch(PDOException $exc){
			echo $exc->setTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
		 
	}

	public function encontrarPorCriterio($argumentos, $tabelas, $criterio){
		try{
			$sql = "SELECT ".$argumentos." FROM ".$tabelas." WHERE ".$criterio;

			$stmt = $this->connection->prepare($sql);

			if($stmt->execute()){
				while($row = $stmt->fetch(PDO::FETCH_NAMED)){
					$remoto = $this->rowToRemoto($row);
				}
				if(!empty($remoto))
					return $remoto;
			}else
				return NULL;
		}catch(PDOException $exc){
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
		 
	}

	public function rowToRemoto($row){
		if (! is_null ( $row ) && $row ['cnpjEmp'] != NULL && $row ['cnpjEmp'] != ""){
			$remoto = new Remoto();

				$remoto->setCnpjEmp($row['cnpjEmp']);
				$remoto->setRecebeAcesso($row['recebeAcesso']);
				$remoto->setInterligaFilial($row['interligaFilial']);
				$remoto->setIpFixo($row['ipFixo']);

			return $remoto;
		}
	}
}
?>
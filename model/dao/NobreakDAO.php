<?php

require_once PATH_MODEL_ENTITIES.'Nobreak.class.php';

class NobreakDAO{

	function __construct($connection){
		$this->connection = $connection;
	}

	public function inserirNobreak(Nobreak $nobreak){

		try{
			$sql = "INSERT INTO tb_nobreak(
				cnpjEmp,
				qtde,
				marca,
				serv,
				term,
				caixa
			) VALUES (
				:cnpjEmp,
				:qtde,
				:marca,
				:serv,
				:term,
				:caixa
			)";

			$params = array(
				':cnpjEmp'=> $nobreak->getCnpjEmp(),
				':qtde'=>  $nobreak->getQtde(),
				':marca'=> $nobreak->getMarca(),
				':serv'=>  $nobreak->getServ(),
				':term'=>  $nobreak->getTerm(),
				':caixa'=> $nobreak->getCaixa()
			);

			$stmt = $this->connection->prepare($sql);

			if($stmt->execute($params)){
				return $this->connection->lastInsertId('nobreak_id_seq');
			}
		}catch(PDOException $exc){
			echo $exc->getTraceAsString();
			print_r($stmt->errorInfo());
			exit();
		}
	}

	public function deletarPorId($id){
		try{
			$sql= "DELETE FROM tb_nobreak WHERE id = ".$id;

			echo $sql;

			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()){
				return TRUE;
			}
		}catch(PDOException $exc){
			echo $exc->getTraceAsString();
			print_r($stmt->errorInfo());
			exit();
		}
		 
	}

	public function encontrarPorCriterio($argumentos, $tabela, $criterio){
		try{
			$sql = "SELECT ".$argumentos." FROM ".$tabela." WHERE ".$criterio;
			
			$stmt = $this->connection->prepare($sql);
			//echo $sql. '<br />';
			if($stmt->execute()){
				while($row = $stmt->fetch ( PDO::FETCH_NAMED )){
					$nobreaks[]= $this->rowToNobreak($row);
				}
				if(!empty($nobreaks))
					return $nobreaks;
			}else
				return NULL;
		}catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}

	private function rowToNobreak($row){
		if (! is_null ( $row ) && $row ['cnpjEmp'] != NULL && $row ['cnpjEmp'] != ""){
			$nobreak = new Nobreak();

			$nobreak->setId($row['id']);
			$nobreak->setCnpjEmp($row['cnpjEmp']);
			$nobreak->setQtde($row['qtde']);
			$nobreak->setMarca($row['marca']);
			$nobreak->setServ($row['serv']);
			$nobreak->setTerm($row['term']);
			$nobreak->setCaixa($row['caixa']);

			return $nobreak;
		}
	}
}
?>
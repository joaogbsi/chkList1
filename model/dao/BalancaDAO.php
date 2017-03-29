<?php

require_once PATH_MODEL_ENTITIES."Balanca.class.php";
class BalancaDAO{
	
	function __construct($connection){
		$this->connection = $connection;
	}
	
	public function inserirBalanca(Balanca $balanca){
		try{
			$sql = "INSERT INTO tb_balanca(
				cnpjEmp,
				qtde,
				marca
			) VALUES (
				:cnpjEmp,
				:qtde,
				:marca
			)";
			
			$params = array(
				':cnpjEmp' => $balanca->getCnpjEmp(),
				':qtde' =>    $balanca->getQtde(),
 				':marca' =>   $balanca->getMarca()				
			);

			$stmt = $this->connection->prepare($sql);
			if($stmt->execute($params)){
				return $this->connection->lastInsertId ( 'balanca_id_seq' );
			}else
				return NULL;
		}catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}
	public function deletarPorId($id){
		try{
			$sql = "DELETE FROM tb_balanca WHERE id = ".$id;
			
			echo $sql;

			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()){
				return TRUE;
			}else
				return NULL;
		}catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}
	
	public function encontrarPorId($id){
		try{
			$sql = "SELECT * FROM tb_balanca WHERE id LIKE ".$id;
			
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute())
				$ecf = $this->rowToBalanca($stmt->fetch ( PDO::FETCH_NAMED ));
			else
				return NULL;
		}catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
		
	}
	
	public function encontrarPorCriterio($argumentos, $tabelas, $criterio){
		try{
			$sql = "SELECT ".$argumentos." FROM ".$tabelas." WHERE ".$criterio;

			$stmt = $this->connection->prepare($sql);

			if($stmt->execute())
				while($row = $stmt->fetch ( PDO::FETCH_NAMED )){
					$balanca []= $this->rowToBalanca($row);
				}
				if(!empty($balanca))
					return $balanca;
			else
				return NULL;
		}catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}

	public function buscarPorCnpj($cnpjEmp){
		try{
			$sql = "SELECT * FROM tb_balanca WHERE cnpjEmp = ".$cnpjEmp;

			$stmt = $this->connection->prepare($sql);

			if($stmt->execute()){
				while($row = $stmt->fetch( PDO::FETCH_NAMED)){
					$balancas[]=$this->rowToBalanca($row);
				}
				if(!empty($balancas))
				return $balancas;
			}else
				return NULL;
		}catch(PDOException $exc){
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
		 
	}
	
	private function rowToBalanca($row){
		if (! is_null ( $row ) && $row ['id'] != NULL && $row ['id'] != "") {
			$balanca = new Balanca();
			
			$balanca->setId ($row['id']);
			$balanca->setCnpjEmp($row['cnpjEmp']);
			$balanca->setQtde($row['qtde']);
			$balanca->setMarca($row['marca']);

			return $balanca;
		}else
			return null;
	}
}
?>
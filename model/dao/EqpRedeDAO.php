<?php

require_once PATH_MODEL_ENTITIES."eqpRede.class.php";
class EqpRedeDAO{
	
	function __construct($connection){
		$this->connection = $connection;
	}
	
	public function inserirEqpRede(EqpRede $eqpRede){
		try{
			$sql = "INSERT INTO tb_eqpRede(
				cnpjEmp,
				qtde,
				marca
			) VALUES (
				:cnpjEmp,
				:qtde,
				:marca
			)";
			
			$params = array(
				':cnpjEmp' => $eqpRede->getCnpjEmp(),
				':qtde' =>    $eqpRede->getQtde(),
 				':marca' =>   $eqpRede->getMarca()
			);
			
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute($params)){
				return $this->connection->lastInsertId ( 'eqpRede_id_seq' );
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
			$sql = "DELETE FROM tb_eqpRede WHERE id = ".$id;

			echo $sql .'<br />';

			$stmt = $this->connection->prepare($sql);

			if($stmt->execute()){
				return TRUE;
			}
		}catch(PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
		 
	}
	
	public function encontrarPorId($id){
		try{
			$sql = "SELECT * FROM tb_eqpRede WHERE id LIKE ".$id;
			
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute())
				$ecf = $this->rowToEqpRede($stmt->fetch ( PDO::FETCH_NAMED ));
			else
				return NULL;
		}catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
		
	}
	
	public function encontrarPorCriterio($argumentos, $tabelas, $criterio){
		//echo 'encontrarPorCriterioDAO <br />';
		try{
			$sql = "SELECT ".$argumentos." FROM ".$tabelas." WHERE ".$criterio;

			
			$stmt = $this->connection->prepare($sql);
			//echo $sql. '<br />';

			if($stmt->execute())
				while($row = $stmt->fetch ( PDO::FETCH_NAMED )){
					$eqpRede []= $this->rowToEqpRede($row);

				}
				if(!empty($eqpRede))
					return $eqpRede;
			else
				return NULL;
		}catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}
	
	private function rowToEqpRede($row){
		if (! is_null ( $row ) && $row ['id'] != NULL && $row ['id'] != "") {
			$eqpRede = new eqpRede();
			
			$eqpRede->setId ($row['id']);
			$eqpRede->setCnpjEmp($row['cnpjEmp']);
			$eqpRede->setQtde($row['qtde']);
			$eqpRede->setMarca($row['marca']);
			
			return $eqpRede;
		}else
			return null;
	}
}
?>
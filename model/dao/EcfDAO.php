<?php

require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_ENTITIES.'Ecf.class.php';


class EcfDAO{
	
	function __construct($connection){
		$this->connection = $connection;
	}
	
	public function inserirEcf( Ecf $ecf){
		try{
			$sql = "INSERT INTO tb_ecf(
				cnpjEmp,
				qtde,
				marca
			) 
			VALUES (
				:cnpjEmp,
				:qtde,
				:marca
			)";
			
			$params = array(
				':cnpjEmp'=> $ecf->getCnpjEmp(),
				':qtde' =>   $ecf->getQtde(),
				':marca' =>  $ecf->getMarca()
			);

			$stmt = $this->connection->prepare($sql);
			if ($stmt->execute ( $params )) {
				return $this->connection->lastInsertId ( 'ecf_id_seq' );
			} else {
				return NULL;
			}
		}catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}

	public function deletarPorId($id){
		try{
			$sql = "DELETE FROM tb_ecf WHERE id = ".$id;

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
	
	/*public function encontrarPorId($id){
		try{
			$sql = "SELECT * FROM tb_ecf WHERE id = " . $id;
			
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()){
				$ecf = $this->rowToEcf($stmt->fetch ( PDO::FETCH_NAMED ));
				
				return $ecf;
			}else
				return NULL;
		}catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}*/
	
	public function encontrarPorCriterio($argumentos, $tabelas, $criteriaString){
		try{
			$sql = "SELECT ".$argumentos." FROM ".$tabelas." WHERE ".$criteriaString;

			//echo $sql;

			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()){
				while ( $row = $stmt->fetch ( PDO::FETCH_NAMED ) ) {
					$ecf []= $this->rowToEcf($row);
				}
				if (!empty($ecf))
					return $ecf;
			}else
				return NULL;
		}catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}
	
	private function rowToEcf($row){
		if (! is_null ( $row ) && $row ['id'] != NULL && $row ['id'] != "") {
			$ecf = new Ecf();
			
			$ecf->setId ($row['id']);
			$ecf->setCnpjEmp($row['cnpjEmp']);
			$ecf->setQtde($row['qtde']);
			$ecf->setMarca($row['marca']);
			
			return $ecf;
		}else
			return null;
	}

	public function buscarPorCnpj($cnpjEmp){
		try{
			$sql = "SELECT * FROM tb_ecf WHERE cnpjEmp = ".$cnpjEmp;

			$stmt = $this->connection->prepare($sql);

			if($stmt->execute()){
				while($row = $stmt->fetch(PDO::FETCH_NAMED)){
					$ecfs[] = $this->rowToEcf($row);
				}
				if(!empty($ecfs))
					return $ecfs;
			}else
				return NULL;
		}catch(PDOException $exc){
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
		 
	}
	
}
?>
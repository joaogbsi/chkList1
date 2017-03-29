<?php

require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_ENTITIES.'Computador.class.php';

class ComputadorDAO{
	
	function __construct($connection){
		$this->connection = $connection;
	}	

	public function inserirComputador(Computador $computador){

		try{

			$sql = "INSERT INTO tb_computadores(
				cnpjEmp,
				qtd,
				descricao,
				sistOp,
				hd,
				memoria,
				serial,
				serv,
				term,
				caixa
			)VALUES (
				:cnpjEmp,
				:qtd,
				:descricao,
				:sistOp,
				:hd,
				:memoria,
				:serial,
				:serv,
				:term,
				:caixa
			)";

			$params = array(
				':cnpjEmp'=>    $computador->getCnpjEmp(),
				':qtd'=>        $computador->getQtde(),
				':descricao' => $computador->getDescricao(),
				':sistOp' =>    $computador->getSistOp(),
				':hd' =>        $computador->getHd(),
				':memoria' =>   $computador->getMemoria(),
				':serial' =>    $computador->getSerial(),
				':serv' =>      $computador->getServ(),
				':term' =>      $computador->getTerm(),
				':caixa' =>     $computador->getCaixa()
			);

			$stmt = $this->connection->prepare($sql);

			if($stmt->execute($params)){
				echo 'true';
				return TRUE;
			}else
				return NULL;
		}catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}



	public function procurarPorCnpj($cnpj){
		try{
			$sql = "SELECT * FROM tb_computadores WHERE cnpjEmp = ".$cnpj;

			
			$stmt = $this->connection->prepare($sql);

			if($stmt->execute()){

				while($row = $stmt->fetch ( PDO::FETCH_NAMED )){
					$computadores[] = $this->rowToComputador($row);
				}
				if(!empty($computadores))
					return $computadores;
			}else
				return NULL;
			
			
		}catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}

	public function encontrarPorCriterio($argumento, $tabela, $criterio){
		try{
			$sql = "SELECT ".$argumento." FROM ".$tabela." WHERE ".$criterio;
			
			$stmt = $this->connection->prepare($sql);

			if($stmt->execute()){
				while($row = $stmt->fetch(PDO::FETCH_NAMED)){
					$computadores[] = $this->rowToComputador($row);
				}
				if(!empty($computadores))
					return $computadores;
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
			$sql = "DELETE FROM tb_computadores WHERE id = ".$id;


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


	private function rowToComputador($row){
		if (! is_null ( $row ) && $row ['cnpjEmp'] != NULL && $row ['cnpjEmp'] != ""){
			
			$computador = new Computador();

			$computador->setId($row['id']);
			$computador->setCnpjEmp($row['cnpjEmp']);
			$computador->setQtde($row['qtd']);
			$computador->setDescricao($row['descricao']);
			$computador->setSistOp($row['sistOp']);
			$computador->setHd($row['hd']);
			$computador->setMemoria($row['memoria']);
			$computador->setSerial($row['serial']);
			$computador->setServ($row['serv']);
			$computador->setTerm($row['term']);
			$computador->setCaixa($row['caixa']);

			return $computador;
			
		}
	}
	
}
?>
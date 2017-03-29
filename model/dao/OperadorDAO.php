<?php

require_once PATH_MODEL_ENTITIES."operador.class.php";

class OperadorDAO{
		
		public function __construct($connection){
			$this->connection = $connection;
		}	
		
		public function inserirOperador(Operador $operador){
			try{
				
				$sql = "INSERT INTO tb_operador(
					cpf,
					cnpjEmp,
					nome,
					turno,
					descAcr,
					cancelar,
					liberar,
					redZ,
					suprSang
				) VALUES(
					:cpf,
					:cnpjEmp,
					:nome,
					:turno,
					:descAcr,
					:cancelar,
					:liberar,
					:redZ,
					:suprSang
				)";
				

				$params = array(
					":cpf" =>      $operador->getCpf(),
					":cnpjEmp" =>  $operador->getCnpjEmp(),
					":nome" =>     $operador->getNome(),
					":turno" =>    $operador->getTurno(),
					":descAcr" =>  $operador->getDescAcr(),
					":cancelar" => $operador->getCancelar(),
					":liberar" =>  $operador->getLiberar(),
					":redZ" =>     $operador->getRedZ(),
					":suprSang" => $operador->getSuprSang()
				);

				echo $sql;
				
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
		
		public function deletarPorId($id){
			try{
				$sql = "DELETE FROM tb_operador WHERE id = ".$id;

				echo $sql .'<br />';

				$stmt = $this->connection->prepare($sql);
				if($stmt->execute()){
					return TRUE;
				}
			}catch ( PDOException $exc ) {
				echo $exc->getTraceAsString ();
				print_r ( $stmt->errorInfo () );
				exit ();
			}
		}
		/*

		*/

		public function encotrarPorCpf($cpf){
			try{
				$sql = "SELECT * FROM tb_operadores WHERE cpf LIKE ".$cpf;
				
				$stmt = $this->connection->prepare($sql);
				if($stmt->execute()){
					$operador = $this->rowToOperador($stmt->fetch(PDO::FETCH_NAMED ));
					
				}else
					return NULL;
				
			}catch ( PDOException $exc ) {
				echo $exc->getTraceAsString ();
				print_r ( $stmt->errorInfo () );
				exit ();
			}
		}
		
		public function encotrarPorCriterio($argumentos, $tabelas, $criterio){
			try{
				$sql = "SELECT ".$argumentos." FROM ".$tabelas." where ".$criterio;
				
				//echo $sql .'<br />';

				$stmt = $this->connection->prepare($sql);

				
				if($stmt->execute()){
					while($row = $stmt->fetch(PDO::FETCH_NAMED )){
						$operadores[] = $this->rowToOperador($row);
					}
					if(!empty($operadores))
						return $operadores;
				}else
					return NULL;
			}catch ( PDOException $exc ) {
				echo $exc->getTraceAsString ();
				print_r ( $stmt->errorInfo () );
				exit ();
			}
		}
		
		public function atualizarOperador(Operador $operador){
			try{
				
			}catch ( PDOException $exc ) {
				echo $exc->getTraceAsString ();
				print_r ( $stmt->errorInfo () );
				exit ();
			}
		}
		
		private function rowToOperador($row){
			if (! is_null ( $row ) && $row ['cpf'] != NULL && $row ['cpf'] != "") {
				$operador = new Operador();
				
				$operador->setId($row['id']);
				$operador->setCpf($row['cpf']);
				$operador->setCnpjEmp($row['cnpjEmp']);
				$operador->setNome($row['nome']);
				$operador->setTurno($row['turno']);
				$operador->setDescAcr($row['descAcr']);
				$operador->setCancelar($row['cancelar']);
				$operador->setLiberar($row['liberar']);
				$operador->setRedZ($row['redZ']);
				$operador->setSuprSang($row['suprSang']);

				return $operador;
			}else{
				return NULL;
			}
		}
}
?>
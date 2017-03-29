<?php

require_once PATH_MODEL_ENTITIES."Vendedor.class.php";

class VendedorDAO{
	
	function __construct($connection){
		$this->connection = $connection;
	}
	
	public function inserirVendedor(Vendedor $vendedor){
		try{
			$sql="INSERT INTO tb_vendedor(
				cpf,
				cnpjEmp,
				nome,
				codigo,
				desconto,
				comissao
			) VALUES (
				:cpf,
				:cnpjEmp,
				:nome,
				:codigo,
				:desconto,
				:comissao
			)";

			
			$params = array (
				':cpf' => $vendedor->getCpf(),
				':cnpjEmp' => $vendedor->getCnpjEmp(),
				':nome' => $vendedor->getNome(),
				':codigo' => $vendedor->getCodigo(),
				':desconto' => $vendedor->getDesconto(),
				':comissao' => $vendedor->getComissao()
			);
			
			$stmt = $this->connection->prepare($sql);
			
			if($stmt->execute($params)){
				return TRUE;
			}else{
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
			$sql = "DELETE FROM tb_vendedor WHERE id = ".$id;

			echo $sql.'<br />';

			$stmt = $this->connection->prepare($sql);

			if($stmt->execute()){
				return TRUE;
			}else{
				return NULL;
			}
		}catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}
	
	public function encontrarPorCpf($cpf){
		try{
			$sql = "SELECT * FROM tb_vendedores WHERE cpf LIKE ".$cpf;
			
			$stmt = $this->connection->prepare($sql);
			
			if($stmt->execute()){
				$vendedor = $this->rowToVendedor($stmt->fetch(PDO::FETCH_NAMED));
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

			//echo $sql .'<br />';

			if($stmt->execute()){
				while($row = $stmt->fetch(PDO::FETCH_NAMED)){
					$vendedores[] = $this->rowToVendedor($row);
				}
				if(!empty($vendedores))
					return $vendedores;
			}else
				return NULL;
			
		}catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}
	
	public function atualizarVendedor(){
		try{
			
		}catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}
	
	private function rowToVendedor($row){
		if (! is_null ( $row ) && $row ['cpf'] != NULL && $row ['cpf'] != "") {
			
			$vendedor = new Vendedor();
			
			$vendedor->setId($row['id']);
			$vendedor->setCpf($row['cpf']);
			$vendedor->setCnpjEmp($row['cnpjEmp']);
			$vendedor->setNome($row['nome']);
			$vendedor->setCodigo($row['codigo']);
			$vendedor->setDesconto($row['desconto']);
			$vendedor->setComissao($row['comissao']);

			return $vendedor;
		}else
			return NULL;
	}
}
?>
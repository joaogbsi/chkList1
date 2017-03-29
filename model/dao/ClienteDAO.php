<?php

require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_ENTITIES.'Cliente.class.php';

class ClienteDAO{
	
	function __construct($connection){
		$this->connection = $connection;
	}
	
	public function inserirCliente(Cliente $cliente){

		try{
			$sql = "INSERT INTO empresa(
				cnpj,
				empresa,
				email,
				telefone,
				respSistema,
				nUsuario,
				loja,
				filial,
				regime,
				fiscal,
				nFiscal,
				ramo
				
			) VALUES(
				:cnpj,
				:empresa,
				:email,
				:telefone,
				:respSistema,
				:nUsuario,
				:loja,
				:filial,
				:regime,
				:fiscal,
				:nFiscal,
				:ramo			
			)";
			
			$params = array(
				':cnpj' =>        $cliente->getCnpj(),
				':empresa' =>     $cliente->getEmpresa(),
				':email' =>       $cliente->getEmail(),
				':telefone' =>    $cliente->getTelefone(),
				':respSistema'=>  $cliente->getRespSistema(),
				':nUsuario'=>     $cliente->getNUsuario(),
				':loja' =>        $cliente->getLoja(),
				':filial' =>      $cliente->getFilial(),
				':regime' =>      $cliente->getRegime(),
				':fiscal' =>      $cliente->getFiscal(),
				':nFiscal' =>     $cliente->getNFiscal(),
				':ramo' =>        $cliente->getRamo()
				
			);

						
			$stmt = $this->connection->prepare($sql);
			
			if($stmt->execute($params)){
				echo 'true';
				return TRUE;
			}else{
				echo 'null';
				return NULL;
			}
		}catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}
	
	public function procurarPorCnpj($cnpj){
		echo 'procurarPorCnpj';
		try{
			$sql = "SELECT * FROM empresa WHERE cnpj = ".$cnpj;
			
			$stmt = $this->connection->prepare($sql);

			echo '<br />'. $sql;

			if($stmt->execute())
				while($row = $stmt->fetch ( PDO::FETCH_NAMED )){
					$cliente = $this->rowToCliente($row);
					var_dump($cliente);
				}
			else
				return NULL;
			
			
		}catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}
	
	public function procurarPorCriterio($argumento, $tabela, $criterio){
		try{
			
		}catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}
	
	private function rowToCliente($row){

		$cliente = new Cliente();

		$cliente->setCnpj($row['cnpj']);
		$cliente->setEmpresa($row['empresa']);
		$cliente->setEmail($row['email']);
		$cliente->setTelefone($row['telefone']);
		$cliente->setRespSistema($row['respSistema']);
		$cliente->setNUsuario($row['nUsuario']);
		$cliente->setLoja($row['loja']);
		$cliente->setFilial($row['filial']);
		$cliente->setRegime($row['regime']);
		$cliente->setFiscal($row['fiscal']);
		$cliente->setNFiscal($row['nFiscal']);
		$cliente->setRamo($row['ramo']);

		return $cliente;
		
	}

	public function listarClientes(){
		
		try{
			$sql = "SELECT * FROM empresa e ORDER BY e.empresa";
					
			$stmt = $this->connection->prepare($sql);

			if ($stmt->execute()){
				while ($row = $stmt->fetch()) {
          			$clientes[] = $this->rowToCliente($row);
          		}
        	}

        	return $clientes;
		}catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}
}


?>
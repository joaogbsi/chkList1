<?php

require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_ENTITIES.'Empresa.class.php';

class EmpresaDAO{
	
	function __construct($connection){
		$this->connection = $connection;
	}
	
	public function inserirEmpresa(Empresa $empresa){

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
				nFiscal,
				ramo,
				sintegra,
				spedFiscal,
				spedPis
				
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
				:nFiscal,
				:ramo,
				:sintegra,
				:spedFiscal,
				:spedPis			
			)";
			
			$params = array(
				':cnpj' =>        $empresa->getCnpj(),
				':empresa' =>     $empresa->getEmpresa(),
				':email' =>       $empresa->getEmail(),
				':telefone' =>    $empresa->getTelefone(),
				':respSistema'=>  $empresa->getRespSistema(),
				':nUsuario'=>     $empresa->getNUsuario(),
				':loja' =>        $empresa->getLoja(),
				':filial' =>      $empresa->getFilial(),
				':regime' =>      $empresa->getRegime(),
				':nFiscal' =>     $empresa->getNFiscal(),
				':ramo' =>        $empresa->getRamo(),
				':sintegra' =>    $empresa->getSintegra(),
				':spedFiscal' =>  $empresa->getSpedFiscal(),
				':spedPis' =>     $empresa->getSpedPis()
				
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

	public function alterarEmpresa(Empresa $empresa, $cnpj){
		try{

			$sql = "UPDATE empresa SET
					empresa = :empresa,
					email = :email,
					telefone = :telefone,
					respSistema = :respSistema,
					nUsuario = :nUsuario,
					loja = :loja,
					filial = :filial,
					regime = :regime,
					nFiscal = :nFiscal,
					ramo = :ramo,
					sintegra = :sintegra,
					spedFiscal = :spedFiscal,
					spedPis = :spedPis
					WHERE empresa.cnpj = " .$cnpj;

			$params = array(
				//':cnpj' =>        $empresa->getCnpj(),
				':empresa' =>     $empresa->getEmpresa(),
				':email' =>       $empresa->getEmail(),
				':telefone' =>    $empresa->getTelefone(),
				':respSistema'=>  $empresa->getRespSistema(),
				':nUsuario'=>     $empresa->getNUsuario(),
				':loja' =>        $empresa->getLoja(),
				':filial' =>      $empresa->getFilial(),
				':regime' =>      $empresa->getRegime(),
				':nFiscal' =>     $empresa->getNFiscal(),
				':ramo' =>        $empresa->getRamo(),
				':sintegra' =>    $empresa->getSintegra(),
				':spedFiscal' =>  $empresa->getSpedFiscal(),
				':spedPis' =>     $empresa->getSpedPis()
				
			);

			$stmt = $this->connection->prepare($sql);
			
			if($stmt->execute($params)){
				echo 'true';
				return TRUE;
			}else{
				echo 'null';
				return NULL;
			}
		}catch(PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
		 
	}
	
	public function procurarPorCnpj($cnpj){

		try{
			$sql = "SELECT * FROM empresa WHERE cnpj = ".$cnpj;
			
			$stmt = $this->connection->prepare($sql);

			if($stmt->execute())
				while($row = $stmt->fetch ( PDO::FETCH_NAMED )){
					$empresa = $this->rowToEmpresa($row);
				}
				if(!empty($empresa))
					return $empresa;
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
	
	private function rowToEmpresa($row){

		$empresa = new Empresa();

		$empresa->setCnpj($row['cnpj']);
		$empresa->setEmpresa($row['empresa']);
		$empresa->setEmail($row['email']);
		$empresa->setTelefone($row['telefone']);
		$empresa->setRespSistema($row['respSistema']);
		$empresa->setNUsuario($row['nUsuario']);
		$empresa->setLoja($row['loja']);
		$empresa->setFilial($row['filial']);
		$empresa->setRegime($row['regime']);
		$empresa->setNFiscal($row['nFiscal']);
		$empresa->setRamo($row['ramo']);
		$empresa->setSintegra($row['sintegra']);
		$empresa->setSpedFiscal($row['spedFiscal']);
		$empresa->setSpedPis($row['spedPis']);

		return $empresa;
		
	}

	public function listarEmpresas(){
		
		try{
			$sql = "SELECT * FROM empresa e ORDER BY e.empresa";
					
			$stmt = $this->connection->prepare($sql);

			if ($stmt->execute()){
				while ($row = $stmt->fetch()) {
          			$empresas[] = $this->rowToEmpresa($row);
          		}
        	}

        	return $empresas;
		}catch ( PDOException $exc ) {
			echo $exc->getTraceAsString ();
			print_r ( $stmt->errorInfo () );
			exit ();
		}
	}
}


?>
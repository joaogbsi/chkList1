<?php

class Remoto{

	private $cnpjEmp;
	private $recebeAcesso;
	private $interligaFilial;
	private $ipFixo;

	public function getCnpjEmp(){
	    return $this->cnpjEmp;
	}
	 
	public function setCnpjEmp($cnpjEmp){
	    $this->cnpjEmp = $cnpjEmp;
	}

	public function getRecebeAcesso(){
	    return $this->recebeAcesso;
	}
	 
	public function setRecebeAcesso($recebeAcesso){
	    $this->recebeAcesso = $recebeAcesso;
	}

	public function getInterligaFilial(){
	    return $this->interligaFilial;
	}
	 
	public function setInterligaFilial($interligaFilial){
	    $this->interligaFilial = $interligaFilial;
	}

	public function getIpFixo(){
	    return $this->ipFixo;
	}
	 
	public function setIpFixo($ipFixo){
	    $this->ipFixo = $ipFixo;
	}
}

?>
<?php

class Operador{
	
	private $id;
	private $cpf;
	private $cnpjEmp;
	private $nome;
	private $turno;
	private $descAcr;
	private $cancelar;
	private $liberar;
	private $redZ;
	private $suprSang;

	public function getId(){
	    return $this->id;
	}
	 
	public function setId($id){
	    $this->id = $id;
	}
	
	public function getCpf(){
		return $this->cpf;
	}
	
	public function setCpf($cpf){
		$this->cpf = $cpf;
	}
	
	public function getCnpjEmp(){
		return $this->cnpjEmp;
	}
	
	public function setCnpjEmp($cnpjEmp){
		$this->cnpjEmp = $cnpjEmp;
	}
	
	public function getNome(){
		return $this->nome;
	}
	
	public function setNome($nome){
		$this->nome = $nome;
	}
	
	public function getTurno(){
		return $this->turno;
	}
	
	public function setTurno($turno){
		$this->turno = $turno;
	}
	
	public function getDescAcr(){
		return $this->descAcr;
	}
	
	public function setDescAcr($descAcr){
		$this->descAcr = $descAcr;
	}
	
	public function getCancelar(){
		return $this->cancelar;
	}
	
	public function setCancelar($cancelar){
		$this->cancelar = $cancelar;
	}
	
	public function getLiberar(){
		return $this->liberar;
	}
	
	public function setLiberar($liberar){
		$this->liberar = $liberar;
	}
	
	public function getRedZ(){
		return $this->redZ;
	}
	
	public function setRedZ($redZ){
		$this->redZ = $redZ;
	}
	
	public function getSuprSang(){
		return $this->suprSang;
	}
	
	public function setSuprSang($suprSang){
		$this->suprSang = $suprSang;
	}
	
}
?>
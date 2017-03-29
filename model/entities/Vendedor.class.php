<?php

class Vendedor{
	
	private $id;
	private $cpf;
	private $cnpjEmp;
	private $nome;
	private $codigo;
	private $desconto;
	private $comissao;

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
		
	public function getCodigo(){
		return $this->codigo;
	}
	
	public function setCodigo($codigo){
		$this->codigo = $codigo;
	}
		
	public function getDesconto(){
		return $this->desconto;
	}
	
	public function setDesconto($desconto){
		$this->desconto = $desconto;
	}
		
	public function getComissao(){
		return $this->comissao;
	}
	
	public function setComissao($comissao){
		$this->comissao = $comissao;
	}
	
	
}
?>
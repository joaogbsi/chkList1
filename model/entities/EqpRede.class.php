<?php

class eqpRede{
	
	private $id;
	private $cnpjEmp;
	private $qtde;
	private $marca;
	
	public function getId(){
		return $this->id;
	}
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function getCnpjEmp(){
		return $this->cnpjEmp;
	}
	
	public function setCnpjEmp($cnpjEmp){
		$this->cnpjEmp = $cnpjEmp;
	}
	
	public function getQtde(){
		return $this->qtde;
	}
	
	public function setQtde($qtde){
		$this->qtde = $qtde;
	}
	
	public function getMarca(){
		return $this->marca;
	}
	
	public function setMarca($marca){
		$this->marca = $marca;
	}
	
}
?>
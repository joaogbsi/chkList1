<?php

class Nobreak{
	
	private $id;
	private $cnpjEmp;
	private $qtde;
	private $marca;
	private $serv;
	private $term;
	private $caixa;
	
	
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
		
	public function getServ(){
		return $this->serv;
	}
	
	public function setServ($serv){
		$this->serv = $serv;
	}
		
	public function getTerm(){
		return $this->term;
	}
	
	public function setTerm($term){
		$this->term = $term;
	}
		
	public function getCaixa(){
		return $this->caixa;
	}
	
	public function setCaixa($caixa){
		$this->caixa = $caixa;
	}
	
}
?>
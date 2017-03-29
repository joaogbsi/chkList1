<?php

class Computador{
	
	private $id;
	private $cnpjEmp;
	private $qtde;
	private $descricao;
	private $sistOp;
	private $hd;
	private $memoria;
	private $serial;
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
	
	public function getDescricao(){
		return $this->descricao;
	}
	
	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}
	
	public function getSistOp(){
		return $this->sistOp;
	}
	
	public function setSistOp($sistOp){
		$this->sistOp = $sistOp;
	}
		
	public function getHd(){
		return $this->hd;
	}
	
	public function setHd($hd){
		$this->hd = $hd;
	}
			
	public function getMemoria(){
		return $this->memoria;
	}
	
	public function setMemoria($memoria){
		$this->memoria = $memoria;
	}
			
	public function getSerial(){
		return $this->serial;
	}
	
	public function setSerial($serial){
		$this->serial = $serial;
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
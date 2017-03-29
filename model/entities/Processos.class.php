<?php

class Processos{

	private $cnpjEmp;
	private $qtdCadastro;
	private $pessoaLanc;
	private $lancPreco;
	private $recebeMerc;
	private $compraVenda;
	private $fiscalVendas;
	private $fechamentoDiario;
	private $respFechamento;
	private $respFinanceiro;

	public function getCnpjEmp(){
	    return $this->cnpjEmp;
	}
	 
	public function setCnpjEmp($cnpjEmp){
	    $this->cnpjEmp = $cnpjEmp;
	}

	public function getQtdCadastro(){
	    return $this->qtdCadastro;
	}
	 
	public function setQtdCadastro($qtdCadastro){
	    $this->qtdCadastro = $qtdCadastro;
	}

	public function getPessoaLanc(){
	    return $this->pessoaLanc;
	}
	 
	public function setPessoaLanc($pessoaLanc){
	    $this->pessoaLanc = $pessoaLanc;
	}

	public function getLancPreco(){
	    return $this->lancPreco;
	}
	 
	public function setLancPreco($lancPreco){
	    $this->lancPreco = $lancPreco;
	}

	public function getRecebeMerc(){
	    return $this->recebeMerc;
	}
	 
	public function setRecebeMerc($recebeMerc){
	    $this->recebeMerc = $recebeMerc;
	}

	public function getCompraVenda(){
	    return $this->compraVenda;
	}
	 
	public function setCompraVenda($compraVenda){
	    $this->compraVenda = $compraVenda;
	}

	public function getFiscalVendas(){
	    return $this->fiscalVendas;
	}
	 
	public function setFiscalVendas($fiscalVendas){
	    $this->fiscalVendas = $fiscalVendas;
	}

	public function getFechamentoDiario(){
	    return $this->fechamentoDiario;
	}
	 
	public function setFechamentoDiario($fechamentoDiario){
	    $this->fechamentoDiario = $fechamentoDiario;
	}

	public function getRespFechamento(){
	    return $this->respFechamento;
	}
	 
	public function setRespFechamento($respFechamento){
	    $this->respFechamento = $respFechamento;
	}

	public function getRespFinanceiro(){
	    return $this->respFinanceiro;
	}
	 
	public function setRespFinanceiro($respFinanceiro){
	    $this->respFinanceiro = $respFinanceiro;
	}
}
?>
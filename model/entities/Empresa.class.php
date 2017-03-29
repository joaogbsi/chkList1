<?php

class Empresa{
	private $cnpj;
	private $empresa;
	private $email;
	private $telefone;
	private $respSistema;
	private $nUsuario;
	private $loja;
	private $filial;
	private $regime;
	private $nFiscal;
	private $ramo;
	private $sintegra;
	private $spedFiscal;
	private $spedPis;

	public function getCnpj() {
		return $this->cnpj;
	}
	
	public function setCnpj($cnpj) {
		$this->cnpj = $cnpj;
	}
	
	public function getEmpresa() {
		return $this->empresa;
	}
	
	public function setEmpresa($empresa) {
		$this->empresa = $empresa;
	}
	
	public function getEmail() {
		return $this->email;
	}
	
	public function setEmail($email) {
		$this->email = $email;
	}
	
	public function getTelefone() {
		return $this->telefone;
	}
	
	public function setTelefone($telefone) {
		$this->telefone = $telefone;
	}
	
	public function getRespSistema() {
		return $this->respSistema;
	}
	
	public function setRespSistema($respSistema) {
		$this->respSistema = $respSistema;
	}
	
	public function getNUsuario() {
		return $this->nUsuario;
	}
	
	public function setNUsuario($nUsuario) {
		$this->nUsuario = $nUsuario;
	}
	
	public function getLoja() {
		return $this->loja;
	}
	
	public function setLoja($loja) {
		$this->loja = $loja;
	}
	
	public function getFilial() {
		return $this->filial;
	}
	
	public function setFilial($filial) {
		$this->filial = $filial;
	}
	
	public function getRegime() {
		return $this->regime;
	}
	
	public function setRegime($regime) {
		$this->regime = $regime;
	}
	
	public function getFiscal() {
		return $this->fiscal;
	}
	
	public function setFiscal($fiscal) {
		$this->fiscal = $fiscal;
	}
	
	public function getNFiscal() {
		return $this->nFiscal;
	}
	
	public function setNFiscal($nFiscal) {
		$this->nFiscal = $nFiscal;
	}
	
	public function getRamo() {
		return $this->ramo;
	}
	
	public function setRamo($ramo) {
		$this->ramo = $ramo;
	}

	public function getSintegra(){
	    return $this->sintegra;
	}
	 
	public function setSintegra($sintegra){
	    $this->sintegra = $sintegra;
	}

	public function getSpedFiscal(){
	    return $this->spedFiscal;
	}
	 
	public function setSpedFiscal($spedFiscal){
	    $this->spedFiscal = $spedFiscal;
	}

	public function getSpedPis(){
	    return $this->spedPis;
	}
	 
	public function setSpedPis($spedPis){
	    $this->spedPis = $spedPis;
	}
}
?>
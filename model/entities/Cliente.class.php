<?php

class Cliente{

	private $empresa;
	private $computadores;
	private $balancas;
	private $ecfs;
	private $eqpRedes;
	private $nobreaks;
	private $vendedores;
	private $operadores;
	private $outrasInfo;
	private $sistema;
	private $remoto;
	private $processos;

	public function getEmpresa(){
	    return $this->empresa;
	}
	 
	public function setEmpresa($empresa){
	    $this->empresa = $empresa;
	}
	
	public function getComputadores(){
		return $this->computadores;
	}
	
	public function setComputadores($computadores){
		$this->computadores = $computadores;
	}
	
	public function getBalancas(){
		return $this->balancas;
	}
	
	public function setBalancas($balancas){
		$this->balancas = $balancas;
	}
	
	public function getEcfs(){
		return $this->ecfs;
	}
	
	public function setEcfs($ecfs){
		$this->ecfs = $ecfs;
	}
	
	public function getEqpRedes(){
		return $this->eqpRedes;
	}
	
	public function setEqpRedes($eqpRedes){
		$this->eqpRedes = $eqpRedes;
	}
	
	public function getNobreaks(){
		return $this->nobreaks;
	}
	
	public function setNobreaks($nobreaks){
		$this->nobreaks = $nobreaks;
	}
	
	public function getvendedores(){
		return $this->vendedores;
	}
	
	public function setvendedores($vendedores){
		$this->vendedores = $vendedores;
	}
	
	public function getOperadores(){
		return $this->operadores;
	}
	
	public function setOperadores($operadores){
		$this->operadores = $operadores;
	}

	public function getOutrasInfo(){
	    return $this->outrasInfo;
	}
	 
	public function setOutrasInfo($outrasInfo){
	    $this->outrasInfo = $outrasInfo;
	}

	public function getSistema(){
	    return $this->sistema;
	}
	 
	public function setSistema($sistema){
	    $this->sistema = $sistema;
	}

	public function getRemoto(){
	    return $this->remoto;
	}
	 
	public function setRemoto($remoto){
	    $this->remoto = $remoto;
	}

	public function getProcessos(){
	    return $this->processos;
	}
	 
	public function setProcessos($processos){
	    $this->processos = $processos;
	}
	
}
?>
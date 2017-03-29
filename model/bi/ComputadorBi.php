<?php


require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_BI .'GenericBI.php';
require_once PATH_MODEL_DAO.'ComputadorDAO.php';

class ComputadorBI extends GenericBI{

	private $computadorDAO;

	public function __construct($connection){
		parent::__construct($connection);
	}

    public function gravaComputador($computador){
        if(is_null($this->computadorDAO)){
            $this->computadorDAO = new ComputadorDAO($this->connection);
        }

        $this->computadorDAO->inserirComputador($computador);
    }

	public function deletarPorId($id){
		if(is_null($this->computadorDAO)){
			$this->computadorDAO = new ComputadorDAO($this->connection);
		}
        echo 'deletarBI <br />';
		$this->computadorDAO->deletarPorId($id);
	}

	public function lerComputador($cnpj){
		
		if(is_null($this->computadorDAO)){
    		$this->computadorDAO = new ComputadorDAO($this->connection);
    	}

    	$computador = $this->computadorDAO->procurarPorCnpj($cnpj);
    	
    	return $computador;
	}

	public function buscarComputador($params, $cnpj){
		if(is_null($this->computadorDAO)){
    		$this->computadorDAO = new ComputadorDAO($this->connection);
    	}

    	$criterio = ' cnpjEmp = '.$cnpj
    	            .' AND qtd = '.$params['qtde']
    	            .' AND descricao = "'.$params['descricao']
    	            .'" AND sistOp = "'.$params['sistOp']
    	            .'" AND hd = "'.$params['hd']
    	            .'" AND memoria = "'.$params['memoria']
    	            .'" AND serial = '.$params['serial']
    	            .' AND serv = '.$params['serv']
    	            .' AND term = '.$params['term']
    	            .' AND caixa = '.$params['caixa'];

    	$computador = $this->computadorDAO->encontrarPorCriterio('*', 'tb_computadores', $criterio);
    	
    	return $computador;
	}
}
?>
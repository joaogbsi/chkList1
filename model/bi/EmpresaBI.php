<?php

require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_BI .'GenericBI.php';
require_once PATH_MODEL_DAO.'EmpresaDAO.php';

class empresaBi extends GenericBI{

	private $empresaDAO;


	public function __construct($connection) {
		parent::__construct($connection);
	}

    public function adicionarEmpresa($empresa) {
        if (is_null($this->empresaDAO)) {
          $this->empresaDAO = new EmpresaDAO($this->connection);
        }

        $this->empresaDAO->inserirempresa($empresa);
    }


	public function alterarEmpresa($empresa, $cnpj) {
	    if (is_null($this->empresaDAO)) {
	      $this->empresaDAO = new EmpresaDAO($this->connection);
	    }

	    $this->empresaDAO->alterarEmpresa($empresa, $cnpj);
    }


    public function buscarEmpresa($cnpj){

    	if(is_null($this->empresaDAO)){
    		$this->empresaDAO = new EmpresaDAO($this->connection);
    	}

    	$empresa = $this->empresaDAO->procurarPorCnpj($cnpj);
    	
    	return $empresa;
    }

	public function recebeEmpresas(){
    	if(is_null($this->empresaDAO)){
    		$this->empresaDAO = new EmpresaDAO($this->connection);
    	}

    	$empresas = $this->empresaDAO->listarempresas();
    	
    	return $empresas;
    }


}
?>
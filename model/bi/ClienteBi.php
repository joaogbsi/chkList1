<?php

require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_BI .'GenericBI.php';
require_once PATH_MODEL_DAO.'ClienteDAO.php';

class ClienteBi extends GenericBI{

	private $clienteDAO;


	public function __construct($connection) {
		parent::__construct($connection);
	}

	public function adicionarCliente($cliente) {
	    if (is_null($this->clienteDAO)) {
	      $this->clienteDAO = new ClienteDAO($this->connection);
	    }

	    $this->clienteDAO->inserirCliente($cliente);
    }


    public function lerCliente($cnpj){
    	echo 'lerClienteBI';
    	if(is_null($this->clienteDAO)){
    		$this->clienteDAO = new ClienteDAO($this->connection);
    	}

    	$cliente = $this->clienteDAO->procurarPorCnpj($cnpj);
    	
    	return $cliente;
    }

	public function recebeClientes(){
    	if(is_null($this->clienteDAO)){
    		$this->clienteDAO = new ClienteDAO($this->connection);
    	}

    	$clientes = $this->clienteDAO->listarClientes();
    	
    	return $clientes;
    }


}
?>
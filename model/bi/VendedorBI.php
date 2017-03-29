<?php

require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_BI.'GenericBI.php';
require_once PATH_MODEL_DAO.'VendedorDAO.php';

class VendedorBI extends GenericBI{

	private $vendedorDAO;

	public function __construct($connection){
		parent::__construct($connection);
	}

	public function gravarVendedor($vendedor){
		if(is_null($this->vendedorDAO)){
			$this->vendedorDAO = new VendedorDAO($this->connection);
		}

		
		$this->vendedorDAO->inserirVendedor($vendedor);
	}

	public function deletarPorId($id){
		if(is_null($this->vendedorDAO)){
			$this->vendedorDAO = new VendedorDAO($this->connection);
		}

		$this->vendedorDAO->deletarPorId($id);
	}

	public function buscarPorCnpj($cnpj){
		if(is_null($this->vendedorDAO)){
			$this->vendedorDAO = new VendedorDAO($this->connection);
		}

		$criterio = 'cnpjEmp = '.$cnpj;
		return $this->vendedorDAO->encontrarPorCriterio('*', 'tb_vendedor', $criterio);
	}
	
	public function buscarVendedor($params, $cnpj){
		if(is_null($this->vendedorDAO)){
			$this->vendedorDAO = new VendedorDAO($this->connection);
		}

		$criterio = 'cnpjEmp = '.$cnpj
		            .' AND cpf = '.$params['cpf']
		            .' AND nome = "'.$params['nome']
		            .'" AND codigo = "'.$params['codigo']
		            .'" AND desconto = '.$params['desconto']
		            .' AND comissao = '.$params['comissao'];
		return $this->vendedorDAO->encontrarPorCriterio('*', 'tb_vendedor', $criterio);
	}

}
?>

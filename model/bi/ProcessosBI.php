<?php
require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_MODEL_BI .'GenericBI.php';
require_once PATH_MODEL_DAO.'ProcessosDAO.php';

class ProcessosBi extends GenericBI{

	private $processosDAO;

	public function __construct($connection) {
		parent::__construct($connection);
	}

	public function gravarProcessos($processos) {
	    if (is_null($this->processosDAO)) {
	      $this->processosDAO = new ProcessosDAO($this->connection);
	    }

	    $this->processosDAO->inserirProcessos($processos);
    }

	public function alterarProcessos($processos, $cnpj) {
	    if (is_null($this->processosDAO)) {
	      $this->processosDAO = new ProcessosDAO($this->connection);
	    }

	    $this->processosDAO->alterarProcessos($processos, $cnpj);
    }

    public function buscarPorCnpj($cnpj) {
	    if (is_null($this->processosDAO)) {
	      $this->processosDAO = new ProcessosDAO($this->connection);
	    }
	    $criterio = 'cnpjEmp = '.$cnpj;
	    return $this->processosDAO->encontrarPorCriterio('*', 'tb_processos', $criterio);
    }
}
?>
<?php
	require_once 'C:\xampp\htdocs\chkList_old\config.php';
	require_once PATH_CONTROLLER.'ClienteController.php';
	

	$clienteController = new ClienteController();

	$clientes = $clienteController->recebeClientes();
	$params = array();
	foreach ($clientes as $cliente) {
		$aux['cnpj'] = $cliente->getCnpj();
		$aux['empresa'] = $cliente->getEmpresa();
		$aux['respSistema'] = $cliente->getRespSistema();
		$aux['telefone'] = $cliente->getTelefone();
		$aux['email'] = $cliente->getEmail();

		$params[] = $aux;
	}

	//var_dump($params)
	echo json_encode($params);


	// if(is_array($clientes)){
	// 	echo 'if';
	// 	echo json_encode($clientes, JSON_FORCE_OBJECT);	
	// }
	

	//var_dump($clientes);



?>
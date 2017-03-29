<?php
	require_once 'C:\xampp\htdocs\chkList_old\config.php';
	require_once PATH_CONTROLLER.'EmpresaController.php';
	

	$empresaController = new EmpresaController();

	//var_dump($_GET);

	$empresas = $empresaController->recebeEmpresas();
	$params = array();
	foreach ($empresas as $empresa) {
		$aux['cnpj'] = $empresa->getCnpj();
		$aux['empresa'] = $empresa->getEmpresa();
		$aux['respSistema'] = $empresa->getRespSistema();
		$aux['telefone'] = $empresa->getTelefone();
		$aux['email'] = $empresa->getEmail();

		$params[] = $aux;
	}

	//var_dump($params)
	echo json_encode($params);


	// if(is_array($empresas)){
	// 	echo 'if';
	// 	echo json_encode($empresas, JSON_FORCE_OBJECT);	
	// }
	

	//var_dump($empresas);



?>
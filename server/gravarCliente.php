<?php

	/* if(isset($_POST['post'] = $_POST[])){
		$obj = json_decode($_POST['post'] = $_POST[]);
		//some php operation
	} */
	require_once 'C:\xampp\htdocs\chkList_old\config.php';
	require_once PATH_CONTROLLER.'EmpresaController.php';
	require_once PATH_CONTROLLER.'ComputadorController.php';
	require_once PATH_CONTROLLER.'EcfController.php';
	require_once PATH_CONTROLLER.'EqpRedeController.php';
	require_once PATH_CONTROLLER.'BalancaController.php';
	require_once PATH_CONTROLLER.'NobreakController.php';
	require_once PATH_CONTROLLER.'OperadorController.php';
	require_once PATH_CONTROLLER.'VendedorController.php';
	require_once PATH_CONTROLLER.'OutraInfController.php';
	require_once PATH_CONTROLLER.'SistemaController.php';
	require_once PATH_CONTROLLER.'RemotoController.php';
	require_once PATH_CONTROLLER.'ProcessosController.php';


	
	$jsonTobj = json_decode(file_get_contents("php://input"), true);
	
	/*
	var_dump($jsonTobj);
	*/
	
	$empresa = $jsonTobj['empresa'];
	$computadores = $jsonTobj['computadores'];
	$ecfs = $jsonTobj['ecfs'];
	$eqpRedes = $jsonTobj['eqpRedes'];
	$balancas = $jsonTobj['balancas'];
	$outraInf = $jsonTobj['outraInf'];
	$remoto = $jsonTobj['remoto'];
	$nobreaks = $jsonTobj['nBreaks'];
	$sistema = $jsonTobj['sistema'];
	$processos = $jsonTobj['processos'];
	$operadores = $jsonTobj['operadores'];
	$vendedores = $jsonTobj['vendedores'];
	

	/*
	var_dump( $empresa);
	var_dump( $eqpRedes);
	var_dump( $computadores);
	var_dump( $ecfs);
	var_dump( $balancas);
	var_dump( $nobreaks);
	var_dump( $operadores);
	var_dump( $vendedores);
	var_dump( $outraInf);
	var_dump( $sistema);
	var_dump( $remoto);
	var_dump( $processos);
*/
	
	$params['cnpj'] = $empresa['cnpj'];	
	$params['empresa'] = $empresa['empresa'];	
	$params['email'] = $empresa['email'];	
	$params['telefone'] = $empresa['telefone'];
	$params['respSistema'] = $empresa['respSistema'];
	$params['nUsuario'] = $empresa['nUsuario'];

	if(strcmp($empresa['loja'], 'Matriz') == 0){
		$params['loja'] = $empresa['loja'];
		if($empresa['filial'] > 0 || is_null($empresa['filial']))
			$params['filial'] = $empresa['filial'];
		else		
			$params['filial'] = 0;
	}else{
		$params['loja'] = $empresa['loja'];
	}

	$params['regime'] = $empresa['regime'];

	if($empresa['sintegra'])
		$params['sintegra'] = 1;
	else
		$params['sintegra'] = 0;

	if($empresa['spedFiscal'])
		$params['spedFiscal'] = 1;
	else
		$params['spedFiscal'] = 0;

	if($empresa['spedPis'])
	$params['spedPis'] = 1;
	
	$params['nFiscal'] = 0;

	if(strcmp($empresa['selRamo'], 'Outras') != 0)
		$params['ramo'] = $empresa['selRamo'];
	else
		$params['ramo'] = $empresa['ramoTipo'];

	/*
	var_dump($params);
	*/


	$empresaController = new EmpresaController();
	if(is_null($empresaController->buscarEmpresa($params['cnpj']))){
		$empresaController->gravarEmpresa($params);
	}else
		$empresaController->alterarEmpresa($params);

	if(!empty($computadores)){

		$computadorController = new ComputadorController();
		$aux = $computadorController->vetorComputadores($params['cnpj']);

		//var_dump($aux);

		foreach ($computadores as $computador) {
			
			
			
			$paramsComp['qtde'] = $computador['qtd'];
			$paramsComp['descricao'] = $computador['descricao'];
			$paramsComp['sistOp'] = $computador['sistOp'];
			$paramsComp['hd'] = $computador['hd'];
			$paramsComp['memoria'] = $computador['memoria'];
			$paramsComp['serial'] = $computador['serial'];
			$paramsComp['serv'] = $computador['serv'];
			$paramsComp['term'] = $computador['term'];
			$paramsComp['caixa'] = $computador['caixa'];

			$auxComp = $computadorController->buscarComputador($paramsComp, $params['cnpj']);

			if(is_null($auxComp)){
				$computadorController->gravarComputador($paramsComp, $params['cnpj']);
			}else{
				$key = array_search($auxComp[0]->getId(), $aux);
				unset($aux[$key]);
			}
		}
		if(!empty($aux)){
			foreach ($aux as $key) {
				$computadorController->deletarPorId($key);
			}
		}
	}

	if(!empty($ecfs)){

		$ecfController = new EcfController();
		$aux = $ecfController->vetorEcfs($params['cnpj']);

		foreach ($ecfs as $ecf) {
			$paramsEcf['qtde'] = $ecf['qtde'];
			$paramsEcf['marca'] = $ecf['marca'];

			$auxEcf = $ecfController->buscarEcf($paramsEcf, $params['cnpj']);

			if(is_null($auxEcf)){
				$ecfController->gravarEcf($paramsEcf, $params['cnpj']);
			}else{
				$key = array_search($auxEcf[0]->getId(), $aux);
				unset($aux[$key]);
			}
		}
		if(!empty($aux)){
			foreach ($aux as $key) {
				$ecfController->deletarPorId($key);
			}
		}

	}

	if(!empty($eqpRedes)){

		$eqpRedeController = new EqpRedeController();
		$aux = $eqpRedeController->vetorEqpRedes($params['cnpj']);

		foreach ($eqpRedes as $eqpRede) {
			$paramsEqpRede['qtde'] = $eqpRede['qtde'];
			$paramsEqpRede['marca'] = $eqpRede['marca'];

			$auxEqpRede = $eqpRedeController->buscarEqpRede($paramsEqpRede, $params['cnpj']);
			//var_dump($auxEqpRede);
			
			if(is_null($auxEqpRede)){
				$eqpRedeController->gravareqpRede($paramsEqpRede, $params['cnpj']);
			}else{
				$key = array_search($auxEcf[0]->getId(), $aux);
				unset($aux[$key]);
			}
		}
		if(!empty($aux)){
			foreach ($aux as $key) {
				$eqpRedeController->deletarPorId($key);
			}
		}

	}
	if(!empty($balancas)){

		$balancaController = new BalancaController();

		$aux = $balancaController->vetorBalanca($params['cnpj']) ;
								
		foreach ($balancas as $balanca) {
			$paramsBalanca['qtde'] = $balanca['qtde'];
			$paramsBalanca['marca'] = $balanca['marca'];

			$auxBalanca= $balancaController->buscarBalanca($paramsBalanca, $params['cnpj']);

			if(is_null($auxBalanca)){
				$balancaController->gravarBalanca($paramsBalanca, $params['cnpj']);				
			}else{
				$key = array_search($auxBalanca[0]->getId(), $aux);
				unset($aux[$key]);
			}

		}
		if(!empty($aux)){
			foreach ($aux as $key) {
				$balancaController->deletarPorId($key);
			}
		}

	}

	if(!empty($nobreaks)){

		$nobreakController = new NobreakController();

		$aux = $nobreakController->vetorNobreak($params['cnpj']);
							
		foreach ($nobreaks as $nobreak) {
			$paramsNobreak['qtde'] = $nobreak['qtde'];
			$paramsNobreak['marca'] = $nobreak['marca'];
			$paramsNobreak['serv'] = $nobreak['serv'];
			$paramsNobreak['term'] = $nobreak['term'];
			$paramsNobreak['caixa'] = $nobreak['caixa'];

			$auxNobreak = $nobreakController->buscarNobreak($paramsNobreak, $params['cnpj']);

			if(is_null($auxNobreak)){
				$nobreakController->gravarNobreak($paramsNobreak, $params['cnpj']);
			}
			else{
				$key = array_search($auxNobreak[0]->getId(), $aux);
				unset($aux[$key]);
			}
		}
		if(!empty($aux)){
			foreach ($aux as $key) {
				$nobreakController->deletarPorId($key);
			}
		}

	}

	if(!empty($operadores)){

		$operadorController = new OperadorController();
		//echo $cnpj;
		$aux = $operadorController->vetorOperador($params['cnpj']);
	
							
		foreach ($operadores as $operador) {

			$paramsOperador['cpf'] =      $operador['cpf'];
			$paramsOperador['nome'] =     $operador['nome'];
			$paramsOperador['turno'] =    $operador['turno'];
			$paramsOperador['descAcr'] =  $operador['descAcr'];
			$paramsOperador['cancelar'] = $operador['cancelar'];
			$paramsOperador['liberar'] =  $operador['liberar'];
			$paramsOperador['redZ'] =     $operador['redZ'];
			$paramsOperador['suprSang'] = $operador['suprSang'];
			
			$auxOperador = $operadorController->buscarOperdador($paramsOperador, $params['cnpj']);
			if(is_null($auxOperador)){
				//echo 'gravarOperador <br />';
				$operadorController->gravarOperador($paramsOperador, $params['cnpj']);
			}else{
				$key = array_search($auxOperador[0]->getId(), $aux);
				unset($aux[$key]);
			}
		}
		if(!empty($aux)){
			foreach ($aux as $key) {
				$operadorController->deletarPorId($key);
			}
		}

	}

	if(!empty($vendedores)){

		$vendedorController = new VendedorController();
		$aux = $vendedorController->vetorVendedor($params['cnpj']);
							
		foreach ($vendedores as $vendedor) {

			$paramsVendedor['cpf'] =       $vendedor['cpf'];
			$paramsVendedor['nome'] =      $vendedor['nome'];
			$paramsVendedor['codigo'] =    $vendedor['codigo'];
			$paramsVendedor['desconto'] =  $vendedor['desconto'];
			$paramsVendedor['comissao'] =  $vendedor['comissao'];
			
			/*
			var_dump($paramsVendedor);
			*/

			$auxVendedor = $vendedorController->buscarVendedor($paramsVendedor, $params['cnpj']);

			if(is_null($auxVendedor)){
				$vendedorController->gravarVendedor($paramsVendedor, $params['cnpj']);
			}else{
				$key = array_search($auxVendedor[0]->getId(), $aux);
				unset($aux[$key]);
			}
		}
		if(!empty($aux)){
			foreach ($aux as $key) {
				$vendedorController->deletarPorId($key);
			}
		}

	}
	
	if(!empty($outraInf)){

		$outraInfController = new OutraInfController();

		//$paramsOutraInf['cnpjEmp'] =            $outraInf['cnpjEmp'];
		$paramsOutraInf['certDigital'] =        $outraInf['certDigital'];
		$paramsOutraInf['tipoInternet'] =       $outraInf['tipoInternet'];
		$paramsOutraInf['qualInternet'] =       $outraInf['qualInternet'];
		$paramsOutraInf['impEtiqueta'] =        $outraInf['impEtiqueta'];
		$paramsOutraInf['marcaTef'] =           $outraInf['marcaTef'];
		$paramsOutraInf['tipoTef'] =            $outraInf['tipoTef'];
		$paramsOutraInf['impressora'] =         $outraInf['impressora'];
		$paramsOutraInf['colDados'] =           $outraInf['colDados'];
		$paramsOutraInf['leitorMesaMarca'] =    $outraInf['leitorMesaMarca'];
		$paramsOutraInf['leitorMesaQtd'] =      $outraInf['leitorMesaQtd'];
		$paramsOutraInf['leitorMesaUsb'] =      $outraInf['leitorMesaUsb'];
		$paramsOutraInf['leitorMaoMarca'] =     $outraInf['leitorMaoMarca'];
		$paramsOutraInf['leitorMaoQtd'] =       $outraInf['leitorMaoQtd'];
		$paramsOutraInf['leitorMaoUsb'] =       $outraInf['leitorMaoUsb'];
		$paramsOutraInf['palmMarca'] =          $outraInf['palmMarca'];
		$paramsOutraInf['palmQtd'] =            $outraInf['palmQtd'];
		$paramsOutraInf['palmSO'] =             $outraInf['palmSO'];
		$paramsOutraInf['nomeSistema'] =        $outraInf['nomeSistema'];
		$paramsOutraInf['buscaPreco'] =         $outraInf['buscaPreco'];

		/*
		var_dump($paramsOutraInf);
		*/
		
		if(is_null($outraInfController->buscarPorCnpj($params['cnpj']))){
			$outraInfController->gravarOutraInf($paramsOutraInf, $params['cnpj']);
		}else{
			$outraInfController->alterarOutraInf($paramsOutraInf, $params['cnpj']);

		}
			
	}

	if(!empty($remoto)){

		$remotoController = new RemotoController();
							
		

			$paramsRemoto['recebeAcesso'] =       $remoto['recebeAcesso'];
			$paramsRemoto['interligaFilial'] =      $remoto['interligaFilial'];
			if(!empty($remoto['ipFixo']) || !is_null($remoto['ipFixo']) ){
				$paramsRemoto['ipFixo'] =    $remoto['ipFixo'];
				$paramsRemoto['selIpFixo'] =    'S';
			}else
				$paramsRemoto['selIpFixo'] =    'N';

			/*
			var_dump($paramsRemoto);
			*/

			if(is_null($remotoController->buscarPorCnpj($params['cnpj'])))
				$remotoController->gravarRemoto($paramsRemoto, $params['cnpj']);
			else
				$remotoController->alterarRemoto($paramsRemoto, $params['cnpj']);

	}
	
	
	if(!empty($sistema)){

		$sistemaController = new SistemaController();

		//$paramsSistema['cnpjEmp'] =            $sistema['cnpjEmp'];
		if(!is_null($sistema['intellicashFull']))
			$paramsSistema['intellicashFull'] =   $sistema['intellicashFull'];
		else
			$paramsSistema['intellicashFull'] =   false;

		if(!is_null($sistema['intellicashLight']))
			$paramsSistema['intellicashLight'] =  $sistema['intellicashLight'];
		else
			$paramsSistema['intellicashLight'] =   false;
		
		if(!is_null($sistema['easycash']))			
			$paramsSistema['easycash'] =          $sistema['easycash'];
		else
			$paramsSistema['easycash'] =   false;
		
		if(!is_null($sistema['gnfe']))			
			$paramsSistema['gnfe'] =              $sistema['gnfe'];
		else
			$paramsSistema['gnfe'] =   false;

		if(!is_null($sistema['cotacao']))			
			$paramsSistema['cotacao'] =           $sistema['cotacao'];
		else
			$paramsSistema['cotacao'] =   false;

		if(!is_null($sistema['intelligroup']))			
			$paramsSistema['intelligroup'] =      $sistema['intelligroup'];
		else
			$paramsSistema['intelligroup'] =   false;

		if(!is_null($sistema['intellistock']))			
			$paramsSistema['intellistock'] =      $sistema['intellistock'];
		else
			$paramsSistema['intellistock'] =   false;

		if(!is_null($sistema['vendaAssistida']))			
			$paramsSistema['vendaAssistida'] =    $sistema['vendaAssist'];
		else
			$paramsSistema['vendaAssistida'] =   false;

		if(!is_null($sistema['orcamento']))			
			$paramsSistema['orcamento'] =         $sistema['orcamento'];
		else
			$paramsSistema['orcamento'] =   false;

		if(!is_null($sistema['pedido']))			
			$paramsSistema['pedido'] =            $sistema['pedido'];
		else
			$paramsSistema['pedido'] =   false;

		if(!is_null($sistema['produto']))			
			$paramsSistema['produto'] =           $sistema['produto'];
		else
			$paramsSistema['produto'] =   false;

		if(!is_null($sistema['edi']))			
			$paramsSistema['edi'] =               $sistema['edi'];
		else
			$paramsSistema['edi'] =   false;

		if(!is_null($sistema['mgMobile']))			
			$paramsSistema['mgMobile'] =          $sistema['mgMobile'];
		else
			$paramsSistema['mgMobile'] =   false;

		if(!is_null($sistema['nfDestinada']))			
			$paramsSistema['nfDestinada'] =       $sistema['nfDestinada'];
		else
			$paramsSistema['nfDestinada'] =   false;

		if(!is_null($sistema['contasPgRc']))			
			$paramsSistema['contasPgRc'] =        $sistema['contasPgRc'];
		else
			$paramsSistema['contasPgRc'] =   false;

		if(!is_null($sistema['sincronizador']))			
			$paramsSistema['sincronizador'] =     $sistema['sincronizador'];
		else
			$paramsSistema['sincronizador'] =   false;

		if(!is_null($sistema['entregaCega']))			
			$paramsSistema['entregaCega'] =       $sistema['entregaCega'];
		else
			$paramsSistema['entregaCega'] =   false;

		if(!is_null($sistema['cte']))			
			$paramsSistema['cte'] =               $sistema['cte'];
		else
			$paramsSistema['cte'] =   false;

		if(is_null($sistemaController->buscarPorCnpj($params['cnpj']))){
			$sistemaController->gravarSistema($paramsSistema, $params['cnpj']);
		}else{
			$sistemaController->alterarSistema($paramsSistema, $params['cnpj']);
		}
	}
	if(!empty($processos)){

		$processosController = new ProcessosController();

		//$paramsProcessos['cnpjEmp'] =            $processos['cnpjEmp'];
		$paramsProcessos['qtdCadastro'] =        $processos['qtdCadastro'];
		$paramsProcessos['fechamentoDiario'] =   $processos['fechamentoDiario'];
		
		if(!is_null($processos['pessoaLanc']))
			$paramsProcessos['pessoaLanc'] =     $processos['pessoaLanc'];
		if(!is_null($processos['lancPreco']))
			$paramsProcessos['lancPreco'] =      $processos['lancPreco'];
		if(!is_null($processos['recebeMerc']))
			$paramsProcessos['recebeMerc'] =     $processos['recebeMerc'];
		if(!is_null($processos['compraVenda']))
			$paramsProcessos['compraVenda'] =    $processos['compraVenda'];
		if(!is_null($processos['fiscalVendas']))
			$paramsProcessos['fiscalVendas'] =    $processos['fiscalVendas'];
		if(!is_null($processos['respFechamento']))
			$paramsProcessos['respFechamento'] = $processos['respFechamento'];
		if(!is_null($processos['respFinanceiro']))
			$paramsProcessos['respFinanceiro'] = $processos['respFinanceiro'];
		/*		
		var_dump($paramsProcessos);
		*/

		if(is_null($processosController->buscarPorCnpj($params['cnpj'])))
			$processosController->gravarProcessos($paramsProcessos, $params['cnpj']);
		else
			$processosController->alterarProcessos($paramsProcessos, $params['cnpj']);

	}

?>


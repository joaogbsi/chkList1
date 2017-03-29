<?php

require_once 'C:\xampp\htdocs\chkList_old\config.php';
require_once PATH_CONTROLLER.'EmpresaController.php';
require_once PATH_CONTROLLER.'ComputadorController.php';
require_once PATH_CONTROLLER.'BalancaController.php';
require_once PATH_CONTROLLER.'EcfController.php';
require_once PATH_CONTROLLER.'EqpRedeController.php';
require_once PATH_CONTROLLER.'NobreakController.php';
require_once PATH_CONTROLLER.'VendedorController.php';
require_once PATH_CONTROLLER.'OperadorController.php';
require_once PATH_CONTROLLER.'OutraInfController.php';
require_once PATH_CONTROLLER.'SistemaController.php';
require_once PATH_CONTROLLER.'RemotoController.php';
require_once PATH_CONTROLLER.'ProcessosController.php';
require_once PATH_MODEL_ENTITIES.'Cliente.class.php';

/*	$teste = getallheaders()['cnpj'];
	echo $teste.'<br />';
*/
	/*foreach (getallheaders() as $name => $value) {
	    //echo "$name: $value\n";
	    echo "$name: \n";
	}*/

	
	$cliente = new Cliente();

	$empresaController = new EmpresaController();
	$computadorController = new ComputadorController();
	$balancaController = new BalancaController();
	$ecfController = new EcfController();
	$eqpRedesController = new EqpRedeController();
	$nobreakController = new NobreakController();
	$vendedorController = new VendedorController();
	$operadorController = new OperadorController();
	$outrasInfController = new OutraInfController();
	$sistemaController = new SistemaController();
	$remotoController = new RemotoController();
	$processosController = new ProcessosController();

	$jsonTobj = json_decode(file_get_contents("php://input"), true);
	//var_dump($jsonTobj);

	//$cnpj = $jsonTobj['cnpj'];
	//var_dump(getallheaders());
	$cnpj = getallheaders()['cnpj'];
	
	if(!is_null($empresa = $empresaController->buscarEmpresa($cnpj))){

			$cliente->setEmpresa($empresa);
	
			$prmEmpresa['cnpj']=$empresa->getCnpj();
			$prmEmpresa['empresa']=$empresa->getEmpresa();
			$prmEmpresa['email']=$empresa->getEmail();
			$prmEmpresa['telefone']=$empresa->getTelefone();
			$prmEmpresa['respSistema']=$empresa->getRespSistema();
			$prmEmpresa['nUsuario']=$empresa->getNUsuario();
			$prmEmpresa['loja']=$empresa->getLoja();
			$prmEmpresa['filial']=$empresa->getFilial();
			if(strcmp($empresa->getRegime(), 'SN') == 0){
				$prmEmpresa['regime']='SN';			
			}else if(strcmp($empresa->getRegime(), 'lPres') == 0){
				$prmEmpresa['regime']='lPres';
			}else if(strcmp($empresa->getRegime(), 'lReal') == 0){
				$prmEmpresa['regime']='lReal';
			}
	
			if($empresa->getNFiscal() == 1){
				$prmEmpresa['chkNaoFiscal']=true;
			}else{
				$prmEmpresa['chkNaoFiscal']=false;
			}
	
			if(strcmp($empresa->getRamo(), 'Supermercado') == 0 ||
			   strcmp($empresa->getRamo(), 'Loja') == 0 ||
			   strcmp($empresa->getRamo(), 'Mat. Construção') == 0
			   )
				$prmEmpresa['selRamo']=$empresa->getRamo();
			else{
				$prmEmpresa['selRamo']= 'Outras';
				$prmEmpresa['ramoTipo']= $empresa->getRamo();
			}
	
			if($empresa->getSintegra() == 1){
				$prmEmpresa['sintegra']=true;
			}else{
				$prmEmpresa['sintegra']=false;
			}
	
			if($empresa->getSpedFiscal() == 1)
				$prmEmpresa['spedFiscal']=true;
			else
				$prmEmpresa['spedFiscal']=false;
			if($empresa->getSpedPis() == 1)
				$prmEmpresa['spedPis']=true;
			else
				$prmEmpresa['spedPis']=false;
	
		
	
		if(!is_null($computadores = $computadorController->lerComputador($cnpj))){

			$cliente->setComputadores($computadores);
	
			foreach ($computadores as $computador) {
				unset($aux);
				$aux['id'] = $computador->getId();
				$aux['cnpjEmp'] = $computador->getCnpjEmp();
				$aux['qtd'] = $computador->getQtde();
				$aux['descricao'] = $computador->getDescricao();
				$aux['sistOp'] = $computador->getSistOp();
				$aux['hd'] = $computador->getHd();
				$aux['memoria'] = $computador->getMemoria();
				$aux['serial'] = $computador->getSerial();
				$aux['serv'] = $computador->getServ();
				$aux['term'] = $computador->getTerm();
				$aux['caixa'] = $computador->getCaixa();
	
				$prmComputadores[] = $aux;
			}
	
		}else
			$prmComputadores='';
	
		if(!is_null($balancas = $balancaController->buscarPorCnpj($cnpj))){

			$cliente->setBalancas($balancas);
	
			foreach ($balancas as $balanca) {
				
				unset($aux);
				$aux['id'] = $balanca->getId ();
				$aux['cnpjEmp'] = $balanca->getCnpjEmp();
				$aux['qtde'] = $balanca->getQtde();
				$aux['marca'] = $balanca->getMarca();
	
				$prmBalancas[] = $aux;
			}
	
		
		}else
			$prmBalancas = '';
	
		if(!is_null($ecfs = $ecfController->buscarPorCnpj($cnpj))){
	
			$cliente->setEcfs($ecfs);
			foreach ($ecfs as $ecf) {
				unset($aux);
	
				$aux['id'] = $ecf->getId ();
				$aux['cnpjEmp'] = $ecf->getCnpjEmp();
				$aux['qtde'] = $ecf->getQtde();
				$aux['marca'] = $ecf->getMarca();
				
				$prmEcfs[] = $aux;
			}
			
		}else
			$prmEcfs = '';
	
		if(!is_null($eqpRedes = $eqpRedesController->buscarPorCnpj($cnpj))){
			$cliente->setEqpRedes($eqpRedes);
			foreach ($eqpRedes as $eqpRede) {
				unset($aux);
	
				$aux['id'] = $eqpRede->getId ();
				$aux['cnpjEmp'] = $eqpRede->getCnpjEmp();
				$aux['qtde'] = $eqpRede->getQtde();
				$aux['marca'] = $eqpRede->getMarca();
	
				$prmEqpRedes[] = $aux;
			}
			
		}else
			$prmEqpRedes = '';
	
		if(!is_null($nobreaks = $nobreakController->buscarPorCnpj($cnpj))){

			$cliente->setNobreaks($nobreaks);
	
			foreach ($nobreaks as $nobreak) {
				unset($aux);
	
				$aux['id'] = $nobreak->getId();
				$aux['cnpjEmp'] = $nobreak->getCnpjEmp();
				$aux['qtde'] = $nobreak->getQtde();
				$aux['marca'] = $nobreak->getMarca();
				$aux['serv'] = $nobreak->getServ();
				$aux['term'] = $nobreak->getTerm();
				$aux['caixa'] = $nobreak->getCaixa();
	
				$prmNobreaks[] = $aux;
			}
		
		}else
			$prmNobreaks = '';
	
		if(!is_null($vendedores = $vendedorController->buscarPorCnpj($cnpj))){
	
			foreach ($vendedores as $vendedor) {
				unset($aux);
	
				$aux['cpf'] = $vendedor->getCpf();
				$aux['cnpjEmp'] = $vendedor->getCnpjEmp();
				$aux['nome'] = $vendedor->getNome();
				$aux['codigo'] = $vendedor->getCodigo();
				$aux['desconto'] = $vendedor->getDesconto();
				$aux['comissao'] = $vendedor->getComissao();	
	
				$prmVendedores[] = $aux;
			}
			$cliente->setVendedores($vendedor);		
		}else
			$prmVendedores = '';
	
		if(!is_null($operadores = $operadorController->buscarPorCnpj($cnpj))){
	
			foreach ($operadores as $operador) {
				unset($aux);
	
				$aux['cpf'] = $operador->getCpf();
				$aux['cnpjEmp'] = $operador->getCnpjEmp();
				$aux['nome'] = $operador->getNome();
				$aux['turno'] = $operador->getTurno();
				$aux['descAcr'] = $operador->getDescAcr();
				$aux['cancelar'] = $operador->getCancelar();
				$aux['liberar'] = $operador->getLiberar();
				$aux['redZ'] = $operador->getRedZ();
				$aux['suprSang'] = $operador->getSuprSang();
	
				$prmOperadores[] = $aux;
			}
			$cliente->setOperadores($operador);		
		}else
			$prmOperadores = '';
	
		if(!is_null($outrasInf = $outrasInfController->buscarPorCnpj($cnpj))){
	
			$prmOutrasInf['cnpjEmp'] =          $outrasInf->getCnpjEmp();
			$prmOutrasInf['certDigital'] =      $outrasInf->getCertDigital();
			$prmOutrasInf['tipoInternet'] =     $outrasInf->getTipoInternet();
			$prmOutrasInf['qualInternet'] =     $outrasInf->getQualInternet();
			if(!empty($outrasInf->getBuscaPreco())){
				$prmOutrasInf['buscaPreco'] =       $outrasInf->getBuscaPreco();
				//$prmOutrasInf['selBuscaPreco'] =    'S';
			}else{
				$prmOutrasInf['selBuscaPreco'] =    'N';
			}

			if(!empty($outrasInf->getImpEtiqueta())){
				$prmOutrasInf['impEtiqueta'] =    $outrasInf->getImpEtiqueta();
				//$prmOutrasInf['selImpEti'] =      'S';
			}else{
				$prmOutrasInf['selImpEti'] =      'N';
			}

			if(!empty($outrasInf->getMarcaTef())){
				$prmOutrasInf['marcaTef'] =         $outrasInf->getMarcaTef();
				$prmOutrasInf['tipoTef'] =          $outrasInf->getTipoTef();				
				//$prmOutrasInf['selTef'] =      'S';
			}else{
				$prmOutrasInf['selTef'] =      'N';
			}

			$prmOutrasInf['impressora'] =       $outrasInf->getImpressora();
			$prmOutrasInf['colDados'] =         $outrasInf->getColDados();
			if(!empty($outrasInf->getLeitorMesaMarca())){
				$prmOutrasInf['leitorMesaMarca'] =  $outrasInf->getLeitorMesaMarca();
				$prmOutrasInf['leitorMesaQtd'] =    $outrasInf->getLeitorMesaQtd();
				if($outrasInf->getLeitorMesaUsb() == 1){
					$prmOutrasInf['leitorMesaUsb'] =     true;
				}else{
					$prmOutrasInf['leitorMesaUsb'] =     false;
				}
			}else{
				$prmOutrasInf['selLeitorMesa'] =    'N';				
			}

			if(!empty($outrasInf->getLeitorMaoMarca())){
				$prmOutrasInf['leitorMaoMarca'] =   $outrasInf->getLeitorMaoMarca();
				$prmOutrasInf['leitorMaoQtd'] =     $outrasInf->getLeitorMaoQtd();
				if($outrasInf->getLeitorMaoUsb() == 1){
					$prmOutrasInf['leitorMaoUsb'] =     true;
				}else{
					$prmOutrasInf['leitorMaoUsb'] =     false;
				}
			}else{
				$prmOutrasInf['selLeitorMaoUsb'] =    'N';
			}

			if(!empty($outrasInf->getPalmMarca())){
				$prmOutrasInf['palmMarca'] =        $outrasInf->getPalmMarca();
				$prmOutrasInf['palmQtd'] =          $outrasInf->getPalmQtd();
				$prmOutrasInf['palmSO'] =           $outrasInf->getPalmSO();				
			}else{
				$prmOutrasInf['selPalm'] =          'N';

			}

			if(!empty($outrasInf->getNomeSistema())){
				$prmOutrasInf['nomeSistema'] =      $outrasInf->getNomeSistema();				
			}else{
				$prmOutrasInf['selNomeSistema'] =      'N';				

			}
	
		}else
			$prmOutrasInf = '';
	
		if(!is_null($sistema = $sistemaController->buscarPorCnpj($cnpj))){

			$cliente->setSistema($sistema);
	
			//$prmSistema['cnpjEmp'] =           $sistema->getCnpjEmp;
			
			if($sistema->getIntellicashFull() == 1)
				$prmSistema['intellicashFull'] =   true;
			
			if($sistema->getIntellicashLight() == 1)
				$prmSistema['intellicashLight'] =  true;
			
			if($sistema->getEasycash() == 1)
				$prmSistema['easycash'] =          true;
			
			if($sistema->getGnfe() == 1)
				$prmSistema['gnfe'] =              true;
			
			if($sistema->getCotacao() == 1)
				$prmSistema['cotacao'] =           true;
			
			if($sistema->getIntelligroup() == 1)
				$prmSistema['intelligroup'] =      true;
			
			if($sistema->getIntellistock() == 1)
				$prmSistema['intellistock'] =      true;
			
			if($sistema->getVendaAssistida() == 1)
				$prmSistema['vendaAssistida'] =    true;
			
			if($sistema->getOrcamento() == 1)
				$prmSistema['orcamento'] =         true;
			
			if($sistema->getPedido() == 1)
				$prmSistema['pedido'] =            true;
			
			if($sistema->getProduto() == 1)
				$prmSistema['produto'] =           true;
			
			if($sistema->getEdi() == 1)
				$prmSistema['edi'] =               true;
			
			if($sistema->getMgMobile() == 1)
				$prmSistema['mgMobile'] =          true;
			
			if($sistema->getNfDestinada() == 1)
				$prmSistema['nfDestinada'] =       true;
			
			if($sistema->getContasPgRc() == 1)
				$prmSistema['contasPgRc'] =        true;
			
			if($sistema->getSincronizador() == 1)
				$prmSistema['sincronizador'] =     true;
			
			if($sistema->getEntregaCega() == 1)
				$prmSistema['entregaCega'] =       true;
			
			if($sistema->getCte() == 1)
				$prmSistema['cte'] =               true;
			
		}else
			$prmSistema = '';
	
		if(!is_null($remoto = $remotoController->buscarPorCnpj($cnpj))){

			$cliente->setRemoto($remoto);
	
			$prmRemoto['cnpjEmp'] =          $remoto->getCnpjEmp();
			/*if($remoto->getRecebeAcesso() == 1)
				$prmRemoto['recebeAcesso'] =     'S';
			else
				$prmRemoto['recebeAcesso'] =     'N';

			if($remoto->getInterligaFilial() == 1)
				$prmRemoto['interligaFilial'] =  'S';
			else
				$prmRemoto['interligaFilial'] =  'N';*/
			$prmRemoto['recebeAcesso'] = $remoto->getRecebeAcesso();
			$prmRemoto['interligaFilial'] = $remoto->getInterligaFilial();
			if(!empty($remoto->getIpFixo())){
				$prmRemoto['ipFixo'] =           $remoto->getIpFixo();
			}else
				$prmRemoto['selIpFixo'] =           'N';

		
		}else
			$prmRemoto = '';
	
		if(!is_null($processos = $processosController->buscarPorCnpj($cnpj))){
	
			$prmProcessos['cnpjEmp'] =         $processos->getCnpjEmp();			
			$prmProcessos['qtdCadastro'] =     $processos->getQtdCadastro();
			
			if(!empty($processos->getPessoaLanc()))
				$prmProcessos['pessoaLanc'] =     $processos->getPessoaLanc();
			else
				$prmProcessos['selPessoaLanc'] =   'N';
			if(!empty($processos->getLancPreco()))
				$prmProcessos['lancPreco'] =     $processos->getLancPreco();
			else
				$prmProcessos['selLancPreco'] =   'N';

			if(!empty($processos->getRecebeMerc()))
				$prmProcessos['recebeMerc'] =     $processos->getRecebeMerc();
			else
				$prmProcessos['selRecebeMerc'] =   'N';

			if(!empty($processos->getCompraVenda()))
				$prmProcessos['compraVenda'] =     $processos->getCompraVenda();
			else
				$prmProcessos['selCompraVenda'] =   'N';
			
			if(!empty($processos->getFiscalVendas()))
				$prmProcessos['fiscalVendas'] =     $processos->getFiscalVendas();
			else
				$prmProcessos['selFiscalVendas'] =   'N';
			
			if($processos->getFechamentoDiario() == 1)
				$prmProcessos['fechamentoDiario'] =     'S';
			else
				$prmProcessos['fechamentoDiario'] =   'N';
			
			
			if(!empty($processos->getFiscalVendas()))
				$prmProcessos['respFechamento'] =     $processos->getRespFechamento();
			else
				$prmProcessos['selRespFinanceiro'] =   'S';

			if(!empty($processos->getRespFinanceiro()))
				$prmProcessos['respFinanceiro'] =     $processos->getRespFinanceiro();
			else
				$prmProcessos['selRespFinanceiro'] =   'S';
			
			
			$cliente->setProcessos($processos);		
		}else
			$prmProcessos = "";
	
		$params = array();

		//var_dump($cliente);
	
	
		//if(!empty($prmEmpresa)){
			$params['empresa'] = $prmEmpresa;
			$params['computadores'] = $prmComputadores;
			$params['balancas'] = $prmBalancas;
			$params['ecfs'] = $prmEcfs;
			$params['eqpRedes'] = $prmEqpRedes;
			$params['nobreaks'] = $prmNobreaks;
			$params['vendedores'] = $prmVendedores;
			$params['operadores'] = $prmOperadores;
			$params['outrasInf'] = $prmOutrasInf;
			$params['sistema'] = $prmSistema;
			$params['remoto'] = $prmRemoto;
			$params['processos'] = $prmProcessos;
			//$params['computador'] = $cliente->getComputadores();
			//var_dump($params);
		//}
		echo json_encode($params);
		//echo json_encode($cliente);
	}
	
?>
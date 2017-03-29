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
require_once PATH.'/mpdf60/mpdf.php';  

/*
class ImprimirCliente extends mpdf{

}
	$teste = getallheaders()['cnpj'];
	echo $teste.'<br />';
*/
	/*foreach (getallheaders() as $name => $value) {
	    //echo "$name: $value\n";
	    echo "$name: \n";
	}*/

	$cliente = new Cliente();

	//$empresaController = new EmpresaController();
	//$computadorController = new ComputadorController();
	//$balancaController = new BalancaController();
	//$ecfController = new EcfController();
	//$eqpRedesController = new EqpRedeController();
	//$nobreakController = new NobreakController();
	$vendedorController = new VendedorController();
	$operadorController = new OperadorController();
	//$outrasInfController = new OutraInfController();
	$sistemaController = new SistemaController();
	$remotoController = new RemotoController();
	$processosController = new ProcessosController();

	$jsonTobj = json_decode(file_get_contents("php://input"), true);
	
	$cnpj = getallheaders()['cnpj'];

	
	ob_start();
	
	$retorno = "";

	function tabelaEmpresa($cnpj){
		//echo $cnpj;
		$empresaController = new EmpresaController();

		if(!is_null($empresa = $empresaController->buscarEmpresa($cnpj))){
		//var_dump($empresa);
		
			$retorno.="
				<h1>Dados da empresa</h1>
				<table>
				<th colspan=\"6\">Dados Empresa</th>
				<tr>
					<td>Empresa:</td>
					<td colspan=\"2\">".$empresa->getEmpresa()."</td>
					<td>CNPJ:</td>
					<td colspan=\"2\">".$empresa->getCnpj()."</td>
				</tr>
				<tr>
					<td>E-mail:</td>
					<td colspan=\"2\">".$empresa->getEmail()."</td>
					<td>Tel.</td>
					<td colspan=\"2\">".$empresa->getTelefone()."</td>
				</tr>
				<tr>
					<td>Responsavel:</td>
					<td colspan=\"2\">".$empresa->getRespSistema()."</td>
					<td>Numero de Usuários</td>
					<td colspan=\"2\">".$empresa->getNUsuario()."</td>
				</tr>
				<tr>";
				if($empresa->getRamo()){
					$retorno.="
						<td>Ramo:</td>
						<td>".$empresa->getRamo()."</td>
					";
				}
				if($empresa->getLoja()){
					$retorno.="
						<td>Loja:</td>
						<td>".$empresa->getLoja()."</td>
					";
				}
				$retorno.="<td>Possui Filial:</td>
						   <td>"	;
				if($empresa->getFilial()) 
					$retorno.= $empresa->getFilial()."</td>";
				else
					$retorno.= '0</td>'; 
										
				$retorno.="</tr>
				<tr>";
				if($empresa->getRegime()){
					$retorno.="<td>Regime:</td>
					<td>";
					//echo $empresa->getRegime();	
					if(strcmp($empresa->getRegime(), 'lPres') == 0)
						$retorno.= 'Lucro Presumido</td>';
					if(strcmp($empresa->getRegime(), 'lReal') == 0)
						$retorno.='Lucro Real</td>';
					if(strcmp($empresa->getRegime(), 'SN') == 0)
						$retorno.='Simples Nacional</td>';
				}
				if($empresa->getSintegra()){
					$retorno.="<td>Fiscal:</td>
					<td >";
					$fiscal = '';
					if($empresa->getSintegra() == 1){
						$fiscal .= 'Sintegra';
					}
					if($empresa->getSpedFiscal() == 1){
						if(!empty($fiscal)){
							$fiscal .= ', ';
						}
						$fiscal .= 'Fiscal';
					}
					if($empresa->getSpedPis() == 1){
						if(!empty($fiscal)){
							$fiscal .= ', ';
						}
						$fiscal .= 'Contribuições';
					}
					$retorno.=$fiscal."</td>";
				}
				if($empresa->getNFiscal()){
					$retorno.="
							
						<td>100% Fiscal</td>
						<td>";
							
						if($empresa->getNFiscal()) 
							$retorno.= $empresa->getNFiscal();
						else
							$retorno.='0'; 
											
						$retorno.="</td>";
					
				}
				$retorno.="
				</tr>

			</table>
			";

			return $retorno;
		}
	}

	function tabelaComputadores($cnpj){
		$computadorController = new ComputadorController();

		if(!is_null($computadores = $computadorController->lerComputador($cnpj))){
			$retorno ="
			<h4>Dados dos Computadores</h4>
			<table>
				<th colspan=\"9\">Computadores</th>
				<tr>
					<th>Qtde</th>
					<th>Descrição</th>
					<th>Sist. OP</th>
					<th>HD</th>
					<th>Memoria</th>
					<th>Serial</th>
					<th>Serv.</th>
					<th>Term.</th>
					<th>Caixa</th>		
				</tr>";

			foreach ($computadores as $computador) {
				$retorno.="<tr>";
					$retorno.="<td>".$computador->getQtde()."</td>";
					$retorno.="<td>".$computador->getDescricao()."</td>";
					$retorno.="<td>".$computador->getSistOp()."</td>";
					$retorno.="<td>".$computador->getHd()."</td>";
					$retorno.="<td>".$computador->getMemoria()."</td>";
					$retorno.="<td>".$computador->getSerial()."</td>";
					$retorno.="<td>".$computador->getServ()."</td>";
					$retorno.="<td>".$computador->getTerm()."</td>";
					$retorno.="<td>".$computador->getCaixa()."</td>";
				$retorno.="</tr>";
			}
			$retorno.="</table>";
			return $retorno;
		}
	}

	function tabelaEcf($cnpj){
		$ecfController = new EcfController();


		if(!is_null($ecfs = $ecfController->buscarPorCnpj($cnpj))){
			$retorno ="
			<h4>ECF</h4>
			<table>
				<tr>
					<th>Qtde</th>
					<th>Marca</th>
				</tr>";
			foreach ($ecfs as $ecf) {
				$retorno.="<tr>";
					$retorno.="<td>".$ecf->getQtde()."</td>";
					$retorno.="<td>".$ecf->getMarca()."</td>";
				$retorno.="</tr>";
			}

			$retorno.="
			</table>
			";

			return $retorno;
		}

	}

	function tabelaBalanca($cnpj){
		$balancaController = new BalancaController();

		if(!is_null($balancas = $balancaController->buscarPorCnpj($cnpj))){
			$retorno ="
			<h4>Balanca</h4>
			<table>
				<tr>
					<th>Qtde</th>
					<th>Marca</th>
				</tr>";
			foreach ($balancas as $balanca) {
				$retorno.="<tr>";
					$retorno.="<td>".$balanca->getQtde()."</td>";
					$retorno.="<td>".$balanca->getMarca()."</td>";
				$retorno.="</tr>";
			}
			$retorno.="
			</table>
			";

			return $retorno;
		}
	}

	function tabelaEqpRedes($cnpj){
		$eqpRedesController = new EqpRedeController();

		if(!is_null($eqpRedes = $eqpRedesController->buscarPorCnpj($cnpj))){

			$retorno ="
			<h4>Equipamento de Redes</h4>
			<table>
				<tr>
					<th>Qtde</th>
					<th>Marca</th>
				</tr>";
			foreach ($eqpRedes as $eqpRede) {
				$retorno.="<tr>";
					$retorno.="<td>".$eqpRede->getQtde()."</td>";
					$retorno.="<td>".$eqpRede->getMarca()."</td>";
				$retorno.="</tr>";
			}
			$retorno.="
			</table>
			";


			return $retorno;
		}
	}

	function tabelaNobreak($cnpj){
		$nobreakController = new NobreakController();

		if(!is_null($nobreaks = $nobreakController->buscarPorCnpj($cnpj))){

			$retorno ="
			<h4>Nobreak</h4>
			<table>
				<tr>
					<th>Qtde</th>
					<th>Marca</th>
					<th>Serv</th>
					<th>Term</th>
					<th>Caixa</th>
				</tr>";

			foreach ($nobreaks as $nobreak) {
				$retorno.="<tr>";
					$retorno.="<td>".$nobreak->getQtde()."</td>";
					$retorno.="<td>".$nobreak->getMarca()."</td>";
					$retorno.="<td>".$nobreak->getServ()."</td>";
					$retorno.="<td>".$nobreak->getTerm()."</td>";
					$retorno.="<td>".$nobreak->getCaixa()."</td>";
				$retorno.="</tr>";
			}


			$retorno.="
			</table>
			";

			return $retorno;
		}
	}

	function tabelaOutrasInf($cnpj){
		$outrasInfController = new OutraInfController();

		if(!is_null($outrasInf = $outrasInfController->buscarPorCnpj($cnpj))){
			$retorno = "<br />
			<h4>Outras Informações</h4>
			<table>
				<tr>"; 
					
					$retorno.="<td>Cert. Digital: </td>";
					if ($outrasInf->getCertDigital()) {
						$retorno.="<td>".$outrasInf->getCertDigital()."</td>";
					}else{
						$retorno.="<td></td>";

					}
					
					if($outrasInf->getTipoInternet()){
						$retorno.="<td>Internet:</td>";
						if(strcmp($outrasInf->getTipoInternet(), "internetFibra") == 0)
							$retorno.="<td>Fibra Optica</td>";
						if(strcmp($outrasInf->getTipoInternet(), "internetRadio") == 0)
							$retorno.="<td>Radio</td>";
						if(strcmp($outrasInf->getTipoInternet(), "internetDsl") == 0)
							$retorno.="<td>DSL</td>";
						if(strcmp($outrasInf->getTipoInternet(), "internetOutras") == 0){
							$retorno.="<td>".$outrasInf->getQualInternet()."</td>";
						}
					}

					if($outrasInf->getImpressora()){
						$retorno.="<td>Impressora:</td>";
						if($outrasInf->getImpressora() == 1)
							$retorno.="<td>S</td>";
						else
							$retorno.="<td>N</td>";
					}

					if($outrasInf->getColDados()){
						$retorno.="<td>Col. de Dados:</td>";
						if($outrasInf->getColDados() == 1)
							$retorno.="<td>S</td>";
						else
							$retorno.="<td>N</td>";
					}
				$retorno.="
				</tr>
				<tr>
				";
					if($outrasInf->getBuscaPreco()){
						$retorno.="<td colspan =\"2\">Busca Preço:</td>";
						$retorno.="<td colspan =\"2\">".$outrasInf->getBuscaPreco()."</td>";
					}
					if($outrasInf->getImpEtiqueta()){
						$retorno.="<td colspan = \"2\">Imp de Etiqueta:</td>";
						$retorno.="<td colspan =\"2\">".$outrasInf->getImpEtiqueta()."</td>";
					}

				$retorno.="
				</tr>
				";
				if($outrasInf->getMarcaTef()){
					$retorno.="
					<tr>
						<th colspan =\"8\">TEF</th>
					<tr >
						<th colspan =\"4\">Marca</th>
						<th colspan =\"4\">Tipo</th>
					</tr>
					";
					$retorno.="
					<tr>
						<td colspan =\"4\">".$outrasInf->getMarcaTef()."</td>
						<td colspan =\"4\">".$outrasInf->getTipoTef()."</td>					
					</tr>
					";
				}
				
				
				if($outrasInf->getLeitorMesaMarca()){
					$retorno.="
					<tr>
						<th colspan=\"8\">Leitor de Mesa</th>
					</tr>";
					$retorno.="
					<tr>
						<th colspan =\"4\">Marca</th>
						<th colspan =\"3\">Tipo</th>
						<th>USB</th>
					</tr>
					<tr>
					";
					
					$retorno.="<td colspan =\"4\">".$outrasInf->getLeitorMesaMarca()."</td>";
					$retorno.="<td colspan =\"3\">".$outrasInf->getLeitorMesaQtd()."</td>";
					if($outrasInf->getLeitorMesaUsb() == 1)
						$retorno.="<td >S</td>";
					else
						$retorno.="<td >N</td>";

					$retorno.="
					</tr>
					";
				}
				
				if($outrasInf->getLeitorMaoMarca()){
					$retorno.="
					<tr>
						<th colspan=\"8\">Leitor de Mao</th>
					</tr>";
					$retorno.="
					<tr>
						<th colspan =\"4\">Marca</th>
						<th colspan =\"3\">Tipo</th>
						<th>USB</th>
					</tr>
					<tr>
					";
					
					$retorno.="<td colspan =\"4\">".$outrasInf->getLeitorMaoMarca()."</td>";
					$retorno.="<td colspan =\"3\">".$outrasInf->getLeitorMaoQtd()."</td>";
					if($outrasInf->getLeitorMaoUsb() == 1)
						$retorno.="<td >S</td>";
					else
						$retorno.="<td >N</td>";

					$retorno.="
					</tr>
					";
				}
				
				if($outrasInf->getPalmMarca()){
					$retorno.="
					<tr>
						<th colspan=\"8\">Palm</th>
					</tr>";
					$retorno.="
					<tr>
						<th colspan =\"3\">Marca</th>
						<th colspan =\"3\">Tipo</th>
						<th colspan =\"2\">Sist. Op</th>
					</tr>
					<tr>
					";
					
					$retorno.="<td colspan =\"3\">".$outrasInf->getPalmMarca()."</td>";
					$retorno.="<td colspan =\"3\">".$outrasInf->getPalmQtd()."</td>";
					$retorno.="<td colspan =\"2\">".$outrasInf->getPalmSO()."</td>";
					

					$retorno.="
					</tr>
					";
				}
				
					
			$retorno.="
				</tr>
			</table>
			";

			return $retorno;
		}
			/*

		*/
	}

	function tabelaRemoto($cnpj){
		$remotoController = new RemotoController();
		//$remoto = $remotoController->buscarPorCnpj($cnpj)
		//var_dump($remotoController->buscarPorCnpj($cnpj));
		
		if(!is_null($acessoRemoto = $remotoController->buscarPorCnpj($cnpj))){
			$retorno="<br />
			<table>
				<tr>
					<th colspan=\"2\">Acesso remoto</th>
				</tr>";				

			if(!is_null($acessoRemoto->getRecebeAcesso())){
				$retorno.="
				<tr>
					<td>Acessa de Outro Computador?</td>";
					$retorno.="<td>".$acessoRemoto->getRecebeAcesso()."</td>
				</tr>";
			}
			if(!is_null($acessoRemoto->getInterligaFilial())){
				$retorno.="
				<tr>
					<td>Interliga Filiais?</td>";
					$retorno.="<td>".$acessoRemoto->getInterligaFilial()."</td>
				</tr>";
			}
			if(!is_null($acessoRemoto->getIpFixo())){
				$retorno.="
				<tr>
					<td>Possui IP Fixo?</td>";
					$retorno.="<td>".$acessoRemoto->getIpFixo()."</td>
				</tr>";
			}

			$retorno.="
				</tr>
			</table>
			";
			//echo $remoto;
			//var_dump($acessoRemoto);

			return $retorno;

		}
		
	}

	function tabelaSistemas($cnpj){

		$sistemaController = new SistemaController();

		if(!is_null($sistema = $sistemaController->buscarPorCnpj($cnpj))){
			$retorno = "
			<h2>Sistemas</h2>
			<ul>";

			if($sistema->getIntellicashFull() ==1 ){
				$retorno.= "<li>Intellicash Full</li>";
			}
			if($sistema->getIntellicashLight() ==1 ){
				$retorno.= "<li>Intellicash Light</li>";
			}
			if($sistema->getEasycash() ==1 ){
				$retorno.= "<li>Easycash</li>";
			}
			if($sistema->getGnfe() ==1 ){
				$retorno.= "<li>gNFe</li>";
			}
			if($sistema->getCotacao() ==1 ){
				$retorno.= "<li>Cotação</li>";
			}
			if($sistema->getIntelligroup() ==1 ){
				$retorno.= "<li>Intelligroup</li>";
			}
			if($sistema->getIntellistock() ==1 ){
				$retorno.= "<li>IntelliStock</li>";
			}
			if($sistema->getVendaAssistida() ==1 ){
				$retorno.= "<li>Venda Assistida</li>";
			}
			if($sistema->getOrcamento() ==1 ){
				$retorno.= "<li>Orçamento</li>";
			}
			if($sistema->getPedido() ==1 ){
				$retorno.= "<li>Pedido</li>";
			}
			if($sistema->getProduto() ==1 ){
				$retorno.= "<li>Produto</li>";
			}
			if($sistema->getEdi() ==1 ){
				$retorno.= "<li>EDI</li>";
			}
			if($sistema->getMgMobile() ==1 ){
				$retorno.= "<li>MgMobile</li>";
			}
			if($sistema->getNfDestinada() ==1 ){
				$retorno.= "<li>NF Destinada</li>";
			}
			if($sistema->getContasPgRc() ==1 ){
				$retorno.= "<li>Contas a Pagar/Receber</li>";
			}
			if($sistema->getSincronizador() ==1 ){
				$retorno.= "<li>Sincronizador</li>";
			}
			if($sistema->getEntregaCega() ==1 ){
				$retorno.= "<li>Entrega Cega</li>";
			}
			if($sistema->getCte() ==1 ){
				$retorno.= "<li>CTe</li>";
			}

			$retorno.="
			</ul>
			";

			return $retorno;
		}
	}

	function tabelaProcessos($cnpj){
		$processosController = new ProcessosController();

		if(!is_null($processos = $processosController->buscarPorCnpj($cnpj))){
			$retorno = "
			<h2>Processos e Procedimentos</h2>
			<table>
			";
			if($processos->getQtdCadastro()){
				$retorno.="
				<tr>
					<td>Pessoas que realizam cadastros:</td>
				";
				$retorno.="<td colspan=\"2\">".$processos->getQtdCadastro()."</td>
				</tr>";
			}

			$retorno.="
			<tr>
				<td>Mesma pessoa do cadastro, lança notas fiscais?</td>";
			if($processos->getPessoaLanc()){
				$retorno.="<td>N</td>
				<td>".$processos->getPessoaLanc()."</td>";
			}else{
				$retorno.="<td colspan=\"2\">S</td>";
			}

			$retorno.="
			<tr>
				<td>Os preços são conferidos pela mesma pessoa que lança nota de compra?</td>";
			if($processos->getLancPreco()){
				$retorno.="<td>N</td>
				<td>".$processos->getLancPreco()."</td>";
			}else{
				$retorno.="<td colspan=\"2\">S</td>";
			}
			
			$retorno.="
			<tr>
				<td>A mercadoria é recebida pela pessoa que lança nota de compra?</td>";
			if($processos->getRecebeMerc()){
				$retorno.="<td>N</td>
				<td>".$processos->getRecebeMerc()."</td>";
			}else{
				$retorno.="<td colspan=\"2\">S</td>";
			}

			$retorno.="
			<tr>
				<td>Mesma pessoa lança nota de compra e nota de venda?</td>";
			if($processos->getCompraVenda()){
				$retorno.="<td>N</td>
				<td>".$processos->getCompraVenda()."</td>";
			}else{
				$retorno.="<td colspan=\"2\">S</td>";
			}
			
			$retorno.="
			<tr>
				<td>Fiscal de Vendas</td>";
			if($processos->getFiscalVendas()){
				$retorno.="<td>N</td>
				<td>".$processos->getFiscalVendas()."</td>";
			}else{
				$retorno.="<td colspan=\"2\">S</td>";
			}
			
			$retorno.="
			<tr>
				<td>Realiza fechamento de caixa diário?</td>";
			if($processos->getFechamentoDiario())
				$retorno.="
				<td colspan=\"2\">".$processos->getFechamentoDiario()."</td>";
			
			$retorno.="
			<tr>
				<td>Tem alquém responsável por conferir Fechamento de Caixa?</td>";
			if($processos->getRespFechamento()){
				$retorno.="<td>S</td>
				<td>".$processos->getRespFechamento()."</td>";
			}else{
				$retorno.="<td colspan=\"2\">N</td>";
			}
			
			$retorno.="
			<tr>
				<td>Responsavel pelo Financeiro?</td>";
			if($processos->getRespFinanceiro()){
				$retorno.="<td>S</td>
				<td>".$processos->getRespFinanceiro()."</td>";
			}else{
				$retorno.="<td colspan=\"2\">N</td>";
			}

			$retorno.="
					</tr>
				</tr>
			</table>
			";

			return $retorno;
		}
	}

	function tabelaVendedores($cnpj){

		$vendedorController = new VendedorController();

		if(!is_null($vendedores = $vendedorController->buscarPorCnpj($cnpj))){
			$retorno = "
			<h4>Vendedores</h4>
			<table>
				<tr>
					<th>CPF</th>
					<th>Nome</th>
					<th>Código</th>
					<th>Desconto</th>
					<th>Comissão</th>
				</tr>";

			foreach ($vendedores as $vendedor) {
				$retorno.="<tr>";
				$retorno.="<td>".$vendedor->getCpf()."</td>";
				$retorno.="<td>".$vendedor->getNome()."</td>";
				$retorno.="<td>".$vendedor->getCodigo()."</td>";
				$retorno.="<td>".$vendedor->getDesconto()."</td>";
				$retorno.="<td>".$vendedor->getComissao()."</td>";
				$retorno.="</tr>";
			}
			$retorno.="
			</table>
			";

			return $retorno;
		}
	}

	function tabelaOperadores($cnpj){
		$operadorController = new OperadorController();

		if(!is_null($operadores = $operadorController->buscarPorCnpj($cnpj))){
			$retorno = "
			<h4>Operadores</h4>
			<table>
				<tr>
					<th>CPF</th>
					<th>Nome</th>
					<th>Turno</th>
					<th>Desc/Acrec</th>
					<th>Cancelar</th>
					<th>Liberar</th>
					<th>Red. Z</th>
					<th>Supri/Sangria</th>
				</tr>";
			foreach ($operadores as $operador) {
				$retorno.="<tr>";
				$retorno.="<td>".$operador->getCpf()."</tr>";
				$retorno.="<td>".$operador->getNome()."</tr>";
				$retorno.="<td>".$operador->getTurno()."</tr>";
				$retorno.="<td>".$operador->getDescAcr()."</tr>";
				$retorno.="<td>".$operador->getCancelar()."</tr>";
				$retorno.="<td>".$operador->getLiberar()."</tr>";
				$retorno.="<td>".$operador->getRedZ()."</tr>";
				$retorno.="<td>".$operador->getSuprSang()."</tr>";
			}
			$retorno.="
			</table>
			";

			return $retorno;
		}
	}

	//echo getEmpresa($cnpj);
	//echo getComputadores($cnpj);
	//echo tabelaEcf($cnpj);
	//if (file_exists('css/estiloPrint.css'))  
  	$css = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/css/estiloPrint.css');
	$pdf = new mPDF('utf-8', 'A4');

	$pdf->WriteHTML($css, 1);
	$pdf->WriteHTML(tabelaEmpresa($cnpj));
	$pdf->WriteHTML(tabelaComputadores($cnpj));
	$pdf->WriteHTML(tabelaEcf($cnpj));
	$pdf->WriteHTML(tabelaBalanca($cnpj));
	$pdf->WriteHTML(tabelaEqpRedes($cnpj));
	$pdf->WriteHTML(tabelaOutrasInf($cnpj));
	$pdf->WriteHTML(tabelaNobreak($cnpj));
	$pdf->WriteHTML(tabelaRemoto($cnpj));
	$pdf->WriteHTML(tabelaSistemas($cnpj));
	$pdf->WriteHTML(tabelaProcessos($cnpj));
	$pdf->WriteHTML(tabelaVendedores($cnpj));
	$pdf->WriteHTML(tabelaOperadores($cnpj));
	$retorno = ob_get_clean();
	
	$pdf->Output(); 
	exit;
	


?>

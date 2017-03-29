<?php 
echo("ahaha");
?>

<!DOCTYPE html>

<html>
	<head lang="pt-BR">
		<meta charset = "utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
		<link rel="stylesheet" href="bootstrap-3.3.7\dist\css\bootstrap.min.css">
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script> -->
		<script src="angular-1.5.8\angular.min.js"></script>
		<script src="app.js"></script>
		<!--<script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
		<script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>-->
		
		<link href="estilo.css" rel="stylesheet" type="text/css" />
		
		
		
	</head>
	
	<body ng-app="myApp"  ng-controller="controller">
		<h1>Hello, world!</h1>	
		
		<div class="col-md-10 col-md-offset-1 col-sm-6">
			<!--<form method="post" action="gravarCliente.php" enctype="multipart/form-data" accept-charset="UTF-8">-->
			<form ng-submit="submitForm(cliente)">
			
			<!-- Dados Empresa------------------------------------------------------------------------->

				<!--<button class="btn btn-block" ng-click="toggleDadosEmp()">Dados da empresa</button>-->
				<a href ng-click="toggleDadosEmp()"><div class="well well-sm"><span class="text-center">Dados da empresa</span></div></a>

				<span ng-hide="formDadosEmp">
					<div class="form-group">
						<label for="empresa">Empresa</label>
						<input type="text" class="form-control" id="empresa" name="empresa" ng-model="cliente.empresa"></input>
											
						<div class="col-md-9">
							<label for="cnpj">CNPJ</label>
							<div ng-class="cssClassCnpj">
								<!--<input type="text" class="form-control" id="cnpj"></input>-->
								<input type="text" class="form-control" id="cnpj" name="cnpj" ng-model="cliente.cnpj" ng-change="validarCNPJ(cliente.cnpj)">
								
							</div>
						</div>
						<div class="col-md-3"><br /><br /><p>{{erro}}</p></div>
											
						<div class="col-md-6">
							<label for="email">E-mail</label>
							<input type="text" class="form-control" id="email" name="email" ng-model="cliente.email"></input>
						</div>	
						<div class="col-md-6">
							<label for="telefone">Telefone</label>
							<input type="text" class="form-control" id="telefone" name="telefone" ng-model="cliente.telefone"></input>
						</div>	
						
						<div class="col-md-10">
							<label for="responsavel">Responsavel</label>
							<input type="text" class="form-control" id="responsavel" name="responsavel" ng-model="cliente.responsavel"></input>
						</div>	
						<div class="col-md-2">
							<label for="usuarios">Nº Usuarios</label>
							<input type="text" class="form-control" id="usuarios" name="usuarios" ng-model="cliente.usuarios"></input>
						</div>	
						
						<div class="col-md-3">
							<label for="ramo">Ramo</label>
							<select class="selectpiker form-control" id="ramo" name="ramo" ng-model="cliente.selRamo" ng-options="ramo for ramo in ramos" ng-change="setOutroRamo()">
								<option value="">Selecione uma opção</option>
							</select>
						</div>	
						<div class="col-md-9">
							<label for="ramo_tipo">Qual?</label>
							<input type="text" class="form-control" id="ramoTipo" name="ramoTipo" ng-model="cliente.ramoTipo" ng-disabled="ramoDisabled"></input>
						</div>
						
						<div class="col-md-5">
							<label for="loja">Loja</label>
							<select class="selectpiker form-control" id="loja" name="loja" ng-options="loja for loja in lojas" ng-model="cliente.selLoja" ng-change="setLoja()">
								<option value="">Selecione um opção</option>
							</select>
						</div>
						<div class="col-md-2">
							<label for="chkFilial">Possui filial?</label>
							<div class="form-control">
								<label class="checkbox-inline">
									<input type="checkbox" id="chkFilial" name="chkFilial" value="filial" ng-model="cliente.chkFilial" ng-disabled="filiaisDisabled" ng-change="setQtdFiliais()">Sim
								</label>
							</div>
						</div>
						<div class="col-md-5">
							<label for="qtdFilial">Quantas Filiais</label>
							<input type="text" class="form-control" id="qtdFilia" name="qtdFilial" ng-model="cliente.qtdFilial" ng-disabled="qtdFiliaisDisabled"></input>
							
						</div>
						
						
						<div class="col-md-4">
							<label for="regime">Regime</label>
							<select class="selectpiker form-control" id="regime" name="regime" ng-model="cliente.regime">
								<option value="SN">Simples Nacional</option>	
								<option value="lPres">Lucro Presumido</option>
								<option value="lReal">Lucro Real</option>
								
							</select>
						</div>	
						
						<div class="col-md-6 col-sm-6">
							<label for="fiscal">Fiscal</label>
							<div class="form-control">
								<label class="checkbox-inline">
									<input type="checkbox" id="chkFis" name="chkFis" ng-model="cliente.chkFis" value="fiscal"> SPED Fiscal
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="chkCont" name="chkCont" ng-model="cliente.chkCont" value="contribuicoes"> SPED Pis/Cofins
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="chkSint" name="chkSint" value="sintegra" ng-model="cliente.chkSint"> Sintegra
								</label>
							</div>
						</div>	
						<div class="col-md-2">
							<label for="nfiscal">100% Fiscal?</label>
							<div class="form-control">
								<label class="checkbox-inline">
									<input type="checkbox" id="chkFilial" name="chkFilial" ng-model="cliente.chkFilial" value="filial">Sim
								</label>
							</div>
						</div>
						
						
						
					</div>
				
				</span>
				<span ng-show="formDadosEmp"></span>
				<!-- /Dados Empresa------------------------------------------------------------------------->
				
				<!-- Dados do Computador------------------------------------------------------------------------->
				
				<a href ng-click="toggleDadosComp()"><div class="well well-sm"><span class="text-center">Dados do Computador</span></div></a>
				
				<span ng-hide="formDadosComp">
				
					<table class="table table-bordered" >
						<tr>
							<th>Qtde</th>
							<th>Descrição</th>
							<th>Sist. OP</th>
							<th>HD</th>
							<th>Memoria</th>
							<th>Seial</th>
							<th>Serv.</th>
							<th>Term.</th>
							<th>Caixa</th>						
						</tr>
						<tr name="computador[]" ng-repeat="comp in computadores">
							
							<td><span id="qtde" name="qtde">{{comp.qtde}}</span></td>
							<td>{{comp.descricao}}</td>
							<td>{{comp.sistOp}}</td>
							<td>{{comp.hd}}</td>
							<td>{{comp.memoria}}</td>
							<td>{{comp.serial}}</td>
							<td>{{comp.serv}}</td>
							<td>{{comp.term}}</td>
							<td>{{comp.caixa}}</td>
							<!-- <td><button class="btn btn-block btn-danger" ng-click="deletaComp(comp)">Apagar</button></td> -->
							<td><a href ng-click="deletaComp(comp)"><div class="alert alert-danger"><div class="text-center">Apagar</div></div></a></td>							
						</tr>
						<tr>
							<td><input class="form-control" type="text"ng-model="cliente.computador.qtde"></input></td>
							<td><input class="form-control" type="text" id="descricao" name="descricao" ng-model="cliente.computador.descricao"></input></td>
							<td><input class="form-control" type="text" id="sistOp" name="sistOp" ng-model="cliente.computador.sistOp"></input></td>
							<td><input class="form-control" type="text" id="descricao" name="descricao" ng-model="cliente.computador.hd"></input></td>
							<td><input class="form-control" type="text" id="descricao" name="descricao" ng-model="cliente.computador.memoria"></input></td>
							<td><input type="checkbox" id="chkSer" name="chkSer" ng-model="cliente.computador.serial" value="serial"></td>
							<td><input type="checkbox" id="chkServ" name="chkServ" ng-model="cliente.computador.serv" value="servidor"></td>
							<td><input type="checkbox" id="chkTerm" name="chkTerm" ng-model="cliente.computador.term" value="terminal"></td>
							<td><input type="checkbox" id="chkCx" name="chkCx" ng-model="cliente.computador.caixa" value="caixa"></td>
							<!-- <td><button class="btn btn-primary btn-block" ng-click="adicionarComp(computador)">Adicionar</button></td> -->
							<td><a href ng-click="adicionarComp(cliente.computador)"><div class="alert alert-info"><div class="text-center"> Adicionar</div></div></a></td>
						</tr>
					</table>
				
				</span>
				<span ng-show="formDadosComp"></span>
				<!-- /Dados do Computador------------------------------------------------------------------------->
				
				<!-- Equipamentos------------------------------------------------------------------------->


				<a href ng-click="toggleEquip()"><div class="well well-sm">Equipamentos</div></a>
				
				<span ng-hide="formEquip">
					<table class="table table-bordered">
						<tr>
							<th class="text-center" colspan="3">ECF</th>
						</tr>
						<tr>
							<th class="text-center">Qtd.</th>
							<th class="text-center">Marca</th>
							<th></th>
						</tr>
						<tr ng-repeat="ecf in ecfs">
							<td>{{ecf.ecfQtd}}</td>
							<td>{{ecf.ecfMarca}}</td>
							<!-- <td><button class="btn btn-block btn-danger" ng-click="deletaEcf(ecf)">Apagar</button></td> -->
							<td><a href ng-click="deletaEcf(cliente.ecf)"><div class="alert alert-danger"><div class="text-center">Apagar</div></div></a></td>
							
						</tr>
						<tr>
							<td><input type="text" class="form-control" id="ecfQtd" name="ecfQtd" ng-model="cliente.ecf.ecfQtd" ></input></td>
							<td><input type="text" class="form-control" id="ecfMarca" name="ecfMarca" ng-model="cliente.ecf.ecfMarca" ></input></td>
							<!-- <td><button class="btn btn-block btn-primary" ng-click="adicionarEcf(ecf)">Adicionar</button></td> -->
							<td><a href ng-click="adicionarEcf(cliente.ecf)"><div class="alert alert-info"><div class="text-center"> Adicionar</div></div></a></td>
						</tr>
						
				
					</table>
					
					<table class="table table-bordered">
						<tr>
							<th class="text-center" colspan="3">Balança</th>
						</tr>
						<tr>
							<th class="text-center">Qtd.</th>
							<th class="text-center">Marca</th>
							<th></th>
						</tr>
						<tr ng-repeat="balanca in balancas">
							<td>{{balanca.balancaQtd}}</td>
							<td>{{balanca.balancaMarca}}</td>
							<!-- <td><button class="btn btn-block btn-danger" ng-click="deletaBalanca(balanca)">Apagar</button></td> -->
							<td><a href ng-click="deletaBalanca(cliente.balanca)"><div class="alert alert-danger"><div class="text-center">Apagar</div></div></a></td>
						</tr>
						<tr>
							<td><input type="text" class="form-control" id="balancaQtd" name="balancaQtd" ng-model="cliente.balanca.balancaQtd" ></input></td>
							<td><input type="text" class="form-control" id="balancaMarca" name="balancaMarca" ng-model="cliente.balanca.balancaMarca" ></input></td>
							<!-- <td><button class="btn btn-block btn-primary" ng-click="adicionarBalanca(balanca)">Adicionar</button></td> -->
							<td><a href ng-click="adicionarBalanca(cliente.balanca)"><div class="alert alert-info"><div class="text-center"> Adicionar</div></div></a></td>
						</tr>
				
					</table></table><table class="table table-bordered">
						<tr>
							<th class="text-center" colspan="3">Equip. de Rede</th>
						</tr>
						<tr>
							<th class="text-center">Qtd.</th>
							<th class="text-center">Marca</th>
							<th></th>
						</tr>
						<tr ng-repeat="rede in redes">
							<td>{{rede.redeQtd}}</td>
							<td>{{rede.redeMarca}}</td>
							<!-- <td><button class="btn btn-block btn-danger" ng-click="deletaRede(rede)">Apagar</button></td> -->
							<td><a href ng-click="deletaRede(cliente.rede)"><div class="alert alert-danger"><div class="text-center">Apagar</div></div></a></td>
						</tr>
						<tr>
							<td><input type="text" class="form-control" id="redeQtd" name="redeQtd" ng-model="cliente.rede.redeQtd" ></input></td>
							<td><input type="text" class="form-control" id="redeMarca" name="redeMarca" ng-model="cliente.rede.redeMarca" ></input></td>
							<!-- <td><button class="btn btn-block btn-primary" ng-click="adicionarRede(rede)">Adicionar</button></td> -->
							<td><a href ng-click="adicionarRede(cliente.rede)"><div class="alert alert-info"><div class="text-center"> Adicionar</div></div></a></td>
						</tr>
					</table>

				</span>
				<span ng-show="formEquip"></span>
				
				<!-- /Equipamentos------------------------------------------------------------------------->
				
				<!-- Outras Informações------------------------------------------------------------------------->
				
				
				<a href ng-click="toggleOutrasInfo()"><div class="well well-sm">Outras Informações</div></a>
				<span ng-hide="formOutrasInfo">
					<div class="col-md-12">
						<table class="table table-bordered">
							<tr>
								<td><label for="certDigital">Cert. Digital:</label></td>
								<td colspan="4">
								
									<label class="radio-inline">
										<input type="radio" name="optCertDigital" ng-model="cliente.optCertDigital">A1
									</label>
									<label class="radio-inline">
										<input type="radio" name="optCertDigital" ng-model="cliente.optCertDigital">A3
									</label>
									<label class="radio-inline">
										<input type="radio" name="optCertDigital" ng-model="cliente.optCertDigital">Não Usa
									</label>			
								</td>
								
								
							</tr>
							<tr>
								<td><label for="internet">Internet:</label></td>
								<td>
									<label class="radio-inline">
										<input type="radio" ng-model="cliente.tInternet" name="optInternet" id="internetFibra" value="internetFibra" ng-change="setOutraInternet()">							
											Fibra
										</input>
									</label>
									<label class="radio-inline">
										<input type="radio" ng-model="cliente.tInternet" name="optInternet" id="internetRadio" value="internetRadio" ng-change="setOutraInternet()">
											Radio
										</input>
									</label>
									<label class="radio-inline">
										<input type="radio" ng-model="cliente.tInternet" name="optInternet" id="internetDsl" value="internetDsl" ng-change="setOutraInternet()">
											DSL
										</input>
									</label>
									<label class="radio-inline">
										<input type="radio" ng-model="cliente.tInternet" name="optInternet" id="internetOutras" value="internetOutras" ng-change="setOutraInternet()">
											Outras
										</input>
									</label>
								</td>
								<td colspan = "3"><input class="form-control" type="text" id="qualInternet" name="qualInternet" ng-model="cliente.qualInternet" ng-disabled="internetDisabled" placeholder="Qual?"></input></td>
								
							</tr>
							<tr>
								<td><label for="buscaPreco">Busca Preço:</label></td>
								<td><label class="radio-inline">
									<input type="radio" ng-model="cliente.selBuscaPreco" name="optBuscaPreco" value="nao" ng-change="setBuscaPreco()">Não
								</label>
									<label class="radio-inline">
										<input type="radio" ng-model="cliente.selBuscaPreco" name="optBuscaPreco" value="sim" ng-change="setBuscaPreco()">Sim
									</label>
								</td>
								<td colspan="3">
									<input class="form-control" type="text" id="qualBuscaPreco" name="qualBuscaPreco" ng-disabled="buscaPrecoDisabled" placeholder="Qual Busca Preço?"></input>
								</td>
								
							</tr>
							<tr>
								<td><label for="impresEti">Impressora de Etiqueta</label></td>
								<td>
									<label class="radio-inline">
										<input type="radio" name="optImpEti" value="nao" ng-model="cliente.selImpEti" ng-change="setImpEti()">Não
									</label>
									<label class="radio-inline">
										<input type="radio" name="optImpEti" value="sim" ng-model="cliente.selImpEti" ng-change="setImpEti()">Sim
									</label>
								</td>
								<td colspan="3">
									<input class="form-control" type="text" id="qualImpEti" name="qualImpEti" placeholder="Qual Impressora?" ng-disabled="impEtiDisabled"></input>
								</td>
								
							</tr>
							<tr>
								<td><label for="tef">TEF</label></td>
								<td>
									<label class="radio-inline">
										<input type="radio" name="optTef" value="nao" ng-model="cliente.selTef" ng-change="setTef()">Não
									</label>
									<label class="radio-inline">
										<input type="radio" name="optTef" value="sim" ng-model="cliente.selTef" ng-change="setTef()">Sim
									</label>
								</td>
								<td colspan="2">
									<input class="form-control" type="text" id="qualTef" name="qualTef" placeholder="Qual TEF?" ng-disabled="tefDisabled"></input>
								</td>
									
								<td>
									<label class="radio-inline">
										<input type="radio" name="optAux" ng-disabled="tefDisabled">VPN
									</label>
									<label class="radio-inline">
										<input type="radio" name="optAux" ng-disabled="tefDisabled">Moden
									</label>
									
								</td>
								
							</tr>
							<tr>
								<td><label for="impressora">Inpressora</label></td>
								<td colspan="4">
									<label class="radio-inline">
										<input type="radio" name="optImpressora" ng-model="cliente.optImpressora">Não
									</label>
									<label class="radio-inline">
										<input type="radio" name="optImpressora" ng-model="cliente.optImpressora">Sim
									</label>
								</td>
								
							</tr>
							<tr>
								<td><label for="coletorDados">Coletor de Dados</label></td>
								<td colspan="4">
									<label class="radio-inline">
										<input type="radio" name="optColetor" ng-model="cliente.optColetor">Não
									</label>
									<label class="radio-inline">
										<input type="radio" name="optColetor" ng-model="cliente.optColetor">Sim
									</label>
								</td>
								
							</tr>
							<tr>
								<td><label for="leitorMesa">Leitor de Mesa</label></td>
								<td>
									<label class="radio-inline">
										<input type="radio" name="optLeitorMesa" value="nao" ng-model="cliente.selLeitorMesa" ng-change="setLeitorMesa()">Não
									</label>
									<label class="radio-inline">
										<input type="radio" name="optLeitorMesa" value="sim" ng-model="cliente.selLeitorMesa" ng-change="setLeitorMesa()">Sim
									</label>
								</td>
								<td>
									<input class="form-control" type="text" id="qualLeitorMesa" name="qualLeitorMesa" placeholder="Marca Leitor?" ng-disabled="leitorMesaDisabled"></input>
								</td>
								<td><input class="form-control" type="text" id="qtdLeitorMesa" name="qtdLeitorMesa" placeholder="Qtd" ng-disabled="leitorMesaDisabled"></input></td>
								<td>
									<label class="checkbox-inline">
										<input type="checkbox" id="chkLeitorMesaUsb" value="usb" ng-disabled="leitorMesaDisabled"> USB 
									</label>
								</td>
							</tr>
							<tr>
								<td><label for="leitorMao">Leitor de Mão</label></td>
								<td>
									<label class="radio-inline">
										<input type="radio" name="optLeitorMao" value="nao" ng-model="cliente.selLeitorMao" ng-change="setLeitorMao()">Não
									</label>
									<label class="radio-inline">
										<input type="radio" name="optLeitorMao" value="sim" ng-model="cliente.selLeitorMao" ng-change="setLeitorMao()">Sim
									</label>
								</td>
								<td>
									<input class="form-control" type="text" id="qualLeitor" name="qualLeitorMao" placeholder="Marca Leitor?" ng-disabled="leitorMaoDisabled"></input>
								</td>
								<td><input class="form-control" type="text" id="qtdLeitor" name="qtdLeitorMao" placeholder="Qtd" ng-disabled="leitorMaoDisabled"></input></td>
								<td>
									<label class="checkbox-inline">
										<input type="checkbox" id="chkLeitoMaorUsb" value="usb" ng-disabled="leitorMaoDisabled"> USB
									</label>
								</td>
							</tr>
							<tr>
								<td><label for="palm">Palm</label></td>
								<td>
									<label class="radio-inline">
										<input type="radio" name="optPalm" value="nao" ng-model="cliente.selPalm" ng-change="setPalm()">Não
									</label>
									<label class="radio-inline">
										<input type="radio" name="optPalm" value="sim" ng-model="cliente.selPalm" ng-change="setPalm()">Sim
									</label>
								</td>
								<td>
									<input class="form-control" type="text" id="qualPalm" name="qualPalm" placeholder="Marca Palm?" ng-disabled="palmDisabled"></input>
								</td>
								<td><input class="form-control" type="text" id="qtdPalm" name="qtdPalm" placeholder="Qtd" ng-disabled="palmDisabled"></input></td>
								<td>
									<label class="checkbox-inline">
										
										<input class="form-control" type="text" id="soPalm" name="soPalm" placeholder="SO Palm?" ng-disabled="palmDisabled"></input>
									</label>
								</td>
							</tr>
							<tr>
								<td><label for="usaSistema">Usa Sistema?</label></td>
								<td>
									<label class="radio-inline">
										<input type="radio" name="optSistema" value="nao" ng-model="cliente.selSistema" ng-change="setSistema()">Não
									</label>
									<label class="radio-inline">
										<input type="radio" name="optSistema" value="sim" ng-model="cliente.selSistema" ng-change="setSistema()">Sim
									</label>
								</td>
								<td colspan="3"><input class="form-control" type="text" id="qualSistema" name="qualSistema" placeholder="Qual Sistema?" ng-disabled="sistemaDisabled"></td>
								
							</tr>
							<tr>
								<td><label for="coletorDados">Coletor de Dados</label></td>
								<td colspan="4">
									<label class="radio-inline">
										<input type="radio" name="optColetor">Não
									</label>
									<label class="radio-inline">
										<input type="radio" name="optColetor">Sim
									</label>
								</td>
								
							</tr>
						</table>
						
						<table class="table table-bordered">
							<tr>
								<th class="text-center" colspan="6">NoBreak</th>
							</tr>
							<tr>
								<th class="text-center">Qtde</th>
								<th class="text-center">Marca</th>
								<th class="text-center">Serv</th>
								<th class="text-center">Term</th>
								<th class="text-center">Cx</th>
								<th class="text-center"></th>
							</tr>
							
							<tr ng-repeat="nBreak in nBreaks">							
								<td>{{nBreak.qtd}}</td>
								<td>{{nBreak.marca}}</td>
								<td>{{nBreak.serv}}</td>
								<td>{{nBreak.term}}</td>
								<td>{{nBreak.cx}}</td>							
								<!-- <td><button class="btn btn-block btn-danger" ng-click="deletaNobreak(nBreak)">Apagar</button></td>		 -->
								<td><a href ng-click="deletaNobreak(nBreak)"><div class="alert alert-danger"><div class="text-center">Apagar</div></div></a></td>
							</tr>
							<tr>
								<td><input class="form-control" type="text" placeholder="Qtd" ng-model="cliente.nobreak.qtd"></input></td>
								<td><input class="form-control" type="text" placeholder="Marca" ng-model="cliente.nobreak.marca"></input></td>
								<td><input type="checkbox" id="chkNBServ" ng-model="cliente.nobreak.serv" value="NBServidor"></td>
								<td><input type="checkbox" id="chkNBTerm" ng-model="cliente.nobreak.term" value="NBTerminal"></td>
								<td><input type="checkbox" id="chkNBCx" ng-model="cliente.nobreak.cx" value="NBTerminal"></td>
								<!-- <td><button class="btn btn-block btn-primary" ng-click="adicionarNBreak(nobreak)"> add </button></td> -->
								<td><a href ng-click="adicionarNBreak(nobreak)"><div class="alert alert-info"><div class="text-center"> Adicionar</div></div></a></td>
							</tr>
							
						</table>
												
						<table class="table table-bordered">
							<tr>
								<th class="text-center" colspan="2">Remoto</th>
							</tr>
							<tr>
								<td><label for="acessoOutro">Acessa de Outro Computador?</label></td>
								<td>
									<label class="radio-inline">
										<input type="radio" name="optAcesso">Não
									</label>
									<label class="radio-inline">
										<input type="radio" name="optAcesso">Sim
									</label>
								</td>
							</tr>
							<tr>
								<td><label for="interligaFiliais">Interliga Filiais?</label></td>
								<td>
									<label class="radio-inline">
										<input type="radio" name="optFiliais">Não
									</label>
									<label class="radio-inline">
										<input type="radio" name="optFiliais">Sim
									</label>
								</td>
							</tr>
							<tr>
								<td><label for="ipFixo">Ip Fixo?</label></td>
								<td>
									<label class="radio-inline">
										<input type="radio" name="optIp" value="nao" ng-model="cliente.selIpFixo" ng-change="setIpFixo()">Não
									</label>
									<label class="radio-inline">
										<input type="radio" name="optIp" value="sim" ng-model="cliente.selIpFixo" ng-change="setIpFixo()">Sim
									</label>
								</td>
							</tr>
							<tr>
								<td><label for="qualIp">Qual IP?</label></td>
								<td>
									<input class="form-control" type="text" id="ipFixo" placeholder="Digite o IP" ng-disabled="ipFixoDisabled">
								
								</td>
							</tr>
							
							
						</table>
						
					</div>
				</span>
				<span ng-show="formOutrasInfo"></span>
				<!-- /Outras Informações------------------------------------------------------------------------->

				<!-- Sistema------------------------------------------------------------------------->

				
				<a href ng-click="toggleSistema()"><div class="well well-sm">Sistema</div></a>
				<span ng-hide="formSistema">
					<table class="table">
						<tr>
							<th class="text-center" colspan=5>Sistema</th>
						</tr>
						<tr>
							<td><input type="checkbox">Intellicash Full</input></td>
							<td><input type="checkbox">Intellicash Light</input></td>
							<td><input type="checkbox">Easycash</input></td>
							<td><input type="checkbox">GNFe</input></td>
							<td></td>
						</tr>
						<tr>
							<td><input type="checkbox">Cotação Online</input></td>
							<td><input type="checkbox">Intelligroup</input></td>
							<td><input type="checkbox">Intellistock</input></td>
							<td><input type="checkbox">Venda Assistida</input></td>
							<td></td>
						</tr>
						<tr>
							<th>
							</th>
						</tr>
						<tr>
							<td><input type="checkbox">Orçamento</input></td>
							<td><input type="checkbox">Pedido</input></td>
							<td><input type="checkbox">Produto</input></td>
							<td><input type="checkbox">EDI</input></td>
							<td><input type="checkbox">MGMobile</input></td>
						</tr>
						<tr>
							<td><input type="checkbox">NFe-Destinada</input></td>
							<td><input type="checkbox">Contas a Pagar/receber</input></td>
							<td><input type="checkbox">Sincronizador</input></td>
							<td><input type="checkbox">Entrega Cega</input></td>
							<td><input type="checkbox">CT-e</input></td>
						</tr>
					</table>
				</span>
				<span ng-show="formSistema"></span>
				<!-- /Sistema------------------------------------------------------------------------->
				
				<!-- Processos e Procedimentos------------------------------------------------------------------------->

				
				<a href ng-click="toggleProc()"><div class="well well-sm">Processos e Procedimentos</div></a>
				<span ng-hide="formProc">
				
					<table class="table">
						<tr>
							<td><label for="qtdCad">Quantas pessoas realizam o cadastro?</label></td>
							<td></td>
							<td>
								<input class="form-control" text="text" id="qtdCadastro">
							</td>
						</tr>
						<tr>
							<td>
								<label for="pessoaCad">Mesma pessoa do cadastro, lança notas fiscais?</label>
							</td>
							<td>
								<label class="radio-inline">
									<input type="radio" name="optPessoaLanc" value="nao" ng-model="cliente.selPessoaLanc" ng-change="setPessoaLanc()">Não
								</label>
								<label class="radio-inline">
									<input type="radio" name="optPessoaLanc" value="sim" ng-model="cliente.selPessoaLanc" ng-change="setPessoaLanc()">Sim
								</label>
							</td>
							<td>
								<input class="form-control" text="text" id="pessoaLanc" placeholder="Quem Lança as NF?" ng-disabled="pessoaLancDisabled">
							</td>
						</tr>
						<tr>
							<td><label for="qLancPrec">Os preços são conferidos pela mesma pessoa que lança nota de compra?</label></td>
							<td>
								<label class="radio-inline">
									<input type="radio" name="optLancPreco" value="nao" ng-model="cliente.selLancPreco" ng-change="setLancPreco()">Não
									
								</label>
								<label class="radio-inline">
									<input type="radio" name="optLancPreco" value="sim" ng-model="cliente.selLancPreco" ng-change="setLancPreco()">Sim
								</label>
							</td>
							<td><input class="form-control" text="text" id="lancPreco" placeholder="Quem confere preço?" ng-disabled="lancPrecoDisabled"></td>
						</tr>
						<tr>
							<td><label for="qRecebeMerc">A mercadoria é recebida pela pessoa que lança nota de compra?</label></td>
							<td>
								<label class="radio-inline">
									<input type="radio" name="optRecebeMerc" value="nao" ng-model="cliente.selRecebeMerc" ng-change="setRecebeMerc()">Não
								</label>
								<label class="radio-inline">
									<input type="radio" name="optRecebeMerc" value="sim" ng-model="cliente.selRecebeMerc" ng-change="setRecebeMerc()">Sim
								</label>
							</td>
							<td><input class="form-control" text="text" id="recebeMerc" placeholder="Quem recebe mercadoria?" ng-disabled="recebeMercDisabled"></td>
						</tr>
						<tr>
							<td><label for="qCompraVenda">Mesma pessoa lança nota de compra e nota de venda?</label></td>
							<td>
								<label class="radio-inline">
									<input type="radio" name="optCompraVenda" value="nao" ng-model="cliente.selCompraVenda" ng-change="setCompraVenda()">Não
								</label>
								<label class="radio-inline">
									<input type="radio" name="optCompraVenda" value="sim" ng-model="cliente.selCompraVenda" ng-change="setCompraVenda()">Sim
								</label>
							</td>
							<td><input class="form-control" text="text" id="compraVenda" placeholder="Quem lança nota?" ng-disabled="compraVendaDisabled"></td>
						</tr>
						<tr>
							<td><label for="qFiscalCaixa">Fiscal de Caixa?</label></td>
							<td>
								<label class="radio-inline">
									<input type="radio" name="optFiscalCaixa" value="nao" ng-model="cliente.selFiscalCaixa" ng-change="setFiscalCaixa()">Não
								</label>
								<label class="radio-inline">
									<input type="radio" name="optFiscalCaixa" value="sim" ng-model="cliente.selFiscalCaixa" ng-change="setFiscalCaixa()">Sim
								</label>
							</td>
							<td><input class="form-control" text="text" id="fiscalVendas" placeholder="Fiscal de Caixa?" ng-disabled="fiscalCaixaDisabled"></td>
						</tr>
						<tr>
							<td><label for="qCaixaDiario">Realiza fechamento de caixa diário?</label></td>
							<td>
								<label class="radio-inline">
									<input type="radio" name="optCaixaDiario">Não
								</label>
								<label class="radio-inline">
									<input type="radio" name="optCaixaDiario">Sim
								</label>
							</td>
							<td></td>
						</tr>
						<tr>
							<td><label for="qRespFechamento">Tem alquém responsável por conferir Fechamento de Caixa?</label></td>
							<td>
								<label class="radio-inline">
									<input type="radio" name="optRespFechamento" value="nao" ng-model="cliente.selRespFechamento" ng-change="setRespFechamento()">Não
								</label>
								<label class="radio-inline">
									<input type="radio" name="optRespFechamento" value="sim" ng-model="cliente.selRespFechamento" ng-change="setRespFechamento()">Sim
								</label>
							</td>
							<td><input class="form-control" text="text" id="respFechamento" placeholder="Responsavel Fechamento" ng-disabled="respFechamentoDisabled"></td>
						</tr>
						<tr>
							<td><label for="qRespFinanceiro">Responsavel pelo Financeiro?</label></td>
							<td>
								<label class="radio-inline">
									<input type="radio" name="optRespFinanceiro" value="nao" ng-model="cliente.selRespFinanceiro" ng-change="setRespFinanceiro()">Não
								</label>
								<label class="radio-inline">
									<input type="radio" name="optRespFinanceiro"  value="sim" ng-model="cliente.selRespFinanceiro" ng-change="setRespFinanceiro()">Sim
								</label>
							</td>
							<td><input class="form-control" text="text" id="respFinanceiro" placeholder="Responsavel Financeiro" ng-disabled="respFinanceiroDisabled"></td>
						</tr>
					</table>
					<table class="table table-bordered">
						<tr>
							<th class="text-center" colspan=6>Vendedores</th>
						</tr>
						<tr>
							<th class="text-center">CPF</th>
							<th class="text-center">Nome</th>
							<th class="text-center">Código</th>
							<th class="text-center">Desconto</th>
							<th class="text-center">Comissão</th>
							<th></th>
						</tr>
						<tr ng-repeat="vendedor in vendedores">
							<td>{{vendedor.cpf}}</td>
							<td>{{vendedor.nome}}</td>
							<td>{{vendedor.codigo}}</td>
							<td>{{vendedor.desconto}}</td>
							<td>{{vendedor.comissao}}</td>
							<!-- <td><button class="btn btn-danger" ng-click="deletaVendedor(vendedor)">Apagar</button></td> -->
							<td><a href ng-click="deletaVendedor(vendedor)"><div class="alert alert-danger"><div class="text-center">Apagar</div></div></a></td>
						</tr>
						<tr>
							<div ng-class="cssClassCpf">
								<td><input type="text" class="form-control" ng-model="cliente.vendedor.cpf" ng-change="validaCPFVendedor(vendedor.cpf)"></input></td>
							</div>
							<td><input type="text" class="form-control" ng-model="cliente.vendedor.nome"></input></td>
							<td><input type="text" class="form-control" ng-model="cliente.vendedor.codigo"></input></td>
							<td><input type="checkbox" ng-model="cliente.vendedor.desconto" value="vendDesconto"></input></td>
							<td><input type="checkbox" ng-model="cliente.vendedor.comissao"></input></td>
							<!-- <td><button class="btn btn-primary" ng-click="adicionarVendedor(vendedor)">Adicionar</button></td> -->
							<td><a href ng-click="adicionarVendedor(vendedor)"><div class="alert alert-info"><div class="text-center"> Adicionar</div></div></a></td>
							
						</tr>
					</table>
					{{erroCpfVendedor}}
					
					<table class="table table-bordered">
						<tr>
							<th class="text-center" colspan=9>Op. de caixa</th>
						</tr>
						<tr>
							<th class="text-center">CPF</th>
							<th class="text-center">Nome</th>
							<th class="text-center">Turno</th>
							<th class="text-center">Desc/Acrec</th>
							<th class="text-center">Cancelar</th>
							<th class="text-center">Liberar</th>
							<th class="text-center">Red. Z</th>
							<th class="text-center">Supri/Sangria</th>
							<th></th>
						</tr>
						<tr ng-repeat="operador in operadores">
							<th>{{operador.cpf}}</th>
							<th>{{operador.nome}}</th>
							<th>{{operador.turno}}</th>
							<th>{{operador.desAcr}}</th>
							<th>{{operador.cancelar}}</th>
							<th>{{operador.liberar}}</th>
							<th>{{operador.redZ}}</th>
							<th>{{operador.sepSang}}</th>
							<!-- <th><button class="btn btn-danger" ng-click="deletaOperador(operador)">Apagar</button></th> -->
							<td><a href ng-click="deletaOperador(operador)"><div class="alert alert-danger"><div class="text-center">Apagar</div></div></a></td>
						</tr>
						<tr>
							<div ng-class="cssClassCpf">
								<td><input type="text" class="form-control" ng-model="cliente.operador.cpf" ng-change="validaCPFOperador(operador.cpf)"></input></td>							
							</div>
							<td><input type="text" class="form-control" ng-model="cliente.operador.nome"></input></td>
							<td><input type="text" class="form-control" ng-model="cliente.operador.turno"></input></td>
							<td><input type="checkbox" ng-model="cliente.operador.desAcr"></input></td>
							<td><input type="checkbox" ng-model="cliente.operador.cancelar"></input></td>
							<td><input type="checkbox" ng-model="cliente.operador.liberar"></input></td>
							<td><input type="checkbox" ng-model="cliente.operador.redZ"></input></td>
							<td><input type="checkbox" ng-model="cliente.operador.sepSang"></input></td>
							<!-- <td><button class="btn btn-primary" ng-click="adicionarOperador(operador)">Adicionar</button></td> -->
							<td><a href ng-click="adicionarOperador(operador)"><div class="alert alert-info"><div class="text-center"> Adicionar</div></div></a></td>
						</tr>
					</table>
					{{erroCpfOperador}}
					
				</span>
				<span ng-show="fornProc"></span>
				<input type="submit" class="btn btn-success"></input>
				<!-- /Processos e Procedimentos------------------------------------------------------------------------->
			</form>
		</div>
	</body>
</html>


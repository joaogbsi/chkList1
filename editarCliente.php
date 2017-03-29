<div class="view" ng-controller="editarCliente">
	<h1>Editar Cliente</h1>	
	<!--
	empresa -> {{empresa}}
	<br />computradores -> {{computadores}}
	<br />ecfs -> {{ecfs}}
	<br />balancas -> {{balancas}}
	<br />eqpRedes -> {{eqpRedes}}
	<br />outraInf -> {{outraInf}}
	<br />nobreak -> {{nBreaks}}
	<br />remoto -> {{remoto}}
	<br />sistema -> {{sistema}}
	<br />processos -> {{processos}}
	-->
		
	<div class="col-md-10 col-md-offset-1 col-sm-6">
		<!--<form method="post" action="server/gravarCliente.php" enctype="multipart/form-data" accept-charset="UTF-8">-->
		<!-- <form ng-submit="submitForm(cliente)"> -->
		<form name=form>
		
		<!-- Dados Empresa-->

			<!--<button class="btn btn-block" ng-click="toggleDadosEmp()">Dados da empresa</button>-->
			<div ng-model="getCliente(clientes.cnpj)">
			
			<a href ng-click="toggleDadosEmp()"><div class="well well-sm"><span class="text-center">Dados da empresa</span></div></a>

			<span ng-hide="formDadosEmp">
				<div class="form-group">
				<div class = "container">
					<div class="col-md-9">
						<label for="empresa">Empresa <font color="red">*</font></label>
						<input type="text" class="form-control" id="empresa" name="empresa" ng-model="empresa.empresa" ng-change="setNomeEmpresa()"></input>
					</div>

										
					<div class="col-md-9">
						<label for="cnpj">CNPJ <font color="red">*</font></label>
						<div ng-class="cssClassCnpj">
							<!--<input type="text" class="form-control" id="cnpj"></input>-->
							<input type="text" class="form-control" id="cnpj" name="cnpj" ng-model="empresa.cnpj" ng-change="validarCNPJ(empresa.cnpj)" >
							
						</div>
					</div>

					<div class="col-md-3"><br /><br /><p>{{erro}}</p></div>
										
					<div class="col-md-6">
						<label for="email">E-mail <font color="red">*</font></label>
						<input type="email" class="form-control" id="email" ng-model="empresa.email" name="email" ng-change="validarEmail()"></input>
						<!--
						{{form.email.$valid}}
						-->
					</div>	
					<div class="col-lg-3 col-md-3">
						<label for="telefone">Telefone <font color="red">*</font></label>
						<input type="text" class="form-control" id="telefone" name="telefone" ng-model="empresa.telefone" ng-change="setTelefone()"></input>
					</div>	
					
					<div class="col-md-6">
						<label for="responsavel">Responsavel</label>
						<input type="text" class="form-control" id="responsavel" name="responsavel" ng-model="empresa.respSistema"></input>
					</div>	
					<div class="col-md-3">
						<label for="usuarios">Nº Usuarios</label>
						<input type="text" class="form-control" id="usuarios" name="usuarios" ng-model="empresa.nUsuario"></input>
					</div>	
					
					<div class="col-md-4">
						<label for="ramo">Ramo</label>
						<!-- {{empresa.selRamo}} -->
						<select class="form-control" id="ramo" name="ramo"        ng-model="empresa.selRamo" ng-options="ramo for ramo in ramos" ng-change="setOutroRamo(empresa.selRamo)">
							<option value="">Selecione uma opção</option>
						</select>
					</div>	
					<div class="col-md-5">
						<label for="ramo_tipo">Qual?</label>
						<input type="text" class="form-control" id="ramoTipo" name="ramoTipo" ng-model="empresa.ramoTipo" ng-disabled="ramoDisabled"></input>
					</div>
					<br />
					<div class="col-md-4">
					
						<label for="loja">Loja</label>
						<select class="selectpiker form-control" id="loja" name="loja" ng-options="loja for loja in lojas" ng-model="empresa.loja" ng-change="setLoja(empresa.loja)">
							<option value="">Selecione um opção</option>
						</select>
					</div>
					<div class="col-md-2">
						<label for="chkFilial">Possui filial?</label>
						<div class="form-control">
							<label class="checkbox-inline">
								<input type="checkbox" id="chkFilial" name="chkFilial" value="filial" ng-model="empresa.chkFilial" ng-disabled="filiaisDisabled" ng-change="setQtdFiliais(empresa.chkFilial)">Sim
							</label>
						</div>
					</div>
					<div class="col-md-4">
						<label for="qtdFilial">Quantas Filiais</label>
						<input type="text" class="form-control" id="filial" name="filial" ng-model="empresa.filial" ng-disabled="qtdFiliaisDisabled"></input>
						
					</div>
					
					
					<div class="col-md-4">
						<label for="regime">Regime</label>
						<select class="selectpiker form-control" id="regime" name="regime" ng-model="empresa.regime">
							<option value="SN">Simples Nacional</option>	
							<option value="lPres">Lucro Presumido</option>
							<option value="lReal">Lucro Real</option>
							
						</select>
					</div>	
					
					<div class="col-md-4 col-sm-4">
						<label for="fiscal">Fiscal</label>
						<div class="form-control">
							<label class="checkbox-inline">
								<input type="checkbox" id="chkFis" name="chkFis" ng-model="empresa.spedFiscal" value="fiscal"> SPED Fiscal
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" id="chkCont" name="chkCont" ng-model="empresa.spedPis" value="contribuicoes"> SPED Pis/Cofins
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" id="chkSint" name="chkSint" ng-model="empresa.sintegra" value="sintegra"> Sintegra
							</label>
						</div>
					</div>	
					<div class="col-md-2">
						<label for="nfiscal">100% Fiscal?</label>
						<div class="form-control">
							<label class="checkbox-inline">
								<input type="checkbox" id="chkNaoFiscal" name="chkNaoFiscal" ng-model="empresa.chkNaoFiscal" value="naoFiscal">Sim
							</label>
						</div>
					</div>
					
					
					
				</div>
				</div>
			
			</span>
			<span ng-show="formDadosEmp"></span>
			<!-- /Dados Empresa-->
			
			<!-- Dados do Computador-->
			
			<a href ng-click="toggleDadosComp()"><div class="well well-sm"><span class="text-center">Dados do Computador</span></div></a>
			
			<span ng-hide="formDadosComp">
			
				<table class="table table-bordered" >
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
					</tr>
					<tr name="computador[]" ng-repeat="comp in computadores">
						
						<td><span id="qtde" name="qtde">{{comp.qtd}}</span></td>
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
						<td><input class="form-control" type="text" ng-model="computador.qtd" name="qtd"></input></td>
						<td><input class="form-control" type="text" id="descricao" name="descricao" ng-model="computador.descricao"></input></td>
						<td><input class="form-control" type="text" id="sistOp" name="sistOp" ng-model="computador.sistOp"></input></td>
						<td><input class="form-control" type="text" id="descricao" name="descricao" ng-model="computador.hd"></input></td>
						<td><input class="form-control" type="text" id="descricao" name="descricao" ng-model="computador.memoria"></input></td>
						<td><input type="checkbox" id="chkSer" name="chkSer" ng-model="computador.serial" value="serial"></td>
						<td><input type="checkbox" id="chkServ" name="chkServ" ng-model="computador.serv" value="servidor"></td>
						<td><input type="checkbox" id="chkTerm" name="chkTerm" ng-model="computador.term" value="terminal"></td>
						<td><input type="checkbox" id="chkCx" name="chkCx" ng-model="computador.caixa" value="caixa"></td>
						<!-- <td><button class="btn btn-primary btn-block" ng-click="adicionarComp(computador)">Adicionar</button></td> -->
						<td><a href ng-click="adicionarComp(computador)"><div class="alert alert-info"><div class="text-center"> Adicionar</div></div></a></td>
					</tr>
				</table>
				

			
			</span>
			<span ng-show="formDadosComp"></span>
			<!-- /Dados do Computador-->
			
			<!-- Equipamentos -->


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
						<td>{{ecf.qtde}}</td>
						<td>{{ecf.marca}}</td>
						<!-- <td><button class="btn btn-block btn-danger" ng-click="deletaEcf(ecf)">Apagar</button></td> -->
						<td><a href ng-click="deletaEcf(ecf)"><div class="alert alert-danger"><div class="text-center">Apagar</div></div></a></td>
						
					</tr>
					<tr>
						<td><input type="text" class="form-control" id="ecfQtd" name="ecfQtd" ng-model="ecf.qtde" ></input></td>
						<td><input type="text" class="form-control" id="ecfMarca" name="ecfMarca" ng-model="ecf.marca" ></input></td>
						<!-- <td><button class="btn btn-block btn-primary" ng-click="adicionarEcf(ecf)">Adicionar</button></td> -->
						<td><a href ng-click="adicionarEcf(ecf)"><div class="alert alert-info"><div class="text-center"> Adicionar</div></div></a></td>
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
						<td>{{balanca.qtde}}</td>
						<td>{{balanca.marca}}</td>
						<!-- <td><button class="btn btn-block btn-danger" ng-click="deletaBalanca(balanca)">Apagar</button></td> -->
						<td><a href ng-click="deletaBalanca(balanca)"><div class="alert alert-danger"><div class="text-center">Apagar</div></div></a></td>
					</tr>
					<tr>
						<td><input type="text" class="form-control" id="balancaQtd" name="balancaQtd" ng-model="balanca.qtde" ></input></td>
						<td><input type="text" class="form-control" id="balancaMarca" name="balancaMarca" ng-model="balanca.marca" ></input></td>
						<!-- <td><button class="btn btn-block btn-primary" ng-click="adicionarBalanca(balanca)">Adicionar</button></td> -->
						<td><a href ng-click="adicionarBalanca(balanca)"><div class="alert alert-info"><div class="text-center"> Adicionar</div></div></a></td>
					</tr>
					<!-- {{balanca}}
					{{balancas}}  -->
													
				</table></table><table class="table table-bordered">
					<tr>
						<th class="text-center" colspan="3">Equip. de Rede</th>
					</tr>
					<tr>
						<th class="text-center">Qtd.</th>
						<th class="text-center">Marca</th>
						<th></th>
					</tr>
					<tr ng-repeat="rede in eqpRedes">
						<td>{{rede.qtde}}</td>
						<td>{{rede.marca}}</td>
						<!-- <td><button class="btn btn-block btn-danger" ng-click="deletaRede(rede)">Apagar</button></td> -->
						<td><a href ng-click="deletaRede(rede)"><div class="alert alert-danger"><div class="text-center">Apagar</div></div></a></td>
					</tr>
					<tr>
						<td><input type="text" class="form-control" id="redeQtd" name="redeQtd" ng-model="rede.qtde" ></input></td>
						<td><input type="text" class="form-control" id="redeMarca" name="redeMarca" ng-model="rede.marca" ></input></td>
						<!-- <td><button class="btn btn-block btn-primary" ng-click="adicionarRede(rede)">Adicionar</button></td> -->
						<td><a href ng-click="adicionarRede(rede)"><div class="alert alert-info"><div class="text-center"> Adicionar</div></div></a></td>
					</tr>					
					<!--

					{{rede}}
					{{eqpRedes}}

					-->
				</table>

			</span>
			<span ng-show="formEquip"></span>
			
			<!-- /Equipamentos-->
			
			<!-- Outras Informações-->
			
			
			<a href ng-click="toggleOutrasInfo()"><div class="well well-sm">Outras Informações</div></a>
			<span ng-hide="formOutrasInfo">
				<div class="col-md-12">
				
					<table class="table table-bordered">
						<tr>
							<td><label for="certDigital">Cert. Digital:</label></td>
							<td colspan="4">
							
								<label class="radio-inline">
									<input type="radio" name="certDigital" ng-model="outraInf.certDigital" value="A1">A1
								</label>
								<label class="radio-inline">
									<input type="radio" name="certDigital" ng-model="outraInf.certDigital" value="A3">A3
								</label>
								<label class="radio-inline">
									<input type="radio" name="certDigital" ng-model="outraInf.certDigital" value="nUsa">Não Usa
								</label>			
							</td>
							
							
						</tr>
						<tr>
							<td><label for="internet">Internet:</label></td>
							<td>
								<label class="radio-inline">
									<input type="radio" ng-model="outraInf.tipoInternet" name="optInternet" id="internetFibra" value="internetFibra" ng-change="setOutraInternet()">							
										Fibra
									</input>
								</label>
								<label class="radio-inline">
									<input type="radio" ng-model="outraInf.tipoInternet" name="optInternet" id="internetRadio" value="internetRadio" ng-change="setOutraInternet()">
										Radio
									</input>
								</label>
								<label class="radio-inline">
									<input type="radio" ng-model="outraInf.tipoInternet" name="optInternet" id="internetDsl" value="internetDsl" ng-change="setOutraInternet()">
										DSL
									</input>
								</label>
								<label class="radio-inline">
									<input type="radio" ng-model="outraInf.tipoInternet" name="optInternet" id="internetOutras" value="internetOutras" ng-change="setOutraInternet()">
										Outras
									</input>
								</label>
							</td>
							<td colspan = "3"><input class="form-control" type="text" id="qualInternet" name="qualInternet" ng-model="outraInf.qualInternet" ng-disabled="internetDisabled" placeholder="Qual?"></input></td>
							
						</tr>
						<tr>
							<td><label for="buscaPreco">Busca Preço:</label></td>
							<td><label class="radio-inline">
								<input type="radio" ng-model="outraInf.selBuscaPreco" name="optBuscaPreco" value="N" ng-change="setBuscaPreco()">Não
							</label>
								<label class="radio-inline">
									<input type="radio" ng-model="outraInf.selBuscaPreco" name="optBuscaPreco" value="S" ng-change="setBuscaPreco()">Sim
								</label>
							</td>
							<td colspan="3">
								<input class="form-control" type="text" id="qualBuscaPreco" name="qualBuscaPreco" ng-model="outraInf.buscaPreco" ng-disabled="buscaPrecoDisabled" placeholder="Qual Busca Preço?"></input>
							</td>
							
						</tr>
						<tr>
							<td><label for="impresEti">Impressora de Etiqueta</label></td>
							<td>
								
								<label class="radio-inline">
									<input type="radio" name="optImpEti" value="N" ng-model="outraInf.selImpEti" ng-change="setImpEti()">Não
								</label>
								<label class="radio-inline">
									<input type="radio" name="optImpEti" value="S" ng-model="outraInf.selImpEti" ng-change="setImpEti()">Sim
								</label>
							</td>
							<td colspan="3">
								<input class="form-control" type="text" id="qualImpEti" name="qualImpEti" ng-model="outraInf.impEtiqueta" placeholder="Qual Impressora?" ng-disabled="impEtiDisabled"></input>
							</td>
							
						</tr>
						<tr>
							<td><label for="tef">TEF</label></td>
							<td>
								<label class="radio-inline">
									<input type="radio" name="optTef" value="N" ng-model="outraInf.selTef" ng-change="setTef()">Não
								</label>
								<label class="radio-inline">
									<input type="radio" name="optTef" value="S" ng-model="outraInf.selTef" ng-change="setTef()">Sim
								</label>
							</td>
							<td colspan="2">
								<input class="form-control" type="text" id="qualTef" name="qualTef" ng-model="outraInf.marcaTef" placeholder="Qual TEF?" ng-disabled="tefDisabled"></input>
							</td>
								
							<td>
								<label class="radio-inline">
									<input type="radio" name="optAux" ng-model="outraInf.tipoTef" value="VPN" ng-disabled="tefDisabled">VPN
								</label>
								<label class="radio-inline">
									<input type="radio" name="optAux" ng-model="outraInf.tipoTef" value="moden" ng-disabled="tefDisabled">Moden
								</label>
								
							</td>
							
						</tr>
						<tr>
							<td><label for="impressora">Impressora</label></td>
							<td colspan="4">
								<label class="radio-inline">
									<input type="radio" name="optImpressora" ng-model="outraInf.impressora" value="N">Não
								</label>
								<label class="radio-inline">
									<input type="radio" name="optImpressora" ng-model="outraInf.impressora" value="S">Sim
								</label>
							</td>
							
						</tr>
						<tr>
							<td><label for="coletorDados">Coletor de Dados</label></td>
							<td colspan="4">
								<label class="radio-inline">
									<input type="radio" name="optColetor" ng-model="outraInf.colDados" value="N">Não
								</label>
								<label class="radio-inline">
									<input type="radio" name="optColetor" ng-model="outraInf.colDados" value="S">Sim
								</label>
							</td>
							
						</tr>
						<tr>
							<td><label for="leitorMesa">Leitor de Mesa</label></td>
							<td>
								<label class="radio-inline">
									<input type="radio" name="optLeitorMesa" value="N" ng-model="outraInf.selLeitorMesa" ng-change="setLeitorMesa()">Não
								</label>
								<label class="radio-inline">
									<input type="radio" name="optLeitorMesa" value="S" ng-model="outraInf.selLeitorMesa" ng-change="setLeitorMesa()">Sim
								</label>
							</td>
							<td>
								<input class="form-control" type="text" id="qualLeitorMesa" name="qualLeitorMesa" placeholder="Marca Leitor?" ng-model="outraInf.leitorMesaMarca" ng-disabled="leitorMesaDisabled"></input>
							</td>
							<td><input class="form-control" type="text" id="qtdLeitorMesa" name="qtdLeitorMesa" placeholder="Qtd" ng-model="outraInf.leitorMesaQtd" ng-disabled="leitorMesaDisabled"></input></td>
							<td>
								<label class="checkbox-inline">
									<input type="checkbox" id="chkLeitorMesaUsb" value="usb" ng-model="outraInf.leitorMesaUsb" ng-disabled="leitorMesaDisabled"> USB 
								</label>
							</td>
						</tr>
						<tr>
							<td><label for="leitorMao">Leitor de Mão</label></td>
							<td>
								<label class="radio-inline">
									<input type="radio" name="optLeitorMao" value="N" ng-model="outraInf.selLeitorMao" ng-change="setLeitorMao()">Não
								</label>
								<label class="radio-inline">
									<input type="radio" name="optLeitorMao" value="S" ng-model="outraInf.selLeitorMao" ng-change="setLeitorMao()">Sim
								</label>
							</td>
							<td>
								<input class="form-control" type="text" id="qualLeitor" name="qualLeitorMao" placeholder="Marca Leitor?" ng-model="outraInf.leitorMaoMarca" ng-disabled="leitorMaoDisabled"></input>
							</td>
							<td><input class="form-control" type="text" id="qtdLeitor" name="qtdLeitorMao" placeholder="Qtd" ng-model="outraInf.leitorMaoQtd" ng-disabled="leitorMaoDisabled"></input></td>
							<td>
								<label class="checkbox-inline">
									<input type="checkbox" id="chkLeitoMaorUsb" value="usb" ng-model="outraInf.leitorMaoUsb" ng-disabled="leitorMaoDisabled"> USB
								</label>
							</td>
						</tr>
						<tr>
							<td><label for="palm">Palm</label></td>
							<td>
								<label class="radio-inline">
									<input type="radio" name="optPalm" value="N" ng-model="outraInf.selPalm" ng-change="setPalm()">Não
								</label>
								<label class="radio-inline">
									<input type="radio" name="optPalm" value="S" ng-model="outraInf.selPalm" ng-change="setPalm()">Sim
								</label>
							</td>
							<td>
								<input class="form-control" type="text" id="qualPalm" name="qualPalm" ng-model="outraInf.palmMarca" placeholder="Marca Palm?" ng-disabled="palmDisabled"></input>
							</td>
							<td><input class="form-control" type="text" id="qtdPalm" name="qtdPalm" placeholder="Qtd" ng-model="outraInf.palmQtd" ng-disabled="palmDisabled"></input></td>
							<td>
								<label class="checkbox-inline">
									
									<input class="form-control" type="text" id="soPalm" name="soPalm" placeholder="SO Palm?" ng-model="outraInf.palmSO" ng-disabled="palmDisabled"></input>
								</label>
							</td>
						</tr>
						<tr>
							<td><label for="usaSistema">Usa Sistema?</label></td>
							<td>
								<label class="radio-inline">
									<input type="radio" name="optSistema" value="N" ng-model="outraInf.selNomeSistema" ng-change="setSistema()">Não
								</label>
								<label class="radio-inline">
									<input type="radio" name="optSistema" value="S" ng-model="outraInf.selNomeSistema" ng-change="setSistema()">Sim
								</label>
							</td>
							<td colspan="3">
								<input class="form-control" type="text" id="qualSistema" name="qualSistema" placeholder="Qual Sistema?" ng-model="outraInf.nomeSistema" ng-disabled="sistemaDisabled">

							</td>
							
						</tr>
						
						<!-- <tr>
							<td><label for="coletorDados">Coletor de Dados</label></td>
							<td colspan="4">
								<label class="radio-inline">
									<input type="radio" name="optColetor" ng-model="outraInf.optColetor" value="N">Não
								</label>
								<label class="radio-inline">
									<input type="radio" name="optColetor" ng-model="outraInf.optColetor" value="S">Sim
								</label>
							</td>
							
						</tr> -->
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
							<th class="text-center">Caixa</th>
							<th class="text-center"></th>
						</tr>
						
						<tr ng-repeat="nBreak in nBreaks">							
							<td>{{nBreak.qtde}}</td>
							<td>{{nBreak.marca}}</td>
							<td>{{nBreak.serv}}</td>
							<td>{{nBreak.term}}</td>
							<td>{{nBreak.caixa}}</td>							
							<!-- <td><button class="btn btn-block btn-danger" ng-click="deletaNobreak(nBreak)">Apagar</button></td>		 -->
							<td><a href ng-click="deletaNobreak(nBreak)"><div class="alert alert-danger"><div class="text-center">Apagar</div></div></a></td>
						</tr>
						<tr>
							<td><input class="form-control" type="text" placeholder="Qtd" ng-model="nobreak.qtde"></input></td>
							<td><input class="form-control" type="text" placeholder="Marca" ng-model="nobreak.marca"></input></td>
							<td><input type="checkbox" id="chkNBServ" ng-model="nobreak.serv" value="NBServidor"></td>
							<td><input type="checkbox" id="chkNBTerm" ng-model="nobreak.term" value="NBTerminal"></td>
							<td><input type="checkbox" id="chkNBCx" ng-model="nobreak.caixa" value="NBTerminal"></td>
							<!-- <td><button class="btn btn-block btn-primary" ng-click="adicionarNBreak(nobreak)"> add </button></td> -->
							<td><a href ng-click="adicionarNBreak(nobreak)"><div class="alert alert-info"><div class="text-center"> Adicionar</div></div></a></td>
						</tr>
						<!-- {{nBreak}}
						{{nBreaks}} -->
					</table>

					<table class="table table-bordered">
						<tr>
							<th class="text-center" colspan="2">Remoto</th>
						</tr>
						<tr>
							<td><label for="acessoOutro">Acessa de Outro Computador?</label></td>
							<td>
								<label class="radio-inline">
									<input type="radio" name="optAcesso" value='N' ng-model="remoto.recebeAcesso">Não
								</label>
								<label class="radio-inline">
									<input type="radio" name="optAcesso" value='S' ng-model="remoto.recebeAcesso">Sim
								</label>
							</td>
						</tr>
						<tr>
							<td><label for="interligaFiliais">Interliga Filiais?</label></td>
							<td>
								<label class="radio-inline">
									<input type="radio" name="optFiliais" value='N' ng-model="remoto.interligaFilial">Não
								</label>
								<label class="radio-inline">
									<input type="radio" name="optFiliais" value='S' ng-model="remoto.interligaFilial">Sim
								</label>
							</td>
						</tr>
						<tr>
							<td><label for="ipFixo">Ip Fixo?</label></td>
							<td>
								<label class="radio-inline">
									<input type="radio" name="optIp" value="N" ng-model="remoto.selIpFixo" ng-change="setIpFixo()">Não
								</label>
								<label class="radio-inline">
									<input type="radio" name="optIp" value="S" ng-model="remoto.selIpFixo" ng-change="setIpFixo()">Sim
								</label>
							</td>
						</tr>
						<tr>
							<td><label for="qualIp">Qual IP?</label></td>
							<td>
								<input class="form-control" type="text" id="ipFixo" placeholder="Digite o IP" ng-model="remoto.ipFixo"ok ng-disabled="ipFixoDisabled">
							
							</td>
						</tr>
						
						
					</table>
					
				</div>
			</span>
			<span ng-show="formOutrasInfo"></span>
			<!-- /Outras Informações-->

			<!--Sistema-->

			
			<a href ng-click="toggleSistema()"><div class="well well-sm">Sistema</div></a>
			<span ng-hide="formSistema">

				<table class="table">
					<tr>
						<th class="text-center" colspan=5>Sistema</th>
					</tr>
					<tr>
						<td><input type="checkbox" id="intellicashFull" name="intellicashFull" ng-model="sistema.intellicashFull">Intellicash Full</input></td>
						<td><input type="checkbox" id="intellicashLight" name="intellicashLight" ng-model="sistema.intellicashLight">Intellicash Light</input></td>
						<td><input type="checkbox" id="easycash" name="easycash" ng-model="sistema.easycash">Easycash</input></td>
						<td><input type="checkbox" id="gnfe" name="gnfe" ng-model="sistema.gnfe">GNFe</input></td>
						<td></td>
					</tr>
					<tr>
						<td><input type="checkbox" id="cotacao" name="cotacao" ng-model="sistema.cotacao">Cotação Online</input></td>
						<td><input type="checkbox" id="intelligroup" name="intelligroup" ng-model="sistema.intelligroup">Intelligroup</input></td>
						<td><input type="checkbox" id="intellistock" name="intellistock" ng-model="sistema.intellistock">Intellistock</input></td>
						<td><input type="checkbox" id="vendaAssit" name="vendaAssist" ng-model="sistema.vendaAssist">Venda Assistida</input></td>
						<td></td>
					</tr>
					<tr>
						<th>
						</th>
					</tr>
					<tr>
						<td><input type="checkbox" id="orcamento" name="orcamento" ng-model="sistema.orcamento">Orçamento</input></td>
						<td><input type="checkbox" id="pedido" name="pedido" ng-model="sistema.pedido">Pedido</input></td>
						<td><input type="checkbox" id="produto" name="produto" ng-model="sistema.produto">Produto</input></td>
						<td><input type="checkbox" id="edi" name="edi" ng-model="sistema.edi">EDI</input></td>
						<td><input type="checkbox" id="mgMobile" name="mgMobile" ng-model="sistema.mgMobile">MGMobile</input></td>
					</tr>
					<tr>
						<td><input type="checkbox" id="nfDestinada" name="nfDestinada" ng-model="sistema.nfDestinada">NFe-Destinada</input></td>
						<td><input type="checkbox" id="contasPgRc" name="contasPgRc" ng-model="sistema.contasPgRc">Contas a Pagar/receber</input></td>
						<td><input type="checkbox" id="sincronizador" name="sincronizador" ng-model="sistema.sincronizador">Sincronizador</input></td>
						<td><input type="checkbox" id="entregaCega" name="entregaCega" ng-model="sistema.entregaCega">Entrega Cega</input></td>
						<td><input type="checkbox" id="cte" name="cte" ng-model="sistema.cte">CT-e</input></td>
					</tr>
				</table>
			</span>
			<span ng-show="formSistema"></span>
			<!-- /Sistema-->
			
			<!-- Processos e Procedimentos-->

			
			<a href ng-click="toggleProc()"><div class="well well-sm">Processos e Procedimentos</div></a>
			<span ng-hide="formProc">

			<!-- 
			{{processos}} 
			-->
			
				<table class="table">
					<tr>
						<td><label for="qtdCad">Quantas pessoas realizam o cadastro?</label></td>
						<td></td>
						<td>
							<input class="form-control" text="text" id="qtdCadastro" name="qtdCadastro" ng-model="processos.qtdCadastro">
						</td>
					</tr>
					<tr>
						<td>
							<label for="pessoaCad">Mesma pessoa do cadastro, lança notas fiscais?</label>
						</td>
						<td>
							<label class="radio-inline">
								<input type="radio" name="optPessoaLanc" value="N" ng-model="processos.selPessoaLanc" ng-change="setPessoaLanc()">Não
							</label>
							<label class="radio-inline">
								<input type="radio" name="optPessoaLanc" value="S" ng-model="processos.selPessoaLanc" ng-change="setPessoaLanc()">Sim
							</label>
						</td>
						<td>
							<input class="form-control" text="text" id="pessoaLanc" placeholder="Quem Lança as NF?" ng-model="processos.pessoaLanc" ng-disabled="pessoaLancDisabled">
						</td>
					</tr>
					<tr>
						<td><label for="qLancPrec">Os preços são conferidos pela mesma pessoa que lança nota de compra?</label></td>
						<td>
							<label class="radio-inline">
								<input type="radio" name="optLancPreco" value="N" ng-model="processos.selLancPreco" ng-change="setLancPreco()">Não
								
							</label>
							<label class="radio-inline">
								<input type="radio" name="optLancPreco" value="S" ng-model="processos.selLancPreco" ng-change="setLancPreco()">Sim
							</label>
						</td>
						<td><input class="form-control" text="text" id="lancPreco" placeholder="Quem confere preço?" ng-model="processos.lancPreco" ng-disabled="lancPrecoDisabled"></td>
					</tr>
					<tr>
						<td><label for="qRecebeMerc">A mercadoria é recebida pela pessoa que lança nota de compra?</label></td>
						<td>
							<label class="radio-inline">
								<input type="radio" name="optRecebeMerc" value="N" ng-model="processos.selRecebeMerc" ng-change="setRecebeMerc()">Não
							</label>
							<label class="radio-inline">
								<input type="radio" name="optRecebeMerc" value="S" ng-model="processos.selRecebeMerc" ng-change="setRecebeMerc()">Sim
							</label>
						</td>
						<td><input class="form-control" text="text" id="recebeMerc" placeholder="Quem recebe mercadoria?" ng-model="processos.recebeMerc" ng-disabled="recebeMercDisabled"></td>
					</tr>
					<tr>
						<td><label for="qCompraVenda">Mesma pessoa lança nota de compra e nota de venda?</label></td>
						<td>
							<label class="radio-inline">
								<input type="radio" name="optCompraVenda" value="N" ng-model="processos.selCompraVenda" ng-change="setCompraVenda()">Não
							</label>
							<label class="radio-inline">
								<input type="radio" name="optCompraVenda" value="S" ng-model="processos.selCompraVenda" ng-change="setCompraVenda()">Sim
							</label>
						</td>
						<td><input class="form-control" text="text" id="compraVenda" placeholder="Quem lança nota?" ng-model="processos.compraVenda" ng-disabled="compraVendaDisabled"></td>
					</tr>
					<tr>
						<td><label for="qFiscalCaixa">Fiscal de Caixa?</label></td>
						<td>
							<label class="radio-inline">
								<input type="radio" name="optFiscalCaixa" value="N" ng-model="processos.selFiscalCaixa" ng-change="setFiscalCaixa()">Não
							</label>
							<label class="radio-inline">
								<input type="radio" name="optFiscalCaixa" value="S" ng-model="processos.selFiscalCaixa" ng-change="setFiscalCaixa()">Sim
							</label>
						</td>
						<td><input class="form-control" text="text" id="fiscalVendas" placeholder="Fiscal de Caixa?" ng-model="processos.fiscalVendas" ng-disabled="fiscalCaixaDisabled"></td>
					</tr>
					<tr>
						<td><label for="qCaixaDiario">Realiza fechamento de caixa diário?</label></td>
						<td>
							<label class="radio-inline">
								<input type="radio" name="optCaixaDiario" ng-model="processos.fechamentoDiario" value="N">Não
							</label>
							<label class="radio-inline">
								<input type="radio" name="optCaixaDiario" ng-model="processos.fechamentoDiario" value="S">Sim
							</label>
						</td>
						<td></td>
					</tr>
					<tr>
						<td><label for="qRespFechamento">Tem alquém responsável por conferir Fechamento de Caixa?</label></td>
						<td>
							<label class="radio-inline">
								<input type="radio" name="optRespFechamento" value="N" ng-model="processos.selRespFechamento" ng-change="setRespFechamento()">Não
							</label>
							<label class="radio-inline">
								<input type="radio" name="optRespFechamento" value="S" ng-model="processos.selRespFechamento" ng-change="setRespFechamento()">Sim
							</label>
						</td>
						<td><input class="form-control" text="text" id="respFechamento" placeholder="Responsavel Fechamento" ng-model="processos.respFechamento" ng-disabled="respFechamentoDisabled"></td>
					</tr>
					<tr>
						<td><label for="qRespFinanceiro">Responsavel pelo Financeiro?</label></td>
						<td>
							<label class="radio-inline">
								<input type="radio" name="optRespFinanceiro" value="N" ng-model="processos.selRespFinanceiro" ng-change="setRespFinanceiro()">Não
							</label>
							<label class="radio-inline">
								<input type="radio" name="optRespFinanceiro"  value="S" ng-model="processos.selRespFinanceiro" ng-change="setRespFinanceiro()">Sim									
							</label>
						</td>
						<td><input class="form-control" text="text" id="respFinanceiro" placeholder="Responsavel Financeiro" ng-model="processos.respFinanceiro" ng-disabled="respFinanceiroDisabled"></td>
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
						<div ng-class="cssClassCpfVendedor">
							<td><input type="text" class="form-control" ng-model="vendedor.cpf" ng-change="validaCPFVendedor(vendedor.cpf)"></input></td>
						</div>
						<td><input type="text" class="form-control" ng-model="vendedor.nome"></input></td>
						<td><input type="text" class="form-control" ng-model="vendedor.codigo"></input></td>
						<td><input type="checkbox" ng-model="vendedor.desconto" value="vendDesconto"></input></td>
						<td><input type="checkbox" ng-model="vendedor.comissao"></input></td>
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
						<th>{{operador.descAcr}}</th>
						<th>{{operador.cancelar}}</th>
						<th>{{operador.liberar}}</th>
						<th>{{operador.redZ}}</th>
						<th>{{operador.suprSang}}</th>
						<!-- <th><button class="btn btn-danger" ng-click="deletaOperador(operador)">Apagar</button></th> -->
						<td><a href ng-click="deletaOperador(operador)"><div class="alert alert-danger"><div class="text-center">Apagar</div></div></a></td>
					</tr>
					<tr>
						<div ng-class="cssClassCpf">
							<td><input type="text" class="form-control" ng-model="operador.cpf" ng-change="validaCPFOperador(operador.cpf)"></input></td>							
						</div>
						<td><input type="text" class="form-control" ng-model="operador.nome"></input></td>
						<td><input type="text" class="form-control" ng-model="operador.turno"></input></td>
						<td><input type="checkbox" ng-model="operador.descAcr"></input></td>
						<td><input type="checkbox" ng-model="operador.cancelar"></input></td>
						<td><input type="checkbox" ng-model="operador.liberar"></input></td>
						<td><input type="checkbox" ng-model="operador.redZ"></input></td>
						<td><input type="checkbox" ng-model="operador.suprSang"></input></td>
						<!-- <td><button class="btn btn-primary" ng-click="adicionarOperador(operador)">Adicionar</button></td> -->
						<td><a href ng-click="adicionarOperador(operador)"><div class="alert alert-info"><div class="text-center"> Adicionar</div></div></a></td>
					</tr>
				</table>
				{{erroCpfOperador}}
				
			</span>
			<span ng-show="fornProc"></span>
			
			<table>
				<tr>
					<td>
						<div class="col md-3" ng-controller="controller">
							<!--
							<a href ="#/"><input type="submit"  ng-click= "submitForm(cliente)" class="btn btn-success"></input></a>
							-->
							<input type="submit"  ng-click= "submitForm(cliente)" class="btn btn-success"></input>

						</div>			
					</td>
					
				</tr>
				
			</table>

			

			
			<!-- /Processos e Procedimentos-->
		</form>
	</div>

</div>
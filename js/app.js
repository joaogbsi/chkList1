var app = angular.module('myApp', ['ngRoute']);


app.controller('controller', function($scope, $window, $http, $document,$location){
	
	
	
	$scope.submitForm = function(cliente){
		//$scope.empresa.push(angular.copy(cliente.empresa));

		$scope.mensagem = '';
		if(!$scope.cnpj){
			if(!$scope.mensagem){
				$scope.mensagem += 'Campos obrigatórios:';
			}
			$scope.mensagem +='\n- Digite um cnpj valido';
		}
		if(!$scope.nomeDisabled){
			if(!$scope.mensagem){
				$scope.mensagem += 'Campos obrigatórios:';
			}
			$scope.mensagem +='\n- Digite o nome da empresa';
		}
		if(!$scope.emailDisabled){
			if(!$scope.mensagem){
				$scope.mensagem += 'Campos obrigatórios:';
			}
			$scope.mensagem +='\n- Digite um e-mail valido';
		}
		if(!$scope.telefoneDisabled){
			if(!$scope.mensagem){
				$scope.mensagem += 'Campos obrigatórios:';
			}
			$scope.mensagem +='\n- Digite o telefone da empresa';	
		}

		if($scope.mensagem){
			$window.alert($scope.mensagem);
			return;
		}

		console.log($scope.empresa);
		post = {
            "empresa"     : $scope.empresa,
            "computadores": $scope.computadores,
            "outraInf"    : $scope.outraInf,
            "remoto"      : $scope.remoto,
			"nBreaks"     : $scope.nBreaks,
			"ecfs"        : $scope.ecfs,
			"balancas"    : $scope.balancas,
			"eqpRedes"    : $scope.eqpRedes,
			"sistema"     : $scope.sistema,
			"vendedores"  : $scope.vendedores,
			"operadores"  : $scope.operadores,
			"processos"   : $scope.processos
			
		};
		
		$scope.json= angular.toJson(post);
		
		console.log(post);
		console.log($scope.json);
		
		 $http({
            method  : 'POST',
            url     : 'server/gravarCliente.php',
            data    : post,
            headers :{'Content-Type': 'application/json'},
			
        }).then(function(response,data){
			console.log(response.data);
			$location.path('listCliente');
		});

        //$scope.deletar();
        

		
	};
});


app.config(['$routeProvider', function($routeProvider, $scope, $rootScope){
	
	$routeProvider.
	when('/', {
		/*
		templateUrl: 'list_cliente.php',
		controller: 'listCliente'
		*/
		templateUrl: 'login.php',
		controller: 'userControler'

	}).
	when('/editarCliente/:cnpj',{
		templateUrl: 'editarCliente.php',
		controller: 'editarCliente',
		resolve: {
	    	cnpj: function($route){
			console.log($route);
	        var cnpj = $route.current.params.cnpj;
	        //$scope.clietne = getCliente(cnpj);
	        }
      	}
	}).
	when('/listCliente',{
		templateUrl: 'list_cliente.php',
		controller: 'listCliente'
	}).
	otherwise({
        redirectTo: '/'
    });
}]);

app.run(function($rootScope, $route, $routeParams, $location) {

      
	$rootScope.$on('$routeChangeStart',function(evt,next,current){
	console.log('user: '+$rootScope.user);
	console.log('params: '+$routeParams);
	//console.log($scope.login);
	//$rootScope.authentication = true;
	//console.log($rootScope.authentication);
	console.log('Nome do Evento:'+evt.name);
	console.log('Próxima Rota:'+ angular.toJson(next));
	console.log('Rota Atual:'+ angular.toJson(current));
	});
});

app.controller('listCliente', function($scope, $window, $http, $document, $rootScope, $location){
	$scope.usuario = $rootScope.user;
	if($rootScope.autorizado){
		$scope.clientes = getClientes(); 

		function getClientes(){
			var json;
			$http({
				method  : 'GET',
				url     : 'server/recebeClientes.php',
				data    : json,
				headers :{'Content-Type': 'application/json'},

			}).then(function(response,data){
				console.log(response);

				$scope.clientes = response.data;
			});
		}
		
	}else{
		$location.path('/');
		$window.alert('Sem usuario');
	}
});

app.controller('editarCliente', function($scope, $window, $http, $document, $routeParams, $rootScope, $location){

	//if($rootScope.autorizado){
		console.log($rootScope.autorizado);

	//cnpj = $routeParams.cnpj;
	//console.log(cnpj);
		if($routeParams.cnpj == 0){
			$scope.empresa;
			$scope.computador;
		
			$scope.computadores = [
				
			];

			$scope.nBreaks = [
				
			];
			
			$scope.ecfs = [
				
			];
			
			$scope.balancas = [
				
			];
			
			$scope.redes = [
				
			];
			
			$scope.vendedores = [
				
			];
			
			$scope.operadores = [
				
			];
		}else{
			$scope.cliente = getCliente($routeParams.cnpj);		
		}
	/*}else{
		$location.path('/');
		$window.alert('Sem usuario')
	}*/
	
	//$scope.getCliente(cnpj)
	
	function getCliente(cnpj){
		console.log(cnpj);
		$http({
            method  : 'GET',
            url     : 'server/lerCliente.php',
            headers : {'Content-Type': 'application/json', 'cnpj': cnpj}
			
        }).then(function(response,data){
        	console.log(response.data);
			$scope.cliente = response.data;


			$scope.empresa = response.data.empresa;
            $scope.computadores = response.data.computadores;
            $scope.outraInf =  response.data.outrasInf;
            $scope.remoto =  response.data.remoto;
			$scope.nBreaks =  response.data.nobreaks;
			$scope.ecfs =  response.data.ecfs;
			$scope.balancas =  response.data.balancas;
			//$scope.redes  = response.data.eqpRedes;
			$scope.eqpRedes  = response.data.eqpRedes;
			$scope.sistema =  response.data.sistema;
			$scope.vendedores =  response.data.vendedores;
			$scope.operadores =  response.data.operadores;
			$scope.processos =  response.data.processos;
			$scope.computador;

			/*
			console.log($scope.empresa);
			console.log($scope.computadores);
			console.log($scope.outraInf);
			console.log($scope.remoto);
			console.log($scope.nBreaks);
			console.log($scope.ecfs);
			console.log($scope.balancas);
			console.log($scope.eqpRedes);
			console.log($scope.sistema);
			console.log($scope.vendedores);
			console.log($scope.operadores);
			console.log($scope.processos);
			*/

			$scope.validarCNPJ($scope.empresa.cnpj);
			$scope.setNomeEmpresa();
			$scope.validarEmail();
			$scope.setTelefone();

		});

	};

	$scope.ramos=['Supermercado', 'Loja', 'Mat. Construção', 'Outras'];
	
	$scope.lojas=['Matriz', 'Filial'];

	$scope.computador;
		
/*-----------------------------------------------------------------------------------------------------------------------------------------------------------*/
	$scope.nomeDisabled = false;
	$scope.emailDisabled = false;
	$scope.telefoneDisabled = false;

	$scope.setNomeEmpresa = function(){
		if($scope.empresa.empresa){
			$scope.nomeDisabled = true;
		}
	}

	$scope.validarEmail = function(){
		if($scope.empresa.email){
			if($scope.form.email.$valid){
				$scope.emailDisabled = $scope.form.email.$valid;
			}			
		}
	}

	$scope.setTelefone = function(){
		if($scope.empresa.telefone){
			$scope.telefoneDisabled = true;
		}
	}

	$scope.ramoDisabled = true;
	$scope.filiaisDisabled = true;
	$scope.qtdFiliaisDisabled = true;
	$scope.internetDisabled = true;
	$scope.buscaPrecoDisabled = true;
	$scope.impEtiDisabled = true;
	$scope.tefDisabled = true;
	$scope.leitorMesaDisabled=true;
	$scope.leitorMaoDisabled=true;
	$scope.palmDisabled=true;
	$scope.sistemaDisabled=true;
	$scope.ipFixoDisabled=true;
	$scope.pessoaLancDisabled=true;
	$scope.lancPrecoDisabled=true;
	$scope.recebeMercDisabled=true;
	$scope.compraVendaDisabled=true;
	$scope.fiscalCaixaDisabled=true;
	$scope.respFechamentoDisabled=true;
	$scope.respFinanceiroDisabled=true;

	$scope.setOutroRamo = function(ramo){
		if(ramo === 'Outras')
			$scope.ramoDisabled = false;
		else{
			$scope.ramoDisabled = true;
			delete ($scope.empresa.ramoTipo);
			
		}
	};
	
	$scope.setLoja= function(loja){
		if(loja === 'Matriz')
			$scope.filiaisDisabled = false;
		else{
			$scope.filiaisDisabled = true;
			$scope.empresa.chkFilial = false;
			delete($scope.empresa.qtdFilial);
			$scope.qtdFiliaisDisabled=true;
		}
	};
	
	$scope.setQtdFiliais=function(chkFilial){

		if(chkFilial){
			$scope.qtdFiliaisDisabled=false;
		}
		else{
			$scope.qtdFiliaisDisabled=true;
			delete($scope.empresa.qtdFilial);
		}
	};
	
	$scope.setOutraInternet= function(){		
		if($scope.outraInf.tipoInternet != 'internetOutras'){
			$scope.internetDisabled = true;
			delete($scope.outraInf.qualInternet);		
		}
		else{
			$scope.internetDisabled = false;
		}
	};
	
	$scope.setBuscaPreco= function(){
		if($scope.outraInf.selBuscaPreco != 'S'){
			$scope.buscaPrecoDisabled = true;
			delete($scope.outraInf.qualBuscaPreco);		
		}
		else{
			$scope.buscaPrecoDisabled = false;
		}
		
	};
	
	$scope.setImpEti= function(){
		if($scope.outraInf.selImpEti != 'S'){
			$scope.impEtiDisabled = true;
			delete($scope.outraInf.impEtiqueta);		
		}
		else{
			$scope.impEtiDisabled = false;
		}
		
	};
	
	$scope.setTef= function(){
		if($scope.outraInf.selTef != 'S'){
			$scope.tefDisabled = true;
			delete($scope.outraInf.qualTef);		
			delete($scope.outraInf.optAux);		
		}
		else{
			$scope.tefDisabled = false;
		}
		
	};

	$scope.setLeitorMesa= function(){
		if($scope.outraInf.selLeitorMesa != 'S'){
			$scope.leitorMesaDisabled = true;
			delete($scope.outraInf.qualLeitorMesa);		
			delete($scope.outraInf.qtdLeitorMesa);		
			delete($scope.outraInf.chkLeitorMesaUsb);		
		}
		else{
			$scope.leitorMesaDisabled = false;
		}
		
	};
	
	$scope.setLeitorMao= function(){
		if($scope.outraInf.selLeitorMao != 'S'){
			$scope.leitorMaoDisabled = true;
			delete($scope.outraInf.qualLeitorMao);		
			delete($scope.outraInf.qtdLeitorMao);		
			delete($scope.outraInf.chkLeitorMaorUsb);		
		}
		else{
			$scope.leitorMaoDisabled = false;
		}
		//$scope.leitorMaoDisabled = $scope.outraInf.selLeitorMao != 'sim'? true: false;
	};
	
	$scope.setPalm= function(){
		if($scope.outraInf.selPalm != 'S'){
			$scope.palmDisabled = true;
			delete($scope.outraInf.qualPalm);		
			delete($scope.outraInf.qtdPalm);		
			delete($scope.outraInf.soPalm);		
		}
		else{
			$scope.palmDisabled = false;
		}
		//$scope.palmDisabled = $scope.outraInf.selPalm != 'sim'? true: false;
	};
	
	$scope.setSistema= function(){
		if($scope.outraInf.selNomeSistema != 'S'){
			$scope.sistemaDisabled = true;
			delete($scope.outraInf.qualSistema);		
		}
		else{
			$scope.sistemaDisabled = false;
		}
		//$scope.sistemaDisabled = $scope.outraInf.selSistema != 'sim'? true: false;
	};
	
	$scope.setIpFixo= function(){
		if($scope.remoto.selIpFixo != 'S'){
			$scope.ipFixoDisabled = true;
			delete($scope.remoto.ipFixo);		
		}
		else{
			$scope.ipFixoDisabled = false;
		}

		//$scope.ipFixoDisabled = $scope.cliente.selIpFixo != 'sim'? true: false;
	};
	
	$scope.setPessoaLanc= function(){

		if($scope.processos.selPessoaLanc != 'N'){
			$scope.pessoaLancDisabled = true;
			delete($scope.processos.pessoaLanc);		
		}
		else{
			$scope.pessoaLancDisabled = false;
		}
		//$scope.pessoaLancDisabled = $scope.cliente.selPessoaLanc != 'nao'? true: false;
	};
	
	$scope.setLancPreco= function(){
		if($scope.processos.selLancPreco != 'N'){
			$scope.lancPrecoDisabled = true;
			delete($scope.processos.lancPreco);		
		}
		else{
			$scope.lancPrecoDisabled = false;
		}
		//$scope.lancPrecoDisabled = $scope.cliente.selLancPreco != 'nao'? true: false;	
	};
	
	$scope.setRecebeMerc= function(){
		if($scope.processos.selRecebeMerc != 'N'){
			$scope.recebeMercDisabled = true;
			delete($scope.processos.recebeMerc);		
		}
		else{
			$scope.recebeMercDisabled = false;
		}
		//$scope.recebeMercDisabled = $scope.cliente.selRecebeMerc != 'nao'? true: false;
	};
	
	$scope.setCompraVenda= function(){
		if($scope.processos.selCompraVenda != 'N'){
			$scope.compraVendaDisabled = true;
			delete($scope.processos.compraVenda);		
		}
		else{
			$scope.compraVendaDisabled = false;
		}
		//$scope.compraVendaDisabled = $scope.cliente.selCompraVenda != 'nao'? true: false;
	};
	
	$scope.setFiscalCaixa= function(){
		if($scope.processos.selFiscalCaixa != 'N'){
			$scope.fiscalCaixaDisabled = true;
			delete($scope.processos.fiscalVendas);		
		}
		else{
			$scope.fiscalCaixaDisabled = false;
		}
		//$scope.fiscalCaixaDisabled = $scope.cliente.selFiscalCaixa != 'nao'? true: false;
	};
	

	
	$scope.setRespFechamento= function(){
		if($scope.processos.selRespFechamento != 'S'){
			$scope.respFechamentoDisabled = true;
			delete($scope.processos.respFechamento);		
		}
		else{
			$scope.respFechamentoDisabled = false;
		}
		//$scope.respFechamentoDisabled = $scope.cliente.selRespFechamento != 'sim'? true: false;
	};
	
	$scope.setRespFinanceiro= function(){
		if($scope.processos.selRespFinanceiro != 'S'){
			$scope.respFinanceiroDisabled = true;
			delete($scope.processos.respFinanceiro);		
		}
		else{
			$scope.respFinanceiroDisabled = false;
		}
		//$scope.respFinanceiroDisabled = $scope.cliente.selRespFinanceiro != 'sim'? true: false;

	};
	
/*-----------------------------------------------------------------------------------------------------------------------------------------------------------*/	
	//console.log(computadores);
	$scope.adicionarComp = function(computador){

		if(!$scope.computadores){
			$scope.computadores = [

			];
		}

		if(computador.serial == true)
			computador.serial = 1;
		else
			computador.serial = 0;
		
		if(computador.serv == true)
			computador.serv = 1;
		else
			computador.serv = 0;

		if(computador.term == true)
			computador.term = 1;
		else
			computador.term = 0;

		if(computador.caixa == true)
			computador.caixa = 1;
		else
			computador.caixa = 0;

		$scope.computadores.push(angular.copy(computador));
		delete $scope.computador;
	
	};
	
	$scope.deletaComp =function(index){
		var indexOfComp = $scope.computadores.indexOf(index);

		$scope.computadores.splice(indexOfComp, 1);
	};

	
	
	$scope.adicionarNBreak = function(nobreak){

		if(!$scope.nBreaks){
			$scope.nBreaks = [

			];
		}

		if(nobreak.serv)
			nobreak.serv = 1;
		else
			nobreak.serv = 0;

		if(nobreak.term)
			nobreak.term = 1;
		else
			nobreak.term = 0;

		if(nobreak.caixa)
			nobreak.caixa = 1;
		else
			nobreak.caixa = 0;

		$scope.nBreaks.push(angular.copy(nobreak));
		delete ($scope.nobreak);
	}

	$scope.deletaNobreak =function(index){
		var indexOfNobreak = $scope.nBreaks.indexOf(index);

		$scope.nBreaks.splice(indexOfNobreak, 1);
	};
	
	$scope.adicionarEcf= function(ecf){

		if(!$scope.ecfs){
			$scope.ecfs = [

			];
		}


		$scope.ecfs.push(angular.copy(ecf));
		delete($scope.ecf)
	}
	
	$scope.deletaEcf =function(index){
		var indexOfEcf = $scope.ecfs.indexOf(index);

		$scope.ecfs.splice(indexOfEcf, 1);
	};
	
	$scope.adicionarBalanca= function(balanca){


		if(!$scope.balancas){
			$scope.balancas = [

			];
		}

		$scope.balancas.push(angular.copy(balanca));
		delete($scope.balanca)
	}
	
	$scope.deletaBalanca =function(index){
		var indexOfBalanca = $scope.balancas.indexOf(index);

		$scope.balancas.splice(indexOfBalanca, 1);
	};
	
	$scope.adicionarRede= function(rede){


		if(!$scope.eqpRedes){
			$scope.eqpRedes = [

			];
		}
		console.log('teste');
		$scope.eqpRedes.push(angular.copy(rede));
		delete($scope.rede)
	}
	
	$scope.deletaRede =function(index){
		var indexOfRede = $scope.eqpRedes.indexOf(index);

		$scope.eqpRedes.splice(indexOfRede, 1);
	};
	
	$scope.adicionarVendedor= function(vendedor){

		if(!$scope.vendedores){
			$scope.vendedores = [

			];
		}

		if(vendedor.desconto){
			vendedor.desconto = 1;
		}else
			vendedor.desconto = 0;

		if(vendedor.comissao){
			vendedor.comissao = 1;
		}else
			vendedor.comissao = 0;

		$scope.vendedores.push(angular.copy(vendedor));
		delete($scope.vendedor);
	}
	
	$scope.deletaVendedor =function(index){
		var indexOfVendedor = $scope.vendedores.indexOf(index);

		$scope.vendedores.splice(indexOfVendedor, 1);
	};
	
	$scope.adicionarOperador= function(operador){

		if(!$scope.operadores){
			$scope.operadores = [

			];
		}

		if(operador.descAcr){
			operador.descAcr = 1;
		}else
			operador.descAcr = 0;

		if(operador.cancelar){
			operador.cancelar = 1;
		}else
			operador.cancelar = 0;

		if(operador.liberar){
			operador.liberar = 1;
		}else
			operador.liberar = 0;

		if(operador.redZ){
			operador.redZ = 1;
		}else
			operador.redZ = 0;

		if(operador.suprSang){
			operador.suprSang = 1;
		}else
			operador.suprSang = 0;

		$scope.operadores.push(angular.copy(operador));
		delete($scope.operador);
	}
	
	$scope.deletaOperador =function(index){
		var indexOfOperador = $scope.operadores.indexOf(index);

		$scope.operadores.splice(indexOfOperador, 1);
	};
	
	
	
/*-----------------------------------------------------------------------------------------------------------------------------------------------------------*/
	$scope.formDadosEmp = true;
	$scope.formDadosComp = true;
	$scope.formEquip = true;
	$scope.formOutrasInfo = true;
	$scope.formSistema = true;
	$scope.formProc = true;
	
	$scope.toggleDadosEmp= function(){
		$scope.formDadosEmp = $scope.formDadosEmp === false ? true: false;
	}
		
	$scope.toggleDadosComp= function(){
		$scope.formDadosComp = $scope.formDadosComp === false ? true: false;
	}
		
	$scope.toggleEquip= function(){
		$scope.formEquip = $scope.formEquip === false ? true: false;
	}
		
	$scope.toggleOutrasInfo= function(){
		$scope.formOutrasInfo = $scope.formOutrasInfo === false ? true: false;
	}
		
	$scope.toggleSistema= function(){
		$scope.formSistema = $scope.formSistema === false ? true: false;
	}
		
	$scope.toggleProc= function(){
		$scope.formProc = $scope.formProc === false ? true: false;
	}

/*-----------------------------------------------------------------------------------------------------------------------------------------------------------*/
	
	$scope.validarCNPJ = function(cnpj){
		
		//console.log(cnpj);
		$scope.cnpj = false;
		cnpj = cnpj.replace(/[^\d]+/g,'');
		
		if(cnpj.length != 14){
			 $scope.erro="Tamanho CNPJ invalido";
			 $scope.cssClassCnpj = 'has-error has-feedback';
			 $scope.cnpj = false;
			 return;
			 //break;
		}
		
		if(cnpj == "00000000000000" || 
           cnpj == "11111111111111" || 
		   cnpj == "22222222222222" || 
		   cnpj == "33333333333333" || 
		   cnpj == "44444444444444" || 
		   cnpj == "55555555555555" || 
		   cnpj == "66666666666666" || 
		   cnpj == "77777777777777" || 
		   cnpj == "88888888888888" || 
		   cnpj == "99999999999999"){
			$scope.erro="Numero CNPJ invalido";
			$scope.cssClassCnpj = 'has-error has-feedback';
			$scope.cnpj = false;
			return;
			//break;
		}
		   
		tamanho = cnpj.length - 2
		numeros = cnpj.substring(0,tamanho);
		digitos = cnpj.substring(tamanho);
		soma = 0;
		pos = tamanho - 7;
		for (i = tamanho; i >= 1; i--) {
			soma += numeros.charAt(tamanho - i) * pos--;
			if (pos < 2)
				pos = 9;
		}
		resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
		if (resultado != digitos.charAt(0)){
			$scope.erro="CNPJ invalido";
			$scope.cssClassCnpj = 'has-error has-feedback';
			$scope.cnpj = false;
			return;
		}
		  
		tamanho = tamanho + 1;
		numeros = cnpj.substring(0,tamanho);
		soma = 0;
		pos = tamanho - 7;
		for (i = tamanho; i >= 1; i--) {
			soma += numeros.charAt(tamanho - i) * pos--;
			if (pos < 2)
				pos = 9;
		}
		  
		resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
		if (resultado != digitos.charAt(1)){
			$scope.erro="Dígito verificador invalido";
			$scope.cssClassCnpj = 'has-error has-feedback';
			$scope.cnpj = false;
			return;
		}			
		$scope.cssClassCnpj = 'has-success has-feedback';
		$scope.erro="";
		$scope.cnpj = true;
		return;
		
	};
	
	$scope.validaCPFVendedor= function(cpf){
		cpf = cpf.replace(/[^\d]+/g,'');
		
		if(cpf.length != 11 || 
           cpf == "00000000000" || 
           cpf == "11111111111" || 
           cpf == "22222222222" || 
           cpf == "33333333333" || 
           cpf == "44444444444" || 
           cpf == "55555555555" || 
           cpf == "66666666666" || 
           cpf == "77777777777" || 
           cpf == "88888888888" || 
           cpf == "99999999999"){
			$scope.erroCpfVendedor="Tamanho CPF invalido"
			$scope.cssClassCpfVendedor='has-error has-feedback';
			return;
		}
		
		soma = 0;
		
		for(i = 0; i<9; i++){
			soma += cpf.charAt(i) * (10 -i);
		}
			rev  = 11-(soma % 11);
			if(rev == 10 || rev == 11){
				rev = 0;
			}
			
			if(rev != cpf.charAt(9)){
				$scope.erroCpfVendedor="Digito 1 Invalido"
				$scope.cssClassCpfVendedor='has-error has-feedback';
				return;
			}else{
				soma =0 
				for(i = 0; i<10; i++){
					soma += cpf.charAt(i) * (11 -i);
				}
				 
				rev = 11 - (soma % 11);  
				if (rev == 10 || rev == 11) 
					rev = 0;    
				if (rev != cpf.charAt(10)){
					$scope.erroCpfVendedor="Digito 2 Invalido"
					$scope.cssClassCpfVendedor='has-error has-feedback';
					return;
				}
				
			}
				 
		$scope.erroCpfVendedor=""
		$scope.cssClassCpfVendedor='has-success has-feedback';
		return;
	};
	
	$scope.validaCPFOperador= function(cpf){
		cpf = cpf.replace(/[^\d]+/g,'');
		
		if(cpf.length != 11 || 
           cpf == "00000000000" || 
           cpf == "11111111111" || 
           cpf == "22222222222" || 
           cpf == "33333333333" || 
           cpf == "44444444444" || 
           cpf == "55555555555" || 
           cpf == "66666666666" || 
           cpf == "77777777777" || 
           cpf == "88888888888" || 
           cpf == "99999999999"){
			$scope.erroCpfOperador="Tamanho CPF invalido"
			$scope.cssClassCpfOperador='has-error has-feedback';
			return;
		}
		
		soma = 0;
		
		for(i = 0; i<9; i++){
			soma += cpf.charAt(i) * (10 -i);
		}
			rev  = 11-(soma % 11);
			if(rev == 10 || rev == 11){
				rev = 0;
			}
			
			if(rev != cpf.charAt(9)){
				$scope.erroCpfOperador="Digito 1 Invalido"
				$scope.cssClassCpfOperador='has-error has-feedback';
				return;
			}else{
				soma =0 
				for(i = 0; i<10; i++){
					soma += cpf.charAt(i) * (11 -i);
				}
				 
				rev = 11 - (soma % 11);  
				if (rev == 10 || rev == 11) 
					rev = 0;    
				if (rev != cpf.charAt(10)){
					$scope.erroCpfOperador="Digito 2 Invalido"
					$scope.cssClassCpfOperador='has-error has-feedback';
					return;
				}
				
			}
				 
		$scope.erroCpfOperador=""
		$scope.cssClassCpfOperador='has-success has-feedback';
		return;
	};	
});

app.controller('userControler', function($scope, $window, $http, $document, $location, $rootScope){
	console.log("teste");

	$scope.autorizado = false;
	$scope.validarUser = function(){
	//console.log($scope.usuario);
		post ={
			"name"     : $scope.usuario.name,
			"password" : $scope.usuario.password
		}
		
		$scope.json= angular.toJson(post);
		
		//console.log(post);
		//console.log($scope.json);

		//aux='';
		
		$http({
            method  : 'POST',
            url     : 'server/validarUser.php',
            data    : post,
            headers :{'Content-Type': 'application/json'},
			
        }).then(function(response,data){
			$scope.login = (response.data);
			//console.log(response.data);
			//aux = response.data;
			if (response.data.name && response.data.password){
				$rootScope.user = response.data;
				
				$rootScope.autorizado = true;
				$location.path('listCliente');
				return;
			}else{
				console.log(response.data);
				$window.alert(response.data);
			}
		});
		/*if(aux){
			$window.alert(response.data);
			return;
		}*/
	};

	$scope.logout=function(){
		$rootScope.autorizado = false;
		$location.path('listCliente');
	}
});

app.controller('printController', function($scope, $window, $http, $document, $location){
	$scope.printCliente = function(cnpj){
		
		console.log(cnpj);	
		$http({
			method  : 'POST',
			url     : 'server/imprimirCliente.php',
        	responseType : 'arraybuffer',
			headers : {accept: 'applicarion/pdf', 'cnpj': cnpj}
		}).then(function(response,data){
		
			//console.log(response.data);
			var file = new Blob([response.data], {type: 'application/pdf;charset=utf-8'});
        	var fileURL = URL.createObjectURL(file);
        	//console.log(file);
        	window.open(fileURL);
        	
		});
	};

});

					
<?php
require_once 'C:\xampp\htdocs\chkList_old\config.php';
//require_once PATH_INCLUDES . '/session.php';
?>
<!--
	<p ng-change="validarUser()" />
-->
<h1>teste</h1>
<div ng-controller = "userControler">
{{usuario}}
</div>

<div class="view">
	<div class="container">
	<h1>Listar</h1>
	<div class="well">
		<label>Search for:<input type="text" class="form-control" ng-model="criteria"></label>
	</div>

		<table class="table table-bordered table-striped">
			<thead>
				<th>CNPJ</th>
				<th>Empresa</th>
				<th>Responsavel</th>
				<th>Telefone</th>
				<th>E-mail</th>
				<th></th>
			</thead>
			<tr ng-repeat="cliente in clientes | filter: criteria">
				<td>{{cliente.cnpj}}</td>
				<td>{{cliente.empresa}}</td>
				<td>{{cliente.respSistema}}</td>
				<td>{{cliente.telefone}}</td>
				<td>{{cliente.email}}</td>
				<!--<td><a href="editarCliente.html" ng-click="getCliente(cliente.cnpj)"><div class="alert alert-info"><div class="text-center"> Alterar</div></div></a></td>-->
				<td><a href="#/editarCliente/{{cliente.cnpj}}" ><div class="alert alert-info"><div class="text-center"> <span class="glyphicon glyphicon-edit"></span> Alterar</div></div></a></td>
				<!--
				<a href="#/editarCliente/{{cliente.cnpj}}" ><div class="alert alert-primary"><div class="text-center"> <span class="glyphicon glyphicon-print"></span></div></div></a>
				-->
				<td ng-controller="printController">
				<button type="submit" ng-click= "printCliente(cliente.cnpj)"  class="btn btn-primary">
				<span class="glyphicon glyphicon-print"></button>
				</td>

			</tr>
		</table>


	</div>
</div>

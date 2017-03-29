
<div class="view" ng-controller="userControler">
	<form class="form-horizontal" name="user">
		<div class="control-group">
			<label class="control-label" for="inputEmail">E-mail</label>
			<div class="controls">
				<input ng-model="usuario.name" id="inputEmail" type="text" placeholder="Digite o seu e-mail..." />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputPassword">Senha</label>
			<div class="controls">
				<input id="inputPassword" type="password" ng-model="usuario.password" placeholder="Digite a sua senha..." />
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
			<label class="checkbox"><input type="checkbox" /> Lembrar senha</label>
				<!--<a href ="#/listCliente">-->
				<button class="btn" type="submit" ng-click="validarUser()" >Acessar</button>
				<!--</a>-->
			</div>
		</div>
	</form>
</div>


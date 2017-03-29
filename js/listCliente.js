'use strict';

app.controller('listCliente', function($scope, $window, $http, $document){
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
});
var app = angular.module("myApp", ['ngRoute']);
app.config(function($routeProvider){
	$routeProvider
	.when('/',{
		templateUrl: 'Vista/inicio.html'
	})
	.otherwise({
		redirectTo: '/'
	});
});
app.controller("inicioController", function($scope, $http){
	$scope.insertar = function(){
		if($scope.f_inicio=='' || $scope.f_inicio==null)
		{
			alert("SELECIONE UNA FECHA DE INICIO");
		}
		else if($scope.f_fin=='' || $scope.f_fin==null)
		{
			alert("SELECCIONE UNA FECHA DE FIN");
		}
		$scope.ff_inicio=($scope.f_inicio.toISOString().split("T")[0]);
		$scope.ff_fin=($scope.f_fin.toISOString().split("T")[0]);
		$http.post("Modelo/Consulta.php", {'f_inicio':$scope.ff_inicio, 'f_fin':$scope.ff_fin})
		.success(function(data){
			$scope.consulta = data;
			console.log($scope.result);
		});
	}
	$scope.mostrar = function(){
		$http.get("Modelo/Contratos.php")
		.success(function(data){
			$scope.contratos = data;
		});
	}
	$scope.cancelar = function(){
		$scope.f_inicio=null;
		$scope.f_fin=null;
	};
}
);
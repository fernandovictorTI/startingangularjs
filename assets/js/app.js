app = angular.module('app', ['ngRoute'])

app.factory("services", ['$http', function($http){
	return{
		teste:function(data,scope){
			var $promise=$http.post('service/business/businteressado.php',data); //send data to user.php
			$promise.then(function(msg){
											   
			});
		}
	}
	
}]);

app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
	        when('/', {
	            templateUrl: 'app/home/home.html',
	            controller: 'homeController'
	        }).
	        when('/interessado/cadastrar', {
	            templateUrl: 'app/interessado/cadastrarinteressado.html',
	            controller: 'cadastrarController'
	        }).
	        when('/interessado/editar/:id', {
	            templateUrl: 'app/interessado/cadastrarinteressado.html',
	            controller: 'editarController'
	        }).
	        when('/interessado/listar', {
	            templateUrl: 'app/interessado/listarInteressado.html',
	            controller: 'listarController'
	        }).
	        otherwise({
	            redirectTo: '/'
	        });
    }
]);

app.run(function ($rootScope) {
});

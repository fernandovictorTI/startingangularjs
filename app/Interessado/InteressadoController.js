app.controller('cadastrarController', ['$scope', '$location', '$routeParams', '$http',

    function cadastrarController($scope, $location, $routeParams, $http) {
        $scope.title = "Cadastrar Interessado";
        $scope.acao = "Cadastrar";        
        $scope.modo = 'salvar';
        $scope.interessado = [];

        $scope.salvar = function(){  

            var request = $http({
                method: "POST",
                url: "service/business/businteressado.php",
                data: {
                    nome : $scope.interessado.nome,
                    cpf : $scope.interessado.cpf,
                    contato : $scope.interessado.contato,
                    endereco : $scope.interessado.endereco,
                    modo : $scope.modo
                },
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            });

            $location.path("/interessado/listar");
        }
    }
    
]);

app.controller('editarController', ['$scope', '$location', '$routeParams', '$http',

    function editarController($scope, $location, $routeParams, $http) {
        $scope.title = "Editar Interessado";
        $scope.acao = "Editar";
        $scope.modo = 'editar';
        $scope.interessado = [];
        $scope.interessado.id = $routeParams.id;

        if($scope.interessado.id > 0){

            var request = $http.get("service/business/businteressado.php?modo=findId&id="+$scope.interessado.id).
            success(function(data){
                if(data.interessado){
                    var usuarioInte = angular.fromJson(data.interessado);

                    $scope.interessado.id = usuarioInte[0].id;
                    $scope.interessado.nome = usuarioInte[0].nome;
                    $scope.interessado.cpf = usuarioInte[0].cpf;
                    $scope.interessado.contato = usuarioInte[0].contato;
                    $scope.interessado.endereco = usuarioInte[0].endereco;
                }
            })

        }

        $scope.salvar = function(){

        	var request = $http({
                method: "POST",
                url: "service/business/businteressado.php",
                data: {
                    id : $scope.interessado.id,
                    nome : $scope.interessado.nome,
                    cpf : $scope.interessado.cpf,
                    contato : $scope.interessado.contato,
                    endereco : $scope.interessado.endereco,
                    modo : $scope.modo
                },
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            });

            $scope.interessado.nome = $scope.modo;

            var request = $http.get("service/business/businteressado.php?modo=listar").
            success(function(data){
                if(data.interessado){
                    $scope.users = data.interessado; 
                }
            })

            $location.path("/interessado/listar");
        }
    }
    
]);

app.controller('listarController', ['$scope', '$location', '$routeParams', '$http',

    function listarController($scope, $location, $routeParams, $http){
        $scope.title = "Lista de Interessado";
        $scope.teste = "";
        $scope.users = [];

        var request = $http.get("service/business/businteressado.php?modo=listar").
            success(function(data){
                if(data.interessado){
                    $scope.users = data.interessado; 
                }
        })

        $scope.excluir = function(idInteressado){

            $scope.modo = 'excluir';

            var request = $http({
                method: "POST",
                url: "service/business/businteressado.php",
                data: {
                    id : idInteressado,
                    modo : $scope.modo
                },
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            });

            var request2 = $http.get("service/business/businteressado.php?modo=listar").
            success(function(data){
                if(data.interessado){
                    $scope.users = data.interessado; 
                }
            })
        }

        $scope.editar = function(idInteressado){
            $location.path("/interessado/editar/"+idInteressado);
        }

    }

]);

app.controller('homeController', ['$scope' ,'$http',

    function homeController($scope, $http){
        $scope.title = "Lista de Interessado";
    }

]);
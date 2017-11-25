app.controller("cadastroController", function($scope, $http, $cookieStore, AutenticacaoService, $compile, $state){
        $('.button-collapse').sideNav('hide');
        $scope.dados = {};

        $scope.usuario = $cookieStore.get('cacheUsuarioY');

        if($scope.usuario != null){
            $state.go('principal');
        }

           
        AutenticacaoService.colocarMenu('outside').then(function (response) {          
            $compile($("#menu").html(response).contents())($scope);           
        });

        //if(typeof $cookieStore.get('token') === 'undefined'){
            //Materialize.toast("Ta vazio", 4000);
        //}
        $scope.limparDados = function(){
            $scope.dados = {
                'name' : '',
                'nickname' : '',
                'birth' : '',
                'email' : ''
            };
        };
    
        //$scope.limparDados();
    
        $scope.submit = function(){

            if (!$scope.dados.name || !$scope.dados.nickname || !$scope.dados.birth || !$scope.dados.email) {
                Materialize.toast('Todos os campos são de preenchimento obrigatório.', 4000);
            } else {

                Materialize.toast('Estamos processando o seu cadastro.', 4000);

                AutenticacaoService.cadastrar($scope.dados).then(function (response) {
                    //console.log('response->',response.data);
                    if((response.status == 200) && (response.data)){
                        //console.log('response->',response.data);
                        if(response.data.codigo == 'success'){
                            $scope.limparDados();
                        }
                        // if(response.data.codigo == 'error'){
                        //     window.alert(response.data.mensagem);
                        // }
                        Materialize.toast(response.data.mensagem, 4000);
                    }else{
                        Materialize.toast('Desculpe, não foi possível realizar o cadastro neste momento.', 4000);
                    }
                });

            }
        
        };
    
    
    
    /*var req = {
     method: 'POST',
     url: 'http://example.com',
     headers: {
       'Content-Type': undefined
     },
     data: { test: 'test' }
    }
    
    $http(req).then(function(){...}, function(){...});*/
        
        
        /*$http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
    
        $scope.email    = "fsdg@sdf.com";
        $scope.password = "1234";
    
        $scope.login = function()
        {
            data = {
                'email' : $scope.email,
                'password' : $scope.password
            };
    
            $http.post('resources/curl.php', data)
            .success(function(data, status, headers, config)
            {
                console.log(status + ' - ' + data);
            })
            .error(function(data, status, headers, config)
            {
                console.log('error');
            });
        }*/
    }); 
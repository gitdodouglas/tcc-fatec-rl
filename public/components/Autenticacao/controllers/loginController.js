app.controller("loginController", function($scope, $http, md5, $cookieStore, AutenticacaoService, $compile){
        $('.button-collapse').sideNav('hide');
        $scope.dados = {};
        //console.log('oioiiioioo');

        AutenticacaoService.colocarMenu('outside').then(function (response) {          
            $compile($("#menu").html(response).contents())($scope);           
        });

        $scope.limparDados = function(){
            $scope.dados = {
                'email' : '',
                'password' : ''
            };
        };
    
        //$scope.limparDados();
        $scope.dados.email = "admin@admin.com";
        $scope.dados.password = "admin";
    
        $scope.submit = function(){

            if (!$scope.dados.email || !$scope.dados.password) {
                Materialize.toast('Todos os campos são de preenchimento obrigatório.', 4000);
            } else {

                AutenticacaoService.logar($scope.dados).then(function (response) {
                    //console.log('response->',response.data);
                    if((response.status == 200) && (response.data)){
                        //console.log('response->',response.data);
                        // if(response.data.codigo == 'success'){
                        //     $scope.limparDados();
                        //     window.alert(response.data.mensagem);
                        // }
                        // if(response.data.codigo == 'error'){
                        //     window.alert(response.data.mensagem);
                        // }
                        if (response.data.codigo == 'success') {
                            var obj = response.data.objeto;
                            //window.location.assign("/#!app");
                            if(obj.codigo_tipo == 1){
                                $cookieStore.put('token',(obj.info+obj.token));
                                window.location.assign("/#!altera");
                            }
                            if(obj.codigo_tipo == 0){
                                $cookieStore.put('token',(obj.info+obj.token));
                                window.location.assign("/#!principal");
                            }

                        }
                        Materialize.toast(response.data.mensagem, 4000);
                    }else{
                        Materialize.toast('Desculpe, não foi possível realizar o login neste momento.', 4000);
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
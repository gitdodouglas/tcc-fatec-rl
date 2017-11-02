app.controller("cadastroController", function($scope,$http, AutenticacaoService){	
        
    //$scope.dados = {};

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
            
            
            AutenticacaoService.cadastrar($scope.dados).then(function (response) {	
                console.log('response->',response.data);
                if((response.status == 200) && (response.data)){
                    //console.log('response->',response.data);
                    // if(response.data.codigo == 'success'){	
                    //     $scope.limparDados();
                    //     window.alert(response.data.mensagem);					
                    // }
                    // if(response.data.codigo == 'error'){					
                    //     window.alert(response.data.mensagem);
                    // }	
                    Materialize.toast(response.data.mensagem, 4000);				
                }else{
                    Materialize.toast('Desculpe, não foi possível realizar o seu cadastro neste momento.', 4000);
                }
            });
        
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
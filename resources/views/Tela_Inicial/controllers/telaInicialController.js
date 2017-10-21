app.controller("telaInicialController", function($scope,$http, SoulTeamService){	
    
        $scope.limparDados = function(){
            $scope.dados = {
                'nome' : '',
                'email' : '',
                'mensagem' : ''
            };
        };
    
        $scope.limparDados();
    
        $scope.submit = function(){
            $scope.result = SoulTeamService.enviarEmail($scope.dados).then(function (response) {			
                if((response.status == 200) && (response.data)){
                    if(response.data.codigo == 'success'){	
                        $scope.limparDados();				
                        window.alert(response.data.mensagem);					
                    }
                    if(response.data.codigo == 'error'){					
                        window.alert(response.data.mensagem);
                    }					
                }else{
                    window.alert('Desculpe, não conseguimos enviar o seu contato neste momento. Lembrando que pode entrar em contato conosco por telefone ou enviando um email diretamente');
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
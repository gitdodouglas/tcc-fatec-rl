app.controller("trocarSenhaController", function($scope, $http, md5, $cookieStore, AutenticacaoService){
        
        $scope.dados = {};
        $scope.dados = {
            'antigaSenha' : '',
            'novaSenha' : '',
            'confNovaSenha' : ''
        };
        
        //fundo branco f6f6f6, menu #7f93fb
        $scope.limparDados = function(){
            $scope.dados = {
                'antigaSenha' : '',
                'novaSenha' : '',
                'confNovaSenha' : ''
            };
        };
    
        //$scope.limparDados();
        //$scope.dados.email = "admin@admin.com";
       // $scope.dados.password = "admin";
    
        $scope.submit = function(){
            
            token = $cookieStore.get('token');
            
            AutenticacaoService.trocarSenha($scope.dados,token).then(function (response) {	
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
                    if (response.data.codigo == 'success') {
                        var obj = response.data.objeto;
                        //window.location.assign("/#!app");
                        // if(obj.codigo_tipo == 1){
                        //     $cookieStore.put('token',(response.data.token+obj.info));
                        // }
                    }
                    Materialize.toast(response.data.mensagem, 4000);				
                }else{
                    Materialize.toast('Desculpe, não foi possível realizar a troca de senha neste momento.', 4000);
                }
            });
        
        };   
    }); 
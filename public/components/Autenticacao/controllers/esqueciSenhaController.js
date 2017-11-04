app.controller("esqueciSenhaController", function($scope, $http, md5, $cookieStore, AutenticacaoService){
        
        $scope.dados = {};
        $scope.dados = {
            'email' : '',
        };
        
        //fundo branco f6f6f6, menu #7f93fb
        $scope.limparDados = function(){
            $scope.dados = {
                'email' : ''
            };
        };
    
        //$scope.limparDados();
        //$scope.dados.email = "admin@admin.com";
       // $scope.dados.password = "admin";
    
        $scope.submit = function(){

            if(typeof $cookieStore.get('token') === 'undefined'){
                Materialize.toast('Tá sem cookie.', 4000);                
            }
            
            token = md5.createHash($cookieStore.get('token'));
            
            AutenticacaoService.esqueciSenha($scope.dados,token).then(function (response) {	
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
                        // $cookieStore.put('token',(obj.info+obj.token));
                        window.location.assign("/app");
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
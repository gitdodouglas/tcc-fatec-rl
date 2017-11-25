app.controller("esqueciSenhaController", function($scope, $http, md5, $cookieStore, AutenticacaoService, $compile, $state){
        $('.button-collapse').sideNav('hide');
        $scope.dados = {};

        $scope.usuario = $cookieStore.get('cacheUsuarioY');

        if($scope.usuario != null){
            $state.go('principal');
        }
        
        AutenticacaoService.colocarMenu('outside').then(function (response) {  
                   
            $compile($("#menu").html(response).contents())($scope);           
        });

        $scope.dados = {
            'email' : ''
        };
        
        //fundo branco f6f6f6, menu #7f93fb
        $scope.limparDados = function(){
            $scope.dados = {
                'email' : ''
            };
        };
    
        //$scope.limparDados();
    
        $scope.submit = function(){
            

            if (!$scope.dados.email) {
                Materialize.toast('Campo de preenchimento obrigatório.', 4000);
            } else {

                Materialize.toast('Estamos processando o seu pedido.', 4000);

                //if(typeof $cookieStore.get('token') === 'undefined'){
                //Materialize.toast('Tá sem cookie.', 4000);
                //}

                //token = md5.createHash($cookieStore.get('token'));

                AutenticacaoService.esqueciSenha($scope.dados).then(function (response) {
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
                            $scope.limparDados();
                            //var obj = response.data.objeto;
                            // $cookieStore.put('token',(obj.info+obj.token));
                            //window.location.assign("/#!app");
                            // if(obj.codigo_tipo == 1){
                            //     $cookieStore.put('token',(response.data.token+obj.info));
                            // }
                        }
                        Materialize.toast(response.data.mensagem, 4000);
                    }else{
                        Materialize.toast('Desculpe, não foi possível realizar a redefinição de senha neste momento.', 4000);
                    }
                });

            }
        
        };   
    }); 
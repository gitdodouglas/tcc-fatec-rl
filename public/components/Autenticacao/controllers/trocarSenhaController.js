app.controller("trocarSenhaController", function($scope, $http, md5, $cookieStore, AutenticacaoService, $compile, $stateParams, $state){
        $('.button-collapse').sideNav('hide');
        $scope.dados = {};

        AutenticacaoService.colocarMenu('outside').then(function (response) {  
              
            $compile($("#menu").html(response).contents())($scope);           
        });
        
        $scope.dados = {
            'old_password' : '',
            'new_password' : '',
            'confirm_password' : ''
        };
        
        //fundo branco f6f6f6, menu #7f93fb
        $scope.limparDados = function(){
            $scope.dados = {
                'old_password' : '',
                'new_password' : '',
                'confirm_password' : ''
            };
        };
    
        //$scope.limparDados();
        //$scope.dados.email = "admin@admin.com";
        //$scope.dados.password = "admin";
    
        $scope.submit = function(){

            if (!$scope.dados.old_password || !$scope.dados.new_password || !$scope.dados.confirm_password) {
                Materialize.toast('Todos os campos são de preenchimento obrigatório.', 4000);
            } else {

                if ($scope.strength == 'fraca') {
                    Materialize.toast('Por favor, digite uma senha segura.', 4000);
                } else {

                    if ($scope.dados.new_password != $scope.dados.confirm_password) {
                        Materialize.toast('A senhas digitadas não correspondem.', 4000);
                    } else {

                        //if(typeof $cookieStore.get('token') === 'undefined'){
                        //Materialize.toast('Tá sem cookie.', 4000);
                        //}

                        token = md5.createHash($cookieStore.get('token'));

                        AutenticacaoService.trocarSenha($scope.dados,token).then(function (response) {
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
                                    $cookieStore.put('cacheUsuarioY',(obj));
                                    $cookieStore.put('token',(obj.info+obj.token));
                                    $state.go('principal');
                                    //window.location.assign("/#!app");
                                    // if(obj.codigo_tipo == 1){
                                    //     $cookieStore.put('token',(response.data.token+obj.info));
                                    // }
                                }
                                Materialize.toast(response.data.mensagem, 4000);
                            }else{
                                Materialize.toast('Desculpe, não foi possível realizar a alteração de senha neste momento.', 4000);
                            }
                        });

                    }

                }

            }
        
        };   
    }); 
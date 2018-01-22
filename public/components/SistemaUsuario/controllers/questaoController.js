app.controller("questaoController", function($scope, $http, $cookieStore, AutenticacaoService, $compile, $stateParams, $state){
        $('.button-collapse').sideNav('hide');


        $scope.dados = {};
        $scope.data = {
            questaoRespondida : ''
        };
        $scope.usuario = $cookieStore.get('cacheUsuarioY');

        if($scope.usuario == null){
            $state.go('login');
        }

           
        AutenticacaoService.colocarMenu('inside').then(function (response) {          
            $compile($("#menu").html(response).contents())($scope);           
        });

        $scope.responderQuestao = function(index){
            var dados = {
                'id' : $scope.usuario.info.id,
                'alternative_id' : $scope.data.questaoRespondida
            };
            AutenticacaoService.responderQuestao(dados).then(function (response) {
                $scope.topicos = {};
                console.log('response->',response);
                if((response.status == 200) && (response.data)){
                    if (response.data.codigo == 'success') {
                        //console.log('response->',response);
                        //$scope.topicos = response.data.objeto.topicos;
                    }
                }else{
                    Materialize.toast('Desculpe, não foi possível continuar. Favor reiniciar a página.', 4000);
                }

            });
        };

        AutenticacaoService.inicializarQuestao({'id' : $scope.usuario.info.id, 'topic_id' : $stateParams.id}).then(function (response) {
            //$scope.questao = {};
            if((response.status == 200) && (response.data)){
                if (response.data.codigo == 'success') {
                    console.log('response->',response);
                    response.data.objeto == null ? $state.reload() : false;
                    $scope.objeto = response.data.objeto;
                    $scope.questao = response.data.objeto.questao;
                }
            }else{
                Materialize.toast('Desculpe, não foi possível acessar as questões. Favor reiniciar a página.', 4000);
            }

        });

       
}); 
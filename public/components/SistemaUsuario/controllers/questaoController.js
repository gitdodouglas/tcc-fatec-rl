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
                'alternative_id' : $scope.questao.alternativas[$scope.data.questaoRespondida].cdAlternativa
            };
            AutenticacaoService.responderQuestao(dados).then(function (response) {
                $scope.topicos = {};
                
                if((response.status == 200) && (response.data)){
                    if (response.data.codigo == 'success') {
                        
                        var resposta = response.data.objeto.resposta;
                        $scope.cdResposta = resposta.cdStatus;
                        if(resposta.cdStatus == 1){
                            $scope.respostaCerta = $scope.questao.alternativas[$scope.data.questaoRespondida].conteudoAlternativa; 
                        }else{
                            $scope.respostaCerta = resposta.respCorreta;
                        }
                        
                        $scope.modalText = resposta.msgDesbloqueio;                        
                        $scope.cdDesbloqueio = resposta.cdDesbloqueio;
                        $scope.proxNivel = resposta.proxNivel;
                        $scope.proxTopico = resposta.proxTopico;
                        
                        $scope.respostaUsuario = $scope.questao.alternativas[$scope.data.questaoRespondida].conteudoAlternativa;
                        
                    }
                }else{
                    Materialize.toast('Desculpe, não foi possível continuar. Favor reiniciar a página.', 4000);
                }
                $scope.questaoRespondida = true; 
                $(".disabledAlternativa").prop("disabled", true);

            });
        };



        $scope.carregarQuestao = function(){
            $scope.respostaUsuario = '';
            $scope.respostaCerta = '';
            $scope.data.questaoRespondida = '';
            $scope.questaoRespondida = false; 
            AutenticacaoService.inicializarQuestao({'id' : $scope.usuario.info.id, 'topic_id' : $stateParams.id}).then(function (response) {
                //$scope.questao = {};
                if((response.status == 200) && (response.data)){
                    if (response.data.codigo == 'success') {
                        
                        response.data.objeto == null ? $state.reload() : false;
                        $scope.objeto = response.data.objeto;
                        $scope.questao = response.data.objeto.questao;
                    }
                }else{
                    Materialize.toast('Desculpe, não foi possível acessar as questões. Favor reiniciar a página.', 4000);
                }

            });
        };

        $scope.abrirModal = function(){
            $('#modal1').modal({
                dismissible: false                
              });
            $('#modal1').modal('open');
        };

        $scope.btnModalContinuar = function(){
            switch($scope.cdDesbloqueio){
                case 1:
                    $state.go('topicos',{id : ($scope.proxNivel-1)}); 
                break;
                case 2:
                    $state.go('topicos',{id : $scope.proxNivel});                    
                break;
                case 3:                    
                    $state.go('topicos',{id : ($scope.proxNivel-1)});                   
                break;
            } 
        };

        $scope.btnContinuar = function(){
            switch($scope.cdDesbloqueio){
                case 0:
                    $scope.carregarQuestao();
                break;
                case 1:
                    $scope.modalTitle = 'Parabéns!';
                    $scope.abrirModal();
                break;
                case 2:
                    $scope.modalTitle = 'Parabéns!';
                    $scope.abrirModal();
                break;
                case 3:
                    $scope.modalTitle = 'Foi por pouco';
                    $scope.abrirModal();                    
                break;
            }
        };
        $scope.carregarQuestao();

       
}); 
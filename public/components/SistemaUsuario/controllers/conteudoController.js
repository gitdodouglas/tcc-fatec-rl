app.controller("conteudoController", function($scope, $http, $cookieStore, AutenticacaoService, $compile, $stateParams, $state){
    $('.button-collapse').sideNav('hide');
    $scope.dados = {};

    $scope.usuario = $cookieStore.get('cacheUsuarioY');

    if($scope.usuario == null){
        $state.go('login');
    }

    $scope.conteudo = {};
    $scope.conteudo.name = $stateParams.name;

    AutenticacaoService.colocarMenu('inside').then(function (response) {
        $compile($("#menu").html(response).contents())($scope);
    });

    AutenticacaoService.inicializarConteudo({'id' : $scope.usuario.info.id, 'topic_id' : $stateParams.id}).then(function (response) {
        if((response.status == 200) && (response.data)){
            if (response.data.codigo == 'success') {

                $scope.conteudo.content = response.data.objeto.conteudo;

            }
        }else{
            Materialize.toast('Desculpe, não foi possível acessar os níveis neste momento. Favor reiniciar a página.', 4000);
        }

    });


});
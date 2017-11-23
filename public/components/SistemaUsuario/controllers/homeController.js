app.controller("homeController", function($scope, $http, $cookieStore, AutenticacaoService, $compile, $stateParams, $state){
    $('.button-collapse').sideNav('hide');

    //$state.go('cadastro');
    //console.log('state->',$stateParams);

    $scope.usuario = $cookieStore.get('cacheUsuarioY');

    if($scope.usuario == null){
        $state.go('login');
    }

    AutenticacaoService.colocarMenu('inside').then(function (response) {

        $compile($("#menu").html(response).contents())($scope);
    });

    $scope.acessarTopico = function(codigo){

        $state.go('topicos',{id : codigo});
    };

    $('.dropdown-button').dropdown({
        belowOrigin: true,
        alignment: 'left',
        inDuration: 500,
        outDuration: 300,
        constrain_width: true,
        hover: false,
        gutter: 1
    });


    AutenticacaoService.principal({'id' : $scope.usuario.info.id}).then(function (response) {
        if((response.status == 200) && (response.data)){
            if (response.data.codigo == 'success') {
                $scope.niveis = {};
                $scope.niveis = response.data.objeto.niveis;
            }
        }else{
            Materialize.toast('Desculpe, não foi possível acessar os níveis neste momento. Favor reiniciar a página.', 4000);
        }

    });

});
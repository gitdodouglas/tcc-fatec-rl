app.controller("indexController", function($scope, $http, AutenticacaoService, $compile){
    $('.button-collapse').sideNav('hide');

    AutenticacaoService.colocarMenu('outside').then(function (response) {

        $compile($("#menu").html(response).contents())($scope);
    });

});
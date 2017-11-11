app.controller("topicosController", function($scope, $http, $cookieStore, AutenticacaoService, $compile){	
        $('.button-collapse').sideNav('hide');
        $scope.dados = {};   

           
        AutenticacaoService.colocarMenu('inside').then(function (response) {          
            $compile($("#menu").html(response).contents())($scope);           
        });

       
}); 
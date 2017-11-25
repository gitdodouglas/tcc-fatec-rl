app.controller("menuController", function($scope, $cookieStore){
    $scope.usuario = $cookieStore.get('cacheUsuarioY');
    $scope.nome = $scope.usuario.info.nickname;
});
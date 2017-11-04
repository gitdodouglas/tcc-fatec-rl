app.config(function($routeProvider) {
    $routeProvider
    .when("/", {
        template : "<h1>Main</h1><p>Click on the links to change this content</p>"
    })
    .when("/principal", {
        templateUrl : "components/Autenticacao/partials/tela-inicial.html"
    })
    .when("/login", {
        templateUrl : "components/Autenticacao/partials/tela-login.html"
    })
    .when("/cadastro", {
        templateUrl : "components/Autenticacao/partials/tela-cadastro.html"
    })
    .when("/trocarSenha", {
        templateUrl : "components/Autenticacao/partials/tela-trocar-senha.html"
    })
    .otherwise({
        template : "<h1>Main</h1><p>Click on the links to change this content</p>"
    });

});


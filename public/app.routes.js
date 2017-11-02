app.config(function($routeProvider) {
    $routeProvider
    .when("/", {
        template : "<h1>Main</h1><p>Click on the links to change this content</p>"
    })
    .when("/banana", {
        template : "<h1>Banana</h1><p>Bananas contain around 75% water.</p>"
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
    .otherwise({
        template : "<h1>Main</h1><p>Click on the links to change this content</p>"
    });

});


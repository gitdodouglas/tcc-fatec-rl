app.config(function($routeProvider) {
    $routeProvider
    .when("/", {
        template : "<h1>Main</h1><p>Click on the links to change this content</p>"
    })
    .when("/principal", {
        templateUrl : "components/SistemaUsuario/partials/tela-home.html"
    })
    .when("/login", {
        templateUrl : "components/Autenticacao/partials/tela-login.html"
    })
    .when("/cadastro", {
        templateUrl : "components/Autenticacao/partials/tela-cadastro.html"
    })
    .when("/altera", {
        templateUrl : "components/Autenticacao/partials/tela-trocar-senha.html"
    })
    .when("/esqueci", {
        templateUrl : "components/Autenticacao/partials/tela-esqueci-senha.html"
    })
    .when("/topicos", {
        templateUrl : "components/SistemaUsuario/partials/tela-topicos.html"
    })
    .when("/conteudo", {
        templateUrl : "components/SistemaUsuario/partials/tela-conteudo.html"
    })
    .when("/questoes", {
        templateUrl : "components/SistemaUsuario/partials/tela-questao.html"
    })
    .otherwise({
        template : "<h1>404</h1><p>Page not found.</p>"
    });

});


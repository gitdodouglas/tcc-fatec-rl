app.config(function($stateProvider, $urlRouterProvider) {



    $stateProvider

    // HOME STATES AND NESTED VIEWS ========================================
        .state('home', {
            url: '/home',
            templateUrl : "components/Index/partials/index.html"
        })
        .state("principal", {
            url: '/principal',
            templateUrl : "components/SistemaUsuario/partials/tela-home.html"
        })
        .state("login", {
            url: '/login',
            templateUrl : "components/Autenticacao/partials/tela-login.html"
        })
        .state("cadastro", {
            url: '/cadastro',
            templateUrl : "components/Autenticacao/partials/tela-cadastro.html"
        })
        .state("altera", {
            url: '/altera',
            templateUrl : "components/Autenticacao/partials/tela-trocar-senha.html"
        })
        .state("esqueci", {
            url: '/esqueci',
            templateUrl : "components/Autenticacao/partials/tela-esqueci-senha.html"
        })
        .state("topicos", {
            url: '/topicos?id',
            templateUrl : "components/SistemaUsuario/partials/tela-topicos.html"
        })
        .state("conteudo", {
            url: '/conteudo?id&name',
            templateUrl : "components/SistemaUsuario/partials/tela-conteudo.html"
        })
        .state("questoes", {
            url: '/questoes?id',
            templateUrl : "components/SistemaUsuario/partials/tela-questao.html"
        });
    $urlRouterProvider.otherwise('/home');

    // ABOUT PAGE AND MULTIPLE NAMED VIEWS =================================

});

// app.config(function($routeProvider) {
//     $routeProvider
//     .when("/", {
//         template : "<h1>Main</h1><p>Click on the links to change this content</p>"
//     })
//     .when("/principal", {
//         templateUrl : "components/SistemaUsuario/partials/tela-home.html"
//     })
//     .when("/login", {
//         templateUrl : "components/Autenticacao/partials/tela-login.html"
//     })
//     .when("/cadastro", {
//         templateUrl : "components/Autenticacao/partials/tela-cadastro.html"
//     })
//     .when("/altera", {
//         templateUrl : "components/Autenticacao/partials/tela-trocar-senha.html"
//     })
//     .when("/esqueci", {
//         templateUrl : "components/Autenticacao/partials/tela-esqueci-senha.html"
//     })
//     .when("/topicos", {
//         templateUrl : "components/SistemaUsuario/partials/tela-topicos.html"
//     })
//     .when("/conteudo", {
//         templateUrl : "components/SistemaUsuario/partials/tela-conteudo.html"
//     })
//     .when("/questoes", {
//         templateUrl : "components/SistemaUsuario/partials/tela-questao.html"
//     })
//     .otherwise({
//         template : "<h1>404</h1><p>Page not found.</p>"
//     });

// });

// // app.config(function($stateProvider) {
// //     var helloState = {
// //       name: 'hello',
// //       url: '/hello',
// //       template: '<h3>hello world!</h3>'
// //     }

// //     var aboutState = {
// //       name: 'about',
// //       url: '/about',
// //       template: '<h3>Its the UI-Router hello world app!</h3>'
// //     }

// //     $stateProvider.state(helloState);
// //     $stateProvider.state(aboutState);
// //   });
// var routerApp = angular.module('routerApp', ['ui.router']);

// routerApp.config(function($stateProvider, $urlRouterProvider) {

//     $urlRouterProvider.otherwise('/home');

//     $stateProvider

//         // HOME STATES AND NESTED VIEWS ========================================
//         .state('home', {
//             url: '/home',
//             templateUrl: 'components/Autenticacao/partials/tela-login.html'
//         })

//         // ABOUT PAGE AND MULTIPLE NAMED VIEWS =================================
//         .state('about', {
//             // we'll get to this in a bit       
//         });

// });

app.service('AutenticacaoService',
    function($http, $templateRequest, $sce){
        this.logar = function(dados){
            return  $http({
                method : 'POST',
                url : 'login',
                headers : {
                    'Content-Type' : 'application/x-www-form-urlencoded'
                },
                data : dados
            });
        };

        this.principal = function(dados){

            return  $http({
                method : 'POST',
                url : 'principal',
                headers : {
                    'Content-Type' : 'application/x-www-form-urlencoded'
                },
                data : dados
            });
        };

        this.inicializarTopico = function(dados){

            return  $http({
                method : 'POST',
                url : 'topicos',
                headers : {
                    'Content-Type' : 'application/x-www-form-urlencoded'
                },
                data : dados
            });
        };

        this.inicializarConteudo = function(dados){
            //console.log('dados21->',dados);
            return  $http({
                method : 'POST',
                url : 'conteudo',
                headers : {
                    'Content-Type' : 'application/x-www-form-urlencoded'
                },
                data : dados
            });
        };

        this.cadastrar = function(dados){
            return  $http({
                method : 'POST',
                url : 'cadastro',
                headers : {
                    'Content-Type' : 'application/x-www-form-urlencoded'
                },
                data : dados
            });
        };

        this.trocarSenha = function(dados,token){
            //console.log('request->', dados);
            dados.token = token;
            return  $http({
                method : 'POST',
                url : 'altera',
                headers : {
                    'Content-Type' : 'application/x-www-form-urlencoded'
                },
                data : dados
            });
        };

        this.colocarMenu = function(opcao){
            var templateUrl = '';
            if(opcao == 'outside'){
                templateUrl = $sce.getTrustedResourceUrl('components/Menus/partials/outside-menu.html');

            }else{
                templateUrl = $sce.getTrustedResourceUrl('components/Menus/partials/inside-menu.html');
            }

            return $templateRequest(templateUrl);
        };



        this.esqueciSenha = function(dados){
            return  $http({
                method : 'POST',
                url : 'esqueci',
                headers : {
                    'Content-Type' : 'application/x-www-form-urlencoded'
                },
                data : dados
            });
        };

        this.responderQuestao = function(dados){
            
            return  $http({
                method : 'POST',
                url : 'corrige',
                headers : {
                    'Content-Type' : 'application/x-www-form-urlencoded'
                },
                data : dados
            });
        };

        this.inicializarQuestao = function(dados){
            
            return  $http({
                method : 'POST',
                url : 'questoes',
                headers : {
                    'Content-Type' : 'application/x-www-form-urlencoded'
                },
                data : dados
            });
        };

    }
);
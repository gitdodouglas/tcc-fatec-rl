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

    }
);
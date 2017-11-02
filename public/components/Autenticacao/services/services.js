app.service('AutenticacaoService', 
    function($http){
        this.logar = function(dados){
            console.log(dados);
            return  $http({
                method : "POST",
                url : "login",
                headers : {
                    'Content-Type' : 'application/x-www-form-urlencoded'
                },
                data : dados
            });
        };

        this.cadastrar = function(dados){
            console.log(dados);
            return  $http({
                method : "POST",
                url : "cadastro",
                headers : {
                    'Content-Type' : 'application/x-www-form-urlencoded'
                },
                data : dados
            });
        };

    }
);


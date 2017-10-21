app.service('AutenticacaoService', 
    function($http){
        this.logar = function(dados){
            console.log('ok->',dados);
            return  $http({
                        method : "POST",
                        url : "cadastro",
                        headers : {
                            'Content-Type' : 'application/x-www-form-urlencoded'
                        },
                        data : $.param(dados)
                    });
        }

    }
);


app.service('SoulTeamService', 
    function($http){
        this.enviarEmail = function(dadosOk){
            
            return  $http({
                        method : "POST",
                        url : "Modulos/Principal/Principal.php/login",
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8'
                        },
                        data: { dados: dadosOk }
                        
                    });
        }

    }
);
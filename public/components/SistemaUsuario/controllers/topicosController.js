app.controller("topicosController", function($scope, $http, $cookieStore, AutenticacaoService, $compile, $stateParams, $state){	
    $('.button-collapse').sideNav('hide');

    $scope.dados = {};  
    $scope.usuario = $cookieStore.get('cacheUsuarioY');

    $scope.dadosTopicos = {
        1 : {
            'title' : 'Moleza',
            'style' : {
                'fundo' : {
                    'background' : '#4db6ac'
                },
                'borda' : {
                    'border-top' : '1px dashed #4db6ac'
                }
            }
        },
        2 : {
            'title' : 'Quase lá',
            'style' : {
                'fundo' : {
                    'background' : '#ba68c8'
                },
                'borda' : {
                    'border-top' : '1px dashed #ba68c8'
                }
            }
        },
        3 : {
            'title' : 'Sabe tudo',
            'style' : {
                'fundo' : {
                    'background' : '#81C784'
                },
                'borda' : {
                    'border-top' : '1px dashed #81C784'
                }
            }
        }
    };

    $scope.topicoAtual = $scope.dadosTopicos[$stateParams.id];   

    AutenticacaoService.colocarMenu('inside').then(function (response) {          
        $compile($("#menu").html(response).contents())($scope);           
    });

    AutenticacaoService.inicializarTopico({'id' : $scope.usuario.info.id, 'level_id' : $stateParams.id}).then(function (response) {
        $scope.topicos = {};
        if((response.status == 200) && (response.data)){          
            if (response.data.codigo == 'success') {
                console.log('response->',response);
                $scope.topicos = response.data.objeto.topicos;
            }
        }else{
            Materialize.toast('Desculpe, não foi possível acessar os níveis neste momento. Favor reiniciar a página.', 4000);
        }
        
    });

       
}); 
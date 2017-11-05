app.directive('passwordStrength', function(){
    return {
        restrict: 'A',
        link: function(scope, element, attrs){
            scope.$watch(attrs.passwordStrength, function(value) {
                if(angular.isDefined(value)){
                    var high = /(^(?=.*[a-z].*[a-z])(?=.*[A-Z].*[A-Z])(?=.*[0-9].*[0-9])(?=.*[!@#$%&*_].*[!@#$%&*_]).{12,}$)/;
                    var medium = /(^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%&*_]).{8,}$)/;
                    if (high.test(value)) {
                        scope.strength = 'forte';
                        scope.color = 'green-text text-darken-4';
                    } else if (medium.test(value )) {
                        scope.strength = 'suficiente';
                        scope.color = 'orange-text text-darken-4';
                    } else {
                        scope.strength = 'fraca';
                        scope.color = 'red-text text-darken-4';
                    }
                }
            });
        }
    };
});
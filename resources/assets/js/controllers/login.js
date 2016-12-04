angular.module('app.controllers')
    .controller('loginController',
        ['$scope', '$location', 'OAuth',
            function ($scope, $location, OAuth) {
                $scope.user = {
                    username: '',
                    password: ''
                };

                $scope.login = function () {
                    if ($scope.form.$valid) {
                        OAuth.getAccessToken($scope.user).then(function () {
                            $location.url('home');
                        }, function () {
                            alert('Acesso negado');
                        });
                    }
                };
            }]);
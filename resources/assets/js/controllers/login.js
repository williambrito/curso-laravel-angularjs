angular.module('app.controllers')
    .controller('loginController',
        ['$scope', '$location', 'OAuth',
            function ($scope, $location, OAuth) {
                $scope.user = {
                    username: '',
                    password: ''
                };

                $scope.error = {
                    erro: false,
                    message: ''
                };

                $scope.login = function () {
                    if ($scope.form.$valid) {
                        OAuth.getAccessToken($scope.user).then(function () {
                            $location.path('home');
                        }, function (data) {
                            $scope.error.erro = true;
                            $scope.error.message = data.data.error_description;
                        });
                    }
                };
            }]);
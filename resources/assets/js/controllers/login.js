angular.module('app.controllers')
    .controller('loginController', [
        '$scope',
        '$location',
        'OAuth',
        '$cookies',
        'userService',
        function ($scope,
                  $location,
                  OAuth,
                  $cookies,
                  userService) {

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
                        userService.authenticated({}, {}, function (data) {
                            $cookies.putObject('user', data);
                            $location.path('home');
                        }, function () {

                        });
                    }, function (data) {
                        $scope.error.erro = true;
                        $scope.error.message = data.data.error_description;
                    });
                }
            };
        }]);
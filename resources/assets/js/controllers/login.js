angular.module('app.controllers')
    .controller('loginController', [
        '$rootScope',
        '$scope',
        '$location',
        'OAuth',
        'OAuthToken',
        '$cookies',
        'userService',
        function ($rootScope,
                  $scope,
                  $location,
                  OAuth,
                  OAuthToken,
                  $cookies,
                  userService) {

            $rootScope.isRefreshToken = false;
            OAuthToken.removeToken();

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
                            $location.path('/home');
                        }, function () {
                            $location.path('/logout');
                        });
                    }, function (data) {
                        $scope.error.erro = true;
                        $scope.error.message = data.data.error_description;
                    });
                }
            };
        }]);
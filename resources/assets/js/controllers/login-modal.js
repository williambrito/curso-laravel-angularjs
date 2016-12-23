angular.module('app.controllers')
    .controller('loginModalController', [
        '$scope',
        '$location',
        'OAuth',
        '$cookies',
        'userService',
        'authService',
        '$modalInstance',
        function ($scope,
                  $location,
                  OAuth,
                  $cookies,
                  userService,
                  authService,
                  $modalInstance) {

            $scope.user = {
                username: '',
                password: ''
            };

            $scope.error = {
                erro: false,
                message: ''
            };

            $scope.on('event:auth-loginConfirmed', function () {
                $modalInstance.close();
            });

            $scope.on('$routeChangeStart', function () {
                $modalInstance.dismiss('cancel');
            });

            $scope.login = function () {
                if ($scope.form.$valid) {
                    OAuth.getAccessToken($scope.user).then(function () {
                        userService.authenticated({}, {}, function (data) {
                            $cookies.putObject('user', data);
                            authService.loginConfirmed();
                        });
                    }, function (data) {
                        $scope.error.erro = true;
                        $scope.error.message = data.data.error_description;
                    });
                }
            };

            $scope.cancel = function () {
                authService.loginCancelled();
                $location.path('/login');
            };
        }]);
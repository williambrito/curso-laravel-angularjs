angular.module('app.controllers')
    .controller('loginModalController', [
        '$rootScope',
        '$scope',
        '$location',
        'OAuth',
        '$cookies',
        'userService',
        'authService',
        '$uibModalInstance',
        function ($rootScope,
                  $scope,
                  $location,
                  OAuth,
                  $cookies,
                  userService,
                  authService,
                  $uibModalInstance) {

            $scope.user = {
                username: '',
                password: ''
            };

            $scope.error = {
                erro: false,
                message: ''
            };

            $scope.$on('event:auth-loginConfirmed', function () {
                $uibModalInstance.close();
                $rootScope.isRefreshToken = false;
                $rootScope.loginModalOpened = false;
            });

            $scope.$on('$routeChangeStart', function () {
                $uibModalInstance.dismiss('cancel');
                $rootScope.isRefreshToken = false;
                $rootScope.loginModalOpened = false;
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
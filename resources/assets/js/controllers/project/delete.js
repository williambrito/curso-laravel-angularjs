angular.module('app.controllers')
    .controller('clientDeleteController', ['$scope', 'clientService', '$location', '$routeParams',
        function ($scope, clientService, $location, $routeParams) {
            $scope.client = clientService.get({id: $routeParams.id});

            $scope.error = {
                erro: false,
                message: ''
            };

            $scope.delete = function () {
                $scope.client.$delete().then(function () {
                    $location.path('/clients');
                },function (data) {
                    $scope.error.erro = true;
                    $scope.error.message = data.data.erro;
                });
            };
        }]);
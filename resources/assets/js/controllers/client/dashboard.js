angular.module('app.controllers')
    .controller('clientDashboardController', [
        '$scope',
        'clientService',
        '$location',
        '$routeParams',
        function ($scope,
                  clientService,
                  $location,
                  $routeParams) {

            $scope.client = clientService.get({id: $routeParams.id});

            $scope.save = function () {
                if ($scope.form.$valid) {
                    clientService.update({id: $scope.client.id}, $scope.client, function () {
                        $location.path('/clients');
                    }, function () {

                    });
                }
            };
        }]);
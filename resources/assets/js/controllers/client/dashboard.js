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

            $scope.client = {};

            clientService.query({
                orderBy: 'created_at',
                sortedBy: 'desc',
                limit: 8
            }, function (response) {
                $scope.clients = response.data;
                $scope.client = $scope.clients[0];
            });

            $scope.showClient = function (client) {
                $scope.client = client;
            };
        }]);
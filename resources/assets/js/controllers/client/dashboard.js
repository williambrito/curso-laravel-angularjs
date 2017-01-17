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

            clientService.query({
                orderBy: 'created_at',
                sortedBy: 'desc',
                limit: 8
            }, function (response) {
                $scope.clients = response.data;
            });
        }]);
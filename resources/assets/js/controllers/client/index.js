angular.module('app.controllers')
    .controller('clientIndexController', ['$scope', 'clientService', function ($scope, clientService) {
        $scope.clients = clientService.query();
    }]);
angular.module('app.controllers')
    .controller('clientCreateController', ['$scope', 'clientService', '$location',
        function ($scope, clientService, $location) {
            $scope.client = new clientService();

            $scope.save = function () {
                $scope.client.$save().then(function () {
                    $location.path('clients');
                }, function () {

                });
            };
        }]);
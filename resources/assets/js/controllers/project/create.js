angular.module('app.controllers')
    .controller('projectCreateController', [
        '$scope',
        'projectService',
        'clientService',
        '$location',
        function ($scope,
                  projectService,
                  clientService,
                  $location) {

            $scope.project = new projectService();
            $scope.clients = clientService.query();

            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.project.$save().then(function () {
                        $location.path('/projects');
                    }, function () {

                    });
                }
            };
        }]);
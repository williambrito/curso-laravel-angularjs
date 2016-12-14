angular.module('app.controllers')
    .controller('projectCreateController', [
        '$scope',
        'projectService',
        'clientService',
        '$location',
        'appConfig',
        function ($scope,
                  projectService,
                  clientService,
                  $location,
                  appConfig) {

            $scope.project = new projectService();
            $scope.clients = clientService.query();
            $scope.status = appConfig.project.status;

            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.project.$save().then(function () {
                        $location.path('/projects');
                    }, function () {

                    });
                }
            };
        }]);
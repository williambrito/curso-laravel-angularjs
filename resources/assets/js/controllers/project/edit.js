angular.module('app.controllers')
    .controller('projectEditController', [
        '$scope',
        'projectService',
        'clientService',
        'appConfig',
        '$location',
        '$routeParams',
        function ($scope,
                  projectService,
                  clientService,
                  appConfig,
                  $location,
                  $routeParams) {

            $scope.project = projectService.get({id: $routeParams.id});
            $scope.clients = clientService.query();
            $scope.status = appConfig.project.status;

            $scope.save = function () {
                if ($scope.form.$valid) {
                    projectService.update({id: $scope.project.id}, angular.copy($scope.project), function () {
                        $location.path('/projects');
                    }, function () {

                    });
                }
            };
        }]);
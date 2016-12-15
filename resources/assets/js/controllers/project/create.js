angular.module('app.controllers')
    .controller('projectCreateController', [
        '$scope',
        'projectService',
        'clientService',
        '$location',
        'appConfig',
        '$cookies',
        function ($scope,
                  projectService,
                  clientService,
                  $location,
                  appConfig,
                  $cookies) {

            $scope.projectService = new projectService();
            $scope.project = {};
            $scope.clients = clientService.query();
            $scope.status = appConfig.project.status;

            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.project.owner_id = $cookies.getObject('user').id;
                    $scope.projectService.$save($scope.project).then(function () {
                        $location.path('/projects');
                    }, function () {

                    });
                }
            };
        }]);
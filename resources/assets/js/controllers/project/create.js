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
            $scope.status = appConfig.project.status;

            $scope.due_date = {
                status: {
                    opened: false
                }
            };

            $scope.open = function () {
                $scope.due_date.status.opened = true;
            };

            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.project.owner_id = $cookies.getObject('user').id;
                    $scope.projectService.$save($scope.project).then(function () {
                        $location.path('/projects');
                    }, function () {

                    });
                }
            };

            $scope.formatName = function (model) {
                if (model) {
                    return model.name;
                }
                return '';
            };

            $scope.getClients = function (name) {
                return clientService.query({
                    search: name
                }).$promise;
            };
        }]);
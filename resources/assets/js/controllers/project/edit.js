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

            projectService.get({id: $routeParams.id}, function (data) {
                $scope.project = data;
                clientService.get({id: data.client_id}, function (data) {
                    $scope.clientSelected = data;
                });
            });

            $scope.status = appConfig.project.status;

            $scope.save = function () {
                if ($scope.form.$valid) {
                    projectService.update({id: $scope.project.id}, $scope.project, function () {
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
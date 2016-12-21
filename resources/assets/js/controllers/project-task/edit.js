angular.module('app.controllers')
    .controller('projectTaskEditController', [
        '$scope',
        'projectTaskService',
        '$location',
        '$routeParams',
        'appConfig',
        function ($scope,
                  projectTaskService,
                  $location,
                  $routeParams,
                  appConfig) {

            $scope.task = projectTaskService.get({
                id: $routeParams.id,
                idTask: $routeParams.idTask
            });
            $scope.status = appConfig.projectTask.status;

            $scope.start_date = {
                status: {
                    opened: false
                }
            };

            $scope.due_date = {
                status: {
                    opened: false
                }
            };

            $scope.openStartDatePicker = function () {
                $scope.start_date.status.opened = true;
            };

            $scope.openDueDatePicker = function () {
                $scope.due_date.status.opened = true;
            };

            $scope.save = function () {
                if ($scope.form.$valid) {
                    projectTaskService.update({
                        id: $routeParams.id,
                        idTask: $routeParams.idTask
                    }, $scope.task, function () {
                        $location.path('/project/' + $routeParams.id + '/tasks');
                    });
                }
            };
        }]);
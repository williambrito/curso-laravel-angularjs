angular.module('app.controllers')
    .controller('projectTaskCreateController', [
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
            $scope.task = new projectTaskService();
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
                    $scope.task.$save({id: $routeParams.id}).then(function () {
                        $location.path('/project/' + $routeParams.id + '/tasks');
                    });
                }
            };
        }]);
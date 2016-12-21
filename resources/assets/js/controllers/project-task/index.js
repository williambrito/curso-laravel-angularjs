angular.module('app.controllers')
    .controller('projectTaskIndexController', [
        '$scope',
        'projectTaskService',
        '$routeParams',
        'appConfig',
        function ($scope,
                  projectTaskService,
                  $routeParams,
                  appConfig) {

            $scope.task = new projectTaskService();

            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.task.status = appConfig.projectTask.status[0].value;
                    $scope.task.$save({id: $routeParams.id}).then(function (data) {
                        $scope.task = new projectTaskService();
                        $scope.tasks.unshift(data);
                    });
                }
            };

            $scope.loadTask = function () {
                $scope.tasks = projectTaskService.query({
                    id: $routeParams.id,
                    orderBy: 'id',
                    sortedBy: 'desc'
                });
            };

            $scope.loadTask();
        }]);
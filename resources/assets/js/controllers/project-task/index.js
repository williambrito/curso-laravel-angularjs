angular.module('app.controllers')
    .controller('projectTaskIndexController', [
        '$scope',
        'projectTaskService',
        '$routeParams',
        function ($scope,
                  projectTaskService,
                  $routeParams) {

            $scope.loadTask = function () {
                $scope.tasks = projectTaskService.query({
                    id: $routeParams.id,
                    orderBy: 'id',
                    sortedBy: 'desc'
                });
            };

            $scope.loadTask();
        }]);
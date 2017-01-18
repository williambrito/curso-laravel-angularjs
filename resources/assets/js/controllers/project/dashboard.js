angular.module('app.controllers')
    .controller('projectDashboardController', [
        '$scope',
        'projectService',
        '$location',
        '$routeParams',
        function ($scope,
                  projectService,
                  $location,
                  $routeParams) {

            $scope.projects = [];
            $scope.project = {};

            projectService.query({
                orderBy: 'created_at',
                sortedBy: 'desc',
                limit: 8
            }, function (response) {
                $scope.projects = response.data;
                $scope.project = $scope.projects[0];
            });

            $scope.showProject = function (project) {
                $scope.project = project;
            };
        }]);
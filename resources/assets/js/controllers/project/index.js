angular.module('app.controllers')
    .controller('projectIndexController', [
        '$scope',
        'projectService',
        function ($scope,
                  projectService) {

            $scope.projects = [];
            $scope.totalProjects = 0;
            $scope.projectsPerPage = 15;

            $scope.pagination = {
                current: 1
            };

            $scope.pageChanged = function (newPage) {
                getResultsPage(newPage);
            };

            function getResultsPage(pageNumber) {
                projectService.query({}, function (data) {
                    $scope.projects = data;
                    //$scope.totalProjects = result.data.Count
                });
            }

            getResultsPage(1);
        }]);
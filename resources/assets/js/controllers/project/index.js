angular.module('app.controllers')
    .controller('projectIndexController', [
        '$scope',
        'projectService',
        function ($scope,
                  projectService) {

            $scope.projects = [];
            $scope.totalProjects = 0;
            $scope.projectsPerPage = 1;

            $scope.pagination = {
                current: 1
            };

            $scope.pageChanged = function (newPage) {
                getResultsPage(newPage);
            };

            function getResultsPage(pageNumber) {
                projectService.query({
                        page: pageNumber,
                        limit: $scope.projectsPerPage
                    },
                    function (data) {
                        $scope.projects = data.data;
                        $scope.totalProjects = data.meta.pagination.total;
                    });
            }

            getResultsPage(1);
        }]);
angular.module('app.controllers')
    .controller('projectIndexController', ['$scope', 'projectService',
        function ($scope, projectService) {
            $scope.projects = projectService.query();
        }]);
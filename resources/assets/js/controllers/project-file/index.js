angular.module('app.controllers')
    .controller('projectFileIndexController', [
        '$scope',
        'projectFileService',
        '$routeParams',
        function ($scope,
                  projectFileService,
                  $routeParams) {
            $scope.files = projectFileService.query({id: $routeParams.id});
        }]);
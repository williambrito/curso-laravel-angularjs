angular.module('app.controllers')
    .controller('projectNoteIndexController', [
        '$scope',
        'projectNoteService',
        '$routeParams',
        function ($scope,
                  projectNoteService,
                  $routeParams) {
            $scope.notes = projectNoteService.query({id: $routeParams.id});
        }]);
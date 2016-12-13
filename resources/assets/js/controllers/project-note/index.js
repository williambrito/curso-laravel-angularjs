angular.module('app.controllers')
    .controller('projectNoteIndexController', [
        '$scope',
        'projectNoteService',
        function ($scope,
                  projectNoteService) {
            $scope.notes = projectNoteService.query();
        }]);
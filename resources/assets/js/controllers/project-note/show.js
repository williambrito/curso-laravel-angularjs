angular.module('app.controllers')
    .controller('projectNoteShowController', [
        '$scope',
        'projectNoteService',
        function ($scope,
                  projectNoteService) {
            $scope.note = projectNoteService.query();
        }]);
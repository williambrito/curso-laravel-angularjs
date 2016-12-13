angular.module('app.controllers')
    .controller('projectNoteEditController', [
        '$scope',
        'projectNoteService',
        '$location',
        '$routeParams',
        function ($scope,
                  projectNoteService,
                  $location,
                  $routeParams) {
            $scope.note = projectNoteService.get({id: $routeParams.id});

            $scope.save = function () {
                if ($scope.form.$valid) {
                    projectNoteService.update({id: $scope.note.id}, $scope.note, function () {
                        $location.path('note');
                    }, function () {

                    });
                }
            };
        }]);
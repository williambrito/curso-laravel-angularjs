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

            $scope.note = projectNoteService.get({
                id: $routeParams.id,
                idNote: $routeParams.idNote
            });

            $scope.save = function () {
                if ($scope.form.$valid) {
                    projectNoteService.update({
                        id: $routeParams.id,
                        idNote: $routeParams.idNote
                    }, $scope.note, function () {
                        $location.path('/project/' + $routeParams.id + '/notes');
                    }, function () {

                    });
                }
            };
        }]);